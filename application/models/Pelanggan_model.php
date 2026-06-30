<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    public function getAll()
    {
        return $this->db
                    ->order_by('id_pelanggan', 'DESC')
                    ->get('pelanggan')
                    ->result();
    }

    public function delete($id)
    {
        return $this->db
                    ->where('id_pelanggan', $id)
                    ->delete('pelanggan');
    }

    public function getById($id)
    {
        return $this->db
                    ->where('id_pelanggan', $id)
                    ->get('pelanggan')
                    ->row();
    }
}