<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function validate_user($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data); 
    }

    public function get_user_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); 
        return $query->row(); 
    }

    public function validate_password($user_id, $password) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user) {
    
            return password_verify($password, $user->password);
        } else {
            return false;
        }
    }

    public function is_username_exist($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); 
    
        if ($query->num_rows() > 0) {
            return true; 
        } else {
            return false; 
        }
    }
    

}
