<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function login() {
        // Mengatur validasi input
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('katasandi', 'Kata sandi', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $response = array(
                'status' => false,
                'message' => validation_errors()
            );
            echo json_encode($response);
            return;
        }

        // Mengambil input
        $nama = $this->input->post('nama');
        $katasandi = $this->input->post('katasandi');

        // Memanggil model untuk verifikasi user
        $user = $this->User_model->login($nama, $katasandi);

        if ($user) {
            // Jika login sukses
            $response = array(
                'status' => true,
                'message' => 'Login berhasil',
                'data' => array(
                    'id' => $user->id,
                    'nama' => $user->nama
                )
            );
        } else {
            // Jika login gagal
            $response = array(
                'status' => false,
                'message' => 'Nama atau Kata sandi salah'
            );
        }

        // Mengirimkan respon JSON
        echo json_encode($response);
    }
}