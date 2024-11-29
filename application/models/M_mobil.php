<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mobil extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_mobil($data) {
        return $this->db->insert('mobil', $data);
    }

    public function get_mobil_data() {
        $sql = "SELECT * FROM mobil WHERE mobilHapus = 0 ORDER BY mobilId asc";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

    public function delete_table($id) {
        $sql = "UPDATE mobil SET mobilHapus = 1 WHERE mobilId = '$id'";
        return $this->db->query($sql, array($id));
    }

    public function active_data($id)
    {
        $sql = "UPDATE mobil SET mobilStatus = IF(mobilStatus = 1, 0, 1) WHERE mobilId = ?";
        return $this->db->query($sql, array($id));
    }

    public function search_mobil($merk) {
        $this->db->select('*');
        $this->db->from('mobil');
        if (!empty($merk)) {
            $this->db->where('mobilMerk', $merk); // Filter berdasarkan merk
        }
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan hasil pencarian
    }

    public function get_car_by_id($mobilId) {
        $this->db->where('mobilId', $mobilId);
        $query = $this->db->get('mobil'); // 'mobil' adalah nama tabel Anda
        return $query->row_array(); // Mengembalikan satu baris sebagai array asosiatif
    }
    
}

