<?php
defined('BASEPATH') or die('No direct script access allowed!');

function check_absen_harian()
{
    $CI = &get_instance();
    $id_user = $CI->session->userdata('id_level');
    $absen_user = $CI->absensi_model->absen_harian($id_user)->num_rows();
    if (!is_weekend()) {
        if ($absen_user < 2) {
            $CI->session->set_userdata('absen_warning', 'true');
        } else {
            $CI->session->set_userdata('absen_warning', 'false');
        }
    }
}

function check_jam($jam, $status, $raw = false)
{
    if ($jam) {
        $status = ucfirst($status);
        $CI = &get_instance();
        $jam_kerja = $CI->absensi_model->db->where('keterangan', $status)->get('jam_kerja')->row();

        if ($status == 'Masuk' && $jam > $jam_kerja->selesai) {
            if ($raw) {
                return [
                    'status' => 'telat',
                    'text' => $jam
                ];
            } else {
                return '<span class="badge badge-danger">' . $jam . ' Telat</span>';
            }
        } elseif ($status == 'Pulang' && $jam > $jam_kerja->selesai) {
            if ($raw) {
                return [
                    'status' => 'lembur',
                    'text' => $jam
                ];
            } else {
                return '<span class="badge badge-success">' . $jam . ' Lembur</span>';
            }
        } else {
            if ($raw) {
                return [
                    'status' => 'normal',
                    'text' => $jam
                ];
            } else {
                return '<span class="badge badge-primary">' . $jam . ' Tepat Waktu</span>';
            }
        }
    } else {
        if ($raw) {
            return [
                'status' => 'normal',
                'text' => 'Tidak Hadir'
            ];
        }
        return 'Tidak Hadir';
    }
}

function is_weekend($tgl = false)
{
    $tgl = @$tgl ? $tgl : date('d-m-Y');
    return in_array(date('l', strtotime($tgl)), ['Saturday', 'Sunday']);
}
