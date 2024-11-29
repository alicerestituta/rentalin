<?php
class M_penyewaan extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function update_data($id, $data) {
        $this->db->where('sewa_id', $id);
        return $this->db->update('penyewaan', $data); // Adjust the table name accordingly
    }
    
}
