<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");
header("Content-Type: application/json; charset=utf-8");

class apiregis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function regis() {

        // Mengambil input
        $data = array(
            'nama_guru' => $this->input->post('nama_guru'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Enkripsi password
        );

        // Memanggil model untuk menyimpan data pengguna baru
        $inserted = $this->User_model->regis($data);

        if ($inserted) {
            // Jika registrasi sukses
            $response = array(
                'status' => true,
                'message' => 'Registrasi berhasil',
                'data' => array(
                    'id_guru' => $inserted, // ID pengguna baru yang dikembalikan dari model
                    'nama_guru' => $data['nama_guru'],
                    'no_hp' => $data['no_hp'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'password' => $data['password']

                )
            );
        } else {
            // Jika registrasi gagal
            $response = array(
                'status' => false,
                'message' => 'Terjadi kesalahan saat registrasi'
            );
        }

        // Mengirimkan respon JSON
        echo json_encode($response);
    }
}
