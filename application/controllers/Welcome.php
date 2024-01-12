<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
		$this->load->view('welcome_message');
	}

	public function tambah(){
		
		$input = $this->M_siswa->InsertSiswa();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);}
	}

	 
	public function edit(){
		
		$input = $this->M_siswa->UpdateSiswa();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!!!.']);}
}

public function hapus(){
		
	$input = $this->M_siswa->DeleteSiswa();
	if ($input) {
		echo json_encode(['success' => true]);
	}else {
		echo json_encode(['Msg'=>'Some Error occured!.']);}
}

}
	

