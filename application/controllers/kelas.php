<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('M_kelas');
	
	}

	public function getAllDataKelas()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_kelas->getAllDataKelas();
		echo json_encode($employee);
	}

	public function index(){
		$this->load->view('v_kelas');
	}
}