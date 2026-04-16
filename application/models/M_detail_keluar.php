<?php

class M_detail_keluar extends CI_Model {
	protected $_table = 'alba_pengeluaran_detail_keluar';

	public function tambah($data){
		return $this->db->insert_batch('alba_pengeluaran_detail_keluar', $data);
	}

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->result();
	}
    public function count_detail_id($no_keluar = NULL) {
        $this->db->select('detail_keluar.*', FALSE); 
        $this->db->from('detail_keluar');
     //   $this->db->order_by('purchase_order_hd.transDate', 'DESC');
        $this->db->group_by('detail_keluar.no_keluar');
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k
            THEN harga_total_k
            END) AS grand_total');


        $kondisi = "( ( (  detail_keluar.no_keluar ='" . $no_keluar . "' )) )";
        $this->db->where($kondisi);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        } else {
          //  $this->db->where('laporan_proyek.kode_lap', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    }
	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}
}