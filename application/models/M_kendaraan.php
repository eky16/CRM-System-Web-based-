<?php

class M_kendaraan extends CI_Model{
	protected $_table = 'leads_project';
	protected $_table_log = 'cassa_log';
	protected $_table1 = 'cassa_status_project'; 
	protected $_table_issueDT = 'tbl_issue_sub'; 


public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }

	public function lihat_status_project(){
		$query = $this->db->get($this->_table1);
		return $query->result();
	}

	public function lihat() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_kendaraan.*', FALSE);
        $this->db->from('alba_kendaraan');
        $kondisi = "( (  (alba_kendaraan.status_kendaraan='" . "aktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_kendaraan.nama_kendaraan','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function lihat_nonaktif() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_kendaraan.*', FALSE);
        $this->db->from('alba_kendaraan');
        $kondisi = "( (  (alba_kendaraan.status_kendaraan='" . "nonaktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_kendaraan.nama_kendaraan','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	public function lihat_id($id_kendaraan){
		$query = $this->db->get_where('alba_kendaraan', ['id_kendaraan' => $id_kendaraan]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id_kendaraan){
		return $this->db->delete('alba_kendaraan', ['id_kendaraan' => $id_kendaraan]);
	}
    
    public function get_kendaraan_aktif() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_kendaraan.*', FALSE);
        $this->db->from('alba_kendaraan');
        $this->db->order_by('alba_kendaraan.nama_kendaraan','ASC');
        $kondisi = "( (  (alba_kendaraan.status_kendaraan ='" . "aktif" . "') ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	
	public function save_kendaraan($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_kendaraan WHERE id_kendaraan  = '{$atdnc_data['id_kendaraan']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_kendaraan', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_kendaraan ='" . $atdnc_data['id_kendaraan'] . "')) )";
         $this->db->where($kondisi);
        $this->db->update('alba_kendaraan', $atdnc_data); 
    }
}
    public function  save_kendaraan_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_kendaraan WHERE nomor_kendaraan = '{$atdnc_data['nomor_kendaraan']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_kendaraan', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( nomor_kendaraan ='" . $atdnc_data['nomor_kendaraan'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_kendaraan', $atdnc_data); 
    }
}
}