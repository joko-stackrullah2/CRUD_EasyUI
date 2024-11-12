<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk login user
    public function login($nama, $katasandi) {
        // Mencari user berdasarkan username
        $this->db->where('nama', $katasandi);
        $user = $this->db->get('guru')->row();

        // Jika user ditemukan, verifikasi password
        if ($user && password_verify($katasandi, $user->katasandi)) {
            return $user;
        } else {
            return false;
        }
    }
}