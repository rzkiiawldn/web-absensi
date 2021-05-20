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

	public function get_level($id_level = null)
	{
		if ($id_level != null) {
			return $this->db->query('SELECT * FROM user_level WHERE id_level = $id_level')->row();
		}
		return $this->db->query('SELECT * FROM user_level')->result();
	}

	public function get_divisi($id_divisi = null)
	{
		if ($id_divisi != null) {  
			return $this->db->query('SELECT * FROM divisi WHERE id_divisi = $id_divisi')->row();
		}
		return $this->db->query('SELECT * FROM divisi')->result();
	}

	public function get_jabatan($id_jabatan = null)
	{
		if ($id_jabatan != null) {
			return $this->db->query('SELECT * FROM jabatan WHERE id_jabatan = $id_jabatan')->row();
		}
		return $this->db->query('SELECT * FROM jabatan')->result();
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
		$query = $this->db->query("SELECT MAX(id_user) as id_user from user");
		$hasil = $query->row();
		return $hasil->id_user;
	}
}
