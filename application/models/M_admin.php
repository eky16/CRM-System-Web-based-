<?php

class M_admin extends CI_Model{
	protected $_table = 'cassa_kehadiran';
    protected $_table_dept = 'alba_department';
    protected $_table_log = 'cassa_log';
    protected $_table_log_absensi = 'cassa_audit_kehadiran';
	protected $_table_status = 'alba_department';
    protected $_table_leads = 'leads_project';
     protected $_timestamps = TRUE;
     protected $_primary_filter = 'intval';

     protected $_table_name = 'cassa_kehadiran';
      protected $_primary_key = 'id';

    public function save($data, $id = NULL) {

        // Set timestamps
        if ($this->_timestamps == TRUE) {
          //  $now = date('Y-m-d H:i:s');
          //  $id || $data['created'] = $now;
           // $data['modified'] = $now;
        }

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
    public function lihat(){
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function lihat_department(){
        $query = $this->db->get($this->_table_dept);
        return $query->result();
    }

   function get_atasan(){
        $query = $this->db->get('alba_karyawan');
        return $query;  
    }
    public function lihat_aktif(){
        $query = $this->db->get_where($this->_table, 'Active = 1');
        return $query->result();
    }
public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }

public function tambah_log_absensi($atdnc_login){
        return $this->db->insert($this->_table_log_absensi, $atdnc_login);
    }
public function get_karyawan_percobaan() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('alba_karyawan');
        $kondisi = "( (  (alba_karyawan.Active='" . 1 . "' ) AND (alba_karyawan.perjanjian_kerja='" . "PERCOBAAN" . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function get_karyawan_kontrak() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('alba_karyawan');
        $kondisi = "( (  (alba_karyawan.Active='" . 1 . "' ) AND (alba_karyawan.perjanjian_kerja='" . "KONTRAK" . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function get_karyawan_tetap() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('alba_karyawan');
        $kondisi = "( (  (alba_karyawan.Active='" . 1 . "' ) AND (alba_karyawan.perjanjian_kerja='" . "TETAP" . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_nonaktif(){
        $query = $this->db->get_where($this->_table, 'Active = 2');
        return $query->result();
    }
      public function get_add_department_by_id($id_dept) {
        $this->db->select('alba_department.department', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->from('alba_department');
        $this->db->join('alba_divisi', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->where('alba_department.id_dept', $id_dept);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

   function get_department(){
        $query = $this->db->get('alba_department');
        return $query;  
    }

    public function cekkodeemployee()
    {
        $query = $this->db->query("SELECT MAX(EmployeeID) as EmployeeID from alba_karyawan");
        $hasil = $query->row();
        return $hasil->EmployeeID;
    }
    
   function get_divisi(){
        $query = $this->db->get('alba_divisi');
        return $query;  
    }

    public function get_pengumuman_aktif($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('tbl_pengumuman');
        $kondisi = "( (  ( tbl_pengumuman.status_p ='" . 1 . "') ) )";
        $this->db->where($kondisi);
        $this->db->order_by('tbl_pengumuman.createdtime_p','DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_pengumuman_nonaktif_p($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('tbl_pengumuman');
        $kondisi = "( (  ( tbl_pengumuman.status_p ='" . 2 . "') ) )";
        $this->db->where($kondisi);
        $this->db->order_by('tbl_pengumuman.createdtime_p','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_pengumuman_aktif_p($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('tbl_pengumuman');
        $kondisi = "( (  ( tbl_pengumuman.status_p ='" . 1 . "') ) )";
        $this->db->where($kondisi);
        $this->db->order_by('tbl_pengumuman.createdtime_p','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function get_pengumuman_ubah($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('tbl_pengumuman');
        $this->db->where('tbl_pengumuman.id_p', $id);
        $this->db->order_by('tbl_pengumuman.createdtime_p','ASC');
            if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_pengumuman.id_p', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
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

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['EmployeeID' => $id]);
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
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
	public function ubah111($atdnc_data2, $id_mom){
    $this->db->where('id_mom',$id_mom);
    $this->db->update('cassa_mom', $atdnc_data2);
    return TRUE;
	}
    public function ubah4($data, $id){
    $this->db->where('id',$id);
    $this->db->update('cassa_mom', $data);
    return TRUE;
    }
	public function save_mom_goal($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_mom_history WHERE id_mom = '{$atdnc_data['id_mom']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_mom_history', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_mom ='" . $atdnc_data['id_mom'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_mom_history', $atdnc_data); 
    }
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['EmployeeID' => $id]);
	}


	public function save_absensi($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_kehadiran WHERE EmployeeID = '{$atdnc_data['EmployeeID']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_kehadiran', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( EmployeeID ='" . $atdnc_data['EmployeeID'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_kehadiran', $atdnc_data); 
    }
	}

public function save_ya($atdnc_data) 
{
    $query = $this->db->query("SELECT * FROM cassa_kehadiran WHERE EmployeeID = '{$atdnc_data['EmployeeID']}'  and tanggal = '{$atdnc_data["tanggal"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_kehadiran', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( EmployeeID ='" . $atdnc_data['EmployeeID'] . "') AND (tanggal='" . $atdnc_data["tanggal"] . "' )) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('cassa_kehadiran', $atdnc_data); 
    }
}
    public function save_log_absensi($atdnc_login) 
    {
    $query = $this->db->query("SELECT * FROM employee_login WHERE username = '{$atdnc_login['username']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('employee_login', $atdnc_login); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( username ='" . $atdnc_login['username'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('employee_login', $atdnc_login); 
    }
    }

    public function save_doc($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_doc WHERE EmployeeID = '{$atdnc_data['EmployeeID']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_doc', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( EmployeeID ='" . $atdnc_data['EmployeeID'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_doc', $atdnc_data); 
    }
    }


    public function update_asset_terpakai($atdnc) 
    {
    $query = $this->db->query("SELECT * FROM cassa_asset WHERE kode_asset = '{$atdnc['kode_asset']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_asset', $atdnc); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_asset ='" . $atdnc['kode_asset'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_asset', $atdnc); 
    }
    }


  	public function view_profile($id = NULL) { 
        $this->db->select('cassa_doc.*', FALSE);
        $this->db->select('cassa_asset.*', FALSE);
        
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->join('cassa_doc', 'cassa_doc.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        
		$this->db->where('alba_karyawan.id', $id);

    	if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        	$this->db->where('alba_karyawan.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }   
    public function view_profile_employee($id = NULL) { 
        $this->db->select('cassa_doc.*', FALSE);
        $this->db->select('cassa_asset.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->join('cassa_doc', 'cassa_doc.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        
        $this->db->where('alba_karyawan.EmployeeID', $id);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('alba_karyawan.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }   
    public function view_all($id = NULL) { 
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
       // $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->from('alba_karyawan');
     //   $this->db->join('cassa_kehadiran', 'alba_karyawan.EmployeeID  = cassa_kehadiran.EmployeeID', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
      //  $this->db->order_by('cassa_kehadiran.tanggal','DESC');
      //  $now = date('Y-m-d');
       
        if (!empty($id)) {
      //  $this->db->where('cassa_kehadiran.tanggal',  $now);
            $query_result = $this->db->get();
             $result = $query_result->result();
        } else {
           
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
        return $result;

    } 

   public function absen_filter_tanggal($date,$date1,$EmployeeID) {     

       // $besok = date('Y-m-d');
        $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_kehadiran'); 
        $this->db->join('cassa_kategori_izin', 'cassa_kehadiran.kategori_izin  = cassa_kategori_izin.id_izin', 'left');
        $this->db->join('alba_karyawan', 'cassa_kehadiran.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        $this->db->where('cassa_kehadiran.tanggal BETWEEN 
            \''. date('Y-m-d', strtotime($date))."'
            and 
            '". date('Y-m-d', strtotime($date1)).'\'
            ');
        $this->db->where('cassa_kehadiran.EmployeeID', $EmployeeID);
        $this->db->order_by('cassa_kehadiran.tanggal','DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        

        return $result;
    }
      public function absen_filter_tanggal_all($date,$date1) {     

       // $besok = date('Y-m-d');
        $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_kehadiran'); 
        $this->db->join('cassa_kategori_izin', 'cassa_kehadiran.kategori_izin  = cassa_kategori_izin.id_izin', 'left');
        $this->db->join('alba_karyawan', 'cassa_kehadiran.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        $this->db->where('cassa_kehadiran.tanggal BETWEEN 
            \''. date('Y-m-d', strtotime($date))."'
            and 
            '". date('Y-m-d', strtotime($date1)).'\'
            ');
        $this->db->order_by('alba_karyawan.nama_karyawan','ASC');
        $this->db->order_by('cassa_kehadiran.tanggal','DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        

        return $result;
    }
       public function sum_attendance($date,$date1) {
        
        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in < "09:15"
        and
        cassa_kehadiran.cek_out >= "17:55"
        THEN 1
        END) AS hadir');



        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in <= "09:15"
        and
        cassa_kehadiran.cek_out >= "00:00"
         AND
               cassa_kehadiran.cek_out < "06:00"
         AND
        cassa_kehadiran.kategori_izin = 12
        THEN 1
        END) AS hadir_lembur');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in = " "
        AND
        cassa_kehadiran.cek_out >= "15:00"
        AND
        cassa_kehadiran.kategori_izin != 15
        AND
        cassa_kehadiran.kategori_izin != 10
        THEN 1
        END) AS lupa_absen_datang'); 

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in > "00:00"
        AND
        cassa_kehadiran.cek_out = " "
        AND
        cassa_kehadiran.kategori_izin != 7
        AND
        cassa_kehadiran.kategori_izin != 15
        AND
        cassa_kehadiran.kategori_izin != 10
        THEN 1
        END) AS lupa_absen_pulang'); 

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in >= "09:15"
        AND
        cassa_kehadiran.cek_in <= "13:00"
        AND
        cassa_kehadiran.cek_out != " "
        AND
        cassa_kehadiran.kategori_izin != 15
        THEN 1
        END) AS telat'); 

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =8
        THEN 1
        END) AS cuti');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =7
        THEN 1
        END) AS sakit');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =15
        THEN 1
        END) AS tugas_luar_kantor');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =13
        THEN 1
        END) AS tugas_luar_kota');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =10
        AND
        cassa_kehadiran.cek_in <= "09:10"
        AND
        cassa_kehadiran.cek_out >= "15:00" 
        AND
        cassa_kehadiran.cek_out <= "17:59"
        THEN 1
        END) AS pulang_awal_izinc');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in <= "09:10"
        AND
        cassa_kehadiran.cek_out >= "14:59"
        AND
        cassa_kehadiran.cek_out <= "17:59"
        THEN 1
        END) AS pulang_awal_tanpa_izin');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.cek_in > "00:00"
        AND
        cassa_kehadiran.cek_out >= "09:00"
        AND
        cassa_kehadiran.cek_out <= "14:59"
        THEN 1
        END) AS pulang_awal_potong');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "19:00"
        AND
        cassa_kehadiran.cek_out <= "20:55"
        THEN 1
        END) AS L1');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "20:56"
        AND
        cassa_kehadiran.cek_out <= "21:55"
        THEN 2
        END) AS L2');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "21:56"
        AND
        cassa_kehadiran.cek_out <=  "22:55"
        THEN 3
        END) AS L3');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "22:56"
        AND
        cassa_kehadiran.cek_out <= "23:59"
        THEN 4
        END) AS L4');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "00:00"
        AND
        cassa_kehadiran.cek_out <= "00:55"
        THEN 5
        END) AS L5');

        $this->db->select('SUM(CASE 
        WHEN 
        cassa_kehadiran.kategori_izin =12
        AND
        cassa_kehadiran.cek_out >= "00:56"
        AND
        cassa_kehadiran.cek_out >= "01:55"
        THEN 6
        END) AS L6');

      
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_kehadiran'); 
        $this->db->join('cassa_kategori_izin', 'cassa_kehadiran.kategori_izin  = cassa_kategori_izin.id_izin', 'left');
        $this->db->join('alba_karyawan', 'cassa_kehadiran.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
         $this->db->order_by('alba_department.department'); 
         $this->db->group_by('alba_karyawan.EmployeeID'); 
        $this->db->where('cassa_kehadiran.tanggal BETWEEN 
            \''. date('Y-m-d', strtotime($date))."'
            and 
            '". date('Y-m-d', strtotime($date1)).'\'
            ');
        $this->db->order_by('cassa_kehadiran.tanggal','DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        

        return $result;
    }
   public function absen_hari_ini($tanggal) {

       // $besok = date('Y-m-d');
        $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->from('cassa_kehadiran'); 
        $this->db->join('cassa_kategori_izin', 'cassa_kehadiran.kategori_izin  = cassa_kategori_izin.id_izin', 'left');
        $now = date('Y-m-d');
        $this->db->where('cassa_kehadiran.tanggal', $tanggal);
            $query_result = $this->db->get();
            $result = $query_result->result();
        

        return $result;
    }
   public function view_foto($id = NULL) {
        $this->db->select('cassa_kehadiran.*', FALSE);
        $this->db->from('cassa_kehadiran'); 
        $this->db->where('cassa_kehadiran.id', $id);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('cassa_kehadiran.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
}