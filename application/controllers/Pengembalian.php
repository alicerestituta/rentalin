<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sewa');
        $this->load->model('m_penyewa');
        $this->load->model('m_mobil');
    }

    public function index()
    {
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
        $data['penyewa'] = $this->db->get()->result();

        $data['sewa'] = $this->db->count_all('sewa');

        $this->load->view('header');
        $this->load->view('admin/pengembalian', $data);
        $this->load->view('footer');
    }

    public function cetak_nota_pengembalian($id = null)
    {
        if ($id !== null) {
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
            $this->db->where('sewaId', $id);
            $data['penyewa'] =(object) $this->db->get()->row_array();
            $this->load->view('admin/cetak_nota_pengembalian', $data);
        }
    }
}
