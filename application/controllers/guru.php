<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {


    public function __construct(){
		parent ::__construct();
		$this->load->model('M_gr');
	
	}
    public function getAllDataGuru()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_gr->getAllDataGuru();
		echo json_encode($employee);
	}
	public function index(){
		$data['dataGuru'] = $this->M_gr->getAllDataGuru();
        $this->load->view('v_guru', $data);
	}

	public function tambah(){
		$input = $this->M_gr->InsertGuru();
		echo json_encode($input);
	}

	public function hapus(){
		
		$input = $this->M_gr->DeleteGuru();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);}
	}

}
