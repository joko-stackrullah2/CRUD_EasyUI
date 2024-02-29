<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model('M_mapel');
	
	}

	public function getAllDataMapel()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_mapel->getAllDataMapel();
		echo json_encode($employee);
	}

	public function index(){
		$this->load->view('v_mapel');
	}

	public function tambah(){
		$input = $this->M_mapel->InsertMapel();
		echo json_encode($input);
	}

	 
	public function edit(){
		
		$input = $this->M_mapel->UpdateMapel();
		echo json_encode($input);
}

public function hapus(){
		
	$input = $this->M_mapel->DeleteMapel();
	if ($input) {
		echo json_encode(['success' => true]);
	}else {
		echo json_encode(['Msg'=>'Some Error occured!.']);}
}
}