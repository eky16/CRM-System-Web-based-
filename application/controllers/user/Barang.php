<?php

use Dompdf\Dompdf;

class Barang extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'barang';
	//	$this->load->model('M_barang', 'm_barang');
	//	$this->load->model('M_customer', 'm_customer');
		
		$this->load->model('M_penerimaan', 'm_penerimaan');
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
	}
	public function index(){
		$this->data['title'] = 'Product';
		$this->data['all_barang'] = $this->m_barang->lihat_stok();
		

		$this->data['no'] = 1;

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
         
		$this->load->view('user/barang/lihat', $this->data);
	}
     


     public function list_barang_aging() {
          $this->data['title'] = 'Barang Aging';

          $this->data['all_pr'] = $this->m_barang->get_barang_aging();
    
    // Debug: periksa hasil query
    //echo "<pre>";
    //print_r($this->data['all_pr']);
    //echo "</pre>";

          $this->data['no'] = 1;
          $id = $this->session->login['kode'];
          $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

          $this->load->view('user/barang_aging/lihat', $this->data);
     }

     public function update_barang_aging() {
        $data = $this->input->post('data');
        $this->m_barang->update_barang_aging($data);
        $this->session->set_flashdata('success', 'Data barang aging berhasil diperbarui');
        redirect('user/barang_aging');
    }

	public function export_excel_stok(){   
           $this->data = array( 'title' => 'LAPORAN STOK TERSEDIA',
                'all_barang' => $this->m_barang->lihat());

        		$this->load->view('user/barang/laporan_stok_excel', $this->data); 
    	}

    

    	public function mf_stok(){ 
		$this->data['title'] = 'MF Stok';
		$this->data['all_pr'] = $this->m_barang->hitung_in_barang();
		$this->data['out_barang'] = $this->m_barang->hitung_out_barang();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/mf_stok/lihat', $this->data);
	}

     public function list_riwayat_stok2(){ 
		$this->data['title'] = 'Riwayat Stok';
		$this->data['all_pr'] = $this->m_barang->hitung_in_barang();
		$this->data['out_barang'] = $this->m_barang->hitung_out_barang();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/riwayat_stok_2/lihat', $this->data);
	}


    	public function list_riwayat_stok(){ 
		$this->data['title'] = 'Riwayat Stok';
		$this->data['all_pr'] = $this->m_barang->hitung_in_barang();
		$this->data['out_barang'] = $this->m_barang->hitung_out_barang();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/riwayat_stok/lihat', $this->data);
	}

     public function item_selesai_forecast(){ 
		$this->data['title'] = 'Riwayat Forecast->Stok';
		$this->data['all_pr'] = $this->m_barang->lihat_list_forecastto_stok();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/forecast_stok/lihat', $this->data);
	}
	
	public function list_pengeluaran_all(){ 
		$this->data['title'] = 'Transaksi Pengeluaran';
		$this->data['customer'] = $this->m_customer->lihat();
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran_all();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/pengeluaran/lihat01', $this->data);
	}
	public function list_pengeluaran(){
		$this->data['title'] = 'Transaksi Pengeluaran';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['no'] = 1;

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->load->view('user/pengeluaran/lihat', $this->data);
	}
	
	public function laporan_pengeluaran(){ 
		$this->data['title'] = 'Riwayat Pengeluaran Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
		$this->data['penerimaan'] = $this->m_pengeluaran->lihat_history_pengeluaran($tanggal,$dan_tanggal); //tampilkan sop menu 
		$this->data['no'] = 1;

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal; 
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/pengeluaran/riwayat_pengeluaran', $this->data);

	}


	public function laporan_pengeluaran02(){
		$this->data['title'] = 'Riwayat Pengeluaran Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$project = $this->input->post('project');
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');

		$this->data['no'] = 1;
		$this->data['proyek'] = $this->m_pengeluaran->get_proyek();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran02($project,$tanggal,$dan_tanggal); //Lihat History Petty Cash
		$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran02_grand_total($project,$tanggal,$dan_tanggal); //tampilkan sop menu
	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran02?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/pengeluaran/riwayat_pengeluaran02', $this->data);

	}
	public function laporan_pengeluaran03(){
		$this->data['title'] = 'Riwayat Pengeluaran Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$project = $this->input->post('project');
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');

		$this->data['no'] = 1;
		$this->data['proyek'] = $this->m_pengeluaran->get_proyek();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran03($project); //Lihat History Petty Cash
		$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran03_grand_total($project); //tampilkan sop menu
	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran03?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/pengeluaran/riwayat_pengeluaran03', $this->data);

	}
	public function export_excel_pengeluaran03(){
       	$this->data['title'] = "CASSA DESIGN";

     	$project = $_GET['project'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Laporan Pengeluaran Barang ';
	 	$pengeluaran =$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran03($project); //Lihat History Petty Cash
	 	$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran03_grand_total($project); //tampilkan sop menu

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran04?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&project='.$project;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $pengeluaran;

  		$this->load->view('user/pengeluaran/report_excel_total02', $this->data);
    }
	public function laporan_pengeluaran04(){
		$this->data['title'] = 'Riwayat Pengeluaran Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$project = $this->input->post('project');
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');

		$this->data['no'] = 1;
		$this->data['proyek'] = $this->m_pengeluaran->get_proyek();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran04($project,$tanggal,$dan_tanggal); //Lihat History Petty Cash
		$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran04_grand_total($project,$tanggal,$dan_tanggal); //tampilkan sop menu
	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran04?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/pengeluaran/riwayat_pengeluaran04', $this->data);

	}
	public function export_excel_pengeluaran04(){
       	$this->data['title'] = "CASSA DESIGN";

     	$project = $_GET['project'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Pengeluaran Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$pengeluaran =$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran04($project,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran04_grand_total($project,$tanggal,$dan_tanggal); //tampilkan sop menu

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran04?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&project='.$project;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $pengeluaran;

  		$this->load->view('user/pengeluaran/report_excel_total01', $this->data);
    }
		public function export_excel_pengeluaran02(){
       	$this->data['title'] = "CASSA DESIGN";

     	$project = $_GET['project'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Pengeluaran Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$pengeluaran =$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran02($project,$tanggal,$dan_tanggal); //Lihat History Petty Cash


	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran02?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&project='.$project;
	 	$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran02_grand_total($project,$tanggal,$dan_tanggal); //tampilkan sop menu
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $pengeluaran;

  		$this->load->view('user/pengeluaran/report_excel', $this->data);
    }
	public function export_excel_pengeluaran(){
       	$this->data['title'] = "CASSA DESIGN";

	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Pengeluaran Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_pengeluaran->lihat_history_pengeluaran($tanggal,$dan_tanggal); //Lihat History Petty Cash

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $absensi;

  		$this->load->view('user/pengeluaran/report_excel', $this->data);
    }
	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';

		$this->data['all_barang'] = $this->m_barang->lihat_stok_barang();
		$this->data['customer'] = $this->m_customer->lihat();
		//$this->data['all_customer'] = $this->m_leads->lihat_cst();

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){

		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));
          $nama_customer = $this->input->post('nama_customer');

		$data_keluar = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'nama_customer' => $this->input->post('nama_customer'),
			'nama_petugas' => $this->input->post('nama_petugas'),
		];

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			array_push($data_detail_keluar, 
			['no_keluar' => $this->input->post('no_keluar'),
		      'nama_customer' => $this->input->post('nama_customer'),]);
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_keluar[$i]['ket_keluar'] = $this->input->post('ket_pengeluaran_hidden')[$i];
			
		}

		if($this->m_pengeluaran->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('user/barang/tambah');
		}
	}


