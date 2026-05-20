<?php

class Alat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_model');
        $this->load->library('form_validation');
    }

    // LIST
    public function index()
    {
        $data['alat'] = $this->Alat_model->getAll();
        $data['kategori'] = $this->Alat_model->getKategori();

        $this->load->view('admin/alat', $data);
    }

    // CREATE
    public function store()
    {
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required');
        $this->form_validation->set_rules('harga_sewa', 'Harga', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if (empty($_FILES['gambar']['name'])) {
            $this->form_validation->set_rules('gambar', 'Gambar', 'required');
        }

        if ($this->form_validation->run() == FALSE) {

            $data['alat'] = $this->Alat_model->getAll();
            $data['kategori'] = $this->Alat_model->getKategori();
            $this->load->view('admin/alat', $data);

        } else {

            $config['upload_path']   = './assets/image/alat/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            $gambar = '';

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }

            $data = [
                'id_kategori' => $this->input->post('id_kategori'),
                'nama_alat'   => $this->input->post('nama_alat'),
                'merk'        => $this->input->post('merk'),
                'stok'        => $this->input->post('stok'),
                'harga_sewa'  => $this->input->post('harga_sewa'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'gambar'      => $gambar,
                'status'      => 'tersedia'
            ];

            $this->Alat_model->insert($data);

            redirect('admin/alat');
        }
    }

    // EDIT
    public function edit($id)
    {
        $data['alat'] = $this->Alat_model->getById($id);
        $data['kategori'] = $this->Alat_model->getKategori();

        $this->load->view('admin/edit_alat', $data);
    }

    // UPDATE
    public function update($id)
    {
        $data = [
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_alat'   => $this->input->post('nama_alat'),
            'merk'        => $this->input->post('merk'),
            'stok'        => $this->input->post('stok'),
            'harga_sewa'  => $this->input->post('harga_sewa'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'status' => $this->input->post('status')
            
        ];

        if (!empty($_FILES['gambar']['name'])) {

            $config['upload_path']   = './assets/image/alat/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {

                $upload = $this->upload->data();
                $data['gambar'] = $upload['file_name'];
            }
        }

        $this->Alat_model->update($id, $data);

        redirect('admin/alat');
    }

    public function filter($id_kategori)
{
    $this->load->model('Alat_model');

    $data['alat'] = $this->Alat_model->getByKategori($id_kategori);
    $data['kategori'] = $this->Alat_model->getKategori();

    $this->load->view('pelanggan/alat', $data);
}

    //PINJAM ALAT
    public function pinjam($id)
    {
        $this->Alat_model->setDipinjam($id);
        redirect('admin/alat');
    }
    
    //KEMBALIKAN ALAT
  
    public function kembali($id)
    {
        $this->Alat_model->setTersedia($id);
        redirect('admin/alat');
    }

    // DELETE
    public function delete($id)
    {
        $this->Alat_model->delete($id);
        redirect('admin/alat');
    }
}