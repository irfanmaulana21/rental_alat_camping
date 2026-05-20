<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function login()
    {
        $this->output->set_content_type('application/json');
        error_reporting(0);

        // LOGIN ADMIN
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['username' => $username])->row();

        if ($admin && password_verify($password, $admin->password)) {

            $this->session->set_userdata([
                'user_id' => $admin->id,
                'username' => $admin->username,
                'role' => 'admin',
                'login' => TRUE
            ]);

            echo json_encode([
                'status' => true,
                'role' => 'admin',
                'message' => 'Login berhasil'
            ]);
            exit;
        }

        // LOGIN PELANGGAN 
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $email])->row();

        if ($pelanggan && password_verify($password, $pelanggan->password)) {

            $this->session->set_userdata([
                'user_id' => $pelanggan->id_pelanggan,
                'username' => $pelanggan->nama,
                'role' => 'pelanggan',
                'login' => TRUE
            ]);

            echo json_encode([
                'status' => true,
                'role' => 'pelanggan',
                'message' => 'Login berhasil'
            ]);
            exit;
        }

        // jika gagal semua
        echo json_encode([
            'status' => false,
            'message' => 'Username/email atau password salah'
        ]);
        exit;
    }

    // REGISTER PELANGGAN
    public function register()
    {
        $this->output->set_content_type('application/json');

        $nama     = $this->input->post('nama');
        $alamat   = $this->input->post('alamat');
        $no_hp    = $this->input->post('no_hp');
        $email    = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!$nama || !$username || !$password) {
            echo json_encode([
                'status' => false,
                'message' => 'Nama, username, dan password wajib diisi'
            ]);
            return;
        }

        // cek username
        $cek = $this->db->get_where('pelanggan', ['username' => $username])->row();
        if ($cek) {
            echo json_encode([
                'status' => false,
                'message' => 'Username sudah digunakan'
            ]);
            return;
        }

        // cek email
        if ($email) {
            $cekEmail = $this->db->get_where('pelanggan', ['email' => $email])->row();
            if ($cekEmail) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Email sudah digunakan'
                ]);
                return;
            }
        }

        // insert
        $data = [
            'nama'     => $nama,
            'alamat'   => $alamat,
            'no_hp'    => $no_hp,
            'email'    => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->insert('pelanggan', $data);

        echo json_encode([
            'status' => true,
            'message' => 'Register berhasil, silakan login'
        ]);
    }

    public function logout()
    {
        $this->output
             ->set_content_type('application/json');

        $this->session->sess_destroy();

        echo json_encode([
            'status'=>true,
            'message'=>'Logout berhasil'
        ]);
    }
}