<?php

use Dompdf\Dompdf;

class Penerimaan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'penerimaan';
		$this->load->model('M_barang', 'm_barang');
	//	$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_detail_terima', 'm_detail_terima');

		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('m_pembelian', 'm_pembelian');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_barang', 'm_barang');
	}
    
	public function index(){
		$this->data['title'] = 'Transaksi Penerimaan';
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat_penerimaan();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->load->view('user/penerimaan/lihat', $this->data);
	}

	public function update_tgl_penerimaan(){
			date_default_timezone_set('Asia/Jakarta');
		$id_hd = $this->input->post('url');
			//validasi jika status bukan stok  maka beri pesan berhasil simpan .

				
			$update_dt['id'] = $this->input->post('id');
			$update_dt['tgl_terima'] = $this->input->post('tgl_terima');
		

		$data_log['user'] = $this->session->login['nama'];
      	$data_log['waktu'] = date('Y-m-d H:i:s');
      	$data_log['ket'] = 'Update Tanggal Terima';
      	$data_log['kode'] = $this->input->post('id');
		
			$data_hs['action_by'] = $this->session->login['nama'];
			$data_hs['actiontime'] = date('Y-m-d H:i:s');
			$idnya = $this->input->post('id_dt');
			$data_hs['no_po'] = $this->input->post('no_po');
			$data_hs['status'] = 'Update Detail Barang id '.$idnya;
				$this->m_pembelian->save_update_pr_dt($update_dt); //simpan ke tabel pr dt	
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log 	
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('user/penerimaan/'.$id_hd);
 
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
		}
   
	public function data_penerimaan(){
		$this->data['title'] = 'Transaksi Penerimaan Barang';
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan_all();
		$this->data['no'] = 1;
        $id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
      	
		$this->load->view('user/penerimaan/lihat_all', $this->data);
	}
	public function laporan_penerimaan(){
		$this->data['title'] = 'Riwayat Penerimaan Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal'); 
		$this->data['no'] = 1;

		$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Barang Masuk

	 	$url_cetak = 'user/penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	
	 	$url_cetak_excel = 'user/penerimaan/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/penerimaan/riwayat_penerimaan', $this->data);

	}
	public function laporan_penerimaan02(){
		$this->data['title'] = 'Riwayat Penerimaan Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
	 	$supplier = $this->input->post('supplier');
		$this->data['no'] = 1;
		//$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();
		$this->data['all_supplier'] = $this->m_penerimaan->get_supplier(); 
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'user/penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/penerimaan/riwayat_penerimaan02', $this->data);

	}
	public function export_excel_01(){
       $this->data['title'] = "CASSA DESIGN";

     	$supplier = $_GET['supplier'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));

	 	$penerimaan =$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash

	 	$url_cetak = 'user/penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $penerimaan;

  		$this->load->view('user/penerimaan/report_excel', $this->data);
    }
		public function export_excel(){
       $this->data['title'] = "ALBA UNGGUL METAL";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_penerimaan->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Petty Cash


	 	$url_cetak = 'user/penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/penerimaan/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $absensi;

  		$this->load->view('user/penerimaan/report_excel', $this->data);
    }
	public function tambah(){ 
		$this->data['title'] = 'Transaksi Penerimaan Barang';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();

		$this->load->view('user/penerimaan/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_diterima = count($this->input->post('nama_barang_hidden'));

		$data_terima = [
			'no_terima' => $this->input->post('no_terima'),
			'tgl_terima' => $this->input->post('tgl_terima'),
			'jam_terima' => $this->input->post('jam_terima'),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'nama_petugas' => $this->input->post('nama_petugas'),
		];

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			array_push($data_detail_terima, ['no_terima' => $this->input->post('no_terima')]);
			$data_detail_terima[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_terima[$i]['min_jumlah'] = $this->input->post('min_jumlah_hidden')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_terima[$i]['zona'] = $this->input->post('zona_hidden')[$i];
			$data_detail_terima[$i]['lantai'] = $this->input->post('lantai_hidden')[$i];
			$data_detail_terima[$i]['blok'] = $this->input->post('blok_hidden')[$i];
			$data_detail_terima[$i]['ket_penerimaan'] = $this->input->post('ket_penerimaan_hidden')[$i];
		}
		
		if($this->m_penerimaan->tambah($data_terima) && $this->m_detail_terima->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
				$this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['nama_barang']) or die('gagal tambah stok');
				
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('user/penerimaan');
		}
	}}

	
	public function detail($no_terima){
		$this->data['title'] = 'Detail Penerimaan';
		//$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['no'] = 1;

		$this->load->view('user/penerimaan/detail', $this->data);
	}

	public function hapus($no_terima){
		if($this->m_penerimaan->hapus($no_terima) && $this->m_detail_terima->hapus($no_terima)){
			$this->session->set_flashdata('success', 'Invoice Penerimaan <strong>Berhasil</strong> Dihapus!');
			redirect('user/penerimaan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
			redirect('user/penerimaan');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('user/penerimaan/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
		$this->data['title'] = 'Laporan Data Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penerimaan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_terima){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['title'] = 'Laporan Detail Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penerimaan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}