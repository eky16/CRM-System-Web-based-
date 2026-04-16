<?php

class M_quotation extends CI_Model{
    protected $_table = 'tbl_payment';
    protected $_table_v = 'tbl_vendor';
    protected $_table_s = 'tbl_supplier';
    

    public function get_data_gambarPenawaran()
{
    $this->db->select("
        alba_quotation_dt.*,

        (SELECT COUNT(*) 
         FROM gambar_penawaran_file 
         WHERE id_quo_dt = alba_quotation_dt.id_quo_dt
        ) as total_gambar
    ");

    $this->db->from('alba_quotation_dt');

    return $this->db->get()->result();
}
    public function get_data_estimasi()
{
    $this->db->select("
        alba_quotation_dt.*,

        (SELECT COUNT(*) 
         FROM alba_estimasi_harga 
         WHERE id_quo_dt1 = alba_quotation_dt.id_quo_dt
        ) as total_estimasi
    ");

    $this->db->from('alba_quotation_dt');

    return $this->db->get()->result();
}

    public function list_reminder($id= null) {
        $this->db->select('alba_karyawan.*', FALSE);

        $this->db->select('alba_quotation_hd.*', FALSE); 
        $this->db->select('alba_quotation_dt.*', FALSE); 
        $this->db->select('alba_customer.nama_cst as nama_cst,alba_customer.alamat_cst ', FALSE);

        $this->db->select("(SELECT COUNT(*) FROM alba_estimasi_harga WHERE alba_estimasi_harga.id_quo_dt1 = alba_quotation_dt.id_quo_dt) as total_estimasi", FALSE);

        $this->db->select("(SELECT COUNT(*) FROM gambar_penawaran_file WHERE gambar_penawaran_file.id_quo_dt = alba_quotation_dt.id_quo_dt) as total_gambar", FALSE);

        $this->db->from('alba_quotation_dt');

        $this->db->join('alba_quotation_hd', 'alba_quotation_hd.number_quo  = alba_quotation_dt.number_request_quo', 'left');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_dt.kd_cst_quo', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID = alba_quotation_hd.kdSales', 'left');
      
        // Prioritas overdue dulu
        $this->db->order_by('DATEDIFF(alba_quotation_dt.follow_up_date, CURDATE())', 'ASC', FALSE);

        // Secondary sorting
        $this->db->order_by('alba_quotation_hd.trans_Date', 'ASC');


        $this->db->where('alba_quotation_hd.status_quo', '2');
            $this->db->having('(total_estimasi = 0 OR total_gambar = 0)');//tampilkan kalau masih ada yang belum


        // Eksekusi query
        $query_result = $this->db->get();
        $result = $query_result->result(); 

        return $result;        
    } 

     public function save_srcLead($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM source_leads WHERE id = '{$atdnc_data['id']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('source_leads', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id ='" . $atdnc_data['id'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('source_leads', $atdnc_data); 
    }
}

    public function save_sgmtBrg($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM segments_barang WHERE id = '{$atdnc_data['id']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('segments_barang', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id ='" . $atdnc_data['id'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('segments_barang', $atdnc_data); 
    }
}
    
    public function lihat_statusQuo_id($id){
        $query = $this->db->get_where('status_quo_sales', ['id' => $id]);
        return $query->row();
    }

    public function lihat_srcLead_id($id){
        $query = $this->db->get_where('source_leads', ['id' => $id]);
        return $query->row();
    }

    public function lihat_id($id){
        $query = $this->db->get_where('segments_barang', ['id' => $id]);
        return $query->row();
    }

    public function hapus_statusQuo($id){
        return $this->db->delete('status_quo_sales', ['id' => $id]);
    }

    public function hapus_srcLead($id){
        return $this->db->delete('source_leads', ['id' => $id]);
    }

    public function hapus_sgmtBrg($id){
        return $this->db->delete('segments_barang', ['id' => $id]);
    }

    public function lihat_statusProgress(){

        $this->db->from('progress_names');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function lihat_statusQuo(){

        $this->db->from('status_quo_sales');
        $this->db->order_by('status', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function lihat_srcLead(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('source_leads');
        $this->db->order_by('source', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function lihat_segmentBarang(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('segments_barang');
        $this->db->order_by('segment_barang', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }
    public function lihat_segment(){
    //  $query = $this->db->get('daftar_barang');
    //  return $query->result();
        $this->db->from('segments');
        $this->db->order_by('segment', 'ASC');
        $query = $this->db->get(); 
        return $query->result();
    }
    


  

    public function save_segmentBarang_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM segments_barang WHERE kd_segment = '{$atdnc_data['kd_segment']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('segments_barang', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kd_segment ='" . $atdnc_data['kd_segment'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('segments_barang', $atdnc_data); 
    }
}
  public function save_status_quo_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM status_quo_sales WHERE kd_status = '{$atdnc_data['kd_status']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('status_quo_sales', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kd_status ='" . $atdnc_data['kd_status'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('status_quo_sales', $atdnc_data); 
    }
}

  public function save_srcLead_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM source_leads WHERE slug = '{$atdnc_data['slug']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('source_leads', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( slug ='" . $atdnc_data['slug'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('source_leads', $atdnc_data); 
    }
}

 public function save_segment_baru($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM segments WHERE slug = '{$atdnc_data['slug']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('segments', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( slug ='" . $atdnc_data['slug'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('segments', $atdnc_data); 
    }
}

