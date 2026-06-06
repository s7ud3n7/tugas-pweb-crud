<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek session login user sesuai pola dosen
        if (!$this->session->userdata('user')) {
            redirect('auth', 'refresh');
        }
        
        // Load model yang dibutuhkan
        $this->load->model('ProdiModel');
        $this->load->model('FakultasModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Daftar Program Studi';
        $data['prodi'] = $this->ProdiModel->getAll();

        $header['title'] = "Daftar Program Studi";
        $this->load->view('layout/header', $header);
        $this->load->view('prodi/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Program Studi';
        $data['action'] = base_url('prodi/tambah');
        $data['button'] = 'Simpan';
        $data['prodi'] = null;
        
        $data['fakultas'] = $this->FakultasModel->getAll();

        $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric|is_unique[prodi.prodi_id]');
        $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required|in_list[D3,S1,S2]');
        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $header['title'] = 'Tambah Program Studi';
            $this->load->view('layout/header', $header);
            $this->load->view('prodi/form', $data);
            $this->load->view('layout/footer');
        } else {
            $insert_data = [
                'prodi_id'     => $this->input->post('prodi_id'),
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata'),
                'fakultas_id'  => $this->input->post('fakultas_id')
            ];

            $this->ProdiModel->insert($insert_data);

            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data program studi berhasil ditambahkan.'
            ]);
            redirect('prodi');
        }
    }

    public function ubah($id)
    {
        $data_lama = $this->ProdiModel->getById($id);
        
        if (!$data_lama) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data program studi tidak ditemukan.'
            ]);
            redirect('prodi');
        }

        $data['title'] = 'Ubah Program Studi';
        $data['action'] = base_url('prodi/ubah/' . $id);
        $data['button'] = 'Update';
        $data['prodi'] = $data_lama;

        $data['fakultas'] = $this->FakultasModel->getAll();

        $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required|in_list[D3,S1,S2]');
        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $header['title'] = 'Ubah Program Studi';
            $this->load->view('layout/header', $header);
            $this->load->view('prodi/form', $data);
            $this->load->view('layout/footer');
        } else {
            $update_data = [
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata'),
                'fakultas_id'  => $this->input->post('fakultas_id')
            ];

            $this->ProdiModel->update($id, $update_data);

            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data program studi berhasil diperbarui.'
            ]);
            redirect('prodi');
        }
    }

    public function hapus($id)
    {
        $data_lama = $this->ProdiModel->getById($id);
        
        if (!$data_lama) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data program studi tidak ditemukan.'
            ]);
            redirect('prodi');
        }

        $this->ProdiModel->delete($id);

        $this->session->set_flashdata('swal', [
            'icon'  => 'warning',
            'title' => 'Dihapus!',
            'text'  => 'Data program studi berhasil dihapus.'
        ]);
        redirect('prodi');
    }
}