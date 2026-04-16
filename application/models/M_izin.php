<?php

class M_izin extends CI_Model{
	protected $_table = 'cassa_kategori_izin';
    protected $_table_log = 'cassa_log';
    protected $_table_leads = 'leads_project';
   


	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
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
    public function kode_kategori(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_kategori,3)) AS kode_kategori FROM cassa_kategori_izin WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_kategori)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "HRD".date('dmy').$kd;  
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
		return $this->db->delete($this->_table, ['kode_kategori' => $id]);
	}

   
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save_kategori_izin($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_kategori_izin WHERE kode_kategori = '{$atdnc_data['kode_kategori']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_kategori_izin', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_kategori ='" . $atdnc_data['kode_kategori'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_kategori_izin', $atdnc_data); 
    }
    }
}