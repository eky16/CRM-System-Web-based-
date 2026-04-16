<?php

class M_payment extends CI_Model{
	protected $_table = 'tbl_payment';
    protected $_table_v = 'tbl_vendor';
    protected $_table_s = 'tbl_supplier';


    public function lihat_payment1(){
        $query = $this->db->get_where($this->_table, 'status_approval = 1');
        return $query->result();
    }
    public function save_pembayaran($data_pembayaran){
        return $this->db->insert_batch('tbl_payment', $data_pembayaran);
    }
    public function api_show(){
        $query = $this->db->get('akses_api');
        return $query->result();
    }
    public function lihat_payment2(){
        $query = $this->db->get_where($this->_table, 'status_approval = 2');
        return $query->result();
    }
    public function lihat_payment3(){
        $query = $this->db->get_where($this->_table, 'status_approval = 3');
        return $query->result();
    }

        public function lihat_supp(){
        $query = $this->db->get('tbl_supplier');
        return $query->result();
    }
        public function hapus_laporan_payment($id){
        return $this->db->delete($this->_table, ['id_payment ' => $id]);
    }
     function deletedd($id)
 {
  $this->db->where('id_payment', $id);
  $this->db->delete('tbl_payment');
 }
     public function hapus_vendor($id){
        return $this->db->delete($this->_table_v, ['id_ven' => $id]);
    }
    public function hapus_supplier($id){
        return $this->db->delete($this->_table_s, ['id_supp' => $id]);
    }

