<?php

class M_reimburs extends CI_Model{ 
	protected $_table = 'cassa_reimbursement';
    protected $_table_log = 'cassa_log';
    protected $_table_sub = 'cassa_reimbursement_sub';
    protected $_table_i = 'cassa_izin';
    protected $_table_id = 'cassa_transaksi_asset';

    public function get_proyek001() { 
        $this->db->select('leads_project.*', FALSE);   
        $this->db->from('leads_project');
        $this->db->group_by('leads_project.nama_project'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_proyek() { 
        $this->db->select('cassa_reimbursement.*', FALSE);   
        $this->db->from('cassa_reimbursement');
        $this->db->order_by('cassa_reimbursement.name_project', 'DESC');
        $this->db->group_by('cassa_reimbursement.name_project'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function view_reimbus_end_laporan($project = NULL) { 
        $this->db->where('cassa_reimbursement.name_project', $project);
        $this->db->select('SUM(cassa_reimbursement_sub.nominal_tf)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement.tanggal_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        // $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
           $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
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
    public function view_reimbus_end_laporan001($project = NULL) { 
        $this->db->where('leads_project.id_lsp', $project);
        $this->db->select('SUM(cassa_reimbursement_sub.nominal_tf)  as total_reimburs');
        $this->db->select('leads_project.*', FALSE);
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');
        $this->db->join('leads_project', 'leads_project.nama_project = cassa_reimbursement.name_project', 'left');
        $this->db->order_by('cassa_reimbursement.tanggal_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        // $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
           $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
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
        public function view_reimbus_end_laporan_total($project = NULL) { 
        $this->db->select('SUM(CASE 
        WHEN 
        cassa_reimbursement_sub.nominal_tf
        AND
        cassa_reimbursement_sub.status_cek = "OK"
        THEN nominal_tf
        END) AS total_reimburs');

     
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->group_by('cassa_reimbursement.name_project');
        $this->db->where('cassa_reimbursement.name_project', $project);
       // $this->db->where($kondisi);
        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function view_reimbus_end_laporan_total001($project = NULL) { 
        $this->db->where('leads_project.id_lsp', $project);
        $this->db->select('SUM(CASE 
        WHEN 
        cassa_reimbursement_sub.nominal_tf
        AND
        cassa_reimbursement_sub.status_cek = "OK"
        THEN nominal_tf
        END) AS total_reimburs');

        $this->db->select('leads_project.*', FALSE);
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');
        $this->db->join('leads_project', 'leads_project.nama_project = cassa_reimbursement.name_project', 'left');
        $this->db->group_by('cassa_reimbursement.name_project');
       // $this->db->where($kondisi);
        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function view_reimbus_end_laporan_total_leads($id_lsp = NULL) {  
        $this->db->select('SUM(CASE 
        WHEN 
        cassa_reimbursement_sub.nominal_tf
        AND
        cassa_reimbursement_sub.status_cek = "OK"
        THEN nominal_tf
        END) AS total_reimburs');

        $this->db->select('leads_project.*', FALSE);
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('leads_project', 'leads_project.nama_project = cassa_reimbursement.name_project', 'left');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');
        $this->db->group_by('cassa_reimbursement.name_project');
        $this->db->where('leads_project.id_lsp', $id_lsp);
       // $this->db->where($kondisi);
        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function lihat_reimburs1(){
        $query = $this->db->get_where($this->_table, 'status_reimbus = 1');
        return $query->result();
    }
    public function lihat_reimburs2(){
        $query = $this->db->get_where($this->_table, 'status_reimbus = 2');
        return $query->result();
    }
    public function lihat_reimburs3(){
        $query = $this->db->get_where($this->_table, 'status_reimbus = 3');
        return $query->result();
    }
        public function lihat_reimburs4(){
        $query = $this->db->get_where($this->_table, 'status_reimbus = 4');
        return $query->result();
    }
    public function hapus_reimbus($id){
        return $this->db->delete($this->_table, ['kode_reimbus' => $id]);
    }
    public function hapus_reimbus_sub($id){
        return $this->db->delete($this->_table_sub, ['kode_reimbus' => $id]);
    }
     public function insert_hd($data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_reimbursement WHERE  kode_reimbus = '{$data["kode_reimbus"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_reimbursement', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( (kode_reimbus='" . $data["kode_reimbus"] . "' )) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_reimbursement', $data); 
    }
    }

     public function insert_dt($data_dt) 
    {
    $query = $this->db->query("SELECT * FROM cassa_reimbursement_sub WHERE  kategori_reimburs = '{$data_dt["kategori_reimburs"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_reimbursement_sub', $data_dt); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( (kategori_reimburs='" . $data_dt["kategori_reimburs"] . "' )) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_reimbursement_sub', $data_dt); 
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
	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

    public function get_kategori(){
        $query = $this->db->get('cassa_reimbursement_category');
        return $query;
    }

        public function get_kategori_sub(){
        $query = $this->db->get('cassa_reimbursement_category_jenis');
      //  $query = $this->db->order_by('cassa_reimbursement_category_jenis','DESC');
        return $query;
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

        public function kode_reimburs(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_reimbus,2)) AS kode_reimbus FROM cassa_reimbursement WHERE DATE(createddate_reimbus)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_reimbus)+1;
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
    public function save_jenis_rembes($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_reimbursement_category WHERE kategori_reimbus = '{$atdnc_data['kategori_reimbus']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_reimbursement_category', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kategori_reimbus ='" . $atdnc_data['kategori_reimbus'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_reimbursement_category', $atdnc_data); 
    }
    }
    public function set_action($where, $value, $tbl_name) {
        $this->db->set($value);
        $this->db->where($where);
        $this->db->update($tbl_name);
    }
    public function save_proses_cek($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_reimbursement_sub WHERE id_sub = '{$atdnc_data['id_sub']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_reimbursement_sub', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_sub ='" . $atdnc_data['id_sub'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_reimbursement_sub', $atdnc_data); 
    }
    }
    public function my_modul_reimbus() { 
          $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
         $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
        //$this->db->where('cassa_reimbursement.status_reimbus',1);

        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 1 . "' OR cassa_reimbursement.status_reimbus ='" . 2 . "' )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    public function my_modul_reimbus_finish() { 
          $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
         $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
        //$this->db->where('cassa_reimbursement.status_reimbus',1);

        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 3 . "' OR cassa_reimbursement.status_reimbus ='" . 4 . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

      public function my_modul_reimbus_f() { 
          $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
         $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
        //$this->db->where('cassa_reimbursement.status_reimbus',1);

        $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 3 . "' OR cassa_reimbursement.status_reimbus ='" . 4 . "'  )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function detail_reimbus($kode_reimbus,$id = NULL) {
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement_sub.kode_reimbus = cassa_reimbursement.kode_reimbus', 'left');

        $this->db->where('cassa_reimbursement.kode_reimbus', $kode_reimbus);
       
        $this->db->order_by('cassa_reimbursement.createddate_reimbus', 'DESC');
        
         $this->db->where('cassa_reimbursement_sub.kode_reimbus', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
      public function Hitung_total($id = NULL) { 
     //   $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
              $this->db->select('SUM(CASE 
        WHEN 
        cassa_reimbursement_sub.nominal_tf
        AND
        cassa_reimbursement_sub.status_cek = "OK"
        THEN nominal_tf
        END) AS total_reimburs');

     
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');
        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        $this->db->where('cassa_reimbursement_sub.kode_reimbus', $id);
       // $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

          public function get_norek_reimbus($id = NULL) { 
     //   $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');

        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');
        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        $this->db->where('cassa_reimbursement_sub.kode_reimbus', $id);
       // $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function view_reimbus_p() {   
        $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement.createddate_reimbus', 'ASC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        // $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
           $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 1 . "' OR cassa_reimbursement.status_reimbus ='" . 2 . "' )) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
        public function view_reimbus_s() { 
          $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        // $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
           $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 3 . "'  ) ) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
          public function view_reimbus_end() { 
          $this->db->select('SUM(cassa_reimbursement_sub.nominal)  as total_reimburs');
      
        $this->db->select('cassa_reimbursement_sub.*', FALSE);
        $this->db->select('cassa_reimbursement.*', FALSE);
        $this->db->from('cassa_reimbursement');
        $this->db->join('cassa_reimbursement_sub', 'cassa_reimbursement.kode_reimbus = cassa_reimbursement_sub.kode_reimbus', 'left');

        $this->db->order_by('cassa_reimbursement_sub.kode_reimbus', 'DESC');
        $this->db->group_by('cassa_reimbursement.kode_reimbus');
        // $this->db->where('cassa_reimbursement.user_reimbus', $this->session->login['nama']);
           $kondisi = "( ( ( cassa_reimbursement.status_reimbus ='" . 4 . "'  ) ) )";
        $this->db->where($kondisi);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
      public function get_add_reimburs_by_id($kategori_reimbus) {
        $this->db->select('cassa_reimbursement_category.kategori_reimbus', FALSE);
        $this->db->select('cassa_reimbursement_category_jenis.*', FALSE);
        $this->db->from('cassa_reimbursement_category');
        $this->db->join('cassa_reimbursement_category_jenis', 'cassa_reimbursement_category.kategori_reimbus = cassa_reimbursement_category_jenis.kategori_reimbus', 'left');
        $this->db->where('cassa_reimbursement_category.kategori_reimbus', $kategori_reimbus);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
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

        public function save_izin($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_izin WHERE kode_izin = '{$atdnc_data['kode_izin']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_izin', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_izin ='" . $atdnc_data['kode_izin'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_izin', $atdnc_data); 
    }
    }

    public function approve_izin($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_izin WHERE kode_izin = '{$atdnc_data['kode_izin']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_izin', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_izin ='" . $atdnc_data['kode_izin'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_izin', $atdnc_data); 
    }
    }

    public function persetujuan_atasan($dept = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 1 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }  
        public function butuh_persetujuan($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
        $this->db->where('alba_karyawan.supervisorID', $this->session->login['kode']);
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 1 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
        public function butuh_persetujuan_hrd($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
        $this->db->where('alba_karyawan.supervisorID', $this->session->login['kode']);
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 2 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
        public function telah_disetujui_hrd($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
        $this->db->where('alba_karyawan.supervisorID', $this->session->login['kode']);
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 3 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 

    public function telah_ditolak_hrd($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
        $this->db->where('alba_karyawan.supervisorID', $this->session->login['kode']);
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 4 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
        public function my_persetujuan_atasan($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 1 . "') AND (alba_karyawan.Active='" . 1 . "' )AND (cassa_izin.EmployeeID='" . $id . "' )) )";
       
        $this->db->where($kondisi);
      //  $this->db->where('alba_karyawan.EmployeeID', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->result();
        } else {
            // $this->db->where('alba_karyawan.EmployeeID', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }  
    public function my_persetujuan_hrd($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 2 . "') AND (alba_karyawan.Active='" . 1 . "' )AND (cassa_izin.EmployeeID='" . $id . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->result();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    } 
    public function my_disetujui($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 3 . "') AND (alba_karyawan.Active='" . 1 . "' )AND (cassa_izin.EmployeeID='" . $id . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->result();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    } 

        public function my_ditolak($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 4 . "') AND (alba_karyawan.Active='" . 1 . "' )AND (cassa_izin.EmployeeID='" . $id . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->result();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    } 
        public function persetujuan_hrd($dept = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
         $this->db->select('cassa_kategori_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('cassa_kategori_izin', 'cassa_kategori_izin.jenis  = cassa_izin.kategori', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 2 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    } 

       public function disetujui($dept = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 3 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    } 

        public function ditolak($dept = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->select('cassa_izin.*', FALSE);
        $this->db->from('cassa_izin');
        $this->db->join('alba_karyawan', 'alba_karyawan.EmployeeID  = cassa_izin.EmployeeID', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('cassa_izin.tgl_pengajuan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (cassa_izin.status='" . 4 . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function save_ya($atdnc_dat) 
{
    $query = $this->db->query("SELECT * FROM cassa_kehadiran WHERE EmployeeID = '{$atdnc_dat['EmployeeID']}'  and tanggal = '{$atdnc_dat["tanggal"]}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_kehadiran', $atdnc_dat); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( EmployeeID ='" . $atdnc_dat['EmployeeID'] . "') AND (tanggal='" . $atdnc_dat["tanggal"] . "' )) )";
        $this->db->where($kondisi);
       // $this->db->where('userid', $atdnc_data['userid'] OR 'date', $atdnc_data["date"] );
        $this->db->update('cassa_kehadiran', $atdnc_dat); 
    }
}


}