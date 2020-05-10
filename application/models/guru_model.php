<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class guru_model extends CI_Model {

    public function getGuru($id = null){
        // return $this->db->get('mahasiswa')->result_array();
        if($id === null){
        
        return $this->db->get('guru')->result_array();
        } else {
            return $this->db->get_where('guru', ['id_guru' => $id])->result_array();
        }
    }

    
    public function create($data){
        $this->db->insert('guru',$data);
        return $this->db->affected_rows();
    }

    // public function update($data,$id){
    //     $this->db->update('mahasiswa',$data, ['nim'=>$id]);
    //     return $this->db->affected_rows();
        
    // }

}

/* End of file mahasiswa_model.php */

?>