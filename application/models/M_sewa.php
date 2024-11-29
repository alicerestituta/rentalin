<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sewa extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_sewa($data)
    {
        $this->db->insert('sewa', $data);
    }
    
}
