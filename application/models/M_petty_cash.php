<?php

class M_petty_cash extends CI_Model{
	protected $_table = 'modul_kerja';
    protected $_table_sub = 'modul_kerja_sub';
    protected $_table_log = 'cassa_log';
    protected $_table_chat = 'modul_kerja_chat';
    protected $_table_daily = 'cassa_daily_report_img';
    protected $_table_daily_sub = 'cassa_daily_report_img_sub';
    protected $_table_kontribusi = 'modul_kerja_kontribusi';
	protected $_table_status = 'alba_department';
    protected $_table_leads = 'leads_project';
    protected $_table_id = 'cassa_transaksi_asset';
    protected $_tables = 'tbl_notif';
    protected $_table_status_log = 'tbl_status_log_proyek';


    public function set_action($where, $value, $tbl_name) {
        $this->db->set($value);
        $this->db->where($where);
        $this->db->update($tbl_name);
    }

    public function ubah_comment($data, $kode_barang){
        $query = $this->db->set($data);
        $query = $this->db->where(['kode_barang' => $kode_barang]);
        $query = $this->db->update($this->_table);
        return $query;
    }

    public function lihat_saldo($id = null) { 
        $this->db->select('tbl_petty_cash.*', FALSE);
        $this->db->from('tbl_petty_cash');
        $this->db->where('tbl_petty_cash.jenis', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_petty_cash.jenis', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function lihat_saldo_isi_ulang($id = null) {
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as total_isi_ulang'); 
        $this->db->from('tbl_petty_cash_in_out');
       $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function lihat_saldo_keluar($id = null) {
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as saldo_keluar'); 
        $this->db->from('tbl_petty_cash_in_out');
       $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function lihat_history_topup($id = null) { 
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_in_out');
      //  $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
        $this->db->order_by('tbl_petty_cash_in_out.tgl_log_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_pettycash_out($id = null) { 
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_in_out');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $id);
        $this->db->order_by('tbl_petty_cash_in_out.tgl_log_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
    public function lihat_history_all_pettycash() { 
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_all_pettycash_filter($jenis_pety_cash,$tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $jenis_pety_cash);
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function lihat_history_all_pettycash_filter_count($jenis_pety_cash,$tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $jenis_pety_cash);
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as total_transaksi'); 
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_all_pettycash_filter_count_kredit1($jenis_pety_cash,$tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash', $jenis_pety_cash);
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as total_transaksi'); 
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_all_pettycash_filter_all($tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function lihat_history_all_pettycash_filter_all_count($tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash','Isi Saldo');
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as total_transaksi'); 
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_all_pettycash_filter_all_count_kredit($tanggal,$dan_tanggal = null) { 
        $this->db->where('tbl_petty_cash_in_out.tgl_prosess BETWEEN 
            \''. date('Y-m-d H:i:s', strtotime($tanggal))."'
            and 
            '". date('Y-m-d H:i:s', strtotime($dan_tanggal)).'\'
            ');
        $this->db->where('tbl_petty_cash_in_out.jenis_pety_cash','Saldo Keluar');
        $this->db->select('SUM(tbl_petty_cash_in_out.nominal_petty_cash)  as total_transaksi'); 
        $this->db->select('tbl_petty_cash_list.*', FALSE);
        $this->db->select('tbl_petty_cash_in_out.*', FALSE);
        $this->db->from('tbl_petty_cash_list');
        $this->db->join('tbl_petty_cash_in_out', 'tbl_petty_cash_in_out.kode_topup = tbl_petty_cash_list.kode_pembayaran', 'left');
        $this->db->order_by('tbl_petty_cash_list.date_petty_cash', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function save_topup($atdnc_dat) 
{
    $query = $this->db->query("SELECT * FROM tbl_petty_cash WHERE jenis = '{$atdnc_dat['jenis']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_petty_cash', $atdnc_dat); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( jenis ='" . $atdnc_dat['jenis'] . "') ) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('tbl_petty_cash', $atdnc_dat); 
    }
}
    public function save_topup_log($atdnc_dataa) 
{
    $query = $this->db->query("SELECT * FROM tbl_petty_cash_in_out WHERE tgl_log_petty_cash = '{$atdnc_dataa['tgl_log_petty_cash']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_petty_cash_in_out', $atdnc_dataa); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( tgl_log_petty_cash ='" . $atdnc_dataa['tgl_log_petty_cash'] . "') ) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('tbl_petty_cash_in_out', $atdnc_dataa); 
    }
}
    public function save_topup_all_log($petty_data) 
{
    $query = $this->db->query("SELECT * FROM tbl_petty_cash_list WHERE date_petty_cash = '{$petty_data['date_petty_cash']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_petty_cash_list', $petty_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( date_petty_cash ='" . $petty_data['date_petty_cash'] . "') ) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('tbl_petty_cash_list', $petty_data); 
    }
}
    public function detail_tugas($kode_modul,$id = NULL) {


        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja.kode_modul,modul_kerja.createdtime', FALSE);
        $this->db->select('modul_kerja_sub.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->where('modul_kerja.kode_modul', $kode_modul);
        $this->db->group_by('modul_kerja_sub.tugas');
        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        
         $this->db->where('modul_kerja_sub.kode_modul', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
       public function lihat_dept_id($id){
        $query = $this->db->get_where($this->_table, ['kode_modul' => $id]);
        return $query->row();
    }
    
       public function lihat_dept_id_($kode){
        $query = $this->db->get_where($this->_table, ['kode_modul' => $kode]);
        return $query->row();
    }
public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }
    public function get_employee(){
        $query = $this->db->get('alba_karyawan');
        return $query;
    }
    public function get_proyek(){
        $query = $this->db->get('leads_project');
        return $query;
    }
    public function lihat_div_id($id = NULL) { 
        $this->db->select('modul_kerja_sub.*', FALSE);
        $this->db->from('modul_kerja_sub');
        $this->db->where('modul_kerja_sub.kode_modul',$id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;

    } 
        public function lihat_div_id_($kode = NULL) { 
        $this->db->select('modul_kerja_sub.*', FALSE);
        $this->db->from('modul_kerja_sub');
        $this->db->where('modul_kerja_sub.kode_modul',$kode);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;

    } 
      public function get_add_department_by_id($kode_modul,$id = NULL) {
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja.kode_modul,modul_kerja.createdtime', FALSE);
        $this->db->select('modul_kerja_sub.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->where('modul_kerja.kode_modul', $kode_modul);
       // $this->db->where('modul_kerja_sub.kode_modul', $id);
        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

      public function get_add_department_by_idd($id = NULL) {

       $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja_kontribusi.penerima', FALSE);
        $this->db->select('alba_karyawan.nama_karyawan,alba_karyawan.divisi', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as name_divisi', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('modul_kerja_kontribusi', 'modul_kerja_kontribusi.kode_modul_kontribusi = modul_kerja.kode_modul', 'left');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
        else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->where('modul_kerja.kode_modul', $id);
       // $this->db->where('modul_kerja_sub.kode_modul', $id);
        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('modul_kerja.kode_modul', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
      public function chat_modul_test($kode = NULL) { 
        $this->db->select('modul_kerja_chat.*', FALSE);
        $this->db->select('modul_kerja.kode_modul,modul_kerja.createdtime', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_chat', 'modul_kerja_chat.kode_modul_chat = modul_kerja.kode_modul', 'left');
      //  $this->db->order_by('datediff(tbl_mobil_pentaris.tgl_habis, now())');
        $this->db->order_by('date(modul_kerja_chat.waktu_chat)', 'ASC');
        
         $this->db->where('modul_kerja_chat.kode_modul_chat', $kode);
        $query_result = $this->db->get();
        $result = $query_result->result();

      //  return $result;
        echo json_encode($result);
    }
    function barang_list2(){ 
        $hasil=$this->db->query("SELECT * FROM tbl_notif WHERE status_baca=1");
 return $hasil->result();

    }
     public function notif_penerima($kode = NULL) { 
        $this->db->select('tbl_notif.*', FALSE);
        $this->db->from('tbl_notif');
        
         $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
         $this->db->where('tbl_notif.status_baca', 1);
        $this->db->limit(20);
        $query_result = $this->db->get();
        $result = $query_result->result();

      //  return $result;
        echo json_encode($result);
    }
     public function notif_penerima_count($kode = NULL) { 
        $this->db->select('tbl_notif.*', FALSE);
        $this->db->from('tbl_notif');
        
         $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
         $this->db->where('tbl_notif.status_baca', 1);
        $this->db->limit(10);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
       // echo json_encode($result);
    }


    public function notif_penerima_count_test($kode = NULL) { 

        $this->db->select('tbl_notif.*', FALSE);
        $this->db->from('tbl_notif');
        
         $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
         $this->db->where('tbl_notif.status_baca', 1);
        $this->db->limit(10);
        $query_result = $this->db->get();
        $result = $query_result->result();

       // return $result;
        echo json_encode($result);
    }

         public function notif_penerima_count1($kode = NULL) { 
        $this->db->select('tbl_notif.*', FALSE);
        $this->db->from('tbl_notif');
        
         $this->db->where('tbl_notif.kepada', $this->session->login['nama']);
         $this->db->order_by('tbl_notif.id_notif', 'DESC');
        $this->db->limit(10);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
       // echo json_encode($result);
    }
    public function kontributor($kode = NULL) { 
        $this->db->select('modul_kerja_kontribusi.*', FALSE);
        $this->db->from('modul_kerja_kontribusi');
        
         $this->db->where('modul_kerja_kontribusi.kode_modul_kontribusi', $kode);

        $query_result = $this->db->get();
        $result = $query_result->result();

      //  return $result;
        echo json_encode($result);
    }
      public function chat_modul($id = NULL) { 
        $this->db->select('modul_kerja_chat.*', FALSE);
        $this->db->select('modul_kerja.kode_modul,modul_kerja.createdtime', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_chat', 'modul_kerja_chat.kode_modul_chat = modul_kerja.kode_modul', 'left');
        $this->db->order_by('modul_kerja_chat.waktu_chat', 'DESC');
        
         $this->db->where('modul_kerja_chat.kode_modul_chat', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
       // echo json_encode($result);
    }
    public function lihat_modul() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('tbl_notif', 'tbl_notif.id_modul = modul_kerja.kode_modul', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->select('SUM(CASE 
        WHEN 
        tbl_notif.status_baca = 1
        and
        tbl_notif.kepada = alba_karyawan.nama_karyawan
        THEN 1
        END) AS read_message');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja.status_modul', 1);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

       public function lihat_progress_harian() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);

        $this->db->select('cassa_daily_report_img.*', FALSE);
        $this->db->from('cassa_daily_report_img');

        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');

        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
        $this->db->group_by('cassa_daily_report_img.kode_daily');
        $this->db->where('cassa_daily_report_img.status', 1);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
           public function lihat_progress_harian1() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);

        $this->db->select('cassa_daily_report_img.*', FALSE);
        $this->db->from('cassa_daily_report_img');

        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');

        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
        $this->db->group_by('cassa_daily_report_img.kode_daily');
        $this->db->where('cassa_daily_report_img.status', 2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

        public function lihat_progress_harian_end() {


       $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('cassa_daily_report_img.*', FALSE);
        $this->db->from('cassa_daily_report_img');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');
        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
        $this->db->group_by('cassa_daily_report_img.kode_daily');
        $this->db->where('cassa_daily_report_img.status', 3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

        public function lihat_sum_img($id_lsp = null) {
        $this->db->select('SUM(CASE 
        WHEN 
        cassa_daily_report_img_sub.stts_foto = 1
        THEN 1
        END) AS total_foto');
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
         $this->db->select('cassa_daily_report_img_sub.*', FALSE);
        $this->db->select('cassa_daily_report_img.*', FALSE);
        $this->db->from('cassa_daily_report_img');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('cassa_daily_report_img_sub', 'cassa_daily_report_img_sub.kode_daily = cassa_daily_report_img.kode_daily', 'left');
        $this->db->join('leads_project', 'leads_project.nama_project = cassa_daily_report_img.proyek', 'left');
        $this->db->group_by('cassa_daily_report_img_sub.tgl_upload');
        $this->db->order_by('cassa_daily_report_img_sub.tgl_upload','DESC');
        $this->db->where('leads_project.id_lsp', $id_lsp);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function lihat_issue_hd($id_lsp = null) {

        $this->db->select('SUM(CASE 
        WHEN 
        tbl_issue_sub.proglem_solved = " "
        THEN 1
        END) AS hitung');

        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('tbl_issue.*', FALSE);
        $this->db->from('tbl_issue');
        $this->db->join('alba_karyawan', 'alba_karyawan.nama_karyawan = tbl_issue.created_issue', 'left');
        $this->db->join('tbl_issue_sub', 'tbl_issue_sub.kode_issue = tbl_issue.kode_issue', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp = tbl_issue.id_lsp_issue', 'left');
        $this->db->order_by('tbl_issue.created_time_issue','ASC');
        $this->db->group_by('tbl_issue.kode_issue');
        $this->db->where('leads_project.id_lsp', $id_lsp);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function lihat_checklist($id_lsp = null) {

        $this->db->select('SUM(CASE 
        WHEN 
        tbl_ceklist_sub.foto_sesudah = " "
        THEN 1
        END) AS hitung');
        
        $this->db->select('SUM(CASE 
        WHEN 
        tbl_ceklist_sub.foto_sesudah != " "
        THEN 1
        else 0
        END) AS hitung_persen');
        $this->db->select('SUM(CASE 
        WHEN 
        tbl_ceklist_sub.foto_sebelum != " " 
        THEN 1
        END) AS hitung_sub');  

        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('tbl_ceklist.*', FALSE);
        $this->db->from('tbl_ceklist');
        $this->db->join('alba_karyawan', 'alba_karyawan.nama_karyawan = tbl_ceklist.user_ceklist', 'left');
        $this->db->join('tbl_ceklist_sub', 'tbl_ceklist_sub.kode_ceklist = tbl_ceklist.kode_ceklist', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp = tbl_ceklist.id_lsp_ceklist', 'left');
        $this->db->order_by('tbl_ceklist.tgl_ceklist','ASC');
        $this->db->group_by('tbl_ceklist.kode_ceklist');
        $this->db->where('leads_project.id_lsp', $id_lsp);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function lihat_hd_checklist($id_ceklist = null) {

        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('tbl_ceklist.*', FALSE);
        $this->db->from('tbl_ceklist');
        $this->db->join('alba_karyawan', 'alba_karyawan.nama_karyawan = tbl_ceklist.user_ceklist', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp = tbl_ceklist.id_lsp_ceklist', 'left');
        $this->db->order_by('tbl_ceklist.tgl_ceklist','ASC');
        $this->db->where('tbl_ceklist.kode_ceklist', $id_ceklist);
       // $this->db->group_by('tbl_ceklist.kode_issue');
            if (!empty($id_ceklist)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
           $this->db->where('tbl_ceklist.kode_ceklist', $id_ceklist);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
        public function lihat_dt_checklist($id_ceklist = null) {

        $this->db->select('tbl_ceklist_sub.*', FALSE);    
        $this->db->select('tbl_ceklist.*', FALSE);
        $this->db->from('tbl_ceklist');
        $this->db->join('tbl_ceklist_sub', 'tbl_ceklist_sub.kode_ceklist = tbl_ceklist.kode_ceklist', 'left');

        $this->db->where('tbl_ceklist.kode_ceklist', $id_ceklist);
       // $this->db->group_by('tbl_ceklist.kode_issue');
           $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function lihat_issue_hd_dt($id_lsp = null) {

        $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('tbl_issue.*', FALSE);
        $this->db->from('tbl_issue');
        $this->db->join('alba_karyawan', 'alba_karyawan.nama_karyawan = tbl_issue.created_issue', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp = tbl_issue.id_lsp_issue', 'left');
        $this->db->order_by('tbl_issue.created_time_issue','DESC');
        $this->db->where('tbl_issue.kode_issue', $id_lsp);

            if (!empty($id_lsp)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
           $this->db->where('tbl_issue.kode_issue', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }

            public function lihat_issue_dt($id_lsp = null) {

        $this->db->select('tbl_issue_sub.*', FALSE);
        $this->db->select('tbl_issue.*', FALSE);
        $this->db->from('tbl_issue');

        $this->db->join('tbl_issue_sub', 'tbl_issue_sub.kode_issue = tbl_issue.kode_issue', 'left');
        $this->db->order_by('tbl_issue_sub.id_sub_issue','DESC');
        $this->db->where('tbl_issue_sub.kode_issue', $id_lsp);
           $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
      public function lihat_view_img($id_lsp,$tgl_upload = null) { 
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('cassa_daily_report_img_sub.*', FALSE);
        $this->db->select('cassa_daily_report_img.durasi', FALSE);
        $this->db->from('cassa_daily_report_img');
        $this->db->join('cassa_daily_report_img_sub', 'cassa_daily_report_img_sub.kode_daily = cassa_daily_report_img.kode_daily', 'left');
                $this->db->join('leads_project', 'leads_project.nama_project = cassa_daily_report_img.proyek', 'left');


        $this->db->where('leads_project.id_lsp', $id_lsp);
        $this->db->where('cassa_daily_report_img_sub.tgl_upload', $tgl_upload);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
          public function lihat_modul_leads($id_lsp = null) {
                    $this->db->select('alba_department.*', FALSE);
        $this->db->select('alba_divisi.divisi as devisi', FALSE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('leads_project', 'leads_project.nama_project = modul_kerja.nama_proyek', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('leads_project.id_lsp', $id_lsp);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

        public function lihat_status_log_proyek($id_lsp = null) {
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);

        $this->db->select('leads_project.*', FALSE);
        $this->db->select('tbl_status_log_proyek.*', FALSE);
        $this->db->from('tbl_status_log_proyek');
        $this->db->join('leads_project', 'leads_project.id_lsp = tbl_status_log_proyek.id_lsp_proyek', 'left');
         $this->db->join('alba_karyawan', 'alba_karyawan.nama_karyawan = tbl_status_log_proyek.operator', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('tbl_status_log_proyek.tgl_create', 'ASC');
        $this->db->group_by('tbl_status_log_proyek.id_stts_log', 'ASC');
        $this->db->where('leads_project.id_lsp', $id_lsp);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function lihat_modul_proses() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('tbl_notif', 'tbl_notif.id_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');


        $this->db->select('SUM(CASE 
        WHEN 
        tbl_notif.status_baca = 1
        and
        tbl_notif.kepada = alba_karyawan.nama_karyawan
        THEN 1
        END) AS read_message');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja.status_modul', 2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function my_daily_report() { 
        $this->db->select('cassa_daily_report_img.*', FALSE); 
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);    
        $this->db->from('cassa_daily_report_img');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');
        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
        $this->db->group_by('cassa_daily_report_img.kode_daily');
         $this->db->where('alba_karyawan.nama_karyawan', $this->session->login['nama']);
        $this->db->where('cassa_daily_report_img.status',1);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
            public function my_daily_report_p() { 
        $this->db->select('cassa_daily_report_img.*', FALSE); 
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);    
        $this->db->from('cassa_daily_report_img');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');
        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
         $this->db->where('alba_karyawan.nama_karyawan', $this->session->login['nama']);
         $this->db->group_by('cassa_daily_report_img.kode_daily');
        $this->db->where('cassa_daily_report_img.status',2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

                public function my_daily_report_f() { 
        $this->db->select('cassa_daily_report_img.*', FALSE); 
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);    
        $this->db->from('cassa_daily_report_img');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = cassa_daily_report_img.karyawan', 'left');
        $this->db->order_by('cassa_daily_report_img.waktu', 'DESC');
         $this->db->where('alba_karyawan.nama_karyawan', $this->session->login['nama']);
         $this->db->group_by('cassa_daily_report_img.kode_daily');
        $this->db->where('cassa_daily_report_img.status',3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function my_modul() { 

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('tbl_notif', 'tbl_notif.id_modul = modul_kerja.kode_modul', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->select('SUM(CASE 
        WHEN 
        tbl_notif.status_baca = 1
        and
        tbl_notif.kepada = alba_karyawan.nama_karyawan
        THEN 1
        END) AS read_message');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
         $this->db->where('alba_karyawan.EmployeeID', $this->session->login['kode']);
        $this->db->where('modul_kerja.status_modul',1);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function my_created_modul() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas ', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja.createdby', $this->session->login['nama']);
        $this->db->where('modul_kerja.status_modul',1);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
      public function my_modul_proses() {
        $kepada =$this->session->login['kode'];
        
        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 1
        and
        tbl_notif.status_baca = 1
        and
        tbl_notif.kepada = alba_karyawan.nama_karyawan
        THEN 1
        END) AS read_message');

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('tbl_notif', 'tbl_notif.id_modul = modul_kerja.kode_modul', 'left');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

  

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->group_by('modul_kerja_sub.status_tugas');
        $this->db->where('alba_karyawan.EmployeeID', $this->session->login['kode']);
        $this->db->where('modul_kerja.status_modul',2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

       public function my_modul_ubah($id = NULL) {
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);

        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
                $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
                $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');
        $this->db->where('modul_kerja.kode_modul', $id);
       // $this->db->where('modul_kerja_sub.kode_modul', $id);
        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('modul_kerja.kode_modul', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
          public function my_modul_user_proses() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
         $this->db->where('modul_kerja.createdby', $this->session->login['nama']);
        $this->db->where('modul_kerja.status_modul',2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

public function my_modul_proses_kontribut() {
        $this->db->select('modul_kerja_kontribusi.kode_modul_kontribusi', FALSE);
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas ', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('modul_kerja_kontribusi', 'modul_kerja_kontribusi.kode_modul_kontribusi = modul_kerja.kode_modul', 'left');
        $this->db->join('tbl_notif', 'tbl_notif.id_modul = modul_kerja.kode_modul', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->select('SUM(CASE 
        WHEN 
        tbl_notif.status_baca = 1
        and
        tbl_notif.kepada = modul_kerja_kontribusi.penerima
        THEN 1
        END) AS read_message');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja_kontribusi.penerima', $this->session->login['nama']);
        $this->db->where('modul_kerja.status_modul',2);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function kontribut_finish() {
        $this->db->select('modul_kerja_kontribusi.kode_modul_kontribusi', FALSE);
        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');
        $this->db->join('modul_kerja_kontribusi', 'modul_kerja_kontribusi.kode_modul_kontribusi = modul_kerja.kode_modul', 'left');
        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja_kontribusi.penerima', $this->session->login['nama']);
        $this->db->where('modul_kerja.status_modul',3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function my_modul_finish() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
         $this->db->where('alba_karyawan.EmployeeID', $this->session->login['kode']);
        $this->db->where('modul_kerja.status_modul',3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
       public function my_modul_finish_user() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
         $this->db->where('modul_kerja.createdby', $this->session->login['nama']);
        $this->db->where('modul_kerja.status_modul',3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
            public function modul_finish() {

        $this->db->select('alba_karyawan.nama_karyawan', FALSE);
        $this->db->select('modul_kerja_sub.kode_modul as code_modul,modul_kerja_sub.tugas', FALSE);
        $this->db->select('modul_kerja.*', FALSE);
        $this->db->from('modul_kerja');
        $this->db->join('modul_kerja_sub', 'modul_kerja_sub.kode_modul = modul_kerja.kode_modul', 'inner');
        $this->db->join('alba_karyawan', 'alba_karyawan.email = modul_kerja.to', 'left');

        $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas = 3
        THEN 1
         else 0
        END) AS proses');

       $this->db->select('SUM(CASE 
        WHEN 
        modul_kerja_sub.status_tugas 
        THEN 1
        END) AS progres');

        $this->db->order_by('modul_kerja.createdtime', 'DESC');
        $this->db->group_by('modul_kerja.kode_modul');
        $this->db->where('modul_kerja.status_modul',3);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function check_by($where, $tbl_name) {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

       public function save($data, $id = NULL) {

        // Set timestamps


        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

   function get_department(){
        $query = $this->db->get('alba_department');
        return $query;  
    }
    
   function get_jabatan(){
        $query = $this->db->get('alba_divisi');
        return $query;  
    }

   function get_atasan(){
        $query = $this->db->get('alba_karyawan');
        return $query;  
    }
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
		return $this->db->insert($this->_table, $data);
	}
    public function kode_modul(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_modul,2)) AS kode_modul FROM modul_kerja WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_modul)+1;
                $kd = sprintf("%02s", $tmp);
            }
        }else{
            $kd = "01";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dm').$kd;  
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


    public function hapus2($id){
        return $this->db->delete($this->_table_status_log, ['id_stts_log' => $id]);
    }

	public function hapus($id){
		return $this->db->delete($this->_table, ['kode_modul' => $id]);
	}
    public function hapus_sub($id){
        return $this->db->delete($this->_table_sub, ['kode_modul' => $id]);
    }


        public function hapus_kontributor($id){
        return $this->db->delete($this->_table_kontribusi, ['kode_modul_kontribusi' => $id]);
    }
        public function hapus_chat($id){
        return $this->db->delete($this->_table_chat, ['kode_modul_chat' => $id]);
    }
    function create_package($kode_modul,$tugas,$email,$createdby,$nama_proyek,$tempo){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'kode_modul' => $kode_modul,
                'to' => $email,
                'nama_proyek' => $nama_proyek,
                'tempo' => $tempo,
                'createdby' => $createdby,
                'createdtime' => date('Y-m-d H:i:s') 
            );
            $this->db->insert('modul_kerja', $data);
            //GET ID PACKAGE
          //  $package_id = $this->db->insert_id();
            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $kode_modul,
                      'tugas'   => $_POST['tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();
        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Ditambahkan!');
            redirect('mod_kerja/lihat_semua');
    }

    function create_package_issue($id_lsp_issue,$kode_issue,$ket_issu,$created_time_issue,$created_issue,$issue,$kode_issuee,$judul_issue){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'kode_issue' => $kode_issue,
                'id_lsp_issue' => $id_lsp_issue,
                'judul_issue' => $judul_issue,
                'ket_issu' => $ket_issu,
                'created_issue' => $created_issue,
                'created_time_issue' => $created_time_issue
            );
            $this->db->insert('tbl_issue', $data);
            //GET ID PACKAGE
          //  $package_id = $this->db->insert_id();
               if( !empty($issue) ) {
            $result = array();
                foreach($issue AS $key => $val){
                     $result[] = array(
                      'kode_issue'   => $kode_issuee[$key],
                      'issue'   => $issue[$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_issue_sub', $result);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('error', 'Issue <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Issue <strong>Berhasil</strong> Ditambahkan!');
          redirect('leads/detail/'.$id_lsp_issue.'#issue'); //redirect page
    }
   function create_package_issue_user($id_lsp_issue,$kode_issue,$ket_issu,$created_time_issue,$created_issue,$issue,$kode_issuee,$judul_issue){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'kode_issue' => $kode_issue,
                'id_lsp_issue' => $id_lsp_issue,
                 'judul_issue' => $judul_issue,
                'ket_issu' => $ket_issu,
                'created_issue' => $created_issue,
                'created_time_issue' => $created_time_issue
            );
            $this->db->insert('tbl_issue', $data);
            //GET ID PACKAGE
          //  $package_id = $this->db->insert_id();
               if( !empty($issue) ) {
            $result = array();
                foreach($issue AS $key => $val){
                     $result[] = array(
                      'kode_issue'   => $kode_issuee[$key],
                      'issue'   => $issue[$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_issue_sub', $result);
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('error', 'Issue <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Issue <strong>Berhasil</strong> Ditambahkan!');
          redirect('user/leads/detail/'.$id_lsp_issue.'#issue'); //redirect page
    }
    function insert_notifXX($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2){
    if( !empty($kepadanya) ) {
            $result = array();
                foreach($kepadanya AS $key => $val){
                     $result[] = array(
                      'id_modul'   => $id_modul2[$key],
                      'kepada'   => $kepadanya[$key],
                      'dari'   => $dari2[$key],
                      'noted'   => $noted2[$key],
                      'creat_at'   => $creat_at2[$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_notif', $result);
}
    }
   function create_package_user($kode_modul,$tugas,$email,$createdby,$nama_proyek,$tempo){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'kode_modul' => $kode_modul,
                'to' => $email,
                'nama_proyek' => $nama_proyek,
                'createdby' => $createdby,
                'tempo' => $tempo,
                'createdtime' => date('Y-m-d H:i:s') 
            );
            $this->db->insert('modul_kerja', $data);
            //GET ID PACKAGE
          //  $package_id = $this->db->insert_id();
            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $kode_modul,
                      'tugas'   => $_POST['tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();
        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Ditambahkan!');
            redirect('user/mod_kerja/viewtask');
    }

function insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2){
    if( !empty($kepadanya) ) {
            $result = array();
                foreach($kepadanya AS $key => $val){
                     $result[] = array(
                      'id_modul'   => $id_modul2[$key],
                      'kepada'   => $kepadanya[$key],
                      'dari'   => $dari2[$key],
                      'noted'   => $noted2[$key],
                      'creat_at'   => $creat_at2[$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_notif', $result);
        }
    }
    function update_package($id,$to,$tugas){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
    $this->db->where('kode_modul',$id);
    $this->db->update('modul_kerja', $to);
    //return TRUE;
            //DELETE DETAIL PACKAGE
            $this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $id,
                      'tugas'   => $_POST['tugas'][$key],
                      'status_tugas'   => $_POST['status_tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();

        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Diubah!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Diubah!');
        redirect('mod_kerja/lihat_semua');
    }
    function update_package_user($id,$to,$tugas){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
    $this->db->where('kode_modul',$id);
    $this->db->update('modul_kerja', $to);
    //return TRUE;
            //DELETE DETAIL PACKAGE
            $this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $id,
                      'tugas'   => $_POST['tugas'][$key],
                      'status_tugas'   => $_POST['status_tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();

        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Diubah!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Diubah!');
        redirect('user/mod_kerja/viewtask');
    }


  public function save_batch($data2){ 
    return $this->db->insert_batch('tbl_notif', $data2);  
    }

    function update_package_user_proses($id,$to,$tugas,$result){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
    $this->db->where('kode_modul',$id);
    $this->db->update('modul_kerja', $to);
    //return TRUE;
            //DELETE DETAIL PACKAGE
            $this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $id,
                      'tugas'   => $_POST['tugas'][$key],
                      'berkas_file'   => $berkasnya[$key],
                      'status_tugas'   => $_POST['status_tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();

        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Diubah!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Diubah!');
        redirect('user/mod_kerja/proses');
    } 
    function user_update_package($id,$to,$tugas){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
    $this->db->where('kode_modul',$id);
    $this->db->update('modul_kerja', $to);
    //return TRUE;
            //DELETE DETAIL PACKAGE
            $this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

            $result = array();
                foreach($tugas AS $key => $val){
                     $result[] = array(
                      'kode_modul'   => $id,
                      'tugas'   => $_POST['tugas'][$key],
                      'status_tugas'   => $_POST['status_tugas'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('modul_kerja_sub', $result);
        $this->db->trans_complete();

        $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Diubah!');
        $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Diubah!');
        redirect('user/mod_kerja/proses');
    }
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }


        public function tampil_asset($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_asset');
        $this->db->where('cassa_asset.status', 'TERSEDIA');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('cassa_asset.status','TERSEDIA');
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    } 

     public function dadadada($data) 
    {
    $query = $this->db->query("SELECT * FROM modul_kerja_sub WHERE  id_sub = '{$data["id_sub"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja_sub', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( (id_sub='" . $data["id_sub"] . "' )) )";
        $this->db->where($kondisi);
        $this->db->update('modul_kerja_sub', $data); 
    }
    }
     public function save_problemsolve($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_issue_sub WHERE  id_sub_issue = '{$atdnc_data["id_sub_issue"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_issue_sub', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( (id_sub_issue='" . $atdnc_data["id_sub_issue"] . "' )) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_issue_sub', $atdnc_data); 
    }
    }
     public function savedaily($atnd) 
    {
    $query = $this->db->query("SELECT * FROM cassa_daily_report_img WHERE  kode_daily = '{$atnd["kode_daily"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_daily_report_img', $atnd); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( (kode_daily='" . $atnd["kode_daily"] . "' )) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_daily_report_img', $atnd); 
    }
    }

     public function save_mymodul($data) 
    {
    $query = $this->db->query("SELECT * FROM modul_kerja WHERE kode_modul = '{$data['kode_modul']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_modul ='" . $data['kode_modul'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('modul_kerja', $data); 
    }
    }


     public function save_mymodul_picture($atdn) 
    {
    $query = $this->db->query("SELECT * FROM modul_kerja WHERE kode_modul = '{$atdn['kode_modul']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja', $atdn); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_modul ='" . $atdn['kode_modul'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('modul_kerja', $atdn); 
    }
    }


    public function save_end_prosess($atdnc_dat) 
{
    $query = $this->db->query("SELECT * FROM modul_kerja WHERE kode_modul = '{$atdnc_dat['kode_modul']}'  ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja', $atdnc_dat); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_modul ='" . $atdnc_dat['kode_modul'] . "') ) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('modul_kerja', $atdnc_dat); 
    }
}
    public function save_contributor($atdnc_data1) 
{
    $query = $this->db->query("SELECT * FROM modul_kerja_kontribusi WHERE penerima = '{$atdnc_data1['penerima']}'  and kode_modul_kontribusi = '{$atdnc_data1["kode_modul_kontribusi"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja_kontribusi', $atdnc_data1); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( penerima ='" . $atdnc_data1['penerima'] . "') AND (kode_modul_kontribusi='" . $atdnc_data1["kode_modul_kontribusi"] . "' )) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('modul_kerja_kontribusi', $atdnc_data1); 
    }
}
    public function kode_asset(){

        $q = $this->db->query("SELECT MAX(RIGHT(id_asset,4)) AS id_asset FROM cassa_asset WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_asset)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "ASSET".date('dmy').$kd;  
    }
public function save_proses($atdnc_data,$id) 
    {
    $query = $this->db->query("SELECT * FROM modul_kerja WHERE kode_modul = '" . $id . "' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('modul_kerja', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_modul ='" . $id . "')) )";
        $this->db->where($kondisi);
        $this->db->update('modul_kerja', $atdnc_data); 
    }
    }



    function save_unlink_chat($atdnc_data,$id,$kepada){
    $kondisi = "( ( ( id_modul ='" . $id . "' and  kepada ='" . $kepada . "')) )";
    $this->db->where($kondisi);
    $this->db->update('tbl_notif', $atdnc_data);
    return TRUE;
    }
public function save_finish_daily($atdnc_data,$id) 
    {
    $query = $this->db->query("SELECT * FROM cassa_daily_report_img WHERE kode_daily = '" . $id . "' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_daily_report_img', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_daily ='" . $id . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_daily_report_img', $atdnc_data); 
    }
    }

}