<?php

class M_detail_terima_mf extends CI_Model {
	protected $_table = 'alba_barang_detail_terima_mf';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_terima($no_terima_mf){
		return $this->db->get_where($this->_table, ['no_terima_mf' => $no_terima_mf])->result();
	}

	public function hapus($no_terima_mf){
		return $this->db->delete($this->_table, ['no_terima_mf' => $no_terima_mf]);
	}
}