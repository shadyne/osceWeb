<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban_model extends CI_Model
{
    public function find_by_jp($jp_id)
    {
        return $this->db->get_where('jawaban_peserta', ['jadwal_peserta_id' => $jp_id])->row_array();
    }

    public function save($jp_id, $kode, $catatan = null)
    {
        $existing = $this->find_by_jp($jp_id);
        $data = [
            'jadwal_peserta_id' => $jp_id,
            'kode_diagnosa'     => $kode,
            'catatan_peserta'   => $catatan,
            'submitted_at'      => date('Y-m-d H:i:s'),
        ];
        if ($existing) {
            $this->db->where('id', $existing['id'])->update('jawaban_peserta', $data);
            return $existing['id'];
        }
        $this->db->insert('jawaban_peserta', $data);
        return $this->db->insert_id();
    }
}
