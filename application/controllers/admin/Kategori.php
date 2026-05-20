<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    // READ
    public function index()
    {
        $data['kategori'] = $this->Kategori_model->getAll();
        $this->load->view('admin/kategori', $data);
    }

    // CREATE
    public function store()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->Kategori_model->insert($data);
        redirect('admin/kategori');
    }

    // EDIT 
    public function edit($id)
    {
        $data['kategori'] = $this->Kategori_model->getById($id);
        $this->load->view('admin/edit_kategori', $data);
    }

    // UPDATE
    public function update($id)
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->Kategori_model->update($id, $data);
        redirect('admin/kategori');
    }

    // DELETE
    public function delete($id)
{
    // cek apakah kategori dipakai di tabel alat
    $dipakai = $this->Kategori_model->cekDipakaiDiAlat($id);

    if ($dipakai > 0) {
        $this->session->set_flashdata('error', 'Kategori tidak bisa dihapus karena masih digunakan di data alat!');
        redirect('admin/kategori');
        return;
    }

    // kalau tidak dipakai, baru hapus
    $this->Kategori_model->delete($id);

    $this->session->set_flashdata('success', 'Kategori berhasil dihapus');
    redirect('admin/kategori');
}
}