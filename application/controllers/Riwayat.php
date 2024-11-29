<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sewa');
        $this->load->model('m_penyewa');
        $this->load->model('m_mobil');
    }

    public function index()
    {
        $penyewaUsersId = $this->session->user_id; 

        $this->db->select('
        sewa.sewaId AS sewa_id,
        sewa.sewaNomorTransaksi AS no_transaksi,
        penyewa.penyewaNama AS penyewa,
        mobil.mobilMerk AS merk,
        mobil.mobilModel AS model,
        sewa.sewaTanggalSewa AS tgl_sewa,
        sewa.sewaTanggalKembali AS tgl_kembali,
        sewa.sewaTanggalSelesai AS tgl_selesai,
        sewa.sewaTotalBayar AS total_bayar,
        sewa.sewaDenda AS denda,
        (sewa.sewaTotalBayar + COALESCE(sewa.sewaDenda, 0)) AS total_bayar_akhir,
        sewa.sewaStatus AS status
    ');
        $this->db->from('sewa');
        $this->db->join('penyewa', 'sewa.sewaPenyewaId = penyewa.penyewaId');
        $this->db->join('mobil', 'sewa.sewaMobilId = mobil.mobilId');
        $this->db->where('penyewa.penyewaUsersId', $penyewaUsersId);

        $data['penyewa'] = $this->db->get()->result();
        $data['sewa'] = $this->db->count_all('sewa');


        $this->load->view('user/riwayat', $data);
    }


}