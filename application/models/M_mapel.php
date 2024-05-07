<?php

class M_mapel extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

     function getAllDataMapel(){

        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'mapel.kode';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_mapel']) ? strval($_POST['search_mapel']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('mapel')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from mapel
        where concat(kode,'',nama_mapel) like '%$search%' order by $sort $order limit $offset, $rows";
        
        $mapel = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $mapel]);
        return $result;
    }

    public function cekMapel($kd,$nm){
        $hasil = $this->db->query("SELECT * FROM mapel WHERE kode=$kd OR nama_mapel = '$nm'")->num_rows();

        return $hasil;
    }

    function InsertMapel(){
        $data = [
            'kode' => $this->input->post('kode'),
            'nama_mapel' => $this->input->post('nama_mapel'),
        ];

        $cekidmapel=$this->cekMapel($data['kode'],$data['nama_mapel']);
        if($cekidmapel > 0){
            $response["success"] = "0";
			$response["msg"] = "Data mapel dengan NAMA MAPEL ".$data['nama_mapel']." sudah ada !";
        }else{
            $this->db->insert('mapel',$data);
            $response["success"] = "1";
			$response["msg"] = "Data mapel berhasil ditambahkan";
        }
        return $response;
    }

    function UpdateMapel(){
        $data = [
            'kode' => $this->input->post('kode'),
            'nama_mapel' => $this->input->post('nama_mapel'),

            
        ];
        $data=$this->cekMapel($data['kode'],$data['nama_mapel']);
        $this->db->where('kode',$data['kode']);
        if($data == 0){
            $response["success"] = "0";
			$response["msg"] = "Data gagal di edit!";
        }else{
            $response["success"] = "1";
            $response["msg"] = "Data mapel berhasil di edit";
            $this->db->update('mapel',$data);
        }
        return $response;
       

    }

    function DeleteMapel(){
        $data = [
            'id_mapel' => $this->input->post('id_mapel'),
            'nama_mapel' => $this->input->post('nama_mapel'),

        ];
        $this->db->where('kode',$data['kode']);
        return $this->db->delete('mapel',$data);
    }

}

