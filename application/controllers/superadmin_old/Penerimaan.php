<?php

use Dompdf\Dompdf;

class Penerimaan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
if ($this->session->login['role'] == 'karyawan' OR $this->session->login['role'] == '') {
    $this->session->set_flashdata('error01', 'Sesi Berakhir, Login Kembali!');
    ?>
    <script>
        alert('Role "Karyawan" Dilarang Akses Halaman Admin');
        window.location.href = "<?php echo site_url('logout'); ?>";
    </script>
    <?php
}
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
	//	$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_detail_terima', 'm_detail_terima');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_izin', 'm_izin');
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
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('penerimaan/lihat', $this->data);
	}
	public function data_penerimaan(){
		$this->data['title'] = 'Transaksi Penerimaan';
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan_all();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('penerimaan/lihat01', $this->data);
	}
	public function laporan_penerimaan(){
		$this->data['title'] = 'Riwayat Penerimaan Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan($tanggal,$dan_tanggal); //tampilkan sop menu
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'penerimaan/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('penerimaan/riwayat_penerimaan', $this->data);

	}
	public function laporan_penerimaan02(){
		$this->data['title'] = 'Riwayat Penerimaan Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
	 	$supplier = $this->input->post('supplier');
		$this->data['no'] = 1;
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		//$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();
		$this->data['all_supplier'] = $this->m_penerimaan->get_supplier(); 
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('penerimaan/riwayat_penerimaan02', $this->data);

	}
	public function export_excel_01(){
       $this->data['title'] = "CASSA DESIGN";

     	$supplier = $_GET['supplier'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));

	 	$penerimaan =$this->data['penerimaan'] = $this->m_penerimaan->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash

	 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $penerimaan;

  		$this->load->view('penerimaan/report_excel', $this->data);
    }
		public function export_excel(){
       $this->data['title'] = "CASSA DESIGN";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_penerimaan->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Petty Cash


	 	$url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'penerimaan/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran'] = $absensi;

  		$this->load->view('penerimaan/report_excel', $this->data);
    }
	public function tambah(){
		$this->data['title'] = 'Transaksi Penerimaan Barang';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_barang01();
		$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('penerimaan/tambah', $this->data);
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
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_terima[$i]['harga_satuan'] = $this->input->post('hrg_brg_hidden')[$i];
			$data_detail_terima[$i]['harga_total'] = $this->input->post('jumlah_hidden')[$i] * $this->input->post('hrg_brg_hidden')[$i];
			$data_detail_terima[$i]['ket_penerimaan'] = $this->input->post('ket_penerimaan_hidden')[$i];
		}
		
		if($this->m_penerimaan->tambah($data_terima) && $this->m_detail_terima->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
				$this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['nama_barang']) or die('gagal min stok');
				$this->m_barang->update_harga($data_detail_terima[$i]['harga_satuan'], $data_detail_terima[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('penerimaan');
		}
	}

	public function detail($no_terima){
		$this->data['title'] = 'Detail Penerimaan';
		//$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->load->view('penerimaan/detail', $this->data);
	}

	public function hapus($no_terima){
		if($this->m_penerimaan->hapus($no_terima) && $this->m_detail_terima->hapus($no_terima)){
			$this->session->set_flashdata('success', 'Invoice Penerimaan <strong>Berhasil</strong> Dihapus!');
			redirect('penerimaan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
			redirect('penerimaan');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penerimaan/keranjang');
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