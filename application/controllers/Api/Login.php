<?php

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'login');
    }
    public function index_get()
    {
       // $mahasiswa = $this->mahasiswa->getMahasiswa();
        //var_dump($mahasiswa);
        $username = $this->get('username'); 
        $password = $this->get('password');
     
        if($username==null && $password == null){
            $login =  $this->login->getLogin();
        }
       
        else{

            $login = $this->login->getLogin($username,$password);
        }
        $this->response($login,200);
    }

    function index_post() {
        $username = $this->post('username');
        $password = $this->post('password');
        $id_login = $this->get('id_login');
        $uuid = uniqid('', true);

        $data = array(
            'id_login'          => $this->post('id_login'),
            'unique_id'         => $uuid,
            'username'          => $this->post('username'),
            'password'          => $this->post('password')
        );
        $cekLogin=$this->login->login($username,$password);
        if($cekLogin){
            $create = $this->login->create($data);
            $this->response(array('data'=> $data,200));
        } else {
            $this->response(null);
       }
    }

    
     function index_put() {
        $id = $this->put('unique_id');
        $data = array(    
            'unique_id'           => $this->put('unique_id'),
            'jam_logout'          => $this->put('jam_logout')
        );

        $update = $this->login->update($data, $id);
         if ($update) {
             $this->response($data, 200);
         } else {
             $this->response(array('status' => 'fail', 502));
         }
     }
    
}


?>