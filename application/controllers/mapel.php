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

	public function index($edit="0", $mapel_id=""){
		$data['edit']=$edit;
		$data['detailMapel']=$this->modul->getDetailMapel($mapel_id);
		$this->load->view('v_mapel',$data);
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

	function saveDokumenMapel(){
		$hasil = $this->M_mapel->saveDokumenMapel();
		echo json_encode($hasil);
	}
}