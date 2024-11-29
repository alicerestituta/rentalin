<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('auth'); 
        check_login(); 
        check_user(); 
    }

    public function index() {
        $data['mobil'] = $this->m_mobil->get_mobil_data();
        $this->load->view('user/dashboard', $data);
    }

    public function form() {
        $mobilId = $this->input->get('id');
        $this->load->model('m_mobil');
        $data['item'] = $this->m_mobil->get_car_by_id($mobilId);
        $this->load->view('user/form', $data); 
    }

    public function search() {
        $merk = $this->input->get('merk'); 
        
        $this->load->model('m_mobil');
        $data['mobil'] = $this->m_mobil->search_mobil($merk);
        
        $this->load->view('user/dashboard', $data);
    }

    public function dashboard() {
        $mobilId = $this->input->get('id');
        $this->load->model('m_mobil');
        if ($mobilId) {
            $data['mobil'] = $this->m_mobil->get_car_by_id($mobilId);
        }
        $this->load->view('user/dashboard/form', $data);
    }
}
