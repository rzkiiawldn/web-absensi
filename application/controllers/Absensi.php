<?php

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
        date_default_timezone_set('Asia/Jakarta');
    }

    // public function index()
    // {
    //     $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
    //     $data = [
    //         'judul'     => 'Absen Harian',
    //         'absen'     => $this->absensi_model->absensi_harian($user->id_user)->num_rows(),
    //         'jam_masuk' => $this->db->get_where('jam_kerja', ['keterangan' => 'Masuk'])->row(),
    //         'jam_pulang'=> $this->db->get_where('jam_kerja', ['keterangan' => 'Pulang'])->row(),
    //         'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
    //     ];
    //     $this->load->view('template/_header', $data);
    //     $this->load->view('absensi/absen');
    //     $this->load->view('template/_footer');
    // }

    public function index()
    {
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        $id_user = $user->id_user;

        $today = $this->absensi_model->today($id_user);
        if (empty($today)) {
            $act = 'Masuk';
            $id_absen = 0;
        }else {
            $act = 'Pulang';
            $id_absen = $today['id_absen'];
        }

        $data = [
            'judul'     => 'Absen Harian',
            'id_absen'  => $id_absen,
            'today'     => $today,
            'act'       => $act,
            'absen'     => $this->absensi_model->absensi_harian($user->id_user)->num_rows(),
            'jadwal'    => $this->db->get('jadwal_kerja')->result(),
            'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/absen');
        $this->load->view('template/_footer');
    }

    public function detail_absensi($id_user = null)
    {
        $user           = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();

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
            'absen_detail' => $this->db->query("SELECT * FROM absen_detail JOIN absen ON absen_detail.absen_id = absen.id_absen WHERE absen.id_user = '$user->id_user' ORDER BY absen.id_absen DESC")->result(),
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

    public function detail($id_absen)
    {
        $data = [
            'judul'     => 'Detail',
            'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'absen_detail' => $this->db->query("SELECT * FROM absen_detail JOIN absen ON absen_detail.absen_id = absen.id_absen JOIN user ON absen.id_user AND user.id_user JOIN karyawan ON karyawan.id_user = user.id_user WHERE absen_detail.absen_id = '$id_absen'")->row()

        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/detail');
        $this->load->view('template/_footer');
    }

    public function data_absensi()
    {
        $data = [
            'judul'     => 'Data Absensi',
            'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'data_user' => $this->db->query("SELECT * FROM user JOIN user_level ON user.id_level = user_level.id_level JOIN karyawan ON karyawan.id_user = user.id_user  WHERE user_level.level = 'Pegawai' ")->result()
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/data_absensi');
        $this->load->view('template/_footer');
    }

    public function izin()
    {
        $user   = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        $user->id_user;

        $keterangan = $this->input->post('keterangan');

        $data = [
            'tanggal'           => date('Y-m-d'),
            'absen_masuk'       => null,
            'absen_pulang'      => null,
            'status'            => 'izin',
            'keterangan'        => $keterangan,
            'id_user'           => $user->id_user
        ];
        $insert = $this->db->insert('absen', $data);

        $absen_id = $this->db->insert_id();
            $data_detail = [
                'absen_id'                        => $absen_id,
                'keterangan_masuk'                => null,
                'keterangan_pulang'               => null,
                'latitude_masuk'                  => null,
                'latitude_pulang'                 => null,
                'longitude_masuk'                 => null,
                'longitude_pulang'                => null,
                'keterangan_jadwal'               => null,
                'foto_masuk'                      => null,
                'foto_pulang'                     => null,
            ];
            $this->db->insert('absen_detail', $data_detail);


        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil absen</div>');
        redirect('absensi');
    }
    public function status()
    {
        $user   = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        $act    = $this->input->post('act');
        $long   = $this->input->post('long');
        $lat    = $this->input->post('lat');
        $foto   = $this->input->post('foto');
        $keterangan_jadwal   = $this->input->post('keterangan_jadwal');

        if ($this->input->post('act')=='Masuk') {
            $data = [
                'tanggal'           => date('Y-m-d'),
                'absen_masuk'       => date('H:i:s'),
                'absen_pulang'      => null,
                'status'            => null,
                'keterangan'        => null,
                'id_user'           => $user->id_user
            ];
            $insert = $this->db->insert('absen', $data);
            $absen_id = $this->db->insert_id();
            $data_detail = [
                'absen_id'                        => $absen_id,
                'keterangan_masuk'                => $act,
                'keterangan_pulang'               => null,
                'latitude_masuk'                  => $lat,
                'latitude_pulang'                 => null,
                'longitude_masuk'                 => $long,
                'longitude_pulang'                => null,
                'keterangan_jadwal'               => $keterangan_jadwal,
                'foto_masuk'                      => $foto,
                'foto_pulang'                     => null,
            ];
            $this->db->insert('absen_detail', $data_detail);
        }else{
            $this->db->set('absen_pulang', date('H:i:s'));
            $this->db->where('id_absen', $this->input->post('id_absen'));
            $this->db->update('absen');
            $absen_id = $this->input->post('id_absen');

            $this->db->set('keterangan_pulang', $act);
            $this->db->set('latitude_pulang', $lat);
            $this->db->set('longitude_pulang', $long);
            $this->db->set('foto_pulang', $foto);
            $this->db->where('absen_id', $this->input->post('id_absen'));
            $this->db->update('absen_detail');
        }

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil absen</div>');
        redirect('absensi');
    }


    public function jam_kerja()
    {
        $data = [
            'judul'     => 'Jam Kerja',
            'user'      => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'jam_kerja' => $this->db->query('SELECT * FROM jam_kerja JOIN jadwal_kerja ON jam_kerja.jadwal_kerja = jadwal_kerja.id_jadwal')->result(),
        ];
        $this->load->view('template/_header', $data);
        $this->load->view('absensi/jam_kerja');
        $this->load->view('template/_footer');
    }
    public function tambah_jam_kerja()
    {
        $data = [
            'id_jam'        => $this->input->post('id_jam'),
            'masuk'         => $this->input->post('masuk'),
            'pulang'       => $this->input->post('pulang'),
            'jadwal_kerja'    => $this->input->post('jadwal_kerja'),
        ];

        $this->db->insert('jam_kerja', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jam kerja berhasil di tambah</div>');
        redirect('absensi/jam_kerja');
    }

    public function edit_jam_kerja($id_jam)
    {
        $id_jam         = $this->input->post('id_jam');
        $masuk          = $this->input->post('masuk');
        $pulang        = $this->input->post('pulang');
        $jadwal_kerja     = $this->input->post('jadwal_kerja');

        $this->db->set('masuk', $masuk);
        $this->db->set('pulang', $pulang);
        $this->db->set('jadwal_kerja', $jadwal_kerja);
        $this->db->where('id_jam', $id_jam);
        $this->db->update('jam_kerja');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jam kerja berhasil di ubah</div>');
        redirect('absensi/jam_kerja');
    }

    public function cetak_data_absensi($id_user)
    {
        $this->load->library('dompdf_gen');

        $user      = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();

        $bulan      = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun      = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data = [
            'judul'     => 'Detail Absensi',
            'user'      => $user,
            'data_user' => $this->user_model->find($id_user),
            'absen_detail' => $this->db->query("SELECT * FROM absen_detail JOIN absen ON absen_detail.absen_id = absen.id_absen WHERE absen.id_user = '$user->id_user'")->result(),
            'absen'     => $this->absensi_model->get_absen($id_user, $bulan, $tahun),
            'jam_kerja' => (array) $this->absensi_model->get_jam(),
            'all_bulan' => bulan(),
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'hari'      => hari_bulan($bulan, $tahun),

        ];

        $filename = 'Absensi ' . $user->username . ' - ' . bulan($data['bulan']) . ' ' . $data['tahun'] . '.pdf';

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
