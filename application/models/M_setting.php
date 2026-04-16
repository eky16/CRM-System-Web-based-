<?php

class M_setting extends CI_Model{
	protected $_table = 'cassa_jmlcuti';
    protected $_table_log = 'cassa_log';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	public function get3(){
		$query = $this->db->get($this->_table_status);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}

	public function lihat_id($id_asset){
		$query = $this->db->get_where($this->_table, ['id_asset' => $id_asset]);
		return $query->row();
	}


	public function tambah($data){
		return $this->db->insert($this->_table_log, $data);
	}


	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function min_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}


	public function hapus($id){
		return $this->db->delete($this->_table, ['tahun' => $id]);
	}
	public function hapus_p($id){
		return $this->db->delete('tbl_pengumuman', ['id_p' => $id]);
	}
    public function hapus_izin($id){
        return $this->db->delete($this->_table, ['kode_izin' => $id]);
    }
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save_cuti($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_jmlcuti WHERE tahun = '{$atdnc_data['tahun']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_jmlcuti', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( tahun ='" . $atdnc_data['tahun'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_jmlcuti', $atdnc_data); 
    }
    }

    public function save_api($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM akses_api WHERE id_api = '{$atdnc_data['id_api']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('akses_api', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_api ='" . $atdnc_data['id_api'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('akses_api', $atdnc_data); 
    }
    }
    public function save_p($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_pengumuman WHERE createdtime_p = '{$atdnc_data['createdtime_p']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_pengumuman', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( createdtime_p ='" . $atdnc_data['createdtime_p'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_pengumuman', $atdnc_data); 
    }
    }
        public function ubah_p($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_pengumuman WHERE id_p = '{$atdnc_data['id_p']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_pengumuman', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_p ='" . $atdnc_data['id_p'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_pengumuman', $atdnc_data); 
    }
    }
    public function jumlah_cuti($id = NULL) { 
        $this->db->select('cassa_jmlcuti.*', FALSE);
        $this->db->from('cassa_jmlcuti');
        $this->db->order_by('cassa_jmlcuti.id','DESC');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function api_show($id = NULL) { 
        $this->db->select('akses_api.*', FALSE);
        $this->db->from('akses_api');
        $this->db->order_by('akses_api.id_api','DESC');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
}