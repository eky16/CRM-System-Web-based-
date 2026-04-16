<?php

class M_detail_keluar_mf extends CI_Model {
	protected $_table = 'alba_pengeluaran_detail_keluar_mf';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_keluar($no_keluar_mf){
		return $this->db->get_where($this->_table, ['no_keluar_mf' => $no_keluar_mf])->result();
	}
     
	public function hapus($no_keluar_mf){
		return $this->db->delete($this->_table, ['no_keluar_mf' => $no_keluar_mf]);
	}
}

