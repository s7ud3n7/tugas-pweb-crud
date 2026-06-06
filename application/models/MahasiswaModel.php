<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {
    public function getAll()
	{
        return $this->db->get('mahasiswa')->result_array();
	}

	public function getById($id)
	{
		return $this->db->get_where('mahasiswa', ['	MAHASISWA_ID' => $id])->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('mahasiswa', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('	MAHASISWA_ID', $id);
		return $this->db->update('mahasiswa', $data);
	}

	public function delete($id)
	{
		$this->db->where('	MAHASISWA_ID', $id);
		return $this->db->delete('mahasiswa');
	}

    public function checkAccount($data)
    {
        $this->db->where('	MAHASISWA_EMAIL', $data['email']);
        $this->db->where('	MAHASISWA_PASSWORD',($data['password']));
        $account = $this->db->get('mahasiswa', 1)->row_array();

        if ($account) {
            $this->session->set_userdata('user', $account);
            return true;
        }
        else {
            return false;
        }
    }
}