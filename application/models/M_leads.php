<?php

class M_leads extends CI_Model{
	protected $_table = 'leads_project';
	protected $_table_log = 'cassa_log';
	protected $_table1 = 'cassa_status_project'; 
	protected $_table_issueDT = 'tbl_issue_sub'; 

  function getData(){
        return $this->db->get('a_test_excel')->result_array();
    }
    public function get_rab_jenis(){
        $query = $this->db->get('jenis_rab');
        return $query->result();
    }
public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }
 function deleted_daily($id)
 	{
  $this->db->where('id_stts_log', $id);
  $this->db->delete('tbl_status_log_proyek'); 
 	}
  function deleted_material_hd($id)
 	{
  $this->db->where('id_material', $id);
  $this->db->delete('tbl_material'); 
 	}
   function deleted_material_dt($id)
 	{
  $this->db->where('id_material', $id);
  $this->db->delete('tbl_material_log'); 
 	}
	public function lihatXX(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	public function lihat_status_project(){
		$query = $this->db->get($this->_table1);
		return $query->result();
	}
	public function jumlah(){ 
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "PENDING" . "' OR leads_project.status_project='" . "TENDER" . "')) )";
        $this->db->where($kondisi);
          $this->db->order_by('leads_project.nama_project','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_my_leads($nama = NULL) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "PENDING" . "' OR leads_project.status_project='" . "TENDER" . "') AND (leads_project.createdby='" . $nama  . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function my_ongoing_p($nama = NULL) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "ON GOING" . "' ) AND (leads_project.createdby='" . $nama  . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function my_retensi($nama = NULL) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "ON GOING" . "' ) AND (leads_project.createdby='" . $nama  . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function my_finish_p($nama = NULL) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "FINISH" . "' ) AND (leads_project.createdby='" . $nama  . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function my_Lose_p($nama = NULL) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('leads_project.*', FALSE);
        $this->db->from('leads_project');
        $kondisi = "( (  (leads_project.status_project='" . "LOOSE" . "' ) AND (leads_project.createdby='" . $nama  . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_material_all($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' )) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
  	public function lihat_material_lantai($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "lantai" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
   	public function lihat_material_dinding($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "dinding" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }  
    	public function lihat_material_pintu($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "pintu" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
     	public function lihat_material_furnitur($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "furniture" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
      	public function lihat_material_me($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "me" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
       	public function lihat_material_lighting($id_lsp = null) {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('tbl_material.*', FALSE);
        $this->db->from('tbl_material');
        $kondisi = "( (  (tbl_material.id_leadsproyek='" . $id_lsp . "' AND tbl_material.jenis='" . "lighting" . "')) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
	public function pending(){ 
		$query = $this->db->get_where($this->_table, 'status_project = "PENDING"');
		return $query->result();
	}
	public function tender(){ 
		$query = $this->db->get_where($this->_table, 'status_project = "TENDER"');
		return $query->result();
	}
	public function ongoing(){ 
        $this->db->order_by('leads_project.nama_project','ASC');
		$query = $this->db->get_where($this->_table, 'status_project = "ON GOING"');
		return $query->result();
	}
    public function retensi(){ 
        $query = $this->db->get_where($this->_table, 'status_project = "RETENSI"');
        return $query->result();
    }
	public function finish(){ 
		$query = $this->db->get_where($this->_table, 'status_project = "FINISH"');
		return $query->result();
	}
	public function loose(){ 
		$query = $this->db->get_where($this->_table, 'status_project = "LOOSE"');
		return $query->result();
	}
	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}
    public function lihat_jenis_rab(){
        $this->db->order_by('jenis_rab.nama_rab', 'DESC');
        $query = $this->db->get('jenis_rab');
        return $query->result();
    }
    public function get_rab_by_id($id_dept,$id_lsp) {

        $this->db->where('jenis_rab.nama_rab', $id_dept);
        $this->db->select('jenis_rab.*', FALSE);
        $this->db->select(' tbl_rap.*', FALSE);
        $this->db->from('jenis_rab');
        $this->db->join(' tbl_rap', 'jenis_rab.nama_rab =  tbl_rap.jenis_rap', 'left');
        $this->db->where('tbl_rap.proyek_rap', $id_lsp);
        

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
	public function lihat_id($id_lsp){
		$query = $this->db->get_where($this->_table, ['id_lsp' => $id_lsp]);
		return $query->row();
	}
    public function lihat_proyekid_rab($id_lsp){
        $query = $this->db->get_where('leads_project', ['id_proyek_accurate' => $id_lsp]);
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
    public function ubah_rap_byID($data, $no_rap){
        $query = $this->db->set($data);
        $query = $this->db->where(['no_rap' => $no_rap]);
        $query = $this->db->update('tbl_rap');
        return $query;
    }
	public function hapus_material($id_lsp){
		return $this->db->delete('tbl_material', ['id_material' => $id_lsp]);
	}
	public function hapus_material_log($id_lsp){
		return $this->db->delete('tbl_material_log', ['id_material' => $id_lsp]);
	}
	public function hapus($id_lsp){
		return $this->db->delete($this->_table, ['id_lsp' => $id_lsp]);
	}

    public function hapus_rab_ByID($no_rap){
        return $this->db->delete('tbl_rap', ['no_rap' => $no_rap]);
    }

	public function hapus_issue_dt($id_sub_issue){
		return $this->db->delete($this->_table_issueDT, ['id_sub_issue' => $id_sub_issue]);
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
    public function save_rab_update($data_rab) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_rap WHERE no_rap = '{$data_rab['no_rap']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert(' tbl_rap', $data_rab); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( no_rap ='" . $data_rab['no_rap'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update(' tbl_rap', $data_rab); 
    }
}
	public function save_material($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_material WHERE id_material = '{$atdnc_data['id_material']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_material', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_material ='" . $atdnc_data['id_material'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_material', $atdnc_data); 
    }
}
	public function tambah_log_material($data){
		return $this->db->insert('tbl_material_log', $data);
	}
	public function update_material($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_material WHERE no = '{$atdnc_data['no']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_material', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( no ='" . $atdnc_data['no'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_material', $atdnc_data); 
    }
}
	public function save_daftar_project($daftar_project) 
    {
    $query = $this->db->query("SELECT * FROM daftar_project WHERE projectNo = '{$daftar_project['no']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('daftar_project', $daftar_project); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( projectNo ='" . $daftar_project['no'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('daftar_project', $daftar_project); 
    }
}
}