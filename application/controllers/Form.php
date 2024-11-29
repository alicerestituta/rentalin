<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penyewa');
        $this->load->library('email');
    }


    public function create()
    {
        $data = array(
            'penyewaUsersId' => $this->session->userdata('user_id'),
            'penyewaNama' => $this->input->post('txnama'),
            'penyewaEmail' => $this->input->post('txemail'),
            'penyewaNoKtp' => $this->input->post('txnomorktp'),
            'penyewaTelepon' => $this->input->post('txnomortelepon'),
            'penyewaAlamat' => $this->input->post('txalamat'),
        );

        if (empty($data['penyewaNama']) || empty($data['penyewaEmail']) || empty($data['penyewaNoKtp']) || empty($data['penyewaTelepon']) || empty($data['penyewaAlamat'])) {
            $response = array(
                'status' => 'error',
                'msg' => 'Semua field harus diisi!'
            );
            echo json_encode($response);
            return;
        }

        $insert = $this->m_penyewa->insert_penyewa($data);

        $mobilId = $this->input->post('txmobilid');
        $tanggalSewa = date('Y-m-d', strtotime($this->input->post('txtanggalsewa')));
        $tanggalKembali = $this->input->post('txtanggalkembali');
        $totalBayar = $this->input->post('txjumlahbayar');
        $no_trans = $this->notrx($tanggalSewa);

        $sql = "INSERT INTO sewa (sewaPenyewaId, sewaNomorTransaksi, sewaMobilId, sewaTanggalSewa, sewaTanggalKembali, sewaTotalBayar, sewaStatus)
            VALUES ('{$insert}','{$no_trans}','{$mobilId}','{$tanggalSewa}','{$tanggalKembali}','{$totalBayar}', 1)";
        $this->db->query($sql);

        // Cek hasil insert
        if ($insert) {
            $response = array(
                'status' => 'success',
                'msg' => 'Sewa berhasil',
                'no_tran' => $no_trans
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Sewa gagal'
            );
        }

        echo json_encode($response);
    }

    function config_email()
    {
        $umail = "alicerestituta@gmail.com";
        $upass = "fpoqscskiszghfam";

        $config['config'] = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $umail,
            'smtp_pass' => $upass,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $config['sender'] = '<noreply>Sender Mail';
        return $config;
    }

    public function get_data_sewa($no_trans)
    {
        $sql = "SELECT*FROM sewa JOIN mobil ON sewa.sewaMobilId = mobil.mobilId  where sewaNomorTransaksi = '{$no_trans}'";
        $data = $this->db->query($sql)->row();
        return $data;
    }

    public function tes_email()
    {
        $email = $this->input->post('email');
        $subject = 'Invoice - Rentalin';


        $get_sewa = $this->get_data_sewa($this->input->post('no_tran'));
        $msg = "<style>@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');</style>";


        $msg .= '<table width="100%" style="font-family: system-ui; background-color: #51B37F; color: #fff; padding: 20px 0;">
                    <tr>
                        <td valign="top" width="30%" align="center">
                        </td>
                        <td width="70%" align="right" style="font-size: 10px; padding-right: 20px;">
                            <div>' . date('F, d M Y') . '</div>
                            <div><strong>Invoice No:</strong> <b>' . $get_sewa->sewaNomorTransaksi . '</b></div>
                        </td>
                    </tr>
                </table>';

        $msg .= '<div style="padding: 20px; font-family: \'Open Sans\', sans-serif; color: #333; font-size: 16px;">
                    <p style="font-size: 16px; color: #333;">Terima kasih telah menyewa mobil di Rentalin! Berikut adalah rincian invoice Anda.</p>
                </div>';

        $msg .= '<div style="text-align: center; margin: 30px 0; font-family: \'Open Sans\', sans-serif;">
                    <span style="font-size: 14px; color: #fff; background-color: #51B37F; padding: 12px 25px; border-radius: 25px; font-weight: bold;">
                        Total Sewa: <span style="font-size: 14px;">Rp '. number_format($get_sewa->sewaTotalBayar).'</span>
                    </span>
                </div>';

        $msg .= '<table width="100%" cellpadding="10" cellspacing="0" style="font-family: \'Open Sans\', sans-serif; border-collapse: collapse; border-top: solid 2px #ddd;">
                    <tr style="background-color: #f1f1f1; text-align: left; color: #333;">
                        <th style="padding: 10px 15px; border-bottom: 2px solid #ddd;">Merk</th>
                        <th style="padding: 10px 15px; border-bottom: 2px solid #ddd;"> Model</th>
                        <th style="padding: 10px 15px; border-bottom: 2px solid #ddd;">Harga</th>
                    </tr>
                    <tr>
                        <td style="padding: 10px 15px; border-bottom: 1px solid #ddd;">' . $get_sewa->mobilMerk . '</td>
                        <td style="padding: 10px 15px; border-bottom: 1px solid #ddd;">' . $get_sewa->mobilModel . '</td>
                        <td style="padding: 10px 15px; border-bottom: 1px solid #ddd;">Rp '.number_format($get_sewa->sewaTotalBayar).'</td>
                    </tr>
                </table>';

        $msg .= '<div style="padding: 20px; text-align: center; font-family: \'Open Sans\', sans-serif; color: #777; font-size: 14px; background-color: #f9f9f9;">
                    <p>Jika ada pertanyaan atau masalah terkait invoice ini, silakan hubungi kami di <a href="mailto:support@rentalin.id" style="color: #1a73e8;">support@rentalin.id</a></p>
                    <p>Terima kasih atas dukungan Anda!</p>
                </div>';

        $config = $this->config_email();
        $this->load->library('email', $config['config']);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype('html');

        $this->email->from($config['sender']);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($msg);

        if ($this->email->send()) {
            $res['notice']['success'] = 'Email berhasil terkirim';
            $res['msg'] = 'Email berhasil terkirim';
            $res['state'] = 1;
        } else {
            $pesan = $this->email->print_debugger();
            $res['notice']['error'] = 'Email Gagal terkirim';
            $res['msg'] = 'Email Gagal terkirim - ' . $pesan;
            $res['state'] = 2;
        }

        return $res;
    }

    //     public function create()
    // {
    //     // Ambil data dari request
    //     $data = array(
    //         'penyewaUsersId' => $this->session->userdata('user_id'),
    //         'penyewaNama' => $this->input->post('txnama'),
    //         'penyewaEmail' => $this->input->post('txemail'),
    //         'penyewaNoKtp' => $this->input->post('txnomorktp'),
    //         'penyewaTelepon' => $this->input->post('txnomortelepon'),
    //         'penyewaAlamat' => $this->input->post('txalamat'),
    //     );

    //     // Validasi input
    //     if (empty($data['penyewaNama']) || empty($data['penyewaEmail']) || empty($data['penyewaNoKtp']) || empty($data['penyewaTelepon']) || empty($data['penyewaAlamat'])) {
    //         $response = array(
    //             'status' => 'error',
    //             'msg' => 'Semua field harus diisi!'
    //         );
    //         echo json_encode($response);
    //         return;
    //     }

    //     // Simpan data penyewa
    //     $insert = $this->m_penyewa->insert_penyewa($data);

    //     if ($insert) {
    //         // Insert data sewa
    //         $mobilId = $this->input->post('txmobilid');
    //         $tanggalSewa = date('Y-m-d', strtotime($this->input->post('txtanggalsewa')));
    //         $tanggalKembali = $this->input->post('txtanggalkembali');
    //         $totalBayar = $this->input->post('txjumlahbayar');
    //         $no_trans = $this->notrx($tanggalSewa);

    //         $sql = "INSERT INTO sewa (sewaPenyewaId, sewaNomorTransaksi, sewaMobilId, sewaTanggalSewa, sewaTanggalKembali, sewaTotalBayar, sewaStatus)
    //             VALUES ('{$insert}','{$no_trans}','{$mobilId}','{$tanggalSewa}','{$tanggalKembali}','{$totalBayar}', 1)";
    //         $this->db->query($sql);

    //         // Kirim email setelah data berhasil disimpan
    //         $this->tes_email($data['penyewaEmail'], $data['penyewaNama'], $totalBayar);

    //         $response = array(
    //             'status' => 'success',
    //             'msg' => 'Sewa berhasil'
    //         );
    //     } else {
    //         $response = array(
    //             'status' => 'error',
    //             'msg' => 'Sewa gagal'
    //         );
    //     }

    //     echo json_encode($response);
    // }

    // public function tes_email($email, $nama, $totalBayar)
    // {
    //     $subject = 'Invoice - Rentalin';
    //     $msg = "<p>Terima kasih telah menyewa mobil di Rentalin! Berikut adalah rincian invoice Anda:</p>";
    //     $msg .= "<p>Nama: $nama</p>";
    //     $msg .= "<p>Total Bayar: Rp$totalBayar</p>";
    //     $this->load->library('email');
    //     $this->email->from('your_email@example.com', 'Rentalin');
    //     $this->email->to($email);
    //     $this->email->subject($subject);
    //     $this->email->message($msg);

    //     return $this->email->send();
    // }




    public function notrx($tgl)
    {
        $sql = "SELECT IFNULL(
        (
                SELECT 	concat('TRX/', 
                                DATE_FORMAT('$tgl' ,'%m%y'),'/',
                                RIGHT(concat('000',RIGHT(sewaNomorTransaksi,3)+1),3))
                FROM sewa
                WHERE sewaNomorTransaksi like concat('TRX/',
                                DATE_FORMAT('$tgl' ,'%m%y'),'/','%')
                                AND DATE_FORMAT(sewaTanggalSewa  ,'%Y%m')=DATE_FORMAT( '$tgl' ,'%Y%m')
                ORDER BY RIGHT(sewaNomorTransaksi,3) DESC LIMIT 1
        ),
        (
                SELECT	concat('TRX/',
                                DATE_FORMAT('$tgl' ,'%m%y'),'/001')
                
        )
        ) no_trans;";
        $no_trans = $this->db->query($sql)->row()->no_trans;
        return $no_trans;
    }
}
