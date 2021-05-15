<?php

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row();
        $data = [
            'judul'     => 'Absen Harian',
            'now'       => date('H:i:s'),
            'absen'     => $this->absensi_model->absensi_harian($user->id_user)->num_rows(),
            'jam_masuk' => $this->db->get_where('jam_kerja', ['keterangan' => 'Masuk'])->row(),
            'jam_pulang'=> $this->db->get_where('jam_kerja', ['keterangan' => 'Pulang'])->row(),
            'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/absen');
        $this->load->view('template/_footer');
    }

    public function detail_absensi($id_user = null)
    {
        $user           = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row();

        if ($id_user != null) {
            $id_user    = @$this->uri->segment(3);
        } else {
            $id_user    = $user->id_user;
        }

        $bulan      = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun      = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data = [
            'judul'     => 'Detail Absensi',
            'user'      => $user,
            'data_user' => $this->user_model->find($id_user),
            'absen'     => $this->absensi_model->get_absen($id_user, $bulan, $tahun),
            'jam_kerja' => (array) $this->absensi_model->get_jam(),
            'all_bulan' => bulan(),
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'hari'      => hari_bulan($bulan, $tahun),

        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/detail_absensi');
        $this->load->view('template/_footer');
    }

    public function data_absensi()
    {
        $data = [
            'judul'     => 'Data Absensi',
            'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
            'data_user' => $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level WHERE user_level.level = 'Karyawan' ")->result()
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/data_absensi');
        $this->load->view('template/_footer');
    }

    public function status()
    {
        $user   = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row();
        if (@$this->uri->segment(3)) {
            $keterangan = ucfirst($this->uri->segment(3));
        } else {
            $absen_harian = $this->absensi_model->absen_harian($user->id_user)->num_rows();
            $keterangan = ($absen_harian < 2 && $absen_harian < 1) ? 'Masuk' : 'Pulang';
        }

        $data = [
            'tanggal'       => date('Y-m-d'),
            'waktu'         => date('H:i:s'),
            'keterangan'    => $keterangan,
            'id_user'       => $user->id_user
        ];
        $result = $this->db->insert('absen', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil absen</div>');
        redirect('absensi/detail_absensi');
    }

    public function jam_kerja()
    {
        $data = [
            'judul'     => 'Jam Kerja',
            'user'      => $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row(),
            'jam_kerja' => $this->db->get('jam_kerja')->result()
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/jam_kerja');
        $this->load->view('template/_footer');
    }
    public function edit_jam_kerja($id_jam)
    {
        $id_jam         = $this->input->post('id_jam');
        $mulai          = $this->input->post('mulai');
        $selesai        = $this->input->post('selesai');
        $keterangan     = $this->input->post('keterangan');

        $this->db->set('mulai', $mulai);
        $this->db->set('selesai', $selesai);
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id_jam', $id_jam);
        $this->db->update('jam_kerja');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jam kerja berhasil di ubah</div>');
        redirect('absensi/jam_kerja');
    }

    public function cetak_data_absensi($id_user)
    {
        $this->load->library('dompdf_gen');

        $user           = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row();

        $bulan      = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun      = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data = [
            'judul'     => 'Detail Absensi',
            'user'      => $user,
            'data_user' => $this->user_model->find($id_user),
            'absen'     => $this->absensi_model->get_absen($id_user, $bulan, $tahun),
            'jam_kerja' => (array) $this->absensi_model->get_jam(),
            'all_bulan' => bulan(),
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'hari'      => hari_bulan($bulan, $tahun),

        ];


        $filename = 'Absensi ' . $data['data_user']->nama . ' - ' . bulan($data['bulan']) . ' ' . $data['tahun'] . '.pdf';

        $this->load->view('absensi/print_data', $data);

        $paper_size     = 'A4';
        $orientation    = 'potrait';
        $html           = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($filename, ['Attachment' => 0]);
    }
}
