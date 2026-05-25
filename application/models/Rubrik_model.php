<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubrik_model extends CI_Model
{
    /* ---------- Master komponen (template lembar penilaian) ---------- */

    public function komponen()
    {
        return $this->db->order_by('nomor')
                        ->get_where('rubrik_komponen', ['is_active' => 1])
                        ->result_array();
    }

    public function update_komponen($id, $data)
    {
        return $this->db->where('id', $id)->update('rubrik_komponen', $data);
    }

    /* ---------- Penilaian per peserta (rubrik_penilaian flat row) ---------- */

    public function find_penilaian($jp_id)
    {
        return $this->db->get_where('rubrik_penilaian', ['id_jadwal_peserta' => $jp_id])->row_array();
    }

    public function save_penilaian($jp_id, $data)
    {
        $existing = $this->find_penilaian($jp_id);
        if ($existing) {
            $this->db->where('id_rubrik', $existing['id_rubrik'])
                     ->update('rubrik_penilaian', $data);
            return $existing['id_rubrik'];
        }
        $data['id_jadwal_peserta'] = $jp_id;
        $this->db->insert('rubrik_penilaian', $data);
        return $this->db->insert_id();
    }

    /**
     * Nilai akhir 0..100. Asumsi 3 komponen, skor maks 3 -> total maks 9.
     */
    public function compute_nilai_akhir($p)
    {
        $total = ((int) $p['kompetensi1']) + ((int) $p['kompetensi2']) + ((int) $p['kompetensi3']);
        return round(($total / 9) * 100, 2);
    }
}
