<?php

class M_mapel extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->root_directory = $this->config->item('base_path')."/";
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
            'kode' => $this->input->post('kode'),
            'nama_mapel' => $this->input->post('nama_mapel'),

        ];
        $this->db->where('kode',$data['kode']);
        return $this->db->delete('mapel',$data);
    }

    function saveDokumenMapel(){
        // $path_file = $this->input->post("path_file");
        $key_file = $this->input->post("key_file");
        $keterangan_file = $this->input->post("keterangan_file");
        
        if($keterangan_file=="" || $_FILES['path_file']['size'] == 0){
            $result['success'] = false;
            $result['msg'] = "Mohon lengkapi Dokumen";
            return $result;
        }
        
        $target_dir = $this->root_directory."static/upload/mapel/".date('Y')."/".date('m')."/".date('d')."/";
        $relative_path = "static/upload/mapel/".date('Y')."/".date('m')."/".date('d')."/";
        $target_file = $target_dir . basename($_FILES["path_file"]["name"]);
        $file_name = basename($_FILES["path_file"]["name"]);
        $file_size = basename($_FILES["path_file"]["size"]);
        $file_path = $relative_path . basename($_FILES["path_file"]["name"]);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $dataArray = array("key_file"=>$key_file,
                            "tipe_file"=>$file_type,
                            "keterangan_file"=>$keterangan_file,
                            "nama_file"=>$file_name,
                            "path_file"=>$file_path,
                            );
        
        if ($key_file == '') {
            unset($dataArray['key_file']);
        }
        $this->db->insert("dokumen_mapel", $dataArray);
        if($this->db->affected_rows()>0){
            $checkDir = is_dir($target_dir);
            if($checkDir == false)
            {
                mkdir($target_dir, 0777, true);
            }
            move_uploaded_file($_FILES["path_file"]["tmp_name"], $target_file);
            $result['success'] = true;
            $result['msg'] = "Berhasil Menyimpan Data";
            $result['upload_file_id'] = $this->db->insert_id();
            $result['nama_file'] = $dataArray['nama_file'];
            $result['tipe_file'] = $dataArray['tipe_file'];
            $result['path_file'] = $dataArray['path_file'];
        }else{
            $result['success'] = false;
            $result['msg'] = "Gagal Menyimpan Data";
        }
        return $result;
    }

}

