<?php

class M_pembelian extends CI_Model{
    protected $_table = 'tbl_payment';
    protected $_table_v = 'tbl_vendor';
    protected $_table_s = 'tbl_supplier';

    
    public function get_barang_id($id_dt) {
    $this->db->select('quantity, qty_partial_packing, qty_sisa_partial_pack');
    $this->db->from('alba_permintaan_barang_dt');
    $this->db->where('id_dt', $id_dt);
    return $this->db->get()->row();
}
    public function update_qty_partial($id_dt, $total_partial_pack, $qty_sisa_pack) {
    $data = array(
        'qty_partial_packing' => $total_partial_pack,
        'qty_sisa_partial_pack' => $qty_sisa_pack

    );

    $this->db->where('id_dt', $id_dt);
    return $this->db->update('alba_permintaan_barang_dt', $data);
}

    public function update_qty_delivery($id_dt, $total_delivery, $qty_sisa) {
    $data = array(
        'Qty_Delivery' => $total_delivery,
        'Qty_Sisa' => $qty_sisa
    );

    $this->db->where('id_dt', $id_dt);
    return $this->db->update('alba_permintaan_barang_dt', $data);
}
    public function get_barang_by_id($id_dt) {
    $this->db->select('quantity, Qty_Delivery, Qty_Sisa');
    $this->db->from('alba_permintaan_barang_dt');
    $this->db->where('id_dt', $id_dt);
    return $this->db->get()->row();
}
  
    public function get_kode_trakhir(){ 
        $query = $this->db->get('alba_pesanan_barang_dt');
        $query = $this->db->order_by('no',"desc");
        $query =  $this->db->limit(1);
        return $query->result();
    }

    function get_sub_category($category_id){
        $query = $this->db->get_where('daftar_unit_barang', array('Kode_barang' => $category_id));
        return $query;
    }

 
    public function ubah_nomor_po_pesanan_dt($update_dt_pjk, $numbernya){
        $query = $this->db->set($update_dt_pjk);
        $query = $this->db->where(['number_po' => $numbernya]);
        $query = $this->db->update('alba_pesanan_barang_dt');
        return $query;
    }
    function getUsers($postData){
       
        $response = array();
        
        $this->db->select('*');

        if($postData['search'] ){
           
      // Select record
          $this->db->where("nama_karyawan like '%".$postData['search']."%' ");
          
          $records = $this->db->get('alba_karyawan')->result();

          foreach($records as $row ){
            $response[] = array("value"=>$row->EmployeeID,"label"=>$row->nama_karyawan);
        }
        
    }
    
    return $response;
}
public function ubah_statusItem_po_detail($data_detail) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_dt WHERE id_dt = '{$data_detail['id_dt']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_dt', $data_detail); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_dt ='" . $data_detail['id_dt'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_pesanan_barang_dt', $data_detail); 
    }
}
public function simpan_data_tagihan_po($data_pembayaran) 
{
    $query = $this->db->query("SELECT * FROM tbl_payment_po_hd WHERE id_paym_po = '{$data_pembayaran['id_paym_po']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_payment_po_hd', $data_pembayaran); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_paym_po ='" . $data_pembayaran['id_paym_po'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_payment_po_hd', $data_pembayaran); 
    }
}
public function simpan_data_grand_total($data_grand_total) 
{
    $query = $this->db->query("SELECT * FROM tbl_po_grand WHERE no_pesanan = '{$data_grand_total['no_pesanan']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_po_grand', $data_grand_total); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( no_pesanan ='" . $data_grand_total['no_pesanan'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_po_grand', $data_grand_total); 
    }
}
public function ubah_statusItem_po_detail_1($data_detail) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_dt WHERE no = '{$data_detail['id_dt']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_dt', $data_detail); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( no ='" . $data_detail['id_dt'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_pesanan_barang_dt', $data_detail); 
    }
}
public function save_po_hd($data_po_hd) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_hd WHERE number_ = '{$data_po_hd['number_']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_hd', $data_po_hd); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( number_ ='" . $data_po_hd['number_'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_pesanan_barang_hd', $data_po_hd); 
    }
}

