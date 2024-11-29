<?php
class M_usrdashboard extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_mobil_data() {
        $query = $this->db->get('mobil'); 
        return $query->result_array(); 
    }
}