public function riwayat_stok_detail(){ 
		$this->data['title'] = 'Riwayat Stok';
		$this->data['all_pr'] = $this->m_barang->hitung_in_barang();
		$this->data['out_barang'] = $this->m_barang->hitung_out_barang();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		$this->load->view('user/riwayat_stok_2/detail', $this->data);
	}

	public function pengeluaran_detail($no_keluar){ 
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['count_all_detail_keluar'] = $this->m_detail_keluar->count_detail_id($no_keluar);
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->load->view('user/pengeluaran/detail', $this->data);
	}

	public function hapus($no_keluar){
		if($this->m_pengeluaran->hapus($no_keluar) && $this->m_detail_keluar->hapus($no_keluar)){
			$this->session->set_flashdata('success', 'Invoice Pengeluaran <strong>Berhasil</strong> Dihapus!');
			redirect('user/barang/list_pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Invoice Pengeluaran <strong>Gagal</strong> Dihapus!');
			redirect('user/barang/list_pengeluaran');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('user/pengeluaran/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['title'] = 'Laporan Data Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_keluar){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['title'] = 'Laporan Detail Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

		public function ubah($No){

		$this->data['title'] = 'Ubah Barang';
		
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->data['barang'] = $this->m_barang->lihat_id($No);
		
		$this->load->view('user/barang/ubah', $this->data);
		}

	public function proses_ubah($No){

		$data = [
			'No' => $this->input->post('No'),
			'Kode_Barang' => $this->input->post('Kode_Barang'),
			'Nama_Barang' => $this->input->post('Nama_Barang'),
			'Kategori_Barang' => $this->input->post('Kategori_Barang'),
			'Warna_barang' => $this->input->post('Warna_barang'),
			'Satuan' => $this->input->post('Satuan'),
			'Stok' => $this->input->post('Stok'),
			'Min' => $this->input->post('Min'),
			'Max' => $this->input->post('Max'),
			'Blok' => $this->input->post('Blok'),
			'Lantai' => $this->input->post('Lantai'),
			'Zona' => $this->input->post('Zona'),
			'nol_tigabulan_qty' => $this->input->post('nol_tigabulan_qty'),
			'tiga_enambulan_qty' => $this->input->post('tiga_enambulan_qty'),
			'over_6bulan_qty' => $this->input->post('over_6bulan_qty'),
			'ket_stok' => $this->input->post('ket_stok'),
			'Type_Barang' => $this->input->post('Type_Barang'),
			'merk_barang' => $this->input->post('merk_barang'),
			
		];

		if($this->m_barang->ubah($data, $No)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('user/barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('user/barang');
		}
	}

	public function hapus_stok($kode_barang){
	
		if($this->m_barang->hapus($kode_barang)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('user/barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('user/barang');
		}
	}
	public function tambah_stok_mf(){

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['satuan_name'] = $this->m_barang->lihat_satuann();
		
		$this->data['title'] = 'Tambah Barang';

		$this->load->view('user/mf_stok/tambah', $this->data);
	}

	public function tambah_stok(){

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['satuan_name'] = $this->m_barang->lihat_satuann();
		
		$this->data['title'] = 'Tambah Barang';

		$this->load->view('user/barang/tambah', $this->data);
	}
	public function proses_tambah_barang(){

		$data = [

			'kode_product' => $this->input->post('kode_product'),
			'kategori' => $this->input->post('kategori'),
			'item' => $this->input->post('item'),
			

		];

		if($this->m_barang->tambah($data)){
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			redirect('user/barang');
		}
	}

	public function laporan_pengeluaran002($project = null){
		$this->data['title'] = 'Riwayat Pengeluaran Barang';

		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_history_pengeluaran002($project); //Lihat History Petty Cash
		$this->data['grand_total_barang'] = $this->m_pengeluaran->total_pengaluaran_biaya002($project);
	 	//$url_cetak = 'barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	//$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'barang/export_excel_pengeluaran02?filter=1&project='.$project;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		//$this->data['all_customer'] = $this->m_leads->lihat_cst();
		$this->data['proyek'] = $this->m_pembelian->daftar_project();

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$dariDB_csa = $this->m_pembelian->cekkode_purcahase_order_CSA();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$this->load->view('user/pengeluaran/riwayat_pengeluaran002', $this->data);
	}
}