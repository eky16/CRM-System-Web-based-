<?php

use Dompdf\Dompdf;

class Penerimaan_mf extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'penerimaan_mf';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_mf', 'm_mf');
	//	$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_penerimaan_mf', 'm_penerimaan_mf');
		$this->load->model('M_detail_terima_mf', 'm_detail_terima_mf');

		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_payment', 'm_payment');
		//$this->load->model('M_pembelian', 'm_pembelian');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_barang', 'm_barang');
	}
    
	public function index(){
		$this->data['title'] = 'Transaksi Penerimaan';
		$this->data['all_penerimaan_mf'] = $this->m_penerimaan_mf->lihat_penerimaan();
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
      	$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		$this->load->view('user/penerimaan_mf/lihat', $this->data);
	}
	public function data_penerimaan_mf(){
		$this->data['title'] = 'Transaksi Penerimaan Komponen MF';
		$this->data['all_penerimaan_mf'] = $this->m_penerimaan_mf->lihat_history_penerimaan_all();
		$this->data['no'] = 1;

		$this->load->view('user/penerimaan_mf/lihat_all', $this->data);
	}
	public function laporan_penerimaan_mf(){
		$this->data['title'] = 'Riwayat Penerimaan Komponen MF';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal'); 
		$this->data['no'] = 1;

		$this->data['penerimaan_mf'] = $this->m_penerimaan_mf->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Barang Masuk
	 	$url_cetak = 'user/penerimaan_mf/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/penerimaan_mf/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/penerimaan_mf/riwayat_penerimaan', $this->data);

	}
	public function laporan_penerimaan02(){
		$this->data['title'] = 'Riwayat Penerimaan Komponen MF';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
	 	$supplier = $this->input->post('supplier');
		$this->data['no'] = 1;
		//$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();
		$this->data['all_supplier'] = $this->m_penerimaan_mf->get_supplier(); 
		$this->data['penerimaan_mf'] = $this->m_penerimaan_mf->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'user/penerimaan_mf/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/penerimaan_mf/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/penerimaan_mf/riwayat_penerimaan02', $this->data);

	}
	public function export_excel_01(){
       $this->data['title'] = "CASSA DESIGN";

     	$supplier = $_GET['supplier'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));

	 	$penerimaan_mf =$this->data['penerimaan_mf'] = $this->m_penerimaan_mf->lihat_history_penerimaan02($supplier,$tanggal,$dan_tanggal); //Lihat History Petty Cash

	 	$url_cetak = 'user/penerimaan_mf/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/penerimaan_mf/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran_mf'] = $penerimaan_mf;

  		$this->load->view('user/penerimaan_mf/report_excel', $this->data);
    }
		public function export_excel(){
       $this->data['title'] = "CASSA DESIGN";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Penerimaan Komponen MF Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_penerimaan_mf->lihat_history_penerimaan($tanggal,$dan_tanggal); //Lihat History Petty Cash


	 	$url_cetak = 'user/penerimaan_mf/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/penerimaan_mf/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['pembayaran_mf'] = $absensi;

  		$this->load->view('user/penerimaan_mf/report_excel', $this->data);
    }
	public function tambah(){ 
		$this->data['title'] = 'Transaksi Penerimaan Komponen MF';
		$this->data['all_komponen'] = $this->m_mf->lihat();
		$this->data['all_supplier'] = $this->m_barang->lihat_pemasok();

		$this->load->view('user/penerimaan_mf/tambah', $this->data);
	}

	public function proses_tambah_mf(){
    $jumlah_barang_diterima_mf = count($this->input->post('nama_barang_mf_hidden'));

    $data_terima_mf = [
        'no_terima' => $this->input->post('no_terima'),
        'tgl_terima' => $this->input->post('tgl_terima'),
        'jam_terima' => $this->input->post('jam_terima'),
        'nama_supplier' => $this->input->post('nama_supplier'),
        'nama_petugas' => $this->input->post('nama_petugas'),
    ];

    $data_detail_terima_mf = [];

    for($i = 0; $i < $jumlah_barang_diterima_mf; $i++){
         array_push($data_detail_terima_mf, [
            'no_terima_mf' => $this->input->post('no_terima'),
            'nama_barang_mf' => $this->input->post('nama_barang_mf_hidden')[$i],
            'jumlah_mf' => $this->input->post('jumlah_mf_hidden')[$i],
            'Satuan_mf' => $this->input->post('Satuan_mf_hidden')[$i],
            'ket_penerimaan_mf' => $this->input->post('ket_penerimaan_mf_hidden')[$i],
            'ttpas' => $this->input->post('ttpas_hidden')[$i],
            'ttpad' => $this->input->post('ttpad_hidden')[$i],
            'smpgs' => $this->input->post('smpgs_hidden')[$i],
            'smpgd' => $this->input->post('smpgd_hidden')[$i],
            'blkgs' => $this->input->post('blkgs_hidden')[$i],
            'blkgd' => $this->input->post('blkgd_hidden')[$i],
            'rack' => $this->input->post('rack_hidden')[$i],
            'box' => $this->input->post('box_hidden')[$i],
            'chss_stat' => $this->input->post('chss_stat_hidden')[$i],
            'chss_din' => $this->input->post('chss_din_hidden')[$i],
            'chs_d_din' => $this->input->post('chs_d_din_hidden')[$i],
            'ttpchs_s' => $this->input->post('ttpchs_s_hidden')[$i],
            'ttpchs_d' => $this->input->post('ttpchs_d_hidden')[$i],
            'cntls' => $this->input->post('cntls_hidden')[$i],
            'cntld' => $this->input->post('cntld_hidden')[$i],
            'pngmn' => $this->input->post('pngmn_hidden')[$i],
            'rell' => $this->input->post('rell_hidden')[$i],
            'samb_rell' => $this->input->post('samb_rell_hidden')[$i],

            
        ]);
            
        
    }
    if($this->m_penerimaan_mf->tambah($data_terima_mf) && $this->m_detail_terima_mf->tambah($data_detail_terima_mf)){
			for ($i=0; $i < $jumlah_barang_diterima_mf ; $i++) { 
				$this->m_mf->plus_stok_mf($data_detail_terima_mf[$i]['jumlah_mf'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok');



				
				$this->m_mf->plus_stok_mf_TTP_A_S($data_detail_terima_mf[$i]['ttpas'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A S');
				$this->m_mf->plus_stok_mf_TTP_A_D($data_detail_terima_mf[$i]['ttpad'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_SMPG_S($data_detail_terima_mf[$i]['smpgs'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_SMPG_D($data_detail_terima_mf[$i]['smpgd'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_BLKG_S($data_detail_terima_mf[$i]['blkgs'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_BLKG_D($data_detail_terima_mf[$i]['blkgd'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_RACK($data_detail_terima_mf[$i]['rack'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_BOX($data_detail_terima_mf[$i]['box'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_CHS_S_STAT($data_detail_terima_mf[$i]['chss_stat'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_CHS_S_DIN($data_detail_terima_mf[$i]['chss_din'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_CHS_D_DIN($data_detail_terima_mf[$i]['chs_d_din'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_TTP_CHS_S($data_detail_terima_mf[$i]['ttpchs_s'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_TTP_CHS_D($data_detail_terima_mf[$i]['ttpchs_d'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_CNTL_S($data_detail_terima_mf[$i]['cntls'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_CNTL_D($data_detail_terima_mf[$i]['cntld'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_PNGMN($data_detail_terima_mf[$i]['pngmn'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_RELL($data_detail_terima_mf[$i]['rell'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
				$this->m_mf->plus_stok_mf_SAMB_RELL($data_detail_terima_mf[$i]['samb_rell'], $data_detail_terima_mf[$i]['nama_barang_mf']) or die('gagal min stok TTP A D');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('user/penerimaan_mf');
		}
	}
    

	public function detail($no_terima_mf){
		$this->data['title'] = 'Detail Penerimaan Komponen MF';
		//$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['penerimaan_mf'] = $this->m_penerimaan_mf->lihat_no_terima($no_terima_mf);
		$this->data['all_detail_terima_mf'] = $this->m_detail_terima_mf->lihat_no_terima($no_terima_mf);
		$this->data['no'] = 1;

		$this->load->view('user/penerimaan_mf/detail', $this->data);
	}

	public function hapus($no_terima_mf){
		if($this->m_penerimaan_mf->hapus($no_terima_mf) && $this->m_detail_terima_mf->hapus($no_terima_mf)){
			$this->session->set_flashdata('success', 'Invoice Penerimaan <strong>Berhasil</strong> Dihapus!');
			redirect('user/penerimaan_mf');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
			redirect('user/penerimaan_mf');
		}
	}

	public function get_all_barang(){
		$data = $this->m_mf->lihat_nama_barang($_POST['Nama_mf']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('user/penerimaan_mf/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_penerimaan_mf'] = $this->m_penerimaan_mf->lihat();
		$this->data['title'] = 'Laporan Data Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penerimaan_mf/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_terima_mf){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penerimaan_mf'] = $this->m_penerimaan_mf->lihat_no_terima($no_terima_mf);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima_mf);
		$this->data['title'] = 'Laporan Detail Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penerimaan_mf/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}