<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model
{
    public function all($penguji_id = null)
    {
        if ($penguji_id) $this->db->where('penguji_id', $penguji_id);
        return $this->db->order_by('created_at', 'DESC')->get('soal_osce')->result_array();
    }

    public function find($id)
    {
        return $this->db->get_where('soal_osce', ['id' => $id])->row_array();
    }

    public function create($data)
    {
        $this->db->insert('soal_osce', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('soal_osce', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('soal_osce', ['id' => $id]);
    }
}
