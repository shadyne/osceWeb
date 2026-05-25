<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function find_by_username($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function find($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function by_role($role)
    {
        return $this->db->order_by('nama_lengkap')
                        ->get_where('users', ['role' => $role, 'is_active' => 1])
                        ->result_array();
    }

    public function create($data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }

    public function username_exists($username, $exclude_id = null)
    {
        $this->db->where('username', $username);
        if ($exclude_id) $this->db->where('id !=', $exclude_id);
        return $this->db->count_all_results('users') > 0;
    }
}