public function save_po_detail_item($save_item_dt) 
{
    $query = $this->db->query("SELECT * FROM alba_permintaan_barang_dt WHERE id_dt = '99999' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_permintaan_barang_dt', $save_item_dt); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_dt ='" . 99999 . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_permintaan_barang_dt', $save_item_dt); 
    }
}
public function getLatestNumber()
{
    $this->db->select('id_dt');
    $this->db->order_by('id_dt', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('alba_permintaan_barang_dt');
    
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->id_dt;
    }
    
    return 0; // Jika tidak ada nomor tersedia
}
public function save_po_detail_item_1_pr($save_item_dt_pr) 
{
    $query = $this->db->query("SELECT * FROM alba_permintaan_barang_dt WHERE id_dt = '99999' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_permintaan_barang_dt', $save_item_dt_pr); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_dt ='" . 99999 . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_permintaan_barang_dt', $save_item_dt_pr); 
    }
}
public function save_po_detail_item_1($save_item_dt) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_dt WHERE id_dt = '99999' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_dt', $save_item_dt); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_dt ='" . 99999 . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_pesanan_barang_dt', $save_item_dt); 
    }
}
public function simpan_kode_terakhir($data_kode) 
{
    $query = $this->db->query("SELECT * FROM alba_kode_otomatis WHERE kode_otomatis = '{$data_kode['kode_otomatis']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_kode_otomatis', $data_kode); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_otomatis ='" . $data_kode['kode_otomatis'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_kode_otomatis', $data_kode); 
    }
}
public function simpan_po_dt($data) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_hd WHERE number_ = '{$data['number_']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_hd', $data); 
    }
 //   elseif ($count == 1) {
  //      $kondisi = "( ( ( number_ ='" . $data['number_'] . "')) )";
  //      $this->db->where($kondisi);
  //      $this->db->update('alba_pesanan_barang_hd', $data); 
 //   }
}

public function nonaktifkan_pr_dt($id)
{
    $this->db->where('number_request', $id);
    return $this->db->update('alba_permintaan_barang_dt', ['status_dt' => 'OFF']);
}




function hapus_pr_dt_master_wo($id) 
{
  $this->db->where('id_dt', $id);
  $this->db->delete('alba_permintaan_barang_dt');
}

function hapus_pr_dt($id) 
{
  $this->db->where('number_request', $id);
  $this->db->delete('alba_permintaan_barang_dt');
}
function hapus_po_dt($id) 
{
  $this->db->where('no', $id);
  $this->db->delete('alba_pesanan_barang_dt');
}
function hapus_pr_dt1($id) 
{
  $this->db->where('id_dt', $id);
  $this->db->delete('alba_permintaan_barang_dt');
}


function hapus_pr_history($id)
{
  $this->db->where('no_po', $id);
  $this->db->delete('alba_permintaan_history');
}
function save_approve_payment($atdnc_data,$id){
    $kondisi = "( ( ( id_payment  ='" . $id . "')) )";
    $this->db->where($kondisi);
    $this->db->update('tbl_payment', $atdnc_data);
    return TRUE;
}
public function save_pengiriman_dt($data_detail_keluar){
    return $this->db->insert_batch('alba_pengiriman_dt', $data_detail_keluar);
}
public function save_purchase_dt1($data_detail_keluar){ 
    return $this->db->insert_batch('alba_permintaan_barang_dt', $data_detail_keluar);
}
public function save_purchase_spk_dt_pr($data_detail_keluar_spk_pr){
    return $this->db->insert_batch('alba_permintaan_barang_dt', $data_detail_keluar_spk_pr);
}
public function save_purchase_spk_dt($data_detail_keluar){
    return $this->db->insert_batch('alba_pesanan_barang_dt', $data_detail_keluar);
}
function save_purchase_dt($number_,$detailName,$quantity,$detailNotes){
    if( !empty($number_) ) {
        $result = array();
        foreach($detailName AS $key => $val){
           $result[] = array(
              'number_po'   => $number_,
              'detailName'   => $detailName[$key],
              'quantity'   => $quantity[$key],
              'detailNotes'   => $detailNotes[$key]
          );
       }      
            //MULTIPLE INSERT TO DETAIL TABLE
       $this->db->insert_batch('alba_permintaan_barang_dt', $result);
   }
}
function update_status_permintaan_selesai($Selesai,$no_pengiriman,$id_dt,$detailName){
  //  $this->db->delete('alba_permintaan_barang_dt', ['number_po' => $number_]);
    if( !empty($no_pengiriman)) {
        $result = array();
        foreach($detailName AS $key => $val){
           $result[] = array(
            'detailName'   => $detailName[$key],
            'status_qr'   => $Selesai,
            'status_proses_pr'   => $Selesai,
            'id_kiriman'   => $no_pengiriman,
            'id_dt'   => $id_dt[$key]
        );
       }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->update_batch('alba_permintaan_barang_dt', $result ,'id_dt');
       //  $this->db->delete('alba_pesanan_barang_dt', ['status_proses_pr' => " "]);
   }
}
function save_pr_sattle_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$gambar_kerja,$status_proses_pr,$detailNotes,$qr_code,$kd_cst){
  //  $this->db->delete('alba_permintaan_barang_dt', ['number_po' => $number_]);
    if( !empty($number_)) {
        $result = array();
        foreach($detailName AS $key => $val){
           $result[] = array(
            'number_po'   => $number_po,
            'number_request'   => $number_,
            'detailName'   => $detailName[$key],
            'itemNo'   => $itemNo[$key],
            'itemUnitName'   => $itemUnitName[$key],
            'warna'   => $warna[$key],
            'gambar_kerja'   => $gambar_kerja[$key],
            'status_proses_pr'   => $status_proses_pr[$key],
            'detailNotes'   => $detailNotes[$key],
            'quantity'   =>  $quantity[$key],
            'qr_code'   =>  $qr_code[$key],
            'kd_cst'   =>  $kd_cst,
            'id_dt'   => $id_dt[$key]
        );
       }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->update_batch('alba_permintaan_barang_dt', $result ,'id_dt');
       //  $this->db->delete('alba_pesanan_barang_dt', ['status_proses_pr' => " "]);
   }
}
function save_po_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$gambar_kerja,$status_proses_pr,$detailNotes,$qr_code){
  //  $this->db->delete('alba_permintaan_barang_dt', ['number_po' => $number_]);
    if( !empty($number_)) {
        $result = array();
        foreach($detailName AS $key => $val){
           $result[] = array(
            'number_po'   => $number_po,
            'number_request'   => $number_,
            'detailName'   => $detailName[$key],
            'itemNo'   => $itemNo[$key],
            'itemUnitName'   => $itemUnitName[$key],
            'warna'   => $warna[$key],
            'gambar_kerja'   => $gambar_kerja[$key],
            'status_proses_pr'   => $status_proses_pr[$key],
            'detailNotes'   => $detailNotes[$key],
            'quantity'   =>  $quantity[$key],
            'qr_code'   =>  $qr_code[$key],
            'id_dt'   => $id_dt[$key]
        );
       }      
            //MULTIPLE INSERT TO DETAIL TABLE

       $this->db->insert_batch('alba_pesanan_barang_dt', $result);
       //  $this->db->delete('alba_pesanan_barang_dt', ['status_proses_pr' => " "]);
   }
}
function ambil_data_kiriman_byDate($tanggal_kirim) { 
    $query = $this->db->get_where('alba_permintaan_barang_dt', array('tanggal_kirim' => $tanggal_kirim, 'status_qr' => 'Ready'));
    return $query;
}
public function nomor_kirim()
{
    $query = $this->db->query("SELECT MAX(RIGHT(kode_pengiriman, 11)) as kode_pengiriman from alba_pengiriman_hd");
    $hasil = $query->row();
    return $hasil->kode_pengiriman;
}

