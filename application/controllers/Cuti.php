<?php

class Cuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		belum_login();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data = [
			'judul'		=> 'Data Cuti',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'cuti'		=> $this->db->query('SELECT * FROM cuti_user JOIN data_cuti ON cuti_user.id_cuti = data_cuti.id_cuti JOIN user ON user.id_user = cuti_user.id_user JOIN karyawan ON karyawan.id_user = user.id_user')->result()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('cuti/index');
		$this->load->view('template/_footer');
	}

	public function detail_cuti()
	{
		$data = [
			'judul'		=> 'Detail Cuti',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'cuti'		=> $this->db->get('data_cuti')->result()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('cuti/detail_cuti');
		$this->load->view('template/_footer');
	}

	public function pengajuan()
	{
		$data = [
			'judul'		=> 'Pengajuan Cuti',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'cuti'		=> $this->db->get('data_cuti')->result()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('cuti/pengajuan_cuti');
		$this->load->view('template/_footer');
	}

	public function ajukan()
	{
		$data = [
			'id_user'		=> $this->input->post('id_user'),
			'jumlah_cuti'	=> 0
		];
		$cuti = $this->db->insert('data_cuti', $data);
		$id_cuti = $this->db->insert_id();
		$data_cuti_user = [
			'id_cuti'               => $id_cuti,
			'id_user'               => $this->input->post('id_user'),
			'tgl_cuti'              => $this->input->post('tgl_cuti'),
			'tgl_selesai_cuti'		=> $this->input->post('tgl_selesai_cuti'),
			'jumlah_cuti_user'		=> 0,
			'alasan_cuti'			=> $this->input->post('alasan_cuti')
		];
		$this->db->insert('cuti_user', $data_cuti_user);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pengajuan berhasil</div>');
        redirect('cuti');
	}
}