    function save_approve_payment($atdnc_data,$id){
    $kondisi = "( ( ( id_payment  ='" . $id . "')) )";
    $this->db->where($kondisi);
    $this->db->update('tbl_payment', $atdnc_data);
    return TRUE;
    }
    function insert_pay_vendor($kod_paymentt,$kategori_pay1,$pay_vendor_id,$pay_vendor_almount){
    if( !empty($pay_vendor_id) ) {
            $result = array();
                foreach($pay_vendor_id AS $key => $val){
                     $result[] = array(
                      'kod_payment'   => $kod_paymentt[$key],
                      'kategori_pay'   => $kategori_pay1[$key],
                      'pay_vendor_id'   => $pay_vendor_id[$key],
                      'pay_vendor_almount'   => $pay_vendor_almount[$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_payment_vendor', $result);
        }
    }

    function insert_paymentt($header_payment,$tgl_payment,$no_spk,$project_payment,$vendor,$almount,$note_payment,$createdBy_payment,$createdTime_payment,$total_payment,$total_pajak){
    if( !empty($header_payment) ) {
            $result = array();
                foreach($no_spk AS $key => $val){
                     $result[] = array(
                      'header_payment'   => $header_payment,
                      'tgl_payment'   => $tgl_payment,
                      'no_spk'   => $no_spk[$key],
                      'project_payment'   => $project_payment[$key],
                      'vendor'   => $vendor[$key],
                      'almount'   => $almount[$key],
                      'total_pajak'   => $total_pajak[$key],
                      'total_payment'   => $total_payment[$key],
                      'note_payment'   => $note_payment[$key],
                      'createdBy_payment'   => $createdBy_payment,
                      'createdTime_payment'   => $createdTime_payment
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('tbl_payment', $result);
        }
    }
    public function view_payment_status($id_lsp = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');

        $kondisi = "( ( ( tbl_payment.status_approval ='" . 1 . "' )) )";
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
    public function lihat($id = null){
        $this->db->from('tbl_vendor');   
        $this->db->order_by('tbl_vendor.nama_vendor', 'ASC'); 
         
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
        public function lihat_daftar_pemasok($id = null){
        $this->db->from('daftar_pemasok');   
        $this->db->order_by('daftar_pemasok.ID_Pemasok', 'DESC'); 
         
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
    public function count_payment_status($id_lsp = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');

        $kondisi = "( ( ( tbl_payment.status_approval ='" . 1 . "')) )";
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
    public function count_payment_status_pend($id_lsp = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');

        $kondisi = "( ( ( tbl_payment.status_approval ='" . 2 . "')) )";
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
        public function view_payment_status_f($id_lsp = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');

        $kondisi = "( ( (  tbl_payment.status_approval ='" . 3 . "')) )";
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

    public function view_paym_finish_id($id = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');

        $this->db->where('tbl_payment.id_payment', $id);
        if (!empty($id)) {
            $query_result = $this->db->get();
           $result = $query_result->result(); 
        } else {
           $this->db->where('tbl_payment.id_payment', $id);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    }
        public function view_payment_status_4($id_lsp = NULL) {
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');

        $kondisi = "( ( (  tbl_payment.status_approval ='" . 4 . "')) )";
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
    public function view_payment_status_ff($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.almount)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
        $this->db->group_by('tbl_payment.id_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 3 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
    public function view_payment_status_pp($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.almount)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
        $this->db->group_by('tbl_payment.id_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 1 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
    public function view_payment_status_fff($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.total_payment)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
    //    $this->db->group_by('tbl_payment.kod_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 3 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
        public function view_payment_status_fffp($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.total_payment)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
    //    $this->db->group_by('tbl_payment.kod_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 1 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
    public function view_payment_status_ppaid($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.almount)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
        $this->db->group_by('tbl_payment.id_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 4 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
            public function view_payment_status_paid($tanggal,$header_payment = NULL) {
        $this->db->select('SUM(tbl_payment.total_payment)  as total_almount');
        $this->db->select('leads_project.*', FALSE); 
        $this->db->select('tbl_payment.*', FALSE);
        $this->db->select('tbl_vendor.*', FALSE);
        $this->db->from('tbl_payment');
        $this->db->join('tbl_vendor', 'tbl_vendor.id_ven  = tbl_payment.vendor', 'left');
        $this->db->join('leads_project', 'leads_project.id_lsp  = tbl_payment.project_payment', 'left');
        $this->db->order_by('tbl_payment.createdTime_payment', 'DESC');
    //    $this->db->group_by('tbl_payment.kod_payment');
        $kondisi = "( ( (  tbl_payment.status_approval ='" . 4 . "' AND tbl_payment.tgl_payment ='" . $tanggal . "'  AND tbl_payment.header_payment ='" . $header_payment . "')) )";
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
    public function simpan_payment($data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE id_payment = '{$data['id_payment']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_payment', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_payment ='" . $data['id_payment'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_payment', $data); 
    }
    }
    public function simpan_payment_from_reimburs($data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE kod_payment = '{$data['kod_payment']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_payment', $data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kod_payment ='" . $data['kod_payment'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_payment', $data); 
    }
    }
    public function simpan_notif_payment($ntfdata) 
    {
    $query = $this->db->query("SELECT * FROM tbl_notif_payment WHERE id_payment = '{$ntfdata['id_payment']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_notif_payment', $ntfdata); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_payment ='" . $ntfdata['id_payment'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_notif_payment', $ntfdata); 
    }
    }
    public function save_vendor($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_vendor WHERE nama_vendor = '{$atdnc_data['nama_vendor']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_vendor', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( nama_vendor ='" . $atdnc_data['nama_vendor'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_vendor', $atdnc_data); 
    }
    }
    public function save_daftar_pemasok($atdnc_data_pemasok) 
    {
    $query = $this->db->query("SELECT * FROM daftar_pemasok WHERE ID_Pemasok = '{$atdnc_data_pemasok['ID_Pemasok']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('daftar_pemasok', $atdnc_data_pemasok); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( ID_Pemasok ='" . $atdnc_data_pemasok['ID_Pemasok'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('daftar_pemasok', $atdnc_data_pemasok); 
    }
    }
public function save_supplier($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_supplier WHERE supp_name = '{$atdnc_data['supp_name']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_supplier', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( supp_name ='" . $atdnc_data['supp_name'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_supplier', $atdnc_data); 
    }
    }
    public function update_supplier($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM  tbl_supplier WHERE id_supp = '{$atdnc_data['id_supp']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_supplier', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_supp ='" . $atdnc_data['id_supp'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_supplier', $atdnc_data); 
    }
    }
    public function update_vendor($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_vendor WHERE id_ven = '{$atdnc_data['id_ven']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_vendor', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_ven ='" . $atdnc_data['id_ven'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_vendor', $atdnc_data); 
    }
    }

        public function update_vendor_1($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM tbl_vendor WHERE vendorNo = '{$atdnc_data['vendorNo']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('tbl_vendor', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( vendorNo ='" . $atdnc_data['vendorNo'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('tbl_vendor', $atdnc_data); 
    }
    }
            public function update_daftar_pemasok($atdnc_data_pemasok) 
    {
    $query = $this->db->query("SELECT * FROM daftar_pemasok WHERE ID_Pemasok = '{$atdnc_data_pemasok['ID_Pemasok']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('daftar_pemasok', $atdnc_data_pemasok); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( ID_Pemasok ='" . $atdnc_data_pemasok['ID_Pemasok'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('daftar_pemasok', $atdnc_data_pemasok); 
    }
    }
}