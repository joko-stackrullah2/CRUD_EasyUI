<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {


    public function __construct(){
		parent ::__construct();
		$this->load->model('M_guru');
	
	}
    public function getAllDataGuru()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->M_gr->getAllDataGuru();
		echo json_encode($employee);
	}
	public function index(){
		$this->load->view('v_guru');
	}

}
