<?php

require APPPATH . '/libraries/REST_Controller.php';

class Guru extends REST_Controller
{ 
    public $image="default.jpg";
    public $id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('guru_model', 'guru');
    }
    public function index_get()
    {
       // $mahasiswa = $this->mahasiswa->getMahasiswa();
        //var_dump($mahasiswa);
        $id = $this->get('id_guru');
     
        if($id==null){
            $guru =  $this->guru->getGuru();
        }
    
        else{

            $guru = $this->guru->getGuru($id);
        }
        $this->response($guru,200);
    }

    function index_post() {
        $this->id = uniqid();
        $data = array(
                    'id_guru'           => $this->post('id_guru'),
                    'nama'              => $this->post('nama'),
                    'alamat'            => $this->post('alamat'),
                    'jenis_kelamin'     => $this->post('jenis_kelamin'),
                    'no_telp'           => $this->post('no_telp'),
                    'username'          => $this->post('username'),
                    'password'          => $this->post('password'),
                    'foto'              => $this->_uploadImage()  
                );

        $insert = $this->guru->create($data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    private function _uploadImage()
    {
     $this->load->helper(array('form', 'url'));
      
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';//menentukan format file
        $config['file_name']            = $this->id;
        $config['overwrite']			= true;//menindih file yg sudah di upload saat di upload file baru
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }

   
    // function index_put() {
    //     $id = $this->put('nim');
    //     $data = array(
    //                 'nim'           => $this->put('nim'),
    //                 'nama'          => $this->put('nama'),
    //                 'alamat'        => $this->put('alamat'),
    //                 'jeniskelamin'  => $this->put('jeniskelamin'),
    //                 'telepon'       => $this->put('telepon')
    //             );

    //     $update = $this->mahasiswa->update($data, $id);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }
}


?>