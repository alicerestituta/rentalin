<?php
class Penyewa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penyewa');
    }

    public function index()
    {
        $data['title'] = 'Penyewa';
        $data['js'] = 'penyewa';

        $this->load->view('header', $data);
        $this->load->view('admin/penyewa', $data);
        $this->load->view('footer', $data);
    }

    function load_data()
    {
        $data['penyewa'] = $this->m_penyewa->get_penyewa_data();
        echo json_encode($data);
    }

    public function create()
    {
        if ($this->input->post('txnomorktp') != '') {
            // $user_id = $this->session->user_id;
            $nama = $this->input->post('txnama');
            $email = $this->input->post('txemail');
            $nomor_ktp = $this->input->post('txnomorktp');
            $nomor_telepon = $this->input->post('txnomortelepon');
            $alamat = $this->input->post('txalamat');

            $sql = "INSERT INTO penyewa (penyewaNama, penyewaEmail, penyewaNoKtp, penyewaTelepon, penyewaAlamat) VALUES ('{$user_id}',{$nama}','{$email}','{$nomor_ktp}','{$nomor_telepon}','{$alamat}')";
            $exc = $this->db->query($sql);

            if ($exc) {
                $res['status'] = 'success';
                $res['msg'] = "Simpan data berhasil";
            } else {
                $res['status'] = 'error';
                $res['msg'] = "Simpan data gagal";
            }

            echo json_encode($res);
        }
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM penyewa WHERE penyewaId = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data {$id} sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Data tidak ditemukan";
        }
        echo json_encode($res);
    }

    public function update_table()
    {
        $id = $this->input->post('id');
        $penyewaNama = $this->input->post('penyewaNama');
        $penyewaEmail = $this->input->post('penyewaEmail');
        $penyewaNoKtp = $this->input->post('penyewaNoKtp');
        $penyewaTelepon = $this->input->post('penyewaTelepon');
        $penyewaAlamat = $this->input->post('penyewaAlamat');

        $this->db->where('penyewaId', $id);
        $update_data = array(
            'penyewaNama' => $penyewaNama,
            'penyewaEmail' => $penyewaEmail,
            'penyewaNoKtp' => $penyewaNoKtp,
            'penyewaTelepon' => $penyewaTelepon,
            'penyewaAlamat' => $penyewaAlamat,
        );

        if ($this->db->update('penyewa', $update_data)) {
            $res['status'] = 'success';
            $res['msg'] = "Data berhasil diperbarui";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal memperbarui data";
        }

        echo json_encode($res);
    }

    public function delete_table()
    {
        $id = $this->input->post('id');
        if ($this->m_penyewa->delete_penyewa($id)) {
            $res['status'] = 'success';
            $res['msg'] = "Data penyewa berhasil dihapus";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal menghapus data penyewa";
        }
        echo json_encode($res);
    }
}
