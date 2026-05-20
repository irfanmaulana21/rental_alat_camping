<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function cekLogin($username)
    {
        return $this->db->get_where('admin', [
            'username' => $username
        ])->row();
    }
}