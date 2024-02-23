<?php

class M_gr extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

     function getAllDataGuru(){

        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'a.id_guru';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_guru']) ? strval($_POST['search_guru']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('guru')->num_rows();
        $row = array();


        $mapel = $this->input->post("nama_mapel");
        if($mapel == ""){
            $mapel = "";
        }else{
            $mapel = "AND nama_mapel = '$mapel'";
        };

        $kelamin = $this->input->post("jk_guru");
        if($kelamin == ""){
            $kelamin = "";
        }else{
            $kelamin = "AND jk_guru = '$kelamin'";
        };

        // select data from table product
        $query = "SELECT a.*, b.nama_mapel
        FROM guru a
        LEFT JOIN mapel b
        ON a.id_mapel = b.id_mapel
        where concat(a.nama_guru,'',a.alamat_guru)  like '%$search%' $mapel $kelamin order by $sort $order limit $offset, $rows";
        
        $guru = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $guru]);
        return $result;

    }

    public function cekGuru(){
        $query = "SELECT a.*, b.nama_mapel
        FROM guru a
        LEFT JOIN mapel b
        ON a.id_mapel = b.id_mapel->num_rows()";

        return $query;
        
    }

     function InsertGuru(){
        $data = [
            'id_guru' => $this->input->post('id_guru'),
            'nama_guru' => $this->input->post('nama_guru'),
            'alamat_guru' => $this->input->post('alamat_guru'),
            'telp_guru' => $this->input->post('telp_guru'),
            'jk_guru' => $this->input->post('jk_guru'),
            'id_mapel' => $this->input->post('id_mapel'),
        ];

        $cekid=$this->cekGuru($data['id_guru']);
        if($cekid > 0){
            $response["success"] = "0";
			$response["msg"] = "Data guru dengan ID ".$data['id_guru']." sudah ada !";
        }else{
            $this->db->insert('guru',$data);
            $response["success"] = "1";
			$response["msg"] = "Data guru berhasil ditambahkan";
        }
        return $response;
    }

     function UpdateGuru(){
        $data = [
            'id_guru' => $this->input->post('id_guru'),
            'nama_guru' => $this->input->post('nama_guru'),
            'alamat_guru' => $this->input->post('alamat_guru'),
            'telp_guru' => $this->input->post('telp_guru'),
            'jk_guru' => $this->input->post('jk_guru'),
            'id_mapel' => $this->input->post('id_mapel'),

            
        ];
        $this->db->where('id_guru',$data['id_guru']);
        if($data == 0){
            $response["success"] = "0";
			$response["msg"] = "Data gagal di edit!";
        }else{
            $response["success"] = "1";
            $response["msg"] = "Data guru berhasil di edit";
            $this->db->update('guru',$data);
        }
        return $response;
       

    }

    function DeleteGuru(){
        $data = [
            'id_guru' => $this->input->post('id_guru'),
            'nama_guru' => $this->input->post('nama_guru'),
            'alamat_guru' => $this->input->post('alamat_guru'),
            'telp_guru' => $this->input->post('telp_guru'),
            'jk_guru' => $this->input->post('jk_guru'),
            'id_mapel' => $this->input->post('id_mapel'),

        ];
        $this->db->where('id_guru',$data['id_guru']);
        return $this->db->delete('guru',$data);
    }
}