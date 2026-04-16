<?php

use Dompdf\Dompdf;

class quotation extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		if (
    !isset($this->session->login) ||
    !isset($this->session->login['role']) ||
    $this->session->login['role'] == ''
) {
    $this->session->set_flashdata('error', 'Sessi Berakhir, Login Kembali!');
    redirect('login');
}

		//$this->load->model('M_pengeluaran', 'm_pengeluaran');
		//$this->load->model('M_detail_keluar', 'm_detail_keluar');
		//$this->load->model('M_kerja', 'm_kerja');
		//$this->load->model('M_payment', 'm_payment');
		//$this->load->model('m_pembelian', 'm_pembelian');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_sales', 'm_sales');
		//$this->load->model('M_kendaraan', 'm_kendaraan');
		$this->load->model('M_quotation', 'm_quotation');
	}

	public function quo_status($id_lsp = NULL){
		$this->data['aktif'] = 'quo_status';
		$this->data['title'] = 'Estimation Completed';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
   $this->data['tgl_awal']  = $this->input->get('tgl_awal');
   $this->data['tgl_akhir'] = $this->input->get('tgl_akhir');

    // ➕ TAMBAHAN (AMBIL ID SALES LOGIN)
    // ===============================
    $login_sales_id = $this->data['emp']->id ?? null;

    $this->data['today'] = date('Y-m-d');
    
    $this->data['estimasi'] = $this->m_quotation->get_data_estimasi();
    $this->data['gambar_penawaran'] = $this->m_quotation->get_data_estimasi();
 
    $this->data['sales'] = $this->m_karyawan->get_sales();
    $all_quo = $this->m_quotation->lihat_item_quo_status(
    $this->data['tgl_awal'],
    $this->data['tgl_akhir']
);
    // ===============================
    // 🔐 HAK AKSES ESTIMASI (PER ROW)
    // ===============================
    foreach ($all_quo as $row) {
        $row->can_see_estimasi = false;

        if (
            !empty($login_sales_id) &&
            !empty($row->kdSales) &&
            (int)$login_sales_id === (int)$row->kdSales
        ) {
            $row->can_see_estimasi = true;
        }
    }
        // Data quotation
    $this->data['all_quo'] = $all_quo;		 
		$this->load->view('user/quotation/quotation_status', $this->data);
		 //     echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // exit;
	}
    
