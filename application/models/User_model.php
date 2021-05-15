<?php

class User_model extends CI_Model
{

	public function get($id_user = null)
	{
		$id_login = $this->session->userdata('id_user');
		if ($id_user != null) {
			return $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE id_user = '$id_user'")->row();
		}
		return $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE id_user != 1 AND id_user != $id_login ORDER BY id_user DESC")->result();
	}

	public function get_level($id_user = null)
	{
		if ($id_user != null) {
			return $this->db->query('SELECT * FROM user_level WHERE id_user = $id_user')->row();
		}
		return $this->db->query('SELECT * FROM user_level')->result();
	}

	public function find($id_user)
	{
		$this->db->join('user_level', 'user.id_level = user_level.id_level', 'LEFT');
		$this->db->where('id_user', $id_user);
		$result = $this->db->get('user');
		return $result->row();
	}

	// kode nik bertambah otomatis
	public function cek_nik()
	{
		$query = $this->db->query("SELECT MAX(nik) as nik from user");
		$hasil = $query->row();
		return $hasil->nik;
	}
}
