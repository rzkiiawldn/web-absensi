<?php

class Pengaturan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		belum_login();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function menu()
	{
		$data = [
			'judul'		=> 'Menu',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'menu'		=> $this->db->get('user_menu')->result()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('pengaturan/menu');
		$this->load->view('template/_footer');
	}

	public function tambah_menu()
	{
		$is_active = $this->input->post('is_active');
		if (!empty($is_active)) {
			$is_active = 1;
		} else {
			$is_active = 0;
		}

		$data = [
			'menu'			=> $this->input->post('menu'),
			'is_active'		=> $is_active,
			'urutan_menu'	=> $this->input->post('urutan_menu'),
		];
		$this->db->insert('user_menu', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu Baru Berhasil Ditambah</div>');
		redirect('pengaturan/menu');
	}

	public function edit_menu($id_menu)
	{
		$id_menu		= $this->input->post('id_menu');
		$menu			= $this->input->post('menu');
		$urutan_menu	= $this->input->post('urutan_menu');

		$is_active = $this->input->post('is_active');
		if (!empty($is_active)) {
			$is_active = 1;
		} else {
			$is_active = 0;
		}

		$this->db->set('menu', $menu);
		$this->db->set('urutan_menu', $urutan_menu);
		$this->db->set('is_active', $is_active);
		$this->db->where('id_menu', $id_menu);
		$this->db->update('user_menu');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu Berhasil Diubah</div>');
		redirect('pengaturan/menu');
	}

	public function hapus_menu($id_menu)
	{
		$this->db->where('id_menu', $id_menu);
		$this->db->delete('user_menu');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu Berhasil Dihapus</div>');
		redirect('pengaturan/menu');
	}

	public function submenu()
	{
		$data = [
			'judul'		=> 'Submenu',
			'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'submenu'	=> $this->db->query('SELECT um.id_menu, um.menu, usm.id_sub, usm.submenu, usm.id_menu, usm.url, usm.icon, usm.is_active, usm.urutan_sub FROM user_menu um JOIN user_sub_menu usm ON um.id_menu = usm.id_menu ORDER BY um.menu ASC ')->result(),
			'menu'		=> $this->db->get('user_menu')->result(),
		];
		$this->load->view('template/_header', $data);
		$this->load->view('pengaturan/submenu');
		$this->load->view('template/_footer');
	}

	public function tambah_submenu()
	{
		$is_active = $this->input->post('is_active');
		if (!empty($is_active)) {
			$is_active = 1;
		} else {
			$is_active = 0;
		}

		$data = [
			'id_menu'		=> $this->input->post('id_menu'),
			'submenu'		=> $this->input->post('submenu'),
			'url'			=> $this->input->post('url'),
			'icon'			=> $this->input->post('icon'),
			'url'			=> $this->input->post('url'),
			'is_active'		=> $is_active,
			'urutan_sub'	=> $this->input->post('urutan_sub'),
		];
		$this->db->insert('user_sub_menu', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu Berhasil Ditambah</div>');
		redirect('pengaturan/submenu');
	}

	public function edit_submenu($id_sub)
	{
		$id_sub		= $this->input->post('id_sub');
		$id_menu	= $this->input->post('id_menu');
		$submenu	= $this->input->post('submenu');
		$url		= $this->input->post('url');
		$icon		= $this->input->post('icon');
		$urutan_sub	= $this->input->post('urutan_sub');

		$is_active = $this->input->post('is_active');
		if (!empty($is_active)) {
			$is_active = 1;
		} else {
			$is_active = 0;
		}

		$this->db->set('id_menu', $id_menu);
		$this->db->set('submenu', $submenu);
		$this->db->set('url', $url);
		$this->db->set('icon', $icon);
		$this->db->set('is_active', $is_active);
		$this->db->set('urutan_sub', $urutan_sub);
		$this->db->where('id_sub', $id_sub);
		$this->db->update('user_sub_menu');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu Berhasil Diubah</div>');
		redirect('pengaturan/submenu');
	}

	public function hapus_submenu($id_sub)
	{
		$this->db->where('id_sub', $id_sub);
		$this->db->delete('user_sub_menu');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu Berhasil Dihapus</div>');
		redirect('pengaturan/submenu');
	}

	public function hak_akses()
	{
		$data = [
			'judul'			=> 'Hak Akses',
			'user'      	=> $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'level'			=> $this->db->get('user_level')->result()
		];
		$this->load->view('template/_header', $data);
		$this->load->view('pengaturan/hak_akses');
		$this->load->view('template/_footer');
	}

	public function hak_akses_menu($id_level)
	{
		$data = [
			'judul'			=> 'Hak Akses Menu',
			'user'      	=> $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
			'level'			=> $this->db->get_where('user_level', ['id_level' => $id_level])->row(),
			'submenu'		=> $this->db->query('SELECT um.id_menu, um.menu, usm.id_sub, usm.submenu, usm.id_menu FROM user_menu um JOIN user_sub_menu usm ON um.id_menu = usm.id_menu ORDER BY um.menu ASC')->result(),
		];
		$this->load->view('template/_header', $data);
		$this->load->view('pengaturan/hak_akses_menu');
		$this->load->view('template/_footer');
	}

	public function ubah_akses_menu()
	{
		$id_menu    = $this->input->post('menuId');
		$id_sub    	= $this->input->post('submenuId');
		$id_level   = $this->input->post('levelId');

		$data = [
			'id_level'  => $id_level,
			'id_menu'   => $id_menu,
			'id_sub'   	=> $id_sub
		];

		$result = $this->db->get_where('user_akses_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_akses_menu', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Hak akses berhasil ditambah</div>');
		} else {
			$this->db->delete('user_akses_menu', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Hak akses berhasil dihapus</div>');
		}
	}
}