function hapus_quo_hd($id)
{
  $this->db->where('number_quo', $id);
  $this->db->delete('alba_quotation_hd');
}
function hapus_quo_history($id)
{
  $this->db->where('no_qt', $id);
  $this->db->delete('alba_quotation_history');
}

function hapus_quo_dt($id) 
{
  $this->db->where('number_request_quo', $id);
  $this->db->delete('alba_quotation_dt');
}

function hapus_quo_dt1($id) 
{
  $this->db->where('id_quo_dt', $id);
  $this->db->delete('alba_quotation_dt');
}

public function update_status_prog($id, $data){
    $this->db->where('id', $id);
    return $this->db->update('alba_quotation_hd', $data);
}

public function update_status_sales($id, $data){
    $this->db->where('id_quo_dt', $id);
    return $this->db->update('alba_quotation_dt', $data);
}
    
public function save_quo_history($data_hs_quo){
        return $this->db->insert('alba_quotation_history', $data_hs_quo);
        
    }

public function cekkode_quotation()
{
    $query = $this->db->query("SELECT MAX(RIGHT(number_quo, 11)) as number_quo from alba_quotation_hd");
    $hasil = $query->row();
    return $hasil->number_quo;
}

public function save_quo_hd($data_hd_quo) 
{
    $query = $this->db->query("SELECT * FROM alba_quotation_hd WHERE number_quo = '{$data_hd_quo['number_quo']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_quotation_hd', $data_hd_quo); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( number_quo ='" . $data_hd_quo['number_quo'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_quotation_hd', $data_hd_quo); 
    }
}

public function save_quo_dt1($data_detail_keluar_quo){ 
    return $this->db->insert_batch('alba_quotation_dt', $data_detail_keluar_quo);
}

public function lihat_quo_status_1($id_lsp = NULL) {
        $this->db->select('alba_quotation_hd.*', FALSE); 
        $this->db->select('count(alba_quotation_dt.number_request_quo) as progres'); 
        $this->db->select('alba_customer.nama_cst', FALSE);
        $this->db->from('alba_quotation_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_hd.kd_cst_quo', 'left');
        $this->db->join('alba_quotation_dt', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'inner');
        $this->db->order_by('alba_quotation_hd.status_quo', 'DESC');
        $this->db->group_by('alba_quotation_hd.number_quo');
        $this->db->select('SUM(CASE 
            WHEN 
            alba_quotation_dt.status_proses_quo = 3
            THEN 1
            else 0
            END) AS proses');


        $kondisi = "( ( (  alba_quotation_hd.status_quo ='" . 1 . "')) )";
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


    
public function lihat_quo_detail_hd($id = NULL) {
        $this->db->select('alba_karyawan.nama_karyawan as sales', FALSE);
        $this->db->select('alba_quotation_hd.*', FALSE); 
        $this->db->select('alba_customer.nama_cst as customer,alba_customer.alamat_cst ', FALSE);
        $this->db->select('progress_names.name as statusProgress', FALSE);


        $this->db->from('alba_quotation_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_hd.kd_cst_quo', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = alba_quotation_hd.kdSales', 'left');
        $this->db->join('progress_names','progress_names.sequence = alba_quotation_hd.status_progress',
        'left');
        $this->db->order_by('alba_quotation_hd.number_1', 'DESC');

       if ($id !== NULL) {
        $this->db->where('alba_quotation_hd.id', $id);
        return $this->db->get()->row();
    }

    return $this->db->get()->result();
}

public function lihat_quo_detail_dt_penawaran($id = NULL) {

        $this->db->select('alba_quotation_dt.*', FALSE);
        $this->db->select('alba_quotation_hd.number_1,alba_quotation_hd.id as id_hd', FALSE); 
        $this->db->select('status_quo_sales.status as status', FALSE);

        $this->db->from('alba_quotation_dt');
        $this->db->join('alba_quotation_hd', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'left');
        $this->db->join(
        'status_quo_sales','status_quo_sales.kd_status = alba_quotation_dt.status_quo_sales',
        'left'
    );

        $kondisi = "( (  (alba_quotation_dt.status_proses_quo='" . "3" . "' )
                    AND (alba_quotation_dt.status_qr_quo='" . "Bisa Estimasi" . "' )) )";
        $this->db->where($kondisi);
        $this->db->where('alba_quotation_hd.id', $id);

        $this->db->order_by('alba_quotation_dt.id_quo_dt','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function lihat_quo_detail_dt($id = NULL) {

        $this->db->select('alba_quotation_dt.*', FALSE);
        $this->db->select('alba_quotation_hd.number_1,alba_quotation_hd.id as id_hd', FALSE); 
        $this->db->select('status_quo_sales.status as status', FALSE);

        $this->db->from('alba_quotation_dt');
        $this->db->join('alba_quotation_hd', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'left');
        $this->db->join(
        'status_quo_sales','status_quo_sales.kd_status = alba_quotation_dt.status_quo_sales',
        'left'
    );

        $kondisi = "( (  (alba_quotation_dt.status_proses_quo='" . "" . "' )) )";
       // $this->db->where($kondisi);
        $this->db->where('alba_quotation_hd.id', $id);

        $this->db->order_by('alba_quotation_dt.id_quo_dt','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

public function lihat_quo_detail_history($id = NULL) {
        $this->db->select(' alba_quotation_history.*', FALSE);
        $this->db->select('alba_quotation_hd.number_quo', FALSE); 
        $this->db->from(' alba_quotation_history');
        $this->db->join('alba_quotation_hd', ' alba_quotation_history.no_qt  = alba_quotation_hd.number_quo', 'left');
        $this->db->where('alba_quotation_hd.id', $id);
        $this->db->order_by('alba_quotation_history.actiontime_qt', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

public function ubah_status_quo($data, $id){
        $query = $this->db->set($data);
        $query = $this->db->where(['id' => $id]);
        $query = $this->db->update('alba_quotation_hd');
        return $query;
    }

public function save_quotation_history($data_hs){
        return $this->db->insert('alba_quotation_history', $data_hs);
    }

public function lihat_quo_detail_dt_aksi($id = NULL) {
        $this->db->select('alba_quotation_dt.*', FALSE);
        $this->db->select('alba_quotation_hd.number_1,alba_quotation_hd.id as id_hd', FALSE); 
        $this->db->from('alba_quotation_dt');
        $this->db->join('alba_quotation_hd', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'left');
        $kondisi = "( (  (alba_quotation_dt.status_proses_quo='" . 2 . "' )) )";
        $this->db->where($kondisi);
        $this->db->where('alba_quotation_hd.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function lihat_quo_detail_dt_aksi_all($id = NULL) {
        
        
        $this->db->select('alba_customer.*', FALSE);
        $this->db->select('alba_quotation_dt.*', FALSE);
        $this->db->select('alba_quotation_hd.number_1,alba_quotation_hd.id as id_hd', FALSE); 
        $this->db->from('alba_quotation_dt');
        $this->db->join('alba_quotation_hd', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'left');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_dt.kd_cst_quo', 'left');

     //   $kondisi = "( (  (alba_quotation_dt.status_proses_pr='" . "" . "' )) )";
       // $this->db->where($kondisi);
        $this->db->where('alba_quotation_hd.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

public function cekkode_pesanan_quo()
{
    $query = $this->db->query("SELECT MAX(kode_otomatis) as kode_otomatis from alba_kode_otomatis WHERE jenis != 'Stok'");
    $hasil = $query->row();
    return $hasil->kode_otomatis;
}

public function cekkode_stok_quo()
{
    $query = $this->db->query("SELECT MAX(kode_otomatis) as kode_otomatis from alba_kode_otomatis WHERE jenis = 'Stok'");
    $hasil = $query->row();
    return $hasil->kode_otomatis;
}
public function save_update_file($update_quo_file) 
    {
        $query = $this->db->query("SELECT * FROM gambar_penawaran_file WHERE id   = '{$update_quo_file['id ']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('gambar_penawaran_file', $update_quo_file); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( id  ='" . $update_quo_file['id'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('gambar_penawaran_file', $update_quo_file); 
        }
    }

public function save_update_quo_dt($update_quo_dt) 
    {
        $query = $this->db->query("SELECT * FROM alba_quotation_dt WHERE id_quo_dt  = '{$update_quo_dt['id_quo_dt']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {

            $this->db->insert('alba_quotation_dt', $update_quo_dt); 
        }
        elseif ($count == 1) {
            $kondisi = "( ( ( id_quo_dt ='" . $update_quo_dt['id_quo_dt'] . "')) )";
            $this->db->where($kondisi);
            $this->db->update('alba_quotation_dt', $update_quo_dt); 
        }
    }

public function lihat_quo_status_post($number_quo = NULL) {
        $this->db->select('alba_quotation_dt.*', FALSE);
        $this->db->select('alba_quotation_hd.*', FALSE); 
        $this->db->select('alba_customer.project_name as nama_project', FALSE);
        $this->db->from('alba_quotation_hd');
        $this->db->join('alba_customer', 'alba_customer.projectNo  = alba_quotation_hd.project', 'left');
        $this->db->join('alba_quotation_dt', 'alba_quotation_dt.number_request  = alba_quotation_hd.number_quo', 'inner');
        $this->db->order_by('alba_quotation_dt.id_quo_dt', 'DESC');
      //  $this->db->group_by('alba_quotation_hd.number_quo');
        
        $this->db->where('alba_quotation_hd.number_quo', $number_quo);
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


public function lihat_item_quo_status($tgl_awal = null, $tgl_akhir = null) {
    $this->db->select('alba_karyawan.*, alba_quotation_hd.*, alba_quotation_dt.*', FALSE); 
    $this->db->select('alba_customer.nama_cst as nama_cst, alba_customer.alamat_cst', FALSE);

    // Subquery untuk filter having
    $this->db->select("(SELECT COUNT(*) FROM alba_estimasi_harga WHERE alba_estimasi_harga.id_quo_dt1 = alba_quotation_dt.id_quo_dt) as total_estimasi", FALSE);
    $this->db->select("(SELECT COUNT(*) FROM gambar_penawaran_file WHERE gambar_penawaran_file.id_quo_dt = alba_quotation_dt.id_quo_dt) as total_gambar", FALSE);

    $this->db->from('alba_quotation_dt');
    $this->db->join('alba_quotation_hd', 'alba_quotation_hd.number_quo = alba_quotation_dt.number_request_quo', 'left');
    $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_quotation_dt.kd_cst_quo', 'left');
    $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID = alba_quotation_hd.kdSales', 'left');

    // FILTER TANGGAL (Hanya jalan jika parameter dikirim)
    // Gunakan trim() untuk memastikan string bukan spasi kosong
    if (!empty(trim($tgl_awal)) && !empty(trim($tgl_akhir))) {
        $this->db->where('alba_quotation_hd.trans_Date >=', $tgl_awal . ' 00:00:00');
        $this->db->where('alba_quotation_hd.trans_Date <=', $tgl_akhir . ' 23:59:59');
    }

    $this->db->where([
        'alba_quotation_dt.status_proses_quo' => '3',
        'alba_quotation_dt.status_qr_quo'     => 'Bisa Estimasi'
    ]);

    // Gabungkan HAVING dalam satu baris agar lebih aman secara sintaks SQL
    $this->db->having('total_estimasi > 0 AND total_gambar > 0');

    $this->db->order_by('alba_quotation_hd.trans_Date', 'ASC');

    return $this->db->get()->result();        
}

public function coba_lihat_item_quo_status($id = null)
{
    $this->db->select([
        'alba_karyawan.*',
        'alba_quotation_hd.*',
        'alba_quotation_dt.*',
        'alba_customer.nama_cst AS nama_cst',
        'alba_customer.alamat_cst'
    ]);

    $this->db->from('alba_quotation_dt');

    $this->db->join(
        'alba_quotation_hd',
        'alba_quotation_hd.number_quo = alba_quotation_dt.number_request_quo',
        'left'
    );

    $this->db->join(
        'alba_customer',
        'alba_customer.kode_cst = alba_quotation_dt.kd_cst_quo',
        'left'
    );

    $this->db->join(
        'alba_karyawan',
        'alba_karyawan.EmployeeID = alba_quotation_hd.kdSales',
        'left'
    );

    $this->db->where("( 
    (alba_quotation_dt.estimasi_harga IS NULL OR alba_quotation_dt.estimasi_harga = '' 
     OR alba_quotation_dt.gambar_penawaran IS NULL OR alba_quotation_dt.gambar_penawaran = '') 
    AND (alba_quotation_dt.status_proses_quo = '3')
)");

    $this->db->order_by('alba_quotation_hd.trans_Date', 'ASC');

    return $this->db->get()->result();
}


public function simpan_qt_dt($data_qt) 
{
    $query = $this->db->query("SELECT * FROM alba_quotation_hd WHERE number_1 = '{$data_qt['number_1']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_quotation_hd', $data_qt); 
    }
 //   elseif ($count == 1) {
  //      $kondisi = "( ( ( number_1 ='" . $data_qt['number_1'] . "')) )";
  //      $this->db->where($kondisi);
  //      $this->db->update('alba_pesanan_barang_hd', $data_qt); 
 //   }
}

public function simpan_kode_terakhir_quo($data_kode_quo) 
{
    $query = $this->db->query("SELECT * FROM alba_kode_otomatis WHERE kode_otomatis = '{$data_kode_quo['kode_otomatis']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_kode_otomatis', $data_kode_quo); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_otomatis ='" . $data_kode_quo['kode_otomatis'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_kode_otomatis', $data_kode_quo); 
    }
}

function save_quo_sattle_dt($number_po,$number_1,$detailName_quo,$id_quo_dt,$status_proses_quo,$detailNotes_quo,$kd_cst_quo){
  //  $this->db->delete('alba_permintaan_barang_dt', ['number_po' => $number_]);
    if( !empty($number_1)) {
        $result = array();
        foreach($detailName_quo AS $key => $val){
           $result[] = array(
            'number_qt'   => $number_po,
            'number_request_quo'   => $number_1,
            'detailName_quo'   => $detailName_quo[$key],           
            'status_proses_quo'   => $status_proses_quo[$key],
            'detailNotes_quo'   => $detailNotes_quo[$key],
            'kd_cst_quo'   =>  $kd_cst_quo,
            'id_quo_dt'   => $id_quo_dt[$key] 
        );
       }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->update_batch('alba_quotation_dt', $result ,'id_quo_dt');
       //  $this->db->delete('alba_pesanan_barang_dt', ['status_proses_pr' => " "]);
   }
}



public function lihat_quo_status_2($id_lsp = NULL) {
        $this->db->select('alba_quotation_hd.*', FALSE); 
        $this->db->select('count(alba_quotation_dt.number_request_quo) as progres'); 
        $this->db->select('alba_customer.nama_cst', FALSE);
        $this->db->from('alba_quotation_hd');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_hd.kd_cst_quo', 'left');
        $this->db->join('alba_quotation_dt', 'alba_quotation_dt.number_request_quo  = alba_quotation_hd.number_quo', 'inner');
        $this->db->order_by('alba_quotation_hd.trans_Date', 'DESC');
        $this->db->group_by('alba_quotation_hd.number_quo');
        $this->db->select('SUM(CASE 
            WHEN 
            alba_quotation_dt.status_qr_quo = "Selesai"
            THEN 1
            else 0
            END) AS proses');


        $kondisi = "( ( (  alba_quotation_hd.status_quo ='" . 2 . "')) )";
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

public function list_reminder_gamPenawaran($id_lsp = null) 
{
    $this->db->select('
        alba_quotation_hd.*,
        alba_quotation_dt.*,
        alba_customer.nama_cst as nama_cst,
        alba_customer.alamat_cst,
        alba_customer.kode_cst
    ', FALSE);
    
    $this->db->from('alba_quotation_dt');
    $this->db->join('alba_quotation_hd', 'alba_quotation_hd.number_quo = alba_quotation_dt.number_request_quo', 'left');
    $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_quotation_dt.kd_cst_quo', 'left');
    
    // Subquery untuk cek apakah ada gambar di tabel gambar_penawaran_file
    $this->db->where("NOT EXISTS (SELECT 1 FROM gambar_penawaran_file WHERE gambar_penawaran_file.id_quo_dt = alba_quotation_dt.id_quo_dt)", NULL, FALSE);
    
    // Kondisi status
    $kondisi = "(alba_quotation_dt.status_proses_quo = '3')";
    $this->db->where($kondisi);
    
    $this->db->order_by('alba_quotation_hd.trans_Date', 'ASC');
    
    $query_result = $this->db->get();
    return $query_result->result();
}


public function lihat_quo_selesai($id = NULL) {
 
    $this->db->select('alba_quotation_hd.*', FALSE); 
$this->db->select('alba_quotation_dt.*', FALSE); 
$this->db->select('alba_customer.nama_cst as nama_cst,alba_customer.alamat_cst ', FALSE);
$this->db->from('alba_quotation_dt');

$this->db->join('alba_quotation_hd', 'alba_quotation_hd.number_quo  = alba_quotation_dt.number_request_quo', 'left');
$this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_quotation_dt.kd_cst_quo', 'left');

$this->db->order_by('alba_quotation_hd.trans_Date', 'ASC');

$kondisi = "(alba_quotation_dt.status_qr_quo IN ('Bisa Estimasi') 
    AND alba_quotation_dt.status_proses_quo = '3')";
$this->db->where($kondisi);

// Eksekusi query
$query_result = $this->db->get();
$result = $query_result->result(); 

return $result;        
}

public function update_status_proses($id_quo_dt, $data){  

    $this->db->where('id_quo_dt', $id_quo_dt);
    return $this->db->update('alba_quotation_dt', $data);

}

public function get_quo_dt_by_id($id_quo_dt) {
    return $this->db->get_where('alba_quotation_dt', ['id_quo_dt' => $id_quo_dt])->row_array();
}




    public function hapus_estimasi($id)
    {
        // Cek apakah data ada
        $cek = $this->db->get_where('alba_estimasi_harga', ['id' => $id])->row();
        if (!$cek) {
            return false; // data tidak ditemukan
        }

        // Hapus data
        $this->db->where('id', $id);
        return $this->db->delete('alba_estimasi_harga'); // akan return TRUE/FALSE
    }


    public function update_number_quo($id_hd, $data_qt) {
    $this->db->where('id', $id_hd);
    return $this->db->update('alba_quotation_hd', $data_qt); // ganti nama tabel jika berbeda
}

    public function hitung_total_quo($id_lsp = NULL) {

    $this->db->select("
        COUNT(alba_quotation_dt.id_quo_dt) as total_quo,

        SUM(
            (SELECT COUNT(*) 
             FROM alba_estimasi_harga 
             WHERE id_quo_dt1 = alba_quotation_dt.id_quo_dt) > 0
        ) as sudah_estimasi,

        SUM(
            (SELECT COUNT(*) 
             FROM gambar_penawaran_file 
             WHERE id_quo_dt = alba_quotation_dt.id_quo_dt) > 0
        ) as sudah_gambar,

        SUM(
            (
                (SELECT COUNT(*) 
                 FROM alba_estimasi_harga 
                 WHERE id_quo_dt1 = alba_quotation_dt.id_quo_dt) > 0
            )
            AND
            (
                (SELECT COUNT(*) 
                 FROM gambar_penawaran_file 
                 WHERE id_quo_dt = alba_quotation_dt.id_quo_dt) > 0
            )
        ) as lengkap
    ", FALSE);

    $this->db->from('alba_quotation_dt');

    $this->db->join(
        'alba_quotation_hd',
        'alba_quotation_hd.number_quo = alba_quotation_dt.number_request_quo',
        'left'
    );

    return $this->db->get()->row();
}
    
    public function hitung_tidak_bisa_estimasi($id_lsp = NULL) {

    $this->db->from('alba_quotation_dt');

    $this->db->where([
        'alba_quotation_dt.status_qr_quo' => 'Tidak Bisa Estimasi',
        'alba_quotation_dt.status_proses_quo' => '3'
    ]);

    return $this->db->count_all_results();
}

    public function hitung_overdue($id_lsp = NULL) {

    $this->db->from('alba_quotation_dt');

    // 🔴 overdue (sudah lewat)
    $this->db->where('DATE(alba_quotation_dt.follow_up_date) < CURDATE()', NULL, FALSE);

    $this->db->where("
    (
        (SELECT COUNT(*) 
         FROM alba_estimasi_harga 
         WHERE id_quo_dt1 = alba_quotation_dt.id_quo_dt) = 0
        OR
        (SELECT COUNT(*) 
         FROM gambar_penawaran_file 
         WHERE id_quo_dt = alba_quotation_dt.id_quo_dt) = 0
    )
", NULL, FALSE);

    return $this->db->count_all_results();
}
}