<?php

class M_pengiriman extends CI_Model{
	protected $_table = 'jadwal_pengiriman';




	function get_sub_category($category_id){ 
		$query = $this->db->get_where('sub_category', array('subcategory_category_id' => $category_id));
		return $query;
	}
	function get_sub_category_project($category_id){ 
		$query = $this->db->get_where('leads_project', array('id_lsp' => $category_id));
		return $query;
	}
	function get_name_vendor_by_id($category_id){ 
		$query = $this->db->get_where('tbl_vendor', array('id_ven' => $category_id));
		return $query;
	}
	public function lihat001(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	public function lihat(){
        $this->db->select('jadwal_pengiriman.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman.tgl_pengiriman', 'DESC');
		$this->db->where('jadwal_pengiriman.status_pengiriman',1);
		$query = $this->db->get(); 
		return $query->result();
	}

	public function lihat_disetujui(){
        $this->db->select('jadwal_pengiriman.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman.tgl_pengiriman', 'DESC');
		$this->db->where('jadwal_pengiriman.status_pengiriman',2);
		$query = $this->db->get(); 
		return $query->result();
	}

	public function lihat_ditolak(){
        $this->db->select('jadwal_pengiriman.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman.tgl_pengiriman', 'DESC');
		$this->db->where('jadwal_pengiriman.status_pengiriman',3);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function lihat_filterdate($tanggal){
        $this->db->select('jadwal_pengiriman.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman.tgl_pengiriman', 'ASC');
		$this->db->where('jadwal_pengiriman.tgl_pengiriman',$tanggal);
		$query = $this->db->get(); 
		return $query->result();
	}

	public function lihat_detail_pengiriman($id_pengiriman){
        $this->db->select('jadwal_pengiriman.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman.tgl_pengiriman', 'ASC');
		$this->db->where('jadwal_pengiriman.id_pengiriman',$id_pengiriman);
            if (!empty($id_pengiriman)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
           $this->db->where('jadwal_pengiriman.id_pengiriman', $id_pengiriman);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
	}
	public function lihat_detail_pengiriman_log($id_pengiriman){
        $this->db->select('jadwal_pengiriman_log.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
		$this->db->from('jadwal_pengiriman_log');
		$this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman_log.project_id', 'left');
		$this->db->order_by('jadwal_pengiriman_log.tgl_pengiriman', 'ASC');
		$this->db->where('jadwal_pengiriman_log.id_pengiriman_log',$id_pengiriman);
         $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
	}
	public function update_pengiriman($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM jadwal_pengiriman WHERE id_pengiriman = '{$atdnc_data['id_pengiriman']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('jadwal_pengiriman', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_pengiriman ='" . $atdnc_data['id_pengiriman'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('jadwal_pengiriman', $atdnc_data); 
    }
}
	public function tambah_log_pengiriman($data){
		return $this->db->insert('jadwal_pengiriman_log', $data);
	} 
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('daftar_barang');
		$this->db->order_by('Nama_Barang', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function lihat_stok_barang(){
		$query = $this->db->get_where($this->_table, 'stok > 0');
		return $query->result();
	}
	public function lihat_stok_barang01(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
		public function lihat_satuan(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('tbl_unit');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
		public function lihat_pemasok(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('daftar_pemasok');
		$this->db->order_by('Nama', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}

	public function lihat_id($kode_barang){
		$query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}
	public function lihat_nama_barang1($Nama_Barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['Nama_Barang' => $Nama_Barang]);
		$query = $this->db->get('daftar_barang');
		return $query->row();
	}
		public function lihat_pembayaran_po($id_pembayaran){
		$query = $this->db->select('*');
		$query = $this->db->where(['id_paym_po' => $id_pembayaran]);
		$query = $this->db->get('tbl_payment_po_hd');
		return $query->row();
	}
	public function lihat_nama_barang2($Nama_Barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['Kode_barang' => $Nama_Barang]);
		$query = $this->db->get('daftar_unit_barang');
		return $query->row();
	}
	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}
	public function update_harga($stok, $nama_barang){
		$query = $this->db->set('hrg_brg', $stok);
		//$query = $this->db->set('hrg_brg', $stok, false);
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

	public function hapus($id_pengiriman){
		return $this->db->delete($this->_table, ['id_pengiriman' => $id_pengiriman]);
	}
	public function hapus_log($id_pengiriman){
		return $this->db->delete('jadwal_pengiriman_log', ['id_pengiriman_log' => $id_pengiriman]);
	}
}