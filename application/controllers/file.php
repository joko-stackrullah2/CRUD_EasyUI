<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('M_file');
	
	}

	public function getAllDataFile()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_file->getAllDataFile();
		echo json_encode($employee);
	}

	public function index(){
		$this->load->view('v_mapel');
	}

	public function tambah(){
		$input = $this->M_file->InsertFile();
		echo json_encode($input);
	}

	 
	public function edit(){
		
		$input = $this->M_file->UpdateFile();
		echo json_encode($input);
}

public function hapus(){
		
	$input = $this->M_file->DeleteFile();
	if ($input) {
		echo json_encode(['success' => true]);
	}else {
		echo json_encode(['Msg'=>'Some Error occured!.']);}
}
}