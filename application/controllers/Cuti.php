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
			'data_user' => $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level JOIN karyawan ON karyawan.id_user = user.id_user WHERE user_level.level = 'Pegawai' ")->result()
        ];
		$this->load->view('template/_header', $data);
		$this->load->view('cuti/index');
		$this->load->view('template/_footer');
	}

	public function detail_cuti($id_user = null)
	{
		$user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
		
		if ($id_user != null) {
            $id_user    = @$this->uri->segment(3);
        } else {
            $id_user    = $user->id_user;
        }

		$data = [
			'judul'		=> 'Detail Cuti',
			'user'      => $user,
			'cuti'		=> $this->db->query("SELECT * FROM cuti_user JOIN data_cuti ON cuti_user.id_cuti = data_cuti.id_cuti JOIN user ON user.id_user = cuti_user.id_user JOIN karyawan ON karyawan.id_user = user.id_user WHERE cuti_user.id_user = '$id_user' ORDER BY cuti_user.id_cuti_user DESC ")->result()
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
		$tgl_cuti = strtotime($this->input->post('tgl_cuti'));
		$tgl_selesai_cuti = strtotime($this->input->post('tgl_selesai_cuti'));
		$jumlah_hari = $tgl_selesai_cuti-$tgl_cuti;
		$jumlah_cuti_user = $jumlah_hari / 60 / 60 / 24;

		$user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
		$id_user = $user->id_user;
		$cek_user = $this->db->get_where('data_cuti', ['id_user' => $id_user])->row();

		if(empty($cek_user)) {
			$data = [
				'id_user'		=> $this->input->post('id_user'),
				'jumlah_cuti'	=> 12 - $jumlah_cuti_user
			];
			$cuti = $this->db->insert('data_cuti', $data);
			$id_cuti = $this->db->insert_id();
		} else {
			$jumlah_cuti = $cek_user->jumlah_cuti - $jumlah_cuti_user;
			$this->db->set('jumlah_cuti', $jumlah_cuti);
			$this->db->where('id_user', $id_user);
			$this->db->update('data_cuti');

			$data_cuti = $this->db->get_where('data_cuti',['id_user' => $id_user])->row();
			$id_cuti = $data_cuti->id_cuti;
		}
		
		$data_cuti_user = [
			'id_cuti'               => $id_cuti,
			'id_user'               => $this->input->post('id_user'),
			'tgl_cuti'              => $this->input->post('tgl_cuti'),
			'tgl_selesai_cuti'		=> $this->input->post('tgl_selesai_cuti'),
			'jumlah_cuti_user'		=> $jumlah_cuti_user,
			'alasan_cuti'			=> $this->input->post('alasan_cuti')
		];
		$this->db->insert('cuti_user', $data_cuti_user);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pengajuan berhasil</div>');
        redirect('cuti/detail_cuti');
	}
}