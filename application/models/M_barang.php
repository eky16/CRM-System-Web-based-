<?php

class M_barang extends CI_Model{
	protected $_table = 'alba_barang';

	

   public function get_barang_aging() {
    $this->db->select('alba_barang.*', FALSE);
    $tgl_batas_0_3_bulan = date('Y-m-d', strtotime('-3 months'));
    $tgl_batas_3_6_bulan = date('Y-m-d', strtotime('-6 months'));

       $this->db->select('alba_barang.Nama_Barang, alba_barang.Type_Barang, alba_barang.Kode_Barang, alba_barang.Stok, alba_barang.Zona, alba_barang.Lantai, alba_barang.Blok');
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima >= DATE_SUB(NOW(), INTERVAL 3 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS nol_tigabulan_qty', FALSE);
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima >= DATE_SUB(NOW(), INTERVAL 6 MONTH) AND alba_barang_penerimaan.tgl_terima < DATE_SUB(NOW(), INTERVAL 3 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS tiga_enambulan_qty', FALSE);
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima < DATE_SUB(NOW(), INTERVAL 6 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS over_6bulan_qty', FALSE);
    
    $this->db->from('alba_barang');
    $this->db->join('alba_barang_detail_terima', 'alba_barang_detail_terima.nama_barang = alba_barang.Nama_Barang', 'left');
    $this->db->join('alba_barang_penerimaan', 'alba_barang_penerimaan.no_terima = alba_barang_detail_terima.no_terima', 'left');
    $this->db->group_by('alba_barang.Nama_Barang, alba_barang.Type_Barang, alba_barang.Kode_Barang');
    $this->db->order_by('alba_barang.Nama_Barang', 'ASC');
    
    $query = $this->db->get(); 
     foreach ($query->result() as $barang) {
        $data = array(
            'Type_Barang' => $barang->Type_Barang,
            'Nama_Barang' => $barang->Nama_Barang,
            'Kode_Barang' => $barang->Kode_Barang,
            'Stok' => $barang->Stok,
            'Zona' => $barang->Zona,
            'Lantai' => $barang->Lantai,
            'Blok' => $barang->Blok,
            'nol_tigabulan_qty' => $barang->nol_tigabulan_qty,
            'tiga_enambulan_qty' => $barang->tiga_enambulan_qty,
            'over_6bulan_qty' => $barang->over_6bulan_qty
        );

        $this->db->where('Kode_Barang', $barang->Kode_Barang);
        $result = $this->db->get('alba_barang');

        if ($result->num_rows() > 0) {
            $this->db->where('Kode_Barang', $barang->Kode_Barang);
            $this->db->update('alba_barang', $data);
        }
    }
    return $query->result();
}


    public function update_barang_aging($data) {
        foreach ($data as $item) {
            $this->db->where('Kode_Barang', $item['Kode_Barang']);
            $this->db->update('alba_barang', $item);
        }
    }

    public function get_stok_barang($Kode_Barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['Kode_Barang' => $Kode_Barang]);
		$query = $this->db->get('alba_barang');
		return $query->row();
	}
	public function get_stok_barang_detail() {
    $id_dt = $this->input->post('id_dt');

    $this->db->select('nol_tigabulan_qty, tiga_enambulan_qty, over_6bulan_qty');
    $this->db->from('alba_barang_detail_terima');
    $this->db->where('id_dt', $id_dt);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $result = $query->row();
        echo json_encode(['success' => true, 'data' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }
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
	public function lihat_by_type($type_barang){
		$this->db->where('Type_Barang', $type_barang);

    $this->db->select('alba_barang.*', FALSE);
    $tgl_batas_0_3_bulan = date('Y-m-d', strtotime('-3 months'));
    $tgl_batas_3_6_bulan = date('Y-m-d', strtotime('-6 months'));

       $this->db->select('alba_barang.Nama_Barang, alba_barang.Type_Barang, alba_barang.Kode_Barang, alba_barang.Stok, alba_barang.Zona, alba_barang.Lantai, alba_barang.Blok');

       // akumulasi stok aging 0-3, 3-6, dan >6bulan
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima >= DATE_SUB(NOW(), INTERVAL 3 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS nol_tigabulan_qty', FALSE);
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima >= DATE_SUB(NOW(), INTERVAL 6 MONTH) AND alba_barang_penerimaan.tgl_terima < DATE_SUB(NOW(), INTERVAL 3 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS tiga_enambulan_qty', FALSE);
    $this->db->select('SUM(CASE 
                            WHEN alba_barang_penerimaan.tgl_terima < DATE_SUB(NOW(), INTERVAL 6 MONTH) THEN alba_barang_detail_terima.min_jumlah
                            ELSE 0
                        END) AS over_6bulan_qty', FALSE);
    
    $this->db->from('alba_barang');
    $this->db->join('alba_barang_detail_terima', 'alba_barang_detail_terima.nama_barang = alba_barang.Nama_Barang', 'left');
    $this->db->join('alba_barang_penerimaan', 'alba_barang_penerimaan.no_terima = alba_barang_detail_terima.no_terima', 'left');
    $this->db->group_by('alba_barang.Nama_Barang, alba_barang.Type_Barang, alba_barang.Kode_Barang');
    $this->db->order_by('alba_barang.Nama_Barang', 'ASC');
    
    $query = $this->db->get(); 
     foreach ($query->result() as $barang) {
        $data = array(
           
            'nol_tigabulan_qty' => $barang->nol_tigabulan_qty,
            'tiga_enambulan_qty' => $barang->tiga_enambulan_qty,
            'over_6bulan_qty' => $barang->over_6bulan_qty
        );

        $this->db->where('Kode_Barang', $barang->Kode_Barang);
        $result = $this->db->get('alba_barang');

        if ($result->num_rows() > 0) {
            $this->db->where('Kode_Barang', $barang->Kode_Barang);
            $this->db->update('alba_barang', $data);
        }
    }
    return $query->result();
}
	
	public function get_all_barang(){
        $this->db->select('alba_barang.*', FALSE);  
		$this->db->from('alba_barang');
		$this->db->order_by('alba_barang.Nama_Barang', 'ASC');
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
		$this->db->from('items');
		$this->db->order_by('item', 'ASC');
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
	public function lihat_id($No){
		$query = $this->db->get_where('alba_barang', ['No' => $No]);
		return $query->row();
	}

    
    

    public function hitung_in_barang(){

		$this->db->select('SUM(CASE WHEN alba_barang_detail_terima.jumlah THEN jumlah END) AS total_in');

        $this->db->select('alba_barang.*', FALSE);  
		$this->db->from('alba_barang');
		$this->db->join('alba_barang_detail_terima', 'alba_barang_detail_terima.nama_barang  = alba_barang.Nama_Barang', 'left');
		$this->db->group_by('alba_barang.Nama_Barang');
		$this->db->order_by('alba_barang.Nama_Barang', 'ASC');
		$query = $this->db->get(); 
		return $query->result();
	}
	public function hitung_out_barang(){

		$this->db->select('SUM(CASE WHEN alba_pengeluaran_detail_keluar.jumlah THEN jumlah END) AS total_out');
        $this->db->select('alba_barang.*', FALSE); 
        $this->db->select('alba_pengeluaran_detail_keluar.*', FALSE); 
		$this->db->from('alba_barang');
		$this->db->join('alba_pengeluaran_detail_keluar', 'alba_pengeluaran_detail_keluar.nama_barang  = alba_barang.Nama_Barang', 'left');
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


	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['Nama_Barang' => $nama_barang]);
		$query = $this->db->get('alba_barang');
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
		$query = $this->db->where(['item' => $Nama_Barang]);
		$query = $this->db->get('items');
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
		return $this->db->insert('items', $data);
	}
	public function plus_stok_from_wo($stok, $itemno){
    $this->db->set('Stok', 'Stok+' . (int)$stok, false);
    $this->db->where('Kode_Barang', $itemno);
    $this->db->update('alba_barang');

    // Logging query for debugging
    error_log($this->db->last_query());

    if ($this->db->affected_rows() > 0) {
        return true; // Berhasil melakukan update
    } else {
        return false; // Gagal melakukan update
    }
}


  public function plus_stok_partial($qty_selesai, $nama_barang)
{
    log_message('info', 'Updating stock for ' . $nama_barang . ' with qty ' . $qty_selesai);
    $this->db->set('Stok', 'Stok + ' . (int)$qty_selesai, false)
             ->where('Nama_Barang', $nama_barang)
             ->update('alba_barang');
    if ($this->db->affected_rows() > 0) {
        log_message('info', 'Stock updated successfully');
    } else {
        log_message('error', 'Failed to update stock for ' . $nama_barang);
    }
}

   public function plus_stok($stok, $nama_barang){
    $this->db->set('Stok', 'Stok+' . $stok, false);
    $this->db->where('Nama_Barang', $nama_barang);
    $this->db->update('alba_barang');

    // Periksa apakah update berhasil
    if ($this->db->affected_rows() > 0) {
        return true; // Berhasil melakukan update
    } else {
        return false; // Gagal melakukan update
    }
}
	
	

	public function update_harga($stok, $nama_barang){
		$query = $this->db->set('hrg_brg', $stok);
		//$query = $this->db->set('hrg_brg', $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}
	public function min_stok($qty, $nama_barang) {
        // Mulai transaksi
        $this->db->trans_start();

        // Mendapatkan data barang berdasarkan nama_barang
        $this->db->where('Nama_Barang', $nama_barang);
        $barang = $this->db->get('alba_barang')->row();

        // Penanganan kesalahan jika barang tidak ditemukan
        if (!$barang) {
            $this->db->trans_rollback();
            return false;
        }

        // Variabel untuk menyimpan sisa stok yang perlu dikurangi
        $stok = $qty;

        // Mengurangi stok dari kategori over_6bulan_qty terlebih dahulu
        if ($stok > 0 && $barang->over_6bulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->over_6bulan_qty);
            $barang->over_6bulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima
            $this->update_stok_aging_detail_terima($nama_barang, 'over_6bulan_qty', $stok_terpotong);
        }

        // Mengurangi stok dari kategori tiga_enambulan_qty jika masih ada stok yang perlu dikurangi
        if ($stok > 0 && $barang->tiga_enambulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->tiga_enambulan_qty);
            $barang->tiga_enambulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima
            $this->update_stok_aging_detail_terima($nama_barang, 'tiga_enambulan_qty', $stok_terpotong);
        }

        // Mengurangi stok dari kategori nol_tigabulan_qty jika masih ada stok yang perlu dikurangi
        if ($stok > 0 && $barang->nol_tigabulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->nol_tigabulan_qty);
            $barang->nol_tigabulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima
            $this->update_stok_aging_detail_terima($nama_barang, 'nol_tigabulan_qty', $stok_terpotong);
        }

        // Kurangi stok total di tabel alba_barang
        $this->db->set('Stok', 'Stok - ' . (int)$qty, false);
        $this->db->where('Nama_Barang', $nama_barang);
        $this->db->update('alba_barang');

        // Update data stok aging di tabel alba_barang
        $data = array(
        'nol_tigabulan_qty' => $barang->nol_tigabulan_qty,
        'tiga_enambulan_qty' => $barang->tiga_enambulan_qty,
        'over_6bulan_qty' => $barang->over_6bulan_qty
        );
        $this->db->where('Nama_Barang', $nama_barang);
        $this->db->update('alba_barang', $data);

        // Selesaikan transaksi
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function update_stok_aging_detail_terima($nama_barang, $kategori, $qty) {
         // Mendapatkan semua entri di alba_barang_detail_terima untuk nama_barang yang sesuai dengan kategori
        $this->db->select('alba_barang_detail_terima.*, alba_barang_penerimaan.tgl_terima');
        $this->db->from('alba_barang_detail_terima');
        $this->db->join('alba_barang_penerimaan', 'alba_barang_detail_terima.no_terima  = alba_barang_penerimaan.no_terima'); // kondisi join
        $this->db->where('alba_barang_detail_terima.nama_barang', $nama_barang);

        // Menyesuaikan kategori sesuai kebutuhan dan mengurutkan berdasarkan tgl_terima secara ascending
        if ($kategori == 'nol_tigabulan_qty') {
            $this->db->where('alba_barang_penerimaan.tgl_terima >=', date('Y-m-d', strtotime('-3 months')));
        } elseif ($kategori == 'tiga_enambulan_qty') {
            $this->db->where('alba_barang_penerimaan.tgl_terima >=', date('Y-m-d', strtotime('-6 months')));
            $this->db->where('alba_barang_penerimaan.tgl_terima <', date('Y-m-d', strtotime('-3 months')));
        } elseif ($kategori == 'over_6bulan_qty') {
            $this->db->where('alba_barang_penerimaan.tgl_terima <', date('Y-m-d', strtotime('-6 months')));
        }
    
        // Urutkan berdasarkan tanggal penerimaan untuk FIFO
        $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'ASC');

        $query = $this->db->get();
        $entries = $query->result();

        // Mengurangi stok sesuai urutan tgl_terima
        foreach ($entries as $entry) {
            if ($qty <= 0) {
            break;
            }

            $stok_terpotong = min($qty, $entry->min_jumlah);
            $qty -= $stok_terpotong;

            // Update min_jumlah pada alba_barang_detail_terima
            $this->db->set('min_jumlah', 'min_jumlah - ' . (int)$stok_terpotong, false);
            $this->db->where('id_t', $entry->id_t); // Assuming 'id_t' is the primary key column
            $this->db->update('alba_barang_detail_terima');
        }
    }
    
    

	public function ubah($data, $No){
		$query = $this->db->set($data);
		$query = $this->db->where(['No' => $No]);
		$query = $this->db->update('alba_barang');
		return $query;
	}

	public function hapus($No){
		return $this->db->delete('alba_barang', ['No' => $No]);
	}
}