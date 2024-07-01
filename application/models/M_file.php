<?php

class M_file extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

     function getAllDataFile(){

        
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'file.kode';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_mapel']) ? strval($_POST['search_mapel']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('dokumen_mapel')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
        from dokumen_mapel
        where concat(kode_mapel_id,'',nama_file) like '%$search%' order by $sort $order limit $offset, $rows";
        
        $mapel = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $mapel]);
        return $result;
    }

    public function cekFile($kd,$nm){
        $hasil = $this->db->query("SELECT * FROM dokumen_mapel WHERE kode_mapel_id=$kd OR nama_file = '$nm'")->num_rows();

        return $hasil;
    }

    function InsertFile(){
        // Memeriksa data POST
        $kode_mapel_id = $this->input->post('kode_mapel_id');
        $path_file = $this->input->post('path_file');
        $nama_file = $this->input->post('nama_file');
        $keterangan_file = $this->input->post('keterangan_file');
    
        // Debugging: Memastikan data POST tidak kosong
        var_dump($_POST);
    
        // Validasi data tidak boleh kosong
        if(empty($kode_mapel_id) || empty($path_file) || empty($nama_file) || empty($keterangan_file)) {
            echo "Semua kolom harus diisi.";
            return;
        }
    
        // Memasukkan data ke array
        $data = array(
            array(
                'kode_mapel_id' => $kode_mapel_id,
                'path_file' => $path_file,
                'nama_file' => $nama_file,
                'keterangan_file' => $keterangan_file
            ),
           array(
                'kode_mapel_id' => $kode_mapel_id,
                'path_file' => $path_file,
                'nama_file' => $nama_file,
                'keterangan_file' => $keterangan_file
            )
        );
    
        // Memasukkan data ke database
        if ($this->db->insert_batch('dokumen_mapel', $data)) {
            echo "Data berhasil ditambahkan.";
        } else {
            // Menampilkan pesan kesalahan
            $error = $this->db->error();
            echo "Terjadi kesalahan: " . $error['message'];
        }
    }

    function UpdateFile(){
        $data = [
            'kode' => $this->input->post('kode'),
            'nama_mapel' => $this->input->post('nama_file'),

            
        ];
        $data=$this->cekFile($data['kode'],$data['nama_file']);
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

}

