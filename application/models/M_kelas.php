<?php

class M_gr extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

     function getAllDataKelas(){

        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kelas.id_kelas';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_kelas']) ? strval($_POST['search_kelas']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('kelas')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from kelas 
        where concat(id_kelas,'',nama_kelas)  like '%$search%' order by $sort $order limit $offset, $rows";
        
        $kelas = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $kelas]);
        return $result;
    }

    public function cekKelas($idkelas){
        $hasil = $this->db->query("select * from kelas where id_kelas=$idkelas")->num_rows();

        return $hasil;
    }

     function InsertKelas(){
        $data = [
            'id_kelas' => $this->input->post('id_kelas'),
            'nama_kelas' => $this->input->post('nama_kelas'),
            
        ];

        $cekid=$this->cekKelas($data['id_kelas']);
        if($cekid > 0){
            $response["success"] = "0";
			$response["msg"] = "Data kelas dengan ID ".$data['id_kelas']." sudah ada !";
        }else{
            $this->db->insert('kelas',$data);
            $response["success"] = "1";
			$response["msg"] = "Data kelas berhasil ditambahkan";
        }
        return $response;
    }
}