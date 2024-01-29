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
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'guru.nip';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_guru']) ? strval($_POST['search_guru']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('guru')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from guru
        where concat(nama,'',alamat)  like '%$search%' order by $sort $order limit $offset, $rows";
        
        $guru = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $guru]);
        return $result;
    }

    public function cekGuru($nip){
        $hasil = $this->db->query("select * from guru where nip=$nip")->num_rows();

        return $hasil;
    }

     function InsertGuru(){
        $data = [
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'mapel' => $this->input->post('mapel'),
            'kelamin' => $this->input->post('kelamin'),
        ];

        $ceknip=$this->cekGuru($data['nip']);
        if($ceknip > 0){
            $response["success"] = "0";
			$response["msg"] = "Data guru dengan NIP ".$data['nip']." sudah ada !";
        }else{
            $this->db->insert('guru',$data);
            $response["success"] = "1";
			$response["msg"] = "Data guru berhasil ditambahkan";
        }
        return $response;
    }
}