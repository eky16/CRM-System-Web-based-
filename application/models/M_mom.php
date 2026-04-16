<?php

class M_mom extends CI_Model{
	protected $_table = 'cassa_mom';
    protected $_table_log = 'cassa_log';
     protected $_table_laporan = 'laporan_proyek';
	protected $_table_status = 'cassa_status_mom';
    protected $_table_leads = 'leads_project';

    public function get_employee(){
        $query = $this->db->get('alba_karyawan');
        return $query;
    }
    function create_tag($kode_tag,$EmployeeID){
        $this->db->trans_start();
            $result = array();
                foreach($EmployeeID AS $key => $val){
                     $result[] = array(
                      'kode_tag'      => $kode_tag,
                      'EmployeeID'      => $_POST['EmployeeID'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('cassa_tag', $result);
        $this->db->trans_complete();
    }
public function tambah_log($data_log){
        return $this->db->insert($this->_table_log, $data_log);
    }
    public function mom_goal(){
        $query = $this->db->get_where($this->_table, 'status = 7');
        return $query->result();
    }
    public function mom_nogoal(){
        $query = $this->db->get_where($this->_table, 'status = 6');
        return $query->result();
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

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
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

    public function tambah_laporan($data) 
    {
    $query = $this->db->query("SELECT * FROM laporan_proyek WHERE kode_lap = '{$data['kode_lap']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('laporan_proyek', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_lap ='" . $data['kode_lap'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('laporan_proyek', $data); 
    }
    }
    public function tambah_laporan_status_log($data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_status_log_proyek WHERE tgl_create = '{$data['tgl_create']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_status_log_proyek', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( tgl_create ='" . $data['tgl_create'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_status_log_proyek', $data); 
    }
    }
    public function update_fv($data) 
    {
    $query = $this->db->query("SELECT * FROM  leads_project WHERE id_lsp = '{$data['id_lsp']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' leads_project', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_lsp ='" . $data['id_lsp'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' leads_project', $data); 
    }
    }

        public function update_laporan_status_log($data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_status_log_proyek WHERE id_stts_log = '{$data['id_stts_log']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_status_log_proyek', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_stts_log ='" . $data['id_stts_log'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_status_log_proyek', $data); 
    }
    }
    public function tambah_laporan_checklist($data)  
    {
    $query = $this->db->query("SELECT * FROM  tbl_ceklist WHERE kode_ceklist = '{$data['kode_ceklist']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_ceklist', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_ceklist ='" . $data['kode_ceklist'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_ceklist', $data); 
    }
    }
        public function ubah_laporan_checklist($data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_ceklist_sub WHERE id_cek_sub = '{$data['id_cek_sub']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_ceklist_sub', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_cek_sub ='" . $data['id_cek_sub'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_ceklist_sub', $data); 
    }
    }
    public function tambah_laporan_issue_hd($data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_issue WHERE kode_issue = '{$data['kode_issue']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_issue', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_issue ='" . $data['kode_issue'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_issue', $data); 
    }
    }
	public function hapus($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}
    public function hapus_laporan_proyek($id){
        return $this->db->delete($this->_table_laporan, ['kode_lap' => $id]);
    }
	public function kode_leadsproject(){

        $q = $this->db->query("SELECT MAX(RIGHT(id_lsp,4)) AS id_lsp FROM leads_project WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_lsp)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "LDP".date('dmy').$kd;  
	}
	public function kode_momproject(){

        $q = $this->db->query("SELECT MAX(RIGHT(id_mom,4)) AS id_mom FROM cassa_mom WHERE DATE(entrytime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_mom)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "MOM".date('dmy').$kd;  
	}

        public function kode_laporan_proyek(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_lap,4)) AS kode_lap FROM laporan_proyek WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_lap)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "LPK".date('dmy').$kd;  
    }

    public function kode_tag(){

        $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS id FROM cassa_mom WHERE DATE(entrytime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "TAG".date('dmy').$kd;  
    }
	public function save_project($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM leads_project WHERE id_lsp = '{$atdnc_data['id_lsp']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('leads_project', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_lsp ='" . $atdnc_data['id_lsp'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('leads_project', $atdnc_data); 
    }
	}
	public function view_mom_filter($id_lsp = NULL) {  
        $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'inner');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( cassa_mom.status_berjalan = 1) ) )";
        $this->db->where($kondisi);

    	if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        	$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    }

        public function view_report_proyek($id_lsp = NULL) {  
        $this->db->select('laporan_proyek.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('laporan_proyek');
        $this->db->join('leads_project', 'laporan_proyek.id_lsp  = leads_project.id_lsp', 'inner');
        $this->db->order_by('laporan_proyek.tgl_laporan', 'DESC');
        $kondisi = "( ( ( cassa_mom.status_berjalan = 1) ) )";
   //     $this->db->where($kondisi);

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
        public function view_report_proyek_byid($id_lsp = NULL) { 
        $this->db->select('laporan_proyek.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('laporan_proyek');
        $this->db->join('leads_project', 'laporan_proyek.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->order_by('laporan_proyek.tgl_laporan', 'DESC');
     //   $kondisi = "( ( ( laporan_proyek.createdby = 1) ) )";
     //   $this->db->where($kondisi);
        $this->db->where('laporan_proyek.createdby', $this->session->login['nama']);
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

        public function detail_report_proyek($id) { 
        $this->db->select('laporan_proyek.*', FALSE);
        $this->db->select('leads_project.nama_project', FALSE);
        $this->db->from('laporan_proyek');
        $this->db->join('leads_project', 'laporan_proyek.id_lsp  = leads_project.id_lsp', 'left');;
        $this->db->order_by('laporan_proyek.tgl_laporan', 'ASC');
        if (!empty($id)) {
            $this->db->where('laporan_proyek.kode_lap', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

           $this->db->where('laporan_proyek.kode_lap', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
	public function view_mom_all($id_lsp = NULL) { 
        $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'inner');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->order_by('cassa_mom.id', 'DESC');
       // $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( cassa_mom.status_berjalan = 1) ) )";
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
    public function view_mom_all_my($id_lsp = NULL) { 
        $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'inner');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $this->db->where('cassa_mom.createdby', $this->session->login['nama']);
        $kondisi = "( ( ( cassa_mom.status_berjalan = 1) ) )";
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
    public function view_mom_tag($id = NULL) { 
        $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('cassa_tag.kode_tag', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->join('cassa_tag', 'cassa_tag.kode_tag  = cassa_mom.kode_tag', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $this->db->where('cassa_tag.EmployeeID', $id);
       //  $this->db->where('cassa_tag.kode_tag', 'TAG2309220001');
       // $kondisi = "( ( ( cassa_mom.status_berjalan = 1)  ) )";
      //  $this->db->where($kondisi);

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
    public function view_mom_all_goal($id_lsp) { 
         $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( cassa_mom_history.id_mom = cassa_mom.id_mom ) ) )";
        $this->db->where($kondisi);
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
       // $this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function view_mom_no_goal($id_lsp) { 
         $this->db->select('cassa_history_mom_tidak.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->join('cassa_history_mom_tidak', 'cassa_mom.id_mom  = cassa_history_mom_tidak.id_mom', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( cassa_history_mom_tidak.id_mom = cassa_mom.id_mom ) ) )";
        $this->db->where($kondisi);
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
       // $this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
        public function view_mom_all_goal_fillter($id_lsp) { 
         $this->db->select('cassa_mom_history.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->join('cassa_mom_history', 'cassa_mom.id_mom  = cassa_mom_history.id_mom', 'left');
        $this->db->order_by('cassa_mom.id_mom');
        $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( cassa_mom_history.id_mom = cassa_mom.id_mom ) ) )";
        $this->db->where($kondisi);
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        $this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function get_lsp() { 
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->group_by('cassa_mom.id_lsp');
        $this->db->order_by('cassa_mom.tanggal', 'ASC');
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

           // $this->db->where('tbl_employee.Active', 1);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function get_lsp_show($id_lsp= null) { 
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->order_by('cassa_mom.tanggal', 'ASC');
         $this->db->where('leads_project.id_lsp', $id_lsp);
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

              $this->db->where('leads_project.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }

       public function get_project() { 
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
               $this->db->order_by('leads_project.nama_project', 'ASC');
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

           // $this->db->where('tbl_employee.Active', 1);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }

    public function export_mom($id = NULL) { 
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->where('cassa_mom.id', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function view_mom_details($id) { 
        $this->db->select('cassa_tag.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('cassa_mom.*', FALSE);
        $this->db->select('leads_project.nama_pic,leads_project.alamat_project,leads_project.nama_project,leads_project.nama_kantor,leads_project.alamat_kantor,leads_project.status_project', FALSE);
        $this->db->from('cassa_mom');
        $this->db->join('leads_project', 'cassa_mom.id_lsp  = leads_project.id_lsp', 'left');
        $this->db->join('cassa_tag', 'cassa_tag.kode_tag  = cassa_mom.kode_tag', 'left');
        $this->db->join('alba_karyawan', 'cassa_tag.EmployeeID  = alba_karyawan.EmployeeID', 'left');
        $this->db->group_by('cassa_mom.id_lsp');
        $this->db->order_by('cassa_mom.tanggal', 'ASC');
        if (!empty($id)) {
            $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {

           $this->db->where('cassa_mom.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    public function save_mom_tidak_goal($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_history_mom_tidak WHERE id_mom = '{$atdnc_data['id_mom']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_history_mom_tidak', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_mom ='" . $atdnc_data['id_mom'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_history_mom_tidak', $atdnc_data); 
    }
}
}