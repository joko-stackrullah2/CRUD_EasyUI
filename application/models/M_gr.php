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
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'guru.id_guru';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_guru']) ? strval($_POST['search_guru']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('guru')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from guru 
        where concat(nama_guru,'',alamat_guru)  like '%$search%' order by $sort $order limit $offset, $rows";
        
        $guru = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $guru]);
        return $result;
    }

    public function cekGuru($idguru){
        $hasil = $this->db->query("select * from guru where id_guru=$idguru")->num_rows();

        return $hasil;
    }

     function InsertGuru(){
        $data = [
            'id_guru' => $this->input->post('id_guru'),
            'nama_guru' => $this->input->post('nama_guru'),
            'alamat_guru' => $this->input->post('alamat_guru'),
            'telp_guru' => $this->input->post('telp_guru'),
            'id_mapel' => $this->input->post('id_mapel'),
            'jk_guru' => $this->input->post('jk_guru'),
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
}