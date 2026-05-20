<?php

class Kategori_model extends CI_Model
{
    private $table = 'kategori';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_kategori' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->update($this->table, $data);
    }

    public function cekDipakaiDiAlat($id_kategori)
{
    return $this->db->where('id_kategori', $id_kategori)
                    ->count_all_results('alat');
}

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_kategori' => $id]);
    }
}