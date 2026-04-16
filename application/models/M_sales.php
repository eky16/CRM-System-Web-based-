<?php

class M_sales extends CI_Model{
	protected $_table = 'alba_sales';
	protected $_table_log = 'cassa_log';
	protected $_table1 = 'cassa_status_project'; 
	protected $_table_issueDT = 'tbl_issue_sub'; 


	public function lihat() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_sales.*', FALSE);
        $this->db->from('alba_sales');
        $kondisi = "( (  (alba_sales.status_sales='" . "aktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_sales.nama_sales','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_nonaktif() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_sales.*', FALSE);
        $this->db->from('alba_sales');
        $kondisi = "( (  (alba_sales.status_sales='" . "nonaktif" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('alba_sales.nama_sales','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	public function lihat_id($id_sales){
		$query = $this->db->get_where('alba_sales', ['id_sales' => $id_sales]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id_sales){
		return $this->db->delete('alba_sales', ['id_sales' => $id_sales]);
	}

	public function kode_sales(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_sales,4)) AS kode_sales FROM alba_sales WHERE DATE(creattime_cst)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_sales)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "CST".date('dmy').$kd;  
	}

	public function save_sales($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_sales WHERE id_sales = '{$atdnc_data['id_sales']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_sales', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_sales ='" . $atdnc_data['id_sales'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_sales', $atdnc_data); 
    }
}
    public function save_sales_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_sales WHERE kode_sales = '{$atdnc_data['kode_sales']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_sales', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_sales ='" . $atdnc_data['kode_sales'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_sales', $atdnc_data); 
    }
}
}