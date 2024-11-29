<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Penyewaan extends CI_Controller
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
        $tglAwal = (!empty($_GET['tglawal'])) ? $_GET['tglawal'] : null;
        $tglAkhir = (!empty($_GET['tglakhir'])) ? $_GET['tglakhir'] : null;
        $sess['tglAwal'] = $tglAwal;
        $sess['tglAkhir'] = $tglAkhir;
        $this->session->set_userdata($sess);
        $this->db->select('sewa.sewaId AS sewa_id, sewa.sewaNomorTransaksi AS no_transaksi, penyewa.penyewaNama AS penyewa, mobil.mobilMerk AS merk, mobil.mobilModel AS model, sewa.sewaTanggalSewa AS tgl_sewa, sewa.sewaTanggalKembali AS tgl_kembali, sewa.sewaTotalBayar AS total_bayar, sewa.sewaStatus as status');
        $this->db->from('sewa');
        $this->db->join('penyewa', 'sewa.sewaPenyewaId = penyewa.penyewaId');
        $this->db->join('mobil', 'sewa.sewaMobilId = mobil.mobilId');
        if ($tglAwal != null) {
            $this->db->where("sewaTanggalSewa between '{$tglAwal}' and '{$tglAkhir}'");
        }
        $data['penyewa'] = $this->db->get()->result();

        $data['sewa'] = $this->db->count_all('sewa');
        $this->load->view('header');
        $this->load->view('admin/laporan_penyewaan', $data);
        $this->load->view('footer');
    }

    // function exportExcel()
    // {
    //     $sql = "SELECT 
    //             sewa.sewaId AS sewa_id, 
    //             sewa.sewaNomorTransaksi AS no_transaksi,
    //             penyewa.penyewaNama AS penyewa, 
    //             mobil.mobilMerk AS merk, 
    //             mobil.mobilModel AS model, 
    //             sewa.sewaTanggalSewa AS tgl_sewa, 
    //             sewa.sewaTanggalKembali AS tgl_kembali, 
    //             sewa.sewaTotalBayar AS total_bayar 
    //         FROM sewa 
    //         JOIN penyewa ON sewa.sewaPenyewaId = penyewa.penyewaId 
    //         JOIN mobil ON sewa.sewaMobilId = mobil.mobilId 
    //         ORDER BY sewa.sewaId";

    //     $res['data'] = $this->db->query($sql)->result_array();
    //     $res['filename'] = 'dataLaporanPenyewaan-' . date('Y-m-d_H-i-s');
    //     $output = $this->load->view("admin/export_excel_penyewaan", $res, true);
    //     echo $output;
    // }

    public function exportExcel()
    {
        
        $sql = "SELECT 
                sewa.sewaId AS sewa_id, 
                sewa.sewaNomorTransaksi AS no_transaksi, 
                penyewa.penyewaNama AS penyewa, 
                mobil.mobilMerk AS merk, 
                mobil.mobilModel AS model, 
                sewa.sewaTanggalSewa AS tgl_sewa, 
                sewa.sewaTanggalKembali AS tgl_kembali, 
                sewa.sewaTotalBayar AS total_bayar 
            FROM sewa 
            JOIN penyewa ON sewa.sewaPenyewaId = penyewa.penyewaId 
            JOIN mobil ON sewa.sewaMobilId = mobil.mobilId";

        if ($this->session->tglAwal != null && $this->session->tglAkhir != null) {
            $sql .= " WHERE sewa.sewaTanggalSewa BETWEEN '{$this->session->tglAwal}' AND '{$this->session->tglAkhir}'";
        }

        $sql .= " ORDER BY sewa.sewaId";
        $res['data'] = $this->db->query($sql)->result_array();
        $res['filename'] = 'dataLaporanPenyewaan-' . date('Y-m-d_H-i-s');
        $output = $this->load->view("admin/export_excel_penyewaan", $res, true);
        echo $output;
    }


    public function exportPDF()
    {

        $sql = "SELECT 
                    sewa.sewaId AS sewa_id, 
                    sewa.sewaNomorTransaksi AS no_transaksi,
                    penyewa.penyewaNama AS penyewa, 
                    mobil.mobilMerk AS merk, 
                    mobil.mobilModel AS model, 
                    sewa.sewaTanggalSewa AS tgl_sewa, 
                    sewa.sewaTanggalKembali AS tgl_kembali, 
                    sewa.sewaTotalBayar AS total_bayar 
                FROM sewa 
                JOIN penyewa ON sewa.sewaPenyewaId = penyewa.penyewaId 
                JOIN mobil ON sewa.sewaMobilId = mobil.mobilId";

        if ($this->session->tglAwal != null && $this->session->tglAkhir != null) {
            $sql .= " WHERE sewa.sewaTanggalSewa BETWEEN '{$this->session->tglAwal}' AND '{$this->session->tglAkhir}'";
        }

        $sql .= " ORDER BY sewa.sewaId";
        $data['data'] = $this->db->query($sql)->result_array();
        $data['filename'] = 'dataLaporanPenyewaan-' . date('Y-m-d_H-i-s');

        $this->load->library('dompdf_gen');

        $html = $this->load->view('admin/export_pdf_penyewaan', $data, true);

        $this->dompdf_gen->loadHtml($html);
        $this->dompdf_gen->setPaper('A4', 'landscape');
        $this->dompdf_gen->render();

        $this->dompdf_gen->stream($data['filename'] . '.pdf', array("Attachment" => true));
    }
}
