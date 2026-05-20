<?php

class Alat_model extends CI_Model
{
    private $table = 'alat';
    // GET ALL DATA 
    public function getAll()
    {
        return $this->db
            ->select('alat.*, kategori.nama_kategori')
            ->from($this->table)
            ->join('kategori', 'kategori.id_kategori = alat.id_kategori')
            ->get()
            ->result();
    }

// COUNT KATEGORI
public function countKategori()
{
    return $this->db->count_all('kategori');
}

// COUNT ALAT TERSEDIA
public function countTersedia()
{
    return $this->db
        ->where('status', 'tersedia')
        ->count_all_results($this->table);
}
    // GET BY ID
    public function getById($id)
    {
        return $this->db
            ->get_where($this->table, ['id_alat' => $id])
            ->row();
    }

    // FILTER BY KATEGORI
    public function getByKategori($id_kategori)
    {
        return $this->db
            ->select('alat.*, kategori.nama_kategori')
            ->from($this->table)
            ->join('kategori', 'kategori.id_kategori = alat.id_kategori')
            ->where('alat.id_kategori', $id_kategori)
            ->get()
            ->result();
    }

    // PAGINATION / LIMIT
    public function getLimit($limit, $offset)
    {
        return $this->db
            ->select('alat.*, kategori.nama_kategori')
            ->from($this->table)
            ->join('kategori', 'kategori.id_kategori = alat.id_kategori')
            ->limit($limit, $offset)
            ->get()
            ->result();
    }

    // COUNT DATA ALAT
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }

    // GET ALL KATEGORI
    public function getKategori()
    {
        return $this->db->get('kategori')->result();
    }

    // INSERT DATA
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // UPDATE DATA
    public function update($id, $data)
    {
        return $this->db
            ->where('id_alat', $id)
            ->update($this->table, $data);
    }

    // DELETE DATA
    public function delete($id)
    {
        return $this->db
            ->where('id_alat', $id)
            ->delete($this->table);
    }
}