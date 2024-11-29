<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_mobil');
    }

    public function index()
    {
        $data['title'] = 'Mobil';
        $data['js'] = 'mobil';

        $this->load->view('header', $data);
        $this->load->view('admin/mobil', $data);
        $this->load->view('footer', $data);
    }

    function load_data()
    {
        $data['mobil'] = $this->m_mobil->get_mobil_data();
        echo json_encode($data);
    }

    public function create()
    {
        $this->load->helper('url');
        $merk = $this->input->post('merk');
        $model = $this->input->post('model');
        $kursi = $this->input->post('kursi');
        $harga_sewa = $this->input->post('harga_sewa');

        // Periksa apakah model sudah ada
        $this->db->where('mobilModel', $model);
        $query = $this->db->get('mobil');

        if ($query->num_rows() > 0) {
            // Model sudah ada
            echo json_encode(array('status' => 'error', 'msg' => "Model $model untuk merk $merk sudah tersedia"));
            return;
        }

        // Upload file
        $file_name = uniqid(); // Menghasilkan nama file unik
        $foto = $this->upload('foto', $file_name);

        if (is_array($foto) && isset($foto['error'])) {
            echo json_encode(array('status' => 'error', 'msg' => $foto['error']));
            return;
        }

        $mobilData = array(
            'mobilId' => 0,
            'mobilMerk' => $merk,
            'mobilModel' => $model,
            'mobilFoto' => $foto,
            'mobilKursi' => $kursi,
            'mobilHargaSewa' => $harga_sewa,
            'mobilStatus' => 1
        );

        $this->db->insert('mobil', $mobilData);
        echo json_encode(array('status' => 'success', 'msg' => 'Data mobil berhasil tersimpan!'));
    }
    
    function upload($field, $filename)
    {
        $this->load->library('upload');

        // Konfigurasi upload
        $config['upload_path']   = './uploads/mobil/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg'; // Hanya tipe file yang diizinkan
        $config['file_name']     = $filename;
        $config['max_size']      = 2048; // Maksimum ukuran file (2MB)
        $config['overwrite']     = TRUE; // Mengganti file dengan nama yang sama

        // Inisialisasi library upload
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field)) {
            $uploadData = $this->upload->data();
            $this->img_resize('./uploads/mobil/' . $uploadData['file_name']);
            return 'uploads/mobil/' . $uploadData['file_name'];
        } else {
            $error = $this->upload->display_errors();
            return array('error' => $error);
        }
    }


    function img_resize($file)
    {
        $config['image_library'] = 'gd2';
        $config['source_image']  = $file;
        $config['create_thumb']  = FALSE;
        $config['quality']       = '70%';
        $config['width']         = 315; // Sesuaikan dengan ukuran yang diinginkan
        $config['height']        = 0;   // Biarkan tinggi otomatis
        $config['maintain_ratio'] = TRUE;
        $config['master_dim']    = 'width';
        $config['new_image']     = $file;

        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize()) {
            $error = $this->image_lib->display_errors();
            return array('error' => $error);
        }

        $this->image_lib->clear();
        return TRUE;
    }

    public function edit_table()
    {
        $id = $this->input->post('id');

        // Mengambil data mobil berdasarkan ID
        $mobil = $this->db->query("SELECT * FROM mobil WHERE mobilId = ?", array($id))->row_array();

        if ($mobil) {
            $res['status'] = 'ok';
            $res['data'] = [
                'mobil' => $mobil
            ];
            $res['msg'] = "Data {$id} ditemukan";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Data {$id} tidak dapat ditemukan";
        }

        echo json_encode($res);
    }

    public function update_mobil()
    {
        $id = $this->input->post('id');

        // Ambil data dari input form
        $mobilData = array(
            'mobilMerk' => $this->input->post('mobilMerk'),
            'mobilModel' => $this->input->post('mobilModel'),
            'mobilKursi' => $this->input->post('mobilKursi'),
            'mobilHargaSewa' => $this->input->post('mobilHargaSewa'),
        );

        // Cek jika ada file foto baru yang diunggah
        $fotoFile = $_FILES['mobilFoto']['name'];
        if (!empty($fotoFile)) {
            // Upload foto
            $uploadedFile = $this->upload('mobilFoto', $fotoFile);
            if ($uploadedFile) {
                // Update data mobil dengan foto baru
                $mobilData['mobilFoto'] = $uploadedFile;
            } else {
                // Jika upload foto gagal
                $res['status'] = 'error';
                $res['msg'] = 'Gagal mengupload foto';
                echo json_encode($res);
                return;
            }
        }

        // Update data mobil di database
        $this->db->where('mobilId', $id);
        if ($this->db->update('mobil', $mobilData)) {
            $res['status'] = 'success';
            $res['msg'] = 'Data berhasil diperbarui';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Gagal memperbarui data';
        }

        echo json_encode($res);
    }


    public function delete_table()
    {
        $id = $this->input->post('id');
        if ($this->m_mobil->delete_table($id)) {
            $res['status'] = 'success';
            $res['msg'] = "Data berhasil dihapus";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal menghapus data";
        }
        echo json_encode($res);
    }

    public function active()
    {
        $id = $this->input->post("id");
        $status = $this->input->post("status");

        if ($this->m_mobil->active_data($id)) {
            $res["status"] = "success";
            $ket = ($status == 1) ?  "tidak tersedia" :  "tersedia";
            $res["msg"] = "Data tersedia";
        } else {
            $res["status"] = "error";
            $ket = ($status == 0) ?  "tidak tersedia" :  "tersedia";
            $res["msg"] = "Data tidak tersedia";
        }
        echo json_encode($res);
    }
}
