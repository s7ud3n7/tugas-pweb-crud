<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct()
{
    parent::__construct();
    if (!$this->session->userdata('user')) {
        redirect('auth', 'refresh');
    }
    
    $this->load->model('FakultasModel');
    $this->load->library('form_validation');
}

    public function index()
    {
        $data['title'] = 'Daftar Fakultas';
        $data['fakultas'] = $this->FakultasModel->getAll();

       $header['title'] = "Daftar Fakultas";
        $this->load->view('layout/header', $header);
        $this->load->view('fakultas/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Fakultas';
        $data['action'] = base_url('fakultas/tambah');
        $data['button'] = 'Simpan';
        $data['fakultas'] = null;

        $this->form_validation->set_rules('fakultas_id', 'ID Fakultas', 'required|numeric|is_unique[fakultas.fakultas_id]');
        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $header['title'] = 'Tambah Fakultas';
            $this->load->view('layout/header', $header);
            $this->load->view('fakultas/form', $data);
            $this->load->view('layout/footer');
        } else {
            $insert_data = [
                'fakultas_id'   => $this->input->post('fakultas_id'),
                'fakultas_name' => $this->input->post('fakultas_name')
            ];

            $this->FakultasModel->insert($insert_data);
            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data fakultas berhasil ditambahkan.'
            ]);
            redirect('fakultas');
        }
    }

    public function ubah($id)
    {
        $data_lama = $this->FakultasModel->getById($id);
        
        if (!$data_lama) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data fakultas tidak ditemukan.'
            ]);
            redirect('fakultas');
        }

        $data['title'] = 'Ubah Fakultas';
        $data['action'] = base_url('fakultas/ubah/' . $id);
        $data['button'] = 'Update';
        $data['fakultas'] = $data_lama; 

        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $header['title'] = 'Ubah Fakultas';
            $this->load->view('layout/header', $header);
             $this->load->view('fakultas/form', $data);
            $this->load->view('layout/footer');
        } else {
            $update_data = [
                'fakultas_name' => $this->input->post('fakultas_name')
            ];

            $this->FakultasModel->update($id, $update_data);

            $this->session->set_flashdata('swal', [
                'icon'  => 'success',
                'title' => 'Berhasil!',
                'text'  => 'Data fakultas berhasil diperbarui.'
            ]);
            redirect('fakultas');
        }
    }

    public function hapus($id)
    {
        $data_lama = $this->FakultasModel->getById($id);
        
        if (!$data_lama) {
            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data fakultas tidak ditemukan.'
            ]);
            redirect('fakultas');
        }

        $this->FakultasModel->delete($id);

        $this->session->set_flashdata('swal', [
            'icon'  => 'success',
            'title' => 'Berhasil!',
            'text'  => 'Data fakultas berhasil dihapus.'
        ]);
        redirect('fakultas');
    }
}