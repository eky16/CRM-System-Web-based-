<?php

class M_log extends CI_Model{
	protected $_table = 'cassa_log';
    protected $_table_log = 'cassa_log';
    protected $_table_leads = 'leads_project';
    protected $_table_i = 'cassa_izin';
    protected $_table_id = 'cassa_transaksi_asset';



	public function get3(){
		$query = $this->db->get($this->_table_status);
		return $query->result();
	}
    public function get_leads(){
        $query = $this->db->get($this->_table_leads);
        return $query->result();
    }
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
        public function lihat($id = NULL) { 
        $this->db->from('cassa_log');
        $this->db->order_by('cassa_log.waktu','DESC');
        $this->db->limit(20);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 

}