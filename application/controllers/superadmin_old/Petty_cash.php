<?php

use Dompdf\Dompdf;

class Petty_cash extends CI_Controller{
	public function __construct(){
		parent::__construct();
if ($this->session->login['role'] == 'karyawan' OR $this->session->login['role'] == '') {
    $this->session->set_flashdata('error01', 'Sesi Berakhir, Login Kembali!');
    ?>
    <script>
        alert('Role "Karyawan" Dilarang Akses Halaman Admin');
        window.location.href = "<?php echo site_url('logout'); ?>";
    </script>
    <?php
}
		$this->data['aktif'] = 'petty_cash';
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_asset', 'm_asset');
		$this->load->model('M_petty_cash', 'm_petty_cash');
		$this->load->model('M_sop', 'm_sop');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
	}

	public function index(){
		$this->data['title'] = 'Saldo Petty Cash';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id_saldo = 'Petty Cash';
	 	$this->data['petty_cash'] = $this->m_petty_cash->lihat_saldo($id_saldo); //Lihat Saldo Petty Cash
	 	$jenis_tampil= 'Isi Saldo';
	 	$this->data['petty_cash_top_up'] = $this->m_petty_cash->lihat_history_topup($jenis_tampil); //Lihat History topup Petty Cash
	 	$jenis_tampil2= 'Saldo Keluar'; 
	 	$this->data['petty_cash_out'] = $this->m_petty_cash->lihat_history_pettycash_out($jenis_tampil2); //Lihat History topup Petty Cash 
	 	$this->data['isi'] = $this->m_sop->lihat_01(); //tampilkan sop menu	
		$this->load->view('petty_cash/lihat_saldo', $this->data);
	}
	public function riwayat(){
		$this->data['title'] = 'Riwayat Petty Cash';
		$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$id_saldo = 'Petty Cash';
	 	$this->data['petty_cash'] = $this->m_petty_cash->lihat_saldo($id_saldo); //Lihat Saldo Petty Cash
	 	$Isi_Saldo = 'Isi Saldo';
	 	$this->data['sum_isi_ulang'] = $this->m_petty_cash->lihat_saldo_isi_ulang($Isi_Saldo); //Lihat Saldo ISI uLANG
	 	$Saldo_Keluar = 'Saldo Keluar';
	 	$this->data['sum_saldo_keluar'] = $this->m_petty_cash->lihat_saldo_keluar($Saldo_Keluar); //Lihat Saldo Petty Cash

	 	$filter = $this->input->post('jenis_pety_cash');
	 	$jenis_pety_cash = $this->input->post('jenis_pety_cash');
	 	$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');

	 	if ($filter =='Saldo Keluar' OR $filter =='Isi Saldo'){
	 	$this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_count($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'petty_cash/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'petty_cash/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
	 	}

	 	if ($filter =='SEMUA TRANSAKSI'){
	 	$this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all_count($filter,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$url_cetak = 'petty_cash/export2?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'petty_cash/export_excel2?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

	 	}
	 	if ($filter =='' ){
	 	$this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash(); //Lihat History Petty Cash

	 	}

		$this->load->view('petty_cash/semua_riwayat', $this->data);

	}
		public function export1(){ 
       $this->data['title'] = "CASSA DESIGN";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Petty Cash '.$jenis_pety_cash.' Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count =$this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_count($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count_kredit = $this->data['petty_cash_riwayat_count_kredit'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_count_kredit1($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cas Kredit
	 	$url_cetak = 'petty_cash/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
		$this->data['count_kredit'] = $count_kredit;
        $this->load->library('pdf2'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('petty_cash/report_pdf', $this->data, true);
        $this->pdf2->create($html,$ket);
    }
		public function export_excel(){
       $this->data['title'] = "CASSA DESIGN";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Petty Cash '.$jenis_pety_cash.' Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count =$this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_count($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count_kredit = $this->data['petty_cash_riwayat_count_kredit'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_count_kredit1($jenis_pety_cash,$tanggal,$dan_tanggal); //Lihat History Petty Cas Kredit
	 	$url_cetak = 'petty_cash/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	$url_cetak_excel = 'petty_cash/export_excel?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
		$this->data['count_kredit'] = $count_kredit;
  		$this->load->view('petty_cash/report_excel', $this->data);
    }
		public function export2(){
       $this->data['title'] = "CASSA DESIGN";

     	$judul = 'Semua Transaksi';
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 	$ket = 'Petty Cash '.$judul.' Tanggal '.date('Y-m-d', strtotime($tanggal)).' Sd Tanggal '.date('Y-m-d', strtotime($dan_tanggal));
	 	$absensi = $this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count = $this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all_count($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count_kredit = $this->data['petty_cash_riwayat_count_kredit'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all_count_kredit($tanggal,$dan_tanggal); //Lihat History Petty Cas Kredit
       	$url_cetak = 'petty_cash/export?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
		$this->data['count_kredit'] = $count_kredit;
        $this->load->library('pdf2'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('petty_cash/report_pdf_all', $this->data, true);
        $this->pdf2->create($html,$ket);
    }
		public function export_excel2(){
       $this->data['title'] = "CASSA DESIGN";

     	$judul = 'Semua Transaksi';
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 	$ket = 'Petty Cash '.$judul.' Tanggal '.date('Y-m-d', strtotime($tanggal)).' Sd Tanggal '.date('Y-m-d', strtotime($dan_tanggal));
	 	$absensi = $this->data['petty_cash_riwayat'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count = $this->data['petty_cash_riwayat_count'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all_count($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$count_kredit = $this->data['petty_cash_riwayat_count_kredit'] = $this->m_petty_cash->lihat_history_all_pettycash_filter_all_count_kredit($tanggal,$dan_tanggal); //Lihat History Petty Cas Kredit
	 	$url_cetak = 'petty_cash/export?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'petty_cash/export_excel2?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&jenis_pety_cash='.$jenis_pety_cash;
	 	
        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
		$this->data['count_kredit'] = $count_kredit;
  		$this->load->view('petty_cash/report_excel_all', $this->data);
    }
		public function save_topup(){
			date_default_timezone_set('Asia/Jakarta');
   //echo '<pre>';
    //    print_r ($_POST);
     //   echo '</pre>';
     //   exit;
			$atdnc_dat['jenis'] = $this->input->post('jenis');
			$atdnc_dat['saldo'] = $this->input->post('hasil_topup');
			$atdnc_dat['saldo_updateby'] = $this->session->login['nama'];
			$atdnc_dat['saldo_UpTime'] = date('Y-m-d H:i:s');
			$this->m_petty_cash->save_topup($atdnc_dat); //simpan ke tbl_petty_cash

			$atdnc_dataa['jenis_pety_cash'] = 'Isi Saldo'; 
			$atdnc_dataa['nominal_petty_cash'] = $this->input->post('nominal_petty_cash');
			$atdnc_dataa['kode_topup'] = $this->input->post('kode_topup');
			$atdnc_dataa['saldo_before'] = $this->input->post('saldo_before');
			$atdnc_dataa['created_log_petty_cash'] = $this->session->login['nama'];
			$atdnc_dataa['tgl_log_petty_cash'] = date('Y-m-d H:i:s');
			$atdnc_dataa['tgl_transaksi_petty'] = $this->input->post('tgl_transaksi_petty');
			$atdnc_dataa['tgl_prosess'] = $this->input->post('tgl_transaksi_petty');
			$this->m_petty_cash->save_topup_log($atdnc_dataa); //simpan ke topup tbl_petty_cash_in_out

			$petty_data['noted_pety_cash'] = 'Isi Saldo'; 
			$petty_data['nominal_pembayaran'] = $this->input->post('nominal_petty_cash');
			$petty_data['kode_pembayaran'] = $this->input->post('kode_topup');
			$petty_data['creat_by_pety_cash'] = $this->session->login['nama'];
			$petty_data['date_petty_cash'] = date('Y-m-d H:i:s');
			$this->m_petty_cash->save_topup_all_log($petty_data); //simpan ke semua riwayat tbl_petty_cash_list


      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Isi Saldo';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('jenis');

			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Isi Ulang Saldo <strong>Gagal</strong> Diproses!');
			$this->session->set_flashdata('success', 'Isi Ulang Saldo <strong>Berhasil</strong> Diproses!');
			redirect('petty_cash');
	

	}
 		public function save_transaksi_pety(){
			date_default_timezone_set('Asia/Jakarta');
   //echo '<pre>';
    //    print_r ($_POST);
     //   echo '</pre>';
     //   exit;
			$atdnc_dat['jenis'] = $this->input->post('jenis');
			$atdnc_dat['saldo'] = $this->input->post('hasil_topup');
			$atdnc_dat['saldo_updateby'] = $this->session->login['nama'];
			$atdnc_dat['saldo_UpTime'] = date('Y-m-d H:i:s');
			$this->m_petty_cash->save_topup($atdnc_dat); //simpan ke tbl_petty_cash

			$atdnc_dataa['jenis_pety_cash'] = 'Saldo Keluar'; 
			$atdnc_dataa['nominal_petty_cash'] = $this->input->post('nominal_petty_cash');
			$atdnc_dataa['kode_topup'] = $this->input->post('kode_topup');
			$atdnc_dataa['saldo_before'] = $this->input->post('saldo_before');
			$atdnc_dataa['created_log_petty_cash'] = $this->session->login['nama'];
			$atdnc_dataa['tgl_log_petty_cash'] = date('Y-m-d H:i:s');
			$petty_data['date_petty_cash'] = date('Y-m-d H:i:s');
			$this->m_petty_cash->save_topup_log($atdnc_dataa); //simpan ke topup tbl_petty_cash_in_out

			$petty_data['noted_pety_cash'] = $this->input->post('ket_saldo_keluar');
			$petty_data['nominal_pembayaran'] = $this->input->post('nominal_petty_cash');
			$petty_data['kode_pembayaran'] = $this->input->post('kode_topup');
			$petty_data['creat_by_pety_cash'] = $this->session->login['nama'];
			$petty_data['date_petty_cash'] = date('Y-m-d H:i:s');
			$this->m_petty_cash->save_topup_all_log($petty_data); //simpan ke semua riwayat tbl_petty_cash_list


      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Saldo Keluar';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('jenis');

			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Isi Ulang Saldo <strong>Gagal</strong> Diproses!');
			$this->session->set_flashdata('success', 'Isi Ulang Saldo <strong>Berhasil</strong> Diproses!');
			redirect('petty_cash');
	

	}

	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_kerja->hapus($id) AND $this->m_kerja->hapus_sub($id)){
			$this->m_kerja->hapus_kontributor($id);
			$this->m_kerja->hapus_chat($id);
			$this->session->set_flashdata('success', 'Modul Kerja <strong>Berhasil</strong> Dihapus!');
			redirect('user/mod_kerja/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Modul Kerja  <strong>Gagal</strong> Dihapus!');
			redirect('user/mod_kerja/lihat_semua');
		}
	}


}