<?php
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth'); 
        check_login(); 
        check_admin(); 
        $this->load->model('m_sewa');
        $this->load->model('m_penyewa');
        $this->load->model('m_mobil');
    }

    function load_data()
    {
        $data['penyewa'] = $this->m_penyewa->get_penyewa_data();
        echo json_encode($data);
    }

    public function dashboard()
    {
        $this->db->select('sewa.sewaId AS sewa_id, sewa.sewaNomorTransaksi AS no_transaksi, penyewa.penyewaNama AS penyewa, penyewa.penyewaEmail AS email, mobil.mobilMerk AS merk, mobil.mobilModel AS model, sewa.sewaTanggalSewa AS tgl_sewa, sewa.sewaTanggalKembali AS tgl_kembali, sewa.sewaTotalBayar AS total_bayar, sewa.sewaStatus as status');
        $this->db->from('sewa');
        $this->db->join('penyewa', 'sewa.sewaPenyewaId = penyewa.penyewaId');
        $this->db->join('mobil', 'sewa.sewaMobilId = mobil.mobilId');
        $data['penyewa'] = $this->db->get()->result();

        $this->db->where('sewaStatus', 1);
        $data['sewa_berlangsung'] = $this->db->count_all_results('sewa');

        $this->db->where('sewaStatus', 0);
        $data['sewa_selesai'] = $this->db->count_all_results('sewa');

        $data['sewa'] = $this->db->count_all('sewa');

        $this->load->view('header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('footer');
    }

    public function ubah_status() {
        $sewa_id = $this->input->post('sewa_id');
        $status = $this->input->post('status');
    
        $this->db->where('sewaId', $sewa_id);
        $sewa = $this->db->get('sewa')->row();
    
        if (!$sewa) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            return;
        }
        if (isset($sewa->sewaTanggalKembali)) {
            $tanggal_kembali = new DateTime($sewa->sewaTanggalKembali);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tanggal kembali tidak ditemukan']);
            return;
        }
    
        $tanggal_sekarang = new DateTime(); 
        $harga = $sewa->sewaTotalBayar; 
    
        $denda = 0;
        if ($tanggal_sekarang > $tanggal_kembali) {
            $hari_telat = $tanggal_sekarang->diff($tanggal_kembali)->days; 
            $denda = $hari_telat * ($harga / 2); 
        }
    
        $data = [
            'sewaStatus' => $status,
            'sewaDenda' => $denda,
            'sewaTanggalSelesai' => $tanggal_sekarang->format('Y-m-d') 
        ];
    
        $this->db->where('sewaId', $sewa_id);
        $update = $this->db->update('sewa', $data);
    
        if ($update) {
            echo json_encode(['success' => true, 'denda' => $denda]);
        } else {
            echo json_encode(['success' => false]);
        }
    }   
}
