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

	
	public function tambah(){
		$input = $this->M_kelas->Insertkelas();
		echo json_encode($input);
	}

	 
	public function edit(){
		
		$input = $this->M_kelas->Updatekelas();
		echo json_encode($input);
}

public function hapus(){
		
	$input = $this->M_kelas->Deletekelas();
	if ($input) {
		echo json_encode(['success' => true]);
	}else {
		echo json_encode(['Msg'=>'Some Error occured!.']);}
}
}