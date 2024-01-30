
<?php

class M_siswa extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

     function getAllDataSiswa(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'siswa.nisn';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_siswa']) ? strval($_POST['search_siswa']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('siswa')->num_rows();
        $row = array();


        $kelas = $this->input->post("kelas");
        if($kelas == ""){
            $kelas = "";
        }else{
            $kelas = "AND kelas = '$kelas'";
        };


        // select data from table product
        $query = "SELECT *
        from siswa
        where concat(nama,'',alamat) like '%$search%' $kelas order by $sort $order limit $offset, $rows";
        
        $siswa = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $siswa]);
        return $result;
    }
    
    public function cekSiswa($nisn){
        $hasil = $this->db->query("select * from siswa where nisn=$nisn")->num_rows();

        return $hasil;
    }

    function InsertSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
            'kelamin' => $this->input->post('kelamin'),
        ];

        $ceknisn=$this->cekSiswa($data['nisn']);
        if($ceknisn > 0){
            $response["success"] = "0";
			$response["msg"] = "Data siswa dengan NISN ".$data['nisn']." sudah ada !";
        }else{
            $this->db->insert('siswa',$data);
            $response["success"] = "1";
			$response["msg"] = "Data siswa berhasil ditambahkan";
        }
        return $response;
    }
    function UpdateSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
            'kelamin' => $this->input->post('kelamin'),

            
        ];
        $this->db->where('nisn',$data['nisn']);
        if($data == 0){
            $response["success"] = "0";
			$response["msg"] = "Data gagal di edit!";
        }else{
            $response["success"] = "1";
            $response["msg"] = "Data siswa berhasil di edit";
            $this->db->update('siswa',$data);
        }
        return $response;
       

    }

    function DeleteSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
            'kelamin' => $this->input->post('kelamin'),

        ];
        $this->db->where('nisn',$data['nisn']);
        return $this->db->delete('siswa',$data);
    }

    public function CariSiswa(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $nama = isset($_POST['nama']) ? strval($_POST['nama']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $where = "nama like '$nama%'";
        $query = "select count(*) from siswa where " . $where;
        $row = array();
        $result['total'] = $row[0];
        

        // select data from table product
        $query = "SELECT * FROM siswa where " . $where . " limit $offset,$rows";

        $items = array();
        while($row = ($query)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
         
        echo json_encode($result);
		
}

}