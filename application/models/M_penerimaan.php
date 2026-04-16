<?php

class M_penerimaan extends CI_Model {
	protected $_table = 'alba_barang_penerimaan';

	public function lihat(){
		return $this->db->get($this->_table)->result(); 
	} 

    
public function lihat_penerimaan() {
    $this->db->select('alba_barang_penerimaan.*', FALSE);
    $this->db->from('alba_barang_penerimaan');
    //$this->db->select('alba_pesanan_barang_hd.*', FALSE); 
   //$this->db->select('alba_permintaan_barang_hd.*', FALSE); 
    $this->db->select('alba_permintaan_barang_dt.*', FALSE); 
    $this->db->select('alba_customer.nama_cst as nama_cst, alba_customer.alamat_cst', FALSE);
    $this->db->from('alba_permintaan_barang_dt');
    //$this->db->join('alba_permintaan_barang_hd', 'alba_permintaan_barang_hd.number_ = alba_permintaan_barang_dt.number_po', 'inner');

    $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_permintaan_barang_dt.kd_cst', 'left');
    //$this->db->order_by('alba_permintaan_barang_hd.transDate', 'ASC');
    $this->db->group_by('alba_barang_penerimaan.no_terima');

    $kondisi = "( ( ( alba_customer.nama_cst = 'Forecast' AND alba_permintaan_barang_dt.status_qr = 'selesai' AND alba_permintaan_barang_dt.quantity > 0 ) ))";
    
    $this->db->where($kondisi); // Tambahkan kondisi ke query

    
    $this->db->order_by('alba_barang_penerimaan.jam_terima', 'DESC');
    $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'DESC');
    $query_result = $this->db->get();
    $result = $query_result->result();
    return $result;
}
        public function lihat_history_penerimaan($tanggal,$dan_tanggal = null) { 
  
        $this->db->where('alba_barang_penerimaan.tgl_terima BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            ');		
        $this->db->select('alba_barang_penerimaan.*', FALSE);
        $this->db->select('alba_barang_detail_terima.*', FALSE);
        $this->db->from('alba_barang_detail_terima');
        $this->db->join('alba_barang_penerimaan', 'alba_barang_penerimaan.no_terima = alba_barang_detail_terima.no_terima', 'left');
        $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function lihat_history_penerimaan_all() { 
     
        $this->db->select('alba_barang_penerimaan.*', FALSE);
        $this->db->select('alba_barang_detail_terima.*', FALSE);
        $this->db->from('alba_barang_detail_terima');
        $this->db->join('alba_barang_penerimaan', 'alba_barang_penerimaan.no_terima = alba_barang_detail_terima.no_terima', 'left');
        $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal = null) { 
  
        $this->db->where('alba_barang_penerimaan.tgl_terima BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            ');   
        $this->db->select('alba_barang_penerimaan.*', FALSE);
        $this->db->select('detail_terima.*', FALSE);
        $this->db->from('detail_terima');
        $this->db->join('alba_barang_penerimaan', 'alba_barang_penerimaan.no_terima = detail_terima.no_terima', 'left');
        $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function get_supplier() { 
        $this->db->select('alba_barang_penerimaan.*', FALSE);
        $this->db->from('alba_barang_penerimaan');
        $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_terima1($no_terima){
		return $this->db->get_where($this->_table, ['no_terima' => $no_terima])->row();
	}
public function lihat_no_terima($id  = null) {
        $this->db->select('alba_barang_penerimaan.*', FALSE);
        $this->db->from('alba_barang_penerimaan');
        $this->db->where('alba_barang_penerimaan.no_terima', $id);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;;
    }
	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_terima){
		return $this->db->delete($this->_table, ['no_terima' => $no_terima]);
	}
}