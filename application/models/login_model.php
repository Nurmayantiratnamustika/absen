<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

    public function getLogin($username = null,$password= null){
        // return $this->db->get('mahasiswa')->result_array();

        if($username === null && $password === null){
        
            return $this->db->get('tbl_login')->result_array();
            } else {
                return $this->db->get_where('tbl_login', ['username' => $username,'password' => $password])->result_array();
            }
    }

    
    public function create($data){
        
        $this->db->insert('tbl_login',$data);

        return $this->db->affected_rows();
    }

    public function update($data,$id){
         $this->db->update('tbl_login',$data, ['unique_id'=>$id]);
         return $this->db->affected_rows();
        
     }

     
    public function login($username,$password){   
            $this->db->select('username,password,alamat');
            $this->db->from('guru');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->limit(1);
            
            $query=$this->db->get();
            if ($query->num_rows()==1) {
                return $query->result();
            }
            else{
                return false;
            }
        }


}

/* End of file mahasiswa_model.php */

?>