public function cekkode_purcahase_order_1()
{
    $query = $this->db->query("SELECT MAX(id_dt) as id_dt from alba_pesanan_barang_dt");
    $hasil = $query->row();
    return $hasil->number_pr;
}

public function cekkode_pesanan()
{
    $query = $this->db->query("SELECT MAX(kode_otomatis) as kode_otomatis from alba_kode_otomatis WHERE jenis != 'Stok'");
    $hasil = $query->row();
    return $hasil->kode_otomatis;
}
public function cekkode_stok()
{
    $query = $this->db->query("SELECT MAX(kode_otomatis) as kode_otomatis from alba_kode_otomatis WHERE jenis = 'Stok'");
    $hasil = $query->row();
    return $hasil->kode_otomatis;
}
public function cekkode_supplier()
{
    $query = $this->db->query("SELECT MAX(ID_Pemasok) as ID_Pemasok from daftar_pemasok WHERE Kategori = 'SUPPLIER'");
    $hasil = $query->row();
    return $hasil->ID_Pemasok;
}
public function cekkode_subcon()
{
    $query = $this->db->query("SELECT MAX(ID_Pemasok) as ID_Pemasok from daftar_pemasok WHERE Kategori = 'SUBCON'");
    $hasil = $query->row();
    return $hasil->ID_Pemasok;
}