public function ajax_filter_quo()
{
    $tgl_awal  = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');

    // FIX: hanya null jika KEDUA kosong
    if (empty($tgl_awal) && empty($tgl_akhir)) {
        $tgl_awal  = null;
        $tgl_akhir = null;
    }

    $data['all_quo'] = $this->m_quotation->lihat_item_quo_status($tgl_awal, $tgl_akhir);
    $data['no'] = 1;

    $id = $this->session->login['kode'];
    $emp = $this->m_karyawan->view_profile_employee($id);
    $login_sales_id = $emp->id ?? null;

    foreach ($data['all_quo'] as $row) {
        $row->can_see_estimasi = false;

        if (
            !empty($login_sales_id) &&
            !empty($row->kdSales) &&
            (int)$login_sales_id === (int)$row->kdSales
        ) {
            $row->can_see_estimasi = true;
        }
    }

    $this->load->view('user/quotation/_table_quo', $data);
}


	public function get_all_barang(){  
      	$data = $this->m_barang->lihat_nama_barang1($_POST['item']); 
      	echo json_encode($data);
      }

    public function keranjang_barang_quo(){
      	$this->load->view('user/quotation/keranjang_quo');
      }
    
    public function hapus_statusQuo($id){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('user/dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_quotation->hapus_statusQuo($id)){
				$this->session->set_flashdata('success', 'Data Status Quotation <strong>Berhasil</strong> Dihapus!');
				redirect('user/quotation/list_statusQuo');
			} else {
				$this->session->set_flashdata('error', 'Data Status Quotation <strong>Gagal</strong> Dihapus!');
				redirect('user/quotation/list_statusQuo');
			}
		}

    public function hapus_srcLead($id){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('user/dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_quotation->hapus_srcLead($id)){
				$this->session->set_flashdata('success', 'Data Source Lead <strong>Berhasil</strong> Dihapus!');
				redirect('user/quotation/list_srcLead');
			} else {
				$this->session->set_flashdata('error', 'Data Source Lead <strong>Gagal</strong> Dihapus!');
				redirect('user/quotation/list_srcLead');
			}
		}
    
    public function hapus_sgmtBrg($id){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('user/dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_quotation->hapus_sgmtBrg($id)){
				$this->session->set_flashdata('success', 'Data Segment Barang <strong>Berhasil</strong> Dihapus!');
				redirect('user/quotation/list_segmentBrg');
			} else {
				$this->session->set_flashdata('error', 'Data Segment Barang <strong>Gagal</strong> Dihapus!');
				redirect('user/quotation/list_segmentBrg');
			}
		}

	public function list_statusQuo(){
			$this->data['title'] = 'Data Status Quotation';

			$this->data['statusQuo'] = $this->m_quotation->lihat_statusQuo();
			$this->data['no'] = 1;
			$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
			$this->load->view('user/quotation/list_status_quo', $this->data);
		}

    public function list_srcLead(){
			$this->data['title'] = 'Data Source Lead';

			$this->data['srcLead'] = $this->m_quotation->lihat_srcLead();
			$this->data['no'] = 1;
			$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
			$this->load->view('user/quotation/lihat_srcLead', $this->data);
		}

    public function list_segmentBrg(){
			$this->data['title'] = 'Data Segment Barang';

			$this->data['segBrg'] = $this->m_quotation->lihat_segmentBarang();
			$this->data['no'] = 1;
			$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
			$this->load->view('user/quotation/list_segmentBarang', $this->data);
		}
    public function list_segment(){
			$this->data['title'] = 'Data Segment';

			$this->data['seg'] = $this->m_quotation->lihat_segment();
			$this->data['no'] = 1;
			$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
			$this->load->view('user/quotation/lihat_segment', $this->data);
		}

	public function proses_ubah_srcLead(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id'] = $this->input->post('id');
			$atdnc_data['source'] = $this->input->post('source');
	        $atdnc_data['status'] = $this->input->post('status');
	        
	        $this->m_quotation->save_srcLead($atdnc_data);
	        	        
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	       	$this->session->set_flashdata('error', 'Data Source Lead <strong>Gagal</strong> Ditambahkan!');
	        $this->session->set_flashdata('success', 'Data Source Lead  <strong>Berhasil</strong> Diubah!');
	        redirect('user/quotation/list_srcLead'); //redirect page
			
		}

	public function proses_ubah(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id'] = $this->input->post('id');
			$atdnc_data['segment_barang'] = $this->input->post('segment_barang');
	        $atdnc_data['status'] = $this->input->post('status');
	        

	        $this->m_quotation->save_sgmtBrg($atdnc_data);
	        	        
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	       	$this->session->set_flashdata('error', 'Data Segment Barang <strong>Gagal</strong> Ditambahkan!');
	        $this->session->set_flashdata('success', 'Data Segment Barang  <strong>Berhasil</strong> Diubah!');
	        redirect('user/quotation/list_segmentBrg'); //redirect page
			
		}
	public function ubah_srcLead($id_lsp){

			$this->data['title'] = 'Ubah Source Lead';
			$this->data['srcLead_id'] = $this->m_quotation->lihat_srcLead_id($id_lsp);

			$this->load->view('user/quotation/ubah_srcLead', $this->data);
		}

	public function ubah_sgmt_brg($id_lsp){

			$this->data['title'] = 'Ubah';
			$this->data['segment_id'] = $this->m_quotation->lihat_id($id_lsp);

			$this->load->view('user/quotation/ubah_sgmt_brg', $this->data);
		}

     public function proses_tambah_segBarang(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['kd_segment'] = $this->input->post('kd_segment');
	        $atdnc_data['creatby_seg'] = $this->session->login['nama'];
	        $atdnc_data['createdtime'] = date('Y-m-d  H:i:s');
	        $atdnc_data['segment_barang'] = $this->input->post('segment_barang');
	        $atdnc_data['status'] = $this->input->post('status');
	       
	     //   echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	     //   exit;

	        $this->m_quotation->save_segmentBarang_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data Segment Barang <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data Segment Barang <strong>Berhasil</strong> Ditambahkan!');
	        redirect('user/quotation/list_segmentBrg'); //redirect page
			
		}

		public function proses_tambah_status_quo(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['kd_status'] = $this->input->post('kd_status');
	        $atdnc_data['creatby'] = $this->session->login['nama'];
	        $atdnc_data['creattime'] = date('Y-m-d  H:i:s');
	        $atdnc_data['status'] = $this->input->post('status');
	       
	     //   echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	     //   exit;

	        $this->m_quotation->save_status_quo_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
	        redirect('user/quotation/list_statusQuo'); //redirect page
			
		}

	    public function proses_tambah_srcLead(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['slug'] = $this->input->post('slug');
	        $atdnc_data['creatby'] = $this->session->login['nama'];
	        $atdnc_data['createdtime'] = date('Y-m-d  H:i:s');
	        $atdnc_data['source'] = $this->input->post('source');
	        $atdnc_data['status'] = $this->input->post('status');
	       
	     //   echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	     //   exit;

	        $this->m_quotation->save_srcLead_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
	        redirect('user/quotation/list_srcLead'); //redirect page
			
		}

    public function proses_tambah_seg(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['slug'] = $this->input->post('slug');
	        $atdnc_data['creatby_seg'] = $this->session->login['nama'];
	        $atdnc_data['createdtime'] = date('Y-m-d  H:i:s');
	        $atdnc_data['segment'] = $this->input->post('segment');
	        $atdnc_data['status'] = $this->input->post('status');
	       
	     //   echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	     //   exit;

	        $this->m_quotation->save_segment_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
	        redirect('user/quotation/list_segment'); //redirect page
			
		}

	public function tambah_segmentBarang($id_lsp = NULL){
		$this->data['aktif'] = 'segment';
		$this->data['title'] = 'Segment';
		$this->data['no'] = 1;

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_quotation->cekkode_quotation();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/quotation/tambah_segmentBarang', $this->data);
}   
    
    public function tambah_status_quo($id_lsp = NULL){
		$this->data['aktif'] = 'status_quotation';
		$this->data['title'] = 'Status Quotation';
		$this->data['no'] = 1;

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_quotation->cekkode_quotation();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/quotation/tambah_status_quo', $this->data);
} 

    public function tambah_srcLead($id_lsp = NULL){
		$this->data['aktif'] = 'source_lead';
		$this->data['title'] = 'Source Lead';
		$this->data['no'] = 1;

		$this->data['segment'] = $this->m_quotation->lihat_segment();

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_quotation->cekkode_quotation();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/quotation/tambah_srcLead', $this->data);
} 
    public function tambah_segment($id_lsp = NULL){
		$this->data['aktif'] = 'segment';
		$this->data['title'] = 'Segment';
		$this->data['no'] = 1;

		$this->data['segment'] = $this->m_customer->lihat_segment();

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_quotation->cekkode_quotation();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/quotation/tambah_segment', $this->data);
}

	public function tambah_quo($id_lsp = NULL){
		$this->data['aktif'] = 'quotation';
		$this->data['title'] = 'Progress';
		$this->data['no'] = 1;

		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_karyawan->get_sales();

		$this->data['warna'] = $this->m_barang->lihat_warna(); //get data barang
		$this->data['segment'] = $this->m_customer->lihat_segment();
		$this->data['segBrg'] = $this->m_quotation->lihat_segmentBarang();

		$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
		$this->data['all_unit'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$this->data['satuan'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_quotation->cekkode_quotation();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/quotation/tambah_quo', $this->data);
}
    public function proses_tambah_quo(){

        date_default_timezone_set('Asia/Jakarta');
 
      	$jumlah_permintaan_barang_quo = count($this->input->post('detailName_quo_hidden'));
      	$trans_Date = $this->input->post('trans_Date'); 
      	$number_quo = $this->input->post('number_quo');
      	$kd_cst_quo = $this->input->post('kd_cst_quo'); 
      	$kdSales = $this->input->post('kdSales'); 
      	
      	$created_quo = $this->session->login['nama'];
      	$createdtime_quo = date('Y-m-d H:i:s');

      	$data_hd_quo['trans_Date'] = $trans_Date;		
      	$data_hd_quo['number_quo'] = $number_quo;
      	$data_hd_quo['kd_cst_quo'] = $kd_cst_quo;
      	$data_hd_quo['kdSales'] = $kdSales;
      	$data_hd_quo['created_quo'] = $created_quo;
      	$data_hd_quo['createdtime_quo'] = $createdtime_quo;
      	//$data_hd_quo['status_quo'] = '1';
			$this->m_quotation->save_quo_hd($data_hd_quo); //simpan ke tabel alba quotation hd

$data_detail_keluar_quo = [];

for ($i = 0; $i < $jumlah_permintaan_barang_quo; $i++) {
	
    if (!empty($_FILES['berkas']['name'][$i])) {
        $config['upload_path']          = './img/uploads/gambar_kerja/'; // penempatan gambar 
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf'; // upload tipe
        $config['max_size']             = 30000; // upload max size 30mb
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);  //konfigurasi file

        $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
        $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
        $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
        $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
        $this->upload->do_upload('file');
        $uploadData = $this->upload->data();
        $foto = $uploadData['file_name'];
        $data_detail_keluar_quo[$i]['gambar_kerja'] = $uploadData['file_name'];
    } else {
        // Handle ketika tidak ada file diunggah
        $data_detail_keluar_quo[$i]['gambar_kerja'] = ''; // Atau isikan dengan nilai default yang sesuai
    }


    $data_detail_keluar_quo[$i]['number_request_quo'] = $this->input->post('number_quo');
    $data_detail_keluar_quo[$i]['kd_cst_quo'] = $this->input->post('kd_cst_quo');
    $data_detail_keluar_quo[$i]['kategori_cust'] = $this->input->post('kategori_cust');
    $data_detail_keluar_quo[$i]['nama_segment'] = $this->input->post('nama_segment');
    $data_detail_keluar_quo[$i]['kategori_barang'] = $this->input->post('kategori_barang_hidden')[$i];
    $data_detail_keluar_quo[$i]['detailName_quo'] = $this->input->post('detailName_quo_hidden')[$i];
    $data_detail_keluar_quo[$i]['item_no'] = $this->input->post('item_no_hidden')[$i];
    $data_detail_keluar_quo[$i]['detailNotes_quo'] = $this->input->post('detailNotes_quo_hidden')[$i];
    $data_detail_keluar_quo[$i]['quantity'] = $this->input->post('quantity_hidden')[$i];
    $data_detail_keluar_quo[$i]['segment_barang'] = $this->input->post('segment_barang_hidden')[$i];
    $data_detail_keluar_quo[$i]['jenis_furniture'] = $this->input->post('jenis_furniture_hidden')[$i];

    $data_detail_keluar_quo[$i]['harga'] = $this->input->post('harga_hidden')[$i];
    $data_detail_keluar_quo[$i]['diskon_persen'] = $this->input->post('diskon_persen_hidden')[$i];
    $data_detail_keluar_quo[$i]['diskon_rupiah'] = $this->input->post('diskon_rupiah_hidden')[$i];
    $data_detail_keluar_quo[$i]['follow_up_date'] = $this->input->post('follow_up_date_hidden')[$i];

}
// yang status packing kiri itu nama field di tabel db nya, yang kanan itu yang dari program name yang dari keranjang

 // $this->db->insert('alba_permintaan_barang_dt',$data_detail_keluar_quo);
			$this->m_quotation->save_quo_dt1($data_detail_keluar_quo); //simpan ke tabel alba permintaan barang dt

			$data_hs_quo['no_qt'] = $number_quo;
			$data_hs_quo['status'] = 'Progress berhasil dibuat';
			$data_hs_quo['action_qt_by'] = $created_quo;
			$data_hs_quo['actiontime_qt'] = $createdtime_quo;
			$this->m_quotation->save_quo_history($data_hs_quo); //simpan ke tabel alba purchase history

			$this->session->set_flashdata('success', 'Permintaan <strong>Barang</strong> Berhasil Dibuat!');
			redirect('user/quotation/list_quo_order'); //redirect page

			//echo '<pre>';
//print_r($this->input->post());
//die();
		}

public function list_quotation_item($id_lsp = NULL)
{
	date_default_timezone_set('Asia/Jakarta');

    $this->data['aktif'] = 'quotation';
    $this->data['title'] = 'Quotation Follow Up';
    $this->data['no']    = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

    // ➕ TAMBAHAN (AMBIL ID SALES LOGIN)
    // ===============================
    $login_sales_id = $this->data['emp']->id ?? null;

    $this->data['today'] = date('Y-m-d');
    
    $this->data['estimasi'] = $this->m_quotation->get_data_estimasi();
    $this->data['gambar_penawaran'] = $this->m_quotation->get_data_estimasi();


    $this->data['sales'] = $this->m_karyawan->get_sales();
    $all_quo = $this->m_quotation->list_reminder();


    // ===============================
    // 🔐 HAK AKSES ESTIMASI (PER ROW)
    // ===============================
    foreach ($all_quo as $row) {
        $row->can_see_estimasi = false;

        if (
            !empty($login_sales_id) &&
            !empty($row->kdSales) &&
            (int)$login_sales_id === (int)$row->kdSales
        ) {
            $row->can_see_estimasi = true;
        }
    }

    // kirim ke view
    $this->data['all_quo'] = $all_quo;
    $this->load->view('user/quotation/list_all_item_quo', $this->data);

}



		public function list_quo_order($id_lsp = NULL){
      	$this->data['aktif'] = 'quotation';
      	$this->data['title'] = 'Quotation Order List';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_quo'] = $this->m_quotation->lihat_quo_status_1(); 

		$this->load->view('user/quotation/list_quo', $this->data);
	}

	public function detail_quo_status($id_quo = NULL){
		$this->data['aktif'] = 'quotation';
		$this->data['title'] = 'Lead Detail Quotation';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		 // CEK LOGIN
    // ===============================
    if (
        !isset($this->session->login) ||
        !isset($this->session->login['kode'])
    ) {
        redirect('login');
    }

    $loginKode = $this->session->login['kode'];
    $loginRole = strtolower($this->session->login['role'] ?? '');
    $loginDept = strtolower($this->session->login['department'] ?? '');


    $this->data['emp'] = $this->m_karyawan->view_profile_employee($loginKode);


		$this->data['hd_quo'] = $this->m_quotation->lihat_quo_detail_hd($id_quo);
		$this->data['dt_quo'] = $this->m_quotation->lihat_quo_detail_dt($id_quo);
		$this->data['his_quo'] = $this->m_quotation->lihat_quo_detail_history($id_quo); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_karyawan->get_sales();

		// PERMISSION ESTIMASI HARGA
    // ===============================
    $this->data['can_see_estimasi'] = false;
    //echo '<pre>';
//var_dump($this->session->login);
//die;


   // IT (BERDASARKAN DEPARTMENT)
if ($loginDept === 'it') {
    $this->data['can_see_estimasi'] = true;
}

// ESTIMATOR
elseif ($loginDept === 'estimator') {
    $this->data['can_see_estimasi'] = true;
}

/// SALES / MARKETING PEMILIK QUOTATION
elseif (
    strtolower($this->session->login['department'] ?? '') === 'marketing' &&
    $loginKode == $this->data['hd_quo']->kdSales
) {
    $this->data['can_see_estimasi'] = true;
}


		$this->load->view('user/quotation/detail_quo', $this->data); 

	}

   
public function cetak_pdf(){

    require_once APPPATH . 'libraries/dompdf/autoload.inc.php';
    //var_dump(file_exists(APPPATH . 'libraries/dompdf/autoload.inc.php'));
    //exit;
    
		$id_quo = $this->input->post('id_quo');
		
		if (!$id_quo) {
        die("Error: ID Quotation tidak diterima oleh sistem.");
    }
		$dompdf = new Dompdf();
        $biaya_kirim = $this->input->post('biaya_kirim_pdf');
        $biaya_penanganan = $this->input->post('biaya_penanganan_pdf');

        $this->data['cetak_biaya_kirim'] = ($biaya_kirim) ? $biaya_kirim : 0;
        $this->data['cetak_biaya_penanganan'] = ($biaya_penanganan) ? $biaya_penanganan : 0;

        $this->data['biaya_kirim'] = $this->input->post('biaya_kirim_pdf');
        $this->data['statusProgress'] = $this->m_quotation->lihat_statusProgress();      
        $this->data['statusQuo'] = $this->m_quotation->lihat_statusQuo();

        $this->data['hd_quo'] = $this->m_quotation->lihat_quo_detail_hd($id_quo);
		$this->data['dt_quo'] = $this->m_quotation->lihat_quo_detail_dt_penawaran($id_quo);
		$this->data['his_quo'] = $this->m_quotation->lihat_quo_detail_history($id_quo); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_karyawan->get_sales();		
		$this->data['title'] = 'Penawaran Harga';
		$this->data['no'] = 1;

		//var_dump($this->data['biaya_kirim_real']); 
        //die();

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('user/quotation/pdf_penawaran', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Penawaran Harga ' . date('d F Y'), array("Attachment" => false));
	}


	    public function penawaran($id_quo = NULL){
		$this->data['aktif'] = 'quotation';
		$this->data['title'] = 'Penawaran Harga';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		 // CEK LOGIN
    // ===============================
    if (
        !isset($this->session->login) ||
        !isset($this->session->login['kode'])
    ) {
        redirect('login');
    }

    $loginKode = $this->session->login['kode'];
    $loginRole = strtolower($this->session->login['role'] ?? '');
    $loginDept = strtolower($this->session->login['department'] ?? '');

    $this->data['user_dept'] = $loginDept;

// Department yang boleh hapus
$this->data['allowed_dept_hapus'] = ['it', 'estimator'];


    
//var_dump($loginDept); // apakah muncul "it"?
//var_dump($this->data['allowed_dept_hapus']); // apakah ada "it"?


    $this->data['emp'] = $this->m_karyawan->view_profile_employee($loginKode);

        $this->data['statusProgress'] = $this->m_quotation->lihat_statusProgress();      
        $this->data['statusQuo'] = $this->m_quotation->lihat_statusQuo();

        $this->data['hd_quo'] = $this->m_quotation->lihat_quo_detail_hd($id_quo);
		$this->data['dt_quo'] = $this->m_quotation->lihat_quo_detail_dt_penawaran($id_quo);
		$this->data['his_quo'] = $this->m_quotation->lihat_quo_detail_history($id_quo); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_karyawan->get_sales();
       

           // AMBIL FILE GAMBAR PER DETAIL
        
foreach ($this->data['dt_quo'] as $key => $row) {

    $this->db->where('id_quo_dt', $row->id_quo_dt);
    $this->data['dt_quo'][$key]->files =
        $this->db->get('gambar_penawaran_file')->result();

       
}
          // AMBIL ESTIMASI SEKALIGUS 

if (!empty($this->data['dt_quo'])) {

    $id_list = array_column($this->data['dt_quo'], 'id_quo_dt');

    $this->db->where_in('id_quo_dt1', $id_list);
    $this->db->order_by('created_at', 'ASC');

    $all_estimasi = $this->db->get('alba_estimasi_harga')->result();

    $grouped_history = [];

    foreach ($all_estimasi as $est) {
        $grouped_history[$est->id_quo_dt1][] = $est;
    }

    $this->data['grouped_history'] = $grouped_history;

} else {
    $this->data['grouped_history'] = [];
}


		// PERMISSION ESTIMASI HARGA

    $this->data['can_see_estimasi'] = false;
    //echo '<pre>';
//var_dump($this->session->login);
//die;


   // IT (BERDASARKAN DEPARTMENT)
if ($loginDept === 'it') {
    $this->data['can_see_estimasi'] = true;
}

// ESTIMATOR
elseif ($loginDept === 'estimator') {
    $this->data['can_see_estimasi'] = true;
}

/// SALES / MARKETING PEMILIK QUOTATION
elseif (
    strtolower($this->session->login['department'] ?? '') === 'marketing' &&
    $loginKode == $this->data['hd_quo']->kdSales
) {
    $this->data['can_see_estimasi'] = true;
}


		$this->load->view('user/quotation/penawaran', $this->data); 

	}

    public function detail_quo($id_quo = NULL){
		$this->data['aktif'] = 'quotation';
		$this->data['title'] = 'Lead Detail';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		 // CEK LOGIN
    // ===============================
    if (
        !isset($this->session->login) ||
        !isset($this->session->login['kode'])
    ) {
        redirect('login');
    }

    $loginKode = $this->session->login['kode'];
    $loginRole = strtolower($this->session->login['role'] ?? '');
    $loginDept = strtolower($this->session->login['department'] ?? '');

    $this->data['user_dept'] = $loginDept;

// Department yang boleh hapus
$this->data['allowed_dept_hapus'] = ['it', 'estimator'];


    
//var_dump($loginDept); // apakah muncul "it"?
//var_dump($this->data['allowed_dept_hapus']); // apakah ada "it"?


    $this->data['emp'] = $this->m_karyawan->view_profile_employee($loginKode);

        $this->data['statusProgress'] = $this->m_quotation->lihat_statusProgress();      
        $this->data['statusQuo'] = $this->m_quotation->lihat_statusQuo();

        $this->data['hd_quo'] = $this->m_quotation->lihat_quo_detail_hd($id_quo);
		$this->data['dt_quo'] = $this->m_quotation->lihat_quo_detail_dt($id_quo);
		$this->data['his_quo'] = $this->m_quotation->lihat_quo_detail_history($id_quo); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_karyawan->get_sales();
       

           // AMBIL FILE GAMBAR PER DETAIL
        
foreach ($this->data['dt_quo'] as $key => $row) {

    $this->db->where('id_quo_dt', $row->id_quo_dt);
    $this->data['dt_quo'][$key]->files =
        $this->db->get('gambar_penawaran_file')->result();

       
}
          // AMBIL ESTIMASI SEKALIGUS 

if (!empty($this->data['dt_quo'])) {

    $id_list = array_column($this->data['dt_quo'], 'id_quo_dt');

    $this->db->where_in('id_quo_dt1', $id_list);
    $this->db->order_by('created_at', 'ASC');

    $all_estimasi = $this->db->get('alba_estimasi_harga')->result();

    $grouped_history = [];

    foreach ($all_estimasi as $est) {
        $grouped_history[$est->id_quo_dt1][] = $est;
    }

    $this->data['grouped_history'] = $grouped_history;

} else {
    $this->data['grouped_history'] = [];
}


		// PERMISSION ESTIMASI HARGA

    $this->data['can_see_estimasi'] = false;
    //echo '<pre>';
//var_dump($this->session->login);
//die;


   // IT (BERDASARKAN DEPARTMENT)
if ($loginDept === 'it') {
    $this->data['can_see_estimasi'] = true;
}

// ESTIMATOR
elseif ($loginDept === 'estimator') {
    $this->data['can_see_estimasi'] = true;
}

/// SALES / MARKETING PEMILIK QUOTATION
elseif (
    strtolower($this->session->login['department'] ?? '') === 'marketing' &&
    $loginKode == $this->data['hd_quo']->kdSales
) {
    $this->data['can_see_estimasi'] = true;
}


		$this->load->view('user/quotation/detail_quo', $this->data); 

	}

	public function proses_approve_quo(){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$id_hd = $this->input->post('id');
			$data['status_quo'] = $this->input->post('status_quo');
      		$this->m_quotation->ubah_status_quo($data,$id_hd); //simpan ke tabel jenis izin


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Estimator Mengetahui Quotation';
      		$data_log['kode'] = $this->input->post('number_quo');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log data

			$data_hs['action_qt_by'] = $this->session->login['nama'];
			$data_hs['actiontime_qt'] = date('Y-m-d H:i:s');
			$data_hs['no_qt'] = $this->input->post('number_quo');
			$data_hs['status'] = $this->input->post('status');
			$this->m_quotation->save_quotation_history($data_hs); //simpan ke tabel History Po

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Permintaan Barang <strong>Berhasil</strong> Disetujui!');
			redirect('user/quotation/detail_quo/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	



	public function kelengkapan_quo($id_quo = NULL){
      	$this->data['aktif'] = 'quotation';
      	$this->data['title'] = 'Proses Estimasi';

      	$this->data['no'] = 1;
				$id = $this->session->login['kode'];
				$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
				$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
				//$this->data['satuan'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
				//$this->data['warna'] = $this->m_barang->lihat_warna(); //get data warna
				
				$this->data['dt_quo'] = $this->m_quotation->lihat_quo_detail_dt_aksi($id_quo);
				$this->data['dt_quo_all'] = $this->m_quotation->lihat_quo_detail_dt_aksi_all($id_quo);

				$this->data['hd_quo'] = $this->m_quotation->lihat_quo_detail_hd($id_quo);

				$dariDB_wo = $this->m_quotation->cekkode_pesanan_quo(); //ambil kode WO dari tabel alba_kode_otomatis
				$nourut_wo = substr($dariDB_wo, 11, 4); // ambil 4 angka kode urutan ke 11 
				$kodeWO = $nourut_wo + 1; // kode terakhir di tambah 1
		    	$this->data['generate_kode_wo']  = $kodeWO; // hasill

				//$dariDB_stok = $this->m_quotation->cekkode_stok(); //ambil kode Stok dari tabel alba_kode_otomatis
				//$nourut_stok = substr($dariDB_stok, 10, 4); // ambil 4 angka kode urutan ke 11 
				//$kodeStok = $nourut_stok + 1; // kode terakhir di tambah 1
		    	//$this->data['generate_kode_stok']  = $kodeStok; // hasill


      	$this->load->view('user/quotation/ubah_quo', $this->data);
      }

    
    public function ubah_quo_dt_prosesto_est(){
			date_default_timezone_set('Asia/Jakarta');
            
            $estimasi_harga = $this->input->post('estimasi_harga');
            			$id_quo_dt = $this->input->post('id_quo_dt');

			$id_hd = $this->input->post('id_header');
			$cek_status =  $this->input->post('status_qr_quo');
			$customer =  $this->input->post('customer');			
			$cek_status_proses =  $this->input->post('status_proses_quo');

			//validasi jika status Dalam Proses Estimasi atau Partlist Required & status proses 2  maka beri pesan gagal simpan.
            if(!in_array($cek_status, ['Tidak Bisa Estimasi', 'Bisa Estimasi']) && $cek_status_proses == 2){
			$this->session->set_flashdata('error_stok', ' <strong>Gagal</strong> Diubah!');
			redirect('user/quotation/kelengkapan_quo/'.$id_hd);
			}
			
			
			//validasi jika status produksi  maka beri pesan berhasil simpan .
			if($cek_status == 'Tidak Bisa Estimasi' || $cek_status == 'Bisa Estimasi'  ){				
			
			$update_quo_dt['id_quo_dt'] = $this->input->post('id_quo_dt');
			$update_quo_dt['detailName_quo'] = $this->input->post('detailName_quo');	
			$update_quo_dt['detailNotes_quo'] = $this->input->post('detailNotes_quo');
			$update_quo_dt['status_proses_quo'] = $this->input->post('status_proses_quo');
			$update_quo_dt['status_qr_quo'] = $this->input->post('status_qr_quo');
			$update_quo_dt['status_awal'] = $this->input->post('status_qr_quo');

			
            
            // INSERT HISTORI HARGA
// ======================

if(!empty($estimasi_harga)){

$data_estimasi = [
'id_quo_dt1' => $id_quo_dt,
'estimasi_harga' => $estimasi_harga,
'created_by' => $this->session->login['nama'],
'created_at' => date('Y-m-d H:i:s')
];

$this->db->insert('alba_estimasi_harga',$data_estimasi);

}

			
			//$update_quo_dt['status_awal'] = $this->input->post('status_qr');

			  $data_log['user'] = $this->session->login['nama'];
		      $data_log['waktu'] = date('Y-m-d H:i:s');
		      $data_log['ket'] = 'Update Detail Barang';
		      $data_log['kode'] = $this->input->post('id_quo_dt');
					

			$data_hs['action_qt_by'] = $this->session->login['nama'];
			$data_hs['actiontime_qt'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_quo_dt');
			$data_hs['no_qt'] = $this->input->post('no_qt');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_quotation->save_update_quo_dt($update_quo_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail Quotation <strong>Berhasil</strong> Diubah!');
			redirect('user/quotation/kelengkapan_quo/'.$id_hd);
			}
			

        //echo '<pre>';
        //print_r ($_POST);
        //echo '</pre>';
        //exit;
		
		}

	public function delete_detail_quo()
	    {
	    	if($this->input->post('checkbox_value'))
	    	{


	    		$id = $this->input->post('checkbox_value');
	    		for($count = 0; $count < count($id); $count++)
	    		{
	    			$this->m_quotation->hapus_quo_dt1($id[$count]);
	    		}
	    	}
	    }

	

    public function proses_permintaan_barang($id_lsp = NULL){
      	$this->data['aktif'] = 'quotation';
      	$this->data['title'] = 'Permintaan Quotation Sedang Diproses';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_quo'] = $this->m_quotation->lihat_quo_status_2(); 


		$this->load->view('user/quotation/list_quo', $this->data);
	}

	public function reminder_gamPenawaran($id_lsp = NULL){
		$this->data['aktif'] = 'quotation';
		$this->data['title'] = 'Follow Up Gambar Penawaran'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		
		$this->data['all_quo'] = $this->m_quotation->list_reminder_gamPenawaran();
		
		 
		$this->load->view('user/quotation/master_qt', $this->data);
		    //  echo '<pre>';
        // print_r ($_POST);
        // echo '</pre>';
        // exit;
	}

    public function ubah_master_qt(){
			date_default_timezone_set('Asia/Jakarta');
			        //echo '<pre>';
       //print_r ($_POST);
       // echo '</pre>';
       //exit;

           
			if ( $this->input->post('status_pembatalan') == 'Batal' ){
	
	        $status_qr_quo = 'Batal';
            }
            if ( $this->input->post('status_pembatalan') != 'Batal' ){
	
	        $status_qr_quo = $this->input->post('status_qr_quo');
            }

			$id_hd = $this->input->post('url');


// Proses unggah file estimasi_harga
if (!empty($_FILES['estimasi_harga']['name'])) {
    $config_estimasi_harga = [
        'upload_path'   => './img/uploads/estimasi_harga',
        'allowed_types' => '*', // Sesuaikan tipe file jika diperlukan
        'max_size'      => 20000, // Maksimal ukuran 20 MB
        'encrypt_name'  => TRUE, // Nama file akan diacak
    ];

    $this->load->library('upload', $config_estimasi_harga, 'upload_estimasi_harga'); // Buat instance upload khusus untuk estimasi_harga

    if ($this->upload_estimasi_harga->do_upload('estimasi_harga')) {
        $update_dt['estimasi_harga'] = $this->upload_estimasi_harga->data("file_name");
    } else {
        $error = $this->upload_estimasi_harga->display_errors();
        echo "Error Upload Estimasi: " . $error;
    }
}
           			
			$update_quo_dt['status_qr_quo'] = $status_qr_quo;
			$update_quo_dt['id_quo_dt'] = $this->input->post('id_quo_dt');
            $update_quo_dt['detailNotes_quo'] = $this->input->post('detailNotes_quo');


		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_quo_dt');
			

			$data_hs_quo['action_qt_by'] = $this->session->login['nama'];
			$data_hs_quo['actiontime_qt'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_quo_dt');
			$data_hs_quo['no_qt'] = $this->input->post('no_qt');
			$data_hs_quo['status'] = 'Update Detail Barang id '.$idnya;

			

			$this->m_quotation->save_quo_history($data_hs_quo); //simpan ke tabel log status pr

			$this->m_quotation->save_update_quo_dt($update_quo_dt); //simpan ke tabel pr dt	

			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('user/quotation/'.$id_hd);
		  
       //echo '<pre>';
       //print_r ($_POST);
       //echo '</pre>';
       //exit;
		}

	public function hapus_estimasi()
{
    // CEK LOGIN
    if (!isset($this->session->login)) {
        echo json_encode([
            'success' => false,
            'message' => 'Session habis, silakan login ulang'
        ]);
        return;
    }

    // AMBIL DEPARTMENT USER
    $user_dept = strtolower(trim($this->session->login['department'] ?? ''));

    // DAFTAR DEPT YANG BOLEH HAPUS
    $allowed_dept = ['it', 'estimator'];

    // VALIDASI AKSES
    if (!in_array($user_dept, $allowed_dept)) {
        echo json_encode([
            'success' => false,
            'message' => 'Akses ditolak (Dept: ' . $user_dept . ')'
        ]);
        return;
    }

    // AMBIL ID
    $id = $this->input->post('id');

    if (empty($id)) {
        echo json_encode([
            'success' => false,
            'message' => 'ID tidak valid'
        ]);
        return;
    }

    // LOAD MODEL
    $this->load->model('m_quotation');

    // HAPUS DATA
    $hapus = $this->m_quotation->hapus_estimasi($id);

    if ($hapus) {
        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan atau gagal dihapus'
        ]);
    }
}

    public function update_estimasiHarga(){ 
    date_default_timezone_set('Asia/Jakarta');

    $id_hd     = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');
    $estimasi  = $this->input->post('estimasi_harga');

    // insert ke tabel estimasi
    $data = [
        'id_quo_dt1'      => $id_quo_dt,
        'estimasi_harga' => $estimasi,
        'created_by'     => $this->session->login['nama'],
        'created_at'     => date('Y-m-d H:i:s')
    ];

    $this->db->insert('alba_estimasi_harga', $data);

    // update status_harga
    $this->db->where('id_quo_dt', $id_quo_dt);
    $this->db->where('status_harga', 'Belum Ada Estimasi');
    $this->db->update('alba_quotation_dt', [
    'status_harga' => 'Sudah Ada Estimasi'
]);

    // log history
    $data_hs_quo['action_qt_by']  = $this->session->login['nama'];
    $data_hs_quo['actiontime_qt'] = date('Y-m-d H:i:s');
    $data_hs_quo['no_qt']         = $this->input->post('no_qt');
    $data_hs_quo['status']        = 'Update Estimasi Harga id '.$id_quo_dt;

    $this->m_quotation->save_quo_history($data_hs_quo);

    // notifikasi
    $this->session->set_flashdata('success', 'Detail QT <strong>Berhasil</strong> Diubah!');

    redirect('user/quotation/detail_quo/'.$id_hd);
}
    
    public function update_status_progress(){

    date_default_timezone_set('Asia/Jakarta');

    $id_hd     = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');
    $statusProgress    = $this->input->post('status_progress');

    // UPDATE STATUS DI TABEL QUOTATION DETAIL

    $data_update = [
        'status_progress' => $statusProgress
    ];

    $this->m_quotation->update_status_prog($id_hd, $data_update);
   

    // LOG ACTIVITY

                $data_hs_quo = [
                'action_qt_by'  => $this->session->login['nama'],
                'actiontime_qt' => date('Y-m-d H:i:s'),
                'no_qt'         => $this->input->post('no_qt'),
                'status'        => 'Update Quotation Progress (Detail ID: '.$id_quo_dt.')'
            ];

            $this->m_quotation->save_quo_history($data_hs_quo);



    // ===============================
    // NOTIFIKASI
    // ===============================
    $this->session->set_flashdata('success', 'Status Sales <strong>Berhasil</strong> Diubah!');
    redirect('user/quotation/detail_quo/'.$id_hd);
    echo '<pre>';
print_r($_POST);
exit;
}


	public function update_status_quo_sales(){

    date_default_timezone_set('Asia/Jakarta');

    $id_hd     = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');
    $status_Qsales    = $this->input->post('status_quo_sales');
        $hargaBarang    = $this->input->post('harga');

    $hargaBarang   = preg_replace('/[^0-9]/', '', $hargaBarang);
    // UPDATE STATUS DI TABEL QUOTATION DETAIL

    $data_update = [
        'status_quo_sales' => $status_Qsales,
                'harga' => $hargaBarang

    ];

    $this->m_quotation->update_status_sales($id_quo_dt, $data_update);
   

    // LOG ACTIVITY

                $data_hs_quo = [
                'action_qt_by'  => $this->session->login['nama'],
                'actiontime_qt' => date('Y-m-d H:i:s'),
                'no_qt'         => $this->input->post('no_qt'),
                'status'        => 'Update Quotation Status (Detail ID: '.$id_quo_dt.')'
            ];

            $this->m_quotation->save_quo_history($data_hs_quo);



    // ===============================
    // NOTIFIKASI
    // ===============================
$this->session->set_flashdata('success', 'Status Sales <strong>Berhasil</strong> Diubah!');
    
    // Kembali ke halaman asal (stay di halaman tempat user klik button)
    if (isset($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        // Fallback jika referer tidak terdeteksi, baru diarahkan ke detail
        redirect('user/quotation/detail_quo/'.$id_hd);
    }
}


    public function update_quo_pl(){ 

    date_default_timezone_set('Asia/Jakarta');

    $id_hd     = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');

    if (!empty($_FILES['gambar_penawaran']['name'])) {

        $config['upload_path']   = './img/uploads/gambar_penawaran/';
        $config['allowed_types'] = '*';
        $config['max_size']      = 20000;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_penawaran')) {

            $upload_data = $this->upload->data();
            $nama_file   = $upload_data['file_name'];
            $nama_asli   = $upload_data['orig_name'];   

            /* =============================
               SIMPAN FILE
            ==============================*/
            $data_file = [
                'id_quo_dt'        => $id_quo_dt,
                'gambar_penawaran' => $nama_file,
                'nama_asli'        => $nama_asli,   

                'tanggal_upload'   => date('Y-m-d H:i:s'),
                'action_by'        => $this->session->login['nama']
            ];

            $this->db->insert('gambar_penawaran_file', $data_file);


            // update status_gambar
    $this->db->where('id_quo_dt', $id_quo_dt);
    $this->db->where('status_gambar', 'Belum Ada Gambar Penawaran');
    $this->db->update('alba_quotation_dt', [
    'status_gambar' => 'Sudah Ada Gambar Penawaran'
]);


            /* =============================
               SIMPAN HISTORY
            ==============================*/
            $data_hs_quo = [
                'action_qt_by'  => $this->session->login['nama'],
                'actiontime_qt' => date('Y-m-d H:i:s'),
                'no_qt'         => $this->input->post('no_qt'),
                'status'        => 'Upload Gambar Penawaran (Detail ID: '.$id_quo_dt.')'
            ];

            $this->m_quotation->save_quo_history($data_hs_quo);

        } else {
            echo $this->upload->display_errors();
            exit;
        }
    }

   // NOTIFIKASI
    $this->session->set_flashdata('success', 'Upload <strong>Gambar</strong> Penawaran!');
    
    // Kembali ke halaman asal (stay di halaman tempat user klik button)
    if (isset($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        // Fallback jika referer tidak terdeteksi, baru diarahkan ke detail
        redirect('user/quotation/detail_quo/'.$id_hd);
    }
}
    public function hapus_file()
{
	    date_default_timezone_set('Asia/Jakarta');

    $id_file   = $this->input->post('id');
    $id_hd     = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');

    $header = $this->db->get_where('alba_quotation_hd', [
    'id' => $id_hd
])->row();

    $file = $this->db->get_where('gambar_penawaran_file', [
        'id' => $id_file
    ])->row();

    if ($file) {

        $path = './img/uploads/gambar_penawaran/'.$file->gambar_penawaran;

        // Hapus file fisik
        if (file_exists($path)) {
            unlink($path);
        }

        // Hapus database
        $this->db->delete('gambar_penawaran_file', [
            'id' => $id_file
        ]);

            /*          SIMPAN HISTORY
            ==============================*/
            $data_hs_quo = [
                'action_qt_by'  => $this->session->login['nama'],
                'actiontime_qt' => date('Y-m-d H:i:s'),
                'no_qt'         => $header->number_quo, // ambil langsung dari DB
                'status'        => 'Hapus Gambar Penawaran (Detail ID: '.$id_quo_dt.')'
            ];

            $this->m_quotation->save_quo_history($data_hs_quo);


        $this->session->set_flashdata('success', 'File berhasil dihapus');
    }

    redirect('user/quotation/detail_quo/'.$id_hd);
   
}

    
  
    public function update_status() {
    	date_default_timezone_set('Asia/Jakarta');
    	
    $id_hd = $this->input->post('id_header');
    $id_quo_dt = $this->input->post('id_quo_dt');
    $status_qr_quo = $this->input->post('status_qr_quo');    
    
$data = [
    'status_qr_quo' => $status_qr_quo
];

$this->m_quotation->update_status_proses($id_quo_dt, $data);

    // History
    $data_hs_quo['action_qt_by'] = $this->session->login['nama'];
			$data_hs_quo['actiontime_qt'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_quo_dt');
			$data_hs_quo['no_qt'] = $this->input->post('no_qt');
			$data_hs_quo['status'] = 'Update Status id '.$idnya;
			$this->m_quotation->save_quo_history($data_hs_quo); //simpan ke tabel log status pr

    $this->session->set_flashdata('success', 'Detail QT <strong>Berhasil</strong> Diubah!');
    redirect('user/quotation/detail_quo/'.$id_hd);
}

    public function quo_item_selesai($id_lsp = NULL){
    $this->data['aktif'] = 'quotation';
    $this->data['title'] = 'Selesai';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    //$jenis_status = 'Selesai';
    
    $this->data['all_quo'] = $this->m_quotation->lihat_quo_selesai();

     //$this->m_quotation->lihat_quo_selesai(); //simpan ke tabel log status pr
 
    $this->load->view('user/quotation/list_quo_selesai_item', $this->data);
}   
    
    public function hapus_quo($id){
		date_default_timezone_set('Asia/Jakarta');
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$data_log['ket'] = 'Hapus Permintaan Barang';
		$data_log['kode'] = $id;


		if(!empty($id)){ 
			$this->m_quotation->hapus_quo_dt($id);
			$this->m_quotation->hapus_quo_history($id);
			$this->m_quotation->hapus_quo_hd($id) ;
			$this->session->set_flashdata('success', 'Permintaan Barang <strong>Berhasil</strong> Dihapus!');
			redirect('user/quotation/list_quo_order'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('user/quotation/list_quo_order'); //redirect page
		}
	}
    
 
public function save_quo_sattle($id = NULL) { 
			date_default_timezone_set('Asia/Jakarta');
  //  echo '<pre>';
  //      print_r ($_POST);
   //     echo '</pre>';
    //   exit;
			$id_hd = $this->input->post('id');

			// Data untuk update ke header
    $data_qt['number_1'] = $this->input->post('number_1');
    $data_qt['created_quo'] = $this->session->login['nama'];
    $data_qt['createdtime_quo'] = date('Y-m-d H:i:s');

    // Update number_1 ke tabel header, bukan insert
    $this->m_quotation->update_number_quo($id_hd, $data_qt);

			
			$data_qt['created_quo'] = $this->session->login['nama'];
			$data_qt['createdtime_quo'] = date('Y-m-d H:i:s');
			$this->m_quotation->simpan_qt_dt($data_qt); //Update pr hd

			$data_kode_quo['kode_otomatis'] = $this->input->post('number_1');
			$this->m_quotation->simpan_kode_terakhir_quo($data_kode_quo); //simpan_kode_terakhir

		
		$number_po = $this->input->post('number_1');
		
		$number_1 = $this->input->post('number_quo');
		$detailName_quo = $this->input->post('detailName_quo');   
		$kd_cst_quo = $this->input->post('kd_cst_quo');  
		//$estimasi_harga = $this->input->post('estimasi_harga'); 
		$status_proses_quo = $this->input->post('status_proses_quo');  

		$detailNotes_quo = $this->input->post('detailNotes_quo');
   
		$id_quo_dt = $this->input->post('id_quo_dt');

    		$this->m_quotation->save_quo_sattle_dt($number_po,$number_1,$detailName_quo,$id_quo_dt,$status_proses_quo,$detailNotes_quo,$kd_cst_quo); //untuk tabel quo dt

    	//	$this->m_quotation->save_po_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$estimasi_harga,$status_proses_pr,$detailNotes, $qr_code ); //untuk tabel purchase d


    			$data_hs_quo['no_qt'] = $number_1;
    			$data_hs_quo['status'] = 'Quotation Baru '.$number_po;
    			$data_hs_quo['action_qt_by'] = $this->session->login['nama'];
    			$data_hs_quo['actiontime_qt'] = date('Y-m-d H:i:s');
			$this->m_quotation->save_quo_history($data_hs_quo); //simpan ke tabel quo history


        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

//echo '<pre>';
//print_r($id_quo_dt);
//echo '</pre>';
//exit;
			$this->session->set_flashdata('error', 'PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
       redirect('user/quotation/list_quotation_item'); //redirect page
     }


	}
