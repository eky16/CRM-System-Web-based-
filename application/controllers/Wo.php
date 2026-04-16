<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('m_pembelian', 'm_pembelian');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_sales', 'm_sales');
		$this->load->model('M_kendaraan', 'm_kendaraan');
	}

	public function tambah($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Sales Order';
		$this->data['no'] = 1;

		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sales'] = $this->m_sales->lihat();
		$this->data['warna'] = $this->m_barang->lihat_warna(); //get data barang

		$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
		$this->data['all_unit'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$this->data['satuan'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_pembelian->cekkode_purcahase_order();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1; 
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('pembelian/tambah_pr', $this->data);
}
	public function tambah_jadwal_kirim($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Jadwal Pengiriman Barang';
		$this->data['no'] = 1;
 
 	   $this->data['kendaraan'] = $this->m_kendaraan->get_kendaraan_aktif();
		$this->data['supir'] = $this->m_karyawan->get_supir();
		$this->data['kenek'] = $this->m_karyawan->get_kenek();
		$this->data['warna'] = $this->m_barang->lihat_warna(); //get data barang

		$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
		$this->data['all_unit'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$this->data['satuan'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$dariDB = $this->m_pembelian->nomor_kirim();
		$nourut = substr($dariDB, 8, 4); //sembunyikan kata dari baris 1 sd 8 , kemudian ambil 4 angka terakhir
		$kodenikSekarang = $nourut + 1; // 4 angka terakhir dari database di tambah 1
		$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('pembelian/tambah_jadwal_kirim', $this->data);
}
      public function get_data_barang_kirim_by_date(){ 
      	$tanggal_kirim = $this->input->post('id2',TRUE);
      	$data = $this->m_pembelian->ambil_data_kiriman_byDate($tanggal_kirim)->result();
      	echo json_encode($data);
      } 
	public function userList(){
    // POST data
		$postData = $this->input->post();

    // get data
		$data = $this->m_pembelian->getUsers($postData);

		echo json_encode($data);
	}
				public function ubah_po_Hd_back(){
		date_default_timezone_set('Asia/Jakarta');
		
		$id_hd = $this->input->post('id_header');
		$update_dt['number_'] = $this->input->post('number_');
		$update_dt['id'] = $this->input->post('id_header');
		$update_dt['status_po'] = $this->input->post('status_po');
      $this->m_pembelian->save_update_po_hd($update_dt); //simpan ke tabel pr dtdt

      $ket001 = $this->input->post('status_po');
      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Update Status PO '. $ket001;
      $data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			if ($ket001 == 5){
					$hasil_keterangan = 'Approval Direksi';
			}
			if ($ket001 == 11){
					$hasil_keterangan = 'Approval PM';
			}
			if ($ket001 == 4){
					$hasil_keterangan = 'Approval Estimator';
			}

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$no_ = $this->input->post('number_');
			$data_hs['status'] = 'Ubah Status PO - '. $no_ .', '. $hasil_keterangan;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PO <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail Pesanan Pembelian <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

public function tambah_spk($id_lsp = NULL){
	$this->data['aktif'] = 'pembelian';
	$this->data['title'] = 'Permintaan Barang';
	//$this->data['all_Mom'] = $this->m_mom->lihat();
	$this->data['no'] = 1;
	$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	$this->data['view_task'] = $this->m_kerja->my_modul();
	$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	$this->data['proyek'] = $this->m_pembelian->daftar_project();
	$this->data['vendor'] = $this->m_payment->lihat();
	$this->data['all_vendor'] = $this->m_barang->lihat_pemasok(); //get data Pemasok
	$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
	$this->data['all_unit'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
	$id = $this->session->login['kode'];
	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		    	$latestNumber = $this->m_pembelian->getLatestNumber();
	    	$id_sekarang = $latestNumber + 2 ;
    		$this->data['latestNumber'] = $id_sekarang;

	$dariDB_csa = $this->m_pembelian->cekkode_purcahase_order_CSA();
	$nourut_csa = substr($dariDB_csa, 0, 4);
	$kodeCSA = $nourut_csa + 1;
      	$this->data['generate_kode_csa']  = $kodeCSA; // nomor_csa

      	$dariDB_msa = $this->m_pembelian->cekkode_purcahase_order_MSA();
      	$nourut_msa = substr($dariDB_msa, 0, 4);
      	$kodeMSA = $nourut_msa + 1;
      	$this->data['generate_kode_msa']  = $kodeMSA; // nomor_csa

      	$dariDB_spk_csa = $this->m_pembelian->cekkode_purcahase_order_SPK_CSA();
      	$nourut_spk_csa = substr($dariDB_spk_csa, 0, 3); 
      	$kodeSPKCSA = $nourut_spk_csa + 1;
      	$this->data['generate_kode_spk_csa']  = $kodeSPKCSA; // nomor_csa

      	$dariDB_spk_msa = $this->m_pembelian->cekkode_purcahase_order_SPK_MSA();
      	$nourut_spk_msa = substr($dariDB_spk_msa, 0, 3);
      	$kodeSPKMSA = $nourut_spk_msa + 1;
      	$this->data['generate_kode_spk_msa']  = $kodeSPKMSA; // nomor_csa
      	$dariDB = $this->m_pembelian->cekkode_purcahase_order();

      	$nourut = substr($dariDB, 12, 5);
      	$kodenikSekarang = $nourut + 1;
      	$this->data['kode_nik']  = $kodenikSekarang ;

      	$this->load->view('pembelian/tambah_spk', $this->data);
      }
      public function get_data_barang_permintaan(){  
      	$data = $this->m_barang->lihat_nama_barang_permintaan($_POST['id_dt']); 
      	echo json_encode($data);
      }
      public function get_all_barang(){  
      	$data = $this->m_barang->lihat_nama_barang1($_POST['Nama_Barang']); 
      	echo json_encode($data);
      }
      function get_satuan_barang(){
      	$category_id = $this->input->post('id',TRUE);
      	$data = $this->m_barang->get_sub_category($category_id)->result();
      	echo json_encode($data);
      }
      public function get_stok_barang(){ 
        $Kode_Barang = $this->input->post('id',TRUE);   
      	$data = $this->m_barang->get_stok_barang($Kode_Barang); 
      	echo json_encode($data);
      }
      
      public function get_stok_barang_forecast(){ 
        $Kode_Barang = $this->input->post('id',TRUE);  

      	$data = $this->m_pembelian->get_stok_barang_forecast($Kode_Barang); 
      	echo json_encode($data);
      }
      public function keranjang_barang(){
      	$this->load->view('pembelian/keranjang');
      }
      public function keranjang_pengiriman(){
      	$this->load->view('pembelian/keranjang_pengiriman');
      }
      public function keranjang_barang_spk(){
      	$this->load->view('pembelian/keranjang_spk');
      }
      public function proses_tambah_pr(){

        date_default_timezone_set('Asia/Jakarta');
 
      	$jumlah_permintaan_barang = count($this->input->post('detailName_hidden'));
      	$transDate = $this->input->post('transDate'); 
        //	$number_ = $this->input->post('number_');
      	$number_pr = $this->input->post('number_pr');
      	$no_permintaan = $this->input->post('no_permintaan');
      	$kd_cst = $this->input->post('kd_cst'); 
      	$kd_sales = $this->input->post('kd_sales'); 
      	$toAddress = $this->input->post('toAddress');
      	$created_po = $this->session->login['nama'];
      	$createdtime_po = date('Y-m-d H:i:s');

      	$data_hd['transDate'] = $transDate;
		//	$data_hd['number_'] = $number_;
      	$data_hd['number_pr'] = $number_pr;
      	$data_hd['no_permintaan'] = $no_permintaan;
      	$data_hd['kd_cst'] = $kd_cst;
      	$data_hd['kd_sales'] = $kd_sales;
      	$data_hd['toAddress'] = $toAddress;
      	$data_hd['created_po'] = $created_po;
      	$data_hd['createdtime_po'] = $createdtime_po;
			$this->m_pembelian->save_purchase_hd($data_hd); //simpan ke tabel alba permintaan barang hd

$data_detail_keluar = [];

for ($i = 0; $i < $jumlah_permintaan_barang; $i++) {
	
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
        $data_detail_keluar[$i]['gambar_kerja'] = $uploadData['file_name'];
    } else {
        // Handle ketika tidak ada file diunggah
        $data_detail_keluar[$i]['gambar_kerja'] = ''; // Atau isikan dengan nilai default yang sesuai
    }

    $data_detail_keluar[$i]['number_request'] = $this->input->post('number_pr');
    $data_detail_keluar[$i]['kd_cst'] = $this->input->post('kd_cst');
    $data_detail_keluar[$i]['detailName'] = $this->input->post('detailName_hidden')[$i];
    $data_detail_keluar[$i]['itemNo'] = $this->input->post('itemNo_hidden')[$i];
    $data_detail_keluar[$i]['warna'] = $this->input->post('warna_hidden')[$i];
    $data_detail_keluar[$i]['quantity'] = $this->input->post('quantity_hidden')[$i];
    $data_detail_keluar[$i]['itemUnitName'] = $this->input->post('itemUnitName_hidden')[$i];
    $data_detail_keluar[$i]['detailNotes'] = $this->input->post('detailNotes_hidden')[$i];
    $data_detail_keluar[$i]['status_packing'] = $this->input->post('status_packing_hidden')[$i];
}
// yang status packing kiri itu nama field di tabel db nya, yang kanan itu yang dari program name yang dari keranjang

 // $this->db->insert('alba_permintaan_barang_dt',$data_detail_keluar);
			$this->m_pembelian->save_purchase_dt1($data_detail_keluar); //simpan ke tabel alba permintaan barang dt

			$data_hs['no_po'] = $number_pr;
			$data_hs['status'] = 'Permintaan Barang Dibuat';
			$data_hs['action_by'] = $created_po;
			$data_hs['actiontime'] = $createdtime_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel alba purchase history

			$this->session->set_flashdata('success', 'Permintaan <strong>Barang</strong> Berhasil Dibuat!');
			redirect('wo/list_permintaan'); //redirect page
		}
      public function proses_tambah_pengiriman(){
      	date_default_timezone_set('Asia/Jakarta');
      	$jumlah_permintaan_barang = count($this->input->post('detailName_hidden'));

      	$Selesai       = 'Selesai';
      	
      	$no_pengiriman = $this->input->post('kode_pengiriman');
      	$id_dt         = $this->input->post('id_dt_hidden');
      	$detailName	   = $this->input->post('detailName_hidden');
      	$created_po    = $this->session->login['nama'];
      	$createdtime_po = date('Y-m-d H:i:s');

      

      	$data_hd['kode_pengiriman'] = $this->input->post('kode_pengiriman');
      	$data_hd['nama_supir']      = $this->input->post('nama_supir');
      	$data_hd['nama_kenek']      = $this->input->post('nama_kenek');
      	$data_hd['no_kendaraan'] = $this->input->post('no_kendaraan');
      	$data_hd['tgl_kiriman']     = $this->input->post('tgl_kiriman');
      	$data_hd['dibuat']          = $created_po;
      	$data_hd['tgl_dibuat']      = $createdtime_po;
			$this->m_pembelian->save_pengiriman_hd($data_hd); //simpan ke tabel alba pengiriman barang hd

			$data_detail_keluar = [];

			for($i = 0; $i < $jumlah_permintaan_barang; $i++){
				array_push($data_detail_keluar, ['kd_pengiriman' => $no_pengiriman]);
				$data_detail_keluar[$i]['id_permintaan'] = $this->input->post('id_dt_hidden')[$i];
				$data_detail_keluar[$i]['catatan_kiriman'] = $this->input->post('detailNotes_hidden')[$i];
			}
			$this->m_pembelian->save_pengiriman_dt($data_detail_keluar); //simpan ke tabel alba permintaan barang dt
			$this->m_pembelian->update_status_permintaan_selesai($Selesai,$no_pengiriman,$id_dt,$detailName); //update ke tabel alba permintaan barang dt

			$data_hs['no_po'] = $no_pengiriman;
			$data_hs['status'] = 'Pengiriman Barang Dibuat';
			$data_hs['action_by'] = $created_po;
			$data_hs['actiontime'] = $createdtime_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel alba purchase history

			$this->session->set_flashdata('success', 'Pengiriman <strong>Barang</strong> Berhasil Dibuat!');
			redirect('wo/pengiriman'); //redirect page
		}

		public function update_open_po($id = NULL) { 
			date_default_timezone_set('Asia/Jakarta');
		//	echo '<pre>';
		//	print_r ($_POST);
		//	echo '</pre>';
     //  print POST
        //print_r($this->db->last_query()); //print query
		//	exit;
				  $id_dt = $this->input->post('id_dt'); //array of id
					$number_pr = $this->input->post('number_pr'); //  array
					$id_redirect = $this->input->post('id_redirect'); //  array
					if(!empty($number_pr) ) {

						$result = array();
						foreach($id_dt AS $key => $val){
							$result[] = array(
								'id_dt'   => $id_dt[$key],
								'number_request'   => $number_pr[$key]
							);
						}      
            //MULTIPLE INSERT TO DETAIL TABLE
						$this->db->update_batch('purchase_order_dt', $result,'id_dt'); 
						$this->session->set_flashdata('success', 'Permintaan barang <strong>Berhasil</strong> Diproses!');
					}
					$this->session->set_flashdata('error', 'Permintaan barang<strong>Gagal</strong> Diproses!');

        redirect('pembelian/kelengkapan_pr/'.$id_redirect); //redirect page
      }
 public function kelengkapan_pr($id_pr = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'Permintaan Barang';

      	$this->data['no'] = 1;
				$id = $this->session->login['kode'];
				$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
				$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
				$this->data['satuan'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
				$this->data['warna'] = $this->m_barang->lihat_warna(); //get data Pemasok
				
				$this->data['dt_pr'] = $this->m_pembelian->lihat_pr_detail_dt_aksi($id_pr);
				$this->data['dt_pr_all'] = $this->m_pembelian->lihat_pr_detail_dt_aksi_all($id_pr);

				$this->data['hd_pr'] = $this->m_pembelian->lihat_pr_detail_hd($id_pr);

				$dariDB_wo = $this->m_pembelian->cekkode_pesanan(); //ambil kode WO dari tabel alba_kode_otomatis
				$nourut_wo = substr($dariDB_wo, 11, 4); // ambil 4 angka kode urutan ke 11 
				$kodeWO = $nourut_wo + 1; // kode terakhir di tambah 1
		    	$this->data['generate_kode_wo']  = $kodeWO; // hasill

				$dariDB_stok = $this->m_pembelian->cekkode_stok(); //ambil kode Stok dari tabel alba_kode_otomatis
				$nourut_stok = substr($dariDB_stok, 10, 4); // ambil 4 angka kode urutan ke 11 
				$kodeStok = $nourut_stok + 1; // kode terakhir di tambah 1
		    	$this->data['generate_kode_stok']  = $kodeStok; // hasill


      	$this->load->view('pembelian/ubah_pr', $this->data);
      }
    public function list_permintaan($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Sales Order';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_1(); 

		$this->load->view('pembelian/list_pr', $this->data);
	}
    public function proses_permintaan_barang($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'Permintaan Barang Sedang Diproses';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_2(); 


		$this->load->view('pembelian/list_pr', $this->data);
	}
	

    public function list_permintaan_item($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'Kemajuan Pesanan Sales Order';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');
        
        if ($jenis_tanggal == 'Semua Data' ){
		$this->data['all_pr'] = $this->m_pembelian->lihat_Item_pr_status_belum_proses_01(); 
		}
		if ($jenis_tanggal == 'tanggal_kirim' or $jenis_tanggal == 'transDate' and $tanggal !='' ){
		$this->data['all_pr'] = $this->m_pembelian->lihat_Item_pr_status_belum_proses($tanggal,$dan_tanggal, $jenis_tanggal); 
		}
		if (empty($jenis_tanggal)){
		$this->data['all_pr'] = $this->m_pembelian->lihat_Item_pr_status_belum_proses_01(); 
		}



		$this->load->view('pembelian/list_all_item_pr', $this->data);
	}
	public function export_excel_permintaan_diproses(){   
           $this->data = array( 'title' => 'KEMAJUAN PESANAN MARKETING ',
                'all_barang' => $this->m_pembelian->lihat_kemajuan_pesanan_mkt());

        		$this->load->view('pembelian/laporan/laporan_permintaan_proses', $this->data); 
    	}
	public function ubah_pr_dt_prosesto_po(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_produksi'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 1; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 2; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 3; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 4; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 5; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 6; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}

// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}


			$id_hd = $this->input->post('id_header');
			$cek_status =  $this->input->post('status_qr');
			$customer =  $this->input->post('customer');
			$cek_stok =  $this->input->post('Stok');
			$cek_stok_forecast =  $this->input->post('Stok_Forecast');
			$cek_status_proses =  $this->input->post('status_proses_pr');
			$qty_permintaan =  $this->input->post('quantity');
			$cek_status_line =  $this->input->post('status_line');
			

			

			//validasi jika status stok & status proses 2 dan jumlah permintaan lebih dari stok maka beri pesan gagal simpan.
			if($cek_status == 'Stok' && $cek_status_proses == 2 &&  $qty_permintaan > $cek_stok ){
			$this->session->set_flashdata('error_stok', ' <strong>Gagal</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}

			//validasi jika status Forecast & customer bukan Forecast & status proses 2 dan jumlah permintaan lebih dari stok maka beri pesan gagal simpan.
			if($cek_status == 'Forecast' && $customer != 'Forecast' && $cek_status_proses == 2 &&  $qty_permintaan > $cek_stok_forecast ){
			$this->session->set_flashdata('error_stok', ' <strong>Gagal</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}

			//validasi jika status Forecast & status proses 2 dan jumlah permintaan kurang atau sama dari stok maka beri pesan berhasil simpan dan memotong jumlah stok.
			if($cek_status == 'Forecast' and $customer != 'Forecast' and $cek_status_proses == 2 and  $qty_permintaan <= $cek_stok_forecast ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_awal'] = $this->input->post('status_qr');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['tgl_perkiraan'] = $this->input->post('tgl_perkiraan');
			$update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
			$update_dt['status_line'] = $this->input->post('status_line');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');

            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi'); //31, tgl otomatis dari cutting sampai packing 
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt


			$nama_barang = $this->input->post('detailName');
			$id_forecast = $this->input->post('id_barang_forecast');
			$qty = $this->input->post('quantity');
			$this->m_pembelian->kurangi_stok_forecast($qty,$id_forecast); // kurangi stok barang


			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}


			//validasi jika status stok & status proses 2 dan jumlah permintaan kurang atau sama dari stok maka beri pesan berhasil simpan dan memotong jumlah stok.
			if($cek_status == 'Stok'and $cek_status_proses == 2 and  $qty_permintaan <= $cek_stok ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_awal'] = $this->input->post('status_qr');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['no_wo'] = $this->input->post('no_wo');
            $update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');
		   

			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;

			$data_keluar = [
			'no_keluar' => $this->input->post('no_wo'), //no_po, jika ingin ada ket. di tran.keluar.
			'tgl_keluar' => date('Y-m-d'),
			'jam_keluar' => date('H:i:s'),
			'nama_customer' => $this->input->post('nama_customer'),
			'nama_petugas' => $this->session->login['nama'],
			];
			$data_keluar_dt = [
			'no_keluar' => $this->input->post('no_wo'), //no_po, jika ingin ada ket. di tran.keluar.
			'nama_barang' => $this->input->post('detailName'),
			'jumlah' => $this->input->post('quantity'),
			
			'satuan' => $this->input->post('itemUnitName'),
			'nama_customer' => $this->input->post('nama_customer'),
			'ket_keluar' => $this->input->post('detailNotes'),
			];

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt
			$this->m_pembelian->save_pengeluaran_hd($data_keluar);
			$this->m_pembelian->save_pengeluaran_dt($data_keluar_dt);

			


			$nama_barang = $this->input->post('detailName');
			//$itemno = $this->input->post('itemNo');
			$qty = $this->input->post('quantity');
			$id_dt = $this->input->post('id_dt');
			$this->m_pembelian->min_stok($qty,$nama_barang, $id_dt); // kurangi stok barang
			

			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}

			
			//validasi jika status stok & status proses bukan 2   maka beri pesan berhasil simpan .
			if($cek_status == 'Stok' && $cek_status_proses != 2 ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');


			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}
			//validasi jika status Forecast & status proses bukan 2   maka beri pesan berhasil simpan .
			if($cek_status == 'Forecast' && $cek_status_proses != 2 ){
               
				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');
            
            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi');  //31 tgl otomatis dari cutting sampai packing
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}

            //validasi jika status Subcon  maka beri pesan berhasil simpan .
			if($cek_status == 'Subcon' ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_awal'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['tgl_perkiraan'] = $this->input->post('tgl_perkiraan');
			$update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
			$update_dt['status_line'] = $this->input->post('status_line');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');
            
            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi'); //31 tgl otomatis dari cutting sampai packing
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

			  $data_log['user'] = $this->session->login['nama'];
		      $data_log['waktu'] = date('Y-m-d H:i:s');
		      $data_log['ket'] = 'Update Detail Barang';
		      $data_log['kode'] = $this->input->post('id_dt');
					

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}

			//validasi jika status produksi  maka beri pesan berhasil simpan .
			if($cek_status == 'Produksi' ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_awal'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['tgl_perkiraan'] = $this->input->post('tgl_perkiraan');
			$update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
			$update_dt['status_line'] = $this->input->post('status_line');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');
            
            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi'); //31 tgl otomatis dari cutting sampai packing
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

			  $data_log['user'] = $this->session->login['nama'];
		      $data_log['waktu'] = date('Y-m-d H:i:s');
		      $data_log['ket'] = 'Update Detail Barang';
		      $data_log['kode'] = $this->input->post('id_dt');
					

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}
				//validasi jika status Forecast dan customer Forecast  maka beri pesan berhasil simpan .
			if($cek_status == 'Forecast' && $customer =='Forecast' ){

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['status_awal'] = $this->input->post('status_qr');
			$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['tgl_perkiraan'] = $this->input->post('tgl_perkiraan');
			$update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
			$update_dt['status_line'] = $this->input->post('status_line');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['type_barang_pesanan'] = $this->input->post('type_barang_pesanan');
            
            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi'); //31 tgl otomatis dari cutting sampai packing
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

			  $data_log['user'] = $this->session->login['nama'];
		      $data_log['waktu'] = date('Y-m-d H:i:s');
		      $data_log['ket'] = 'Update Detail Barang';
		      $data_log['kode'] = $this->input->post('id_dt');
					

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);
			}


      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	

    public function update_siap_kirim(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			$id_hd = $this->input->post('url');
			$cek_status = $this->input->post('status_qr');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .
			if($cek_status !="Batal"){
								if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['status_packing'] = $this->input->post('status_packing');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			//$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
            $update_dt['ketproblem'] = $this->input->post('ketproblem');
            //$update_dt['no_wo'] = $this->input->post('no_wo');
            $update_dt['blok'] = $this->input->post('blok');
            $update_dt['lantai'] = $this->input->post('lantai');
            $update_dt['zona'] = $this->input->post('zona');
            
			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
			}

	
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
	
	public function ubah_proses(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			    $this->load->library('upload');

			$id_hd = $this->input->post('url');
			$cek_status = $this->input->post('status_qr');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .
			if($cek_status !="Batal"){
				
								 // Proses unggah file part_list
            if (!empty($_FILES['part_list']['name'])) {
                $config['upload_path']   = './img/uploads/part_list';
                $config['allowed_types'] = '*';
                $config['max_size']      = 20000;
                $config['encrypt_name']  = TRUE; // Ini berarti nama file akan diubah menjadi serangkaian karakter acak yang unik setiap kali file diunggah
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('part_list')) {
                    $update_dt['part_list'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                $error = array('error' => $this->upload->display_errors());
                print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }

            // Proses unggah file gambar_kerja
            if (!empty($_FILES['gambar_kerja']['name'])) {
                $config['upload_path']   = './img/uploads/gambar_kerja';
                $this->upload->initialize($config); // Inisialisasi konfigurasi upload baru
                if ($this->upload->do_upload('gambar_kerja')) {
                $update_dt['gambar_kerja'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }

            // Proses unggah file gambar_jadi
            if (!empty($_FILES['gambar_jadi']['name'])) {
                $config['upload_path']   = './img/uploads/gambar_jadi';
                $config['allowed_types'] = '*';
                $config['max_size']      = 20000;
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config); // Inisialisasi konfigurasi upload baru

                if ($this->upload->do_upload('gambar_jadi')) {
                $update_dt['gambar_jadi'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }

            // Proses unggah file packing_list
            if (!empty($_FILES['packing_list']['name'])) {
                $config['upload_path']   = './img/uploads/packing_list';
                 $config['allowed_types'] = '*';
                $config['max_size']      = 20000;
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config); // Inisialisasi konfigurasi upload baru
                if ($this->upload->do_upload('packing_list')) {
                $update_dt['packing_list'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }
            $update_dt['warna'] = $this->input->post('warna');
            $update_dt['detailNotes'] = $this->input->post('detailNotes');
            $update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
            $update_dt['ketproblem'] = $this->input->post('ketproblem');
            $update_dt['blok'] = $this->input->post('blok');
            $update_dt['lantai'] = $this->input->post('lantai');
            $update_dt['zona'] = $this->input->post('zona');
            
			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Update Detail Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
			}

		if($cek_status =="Batal"){ // Kembali ke stock FG .28/08/23
		
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['id_dt'] = $this->input->post('id_dt');

			$data_log['user'] = $this->session->login['nama'];
	      	$data_log['waktu'] = date('Y-m-d H:i:s');
	      	$data_log['ket'] = 'Pembatalan Pesanan Barang';
	      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Pembatalan Pesanan Barang '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
	
            $itemno = $this->input->post('itemNo');
			//$nama_barang = $this->input->post('detailName');
			$stok = $this->input->post('quantity');

			$this->m_barang->plus_stok_from_wo($stok, $itemno); //simpan ke tabel pr dt	

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Stok <strong>Berhasil</strong> Dikembalikan!');
			redirect('wo/'.$id_hd);
		}


      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
public function update_stok_kategori($id_dt, $tgl_terima, $qty, $kategori) {
    // Menghitung tanggal batas untuk kategori aging
    $three_months_ago = date('Y-m-d', strtotime('-3 months'));
    $six_months_ago = date('Y-m-d', strtotime('-6 months'));

    // Menentukan kategori baru berdasarkan tgl_terima
    if ($tgl_terima >= $three_months_ago) {
        $kategori_baru = 'nol_tiga_bulan';
        $tgl_terima_kolom_baru = 'tgl_terima_nol_tigabulan';
    } elseif ($tgl_terima >= $six_months_ago && $tgl_terima < $three_months_ago) {
        $kategori_baru = 'tiga_enam_bulan';
        $tgl_terima_kolom_baru = 'tgl_terima_tiga_enambulan';
    } else {
        $kategori_baru = 'lebih_enam_bulan';
        $tgl_terima_kolom_baru = 'tgl_terima_lebih_enam_bulan';
    }

    // Menentukan kolom tanggal terima lama berdasarkan kategori lama
    if ($kategori == 'nol_tiga_bulan') {
        $tgl_terima_kolom_lama = 'tgl_terima_nol_tigabulan';
    } elseif ($kategori == 'tiga_enam_bulan') {
        $tgl_terima_kolom_lama = 'tgl_terima_tiga_enambulan';
    } else {
        $tgl_terima_kolom_lama = 'tgl_terima_lebih_enam_bulan';
    }

    // Hanya lakukan pembaruan jika kategori baru berbeda dari kategori lama
    if ($kategori !== $kategori_baru) {
        // Mengurangi qty dari kategori lama
        $this->db->set($kategori, $kategori . ' - ' . (int)$qty, false);
        $this->db->where('id_dt', $id_dt);
        $this->db->update('alba_permintaan_barang_dt');

        // Menambah qty ke kategori baru
        $this->db->set($kategori_baru, $kategori_baru . ' + ' . (int)$qty, false);
        $this->db->where('id_dt', $id_dt);
        $this->db->update('alba_permintaan_barang_dt');

        // Kosongkan tanggal terima lama
        $this->db->set($tgl_terima_kolom_lama, NULL);
        $this->db->where('id_dt', $id_dt);
        $this->db->update('alba_permintaan_barang_dt');

        // Isi tanggal terima baru
        $this->db->set($tgl_terima_kolom_baru, $tgl_terima);
        $this->db->where('id_dt', $id_dt);
        $this->db->update('alba_permintaan_barang_dt');
    }
}


public function update_tgl_cutting_act(){
    date_default_timezone_set('Asia/Jakarta');

    $id_hd = $this->input->post('url');

    if (!empty($_FILES['gambar_kerja']['name'])) {
        $config['upload_path'] = './img/uploads/gambar_kerja';
        $config['allowed_types'] = '*';
        $config['max_size'] = 20000;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar_kerja');

        $update_dt['gambar_kerja'] = $this->upload->data("file_name");
    }
    
     // Ambil parameter filter
    $jenis_tanggal = $this->input->post('jenis_tanggal');
    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');

    $update_dt['id_dt'] = $this->input->post('id_dt');
    $update_dt['timescan_cutting'] = $this->input->post('timescan_cutting');

    $data_log['user'] = $this->session->login['nama'];
    $data_log['waktu'] = date('Y-m-d H:i:s');
    $data_log['ket'] = 'Update Detail Barang';
    $data_log['kode'] = $this->input->post('id_dt');

    $data_hs['action_by'] = $this->session->login['nama'];
    $data_hs['actiontime'] = date('Y-m-d H:i:s');
    $idnya = $this->input->post('id_dt');
    $data_hs['no_po'] = $this->input->post('no_po');
    $data_hs['status'] = 'Update Tanggal Scan Cutting id '.$idnya;

    // Debug prints
    //echo '<pre>';
    //echo 'Data received from form:';
    //print_r($_POST);
    //echo 'Data to be saved in purchase history:';
    //print_r($data_hs);
    //echo '</pre>';
    //exit;

    $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

    $this->m_pembelian->save_update_pr_dt($update_dt); // simpan ke tabel pr dt	
    $this->m_mom->tambah_log($data_log); // simpan ke tabel log 	
    $this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
    redirect('wo/'.$id_hd);
}


		public function update_tgl_punching_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_punching'] = $this->input->post('timescan_punching');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan Punching id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function update_tgl_bending_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_bending'] = $this->input->post('timescan_bending');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan Bending id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function update_tgl_welding_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_welding'] = $this->input->post('timescan_welding');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan Welding id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function update_tgl_ps_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_ps'] = $this->input->post('timescan_ps');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan PS id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
        public function update_tgl_fa_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_fa'] = $this->input->post('timescan_fa');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan FA id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function update_tgl_packing_act(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			
			$update_dt['timescan_packing'] = $this->input->post('timescan_packing');
			

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
            $data_hs['actiontime'] = date('Y-m-d H:i:s');
            $idnya = $this->input->post('id_dt');
            $data_hs['no_po'] = $this->input->post('no_po');
            $data_hs['status'] = 'Update Tanggal Scan Packing id '.$idnya;
            $this->m_pembelian->save_purchase_history($data_hs); // simpan ke tabel purchase history

				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
public function update_tgl_cutting(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_cutting'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 1; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 2; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 3; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 4; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 5; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 6; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['tgl_rencana_cutting'] = $tanggal_awal;
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}


public function update_tgl_punching(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_punching'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 1; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 2; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 3; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 4; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 5; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_punching'] = $tanggal_awal;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}


public function update_tgl_bending(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_bending'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 0; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 1; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 2; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 3; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 4; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_bending'] = $tanggal_awal;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

public function update_tgl_welding(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_welding'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 0; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 0; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 1; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 2; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 3; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_welding'] = $tanggal_awal;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

public function update_tgl_ps(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_ps'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 0; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 0; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 0; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 1; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 2; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_ps'] = $tanggal_awal;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

public function update_tgl_fa(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_fa'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 0; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 0; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 0; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 0; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 1; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_fa'] = $tanggal_awal;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

public function update_tgl_packing(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_rencana_packing'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 0; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 0; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 0; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 0; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 0; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 0; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['tgl_rencana_packing'] = $tanggal_awal;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}


			public function ubah_master_schedule_produksi(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

$tanggal_awal = $this->input->post('tgl_produksi'); // Tanggal Produksi (31 untuk tgl otomastis cutting->packing)
$jml_hari_punching = 1; // Jumlah hari untuk masuk ke tahap punching dari tahap cutting
$jml_hari_bending = 2; // Jumlah hari untuk masuk ke tahap bending dari tahap cutting
$jml_hari_welding = 3; // Jumlah hari untuk masuk ke tahap welding dari tahap cutting
$jml_hari_ps = 4; // Jumlah hari untuk masuk ke tahap PS dari tahap cutting
$jml_hari_fa = 5; // Jumlah hari untuk masuk ke tahap FA dari tahap cutting
$jml_hari_packing = 6; // Jumlah hari untuk masuk ke tahap packing dari tahap cutting

//libur nasional harus didefinisikan manual
$libur_nasional = [
    '2024-02-08',
    '2024-02-09',
    '2024-03-01',
    '2024-03-11',
    '2024-03-12',
    '2024-03-29',
    '2024-04-08',
    '2024-04-09',
    '2024-04-10',
    '2024-04-11',
    '2024-04-12',
    '2024-04-15',
    '2024-04-16',
    '2024-04-17',
    '2024-04-18',
    '2024-04-19',
    '2024-05-01',
    '2024-05-09',
    '2024-05-10',
    '2024-05-23',
    '2024-05-24',
    '2024-06-17',
    '2024-06-18',
    '2024-07-07',
    '2024-08-17',
    '2024-09-15',
    '2024-12-25',
    '2024-12-26'
];

// Fungsi untuk menentukan apakah sebuah tanggal adalah tanggal merah, Sabtu, atau Minggu
function isTanggalLiburAtauAkhirPekan($tanggal, $libur_nasional) {
    $hari = date('N', strtotime($tanggal)); // Mendapatkan hari dalam format 1 (Senin) hingga 7 (Minggu)
    return in_array($tanggal, $libur_nasional) || $hari >= 6; // Menghindari Sabtu, Minggu, atau tanggal merah
}


// Menghitung tanggal-tanggal hasil dari setiap tahap
$tgl_hasil_punching = $tanggal_awal;
while ($jml_hari_punching > 0) {
    $tgl_hasil_punching = date('Y-m-d', strtotime($tgl_hasil_punching . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_punching, $libur_nasional)) {
        $jml_hari_punching--;
    }
}

$tgl_hasil_bending = $tanggal_awal;
while ($jml_hari_bending > 0) {
    $tgl_hasil_bending = date('Y-m-d', strtotime($tgl_hasil_bending . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_bending, $libur_nasional)) {
        $jml_hari_bending--;
    }
}

$tgl_hasil_welding = $tanggal_awal;
while ($jml_hari_welding > 0) {
    $tgl_hasil_welding = date('Y-m-d', strtotime($tgl_hasil_welding . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_welding, $libur_nasional)) {
        $jml_hari_welding--;
    }
}

$tgl_hasil_ps = $tanggal_awal;
while ($jml_hari_ps > 0) {
    $tgl_hasil_ps = date('Y-m-d', strtotime($tgl_hasil_ps . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_ps, $libur_nasional)) {
        $jml_hari_ps--;
    }
}

$tgl_hasil_fa = $tanggal_awal;
while ($jml_hari_fa > 0) {
    $tgl_hasil_fa = date('Y-m-d', strtotime($tgl_hasil_fa . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_fa, $libur_nasional)) {
        $jml_hari_fa--;
    }
}

$tgl_hasil_packing = $tanggal_awal;
while ($jml_hari_packing > 0) {
    $tgl_hasil_packing = date('Y-m-d', strtotime($tgl_hasil_packing . ' +1 day'));
    if (!isTanggalLiburAtauAkhirPekan($tgl_hasil_packing, $libur_nasional)) {
        $jml_hari_packing--;
    }
}

			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
            $update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
            $update_dt['status_line'] = $this->input->post('status_line');
            $update_dt['ketproblem'] = $this->input->post('ketproblem');
           
            $update_dt['tgl_rencana_cutting'] = $this->input->post('tgl_produksi');
            $update_dt['tgl_rencana_punching'] = $tgl_hasil_punching;
            $update_dt['tgl_rencana_bending'] = $tgl_hasil_bending;
            $update_dt['tgl_rencana_welding'] = $tgl_hasil_welding;
            $update_dt['tgl_rencana_ps'] = $tgl_hasil_ps;
            $update_dt['tgl_rencana_fa'] = $tgl_hasil_fa;
            $update_dt['tgl_rencana_packing'] = $tgl_hasil_packing;

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
           
		
			public function ubah_master_forecast_to_stok(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			$id_hd = $this->input->post('url');
			 $proses = $this->input->post('proses'); // Menentukan apakah parsial atau non-parsial
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				    // Proses unggah file part_list
            if (!empty($_FILES['part_list']['name'])) {
                $config['upload_path']   = './img/uploads/part_list';
                $config['allowed_types'] = '*';
                $config['max_size']      = 20000;
                $config['encrypt_name']  = TRUE; //  nama file akan diubah menjadi serangkaian karakter acak yang unik setiap kali file diunggah
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('part_list')) {
                    $update_dt['part_list'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                $error = array('error' => $this->upload->display_errors());
                print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }

            // Proses unggah file gambar_kerja
            if (!empty($_FILES['gambar_kerja']['name'])) {
                $config['upload_path']   = './img/uploads/gambar_kerja';
                $config['allowed_types'] = '*';
                $config['max_size']      = 20000;
                $config['encrypt_name']  = TRUE; // Ini berarti nama file akan diubah menjadi serangkaian karakter acak yang unik setiap kali file diunggah
                $this->load->library('upload', $config);
                $this->upload->initialize($config); // Inisialisasi konfigurasi upload baru
                if ($this->upload->do_upload('gambar_kerja')) {
                $update_dt['gambar_kerja'] = $this->upload->data("file_name");
                } else {
                // Handle error jika upload gagal
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); // Tampilkan pesan error, sesuaikan dengan kebutuhan Anda
                }
            }
			

if ($proses === 'partial') {

	$data = json_decode(file_get_contents("php://input"), true);
date_default_timezone_set('Asia/Jakarta');
$status_qr = $this->input->post('status_qr');
$no_terima = $this->input->post('no_wo');


    // Jika status QR adalah 'Packing'
    if ($status_qr === 'Packing') {
        $update_dt['status_qr'] = 'Packing';
        $update_dt['status_proses_pr'] = '3';
        $update_dt['id_dt'] = $this->input->post('id_dt');
        $update_dt['no_wo'] = $this->input->post('no_wo');
        $this->m_pembelian->save_update_pr_dt($update_dt); // Simpan ke tabel pr dt

        // Update stok
        $nama_barang = $this->input->post('detailName');
        $qty_selesai = $this->input->post('qty_selesai');
        $this->m_barang->plus_stok_partial($qty_selesai, $nama_barang); // Simpan ke tabel stok

        // Data penerimaan partial
        $unique_id = round(microtime(true) * 1000) . '-' . rand(100, 999);


        $data_terima_partial = [
             'no_terima' => $this->input->post('no_wo') . '-' . $unique_id,
            'tgl_terima'    => date('Y-m-d'),
            'jam_terima'    => date('H:i:s'),
            'nama_supplier' => 'Forecast',
            'nama_petugas'  => $this->session->login['nama'],
        ];
        $this->m_pembelian->save_proses_forecasttostok_partial($data_terima_partial); // Simpan ke tabel penerimaan hd

        $data_terima_dt['no_terima'] = $this->input->post('no_wo') . '-' . $unique_id;
$data_terima_dt['nama_barang'] = $this->input->post('detailName');
$data_terima_dt['jumlah'] = $this->input->post('qty_selesai');
$data_terima_dt['min_jumlah'] = $this->input->post('qty_selesai');
$data_terima_dt['satuan'] = $this->input->post('itemUnitName');
$data_terima_dt['tgl_terima_dt'] = $this->input->post('tgl_terima1');
$data_terima_dt['jam_terima_dt'] = $this->input->post('jam_terima1');

$this->m_pembelian->save_proses_forecasttostok_dt($data_terima_dt);

        $this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
        redirect('wo/' . $id_hd);

        echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    exit;
    }

    // Jika status QR adalah 'Selesai'
    elseif ($status_qr === 'Selesai') {
        // Update status QR dan status proses
        $update_dt['status_qr'] = 'Selesai';
        $update_dt['status_proses_pr'] = 'Selesai';
        $update_dt['id_dt'] = $this->input->post('id_dt');
        $update_dt['no_wo'] = $this->input->post('no_wo');
        $this->m_pembelian->save_update_pr_dt($update_dt); // Simpan ke tabel pr dt

        // Update stok
        $nama_barang = $this->input->post('detailName');
        $qty_selesai = $this->input->post('qty_selesai');
        $this->m_barang->plus_stok_partial($qty_selesai, $nama_barang); // Simpan ke tabel stok

        // Data penerimaan partial
        $no_terima_selesai = $this->input->post('no_wo') . '-' . time();

        $data_terima_partial = [
            'no_terima'     => $no_terima_selesai,
            'tgl_terima'    => date('Y-m-d'),
            'jam_terima'    => date('H:i:s'),
            'nama_supplier' => 'Forecast',
            'nama_petugas'  => $this->session->login['nama'],
        ];
        $this->m_pembelian->save_proses_forecasttostok_partial($data_terima_partial); // Simpan ke tabel penerimaan hd

        // Data penerimaan detail
        $data_terima_dt = [
            'no_terima'     => $no_terima_selesai,
            'nama_barang'   => $this->input->post('detailName'),
            'jumlah'        => $this->input->post('qty_selesai'),
            'min_jumlah'    => $this->input->post('qty_selesai'),
            'satuan'        => $this->input->post('itemUnitName'),
            'tgl_terima_dt' => $this->input->post('tgl_terima1'),
            'jam_terima_dt' => $this->input->post('jam_terima1'),
        ];
        $this->m_pembelian->save_proses_forecasttostok_dt($data_terima_dt); // Simpan ke tabel penerimaan dt

        $this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
        redirect('wo/' . $id_hd);
    }

} else { //proses non partial
	$update_dt['status_qr'] = 'Selesai';
			$update_dt['status_proses_pr'] = 'Selesai';
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['no_wo'] = $this->input->post('no_wo');
			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt

            //$itemno = $this->input->post('itemNo');
			$nama_barang = $this->input->post('detailName');
			$stok = $this->input->post('quantity');
			$this->m_barang->plus_stok($stok, $nama_barang); //simpan ke tabel pr dt	
            
            $data_terima = [
			'no_terima' => $this->input->post('no_wo'),
			'tgl_terima' => date('Y-m-d'),
			'jam_terima' => date('H:i:s'),
			'nama_supplier' => 'Forecast',
			'nama_petugas' => $this->session->login['nama'],
			];
			$this->m_pembelian->save_proses_forecasttostok($data_terima); //simpan ke tabel penerimaan hd

			$data_terima_dt['no_terima'] = $this->input->post('no_wo');
			$data_terima_dt['nama_barang'] = $this->input->post('detailName');
			$data_terima_dt['jumlah'] = $this->input->post('quantity');
			$data_terima_dt['min_jumlah'] = $this->input->post('quantity');
			$data_terima_dt['satuan'] = $this->input->post('itemUnitName');

			$this->m_pembelian->save_proses_forecasttostok_dt($data_terima_dt); //simpan ke tabel penerimaan dt
            }
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
			public function ubah_master_forecast(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_qr'] = $this->input->post('status_qr');
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['status_packing'] = $this->input->post('status_packing');
           // $update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
            $update_dt['status_line'] = $this->input->post('status_line');

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	

			$nama_barang = $this->input->post('detailName');
			$stok = $this->input->post('quantity');
			$this->m_barang->plus_stok($stok, $nama_barang); //simpan ke tabel pr dt	

			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
            
			public function ubah_master_wo(){
			date_default_timezone_set('Asia/Jakarta');
			        //echo '<pre>';
       //print_r ($_POST);
       // echo '</pre>';
       //exit;

           
			if ( $this->input->post('status_pembatalan') == 'Batal' ){
	
	        $status_qr = 'Batal';
            }
            if ( $this->input->post('status_pembatalan') != 'Batal' ){
	
	        $status_qr = $this->input->post('status_qr');
            }

			$id_hd = $this->input->post('url');

			
                
     // Proses unggah file part_list

// Proses unggah file part_list
if (!empty($_FILES['part_list']['name'])) {
    $config_part_list = [
        'upload_path'   => './img/uploads/part_list',
        'allowed_types' => '*', // Sesuaikan tipe file jika diperlukan
        'max_size'      => 20000, // Maksimal ukuran 20 MB
        'encrypt_name'  => TRUE, // Nama file akan diacak
    ];

    $this->load->library('upload', $config_part_list, 'upload_part_list'); // Buat instance upload khusus untuk part_list

    if ($this->upload_part_list->do_upload('part_list')) {
        $update_dt['part_list'] = $this->upload_part_list->data("file_name");
    } else {
        $error = $this->upload_part_list->display_errors();
        echo "Error Upload Part List: " . $error;
    }
}

// Proses unggah file gambar_kerja
if (!empty($_FILES['gambar_kerja']['name'])) {
    $config_gambar_kerja = [
        'upload_path'   => './img/uploads/gambar_kerja',
        'allowed_types' => '*', // Sesuaikan tipe file jika diperlukan
        'max_size'      => 20000, // Maksimal ukuran 20 MB
        'encrypt_name'  => TRUE, // Nama file akan diacak
    ];

    $this->load->library('upload', $config_gambar_kerja, 'upload_gambar_kerja'); // Buat instance upload khusus untuk gambar_kerja

    if ($this->upload_gambar_kerja->do_upload('gambar_kerja')) {
        $update_dt['gambar_kerja'] = $this->upload_gambar_kerja->data("file_name");
    } else {
        $error = $this->upload_gambar_kerja->display_errors();
        echo "Error Upload Gambar Kerja: " . $error;
    }
}
            
			$update_dt['tgl_produksi'] = $this->input->post('tgl_produksi');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_qr'] = $status_qr;
			$update_dt['id_dt'] = $this->input->post('id_dt');
            $update_dt['status_packing'] = $this->input->post('status_packing');
            $update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
            $update_dt['status_line'] = $this->input->post('status_line');
            $update_dt['ketproblem'] = $this->input->post('ketproblem');
            $update_dt['no_wo'] = $this->input->post('no_wo');
            $update_dt['detailNotes'] = $this->input->post('detailNotes');


		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Detail Barang';
      	$data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;

			

			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	

			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('wo/'.$id_hd);

			
			  
       //echo '<pre>';
       //print_r ($_POST);
       //echo '</pre>';
       //exit;
		}
	public function list_permintaan_get($number_pr = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'List Sales Order';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$number_pr = $this->input->post('number_pr');
		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_post($number_pr); 


		$this->load->view('pembelian/list_pr_get', $this->data);
	}
	public function list_history_permintaan($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_3(); 


		$this->load->view('pembelian/list_pr_01', $this->data);
	}
	public function move_pr(){
		$no_pr = $this->input->post('number_pr');
		$id_hd = $this->input->post('id');
		$data['status_po'] = "Selesai";
		$this->m_pembelian->ubah_status_pr($data,$id_hd); 
		$this->session->set_flashdata('error', ' PR <strong>Gagal</strong> Ditambahkan!');
		$this->session->set_flashdata('success',$no_pr. '  <strong>Dipindahkan Ke Tabel Riwayat Permintaan Barang</strong>!');
		redirect('wo/proses_permintaan_barang');
	}
	public function Forecast($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang - Forecast';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Forecast';
		$this->data['laporan'] = 'Forecast';
		$this->data['all_pr'] = $this->m_pembelian->list_produksi($jenis_produksi); 

		$this->load->view('pembelian/list_po_hd', $this->data);
	}

	public function Subcon($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang - Subcon';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Subcon';
		$this->data['laporan'] = 'Subcon';
		$this->data['all_pr'] = $this->m_pembelian->list_subcon($jenis_produksi); 

		$this->load->view('pembelian/list_subcon', $this->data);
	}

    
	public function booking($id_lsp = NULL) {
    $this->data['aktif'] = 'pembelian';
    $this->data['title'] = 'Booking Customer';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];

    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
           
           
    // Ambil data dari input form
    $id_dt = $this->input->post('id_dt');
    $tgl_terima_nol_tigabulan = $this->input->post('tgl_terima_nol_tigabulan');
    $tgl_terima_tiga_enambulan = $this->input->post('tgl_terima_tiga_enambulan');
    $tgl_terima_lebih_enam_bulan = $this->input->post('tgl_terima_lebih_enam_bulan');
    $qty = $this->input->post('quantity');
    
    // Tentukan kategori berdasarkan tanggal terima
    $kategori = '';
    if ($tgl_terima_nol_tigabulan) {
        $kategori = 'nol_tiga_bulan';
    } elseif ($tgl_terima_tiga_enambulan) {
        $kategori = 'tiga_enam_bulan';
    } elseif ($tgl_terima_lebih_enam_bulan) {
        $kategori = 'lebih_enam_bulan';
    }

    // Debug statement
    //echo "id_dt: $id_dt, tgl_terima_nol_tigabulan: $tgl_terima_nol_tigabulan, tgl_terima_tiga_enambulan: $tgl_terima_tiga_enambulan, tgl_terima_lebih_enam_bulan: $tgl_terima_lebih_enam_bulan, qty: $qty, kategori: $kategori<br>";

    $this->data['all_pr'] = $this->m_pembelian->data_stok_ready($id_dt, $tgl_terima_nol_tigabulan, $tgl_terima_tiga_enambulan, $tgl_terima_lebih_enam_bulan, $qty, $kategori);
    

    $this->load->view('pembelian/list_po_booking', $this->data);
}

	public function pesanan_dibatalkan($id_lsp = NULL){ //Baru ditambahkan (8/28/23)
		$this->data['aktif'] = 'pesanan_dibatalkan';
		$this->data['title'] = 'List Pesanan Dibatalkan';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['all_pr'] = $this->m_pembelian->list_dibatalkan();

		$this->load->view('pembelian/list_pesanan_dibatalkan', $this->data);
	}
	public function export_excel_batal(){ 
		$jenis_produksi = 'Batal'; 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_dibatalkan());

		$this->load->view('pembelian/laporan/laporan_batal', $this->data); 
    	}
	public function export_excel_subcon(){ 
		$jenis_produksi = 'Subcon'; 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_subcon());

		$this->load->view('pembelian/laporan/laporan_subcon', $this->data); 
    	}

	public function export_excel_booking(){ 
		$jenis_produksi = 'Stok & Ready'; 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->data_stok_ready());

		$this->load->view('pembelian/laporan/laporan_stok_ready', $this->data); 
    	}
	public function export_excel_siap_kirim(){ 
		$jenis_produksi = 'Barang Siap Dikirim'; 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->data_siap_dikirim());

		$this->load->view('pembelian/laporan/laporan_siap_kirim', $this->data); 
    	}
    	
	public function pengiriman($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Barang Siap Dikirim';
		$this->data['no'] = 1;
		$jenis_produksi = 'Ready';
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
        
        //start
       $jenis_tanggal = $this->input->post('jenis_tanggal');
       $tanggal = $this->input->post('tanggal');
       $dan_tanggal = $this->input->post('dan_tanggal');

           if ($jenis_tanggal == 'Semua Data' ){
		$this->data['all_pr'] = $this->m_pembelian->data_siap_dikirim($jenis_produksi); 
		   }

           if ($jenis_tanggal == 'tanggal_kirim' && $tanggal != '' || $jenis_tanggal == 'tgl_produksi' && $tanggal != ''){
        $this->data['all_pr'] = $this->m_pembelian->data_siap_dikirim_filter($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal); 
           }

           if ($jenis_tanggal == 'transDate' && $tanggal != ''){
        $this->data['all_pr'] = $this->m_pembelian->data_siap_dikirim_filter_transdate($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal); 
           }

           if (empty($jenis_tanggal)){
        $this->data['all_pr'] = $this->m_pembelian->data_siap_dikirim($jenis_produksi); 
           }

        // finish
	    $this->load->view('pembelian/list_siap_kirim', $this->data);
	       }

	public function export_excel_produksi(){ 
		$jenis_produksi = $this->input->get('laporan'); 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_produksi($jenis_produksi));

		$this->load->view('pembelian/laporan/laporan_produksi', $this->data); 
    	}

    public function export_excel_master_sp_actual_line(){ 
		$jenis_produksi = $this->input->get('laporan'); 
		$jenis_line = $this->input->get('line'); 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi.'- '. $jenis_line,
			'all_barang' =>  $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi,$jenis_line));

		$this->load->view('pembelian/laporan/laporan_mps_actual', $this->data); 
    	}


    public function export_excel_master_sp_line(){ 
		$jenis_produksi = $this->input->get('laporan'); 
		$jenis_line = $this->input->get('line'); 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi.'- '. $jenis_line,
			'all_barang' =>  $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi,$jenis_line));

		$this->load->view('pembelian/laporan/laporan_master_schedule_produksi', $this->data); 
    	}
    public function export_excel_produksi_line(){ 
		$jenis_produksi = $this->input->get('laporan'); 
		$jenis_line = $this->input->get('line'); 
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi.'- '. $jenis_line,
			'all_barang' =>  $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line));

		$this->load->view('pembelian/laporan/laporan_produksi', $this->data); 
    	}

    public function export_excel_msp_act_01() {
    $this->data['title'] = "ALBA UNGGUL METAL";

    // Pastikan parameter diterima dengan benar
    $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
    $dan_tanggal = isset($_GET['dan_tanggal']) ? $_GET['dan_tanggal'] : null;
    //$jenis_line = isset($_GET['jenis_line']) ? $_GET['jenis_line'] : null; 
    $jenis_tanggal = isset($_GET['jenis_tanggal']) ? $_GET['jenis_tanggal'] : null;
    $jenis_produksi = 'Selesai';

     // Format keterangan
    $ket = 'LAPORAN SCAN PRODUKSI - ' . date('d F, Y', strtotime($tanggal)) . ' S/d ' . date('d F, Y', strtotime($dan_tanggal));

     

    // Daftar jenis tanggal yang didukung
    $supported_dates = [
        'timescan_cutting', 'timescan_punching', 'timescan_bending',
        'timescan_welding', 'timescan_ps', 'timescan_fa', 'timescan_packing'
    ];

    // Tentukan data berdasarkan filter
        // Ambil data dari model
    if (in_array($jenis_tanggal, $supported_dates) && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } elseif ($jenis_tanggal == 'transDate' && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } else {
        $this->data['all_pr'] = []; // Berikan nilai default jika tidak ada data yang diambil
    }
    $this->data['ket'] = $ket;

    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;

    // Load view untuk menampilkan data yang akan diekspor
    $this->load->view('pembelian/laporan/report_excel_msp_act', $this->data);
}
    
    public function export_excel_msp_act() {
    $this->data['title'] = "ALBA UNGGUL METAL";

    // Pastikan parameter diterima dengan benar
    $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
    $dan_tanggal = isset($_GET['dan_tanggal']) ? $_GET['dan_tanggal'] : null;
    //$jenis_line = isset($_GET['jenis_line']) ? $_GET['jenis_line'] : null; 
    $jenis_tanggal = isset($_GET['jenis_tanggal']) ? $_GET['jenis_tanggal'] : null;
    $jenis_produksi = 'Produksi';

     // Format keterangan
    $ket = 'LAPORAN SCAN PRODUKSI - ' . date('d F, Y', strtotime($tanggal)) . ' S/d ' . date('d F, Y', strtotime($dan_tanggal));

    // Daftar jenis tanggal yang didukung
    $supported_dates = [
        'timescan_cutting', 'timescan_punching', 'timescan_bending',
        'timescan_welding', 'timescan_ps', 'timescan_fa', 'timescan_packing'
    ];

    // Ambil data dari model
    if (in_array($jenis_tanggal, $supported_dates) && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } elseif ($jenis_tanggal == 'transDate' && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } else {
        $this->data['all_pr'] = []; // Berikan nilai default jika tidak ada data yang diambil
    }
    $this->data['ket'] = $ket;

    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;

    // Load view untuk menampilkan data yang akan diekspor
    $this->load->view('pembelian/laporan/report_excel_msp_act', $this->data);
}

    public function export_excel_msp_01() {
    $this->data['title'] = "ALBA UNGGUL METAL";

    // Pastikan parameter diterima dengan benar
    $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
    $dan_tanggal = isset($_GET['dan_tanggal']) ? $_GET['dan_tanggal'] : null;
    //$jenis_line = isset($_GET['jenis_line']) ? $_GET['jenis_line'] : null; 
    $jenis_tanggal = isset($_GET['jenis_tanggal']) ? $_GET['jenis_tanggal'] : null;
    $jenis_produksi = 'Produksi';

    
    // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        }
    $this->data['ket'] = $ket;

    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;

    // Load view untuk menampilkan data yang akan diekspor
    $this->load->view('pembelian/laporan/laporan_msp', $this->data);
}
    
    public function export_excel_msp() {
    $this->data['title'] = "ALBA UNGGUL METAL";

    // Pastikan parameter diterima dengan benar
    $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
    $dan_tanggal = isset($_GET['dan_tanggal']) ? $_GET['dan_tanggal'] : null;
    //$jenis_line = isset($_GET['jenis_line']) ? $_GET['jenis_line'] : null; 
    $jenis_tanggal = isset($_GET['jenis_tanggal']) ? $_GET['jenis_tanggal'] : null;
    $jenis_produksi = 'Produksi';

     
    // Format keterangan
    $ket = 'LAPORAN JADWAL PRODUKSI- ' . date('d F, Y', strtotime($tanggal)) . ' S/d ' . date('d F, Y', strtotime($dan_tanggal));

    // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        }
    $this->data['ket'] = $ket;

    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;

    // Load view untuk menampilkan data yang akan diekspor
    $this->load->view('pembelian/laporan/laporan_msp', $this->data);
}
    public function laporan_msp_act_01($id_lsp = NULL){
    
    $this->data['aktif'] = 'msa';
    $this->data['title'] = 'Laporan Scan Produksi';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Selesai';

    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
    //$jenis_line = $this->input->post('status_line');
    $jenis_tanggal = $this->input->post('jenis_tanggal'); // Ambil jenis tanggal dari dropdown

     // Logging data POST
    log_message('debug', 'POST data: ' . print_r($this->input->post(), true));

     // Daftar jenis tanggal yang didukung
    $supported_dates = [
        'timescan_cutting', 'timescan_punching', 'timescan_bending',
        'timescan_welding', 'timescan_ps', 'timescan_fa', 'timescan_packing'
    ];

    // Ambil data dari model
    if (in_array($jenis_tanggal, $supported_dates) && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } elseif ($jenis_tanggal == 'transDate' && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } else {
        $this->data['all_pr'] = []; // Berikan nilai default jika tidak ada data yang diambil
    }

    // Debug output untuk memeriksa data yang diterima
    log_message('debug', 'Data all_pr: ' . print_r($this->data['all_pr'], true));

    // URL untuk cetak PDF
    $url_cetak = 'wo/export1?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal;
    $this->data['url_cetak'] = base_url($url_cetak);

    // URL untuk ekspor Excel
    $url_cetak_excel = 'wo/export_excel_msp_act_01?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal . '&jenis_tanggal=' . $jenis_tanggal;
    $this->data['url_cetak_excel'] = base_url($url_cetak_excel);

    // Memuat view dengan data yang diperlukan
    $this->load->view('pembelian/laporan_msp_act', $this->data);
    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;
}

    public function laporan_msp_act($id_lsp = NULL){
    
    $this->data['aktif'] = 'msa';
    $this->data['title'] = 'Laporan Scan Produksi';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Produksi';

    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
    //$jenis_line = $this->input->post('status_line');
    $jenis_tanggal = $this->input->post('jenis_tanggal'); // Ambil jenis tanggal dari dropdown

     // Logging data POST
    log_message('debug', 'POST data: ' . print_r($this->input->post(), true));

     // Daftar jenis tanggal yang didukung
    $supported_dates = [
        'timescan_cutting', 'timescan_punching', 'timescan_bending',
        'timescan_welding', 'timescan_ps', 'timescan_fa', 'timescan_packing'
    ];

    // Ambil data dari model
    if (in_array($jenis_tanggal, $supported_dates) && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } elseif ($jenis_tanggal == 'transDate' && !empty($tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_act($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
    } else {
        $this->data['all_pr'] = []; // Berikan nilai default jika tidak ada data yang diambil
    }

    // Debug output untuk memeriksa data yang diterima
    log_message('debug', 'Data all_pr: ' . print_r($this->data['all_pr'], true));

    // URL untuk cetak PDF
    $url_cetak = 'wo/export1?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal ;
    $this->data['url_cetak'] = base_url($url_cetak);

    // URL untuk ekspor Excel
    $url_cetak_excel = 'wo/export_excel_msp_act?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal  . '&jenis_tanggal=' . $jenis_tanggal;
    $this->data['url_cetak_excel'] = base_url($url_cetak_excel);

    // Memuat view dengan data yang diperlukan
    $this->load->view('pembelian/laporan_msp_act', $this->data);
   
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;
}


    public function master_schedule_produksi_actual_line1($id_lsp = NULL){
		$this->data['aktif'] = 'msa';
		$this->data['title'] = 'Master Schedule Produksi (Actual) Line 1'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Master Schedule Produksi (Actual)';
		$this->data['jenis_line'] = $jenis_line;
		
        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		 if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data') {
        $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi, $jenis_line);
    } elseif ($tanggal != '') {
        $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual_filter($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
    }
		//finish

		

		$this->load->view('pembelian/master_schedule_produksi_actual', $this->data);
	}	
	
    public function master_schedule_produksi_actual_line2($id_lsp = NULL){
		$this->data['aktif'] = 'msa';
		$this->data['title'] = 'Master Schedule Produksi (Actual) Line 2'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Master Schedule Produksi (Actual)';
		$this->data['jenis_line'] = $jenis_line;
		
        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		if ($jenis_tanggal == 'Semua Data' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi,$jenis_line); 
		}

		if ($jenis_tanggal != 'Semua Data' and $tanggal !='' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual_filter($jenis_produksi,$jenis_line,$tanggal,$dan_tanggal,$jenis_tanggal); 
		}
		if (empty($jenis_tanggal)){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi,$jenis_line); 
		}
		//finish

		$this->load->view('pembelian/master_schedule_produksi_actual', $this->data);
	}

	public function master_schedule_produksi_actual_line3($id_lsp = NULL){
		$this->data['aktif'] = 'msa';
		$this->data['title'] = 'Master Schedule Produksi (Actual) Line 3'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Master Schedule Produksi (Actual)';
		$this->data['jenis_line'] = $jenis_line;
		
        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		if ($jenis_tanggal == 'Semua Data' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi,$jenis_line); 
		}

		if ($jenis_tanggal != 'Semua Data' and $tanggal !='' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual_filter($jenis_produksi,$jenis_line,$tanggal,$dan_tanggal,$jenis_tanggal); 
		}
		if (empty($jenis_tanggal)){
		$this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_actual($jenis_produksi,$jenis_line); 
		}
		//finish

		$this->load->view('pembelian/master_schedule_produksi_actual', $this->data);
	}

	
    public function laporan_msp_01($id_lsp = NULL){
    
    $this->data['aktif'] = 'msp';
    $this->data['title'] = 'Laporan Schedule Produksi';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Produksi';

    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
    //$jenis_line = $this->input->post('status_line');
    $jenis_tanggal = $this->input->post('jenis_tanggal'); // Ambil jenis tanggal dari dropdown

     // Logging data POST
    log_message('debug', 'POST data: ' . print_r($this->input->post(), true));

    
    // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp_01($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        }

    // Debug output untuk memeriksa data yang diterima
    log_message('debug', 'Data all_pr: ' . print_r($this->data['all_pr'], true));

    // URL untuk cetak PDF
    $url_cetak = 'wo/export1?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal ;
    $this->data['url_cetak'] = base_url($url_cetak);

    // URL untuk ekspor Excel
    $url_cetak_excel = 'wo/export_excel_msp_01?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal . '&jenis_tanggal=' . $jenis_tanggal;
    $this->data['url_cetak_excel'] = base_url($url_cetak_excel);

    // Memuat view dengan data yang diperlukan
    $this->load->view('pembelian/laporan_msp', $this->data);
    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;
}

    public function laporan_msp($id_lsp = NULL){
    
    $this->data['aktif'] = 'msp';
    $this->data['title'] = 'Laporan Schedule Produksi';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Produksi';

    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
    //$jenis_line = $this->input->post('status_line');
    $jenis_tanggal = $this->input->post('jenis_tanggal'); // Ambil jenis tanggal dari dropdown

     // Logging data POST
    log_message('debug', 'POST data: ' . print_r($this->input->post(), true));

    
    // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi
            	, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi
            	, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->lihat_history_msp($jenis_produksi
            	, $tanggal, $dan_tanggal, $jenis_tanggal);
        }

    // Debug output untuk memeriksa data yang diterima
    log_message('debug', 'Data all_pr: ' . print_r($this->data['all_pr'], true));

    // URL untuk cetak PDF
    $url_cetak = 'wo/export1?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal ;
    $this->data['url_cetak'] = base_url($url_cetak);

    // URL untuk ekspor Excel
    $url_cetak_excel = 'wo/export_excel_msp?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal . '&jenis_tanggal=' . $jenis_tanggal;
    $this->data['url_cetak_excel'] = base_url($url_cetak_excel);

    // Memuat view dengan data yang diperlukan
    $this->load->view('pembelian/laporan_msp', $this->data);
    // Debugging data untuk memastikan filter sudah bekerja
    //echo '<pre>';
    //print_r($this->data['all_pr']);
    //echo '</pre>';
    //exit;
}

	public function master_schedule_produksi_line1($id_lsp = NULL){
		$this->data['aktif'] = 'msp';
		$this->data['title'] = 'Master Schedule Produksi (MSP) Line 1'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Master Schedule Produksi (MSP)';
		$this->data['jenis_line'] = $jenis_line;

        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

        // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line_filter($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        }
		//finish

		$this->load->view('pembelian/master_schedule_produksi_line', $this->data);

		 //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
	public function master_schedule_produksi_line2($id_lsp = NULL){
		$this->data['aktif'] = 'msp';
		$this->data['title'] = 'Master Schedule Produksi (MSP) Line 2'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Master Schedule Produksi (MSP)';
		$this->data['jenis_line'] = $jenis_line;

		
		//start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		 // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line_filter($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        }
		//finish

		$this->load->view('pembelian/master_schedule_produksi_line', $this->data);

		//echo '<pre>';
     // print_r ($_POST);
      //echo '</pre>';
     // exit;
	}
	public function master_schedule_produksi_line3($id_lsp = NULL){
		$this->data['aktif'] = 'msp';
		$this->data['title'] = 'Master Schedule Produksi (MSP) Line 3'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Master Schedule Produksi (MSP)';
		$this->data['jenis_line'] = $jenis_line;
		
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		//start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

		 // Tentukan data berdasarkan filter
        if (empty($jenis_tanggal) || $jenis_tanggal == 'Semua Data' || ($jenis_tanggal == 'transDate' && !empty($tanggal))) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } elseif (!empty($jenis_tanggal) && !empty($tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line_filter($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            $this->data['all_pr'] = $this->m_pembelian->list_master_schedule_produksi_line($jenis_produksi, $jenis_line, $tanggal, $dan_tanggal, $jenis_tanggal);
        }
		//finish

		$this->load->view('pembelian/master_schedule_produksi_line', $this->data);
	}

	public function master_forecast($id_lsp = NULL){
		$this->data['aktif'] = 'master_forecast';
		$this->data['title'] = 'Master Forecast'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Forecast';
		//$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Produksi';
		//$this->data['jenis_line'] = $jenis_line;
		 //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

	
		if ($jenis_tanggal == 'Semua Data' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_forecast_01(); 
		}

		if ($jenis_tanggal == 'tanggal_kirim' or $jenis_tanggal == 'transDate' and $tanggal !='' ){
		$this->data['all_pr'] = $this->m_pembelian->list_master_forecast($jenis_produksi,$tanggal,$dan_tanggal,$jenis_tanggal); 
		}
		
		if (empty($jenis_tanggal)){
		$this->data['all_pr'] = $this->m_pembelian->list_master_forecast_01(); 
		}
		//finish
		$this->load->view('pembelian/master_forecast', $this->data);
	}
    
   
	public function master_wo($id_lsp = NULL){
		$this->data['aktif'] = 'master_wo';
		$this->data['title'] = 'Master Work Order'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Produksi';
		$this->data['jenis_line'] = $jenis_line;

        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

	  
	   // Dapatkan bulan dan tahun saat ini
    $bulan_sekarang = date('Y-m');
    $start_date = $bulan_sekarang . '-01';  // Tanggal awal bulan
    $end_date = date("Y-m-t", strtotime($bulan_sekarang . '-01'));  // Tanggal akhir bulan

    set_time_limit(50); // Meningkatkan waktu eksekusi menjadi 50 detik

    // Jika 'jenis_tanggal' kosong atau 'Semua Data', ambil data berdasarkan bulan aktif (bulan sekarang)
    if ($jenis_tanggal == 'Semua Data' || empty($jenis_tanggal)) {
        $this->data['all_pr'] = $this->m_pembelian->list_master_wo($jenis_produksi, $jenis_line, $start_date, $end_date, 'transDate');

     } elseif (($jenis_tanggal == 'tanggal_kirim' || $jenis_tanggal == 'transDate') && !empty($tanggal)) {
    // Jika 'tanggal_kirim' atau 'transDate' dipilih dan 'tanggal' tidak kosong, filter berdasarkan tanggal
    $this->data['all_pr'] = $this->m_pembelian->list_master_wo_filter($jenis_produksi, $jenis_line,$tanggal, $dan_tanggal, $jenis_tanggal);
     } else {
    // Kondisi default jika tidak ada filter lain yang terpenuhi, ambil data aktif
    $this->data['all_pr'] = $this->m_pembelian->list_master_wo($jenis_produksi, $jenis_line);
}
	
		//finish
		 
		$this->load->view('pembelian/master_wo', $this->data);
	}
	public function export_excel_tambah_so(){ 
		$jenis_produksi = 'Wo'; 
		$jenis_line = 'Line 1';
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_master_wo($jenis_produksi,$jenis_line));

		$this->load->view('pembelian/laporan/laporan_so', $this->data); 
    	}
	public function export_excel_master_forecast(){ 
		$jenis_produksi = 'Forecast'; 
		//$jenis_line = 'Line 1';
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_master_forecast_01());

		$this->load->view('pembelian/laporan/laporan_master_forecast', $this->data); 
    	}
	public function export_excel_master_wo(){ 
		$jenis_produksi = 'Wo'; 
		$jenis_line = 'Line 1';
		$this->data = array( 'title' => 'Laporan '.$jenis_produksi,
			'all_barang' =>  $this->m_pembelian->list_master_wo($jenis_produksi,$jenis_line));

		$this->load->view('pembelian/laporan/laporan_master_wo', $this->data); 
    	}
	
	public function produksi_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang - Produksi Line 1'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Produksi';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function cutting_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Cutting Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Cutting';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Cutting';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function punching_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Punching Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Punching';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Punching';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}

	public function bending_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Bending Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Bending';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Bending';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function welding_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Welding Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Welding';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Welding';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function ps_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'PS Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'PS';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'PS';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function fa_line1($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'FA Line 1';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'FA';
		$jenis_line = 'Line 1';
		$this->data['laporan'] = 'FA';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function produksi_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang - Produksi Line 2'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Produksi';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function cutting_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Cutting Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Cutting';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Cutting';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function punching_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Punching Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Punching';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Punching';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function bending_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Bending Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Bending';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Bending';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function welding_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Welding Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Welding';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'Welding';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function ps_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'PS Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'PS';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'PS';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function fa_line2($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'FA Line 2';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'FA';
		$jenis_line = 'Line 2';
		$this->data['laporan'] = 'FA';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function produksi_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang - Produksi Line 3'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Produksi';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function cutting_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Cutting Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Cutting';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Cutting';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function punching_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Punching Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Punching';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Punching';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function bending_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Bending Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Bending';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Bending';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function welding_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Welding Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Welding';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'Welding';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function ps_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'PS Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'PS';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'PS';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function fa_line3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'FA Line 3';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'FA';
		$jenis_line = 'Line 3';
		$this->data['laporan'] = 'FA';
		$this->data['jenis_line'] = $jenis_line;
		$this->data['all_pr'] = $this->m_pembelian->list_produksi_line($jenis_produksi,$jenis_line); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function packing($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Packing';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Packing';
		$this->data['laporan'] = 'Packing';
		$this->data['all_pr'] = $this->m_pembelian->list_produksi($jenis_produksi); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function wh_fg($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'WH FG';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'WH FG';
		$this->data['laporan'] = 'WH FG';
		$this->data['all_pr'] = $this->m_pembelian->list_produksi($jenis_produksi); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function selesai($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pengiriman';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['all_pr'] = $this->m_pembelian->lihat_data_pengiriman_hd(); 
		$this->load->view('pembelian/list_pengiriman_selesai', $this->data);
	}

   public function export_excel_laporan_pengiriman() {
    $this->data['title'] = "ALBA UNGGUL METAL";
  
    $tanggal = $_GET['tanggal'];
    $dan_tanggal = $_GET['dan_tanggal'];  
    $type_barang_pesanan = $_GET['type_barang_pesanan'];
    $jenis_produksi = 'Selesai';
    

    $ket = 'LAPORAN PENGIRIMAN SELESAI - ' . date('d F, Y', strtotime($tanggal)) . ' S/d ' . date('d F, Y', strtotime($dan_tanggal));

    // Ambil data dari model
    $this->data['all_pr'] = $this->m_pembelian->lihat_history_pengiriman_selesai($jenis_produksi, $tanggal, $dan_tanggal, $type_barang_pesanan);
    
    // Hitung total qty
    $total_qty = 0;
    foreach ($this->data['all_pr'] as $row) {
        $total_qty += $row->quantity; // Sesuaikan dengan nama kolom yang benar
    }

    // Menyimpan informasi untuk ditampilkan di view
    $this->data['total_qty'] = $total_qty;
    $this->data['ket'] = $ket;

    // Load view untuk menampilkan data yang akan diekspor
    $this->load->view('pembelian/laporan/report_excel_pengiriman_selesai', $this->data);
}


     public function laporan_pengiriman($id_lsp = NULL)
{
    $this->data['aktif'] = 'pembelian';
    $this->data['title'] = 'Laporan Pengiriman Selesai';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Selesai';

    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
    $type_barang_pesanan = $this->input->post('type_barang_pesanan'); // Ambil jenis tanggal dari dropdown


    // Mengambil data berdasarkan filter tanggal dan jenis pesanan
    $this->data['all_pr'] = $this->m_pembelian->lihat_history_pengiriman_selesai($jenis_produksi, $tanggal, $dan_tanggal, $type_barang_pesanan);

    // Debug output untuk memeriksa data yang diterima
    log_message('debug', 'Data all_pr: ' . print_r($this->data['all_pr'], true));

    // URL untuk cetak PDF
    $url_cetak = 'wo/export1?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal  . '&type_barang_pesanan=' . $type_barang_pesanan;
    $this->data['url_cetak'] = base_url($url_cetak);

    // URL untuk ekspor Excel
    $url_cetak_excel = 'wo/export_excel_laporan_pengiriman?filter=1&tanggal=' . $tanggal . '&dan_tanggal=' . $dan_tanggal. '&type_barang_pesanan=' . $type_barang_pesanan;
    $this->data['url_cetak_excel'] = base_url($url_cetak_excel);

    // Memuat view dengan data yang diperlukan
    $this->load->view('pembelian/laporan_pengiriman_selesai', $this->data);
}

    public function item_selesai($id_lsp = NULL){
    $this->data['aktif'] = 'pembelian';
    $this->data['title'] = 'Selesai';
    $this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $jenis_produksi = 'Selesai';

    $jenis_tanggal = $this->input->post('jenis_tanggal');
    $tanggal = $this->input->post('tanggal');
    $dan_tanggal = $this->input->post('dan_tanggal');
set_time_limit(30); // Meningkatkan waktu eksekusi menjadi 60 detik

    // Dapatkan bulan dan tahun saat ini
    $bulan_sekarang = date('Y-m-01');  // Awal bulan
    $akhir_bulan_sekarang = date('Y-m-t');  // Akhir bulan

    // Jika jenis_tanggal kosong, secara otomatis filter berdasarkan tanggal kirim bulan saat ini
    if (empty($jenis_tanggal)) {
        $jenis_tanggal = 'tanggal_kirim';
        $tanggal = $bulan_sekarang;
        $dan_tanggal = $akhir_bulan_sekarang;
    }

    // Filter data berdasarkan input atau default ke tanggal kirim bulan saat ini
    if ($jenis_tanggal == 'Semua Data') {
        $this->data['all_pr'] = $this->m_pembelian->lihat_pengiriman_detail($jenis_produksi); 
    } elseif ($jenis_tanggal == 'tanggal_kirim') {
        $this->data['all_pr'] = $this->m_pembelian->lihat_pengiriman_detail_filter($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal); 
    } elseif ($jenis_tanggal == 'transDate') {
        $this->data['all_pr'] = $this->m_pembelian->lihat_pengiriman_detail_filter_transDate($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal); 
    }


    
    $this->load->view('pembelian/list_pengiriman_selesai_item', $this->data);
}

	public function item_selesai_forecast($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Forecast Stok Selesai';
		$this->data['no'] = 1;
		$jenis_produksi = 'Selesai';
		$this->data['all_pr'] = $this->m_pembelian->list_forecastto_stok($jenis_produksi); 
		$this->load->view('pembelian/list_po_hd', $this->data);
	}
	public function export_excel_selesai(){ 
		$judul = 'Barang Selesai Dikirim'; 
		$jenis_produksi = 'Selesai';
		$this->data = array( 'title' => 'Laporan '.$judul,
			'all_barang' =>  $this->m_pembelian->lihat_pengiriman_detail($jenis_produksi ));

		$this->load->view('pembelian/laporan/laporan_selesai', $this->data); 
    	}
	public function scan_cutting($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Cutting';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;


		$this->load->view('pembelian/scan', $this->data);
	}
		function cek_id()
	{
		//$user = $this->user;
		$result_code = $this->input->post('id_karyawan');
		$tgl = date('Y-m-d');
		$jam_msk = date('h:i:s');
		$jam_klr = date('h:i:s');
		$cek_id = $this->m_pembelian->cek_id($result_code);
		$cek_kehadiran = $this->m_pembelian->cek_kehadiran($result_code);
		if (!$cek_id) {
			$this->session->set_flashdata('error', 'gagal data QR tidak ditemukan!');
			redirect('pembelian/scan_cutting');
		} elseif ($cek_kehadiran && $cek_kehadiran->status_qr == '' ) {
			$data = array(
				'status_qr' => 'Cutting',
			);
			$this->m_pembelian->absen_pulang($result_code, $data);
			$this->session->set_flashdata('success', 'Status Barang '.$result_code.' Berhasil Diubah!');
			redirect('pembelian/scan_cutting');
		} elseif ($cek_kehadiran && $cek_kehadiran->status_qr != '') {
			$this->session->set_flashdata('info', 'Kode Barang '.$result_code.' Sudah Diubah!');
			redirect('pembelian/scan_cutting');
			return false;
		} 
	}
	public function list_selesai($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3



		$this->load->view('pembelian/list_po_selesai', $this->data);
	}
	public function list_selesai_item($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pembelian Semua Item';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_notspk();  

		$this->load->view('pembelian/list_po_selesai_item', $this->data);
	}
		  public  function data_pembelian_all_item(){
        $this->data=$this->m_pembelian->lihat_smua_item_pembelian();
        echo json_encode($this->data);
    }
	  public  function data_pembelian_no_spk(){
        $this->data=$this->m_pembelian->lihat_pr_status_notspk();
        echo json_encode($this->data);
    }
	  public  function data_pembelian_spk(){
        $this->data=$this->m_pembelian->lihat_pr_status_7spk();
        echo json_encode($this->data);
    }
	public function list_pengiriman($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Proses Pengiriman';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['all_pr'] = $this->m_pembelian->list_stok(); 

		$this->load->view('pembelian/list_po', $this->data);
	}
	public function detail_pr($id_pr = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Detail Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->data['hd_pr'] = $this->m_pembelian->lihat_pr_detail_hd($id_pr);
		$this->data['dt_pr'] = $this->m_pembelian->lihat_pr_detail_dt($id_pr);
		$this->data['his_pr'] = $this->m_pembelian->lihat_pr_detail_history($id_pr); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sls'] = $this->m_sales->lihat();

		$this->load->view('pembelian/detail_pr', $this->data); 
	}
	public function detail_pr_01($id_pr = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Detail Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->data['hd_pr'] = $this->m_pembelian->lihat_pr_detail_hd($id_pr);
		$this->data['dt_pr'] = $this->m_pembelian->lihat_pr_detail_dt_01($id_pr);
		$this->data['his_pr'] = $this->m_pembelian->lihat_pr_detail_history($id_pr); 
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['sls'] = $this->m_sales->lihat();

		$this->load->view('pembelian/detail_pr_01', $this->data); 
	}
	public function detail_pengiriman($id_pr = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Detail Pengiriman Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->data['hd_pr'] = $this->m_pembelian->lihat_pengiriman_detail_hd($id_pr);
		$this->data['dt_pr'] = $this->m_pembelian->lihat_pengiriman_dt($id_pr);


		$this->load->view('pembelian/detail_pengiriman', $this->data); 
	}
	    public function detail_po($id_pr = NULL){
	    	$this->data['aktif'] = 'pembelian';
	    	$this->data['title'] = 'Detail Purchase Request';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
	    	$this->data['no'] = 1;
	    	$id = $this->session->login['kode'];
	    	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    	$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    	$this->data['view_task'] = $this->m_kerja->my_modul();

	    	$this->data['hd_pr'] = $this->m_pembelian->lihat_pr_detail_hd($id_pr);
	    	$this->data['dt_pr'] = $this->m_pembelian->lihat_pr_detail_dt($id_pr);
	    	$this->data['his_pr'] = $this->m_pembelian->lihat_pr_detail_history($id_pr); 

	    	$this->load->view('pembelian/detail_po', $this->data);
	    }
	    public function detail_po_dt($id_pr = NULL){

	    	$this->data['aktif'] = 'pembelian';
	    	$this->data['title'] = 'Detail Pesanan Barang';
	    	$this->data['no'] = 1;
	    	$id = $this->session->login['kode'];
	    	$this->data['customer'] = $this->m_customer->lihat();
				$this->data['sales'] = $this->m_sales->lihat();
				$this->data['warna'] = $this->m_barang->lihat_warna(); //get data barang
	    	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
				$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
				$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
				$this->data['his_pr'] = $this->m_pembelian->lihat_po_detail_history($id_pr); 
				$this->data['hitung_persentasi_dt'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr); 

			//	$id_lsp = $this->data['hd_pr']->projectNo;


				$this->load->view('pembelian/detail_po_dt', $this->data);
			}

			public function detail_po_dt_penerimaan($id_pr = NULL){ 
				$this->data['aktif'] = 'pembelian';
				$this->data['title'] = 'Detail Pesanan Pembelian';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
				$this->data['no'] = 1;
				$id = $this->session->login['kode'];
				$this->data['hd_api'] = $this->m_pembelian->api_show($id_pr);
				$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    	$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    	$this->data['view_task'] = $this->m_kerja->my_modul();

	    	$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
	    	$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
	    	$this->data['his_pr'] = $this->m_pembelian->lihat_po_detail_history($id_pr); 
	    	$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr);
	    	$this->data['hs_price'] = $this->m_pembelian->lihat_po_history_price($id_pr);
	    	$this->load->view('pembelian/detail_po_dt_penerimaan', $this->data);
	    }

	    public function hapus_pr_hd_dt_hs($id)
	    {

	    	date_default_timezone_set('Asia/Jakarta');
	    	$data_log['user'] = $this->session->login['nama'];
	    	$data_log['waktu'] = date('Y-m-d H:i:s');
	    	$data_log['ket'] = 'Hapus purchase request';
	    	$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if(!empty($id)){
				$this->db->delete('purchase_order_dt', ['number_po' => $id]);
				$this->db->delete('purchase_order_hd', ['number_' => $id]);
				$this->db->delete('alba_permintaan_history', ['no_po' => $id]);
				$this->session->set_flashdata('success', 'Laporan Payment <strong>Berhasil</strong> Dihapus!');
			redirect('pembelian/list_permintaan'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Laporan Payment<strong>Gagal</strong> Dihapus!');
			redirect('pembelian/list_permintaan'); //redirect page
		}
	}


	public function hapus_master_wo($id)
	    {

	    	date_default_timezone_set('Asia/Jakarta');
	    	$data_log['user'] = $this->session->login['nama'];
	    	$data_log['waktu'] = date('Y-m-d H:i:s');
	    	$data_log['ket'] = 'Hapus Permintaan Barang';
	    	$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if(!empty($id)){
				$this->m_pembelian->hapus_pr_dt_master_wo($id);
			   
				
				$this->session->set_flashdata('success', 'Permintaan Barang <strong>Berhasil</strong> Dihapus!');
			redirect('pembelian/master_wo'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('pembelian/master_wo'); //redirect page
		}
	}

	public function ubah_pr_dt(){ 
		date_default_timezone_set('Asia/Jakarta');

		$id_hd = $this->input->post('id_header');
		$update_dt['id_dt'] = $this->input->post('id_dt');
		$update_dt['detailName'] = $this->input->post('detailName');
		$update_dt['warna'] = $this->input->post('warna');
		$update_dt['quantity'] = $this->input->post('quantity');
		$update_dt['detailNotes'] = $this->input->post('detailNotes');
		$update_dt['status_packing'] = $this->input->post('status_packing');
    $this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel alba_permintaan_barang_dt


			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_pr/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
			public function ubah_pr_customer(){ 
		date_default_timezone_set('Asia/Jakarta');

		$id_hd = $this->input->post('id_header');
		$update_dt['id'] = $this->input->post('id_header');
		$update_dt['kd_cst'] = $this->input->post('kd_cst');
		$update_dt['kd_sales'] = $this->input->post('kd_sales');

      		$this->m_pembelian->save_update_pr_proyek($update_dt); //simpan ke tabel pr dt


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Update Customer/Sales';
      		$data_log['kode'] = $this->input->post('no_pr');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
		//	$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_pr');
			$data_hs['status'] = 'Update Proyek';
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Proyek <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_pr/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function ubah_po_dtt(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
					if (!empty($_FILES['gambar_kerja']['name'])) {
				$config['upload_path']          = './img/uploads/gambar_kerja';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('gambar_kerja');

				$update_dt['gambar_kerja'] = $this->upload->data("file_name");
			}
			$id_hd = $this->input->post('id_header');
			$update_dt['no'] = $this->input->post('no');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['warna'] = $this->input->post('warna');
			$update_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['qr_code'] = $this->input->post('qr_code');
			$update_dt['status_packing'] = $this->input->post('status_packing');

	  $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Update Detail Barang';
      $data_log['kode'] = $this->input->post('id_dt');
			

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;

			$this->m_pembelian->save_update_po_dtt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	

			$this->session->set_flashdata('error', 'Detail PO <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail Pesanan Pembelian <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

	public function ubah_po_Hd(){
		date_default_timezone_set('Asia/Jakarta');
		
		$id_hd = $this->input->post('id_header');
		$update_dt['number_'] = $this->input->post('number_');
		$update_dt['kd_cst'] = $this->input->post('kd_cst');
		$update_dt['kd_sales'] = $this->input->post('kd_sales');
		$update_dt['shipDate'] = $this->input->post('shipDate');
		$update_dt['toAddress'] = $this->input->post('toAddress');
		$update_dt['description'] = $this->input->post('description');
		$update_dt['id'] = $id_hd;

     $this->m_pembelian->save_update_po_hd($update_dt); //simpan ke tabel pr dt


     // $numbernya = $this->input->post('number_');
      $numbernya = $this->input->post('number_lama');
      $update_dt_pjk['number_po'] = $this->input->post('number_');
      $this->m_pembelian->ubah_nomor_po($update_dt_pjk,$numbernya); //simpan ke tabel pr dt
      $this->m_pembelian->ubah_nomor_po_pesanan_dt($update_dt_pjk,$numbernya); //simpan ke tabel pr dt


			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'Update Header Pesanan Pembelian '.$nomor_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PO <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Header <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}

		public function tambah_item_new_po(){
			date_default_timezone_set('Asia/Jakarta');

			$id_hd = $this->input->post('id_header');

			$save_item_dt['number_request'] = $this->input->post('id_dt');
			$save_item_dt['detailName'] = $this->input->post('detailName');
			$save_item_dt['itemNo'] = $this->input->post('itemNo');
			$save_item_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$save_item_dt['warna'] = $this->input->post('warna');
			$save_item_dt['quantity'] = $this->input->post('quantity');
			$save_item_dt['detailNotes'] = $this->input->post('detailNotes');
			$save_item_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$save_item_dt['kd_cst'] = $this->input->post('kd_cst');

			$this->m_pembelian->save_po_detail_item($save_item_dt); //simpan ke tabel pr dt
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('wo/kelengkapan_pr/'.$id_hd);

		//	$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function proses_pengiriman_ulang(){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_hd = $this->input->post('id_header');
			$data['status_po'] = '10';
			$data['shipDate'] = $this->input->post('shipDate');
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel pr dt


      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Pengiriman Ulang Barang';
      $data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('number_');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'Pengiriman Ulang Pesanan Tidak Sesuai '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail Pesanan <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Detail Pesanan  <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt_penerimaan/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function finish_pesanan_pembelian(){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_hd = $this->input->post('id');
			$data['status_po'] = '7';
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel pr dt


      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Pesanan telah selesai';
      $data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('number_');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'Pesanan Pembelian Selesai '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail Pesanan <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Detail Pesanan  <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt_penerimaan/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function ubah_po_dt(){
			date_default_timezone_set('Asia/Jakarta');
			if (!empty($_FILES['berkas']['name'])) {
				$config['upload_path']          = './img/uploads';
				$config['allowed_types']        = '*';
				$config['max_size']             = 10000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
				$config['encrypt_name']         = TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('berkas');
        // $file1 = $this->upload->data();
        //    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

				$update_dt['foto'] = $this->upload->data("file_name");
			}	
			$id_hd = $this->input->post('id_header');
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['status_item'] = $this->input->post('status_item');
			$update_dt['status_item_noted'] = $this->input->post('status_item_noted');
      		$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Update Detail PR';
      		$data_log['kode'] = $this->input->post('id_dt');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail pr id '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function proses_approve_pr(){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$id_hd = $this->input->post('id');
			$data['status_po'] = $this->input->post('status_po');
      		$this->m_pembelian->ubah_status_pr($data,$id_hd); //simpan ke tabel jenis izin


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'PM Mengetahui PR';
      		$data_log['kode'] = $this->input->post('number_pr');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log data

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = $this->input->post('status');
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel History Po

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Permintaan Barang <strong>Berhasil</strong> Disetujui!');
			redirect('pembelian/detail_pr/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	

		public function proses_approve_po(){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$cek_status = $this->input->post('status_po');
			if($cek_status == 5){
			$id_hd = $this->input->post('id');
			$data['status_po'] = $this->input->post('status_po');
			$data['approved_estimator'] = $this->session->login['nama'];
			$data['approvedtime_estimator'] = date('Y-m-d H:i:s');
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel jenis izin
			}else{
			$id_hd = $this->input->post('id');
			$data['status_po'] = $this->input->post('status_po');
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel jenis izin
			}


			$id_hd = $this->input->post('id');
			$data['status_po'] = $this->input->post('status_po');
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel jenis izin


  		$data_log['user'] = $this->session->login['nama'];
  		$data_log['waktu'] = date('Y-m-d H:i:s');
  		$data_log['ket'] = 'Estimator Mengetahui PR';
  		$data_log['kode'] = $this->input->post('number_pr');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log data

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = $this->input->post('status');
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel History Po

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function save_pr_sattle($id = NULL) { 
			date_default_timezone_set('Asia/Jakarta');
  //  echo '<pre>';
  //      print_r ($_POST);
   //     echo '</pre>';
    //   exit;
			$id_hd = $this->input->post('id');

			$data['transDate'] = $this->input->post('transDate');
			$data['number_'] = $this->input->post('number_');
		//	$data['status_po'] = $this->input->post('status_po');

			$data['created_po'] = $this->session->login['nama'];
			$data['createdtime_po'] = date('Y-m-d H:i:s');
			$this->m_pembelian->simpan_po_dt($data); //Update pr hd

			$data_kode['kode_otomatis'] = $this->input->post('number_');
			$this->m_pembelian->simpan_kode_terakhir($data_kode); //simpan_kode_terakhir

		
		$number_po = $this->input->post('number_');
		$qr_code = $this->input->post('qr_code');
		$number_ = $this->input->post('number_pr');
		$detailName = $this->input->post('detailName'); 
		$itemNo = $this->input->post('itemNo');
		$quantity = $this->input->post('quantity'); 
		$itemUnitName = $this->input->post('itemUnitName'); 
		$warna = $this->input->post('warna');  
		$kd_cst = $this->input->post('kd_cst');  
		$gambar_kerja = $this->input->post('gambar_kerja'); 
		$status_proses_pr = $this->input->post('status_proses_pr');  

		$detailNotes = $this->input->post('detailNotes');
   
		$id_dt = $this->input->post('id_dt');

    		$this->m_pembelian->save_pr_sattle_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$gambar_kerja,$status_proses_pr,$detailNotes, $qr_code,$kd_cst); //untuk tabel purchase dt

    	//	$this->m_pembelian->save_po_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$gambar_kerja,$status_proses_pr,$detailNotes, $qr_code ); //untuk tabel purchase d


    			$data_hs['no_po'] = $number_;
    			$data_hs['status'] = 'Pesanan Baru '.$number_po;
    			$data_hs['action_by'] = $this->session->login['nama'];
    			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel purchase history


        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

			$this->session->set_flashdata('error', 'PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
       redirect('wo/proses_permintaan_barang'); //redirect page
     }
      public function save_laporan($id = NULL) { 

      	$data['header_payment'] = $this->input->post('header_payment'); 
      	$data['kod_payment'] = $this->input->post('kod_payment');
      	$data['no_spk'] = $this->input->post('no_spk'); 
      	$data['tgl_payment'] = $this->input->post('tgl_payment');
      	$data['project_payment'] = $this->input->post('project_payment');
      	$data['vendor'] = $this->input->post('vendor');
      	$data['almount'] = $this->input->post('almount');
      	$data['note_payment'] = $this->input->post('note_payment');
      	$data['createdBy_payment'] = $this->session->login['nama'];
      	$data['createdTime_payment'] = $this->input->post('createdTime_payment');
      	$this->m_payment->simpan_payment($data);

			//untuk log
      	$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = $this->input->post('createdTime_payment');
      	$nama =  $this->input->post('kod_payment');
      	$keterangan =  'Add Payment';
      	$data_log['ket'] = $keterangan.' '.$nama;
      	$data_log['kode'] = $this->input->post('kod_payment');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

			$this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Ditambahkan!');
        redirect('payment'); //redirect page
      }

      public function save_purchase_order($id = NULL) { 
      	date_default_timezone_set('Asia/Jakarta');

      	$transDate = $this->input->post('transDate'); 
      	$number_ = $this->input->post('number_');
      	$number_pr = $this->input->post('number_pr');
      	$project = $this->input->post('project'); 
      	$toAddress = $this->input->post('toAddress');
      	$created_po = $this->session->login['nama'];
      	$createdtime_po = date('Y-m-d H:i:s');

      	$detailName = $this->input->post('detailName');
      	$quantity = $this->input->post('quantity');
      	$detailNotes = $this->input->post('detailNotes');

    		$this->m_pembelian->save_purchase_dt($number_,$detailName,$quantity,$detailNotes); //untuk tabel purchase dt


    		$data_hd['transDate'] = $transDate;
    		$data_hd['number_'] = $number_;
    		$data_hd['number_pr'] = $number_pr;
    		$data_hd['project'] = $project;
    		$data_hd['toAddress'] = $toAddress;
    		$data_hd['created_po'] = $created_po;
    		$data_hd['createdtime_po'] = $createdtime_po;
			$this->m_pembelian->save_purchase_hd($data_hd); //simpan ke tabel purchase hd

			$data_hs['no_po'] = $number_;
			$data_hs['status'] = 'PR Dibuat';
			$data_hs['action_by'] = $created_po;
			$data_hs['actiontime'] = $createdtime_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel purchase history

			//untuk log
			$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$nama =  $number_pr;
			$keterangan =  'Add PR';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $number_pr;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

			$this->session->set_flashdata('error', 'PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'PR <strong>Berhasil</strong> Ditambahkan!');
       redirect('pembelian/list_permintaan'); //redirect page
     }


	public function hapus_pr($id){
		date_default_timezone_set('Asia/Jakarta');
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$data_log['ket'] = 'Hapus Permintaan Barang';
		$data_log['kode'] = $id;


		if(!empty($id)){ 
			$this->m_pembelian->hapus_pr_dt($id);
			$this->m_pembelian->hapus_pr_history($id);
			$this->m_pembelian->hapus_pr_hd($id) ;
			$this->session->set_flashdata('success', 'Permintaan Barang <strong>Berhasil</strong> Dihapus!');
			redirect('pembelian/list_permintaan'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('pembelian/list_permintaan'); //redirect page
		}
	}

}
