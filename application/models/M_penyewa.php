<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penyewa extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_penyewa($data) {
        $this->db->insert('penyewa', $data);
        return $this->db->insert_id();
    }

    public function get_penyewa_data() {
        $sql = "SELECT * FROM penyewa WHERE penyewaHapus = 0 ORDER BY penyewaId asc";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

    public function delete_penyewa($id) {
        $sql = "UPDATE penyewa SET penyewaHapus = 1 WHERE penyewaId='$id'";
        return $this->db->query($sql);
    }
}

