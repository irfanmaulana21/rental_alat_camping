<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
        echo password_hash('1234', PASSWORD_DEFAULT);
    }

}