<?php

class M_kelas extends CI_Model
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

        $cekidkelas=$this->cekKelas($data['id_kelas']);
        if($cekidkelas > 0){
            $response["success"] = "0";
			$response["msg"] = "Data kelas dengan ID KELAS ".$data['id_kelas']." sudah ada !";
        }else{
            $this->db->insert('kelas',$data);
            $response["success"] = "1";
			$response["msg"] = "Data kelas berhasil ditambahkan";
        }
        return $response;
    }
    function UpdateKelas(){
        $data = [
            'id_kelas' => $this->input->post('id_kelas'),
            'nama_kelas' => $this->input->post('nama_kelas'),

            
        ];
        $this->db->where('id_kelas',$data['id_kelas']);
        if($data == 0){
            $response["success"] = "0";
			$response["msg"] = "Data gagal di edit!";
        }else{
            $response["success"] = "1";
            $response["msg"] = "Data kelas berhasil di edit";
            $this->db->update('kelas',$data);
        }
        return $response;
       

    }

    function DeleteKelas(){
        $data = [
            'id_kelas' => $this->input->post('id_kelas'),
            'nama_kelas' => $this->input->post('nama_kelas'),

        ];
        $this->db->where('id_kelas',$data['id_kelas']);
        return $this->db->delete('kelas',$data);
    }

    public function CariKelas(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $nama = isset($_POST['nama']) ? strval($_POST['nama']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $where = "nama like '$nama%'";
        $query = "select count(*) from kelas where " . $where;
        $row = array();
        $result['total'] = $row[0];
        

        // select data from table product
        $query = "SELECT * FROM kelas where " . $where . " limit $offset,$rows";

        $items = array();
        while($row = ($query)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
         
        echo json_encode($result);
		
}
}