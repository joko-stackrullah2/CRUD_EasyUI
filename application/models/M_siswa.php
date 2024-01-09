
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
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'customers.customerNumber';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_customer']) ? strval($_POST['search_customer']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('siswa')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT * FROM siswa";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
    }

    function InsertSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
            
        ];
        $this->db->insert('siswa',$data);
        return $this->db->insert_id();
    }
    function UpdateSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
            
        ];
        $this->db->where('nisn',$data['nisn']);
        return $this->db->update('siswa',$data);
    }

    function DeleteSiswa(){
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'kelas' => $this->input->post('kelas'),
        ];
        $this->db->where('nisn',$data['nisn']);
        return $this->db->delete('siswa',$data);
    }

}