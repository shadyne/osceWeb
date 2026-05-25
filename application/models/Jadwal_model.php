<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    public function all($penguji_id = null)
    {
        $this->db->select('j.*, s.judul AS soal_judul, u.nama_lengkap AS penguji_nama')
                 ->from('jadwal_ujian j')
                 ->join('soal_osce s', 's.id = j.soal_id', 'left')
                 ->join('users u', 'u.id = j.penguji_id', 'left')
                 ->order_by('j.tanggal', 'DESC')
                 ->order_by('j.waktu_mulai', 'DESC');
        if ($penguji_id) $this->db->where('j.penguji_id', $penguji_id);
        return $this->db->get()->result_array();
    }

    public function find($id)
    {
        return $this->db->select('j.*, s.judul AS soal_judul, s.dokumen_kasus, s.lampiran')
                        ->from('jadwal_ujian j')
                        ->join('soal_osce s', 's.id = j.soal_id', 'left')
                        ->where('j.id', $id)->get()->row_array();
    }

    public function create($data)
    {
        $this->db->insert('jadwal_ujian', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('jadwal_ujian', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('jadwal_ujian', ['id' => $id]);
    }

    /* ---- Peserta assignment ---- */

    public function assign_peserta($jadwal_id, array $peserta_ids)
    {
        foreach ($peserta_ids as $pid) {
            $sql = "INSERT IGNORE INTO jadwal_peserta (jadwal_id, peserta_id) VALUES (?, ?)";
            $this->db->query($sql, [$jadwal_id, (int) $pid]);
        }
    }

    public function peserta_of($jadwal_id)
    {
        return $this->db->select('jp.*, u.nama_lengkap, u.identitas, u.username')
                        ->from('jadwal_peserta jp')
                        ->join('users u', 'u.id = jp.peserta_id')
                        ->where('jp.jadwal_id', $jadwal_id)
                        ->order_by('u.nama_lengkap')
                        ->get()->result_array();
    }

    public function jadwal_for_peserta($peserta_id)
    {
        return $this->db->select('j.*, s.judul AS soal_judul, jp.id AS jp_id, jp.status AS jp_status, jp.waktu_submit')
                        ->from('jadwal_peserta jp')
                        ->join('jadwal_ujian j', 'j.id = jp.jadwal_id')
                        ->join('soal_osce s', 's.id = j.soal_id', 'left')
                        ->where('jp.peserta_id', $peserta_id)
                        ->order_by('j.tanggal', 'DESC')
                        ->get()->result_array();
    }

    public function find_peserta_session($jp_id, $peserta_id = null)
    {
        $this->db->select('jp.*, j.nama_sesi, j.tanggal, j.waktu_mulai, j.waktu_selesai, j.durasi_menit, j.status AS jadwal_status, j.penguji_id,
                           s.judul AS soal_judul, s.dokumen_kasus, s.lampiran, s.kunci_kode')
                 ->from('jadwal_peserta jp')
                 ->join('jadwal_ujian j', 'j.id = jp.jadwal_id')
                 ->join('soal_osce s', 's.id = j.soal_id', 'left')
                 ->where('jp.id', $jp_id);
        if ($peserta_id) $this->db->where('jp.peserta_id', $peserta_id);
        return $this->db->get()->row_array();
    }

    public function start_session($jp_id)
    {
        $this->db->where('id', $jp_id)
                 ->where('status', 'belum')
                 ->update('jadwal_peserta', [
                     'status'      => 'mengerjakan',
                     'waktu_mulai' => date('Y-m-d H:i:s'),
                 ]);
    }

    public function finish_session($jp_id)
    {
        $this->db->where('id', $jp_id)->update('jadwal_peserta', [
            'status'       => 'selesai',
            'waktu_submit' => date('Y-m-d H:i:s'),
        ]);
    }
}
