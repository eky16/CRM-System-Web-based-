<?php

class M_karyawan extends CI_Model{
    protected $_table = 'alba_karyawan';
    protected $_table_log = 'cassa_log';
    protected $_table_status = 'alba_department';
   // protected $_table_leads = 'leads_project';


   function get_atasan(){
        $query = $this->db->get('alba_karyawan');
        return $query;  
    }


    public function lihat_aktif(){
        $query = $this->db->get_where('alba_karyawan', 'Active = 1');
        return $query->result();
    }
public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
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

        public function get_sales() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.nama_karyawan','ASC');
        
        $kondisi = "( (  ( alba_karyawan.Active ='" . 1 . "') AND ( alba_divisi.divisi ='" . "Sales" . "')  ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function get_supir() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.nama_karyawan','ASC');
        
        $kondisi = "( (  ( alba_karyawan.Active ='" . 1 . "') AND ( alba_divisi.divisi ='" . "Supir" . "')  ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function get_kenek() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.nama_karyawan','ASC');
        
        $kondisi = "( (  ( alba_karyawan.Active ='" . 1 . "') AND ( alba_divisi.divisi ='" . "Kenek" . "')  ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_masa_kerja() {
       // $this->db2 = $this->load->database('db2', TRUE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('datediff(alba_karyawan.akhir_kerja, now())');
        
        $kondisi = "( (  ( alba_karyawan.perjanjian_kerja ='" . "KONTRAK" . "' OR alba_karyawan.perjanjian_kerja='" . "PERCOBAAN" . "') 
        AND (alba_karyawan.Active='" . 1 . "') 
        AND (datediff(alba_karyawan.akhir_kerja, now()) <= 30 ) ) )";
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
    // Ambil nomor urut terbesar (3 digit di awal EmployeeID)
    $query = $this->db->query("
        SELECT MAX(CAST(SUBSTRING(EmployeeID, 1, 3) AS UNSIGNED)) as max_nourut 
        FROM alba_karyawan
    ");
    $hasil = $query->row();
    return $hasil->max_nourut; // akan mengembalikan angka, bukan string
}

    
   function get_jabatan(){
        $query = $this->db->get('alba_divisi');
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


    public function save_project($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM alba_karyawan WHERE EmployeeID = '{$atdnc_data['EmployeeID']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('alba_karyawan', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( EmployeeID ='" . $atdnc_data['EmployeeID'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('alba_karyawan', $atdnc_data); 
    }
    }

    public function save_user_login($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM employee_login WHERE kode = '{$atdnc_data['kode']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('employee_login', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode ='" . $atdnc_data['kode'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('employee_login', $atdnc_data); 
    }
    }
    public function save_employee_login($atdnc_login) 
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
 

  
    public function view_karyawan_all($EmployeeID = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.tgl_bergabung','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( alba_karyawan.Active = 1) ) )";
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

    public function view_user_login($EmployeeID = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
         $this->db->select('employee_login.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->join('employee_login', 'employee_login.kode  = alba_karyawan.EmployeeID', 'inner');
        $this->db->order_by('alba_karyawan.tgl_bergabung','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( alba_karyawan.Active = 1) ) )";
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
    public function view_karyawan_div($dept = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.tgl_bergabung','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( (alba_department.department='" . "$dept" . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
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
    public function view_karyawan_all_non($EmployeeID = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.nama_karyawan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( alba_karyawan.Active = 2) ) )";
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
    public function view_profile($id = NULL) { 
         
        $this->db->select('cassa_doc.*', FALSE);
   
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
       

        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);

          
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->join('cassa_doc', 'cassa_doc.EmployeeID  = alba_karyawan.EmployeeID', 'left');
       
       // $this->db->group_by('alba_karyawan.EmployeeID');
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
    
    

}