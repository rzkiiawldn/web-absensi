<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {

        if ($this->session->userdata('nik')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nik', 'Nik', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']  = 'Halaman Login';
            $this->load->view('auth/login', $data);
        } else {
            // validasi login berhasil
            $this->_login();
        }
    }

    public function _login()
    {
        $nik        = $this->input->post('nik');
        $password   = $this->input->post('password');
        $user       = $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE nik = '$nik' OR nama = '$nik' OR user_level.level = '$nik' ")->row_array();
        if ($user) {
            // jika nik benar, di cek passwordnya
            if (password_verify($password, $user['password'])) {
                // jika password benar siapkan data
                $data = [
                    'id_user'    => $user['id_user'],
                    'nik'        => $user['nik'],
                    'id_level'   => $user['id_level']
                ];
                // kemudian simpan data kedalam session
                $this->session->set_userdata($data);
                redirect('user');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password yang anda masukan salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">NIK tidak terdaftar</div>');
            redirect('auth');
        }
    }

    public function blocked()
    {
        $data['judul']  = 'Akses dilarang';
        $this->load->view('auth/blocked');
    }

    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('id_level');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil keluar</div>');
        redirect('auth');
    }
}
