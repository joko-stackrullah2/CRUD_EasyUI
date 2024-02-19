<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "";
	}
	public function getData()
	{
		$menu ='[{
            "id":10,
            "text":"Home",
            "iconCls":"icon-home",
            "attributes":{
                    "url":"dashboard",
                    "view":"dashboard",
                    "title":"Dashboard"

                    }				    
         },{
            "id":1,
            "text":"SMKN 1 Kepanjen",
            "iconCls":"icon-key",
            "state":"closed",
            "children":[{
                "id":"1",
                "text":"Siswa",
                "checked":false,
                "iconCls":"icon-mini-add",
                "attributes":{
                    "url":"siswa",
                    "view":"v_siswa",
                    "title":"Data Siswa"
                    }
                },{
                "id":"2",
                "text":"Guru",
                "checked":false,
                "iconCls":"icon-mini-add",
                "attributes":{
                    "url":"Gr",
                    "view":"v_guru",
                    "title":"Data Guru"
                    }
                },{
                "id":"3",
                "text":"Mata Pelajaran",
                "checked":false,
                "iconCls":"icon-mini-add",
                "attributes":{
                    "url":"mapel",
                    "view":"v_mapel",
                    "title":"Mata Pelajaran"
                    
                }
                
            }]
         }]';
		echo $menu;	
	}

	public function getContent(){
		//print_r($_POST);
		$url = isset($_POST['url'])?$_POST['url']:"";
		$view = isset($_POST['view'])?$_POST['view']:"";
		$this->load->view($view,null,true);
		//echo $view;
	}

	public function getContentMenu($view='',$title=''){
		// //print_r($_POST);
		// $url = isset($_POST['url'])?$_POST['url']:"";
		// $view = isset($_POST['view'])?$_POST['view']:"";
		$this->load->view($view,$title);
		//echo $view;
	}

}