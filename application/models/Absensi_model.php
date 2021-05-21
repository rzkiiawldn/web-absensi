<?php

class Absensi_model extends CI_Model
{
    public function get_absen($id_user, $bulan, $tahun)
    {
        $this->db->select("DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tgl, a.absen_masuk AS jam_masuk, (SELECT absen_masuk FROM absen al JOIN absen_detail ad ON al.id_absen = ad.absen_id WHERE al.tanggal = a.tanggal AND id_user = '$id_user' AND ad.keterangan_masuk != ad.keterangan_masuk) AS jam_pulang");
        $this->db->where('id_user', $id_user);
        $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tanggal, '%Y') = ", $tahun);
        $this->db->group_by("tanggal");
        $result = $this->db->get('absen a');
        return $result->result_array();
    }

    public function absensi_harian($id_user)
    {
        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
        $this->db->where('id_user', $id_user);
        $data = $this->db->get('absen');
        return $data;
    }

    public function get_jam()
    {
        return $this->db->get('jam_kerja')->result();
    }


    public function get_jam_by_time($time)
    {
        $this->db->where('mulai', $time, '<=');
        $this->db->or_where('selesai', $time, '>=');
        $data = $this->db->get('jam_kerja');
        return $data->row();
    }

    public function today($id_user)
    {
        $today = date('Y-m-d');
        return $this->db->query("SELECT * FROM absen WHERE tanggal = '$today' AND id_user = '$id_user'")->row_array();
    }
}
