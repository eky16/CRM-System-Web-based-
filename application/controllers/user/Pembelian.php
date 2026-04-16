<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
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
	}

	public function tambah($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang';
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

	$this->load->view('user/pembelian/tambah_pr', $this->data);
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
			redirect('user/pembelian/detail_po_dt/'.$id_hd);

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

      	$this->load->view('user/pembelian/tambah_spk', $this->data);
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

      public function keranjang_barang(){
      	$this->load->view('user/pembelian/keranjang');
      }
      public function keranjang_barang_spk(){
      	$this->load->view('user/pembelian/keranjang_spk');
      }
      public function proses_tambah_pr(){
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

			for($i = 0; $i < $jumlah_permintaan_barang; $i++){
				array_push($data_detail_keluar, ['number_request' => $this->input->post('number_pr')]);
				$data_detail_keluar[$i]['detailName'] = $this->input->post('detailName_hidden')[$i];
				$data_detail_keluar[$i]['itemNo'] = $this->input->post('itemNo_hidden')[$i];
				$data_detail_keluar[$i]['warna'] = $this->input->post('warna_hidden')[$i];
				$data_detail_keluar[$i]['quantity'] = $this->input->post('quantity_hidden')[$i];
				$data_detail_keluar[$i]['itemUnitName'] = $this->input->post('itemUnitName_hidden')[$i];
				$data_detail_keluar[$i]['detailNotes'] = $this->input->post('detailNotes_hidden')[$i];
			}
			$this->m_pembelian->save_purchase_dt1($data_detail_keluar); //simpan ke tabel alba permintaan barang dt

			$data_hs['no_po'] = $number_pr;
			$data_hs['status'] = 'Permintaan Barang Dibuat';
			$data_hs['action_by'] = $created_po;
			$data_hs['actiontime'] = $createdtime_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel alba purchase history

			$this->session->set_flashdata('success', 'Permintaan <strong>Barang</strong> Berhasil Dibuat!');
			redirect('user/pembelian/list_permintaan'); //redirect page
		}
		public function proses_tambah_spk(){
			$jumlah_permintaan_barang = count($this->input->post('detailName_hidden'));
			$jumlah_permintaan_barang_pr = count($this->input->post('detailName_hidden'));
			$transDate = $this->input->post('transDate'); 
        //	$number_ = $this->input->post('number_');
			$vendorNo = $this->input->post('vendorNo');
			$shipDate = $this->input->post('shipDate');
			$description = $this->input->post('description');
			$taxable = $this->input->post('taxable');;
			$departmentName = $this->input->post('departmentName');
			$branchName = $this->input->post('branchName');
			$number_pr = $this->input->post('number_pr');
			$number_ = $this->input->post('number_');
			$project = $this->input->post('project'); 
			$toAddress = $this->input->post('toAddress');
			$jenis_pembayaran = $this->input->post('jenis_pembayaran');
			$jenis_p_item = $this->input->post('jenis_pembelian_item');
			$created_po = $this->session->login['nama'];
			$createdtime_po = date('Y-m-d H:i:s');

			if (!empty($_FILES['berkas']['name'])) {
				$config['upload_path']          = './img/uploads/berkas_pembelian';
				$config['allowed_types']        = '*';
				$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
				$config['encrypt_name']			= TRUE;
				$this->load->library('upload', $config);
				$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

				$data_hd['berkas_pdf'] = $this->upload->data("file_name");
			}

			$data_hd['number_pr'] = $number_pr;
			$data_hd['number_'] = $number_;
			$data_hd['transDate'] = $transDate;
			$data_hd['shipDate'] = $shipDate;
			$data_hd['taxable'] = $taxable;
			$data_hd['description'] = $description;
			$data_hd['vendorNo'] = $vendorNo;
			$data_hd['toAddress'] = $toAddress;	
			$data_hd['status_po'] = '11';		
			$data_hd['project'] = $project;
			$data_hd['branchName'] = $branchName; 
			$data_hd['jenis_pembelian_item'] = $jenis_p_item;
			$data_hd['created_po'] = $created_po;
			$data_hd['createdtime_po'] = $createdtime_po;
			$data_hd['jenis_permintaan'] = $jenis_pembayaran;

			$this->m_pembelian->save_purchase_spk_hd($data_hd); //simpan ke tabel purchase hd

			$data_hd_pr['number_pr'] = $number_pr;
			$data_hd_pr['transDate'] = $transDate;
			$data_hd_pr['vendorNo'] = $vendorNo;
			$data_hd_pr['toAddress'] = $toAddress;	
			$data_hd_pr['status_po'] = 'Selesai';		
			$data_hd_pr['project'] = $project;
			$data_hd_pr['created_po'] = $created_po;
			$data_hd_pr['createdtime_po'] = $createdtime_po;
			$this->m_pembelian->save_purchase_spk_hd_pr($data_hd_pr); //simpan ke tabel purchase hd

			$data_kode['jenis'] = $this->input->post('jenis_pembayaran');
			$data_kode['kode_otomatis'] = $this->input->post('number_');
			$this->m_pembelian->simpan_kode_terakhir($data_kode); //simpan_kode_terakhir

			$data_detail_keluar = [];
			$package_id = $this->input->post('latestNumber'); 
			for($i = 0; $i < $jumlah_permintaan_barang; $i++){
				array_push($data_detail_keluar, ['number_request' => $this->input->post('number_pr')]);
				$data_detail_keluar[$i]['id_dt'] = $package_id++;
				$data_detail_keluar[$i]['number_po'] = $number_;
				$data_detail_keluar[$i]['useTax1'] = $taxable;
				$data_detail_keluar[$i]['departmentName'] = $departmentName;
				$data_detail_keluar[$i]['status_proses_pr'] ='3';
			//	$data_detail_keluar[$i]['projectNo'] = $project;
				$data_detail_keluar[$i]['id_rap'] = $this->input->post('no_rap_hidden')[$i];
				$data_detail_keluar[$i]['detailName'] = $this->input->post('detailName_hidden')[$i];
				$data_detail_keluar[$i]['jenis_p_item'] = $jenis_p_item;
				$data_detail_keluar[$i]['unitPrice'] = $this->input->post('unitPrice_hidden')[$i];
				$data_detail_keluar[$i]['itemNo'] = $this->input->post('itemNo_hidden')[$i];
				$data_detail_keluar[$i]['quantity'] = $this->input->post('quantity_hidden')[$i];
				$data_detail_keluar[$i]['itemUnitName'] = $this->input->post('itemUnitName_hidden')[$i];
				$data_detail_keluar[$i]['detailNotes'] = $this->input->post('detailNotes_hidden')[$i];
				$data_detail_keluar[$i]['total_harga'] = $this->input->post('unitPrice_hidden')[$i] * $this->input->post('quantity_hidden')[$i];
			}
			$package_id2 = $this->input->post('latestNumber'); 
	for($i = 0; $i < $jumlah_permintaan_barang_pr; $i++){
			//	array_push($data_detail_keluar_spk_pr, ['number_request' => $this->input->post('number_pr')]);
				$data_detail_keluar_spk_pr[$i]['number_request'] = $number_pr;
				$data_detail_keluar_spk_pr[$i]['id_dt'] = $package_id2++;
				$data_detail_keluar_spk_pr[$i]['number_po'] = $number_;
				$data_detail_keluar_spk_pr[$i]['useTax1'] = $taxable;
				$data_detail_keluar_spk_pr[$i]['departmentName'] = $departmentName;
				$data_detail_keluar_spk_pr[$i]['status_proses_pr'] ='3';
			//	$data_detail_keluar_spk_pr[$i]['projectNo'] = $project;
				$data_detail_keluar_spk_pr[$i]['id_rap'] = $this->input->post('no_rap_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['detailName'] = $this->input->post('detailName_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['jenis_p_item'] = $jenis_p_item;
				$data_detail_keluar_spk_pr[$i]['unitPrice'] = $this->input->post('unitPrice_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['itemNo'] = $this->input->post('itemNo_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['quantity'] = $this->input->post('quantity_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['itemUnitName'] = $this->input->post('itemUnitName_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['detailNotes'] = $this->input->post('detailNotes_hidden')[$i];
				$data_detail_keluar_spk_pr[$i]['total_harga'] = $this->input->post('unitPrice_hidden')[$i] * $this->input->post('quantity_hidden')[$i];

			}

				$this->m_pembelian->save_purchase_spk_dt($data_detail_keluar);
				$this->m_pembelian->save_purchase_spk_dt_pr($data_detail_keluar_spk_pr);
		

			$data_hs['no_po'] = $number_pr;
			$data_hs['status'] = 'Pesanan Pembelian Dibuat';
			$data_hs['action_by'] = $created_po;
			$data_hs['actiontime'] = $createdtime_po;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel purchase history

			//untuk log
			$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$nama =  $this->input->post('number_pr');
			$keterangan =  'Add PR';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('number_pr');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log
	//	if($this->m_pembelian->save_purchase_hd($data_hd) && $this->m_pembelian->save_purchase_dt1($data_detail_keluar)){
			//for ($i=0; $i < $jumlah_permintaan_barang ; $i++) { 
			//	$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
			//}
			
		//}
			$this->session->set_flashdata('success', 'Pembelian <strong>Pesanan</strong> Berhasil Dibuat!');
			redirect('user/pembelian/list_pesanan_pembelian'); //redirect page
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

        redirect('user/pembelian/kelengkapan_pr/'.$id_redirect); //redirect page
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

				$dariDB_csa = $this->m_pembelian->cekkode_pesanan(); 
				$nourut_csa = substr($dariDB_csa, 11, 4);
				$kodeCSA = $nourut_csa + 1;
		    $this->data['generate_kode_csa']  = $kodeCSA; // nomor_csa

      	$this->load->view('user/pembelian/ubah_pr', $this->data);
      }
    public function list_permintaan($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Sales order';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_1(); 


		$this->load->view('user/pembelian/list_pr', $this->data);
	}
    public function proses_permintaan_barang($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'Permintaan Barang Sedang Diproses';
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

			$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_2(); 


		$this->load->view('user/pembelian/list_pr', $this->data);
	}

    public function laporan_01($id_lsp = NULL){ 
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
		$this->data['proyek'] = $this->m_pembelian->get_proyek();
		$project = $this->input->post('project');
		$this->data['all_pr'] = $this->m_pembelian->laporan_01($project); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report($project);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'user/pembelian/export_excel_01?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/laporan01', $this->data);
	}
    public function laporan_detail_item_bydate($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
		$this->data['proyek'] = $this->m_pembelian->get_proyek();
		$project = $this->input->post('project');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_detail_item_bydate($tanggal,$dan_tanggal); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report_bydate($tanggal,$dan_tanggal);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'user/pembelian/export_excel_laporan_bydate?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/laporan_detail_item_bydate', $this->data);
	}
			public function export_excel_laporan_bydate(){
       $this->data['title'] = "CASSA DESIGN";

    $tanggal = $_GET['tanggal'];
    $dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Laporan Pesanan Pembelian Proyek Dari Tanggal'. $tanggal . 'S/d '. $dan_tanggal;

	 	$penerimaan =$this->data['penerimaan'] = $this->m_pembelian->laporan_01_detail_item_bydate($tanggal,$dan_tanggal); //Lihat History Petty Cash

	// 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	// 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report_bydate($tanggal,$dan_tanggal);
  		$this->load->view('user/pembelian/laporan_excel_01_dtitem_bydate', $this->data);
    }
    public function laporan_detail_item($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
		$this->data['proyek'] = $this->m_pembelian->get_proyek();
		$project = $this->input->post('project');
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_detail_item($project); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report($project);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'user/pembelian/export_excel_01_dt_item?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/laporan_detail_item', $this->data);
	}

			public function export_excel_01_dt_item(){
       $this->data['title'] = "CASSA DESIGN";

    $project = $_GET['project'];
	 
	 	$ket = 'Laporan Pesanan Pembelian Proyek'. $project;

	 	$penerimaan =$this->data['penerimaan'] = $this->m_pembelian->laporan_01_detail_item($project); //Lihat History Petty Cash

	// 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	// 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report($project);
  		$this->load->view('user/pembelian/laporan_excel_01_dtitem', $this->data);
    }
		public function export_excel_01(){
       $this->data['title'] = "CASSA DESIGN";

    $project = $_GET['project'];
	 
	 	$ket = 'Laporan Pesanan Pembelian Proyek'. $project;

	 	$penerimaan =$this->data['penerimaan'] = $this->m_pembelian->laporan_01($project); //Lihat History Petty Cash

	// 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	// 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report($project);
  		$this->load->view('user/pembelian/laporan_excel_01', $this->data);
    }
    public function list_permintaan_item($id_lsp = NULL){
      	$this->data['aktif'] = 'pembelian';
      	$this->data['title'] = 'List Item Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
      	$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['all_pr'] = $this->m_pembelian->lihat_Item_pr_status_belum_proses(); 


		$this->load->view('user/pembelian/list_all_item_pr', $this->data);
	}

		public function export_pesanan_pembelian01($id_pr){ 
	//	$dompdf = new Dompdf();
			$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
			$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
			$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr); 
			$this->data['title'] = 'Pesanan Pembelian';
			$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'Pesanan_pembelian_CSA_ptcahayaselaras'.' '. $this->data['hd_pr']->id . ' ' . $this->data['hd_pr']->nama_project ;
		$html = $this->load->view('user/pembelian/report_pembelian01', $this->data, true);
		$this->pdf->create($html, $filename);
	}
			public function export_pesanan_pembelian03($id_pr){ 
	//	$dompdf = new Dompdf();
			$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
			$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
			$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr); 
			$this->data['title'] = 'Pesanan Pembelian';
			$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'SPK_CSA_ptcahayaselaras'.' '. $this->data['hd_pr']->id . ' ' . $this->data['hd_pr']->nama_project ;
		$html = $this->load->view('user/pembelian/report_pembelian03', $this->data, true);
		$this->pdf->create($html, $filename);
	}
				public function export_pesanan_pembelian04($id_pr){ 
	//	$dompdf = new Dompdf();
				$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
				$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
				$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr); 
			$this->data['title'] = 'Pesanan Pembelian';
			$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'SPK_MSA_ptcahayaselaras'.' '. $this->data['hd_pr']->id . ' ' . $this->data['hd_pr']->nama_project ;
		$html = $this->load->view('user/pembelian/report_pembelian04', $this->data, true);
		$this->pdf->create($html, $filename);
	}
		public function export_pesanan_pembelian02($id_pr){ 
	//	$dompdf = new Dompdf();
				$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
				$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
				$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr); 
			$this->data['title'] = 'Pesanan Pembelian';
			$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'Pesanan_pembelian_MSA_ptcahayaselaras'.' '. $this->data['hd_pr']->id . ' ' . $this->data['hd_pr']->nama_project ;
		$html = $this->load->view('user/pembelian/report_pembelian02', $this->data, true);
		$this->pdf->create($html, $filename);
	}
		public function export_pesanan_permintaan01($id_pr){ 
	//	$dompdf = new Dompdf();
    	$this->data['hd_pr'] = $this->m_pembelian->lihat_pr_detail_hd($id_pr);
	    $this->data['dt_pr'] = $this->m_pembelian->lihat_pr_detail_dt($id_pr); 
			$this->data['title'] = 'Pesanan Pembelian';
			$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'Permintaan_barang_ptcahayaselaras'.' '. $this->data['hd_pr']->id . ' ' . $this->data['hd_pr']->nama_project ;
		$html = $this->load->view('user/pembelian/report_permintaan01', $this->data, true);
		$this->pdf->create($html, $filename);
	}
	public function list_permintaan_get($number_pr = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'List Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$number_pr = $this->input->post('number_pr');
		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_post($number_pr); 


		$this->load->view('user/pembelian/list_pr_get', $this->data);
	}
	public function list_history_permintaan($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_riwayats(); 


		$this->load->view('user/pembelian/list_pr', $this->data);
	}
	public function move_pr(){
		$no_pr = $this->input->post('number_pr');
		$id_hd = $this->input->post('id');
		$data['status_po'] = "Selesai";
		$this->m_pembelian->ubah_status_pr($data,$id_hd); 
		$this->session->set_flashdata('error', ' PR <strong>Gagal</strong> Ditambahkan!');
		$this->session->set_flashdata('success',$no_pr. '  <strong>Dipindahkan Ke Tabel Riwayat Permintaan Barang</strong>!');
		redirect('user/pembelian/list_permintaan');
	}
	public function Forecast($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Forecast';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		$this->data['all_pr'] = $this->m_pembelian->list_forcest(); 

		$this->load->view('user/pembelian/list_po_hd', $this->data);
	}
	public function produksi($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Produksi';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		$this->data['all_pr'] = $this->m_pembelian->list_produksi(); 

		$this->load->view('user/pembelian/list_po_hd', $this->data);
	}
	public function scan_cutting($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Cutting';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;


		$this->load->view('user/pembelian/scan', $this->data);
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
			redirect('user/pembelian/scan_cutting');
		} elseif ($cek_kehadiran && $cek_kehadiran->status_qr == '' ) {
			$data = array(
				'status_qr' => 'Cutting',
			);
			$this->m_pembelian->absen_pulang($result_code, $data);
			$this->session->set_flashdata('success', 'Status Barang '.$result_code.' Berhasil Diubah!');
			redirect('user/pembelian/scan_cutting');
		} elseif ($cek_kehadiran && $cek_kehadiran->status_qr != '') {
			$this->session->set_flashdata('info', 'Kode Barang '.$result_code.' Sudah Diubah!');
			redirect('user/pembelian/scan_cutting');
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



		$this->load->view('user/pembelian/list_po_selesai', $this->data);
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
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_notspk();  

		$this->load->view('user/pembelian/list_po_selesai_item', $this->data);
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
		public function list_selesai_spk($id_lsp = NULL){ 
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian Spk';
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
		$this->data['all_pr'] = $this->m_pembelian->lihat_pr_status_7spk();  

		$this->load->view('user/pembelian/list_spk_selesai', $this->data);
	}
	public function list_pengiriman($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Proses Pengiriman';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['all_pr'] = $this->m_pembelian->list_stok(); 

		$this->load->view('user/pembelian/list_po', $this->data);
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

		$this->load->view('user/pembelian/detail_pr', $this->data); 
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

	    	$this->load->view('user/pembelian/detail_po', $this->data);
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


				$this->load->view('user/pembelian/detail_po_dt', $this->data);
			}

	    public function detail_po_dt_log($id_pr = NULL){

	    	$this->load->database();
	    	$last = $this->db->order_by('no',"desc")
	    	->limit(1)
	    	->get('alba_pesanan_barang_dt')
	    	->row();
 	$this->data['hd_api'] = $this->m_pembelian->api_show($id_pr);
  			$this->data['last'] = $last;
	    	$this->data['aktif'] = 'pembelian';
	    	$this->data['title'] = 'History Purchase Order Header';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
	    	$this->data['no'] = 1;
	    	$id = $this->session->login['kode'];
	    	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    	$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    	$this->data['view_task'] = $this->m_kerja->my_modul();
	    	$this->data['proyek'] = $this->m_pembelian->daftar_project();
				$this->data['all_vendor'] = $this->m_barang->lihat_pemasok(); //get data Pemasok
				$this->data['hd_pr'] = $this->m_pembelian->lihat_po_detail_hd($id_pr);
				$this->data['dt_pr'] = $this->m_pembelian->lihat_po_detail_dt($id_pr);
				$this->data['dt_pr_count_estimator'] = $this->m_pembelian->lihat_po_detail_dt_count($id_pr);
				$this->data['his_pr'] = $this->m_pembelian->lihat_po_detail_history($id_pr); 
				$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
				$this->data['hs_price'] = $this->m_pembelian->lihat_po_history_price($id_pr);
				$this->data['hs_header'] = $this->m_pembelian->lihat_po_history_header($id_pr);
				$this->load->view('user/pembelian/detail_po_dt_log', $this->data);
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
	    	$this->load->view('user/pembelian/detail_po_dt_penerimaan', $this->data);
	    }
	    public function delete_detail_pr()
	    {
	    	if($this->input->post('checkbox_value'))
	    	{


	    		$id = $this->input->post('checkbox_value');
	    		for($count = 0; $count < count($id); $count++)
	    		{
	    			$this->m_pembelian->hapus_pr_dt1($id[$count]);
	    		}
	    	}
	    }

	  public function delete_detail_p0()
	    {
	    	if($this->input->post('checkbox_value'))
	    	{


	    		$id = $this->input->post('checkbox_value');
	    		for($count = 0; $count < count($id); $count++)
	    		{
	    			$this->m_pembelian->hapus_po_dt($id[$count]);
	    		}
	    	}
	    }


       public function hapus_master_wo($id)
	    {

	    	date_default_timezone_set('Asia/Jakarta');
	    	$data_log['user'] = $this->session->login['nama'];
	    	$data_log['waktu'] = date('Y-m-d H:i:s');
	    	$data_log['ket'] = 'Hapus purchase request';
	    	$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if(!empty($id_dt)){
				$this->db->delete('alba_pesanan_barang_dt', ['number_po' => $id_dt]);
				
				$this->session->set_flashdata('success', 'Laporan Payment <strong>Berhasil</strong> Dihapus!');
			redirect('user/wo/master_wo'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Laporan Payment<strong>Gagal</strong> Dihapus!');
			redirect('user/wo/master_wo'); //redirect page
		}
	}

      public function master_wo($id_lsp = NULL){
		$this->data['aktif'] = 'master_wo';
		$this->data['title'] = 'Master Work Order'; 
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$jenis_produksi = 'Produksi';
		//$jenis_line = 'Line 1';
		$this->data['laporan'] = 'Produksi';
		//$this->data['jenis_line'] = $jenis_line;

        //start
		$jenis_tanggal = $this->input->post('jenis_tanggal');
		$tanggal = $this->input->post('tanggal');
		$dan_tanggal = $this->input->post('dan_tanggal');

	  
	// Dapatkan bulan dan tahun saat ini
$bulan_sekarang = date('Y-m');
 set_time_limit(50); // Meningkatkan waktu eksekusi menjadi 60 detik

        // Jika 'jenis_tanggal' kosong atau 'Semua Data', ambil data berdasarkan bulan sekarang
        if ($jenis_tanggal == 'Semua Data' || empty($jenis_tanggal)) {
            $this->data['all_pr'] = $this->m_pembelian->list_master_wo($jenis_produksi, $bulan_sekarang.'-01', $bulan_sekarang.'-31', 'transDate');
    
        } elseif (($jenis_tanggal == 'tanggal_kirim' || $jenis_tanggal == 'transDate') && !empty($tanggal)) {
            // Jika 'tanggal_kirim' atau 'transDate' dipilih dan 'tanggal' tidak kosong, filter berdasarkan tanggal
            $this->data['all_pr'] = $this->m_pembelian->list_master_wo($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        } else {
            // Kondisi default jika tidak ada filter lain yang terpenuhi
            $this->data['all_pr'] = $this->m_pembelian->list_master_wo($jenis_produksi, $tanggal, $dan_tanggal, $jenis_tanggal);
        }

		//finish
		 
		$this->load->view('user/pembelian/master_wo', $this->data);
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
			redirect('user/pembelian/list_permintaan'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Laporan Payment<strong>Gagal</strong> Dihapus!');
			redirect('user/pembelian/list_permintaan'); //redirect page
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
    $this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel alba_permintaan_barang_dt


			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('user/pembelian/detail_pr/'.$id_hd);

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
			redirect('user/pembelian/detail_pr/'.$id_hd);

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
			redirect('user/pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function apprv_estimator_po_dt(){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_hd = $this->input->post('id_header');
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['no'] = $this->input->post('id_detail');

			$update_dt['status_estimator'] = $this->input->post('status_estimator');
			$update_dt['note_estimator'] = $this->input->post('note_estimator');
      $this->m_pembelian->save_update_po_dtt($update_dt); //simpan ke tabel pr dt


      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Update Detail Pesanan Pembelian';
      $data_log['kode'] = $this->input->post('id_dt');
					$this->m_mom->tambah_log($data_log); //simpan ke tabel log

					if ($this->input->post('status_estimator') == 1){
						$ket1 = 'Estimator Menyetujui Pembelian Item Id';
						$data_hs['action_by'] = $this->session->login['nama'];
						$data_hs['actiontime'] = date('Y-m-d H:i:s');
						$idnya = $this->input->post('id_dt');
						$ket2 = $this->input->post('note_estimator');
						$no_id = $this->input->post('nomor_');
						$data_hs['no_po'] = $this->input->post('no_po');
						$data_hs['status'] = $ket1.' '.$idnya.' -  '.$ket2.' , '.$no_id;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
		}	
		if ($this->input->post('status_estimator') == 2){
			$ket1 = 'Estimator Menolak Item Id';
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$ket2 = $this->input->post('note_estimator');
			$harga = $this->input->post('harga_lama');
			$no_id = $this->input->post('nomor_');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = $ket1.' '.$idnya.'  '.$harga.' -  '.$ket2.' , '.$no_id;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
		}	


		$this->session->set_flashdata('error', 'Detail PO <strong>Gagal</strong> Ditambahkan!');
		$this->session->set_flashdata('success', 'Detail Pesanan Pembelian <strong>Berhasil</strong> Diubah!');
		redirect('user/pembelian/detail_po_dt/'.$id_hd);

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
			redirect('user/pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
		public function ubah_pr_dt_prosesto_po(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			$id_hd = $this->input->post('id_header');
			$cek_status =  $this->input->post('status_qr');
			$cek_stok =  $this->input->post('Stok');
			$qty_permintaan =  $this->input->post('quantity');
			$cek_status = $this->input->post('status_proses_pr');

			if($cek_status == 'Stok' and $cek_status == 2 and  $qty_permintaan > $cek_stok ){

			$this->session->set_flashdata('error_stok', ' <strong>Gagal</strong> Diubah!');
			redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}

			//update jika status stok dan bukan diproses 
			if($cek_status == 'Stok' and $cek_status != 2 ){

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
			redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}
			if($cek_status == 'Stok' and $cek_status == 2 and  $qty_permintaan <= $cek_stok ){

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
			$update_dt['status_awal'] =  $this->input->post('status_qr');

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
			redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}
			if($cek_status != 'Stok'){

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
		//	$update_dt['tanggal_kirim'] = $this->input->post('tanggal_kirim');
			$update_dt['status_awal'] =  $this->input->post('status_qr');

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
			redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}
	


      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function ubah_pr_dt_prosesto_po_rap(){
			date_default_timezone_set('Asia/Jakarta');
			      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
			$cek_id_rap = $this->input->post('no_rap');
			if(!empty($cek_id_rap)){
							$id_hd = $this->input->post('id_header');
			$cek_jenis_item = $this->input->post('jenis_pembelian_item');
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['unitPrice'] = $this->input->post('unitPrice');
			$update_dt['itemDiscPercent'] = $this->input->post('itemDiscPercent');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['total_harga'] = $this->input->post('unitPrice') * $this->input->post('quantity') ;
			$update_dt['id_rap'] = $this->input->post('no_rap');


			$qty = $this->input->post('quantity');
			$qty_lama = $this->input->post('quantity_lama');
			$harga_baru = $this->input->post('unitPrice');
			$hb = $qty * $harga_baru;
			$harga_lama = $this->input->post('harga_lama');
			$hl = $qty * $qty_lama;

			$selisih = $hb - $hl;
			$sisa_anggaran = $this->input->post('jumlah');
			if ($selisih > $sisa_anggaran){
				$this->session->set_flashdata('error_update', 'Detail PR <strong>Berhasil</strong> Diubah!');
				redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}
			if ($selisih <= $sisa_anggaran ){
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
	//		$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
				$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
				redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			}
		}
			if(empty($cek_id_rap)){
			$id_hd = $this->input->post('id_header');
			$cek_jenis_item = $this->input->post('jenis_pembelian_item');
			$update_dt['id_dt'] = $this->input->post('id_dt');
			$update_dt['detailName'] = $this->input->post('detailName');
			$update_dt['quantity'] = $this->input->post('quantity');
			$update_dt['detailNotes'] = $this->input->post('detailNotes');
			$update_dt['unitPrice'] = $this->input->post('unitPrice');
			$update_dt['itemDiscPercent'] = $this->input->post('itemDiscPercent');
			$update_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$update_dt['total_harga'] = $this->input->post('unitPrice') * $this->input->post('quantity') ;
		//	$update_dt['id_rap'] = $this->input->post('no_rap');

		
			$this->session->set_flashdata('error_update', 'Detail PR <strong>Berhasil</strong> Diubah!');
	
	
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
	//		$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
				$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
				redirect('user/pembelian/kelengkapan_pr/'.$id_hd);
			

			}
			
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

			$this->m_pembelian->save_po_detail_item($save_item_dt); //simpan ke tabel pr dt
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('user/pembelian/kelengkapan_pr/'.$id_hd);

		//	$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function update_po_cek_estimator($id = NULL) { 
			date_default_timezone_set('Asia/Jakarta');
     //      echo '<pre>';
    //      print_r ($_POST);
     //   echo '</pre>';
     //  print POST
        //print_r($this->db->last_query()); //print query
     //  exit;
	$id_hd = $this->input->post('id_header');
  $no = $this->input->post('no'); //array of id
	$status_estimator = $this->input->post('status_estimator'); //  array
	$approvalBy = $this->session->login['nama']; // not array
	$approvalTime = date('Y-m-d H:i:s'); // not array
	if(!empty($status_estimator) ) {

		$result = array();
		foreach($no AS $key => $val){
			$result[] = array(
				'no'   => $no[$key],
				'status_estimator'   => $status_estimator[$key]
			);
		}      
            //MULTIPLE INSERT TO DETAIL TABLE
		$this->db->update_batch('alba_pesanan_barang_dt', $result,'no'); 
		$this->session->set_flashdata('success', 'Item <strong>Berhasil</strong> Diproses!');

	}

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'Estimator Menyetujui Pembelian';
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
	$this->session->set_flashdata('error', 'Item <strong>Gagal</strong> Diproses!');

	redirect('user/pembelian/detail_po_dt/'.$id_hd);
}
		public function update_po_cek_pm($id = NULL) { 
			date_default_timezone_set('Asia/Jakarta');
     //      echo '<pre>';
    //      print_r ($_POST);
     //   echo '</pre>';
     //  print POST
        //print_r($this->db->last_query()); //print query
     //  exit;
	$id_hd = $this->input->post('id_header');
  $no = $this->input->post('no'); //array of id
	$status_estimator = $this->input->post('status_estimator'); //  array
	$approvalBy = $this->session->login['nama']; // not array
	$approvalTime = date('Y-m-d H:i:s'); // not array
	if(!empty($status_estimator) ) {

		$result = array();
		foreach($no AS $key => $val){
			$result[] = array(
				'no'   => $no[$key],
				'status_pm'   => $status_estimator[$key]
			);
		}      
            //MULTIPLE INSERT TO DETAIL TABLE
		$this->db->update_batch('alba_pesanan_barang_dt', $result,'no'); 
		$this->session->set_flashdata('success', 'Item <strong>Berhasil</strong> Diproses!');

	}

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'PM Menyetujui Pembelian';
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
	$this->session->set_flashdata('error', 'Item <strong>Gagal</strong> Diproses!');

	redirect('user/pembelian/detail_po_dt/'.$id_hd);
}

	public function tambah_item_new_po_detail_dt(){
			date_default_timezone_set('Asia/Jakarta');

		//	$code = $this->m_pembelian->cekkode_trakhir_po(); //cek kode trakhir id dt


			$id_hd = $this->input->post('id_header');

			$save_item_dt['id_rap'] = $this->input->post('no_rap');
			$save_item_dt['id_dt'] = $this->input->post('kode_trakhir');
			$save_item_dt['number_po'] = $this->input->post('number_po');
			$save_item_dt['number_request'] = $this->input->post('id_dt');
			$save_item_dt['detailName'] = $this->input->post('detailName');
			$save_item_dt['itemNo'] = $this->input->post('itemNo'); 
			$save_item_dt['projectNo'] = $this->input->post('projectNo'); 
			$save_item_dt['departmentName'] = $this->input->post('departmentName'); 
			$save_item_dt['useTax1'] = $this->input->post('taxable'); 
			$save_item_dt['itemUnitName'] = $this->input->post('itemUnitName');
			$save_item_dt['quantity'] = $this->input->post('quantity');
			$save_item_dt['detailNotes'] = $this->input->post('detailNotes');
			$save_item_dt['unitPrice'] = $this->input->post('unitPrice');
			$save_item_dt['jenis_p_item'] = $this->input->post('jenis_pembelian_item');
			$save_item_dt['status_proses_pr'] = $this->input->post('status_proses_pr');
			$save_item_dt['total_harga'] = $this->input->post('unitPrice') * $this->input->post('quantity') ;
      $this->m_pembelian->save_po_detail_item_1($save_item_dt); //simpan ke tabel tbl_po_dt

      $save_item_dt_pr['id_rap'] = $this->input->post('no_rap');
			$save_item_dt_pr['id_dt'] = $this->input->post('kode_trakhir');
			$save_item_dt_pr['status_proses_pr'] = 3;
			$save_item_dt_pr['number_po'] = $this->input->post('number_po');
			$save_item_dt_pr['number_request'] = $this->input->post('id_dt');
			$save_item_dt_pr['detailName'] = $this->input->post('detailName');
			$save_item_dt_pr['itemNo'] = $this->input->post('itemNo'); 
			$save_item_dt_pr['unitPrice'] = $this->input->post('unitPrice');
			$save_item_dt_pr['itemUnitName'] = $this->input->post('itemUnitName');
			$save_item_dt_pr['projectNo'] = $this->input->post('projectNo'); 
			$save_item_dt_pr['departmentName'] = $this->input->post('departmentName'); 
			$save_item_dt_pr['useTax1'] = $this->input->post('taxable'); 
			$save_item_dt_pr['quantity'] = $this->input->post('quantity');
			$save_item_dt_pr['detailNotes'] = $this->input->post('detailNotes');
			
			$save_item_dt_pr['jenis_p_item'] = $this->input->post('jenis_pembelian_item');
			$save_item_dt_pr['total_harga'] = $this->input->post('unitPrice') * $this->input->post('quantity') ;
      $this->m_pembelian->save_po_detail_item_1_pr($save_item_dt_pr); //simpan ke tabel pr dt






      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Tambah Item PR';
      $data_log['kode'] = $this->input->post('id_dt');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$this->session->set_flashdata('error', 'Detail PR <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Detail PR <strong>Berhasil</strong> Diubah!');
			redirect('user/pembelian/detail_po_dt/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function proses_klaim_po(){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_hd = $this->input->post('id_header');
			$id_dt = $this->input->post('id_dt');
			$status_item = $this->input->post('status_item');
			$status_item_noted = $this->input->post('status_item_noted');
			if ($status_item == 'TIDAK SESUAI'){
				$data['status_po'] = '9';
      $this->m_pembelian->ubah_status_po($data,$id_hd); //simpan ke tabel pr dt
    }

    if (!empty($_FILES['berkas']['name'])) {
    	$config['upload_path']          = './img/uploads/berkas1';
    	$config['allowed_types']        = '*';
    	$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
    	$config['encrypt_name']			= TRUE;
    	$this->load->library('upload', $config);
    	$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

    	$data_detail['foto'] = $this->upload->data("file_name");
    }
    $data_detail['status_item'] = $status_item;
    $data_detail['id_dt'] = $id_dt;
    $data_detail['status_item_noted'] = $status_item_noted;
      $this->m_pembelian->ubah_statusItem_po_detail_1($data_detail); //simpan ke tabel pr dt

      $data_log['user'] = $this->session->login['nama'];
      $data_log['waktu'] = date('Y-m-d H:i:s');
      $data_log['ket'] = 'Update Detail Pesanan Pembelian';
      $data_log['kode'] = $this->input->post('number_pr');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('number_pr');
			$data_hs['status'] = 'Pesanan Pembelian id '.$idnya.' '.$status_item;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'Detail Pesanan <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Detail Pesanan  <strong>Berhasil</strong> Diubah!');
			redirect('user/pembelian/detail_po_dt_penerimaan/'.$id_hd);

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
			redirect('user/pembelian/detail_po_dt_penerimaan/'.$id_hd);

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
			redirect('user/pembelian/detail_po_dt_penerimaan/'.$id_hd);

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}	
		public function proses_terima_barang(){
			date_default_timezone_set('Asia/Jakarta');
			$cek_status = $this->input->post('status_po');
			if ($cek_status == 7){
				if (!empty($_FILES['surat_jalan']['name'])) {
					$config['upload_path']          = './img/uploads';
					$config['allowed_types']        = '*';
					$config['max_size']             = 10000;
			   //$config['max_width']            = 1024;
			   //$config['max_height']           = 768;
					$config['encrypt_name']         = TRUE;
					$this->load->library('upload', $config);
					$this->upload->do_upload('surat_jalan');
			   // $file1 = $this->upload->data();
			   //    echo '<pre>';
			//    print_r ($file1);
			//   echo '</pre>';
			//   exit;
					$data_hd['surat_jalan'] = $this->upload->data("file_name");
				}
				$data_hd['number_'] = $this->input->post('number_');
				$data_hd['status_po'] = $this->input->post('status_po');
				$data_hd['update_po_by'] = $this->session->login['nama'];
				$data_hd['updateTime_po'] = date('Y-m-d H:i:s');
      		$this->m_pembelian->save_purchase_hd($data_hd); //simpan ke tabel pr dt


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Update PO';
      		$data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('number_');
			$data_hs['status'] = 'Barang Diterima '.$idnya;
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
		}
		$cek_status = $this->input->post('status_po');
		if ($cek_status == 9){

			$data_hd['number_'] = $this->input->post('number_');
			$data_hd['status_po'] = $this->input->post('status_po');
			$data_hd['update_po_by'] = $this->session->login['nama'];
			$data_hd['updateTime_po'] = date('Y-m-d H:i:s');
      		$this->m_pembelian->save_purchase_hd($data_hd); //simpan ke tabel pr dt


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Update PO';
      		$data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('number_');
			$data_hs['no_po'] = $this->input->post('number_');
			$data_hs['status'] = 'Klaim, Barang Tidak Sesuai ';
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr
		}
		$this->session->set_flashdata('error', 'PO <strong>Gagal</strong> Diproses!');
		$this->session->set_flashdata('success', 'PO <strong>Berhasil</strong> Diproses!');
		redirect('user/pembelian/list_pengiriman');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
	public function proses_return_barang(){
		date_default_timezone_set('Asia/Jakarta');
		$cek_status = $this->input->post('status_po');

		$data_hd['number_'] = $this->input->post('number_');
		$data_hd['status_po'] = $this->input->post('status_po');
		$data_hd['tgl_return'] = $this->input->post('tgl_return');
		$data_hd['update_po_by'] = $this->session->login['nama'];
		$data_hd['updateTime_po'] = date('Y-m-d H:i:s');
      		$this->m_pembelian->save_purchase_hd($data_hd); //simpan ke tabel pr dt


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Return PO';
      		$data_log['kode'] = $this->input->post('number_');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 

			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('number_');
			$data_hs['status'] = 'Pengiriman ulang barang tidak sesuai ';
			$this->m_pembelian->save_purchase_history($data_hs); //simpan ke tabel log status pr

			$this->session->set_flashdata('error', 'PO <strong>Gagal</strong> Diproses!');
			$this->session->set_flashdata('success', 'PO <strong>Berhasil</strong> Diproses!');
			redirect('user/pembelian/list_pengiriman');

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
			redirect('user/pembelian/detail_po/'.$id_hd);

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
			redirect('user/pembelian/detail_pr/'.$id_hd);

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
			redirect('user/pembelian/detail_po_dt/'.$id_hd);

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
		$gambar_kerja = $this->input->post('gambar_kerja'); 
		$status_proses_pr = $this->input->post('status_proses_pr');  

		$detailNotes = $this->input->post('detailNotes');
   
		$id_dt = $this->input->post('id_dt');

    		$this->m_pembelian->save_pr_sattle_dt($number_po,$number_,$detailName,$itemNo,$quantity,$id_dt,$itemUnitName,$warna,$gambar_kerja,$status_proses_pr,$detailNotes, $qr_code); //untuk tabel purchase dt

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
			$this->session->set_flashdata('success', 'PR <strong>Berhasil</strong> Ditambahkan!');
       redirect('user/pembelian/list_permintaan'); //redirect page
     }
     public function index($id_lsp = NULL){
     	$this->data['aktif'] = 'list_payment';
     	$this->data['title'] = 'List Payment Waiting Approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
     	$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$id_lsp = $this->input->post('id_lsp');
		$this->data['all_paym'] = $this->m_payment->view_payment_status(); 

		$this->load->view('user/paym/lihat_paym', $this->data);
	}
	public function pending_($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Pending';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$id_lsp = $this->input->post('id_lsp');
		$this->data['all_paym'] = $this->m_payment->count_payment_status_pend(); 

		$this->load->view('user/paym/lihat_paym', $this->data);
	}
	public function finish($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$id_lsp = $this->input->post('id_lsp');
		$this->data['all_paym'] = $this->m_payment->view_payment_status_f(); 

		$this->load->view('user/paym/lihat_paym_apprvd', $this->data);
	}
	public function finishh($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Paid';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$id_lsp = $this->input->post('id_lsp');
		$this->data['all_paym'] = $this->m_payment->view_payment_status_4(); 

		$this->load->view('user/paym/lihat_paym_finish', $this->data);
	}
	public function add_pay($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->load->view('user/paym/add_payment', $this->data);
	}
	public function finish_($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'Print report payment approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat(); 


		$tanggal = $this->input->post('tanggal');
		$header_payment = $this->input->post('header_payment');
		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
		$absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment); 
		$count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);  
		$url_cetak = 'user/payment/export?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('user/paym/report_paym', $this->data);
	}
	
	public function export_excel(){  
		$tanggal = $_GET['tanggal']; 
		$header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
		$url_cetak = 'user/payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment);  
		$count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);
		$this->data['ket'] = $ket;
		$this->data['status'] = 'APPROVED';
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;

		$this->load->view('user/paym/export_excel', $this->data); 
	}
	public function export(){
		$this->data['title'] = "CASSA DESIGN"; 

        //$tgl_sekarang = $_GET['tanggal_sekarang'];

             // Jika filter nya 1 (per tanggal)
		$tanggal = $_GET['tanggal']; 
		$header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
		$nama_fle ='CSA-MSA-GFY-';
		$ket = $nama_fle.date('dmY', strtotime($tanggal));
		$url_cetak = 'user/payment/export?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment);  
		$count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);
		$this->data['ket'] = $ket;
		$this->data['status'] = 'APPROVED';
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
        $filename = $ket;
        $html = $this->load->view('user/paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
      }
      public function print_p($id_lsp = NULL){
      	$this->data['aktif'] = 'list_payment';
      	$this->data['title'] = 'Print report waiting approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat(); 


		$tanggal = $this->input->post('tanggal');
		$header_payment = $this->input->post('header_payment');
		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
		$absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment); 
		$count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);  
		$url_cetak = 'user/payment/export_p?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('user/paym/report_paym', $this->data);
	}
	public function export_p(){
		$this->data['title'] = "CASSA DESIGN"; 

        //$tgl_sekarang = $_GET['tanggal_sekarang'];

             // Jika filter nya 1 (per tanggal)
		$tanggal = $_GET['tanggal']; 
		$header_payment = $_GET['header_payment'];
       // $this->data['judul'] = "CSA-MSA-GFY-".$tanggal;	
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
		$nama_fle ='CSA-MSA-GFY-';
		$ket = 'Waiting Approve '.$nama_fle.date('dmY', strtotime($tanggal));
		$url_cetak = 'user/payment/export_p?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment);  
		$count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);
		$this->data['ket'] = $ket;
		$this->data['status'] = 'BELUM DIAPPROVE';
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
        $filename = $ket;
        $html = $this->load->view('user/paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
      }
      public function export_excel_pending(){  
      	$tanggal = $_GET['tanggal']; 
      	$header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
      	$nama_fle ='CSA-MSA-GFY-';
       // $kalimat2=addcslashes($nama_fle);
      	$ket = $nama_fle.date('dmY', strtotime($tanggal));
      	$url_cetak = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
      	$url_cetak_excel = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
      	$absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment);  
      	$count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);
      	$this->data['ket'] = $ket;
      	$this->data['status'] = 'BELUM DIAPPROVE';
      	$this->data['url_cetak'] = base_url($url_cetak);
      	$this->data['all_paym'] = $absensi;
      	$this->data['count'] = $count;

      	$this->load->view('user/paym/export_excel', $this->data); 
      }

      public function print_paid($id_lsp = NULL){
      	$this->data['aktif'] = 'list_payment';
      	$this->data['title'] = 'Print report payment paid';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
      	$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat(); 


		$tanggal = $this->input->post('tanggal');
		$header_payment = $this->input->post('header_payment');
		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
		$absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment); 
		$count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);  
		$url_cetak = 'user/payment/export_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('user/paym/report_paym', $this->data);
	}
	public function export_paid(){
		$this->data['title'] = "CASSA DESIGN"; 

        //$tgl_sekarang = $_GET['tanggal_sekarang'];

             // Jika filter nya 1 (per tanggal)
		$tanggal = $_GET['tanggal']; 
		$header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
		$nama_fle ='CSA-MSA-GFY-';
		$ket = $nama_fle.date('dmY', strtotime($tanggal));
		$url_cetak = 'user/payment/export_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment);  
		$count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);
		$this->data['ket'] = $ket;
		$this->data['status'] = 'PAID';
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
        $filename = $ket;
        $html = $this->load->view('user/paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
      }
      public function export_excel_paid(){  
      	$tanggal = $_GET['tanggal']; 
      	$header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
      	$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
      	$url_cetak = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
      	$url_cetak_excel = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
      	$absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment);  
      	$count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);
      	$this->data['ket'] = $ket;
      	$this->data['status'] = 'PAID';
      	$this->data['url_cetak'] = base_url($url_cetak);
      	$this->data['all_paym'] = $absensi;
      	$this->data['count'] = $count;

      	$this->load->view('user/paym/export_excel', $this->data); 
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
        redirect('user/payment'); //redirect page
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
       redirect('user/pembelian/list_permintaan'); //redirect page
     }



     public function hapus_laporan($id){

     	date_default_timezone_set('Asia/Jakarta');
     	$data_log['user'] = $this->session->login['nama'];
     	$data_log['waktu'] = date('Y-m-d H:i:s');
     	$data_log['ket'] = 'Hapus Payment';
     	$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if($this->m_payment->hapus_laporan_payment($id)){
				$this->session->set_flashdata('success', 'Laporan Payment <strong>Berhasil</strong> Dihapus!');
			redirect('user/payment'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Laporan Payment<strong>Gagal</strong> Dihapus!');
			redirect('user/payment'); //redirect page
		}
	}


	public function hapus_vendor($id){
		date_default_timezone_set('Asia/Jakarta');
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$data_log['ket'] = 'Hapus Vendor';
		$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if($this->m_payment->hapus_vendor($id)){
				$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Dihapus!');
			redirect('user/payment/d_vend'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Vendor<strong>Gagal</strong> Dihapus!');
			redirect('user/payment/d_vend'); //redirect page
		}
	}
	public function proses_simpan_supplier(){
		date_default_timezone_set('Asia/Jakarta');
		$atdnc_data['supp_name'] = $this->input->post('supp_name');
		$atdnc_data['supp_rekname'] = $this->input->post('supp_rekname');
		$atdnc_data['supp_norek'] = $this->input->post('supp_norek');
		$atdnc_data['createdBy_supp'] = $this->session->login['nama'];
		$atdnc_data['createdTime_supp'] = date('Y-m-d H:i:s');
      		$this->m_payment->save_supplier($atdnc_data); //simpan ke tabel jenis izin


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Add Supplier';
      		$data_log['kode'] = $this->input->post('supp_name');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/payment/d_supp');

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

		}
		public function proses_update_supplier(){
			date_default_timezone_set('Asia/Jakarta');
			$atdnc_data['id_supp'] = $this->input->post('id_supp');
			$atdnc_data['supp_name'] = $this->input->post('supp_name');
			$atdnc_data['supp_rekname'] = $this->input->post('supp_rekname');
			$atdnc_data['supp_norek'] = $this->input->post('supp_norek');
			$atdnc_data['updateBy_supp'] = $this->session->login['nama'];
			$atdnc_data['updateTime_supp'] = date('Y-m-d H:i:s');
      		$this->m_payment->update_supplier($atdnc_data); //simpan ke tabel jenis izin


      		$data_log['user'] = $this->session->login['nama'];
      		$data_log['waktu'] = date('Y-m-d H:i:s');
      		$data_log['ket'] = 'Update Supplier';
      		$data_log['kode'] = $this->input->post('supp_name');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/payment/d_supp');

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

		}
		public function hapus_supplier($id){
			date_default_timezone_set('Asia/Jakarta');
			$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Supplier';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

			if($this->m_payment->hapus_supplier($id)){
				$this->session->set_flashdata('success', 'Supplier <strong>Berhasil</strong> Dihapus!');
			redirect('user/payment/d_supp'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('user/payment/d_supp'); //redirect page
		}
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
			redirect('user/pembelian/list_permintaan'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('user/pembelian/list_permintaan'); //redirect page
		}
	}

public function getDataFromAPI3($page = 1)
{
	
  //  $url = 'http://example.com/api/data?page='.$page.'&limit='.$limit;
    $url = 'https://public.accurate.id/accurate/api/purchase-order/list.do?fields=number,id,charField1&access_token=2730bcda-e3a8-4f39-a4d0-00a0bd094d9b&session=0f1e7fef-91bb-44a1-a836-9fcec65c9129&sp.pageSize=20&sp.page='.$page.'&limit='.$limit;
    $response = file_get_contents($url);
    
    echo $response;
}

    
    public function view_api($page = 1) {
    
    		$limit = 5; // batasan data per halaman
    		$start = ($page - 1) * $limit; // hitung mulai dari data ke berapa
     		$url = 'https://public.accurate.id/accurate/api/purchase-order/list.do?fields=number,id,charField1&access_token=2730bcda-e3a8-4f39-a4d0-00a0bd094d9b&session=0f1e7fef-91bb-44a1-a836-9fcec65c9129&sp.page='.$page;
   			// $url = 'https://contohapi.com/data?start='.$start.'&limit='.$limit;
    		$response = file_get_contents($url);
    		$data_hasil = json_decode($response,true);

    			 $url = 'https://public.accurate.id/accurate/api/purchase-order/list.do?fields=number,id,charField1&access_token=2730bcda-e3a8-4f39-a4d0-00a0bd094d9b&session=0f1e7fef-91bb-44a1-a836-9fcec65c9129';
   			// $url = 'https://contohapi.com/count';
    $response = file_get_contents($url);
    $data_res = json_decode($response,true);
 		$count = count($data_res); // menghitung total baris data

        $start = ($page - 1) * $limit;
        $data['total_data'] = $count;
        $data['result'] = $data_hasil;
        $data['current_page'] = $page;
        $data['total_page'] = ceil($data['total_data'] / $limit);
        
       // $this->load->view('data_view', $data);
        $this->load->view('user/pembelian/v_api', $data);
    }


public function view_api5()
{
		$this->load->library('pagination');
    $config['base_url'] = base_url() . 'user/pembelian/getDataFromAPI';
    $config['total_rows'] = $this->getTotalRows(); // hitung total baris data dari API
    $config['per_page'] = 20; // batasan data per halaman
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 5;

    $this->pagination->initialize($config);

    $data['result'] = $this->getDataFromAPI();
 //  $this->load->view('user/pembelian/v_api', $this->data);
}



private function getTotalRows()
{
	 $url = 'https://public.accurate.id/accurate/api/purchase-order/list.do?fields=number,id,charField1&access_token=2730bcda-e3a8-4f39-a4d0-00a0bd094d9b&session=0f1e7fef-91bb-44a1-a836-9fcec65c9129';
   // $url = 'https://contohapi.com/count';
    $response = file_get_contents($url);
    $data_res = json_decode($response,true);
 		$count = count($data_res); // menghitung total baris data

    return $count;
}


	public function view_api3($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_pembelian->daftar_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$this->data['all_barang'] = $this->m_barang->lihat_stok(); //get data barang
		$this->data['all_unit'] = $this->m_barang->lihat_satuan(); //get data Satuan Unit
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	$dariDB = $this->m_pembelian->cekkode_purcahase_order();

	$nourut = substr($dariDB, 6, 5);
	$kodenikSekarang = $nourut + 1;
	$this->data['kode_nik']  = $kodenikSekarang ;

	$this->load->view('user/pembelian/v_api', $this->data);
}
	public function laporan_03($project = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();

		$this->data['all_pr'] = $this->m_pembelian->laporan_03($project); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_03_total_grand_report_sending($project);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_03?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/laporan03', $this->data);
	}
	public function laporan_02($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Permintaan Barang';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();
		$project = $this->input->post('project');
		$this->data['all_pr'] = $this->m_pembelian->laporan_01($id_lsp); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_report($id_lsp);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/laporan02', $this->data);
	}
	public function sub_laporan_furniture($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian Furniture';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();

		$project = $id_lsp;
		$jenis = "Furniture";
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_furniture($id_lsp,$jenis); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_furniture($id_lsp,$jenis);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_sub?filter=1&project='.$project.'&jenis='.$jenis;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/sub_laporan', $this->data);
	}
					public function export_excel_sub(){
       $this->data['title'] = "CASSA DESIGN";

    $id_lsp = $_GET['project'];
	 	$jenis = $_GET['jenis'];
	 	$ket = 'Laporan Pesanan Pembelian Dalam Pengiriman Proyek'. $id_lsp;

	 	$penerimaan =$this->data['penerimaan'] = $this->m_pembelian->laporan_01_furniture($id_lsp,$jenis);  //Lihat History Petty Cash

	// 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	// 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_furniture($id_lsp,$jenis);
  		$this->load->view('user/pembelian/laporan_sub', $this->data);
    }
	public function sub_laporan_me($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian ME';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();

		$project = $id_lsp;
		$jenis = "ME";
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_furniture($id_lsp,$jenis); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_furniture($id_lsp,$jenis);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_sub?filter=1&project='.$project.'&jenis='.$jenis;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/sub_laporan', $this->data);
	}
	public function sub_laporan_dll($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian DLL';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();

			$project = $id_lsp;
		$jenis = "DLL";
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_furniture($id_lsp,$jenis); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_furniture($id_lsp,$jenis);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_sub?filter=1&project='.$project.'&jenis='.$jenis;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/sub_laporan', $this->data);
	}

	public function sub_laporan_sipil($id_lsp = NULL){
		$this->data['aktif'] = 'pembelian';
		$this->data['title'] = 'Riwayat Pesanan Pembelian Sipil';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
	//	$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();
		$this->data['proyek'] = $this->m_pembelian->get_proyek();

		$project = $id_lsp;
		$jenis = "Sipil";
		$this->data['all_pr'] = $this->m_pembelian->laporan_01_furniture($id_lsp,$jenis); 
		$this->data['grand_total'] = $this->m_pembelian->laporan_01_total_grand_furniture($id_lsp,$jenis);

	//	$url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
		$url_cetak = 'pembelian/export_excel_sub?filter=1&project='.$project.'&jenis='.$jenis;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak);

		$this->load->view('user/pembelian/sub_laporan', $this->data);
	}
}
