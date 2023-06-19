<?php
class LoginModel extends CI_Model{
    public function getByUsername($username){
        $this->db->where('username',$username);
        $admin = $this->db->get('admin')->row_array();
        return $admin;
    }
}
?>