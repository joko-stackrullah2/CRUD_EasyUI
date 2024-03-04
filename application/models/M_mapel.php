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
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'mapel.id_mapel';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_mapel']) ? strval($_POST['search_mapel']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('mapel')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from mapel
        where concat(id_mapel,'',nama_mapel)  like '%$search%' order by $sort $order limit $offset, $rows";
        
        $mapel = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $mapel]);
        return $result;
    }

    public function cekMapel($idmapel){
        $hasil = $this->db->query("select * from mapel where id_mapel=$idmapel")->num_rows();

        return $hasil;
    }

    function InsertMapel(){
        $data = [
            'id_mapel' => $this->input->post('id_mapel'),
            'nama_mapel' => $this->input->post('nama_mapel'),

        ];

        $cekidmapel=$this->cekMapel($data['id_mapel']);
        if($cekidmapel > 0){
            $response["success"] = "0";
			$response["msg"] = "Data mapel dengan ID MAPEL ".$data['id_mapel']." sudah ada !";
        }else{
            $this->db->insert('mapel',$data);
            $response["success"] = "1";
			$response["msg"] = "Data mapel berhasil ditambahkan";
        }
        return $response;
    }

    function UpdateMapel(){
        $data = [
            'id_mapel' => $this->input->post('id_mapel'),
            'nama_mapel' => $this->input->post('nama_mapel'),

            
        ];
        $this->db->where('id_mapel',$data['id_mapel']);
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
        $this->db->where('id_mapel',$data['id_mapel']);
        return $this->db->delete('mapel',$data);
    }

}

