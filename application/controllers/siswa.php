<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('M_siswa');
	
	}

	public function getAllDataSiswa()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_siswa->getAllDataSiswa();
		echo json_encode($employee);
	}

	public function index(){
		$this->load->view('v_siswa');
	}
	
	public function tambah(){
		$input = $this->M_siswa->InsertSiswa();
		echo json_encode($input);
	}

	 
	public function edit(){
		
		$input = $this->M_siswa->UpdateSiswa();
		echo json_encode($input);
}

public function hapus(){
		
	$input = $this->M_siswa->DeleteSiswa();
	if ($input) {
		echo json_encode(['success' => true]);
	}else {
		echo json_encode(['Msg'=>'Some Error occured!.']);}
}


}
	

