<?php

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		belum_login();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()

	{
		$nik  = $this->session->userdata('nik');
		$data = [
			'judul'     => 'Dashboard',
			'user'      => $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE nik = '$nik' ")->row()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('index');
		$this->load->view('template/_footer');
	}

	public function data_user()
	{
		$dariDB 				= $this->user_model->cek_nik();
		// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
		$nourut 				= substr($dariDB, 3, 4);
		$kode_nik_sekarang 		= $nourut + 1;

		$data = [
			'judul'		=> 'Data User',
			'nik'		=> $kode_nik_sekarang,
			'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
			'data_user'	=> $this->user_model->get()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('user/index');
		$this->load->view('template/_footer');
	}

	public function tambah_user()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('id_level', 'Level', 'required');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'min_length' => 'password terlalu lemah',
			'matches'    => 'password tidak sama'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$dariDB 				= $this->user_model->cek_nik();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			$nourut 				= substr($dariDB, 3, 4);
			$kode_nik_sekarang 		= $nourut + 1;

			$data = [
				'judul'		=> 'Data User',
				'nik'		=> $kode_nik_sekarang,
				'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
				'data_user'	=> $this->user_model->get(),
				'level'		=> $this->user_model->get_level()
			];

			$this->load->view('template/_header', $data);
			$this->load->view('user/tambah_user');
			$this->load->view('template/_footer');
		} else {
			$data = [
				'nama'          => htmlspecialchars($this->input->post('nama', TRUE)),
				'nik'          	=> htmlspecialchars($this->input->post('nik', TRUE)),
				'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'id_level'      => $this->input->post('id_level')
			];
			$this->db->insert("user", $data);
			// pesan dengan flash_data
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data User Berhasil Ditambah</div>');
			redirect('user/data_user');
		}
	}

	public function edit_user($id_user)
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]', [
			'min_length' => 'password terlalu lemah',
		]);
		if ($this->form_validation->run() == false) {
			$data = [
				'judul'		=> 'Data User',
				'data_user'	=> $this->user_model->get($id_user),
				'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
				'level'		=> $this->user_model->get_level()
			];
			$this->load->view('template/_header', $data);
			$this->load->view('user/edit_user');
			$this->load->view('template/_footer');
		} else {
			$id_user 	= htmlspecialchars($this->input->post('id_user', TRUE));
			$nama 		= htmlspecialchars($this->input->post('nama', TRUE));
			$nik 		= htmlspecialchars($this->input->post('nik', TRUE));
			$password 	= $this->input->post('password1');
			$id_level 	= htmlspecialchars($this->input->post('id_level', TRUE));

			$this->db->set('nama', $nama);
			$this->db->set('nik', $nik);
			$this->db->set('id_level', $id_level);
			if (!empty($password)) {
				$this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
			}
			$this->db->where('id_user', $id_user);
			$this->db->update('user');

			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat data user berhasil diubah</div>');
			redirect('user/data_user');
		}
	}

	public function hapus_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('user');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data User Berhasil Dihapus</div>');
		redirect('user/data_user');
	}

	public function level()
	{
		$data = [
			'judul'		=> 'Level',
			'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
			'level'		=> $this->user_model->get_level()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('user/level');
		$this->load->view('template/_footer');
	}

	public function tambah_level()
	{
		$data = [
			'level'			=> $this->input->post('level')
		];
		$this->db->insert('user_level', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Level Berhasil ditambah</div>');
		redirect('user/level');
	}

	public function edit_level($id_level)
	{
		$id_level		= $this->input->post('id_level');
		$level			= $this->input->post('level');

		$this->db->set('level', $level);
		$this->db->where('id_level', $id_level);
		$this->db->update('user_level');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Level Berhasil diubah</div>');
		redirect('user/level');
	}

	public function hapus_level($id_level)
	{
		$this->db->where('id_level', $id_level);
		$this->db->delete('user_level');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Level Berhasil Dihapus</div>');
		redirect('user/level');
	}

	public function edit_profile()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]', [
			'min_length' => 'password terlalu lemah',
		]);
		if ($this->form_validation->run() == false) {
			$data = [
				'judul'		=> 'Edit Profile',
				'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
				'level'		=> $this->user_model->get_level()
			];
			$this->load->view('template/_header', $data);
			$this->load->view('user/edit_profile');
			$this->load->view('template/_footer');
		} else {
			$id_user 	= htmlspecialchars($this->input->post('id_user', TRUE));
			$nama 		= htmlspecialchars($this->input->post('nama', TRUE));
			$nik 		= htmlspecialchars($this->input->post('nik', TRUE));
			$password 	= $this->input->post('password1');

			$this->db->set('nama', $nama);
			$this->db->set('nik', $nik);
			if (!empty($password)) {
				$this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
			}
			$this->db->where('id_user', $id_user);
			$this->db->update('user');

			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat data user berhasil diubah</div>');
			redirect('user/edit_profile');
		}
	}
}
