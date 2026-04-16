<?php

class M_sop extends CI_Model{
	protected $_table = 'tbl_sop';

    public function save_sop($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_sop WHERE createdtime_sop = '{$atdnc_data['createdtime_sop']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_sop', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( createdtime_sop ='" . $atdnc_data['createdtime_sop'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_sop', $atdnc_data); 
    }
    }
    public function ubah_sop($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_sop WHERE id_sop = '{$atdnc_data['id_sop']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_sop', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_sop ='" . $atdnc_data['id_sop'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_sop', $atdnc_data); 
    }
    }
        public function get_sop_edit($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('tbl_sop');
        $this->db->where('tbl_sop.id_sop', $id);
            if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_sop.id_sop', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function hapus_sop($id){
        return $this->db->delete('tbl_sop', ['id_sop' => $id]);
    }
    public function lihat_semua(){
        $query = $this->db->get_where($this->_table, 'status_sop = 1');
        return $query->result();
    }
    
    public function lihat_01($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP1" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_02($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP2" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_03($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP3" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_04($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP4" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_05($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP5" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_06($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP6" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    //Calendar SOP
    public function lihat_07($id = NULL) { 
        $this->db->from('tbl_sop');
        $kondisi = "( (  (tbl_sop.jenis_sop='" . "SOP7" . "' ) AND (tbl_sop.status_sop='" . 1 . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}