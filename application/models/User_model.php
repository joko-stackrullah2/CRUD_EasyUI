<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk login user
    public function login($nama, $password) {
        // Mencari user berdasarkan username
        $this->db->where('nama_guru', $nama);
        $this->db->where('password', $password);
        $user = $this->db->get('guru')->row();

        // Jika user ditemukan, verifikasi password
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

}