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
		$username  = $this->session->userdata('username');
		$data = [
			'judul'     => 'Dashboard',
			'user'      => $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE username = '$username' ")->row()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('index');
		$this->load->view('template/_footer');
	}

	/* ======================================= KELOLA USER ======================================= */

	public function data_user()
	{
		$dariDB 				= $this->user_model->cek_nik();
		// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
		$nourut 				= substr($dariDB, 3, 4);
		$kode_nik_sekarang 		= $nourut + 1;

		$data = [
			'judul'		=> 'Data User',
			'nik'		=> $kode_nik_sekarang,
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'data_user'	=> $this->user_model->get()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('user/index');
		$this->load->view('template/_footer');
	}

	public function tambah_user()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim');
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
				'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
				'data_user'	=> $this->user_model->get(),
				'level'		=> $this->user_model->get_level(),
				'divisi'	=> $this->user_model->get_divisi(),
				'jabatan'	=> $this->user_model->get_jabatan(),
			];

			$this->load->view('template/_header', $data);
			$this->load->view('user/tambah_user');
			$this->load->view('template/_footer');
		} else {

			$id_jabatan 		= $this->input->post('id_jabatan');
			$id_divisi 			= $this->input->post('id_divisi');
			$nik 				= $this->input->post('nik');
			$nama_karyawan 		= $this->input->post('nama_karyawan');
			$alamat_karyawan	= $this->input->post('alamat_karyawan');
			$tahun_bergabung 	= $this->input->post('tahun_bergabung');

			$data = [
				'username'      => htmlspecialchars($this->input->post('username', TRUE)),
				'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'id_level'      => $this->input->post('id_level')
			];
			$this->db->insert("user", $data);

			$user_baru = $this->db->query("SELECT * FROM user ORDER BY id_user DESC LIMIT 1")->row();

            $data = [
                'id_user'      			=> $user_baru->id_user,
                'id_jabatan	'   		=> $id_jabatan,
                'id_divisi'      		=> $id_divisi,
                'nik'      				=> $nik,
                'nama_karyawan'      	=> $nama_karyawan,
                'alamat_karyawan'      	=> $alamat_karyawan,
                'foto_karyawan'      	=> 1,
                'tahun_bergabung'      	=> $tahun_bergabung,
            ];
            $this->db->insert('karyawan', $data);
			// pesan dengan flash_data
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data User Berhasil Ditambah</div>');
			redirect('user/data_user');
		}
	}

	public function edit_user($id_user)
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]', [
			'min_length' => 'password terlalu lemah',
		]);
		if ($this->form_validation->run() == false) {
			$data = [
				'judul'		=> 'Data User',
				'data_user'	=> $this->user_model->get($id_user),
				'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
				'level'		=> $this->user_model->get_level()
			];
			$this->load->view('template/_header', $data);
			$this->load->view('user/edit_user');
			$this->load->view('template/_footer');
		} else {
			$id_user 	= htmlspecialchars($this->input->post('id_user', TRUE));
			$username 		= htmlspecialchars($this->input->post('username', TRUE));
			$password 	= $this->input->post('password1');
			$id_level 	= htmlspecialchars($this->input->post('id_level', TRUE));

			$this->db->set('username', $username);
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
	/* ======================================= AKHIR KELOLA USER ======================================= */

	/* ======================================= KELOLA LEVEL ======================================= */

	public function level()
	{
		$data = [
			'judul'		=> 'Level',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
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

	/* ======================================= AKHIR KELOLA LEVEL ======================================= */

	/* ======================================= KELOLA jabatan ======================================= */

	public function jabatan()
	{
		$data = [
			'judul'		=> 'Jabatan',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'jabatan'	=> $this->user_model->get_jabatan()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('user/jabatan');
		$this->load->view('template/_footer');
	}

	public function tambah_jabatan()
	{
		$data = [
			'jabatan'	=> $this->input->post('jabatan')
		];
		$this->db->insert('jabatan', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">jabatan Berhasil ditambah</div>');
		redirect('user/jabatan');
	}

	public function edit_jabatan($id_jabatan)
	{
		$id_jabatan		= $this->input->post('id_jabatan');
		$jabatan			= $this->input->post('jabatan');

		$this->db->set('jabatan', $jabatan);
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">jabatan Berhasil diubah</div>');
		redirect('user/jabatan');
	}

	public function hapus_jabatan($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->delete('jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">jabatan Berhasil Dihapus</div>');
		redirect('user/jabatan');
	}

	/* ======================================= AKHIR KELOLA jabatan ======================================= */


	/* ======================================= KELOLA DIVISI ======================================= */

	public function divisi()
	{
		$data = [
			'judul'		=> 'Divisi',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'divisi'	=> $this->user_model->get_divisi()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('user/divisi');
		$this->load->view('template/_footer');
	}

	public function tambah_divisi()
	{
		$data = [
			'divisi'	=> $this->input->post('divisi')
		];
		$this->db->insert('divisi', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">divisi Berhasil ditambah</div>');
		redirect('user/divisi');
	}

	public function edit_divisi($id_divisi)
	{
		$id_divisi		= $this->input->post('id_divisi');
		$divisi			= $this->input->post('divisi');

		$this->db->set('divisi', $divisi);
		$this->db->where('id_divisi', $id_divisi);
		$this->db->update('divisi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">divisi Berhasil diubah</div>');
		redirect('user/divisi');
	}

	public function hapus_divisi($id_divisi)
	{
		$this->db->where('id_divisi', $id_divisi);
		$this->db->delete('divisi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">divisi Berhasil Dihapus</div>');
		redirect('user/divisi');
	}

	/* ======================================= AKHIR KELOLA DIVISI ======================================= */

	public function edit_profile()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]', [
			'min_length' => 'password terlalu lemah',
		]);
		if ($this->form_validation->run() == false) {
			$data = [
				'judul'		=> 'Edit Profile',
				'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
				'level'		=> $this->user_model->get_level()
			];
			$this->load->view('template/_header', $data);
			$this->load->view('user/edit_profile');
			$this->load->view('template/_footer');
		} else {
			$id_user 	= htmlspecialchars($this->input->post('id_user', TRUE));
			$username 	= htmlspecialchars($this->input->post('username', TRUE));
			$password 	= $this->input->post('password1');

			$this->db->set('username', $username);
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
