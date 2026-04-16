<?php

class M_customer extends CI_Model{
	protected $_table = 'leads_project';
	protected $_table_log = 'cassa_log';
	protected $_table1 = 'cassa_status_project'; 
	protected $_table_issueDT = 'tbl_issue_sub'; 


public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }

    public function lihat_segment(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('segments');
        $this->db->order_by('segment', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function lihat_lead(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('source_leads');
        $this->db->order_by('source', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function lihat_wilayah(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('cities');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

	public function lihat_status_project(){
		$query = $this->db->get($this->_table1);
		return $query->result();
	}

	public function lihat() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_customer.*', FALSE);
        $this->db->from('alba_customer');
        $kondisi = "( (  (alba_customer.status_cst='" . "aktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_customer.nama_cst','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function lihat_nonaktif() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_customer.*', FALSE);
        $this->db->from('alba_customer');
        $kondisi = "( (  (alba_customer.status_cst='" . "nonaktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_customer.nama_cst','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	public function lihat_id($id_cst){
		$query = $this->db->get_where('alba_customer', ['id_cst' => $id_cst]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id_cst){
		return $this->db->delete('alba_customer', ['id_cst' => $id_cst]);
	}

	public function kode_customer(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_cst,4)) AS kode_cst FROM alba_customer WHERE DATE(creattime_cst)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_cst)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "CST".date('dmy').$kd;  
	}

	public function save_customer($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_customer WHERE id_cst = '{$atdnc_data['id_cst']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_customer', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_cst ='" . $atdnc_data['id_cst'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_customer', $atdnc_data); 
    }
}
    public function save_customer_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_customer WHERE kode_cst = '{$atdnc_data['kode_cst']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_customer', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_cst ='" . $atdnc_data['kode_cst'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_customer', $atdnc_data); 
    }
}
}