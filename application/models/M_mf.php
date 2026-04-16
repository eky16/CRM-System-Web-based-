<?php

class M_mf extends CI_Model{
	protected $_table = 'alba_mf';



    public function get_stok_komponen($kode_mf){
		$query = $this->db->select('*');
		$query = $this->db->where(['kode_mf' => $kode_mf]);
		$query = $this->db->get('alba_mf');
		return $query->row();
	}
	function get_sub_category($category_id){ 
		$query = $this->db->get_where('alba_barang_satuan', array('subcategory_category_id' => $category_id));
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
        $this->db->select('alba_mf.*', FALSE);  
		$this->db->from('alba_mf');
		$this->db->order_by('alba_mf.nama_mf', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function lihat_warna(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('alba_warna');
		$this->db->order_by('nama_warna', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function lihat_stok(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('alba_barang');
		$this->db->order_by('Nama_Barang', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function lihat_stok_barang(){
		$query = $this->db->get_where($this->_table, 'stok_mf > 0');
		return $query->result();
	}
	public function lihat_stok_barang01(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
		public function lihat_satuan(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('alba_barang_satuan');
		$this->db->order_by('nm_satuan', 'ASC');
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
		public function lihat_satuann(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('barang_satuan');
		$this->db->order_by('nm_satuan', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
		public function lihat_kategori(){
	//	$query = $this->db->get('daftar_barang');
	//	return $query->result();
		$this->db->from('barang_kategori');
		$this->db->order_by('kategori_barang', 'DESC');
		$query = $this->db->get(); 
		return $query->result();
	}

		public function lihat_permintaan_barang_3(){
        $this->db->select('purchase_order_dt.*', FALSE);
        $this->db->select('purchase_order_hd.*', FALSE);
		$this->db->from('purchase_order_hd');
		$this->db->join('purchase_order_dt', 'purchase_order_dt.number_request  = purchase_order_hd.number_pr', 'inner');
		$this->db->where('purchase_order_hd.status_po',3);
		$this->db->order_by('number_pr', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function lihat_id($no_mf){
		$query = $this->db->get_where('alba_mf', ['no_mf' => $no_mf]);
		return $query->row();
	}

    

    public function hitung_in_barang(){

		$this->db->select('SUM(CASE WHEN alba_barang_detail_terima_mf.jumlah THEN jumlah END) AS total_in');

        $this->db->select('alba_barang.*', FALSE);  
		$this->db->from('alba_barang');
		$this->db->join('alba_barang_detail_terima_mf', 'alba_barang_detail_terima_mf.nama_barang  = alba_barang.Nama_Barang', 'left');
		$this->db->group_by('alba_barang.Nama_Barang');
		$this->db->order_by('alba_barang.Nama_Barang', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function hitung_out_barang(){

		$this->db->select('SUM(CASE WHEN alba_pengeluaran_detail_keluar_mf.jumlah_mf THEN jumlah END) AS total_out');
        $this->db->select('alba_barang.*', FALSE); 
        $this->db->select('alba_pengeluaran_detail_keluar_mf.*', FALSE); 
		$this->db->from('alba_barang');
		$this->db->join('alba_pengeluaran_detail_keluar_mf', 'alba_pengeluaran_detail_keluar_mf.nama_barang  = alba_barang.Nama_Barang', 'left');
		$this->db->group_by('alba_barang.Nama_Barang');
		$this->db->order_by('alba_barang.Nama_Barang', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}



    public function lihat_list_forecastto_stok($jenis_produksi = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_permintaan_barang_dt.*', FALSE); 
        $this->db->select('alba_customer.nama_cst as nama_cst,alba_customer.alamat_cst ', FALSE);
        $this->db->from('alba_permintaan_barang_dt');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = alba_permintaan_barang_dt.number_po', 'inner');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_permintaan_barang_dt.kd_cst', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.transDate', 'ASC');
        $kondisi = "( ( (  alba_customer.nama_cst ='" . 'Forecast' . "' and alba_permintaan_barang_dt.status_qr ='" . 'selesai' . "')) )";

        $this->db->where($kondisi);

        if (!empty($jenis_produksi)) {
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        } else {
          //  $this->db->where('laporan_proyek.kode_lap', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    }


	public function lihat_nama_barang($Nama_mf){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_mf' => $Nama_mf]);
		$query = $this->db->get('alba_mf');
		return $query->row();
	}
	public function lihat_nama_barang_permintaan1($id_dt){
		$query = $this->db->select('alba_permintaan_barang_dt.*');
		$query = $this->db->select('alba_customer.*');
		$query = $this->db->where(['id_dt' => $id_dt]);
		$query = $this->db->get('alba_permintaan_barang_dt');
		return $query->row();
	}
		public function lihat_nama_barang_permintaan($id_dt){
        $this->db->select('alba_permintaan_barang_dt.*', FALSE);
        $this->db->select('alba_customer.*', FALSE);
		$this->db->from('alba_permintaan_barang_dt');
		$this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_permintaan_barang_dt.kd_cst', 'left');
		$this->db->where('alba_permintaan_barang_dt.id_dt',$id_dt);
		$query = $this->db->get(); 
		return $query->row();
	}
	public function lihat_nama_barang1($Nama_Barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['Nama_Barang' => $Nama_Barang]);
		$query = $this->db->get('alba_mf');
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
		return $this->db->insert('alba_mf', $data);
	}

	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('Stok', 'Stok+' . $stok, false);
		$query = $this->db->where('Nama_Barang', $nama_barang);
		$query = $this->db->update('alba_barang');
		return $query;
	}
	
	public function plus_stok_mf($stok_mf, $Nama_mf){
		$query = $this->db->set('stok_mf', 'stok_mf+' . $stok_mf, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_TTP_A_S($ttp_a_s, $Nama_mf){
		$query = $this->db->set('TTP_A_S', 'TTP_A_S+' . $ttp_a_s, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_TTP_A_D($ttp_a_d, $Nama_mf){
		$query = $this->db->set('TTP_A_D', 'TTP_A_D+' . $ttp_a_d, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_SMPG_S($smpg_s, $Nama_mf){
		$query = $this->db->set('SMPG_S', 'SMPG_S+' . $smpg_s, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_SMPG_D($smpg_d, $Nama_mf){
		$query = $this->db->set('SMPG_D', 'SMPG_D+' . $smpg_d, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_BLKG_S($blkg_s, $Nama_mf){
		$query = $this->db->set('BLKG_S', 'BLKG_S+' . $blkg_s, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_BLKG_D($blkg_d, $Nama_mf){
		$query = $this->db->set('BLKG_D', 'BLKG_D+' . $blkg_d, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_RACK($rack, $Nama_mf){
		$query = $this->db->set('RACK', 'RACK+' . $rack, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_BOX($box, $Nama_mf){
		$query = $this->db->set('BOX', 'BOX+' . $box, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_CHS_S_STAT($chs_s_stat, $Nama_mf){
		$query = $this->db->set('CHS_S_STAT', 'CHS_S_STAT+' . $chs_s_stat, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_CHS_S_DIN($chs_s_din, $Nama_mf){
		$query = $this->db->set('CHS_S_DIN', 'CHS_S_DIN+' . $chs_s_din, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_CHS_D_DIN($chs_d_din, $Nama_mf){
		$query = $this->db->set('CHS_D_DIN', 'CHS_D_DIN+' . $chs_d_din, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_TTP_CHS_S($ttp_chs_s, $Nama_mf){
		$query = $this->db->set('TTP_CHS_S', 'TTP_CHS_S+' . $ttp_chs_s, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_TTP_CHS_D($ttp_chs_d, $Nama_mf){
		$query = $this->db->set('TTP_CHS_D', 'TTP_CHS_D+' . $ttp_chs_d, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_CNTL_S($cntl_s, $Nama_mf){
		$query = $this->db->set('CNTL_S', 'CNTL_S+' . $cntl_s, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_CNTL_D($cntl_d, $Nama_mf){
		$query = $this->db->set('CNTL_D', 'CNTL_D+' . $cntl_d, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_PNGMN($pngmn, $Nama_mf){
		$query = $this->db->set('PNGMN', 'PNGMN+' . $pngmn, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_RELL($rell, $Nama_mf){
		$query = $this->db->set('RELL', 'RELL+' . $rell, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function plus_stok_mf_SAMB_RELL($samb_rell, $Nama_mf){
		$query = $this->db->set('SAMB_RELL', 'SAMB_RELL+' . $samb_rell, false);
		$query = $this->db->where('nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function update_harga($stok, $nama_barang){
		$query = $this->db->set('hrg_brg', $stok);
		//$query = $this->db->set('hrg_brg', $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}
	public function min_stok($stok_mf, $Nama_mf){
		$query = $this->db->set('stok_mf', 'stok_mf-' . $stok_mf, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf($stok_mf, $Nama_mf){
		$query = $this->db->set('stok_mf', 'stok_mf-' . $stok_mf, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_TTP_A_S($ttp_a_s, $Nama_mf){
		$query = $this->db->set('TTP_A_S', 'TTP_A_S-' . $ttp_a_s, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_TTP_A_D($ttp_a_d, $Nama_mf){
		$query = $this->db->set('TTP_A_D', 'TTP_A_D-' . $ttp_a_d, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_SMPG_S($smpg_s, $Nama_mf){
		$query = $this->db->set('SMPG_S', 'SMPG_S-' . $smpg_s, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_SMPG_D($smpg_d, $Nama_mf){
		$query = $this->db->set('SMPG_D', 'SMPG_D-' . $smpg_d, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_BLKG_S($blkg_s, $Nama_mf){
		$query = $this->db->set('BLKG_S', 'BLKG_S-' . $blkg_s, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_BLKG_D($blkg_d, $Nama_mf){
		$query = $this->db->set('BLKG_D', 'BLKG_D-' . $blkg_d, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_RACK($rack, $Nama_mf){
		$query = $this->db->set('RACK', 'RACK-' . $rack, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_BOX($box, $Nama_mf){
		$query = $this->db->set('BOX', 'BOX-' . $box, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_CHS_S_STAT($chs_s_stat, $Nama_mf){
		$query = $this->db->set('CHS_S_STAT', 'CHS_S_STAT-' . $chs_s_stat, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_CHS_S_DIN($chs_s_din, $Nama_mf){
		$query = $this->db->set('CHS_S_DIN', 'CHS_S_DIN-' . $chs_s_din, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_CHS_D_DIN($chs_d_din, $Nama_mf){
		$query = $this->db->set('CHS_D_DIN', 'CHS_D_DIN-' . $chs_d_din, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_TTP_CHS_S($ttp_chs_s, $Nama_mf){
		$query = $this->db->set('TTP_CHS_S', 'TTP_CHS_S-' . $ttp_chs_s, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_TTP_CHS_D($ttp_chs_d, $Nama_mf){
		$query = $this->db->set('TTP_CHS_D', 'TTP_CHS_D-' . $ttp_chs_d, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_CNTL_S($cntl_s, $Nama_mf){
		$query = $this->db->set('CNTL_S', 'CNTL_S-' . $cntl_s, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_CNTL_D($cntl_d, $Nama_mf){
		$query = $this->db->set('CNTL_D', 'CNTL_D-' . $cntl_d, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_PNGMN($pngmn, $Nama_mf){
		$query = $this->db->set('PNGMN', 'PNGMN-' . $pngmn, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_RELL($rell, $Nama_mf){
		$query = $this->db->set('RELL', 'RELL-' . $rell, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}
	public function min_stok_mf_SAMB_RELL($samb_rell, $Nama_mf){
		$query = $this->db->set('SAMB_RELL', 'SAMB_RELL-' . $samb_rell, false);
		$query = $this->db->where('Nama_mf', $Nama_mf);
		$query = $this->db->update('alba_mf');
		return $query;
	}

	public function ubah($data, $no_mf){
		$query = $this->db->set($data);
		$query = $this->db->where(['no_mf' => $no_mf]);
		$query = $this->db->update('alba_mf');
		return $query;
	}

	public function hapus($no_mf){
		return $this->db->delete('alba_mf', ['no_mf' => $no_mf]);
	}
}