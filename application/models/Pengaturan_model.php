<?php

class Pengaturan_model extends CI_Model
{
    // MENGAMBIL DATA / READ (JIKA ID KOSONG MAKA TAMPILKAN SEMUA DATA, TETAPI JIKA ID TIDAK KOSONG MAKA AMBIL DATA BERDASARKAN ID)
    public function get($id = null)
    {
        if ($id != null) {
            return $this->db->get_where('table', ['id' => $id]);
        }
        return $this->db->get('table');
    }

    // TAMBAH DATA
    public function add($data)
    {
        $this->db->insert('table', $data);
    }

    // EDIT DATA
    public function edit()
    {
        $this->db->update('table');
    }

    // HAPUS DATA
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('table');
    }
}