public function save_pengiriman_hd($data_hd) 
{
    $query = $this->db->query("SELECT * FROM  alba_pengiriman_hd WHERE kode_pengiriman = '{$data_hd['kode_pengiriman']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' alba_pengiriman_hd', $data_hd); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_pengiriman ='" . $data_hd['kode_pengiriman'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' alba_pengiriman_hd', $data_hd); 
    }
}
public function save_purchase_spk_hd($data_hd) 
{
    $query = $this->db->query("SELECT * FROM alba_pesanan_barang_hd WHERE number_pr = '{$data_hd['number_pr']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_pesanan_barang_hd', $data_hd); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( number_pr ='" . $data_hd['number_pr'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_pesanan_barang_hd', $data_hd); 
    }
}

    public function forecast_update_to_stok($stok, $nama_barang){
        $query = $this->db->set('Stok', 'Stok+' . $stok, false);
        $query = $this->db->where('Nama_Barang', $nama_barang);
        $query = $this->db->update('alba_barang');
        return $query;
    }
    public function get_penerimaan_by_no($no_terima) {
    $this->db->where('no_terima', $no_terima);
    $query = $this->db->get('alba_barang_penerimaan'); 
    return $query->row_array();
}
    public function check_existing_terima($no_terima, $nama_barang) {
    $this->db->select('tgl_terima, jam_terima');
    $this->db->from('alba_barang_penerimaan'); // Ganti dengan nama tabel penerimaan Anda
    $this->db->where('no_terima', $no_terima);
    //$this->db->where('nama_barang', $nama_barang);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); // Mengembalikan data jika ada
    }
    return false; // Mengembalikan false jika tidak ada
}

     public function save_proses_forecasttostok_partial($data_terima_partial){
        return $this->db->insert('alba_barang_penerimaan', $data_terima_partial);
    }
    public function get_all_penerimaan() {
    return $this->db->get('alba_barang_penerimaan')->result_array();
}
    public function save_proses_forecasttostok($data_terima) 
    {
        $query = $this->db->query("SELECT * FROM alba_barang_penerimaan WHERE no_terima = '{$data_terima['no_terima']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_barang_penerimaan', $data_terima); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( no_terima ='" . $data_terima['no_terima'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_barang_penerimaan', $data_terima); 
        }
    }
    public function save_proses_forecasttostok_dt($data_terima_dt){
        return $this->db->insert('alba_barang_detail_terima', $data_terima_dt);
    }

    public function update_data($id_dt, $update_data) {
    $this->db->where('id_dt', $id_dt);
    return $this->db->update('alba_permintaan_barang_dt', $update_data);
}

   
    
    public function save_update_pr_dt($update_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_permintaan_barang_dt WHERE id_dt = '{$update_dt['id_dt']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_permintaan_barang_dt', $update_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( id_dt ='" . $update_dt['id_dt'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_permintaan_barang_dt', $update_dt); 
        }
    }
    public function save_pengeluaran_hd($data_keluar) 
    {
        $query = $this->db->query("SELECT * FROM alba_pengeluaran WHERE no_keluar = '{$data_keluar['no_keluar']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_pengeluaran', $data_keluar); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( no_keluar ='" . $data_keluar['no_keluar'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_pengeluaran', $data_keluar); 
        }
    }
    public function save_pengeluaran_dt($data_keluar_dt){
        return $this->db->insert('alba_pengeluaran_detail_keluar', $data_keluar_dt);
    }
   
   
  public function min_stok($qty, $nama_barang, $id_dt) {
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

        // Variabel untuk menyimpan jumlah yang diambil dari masing-masing kategori
        $stok_terambil = [
            'nol_tigabulan_qty' => 0,
            'tiga_enambulan_qty' => 0,
            'over_6bulan_qty' => 0
        ];

        // Variabel untuk menyimpan tanggal terima dari stok aging yang diambil
    $tgl_terima_0_3 = null;
    $tgl_terima_3_6 = null;
    $tgl_terima_over6 = null;


        // Mengurangi stok dari kategori over_6bulan_qty terlebih dahulu
        if ($stok > 0 && $barang->over_6bulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->over_6bulan_qty);
            $barang->over_6bulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;
            $stok_terambil['over_6bulan_qty'] += $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima dan dapatkan tanggal terima
        $tgl_terima_over6 = $this->update_stok_aging_detail_terima($nama_barang, 'over_6bulan_qty', $stok_terpotong);

        }

        // Mengurangi stok dari kategori tiga_enambulan_qty jika masih ada stok yang perlu dikurangi
        if ($stok > 0 && $barang->tiga_enambulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->tiga_enambulan_qty);
            $barang->tiga_enambulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;
            $stok_terambil['tiga_enambulan_qty'] += $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima dan dapatkan tanggal terima
        $tgl_terima_3_6 = $this->update_stok_aging_detail_terima($nama_barang, 'tiga_enambulan_qty', $stok_terpotong);
        }

        // Mengurangi stok dari kategori nol_tigabulan_qty jika masih ada stok yang perlu dikurangi
        if ($stok > 0 && $barang->nol_tigabulan_qty > 0) {
            $stok_terpotong = min($stok, $barang->nol_tigabulan_qty);
            $barang->nol_tigabulan_qty -= $stok_terpotong;
            $stok -= $stok_terpotong;
            $stok_terambil['nol_tigabulan_qty'] += $stok_terpotong;

            // Update stok aging pada tabel alba_barang_detail_terima dan dapatkan tanggal terima
        $tgl_terima_0_3 = $this->update_stok_aging_detail_terima($nama_barang, 'nol_tigabulan_qty', $stok_terpotong);

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

         // Simpan history pengambilan stok aging ke tabel alba_permintaan_barang_dt
    $data_history = array(
        'nol_tiga_bulan' => $stok_terambil['nol_tigabulan_qty'],
        'tiga_enam_bulan' => $stok_terambil['tiga_enambulan_qty'],
        'lebih_enam_bulan' => $stok_terambil['over_6bulan_qty'],
        'tgl_terima_nol_tigabulan' => $tgl_terima_0_3,
        'tgl_terima_tiga_enambulan' => $tgl_terima_3_6,
        'tgl_terima_lebih_enam_bulan' => $tgl_terima_over6
    );

    // Debugging: Log data yang akan disimpan ke tabel
    error_log("Data yang akan disimpan: " . json_encode($data_history));
    $this->db->where('id_dt', $id_dt);
    $this->db->update('alba_permintaan_barang_dt', $data_history);

        // Selesaikan transaksi
    $this->db->trans_complete();

    return $this->db->trans_status();
    }

    public function update_stok_aging_detail_terima($nama_barang, $kategori, $qty) {
    // Mendapatkan semua entri di alba_barang_detail_terima untuk nama_barang yang sesuai dengan kategori
    $this->db->select('alba_barang_detail_terima.*, alba_barang_penerimaan.tgl_terima');
    $this->db->from('alba_barang_detail_terima');
    $this->db->join('alba_barang_penerimaan', 'alba_barang_detail_terima.no_terima = alba_barang_penerimaan.no_terima'); // kondisi join
    $this->db->where('alba_barang_detail_terima.nama_barang', $nama_barang);

    // Menyesuaikan kategori sesuai kebutuhan dan mengurutkan berdasarkan tgl_terima secara ascending
    if ($kategori == 'nol_tigabulan_qty') {
        $this->db->group_start()
            ->where('alba_barang_penerimaan.tgl_terima >=', date('Y-m-d', strtotime('-3 months')))
            ->where('alba_barang_penerimaan.tgl_terima <=', date('Y-m-d', strtotime('+1 day'))) // Include today
        ->group_end();
    } elseif ($kategori == 'tiga_enambulan_qty') {
        $this->db->group_start()
            ->where('alba_barang_penerimaan.tgl_terima >=', date('Y-m-d', strtotime('-6 months')))
            ->where('alba_barang_penerimaan.tgl_terima <=', date('Y-m-d', strtotime('-3 months')))
        ->group_end();
    } elseif ($kategori == 'over_6bulan_qty') {
        $this->db->where('alba_barang_penerimaan.tgl_terima <=', date('Y-m-d', strtotime('-6 months')));
    }

    // Urutkan berdasarkan tanggal penerimaan untuk FIFO
    $this->db->order_by('alba_barang_penerimaan.tgl_terima', 'ASC');

    $query = $this->db->get();
    $entries = $query->result();

     // Debugging: Log entries fetched
    error_log("Entries fetched for $kategori: " . json_encode($entries));

    $last_tgl_terima = null;

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

        // Simpan tanggal terima terakhir yang digunakan
        $last_tgl_terima = $entry->tgl_terima;

        // Debugging: Log each update step
        error_log("Updated min_jumlah for id_t {$entry->id_t}, tgl_terima {$entry->tgl_terima}, stok_terpotong $stok_terpotong, remaining qty $qty");
    }

    // Mengembalikan tanggal terima terakhir yang digunakan
    return $last_tgl_terima;
}


    public function save_update_pr_dttt($update_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_pesanan_barang_dt WHERE no = '{$update_dt['no']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_pesanan_barang_dt', $update_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( no ='" . $update_dt['no'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_pesanan_barang_dt', $update_dt); 
        }
    }
    public function save_update_po_dtt($update_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_pesanan_barang_dt WHERE no = '{$update_dt['no']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_pesanan_barang_dt', $update_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( no ='" . $update_dt['no'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_pesanan_barang_dt', $update_dt); 
        }
    }

    public function save_update_po_dtt_1($update_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_permintaan_barang_dt WHERE id_dt = '{$update_dt['id_dt']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_permintaan_barang_dt', $update_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( id_dt ='" . $update_dt['id_dt'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_permintaan_barang_dt', $update_dt); 
        }
    }
    public function save_update_po_hd($update_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_pesanan_barang_hd WHERE id = '{$update_dt['id']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_pesanan_barang_hd', $update_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( id ='" . $update_dt['id'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_pesanan_barang_hd', $update_dt); 
        }
    }
    public function get_terima_by_no($no_terima) {
    $this->db->select('tgl_terima, jam_terima');
    $this->db->from('alba_barang_penerimaan'); 
    $this->db->where('no_terima', $no_terima); // Filter berdasarkan no_terima

    $query = $this->db->get();

    // Cek apakah ada data yang ditemukan
    if ($query->num_rows() > 0) {
        return $query->row_array(); // Kembalikan data sebagai array
    }

    return null; // Kembalikan null jika tidak ada data
}
    public function save_purchase_history($data_hs){
        return $this->db->insert('alba_permintaan_history', $data_hs);
    }
    public function lihat_pembayaran_po($id_pembayaran){
        $query = $this->db->select('*');
        $query = $this->db->where(['id_paym_po' => $id_pembayaran]);
        $query = $this->db->get('tbl_payment_po_hd');
        return $query->row();
    }
    public function lihat_pembayaran_1(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('tbl_payment_po_hd');
        $this->db->order_by('id_paym_po', 'ASC');
        $kondisi = "( ( (  tbl_payment_po_hd.sisa_pembayaran !='" . 0 . "' )) )";
        $this->db->where($kondisi);
        $query = $this->db->get(); 
        return $query->result();
    }

  
   
    public function lihat_data_pengiriman_hd() {
        $this->db->select('alba_pengiriman_hd.*', FALSE); 
      //  $this->db->select('count(alba_pengiriman_dt.kd_pengiriman) as progres'); 
        $this->db->select('alba_pengiriman_dt.*', FALSE);
        $this->db->from('alba_pengiriman_hd');
        $this->db->join('alba_pengiriman_dt', 'alba_pengiriman_dt.kd_pengiriman  = alba_pengiriman_hd.kode_pengiriman', 'left');
        $this->db->order_by('alba_pengiriman_hd.tgl_kiriman', 'DESC');
        $this->db->group_by('alba_pengiriman_hd.kode_pengiriman');
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


  
    public function lihat_permintaan_barang($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.*', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_pesanan_barang_hd.kd_cst', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . "Forcest" . "' OR alba_pesanan_barang_hd.status_po ='" . "Stok" . "' OR alba_pesanan_barang_hd.status_po ='" . "Produksi" . "')) )";
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
    public function list_forcest($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.*', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_pesanan_barang_hd.kd_cst', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . "Forecast" . "')) )";
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

      public function list_siap_kirim($jenis_produksi = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_permintaan_barang_dt.*', FALSE); 
        $this->db->select('alba_customer.nama_cst as nama_cst,alba_customer.alamat_cst ', FALSE);
        $this->db->from('alba_permintaan_barang_dt');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = alba_permintaan_barang_dt.number_po', 'inner');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_permintaan_barang_dt.kd_cst', 'left');
        $this->db->order_by('alba_permintaan_barang_dt.tanggal_kirim', 'ASC');

        $kondisi = "( ( (  alba_permintaan_barang_dt.status_qr ='" . $jenis_produksi . "' and alba_permintaan_barang_dt.status_proses_pr ='" . "3" . "')) )";
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

     public function list_forecastto_stok($jenis_produksi = NULL) {
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

 
    public function list_stok($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.*', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_pesanan_barang_hd.kd_cst', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . "Stok" . "')) )";
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
    public function lihat_po_status_8($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.number_', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 8 . "')) )";
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
    public function lihat_pr_status_9($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.number_', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 9 . "' )) )";
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

    public function get_proyek() {  
        $this->db->select('alba_customer.*', FALSE);   
        $this->db->select('alba_pesanan_barang_hd.*', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo = alba_pesanan_barang_hd.project', 'left');
        $this->db->order_by('alba_customer.project_name', 'DESC');
        $this->db->group_by('alba_customer.projectNo'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function laporan_01($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
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
    public function laporan_01_furniture($project,$jenis = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);
        $this->db->where('alba_pesanan_barang_hd.jenis_pembelian_item', $jenis);
        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' )) )";
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
        public function laporan_01_detail_item_bydate($tanggal,$dan_tanggal = NULL) {
        $this->db->where('alba_pesanan_barang_hd.transDate BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
       // $this->db->where('alba_pesanan_barang_hd.project', $project);

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE);
         $this->db->select('alba_pesanan_barang_dt.*', FALSE);  
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
       // $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.transDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
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
        public function laporan_01_detail_item($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE);
         $this->db->select('alba_pesanan_barang_dt.*', FALSE);  
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
       // $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
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
    public function laporan_04($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
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
    public function laporan_03($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
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
    public function laporan_01_total($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            and
            alba_pesanan_barang_hd.cashDiscount ="0"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');



        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            and
            alba_pesanan_barang_hd.cashDiscount ="0"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            and
            alba_pesanan_barang_hd.cashDiscount !="0"
            THEN  alba_pesanan_barang_hd.cashDiscount
            END) AS total_harga_p_d');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN alba_pesanan_barang_hd.cashDiscount 
            else 0 
            END) AS cashDiscount_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            and
            alba_pesanan_barang_hd.cashDiscount !=0
            THEN total_harga - cashDiscount
            END) AS total_harga_sebelum_diskon');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount != "0"
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS harga_diskon');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            and
            alba_pesanan_barang_hd.cashDiscount !="0"
            THEN (total_harga - cashDiscount) * 11 / 100
            END) AS total_harga_pajak_with_disk');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
         $this->db->group_by('alba_pesanan_barang_dt.number_po');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_total_ME($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_me');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' AND tbl_po_grand.jenis_pesanan ='" . "ME" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_total_furniture($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_furniture');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' AND tbl_po_grand.jenis_pesanan ='" . "Furniture" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_total_preliminaries($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_preliminaries');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' AND tbl_po_grand.jenis_pesanan ='" . "Preliminaries" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_total_sipil($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_sipil');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' AND tbl_po_grand.jenis_pesanan ='" . "Sipil" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_total_dll($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_dll');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' AND tbl_po_grand.jenis_pesanan ='" . "DLL" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_01_total_grand_leads($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_01_total_grand_report_bydate($tanggal,$dan_tanggal = NULL) {
     //   $this->db->where('leads_project.id_proyek_accurate', $project);

        $this->db->where('alba_pesanan_barang_hd.transDate BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_01_total_grand_report($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_proyek_accurate', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function laporan_01_total_grand_furniture($project,$jenis = NULL) {
        $this->db->where('leads_project.id_proyek_accurate', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "' and alba_pesanan_barang_hd.jenis_pembelian_item ='" . $jenis . "' )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }

          public function laporan_03_total_grand_report_sending_leads($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
      public function laporan_03_total_grand_report_sending($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_proyek_accurate', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
   public function laporan_04_total($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
//         $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
    public function laporan_03_total($project,$id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.project', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
//         $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
    public function laporan_01_total_leads($project,$id_lsp = NULL) {
     

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('leads_project', 'leads_project.id_proyek_accurate  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
//         $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->where('leads_project.id_lsp', $project);
        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
    public function laporan_01_total_leads_dalam_pengiriman($project,$id_lsp = NULL) {
     

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga * 11/100
            END) AS total_harga_pajak');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN total_harga 
            END) AS total_harga_p');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="true"
            THEN cashDiscount 
            END) AS cashDiscount_pajak');


        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.total_harga 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN total_harga 
            END) AS total_harga_np');

        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_hd.cashDiscount 
            and
            alba_pesanan_barang_hd.taxable ="false"
            THEN cashDiscount 
            END) AS cashDiscount_np');
       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('leads_project', 'leads_project.id_proyek_accurate  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
//         $this->db->group_by('alba_pesanan_barang_hd.number_');
        $this->db->where('leads_project.id_lsp', $project);
        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
    public function lihat_pr_status_7($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
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
    public function lihat_pr_status_notspk($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.jenis_permintaan ='" . ' ' . "' and alba_pesanan_barang_hd.status_po ='" . 7 . "'  )) )";
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
    public function lihat_smua_item_pembelian($id_lsp = NULL) {
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_pesanan_barang_dt.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_pesanan_barang_dt', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( ( alba_pesanan_barang_hd.status_po ='" . 7 . "'  )) )";
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
    public function lihat_pr_status_7spk($id_lsp = NULL) {
        $this->db->where('alba_pesanan_barang_hd.status_po', 7);
        $this->db->select('alba_pesanan_barang_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->select('daftar_pemasok.Nama as vendorNo', FALSE);
        $this->db->from('alba_pesanan_barang_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd.shipDate', 'DESC');

        $kondisi = "( ( (  alba_pesanan_barang_hd.jenis_permintaan ='" . 'SPK CSA' . "' OR alba_pesanan_barang_hd.jenis_permintaan ='" . 'SPK MSA' . "')) )";
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
 
    public function lihat_pengiriman_detail_hd($id = NULL) {
         $this->db->select('alba_pengiriman_hd.*', FALSE);
        $this->db->from('alba_pengiriman_hd');

        $this->db->where('alba_pengiriman_hd.id_pengiriman ', $id);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('alba_pengiriman_hd.id_pengiriman', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function lihat_pengiriman_dt($id = NULL) {
        $this->db->select('alba_pengiriman_dt.*', FALSE);
        $this->db->select('alba_permintaan_barang_dt.*', FALSE); 
        $this->db->select('alba_customer.*', FALSE); 
        $this->db->from('alba_pengiriman_dt');

        $this->db->join('alba_pengiriman_hd', 'alba_pengiriman_dt.kd_pengiriman  = alba_pengiriman_hd.kode_pengiriman', 'left');

        $this->db->join('alba_permintaan_barang_dt', 'alba_permintaan_barang_dt.id_dt  = alba_pengiriman_dt.id_permintaan', 'left');

        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_permintaan_barang_dt.kd_cst', 'left');

        $this->db->where('alba_pengiriman_hd.id_pengiriman', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

   

 
    public function lihat_po_history_price($id = NULL) { 

        $this->db->select('purchase_order_history_price.*', FALSE);
        $this->db->select('alba_pesanan_barang_hd.number_,alba_pesanan_barang_hd.id as id_hd', FALSE); 
        $this->db->from('purchase_order_history_price');
        $this->db->join('alba_pesanan_barang_hd', 'purchase_order_history_price.kode_po  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->order_by('purchase_order_history_price.waktu_ubah', 'ASC');
        $this->db->where('alba_pesanan_barang_hd.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_po_history_header($id = NULL) { 

         $this->db->select('alba_customer.project_name', FALSE);
          $this->db->select('daftar_pemasok.Nama', FALSE);
        $this->db->select('alba_pesanan_barang_hd_log.*', FALSE);
        $this->db->select('alba_pesanan_barang_hd.number_,alba_pesanan_barang_hd.id as id_hd', FALSE); 
        $this->db->from('alba_pesanan_barang_hd_log');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd_log.number_log  = alba_pesanan_barang_hd.number_', 'left');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_pesanan_barang_hd_log.project', 'left');
        $this->db->join('daftar_pemasok', 'daftar_pemasok.ID_Pemasok  = alba_pesanan_barang_hd_log.vendorNo', 'left');
        $this->db->order_by('alba_pesanan_barang_hd_log.updateTime_po', 'ASC');
        $this->db->where('alba_pesanan_barang_hd.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function tambah_log_pesanan($update_dt_log){
        return $this->db->insert('alba_pesanan_barang_hd_log', $update_dt_log);
    }
    public function lihat_po_detail_dt_count($id = NULL) { 
        $this->db->select('SUM(CASE 
            WHEN 
            alba_pesanan_barang_dt.status_qr = "Packing"
            THEN 1
            else 0
            END) AS e_approved');

       // $this->db->select('SUM(alba_pesanan_barang_dt.unitPrice )  as total_almount');
        $this->db->select('count(alba_pesanan_barang_dt.number_request) as progres'); 
        $this->db->select('alba_pesanan_barang_dt.*', FALSE);
        $this->db->select('alba_pesanan_barang_hd.number_,alba_pesanan_barang_hd.id as id_hd', FALSE); 
        $this->db->from('alba_pesanan_barang_dt');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_dt.number_po  = alba_pesanan_barang_hd.number_', 'left');
        $kondisi = "( (  (alba_pesanan_barang_dt.status_proses_pr='" . "" . "' )) )";
       // $this->db->where($kondisi);
      //   $this->db->group_by('alba_pesanan_barang_dt.no');
        $this->db->where('alba_pesanan_barang_hd.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
 
 
    public function lihat_po_detail_history($id = NULL) {
        $this->db->select(' alba_permintaan_history.*', FALSE);
        $this->db->select('alba_pesanan_barang_hd.number_pr', FALSE); 
        $this->db->from(' alba_permintaan_history');
        $this->db->join('alba_pesanan_barang_hd', ' alba_permintaan_history.no_po  = alba_pesanan_barang_hd.number_pr', 'left');
        $this->db->where('alba_pesanan_barang_hd.id', $id);
        $this->db->order_by('alba_permintaan_history.actiontime', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function api_show($id = NULL) { 
        $this->db->select('akses_api.*', FALSE); 
        $this->db->from('akses_api');

        $this->db->where('akses_api.id_api', 1);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('akses_api.id_api', 1);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function alba_customer2() { 
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $this->db->order_by('leads_project.nama_project', 'ASC');
        if (!empty($id)) {
            $this->db->where('leads_project.id_lsp', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

           // $this->db->where('tbl_employee.Active', 1);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }




       public function grand_total_finish($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 7 . "'   )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function Dalam_perjalanan_me($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_me');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "' AND tbl_po_grand.jenis_pesanan ='" . "ME" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function dalam_perjalanan_furniture($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_furniture');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "' AND tbl_po_grand.jenis_pesanan ='" . "Furniture" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function dalam_perjalanan_sipil($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_sipil');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "' AND tbl_po_grand.jenis_pesanan ='" . "Sipil" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }
       public function dalam_perjalanan_dll($project,$id_lsp = NULL) {
        $this->db->where('leads_project.id_lsp', $project);

        $this->db->select('SUM(CASE 
            WHEN 
            tbl_po_grand.grand_total 
            THEN grand_total
            END) AS harga_total_dll');

       // $this->db->select('SUM(alba_pesanan_barang_dt.total_harga)  as total_harga');
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('leads_project');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = leads_project.id_proyek_accurate', 'left');
        $this->db->join('tbl_po_grand', 'leads_project.id_lsp  = tbl_po_grand.no_project', 'left');
        $this->db->join('alba_pesanan_barang_hd', 'alba_pesanan_barang_hd.number_  = tbl_po_grand.no_pesanan', 'left');
       //  $this->db->group_by('alba_pesanan_barang_hd.number_');

        $kondisi = "( ( (  alba_pesanan_barang_hd.status_po ='" . 6 . "' AND tbl_po_grand.jenis_pesanan ='" . "DLL" . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();


        return $result;
    }


public function get_stok_barang_forecast($Kode_Barang) {
    $this->db->select('*');
    $this->db->where([
        'itemNo' => $Kode_Barang,
        'status_awal' => 'Forecast',
        'kd_cst' => 'P54736',
        'status_proses_pr' => '3'
    ]);
    $this->db->where('status_qr !=', 'Selesai'); // Menambahkan kondisi untuk status_qr
    $this->db->where('quantity >', 0); // Kondisi quantity > 0
    $query = $this->db->get('alba_permintaan_barang_dt');
    return $query->row();
}

    public function kurangi_stok_forecast($qty,$id_forecast){
        $query = $this->db->set('quantity', 'quantity-' . $qty, false);
        $query = $this->db->where('id_dt', $id_forecast);
        $query = $this->db->update('alba_permintaan_barang_dt');
        return $query;
    }

    public function cek_id($id_karyawan)
    {
        $query_str = $this->db->where('qr_code', $id_karyawan)
                              ->get('alba_pesanan_barang_dt');
        if ($query_str->num_rows() > 0) {
            return $query_str->row();
        } else {
            return false;
        }
    }

    public function cek_kehadiran($id_karyawan)
    {

        $query_str =
            $this->db->where('qr_code', $id_karyawan)->get('alba_pesanan_barang_dt');
        if ($query_str->num_rows() > 0) {
            return $query_str->row();
        } else {
            return false;
        }
    }

    public function absen_pulang($id_karyawan, $data)
    {
        
        $tgl = date('Y-m-d');
        return $this->db->where('qr_code', $id_karyawan)
            ->update('alba_pesanan_barang_dt', $data);
    }

 
 }
