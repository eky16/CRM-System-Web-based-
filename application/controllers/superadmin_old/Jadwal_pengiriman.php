<?php

use Dompdf\Dompdf;

class Jadwal_pengiriman extends CI_Controller{
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
		date_default_timezone_set('Asia/Jakarta');
		
	//	$this->load->model('M_barang', 'm_barang');
	//	$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
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
		$this->load->model('M_pengiriman', 'm_pengiriman');
	}
	public function index(){
		$this->data['aktif'] = 'schedul_kirim';
		$this->data['title'] = 'Jadwal Pengiriman Menunggu Persetujuan';
		$this->data['no'] = 1;

		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$filter_tgl = $this->input->post('tanggal');

		if(empty($filter_tgl)){
		$this->data['request_pengiriman'] = $this->m_pengiriman->lihat();		
		}
		if(!empty($filter_tgl)){
		$this->data['request_pengiriman'] = $this->m_pengiriman->lihat_filterdate($filter_tgl);	
		}
		

		$this->load->view('jadwal_pengiriman/lihat', $this->data);
	}
	public function tambah(){
		$this->data['aktif'] = 'schedul_kirim';
		$this->data['title'] = 'Tambah Jadwal';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_barang();
		//$this->data['all_customer'] = $this->m_leads->lihat_cst();
		$this->data['proyek'] = $this->m_pembelian->daftar_project2();

		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->load->view('jadwal_pengiriman/tambah', $this->data);
	}
	public function disetujui(){
		$this->data['aktif'] = 'schedul_kirim';
		$this->data['title'] = 'Jadwal Pengiriman Disetujui';
		$this->data['no'] = 1;

		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$filter_tgl = $this->input->post('tanggal');

		if(empty($filter_tgl)){
		$this->data['request_pengiriman'] = $this->m_pengiriman->lihat_disetujui();		
		}
		if(!empty($filter_tgl)){
		$this->data['request_pengiriman'] = $this->m_pengiriman->lihat_filterdate($filter_tgl);	
		}
		

		$this->load->view('jadwal_pengiriman/lihat', $this->data);
	}
		public function schedule_calendar(){
		$this->data['title'] = 'Kalender Pengiriman';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_barang();
		//$this->data['all_customer'] = $this->m_leads->lihat_cst();
		$this->data['proyek'] = $this->m_pembelian->daftar_project2();

		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->load->view('jadwal_pengiriman/sch_calendar', $this->data);
	}
	public function ditolak(){
		$this->data['aktif'] = 'schedul_kirim';
		$this->data['title'] = 'Jadwal Pengiriman Ditolak';
		$this->data['no'] = 1;

		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->data['request_pengiriman'] = $this->m_pengiriman->lihat_ditolak();		
	
		

		$this->load->view('jadwal_pengiriman/lihat_tolak', $this->data);
	}
	public function detail_pengiriman($id_pengiriman){
		$this->data['title'] = 'Detail Schedul';
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
		$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['proyek'] = $this->m_pembelian->daftar_project2();
		$this->data['pengiriman_hd'] = $this->m_pengiriman->lihat_detail_pengiriman($id_pengiriman);
		$this->data['pengiriman_dt'] = $this->m_pengiriman->lihat_detail_pengiriman_log($id_pengiriman);
		$this->load->view('user/jadwal_pengiriman/detail_pengiriman', $this->data);
	}
    public function update_detail_pengiriman($id = NULL) { 
	  //	    echo '<pre>';
       //    print_r ($_POST);
      //   echo '</pre>';
       // exit;
    	date_default_timezone_set('Asia/Jakarta');
	$link = $this->input->post('id_pengiriman');
	$atdnc_data['id_pengiriman'] = $this->input->post('id_pengiriman');
	$atdnc_data['tgl_pengiriman'] = $this->input->post('tgl_pengiriman');
    	$atdnc_data['waktu_pengiriman'] = $this->input->post('waktu_pengiriman'); 
    	$atdnc_data['status_pengiriman'] = $this->input->post('status_pengiriman'); 
    	$atdnc_data['ket_pengiriman'] = $this->input->post('ket_pengiriman');
    	$atdnc_data['project_id'] = $this->input->post('project_id');
    	$this->m_pengiriman->update_pengiriman($atdnc_data);


	$data['id_pengiriman_log'] = $this->input->post('id_pengiriman');
    	$data['project_id'] = $this->input->post('project_id_old');
    	$data['tgl_pengiriman'] = $this->input->post('tgl_old');
    	$data['waktu_pengiriman'] = $this->input->post('time_old');
    	$data['ket_pengiriman'] = $this->input->post('ket_pengiriman_old');
    	$data['update_by'] = $this->session->login['nama'];
    	$data['update_at'] = date('Y-m-d H:i:s');

    	$this->m_pengiriman->tambah_log_pengiriman($data); 	//untuk tabel material log


	$data_log['user'] = $this->session->login['nama'];
	$data_log['waktu'] = date('Y-m-d H:i:s');
	$keterangan =  'Ubah Jadwal Pengiriman';
	$data_log['ket'] = $keterangan .' -'. $this->input->post('project_id');
	$data_log['kode'] = $this->input->post('project_id');
	$this->m_mom->tambah_log($data_log); //simpan ke tabel log

    	

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
        redirect('jadwal_pengiriman/detail_pengiriman/'.$link); //redirect page
    }
     public function save_apprv($id = NULL) { 
        $link = $this->input->post('id_apprv');
      date_default_timezone_set('Asia/Jakarta');
	$atdnc_data['id_pengiriman'] = $this->input->post('id_apprv');
    	$atdnc_data['status_pengiriman'] = $this->input->post('status_pengiriman'); 
    	$atdnc_data['apprv_by'] = $this->session->login['nama'];
    	$atdnc_data['apprv_time'] = date('Y-m-d H:i:s');

    	$this->m_pengiriman->update_pengiriman($atdnc_data); 
			//untuk log

			$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Apprv Jadwal Pengiriman';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_apprv');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Jadwal Pengiriman <strong>Berhasil</strong> Diubah!');
        redirect('jadwal_pengiriman'); //redirect page
    }
	public function export_excel_stok(){  
           $this->data = array( 'title' => 'LAPORAN STOK TERSEDIA',
                'all_barang' => $this->m_barang->lihat());

        		$this->load->view('user/barang/laporan_stok_excel', $this->data); 
    	}

	public function laporan_pengeluaran(){ 
		$this->data['title'] = 'Riwayat Pengeluaran Barang';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		//s$this->data['isi'] = $this->m_sop->lihat_02(); //tampilkan sop menu
		$tanggal = $this->input->post('tanggal');
	 	$dan_tanggal = $this->input->post('dan_tanggal');
		$this->data['penerimaan'] = $this->m_pengeluaran->lihat_history_pengeluaran($tanggal,$dan_tanggal); //tampilkan sop menu 
		$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran_total($tanggal,$dan_tanggal); //tampilkan sop menu
		$this->data['no'] = 1;

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak'] = base_url($url_cetak);
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$this->data['url_cetak_excel'] = base_url($url_cetak_excel);

		$this->load->view('user/pengeluaran/riwayat_pengeluaran', $this->data);

	}


	public function export_excel_pengeluaran(){
       	$this->data['title'] = "CASSA DESIGN";

     	$jenis_pety_cash = $_GET['jenis_pety_cash'];
	 	$tanggal = $_GET['tanggal'];
	 	$dan_tanggal = $_GET['dan_tanggal'];
	 
	 	$ket = 'Pengeluaran Barang Tanggal '.date('Ymd', strtotime($tanggal)).' Sd Tanggal '.date('Ymd', strtotime($dan_tanggal));
	 	$absensi =$this->data['petty_cash_riwayat'] = $this->m_pengeluaran->lihat_history_pengeluaran($tanggal,$dan_tanggal); //Lihat History Petty Cash
	 	$this->data['grand_total'] = $this->m_pengeluaran->lihat_history_pengeluaran_total($tanggal,$dan_tanggal); //tampilkan sop menu

	 	$url_cetak = 'user/barang/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	$url_cetak_excel = 'user/barang/export_excel_pengeluaran?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
	 	
        	$this->data['ket'] = $ket;
        	$this->data['url_cetak'] = base_url($url_cetak);
        	$this->data['pembayaran'] = $absensi;

  		$this->load->view('user/pengeluaran/report_excel', $this->data);
    }


	public function proses_tambah(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));

		$data_keluar = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'nama_customer' => $this->input->post('nama_customer'),
			'nama_petugas' => $this->input->post('nama_petugas'),
		];

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_keluar[$i]['harga_satuan_k'] = $this->input->post('harga_satuan_k_hidden')[$i];
			$data_detail_keluar[$i]['harga_total_k'] = $this->input->post('harga_satuan_k_hidden')[$i] * $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['ket_keluar'] = $this->input->post('ket_pengeluaran_hidden')[$i];
		}

		if($this->m_pengeluaran->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('user/barang/list_pengeluaran');
		}
	}

	public function pengeluaran_detail($no_keluar){ 
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['count_all_detail_keluar'] = $this->m_detail_keluar->count_detail_id($no_keluar);
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$dariDB_csa = $this->m_pembelian->cekkode_purcahase_order_CSA();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/pengeluaran/detail', $this->data);
	}

	public function hapus($id_pengiriman){
		if($this->m_pengiriman->hapus($id_pengiriman) && $this->m_pengiriman->hapus_log($id_pengiriman)){
			$this->session->set_flashdata('success', 'Jadwal Pengiriman <strong>Berhasil</strong> Dihapus!');
			redirect('jadwal_pengiriman');
		} else {
			$this->session->set_flashdata('error', 'Jadwal Pengiriman <strong>Gagal</strong> Dihapus!');
			redirect('jadwal_pengiriman');
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

		public function ubah($kode_barang){

		$this->data['title'] = 'Ubah Barang';
		
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$dariDB_csa = $this->m_pembelian->cekkode_purcahase_order_CSA();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);
		$this->data['satuan_name'] = $this->m_barang->lihat_satuann();

		$this->load->view('user/barang/ubah', $this->data);
		}

	public function proses_ubah($kode_barang){

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'stok' => $this->input->post('stok'),
			'hrg_brg' => $this->input->post('hrg_brg'),
			'satuan' => $this->input->post('satuan'),
		];

		if($this->m_barang->ubah($data, $kode_barang)){
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
	public function tambah_stok(){

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$dariDB_csa = $this->m_pembelian->cekkode_purcahase_order_CSA();
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['satuan_name'] = $this->m_barang->lihat_satuann();
		$this->data['kategori_name'] = $this->m_barang->lihat_kategori();
		$this->data['title'] = 'Tambah Barang';

		$this->load->view('user/barang/tambah', $this->data);
	}
	public function proses_tambah_jadwal(){
      date_default_timezone_set('Asia/Jakarta');

		$data = [
			'id_pengiriman' => $this->input->post('id_pengiriman'),
			'project_id' => $this->input->post('project_id'),
			'tgl_pengiriman' => $this->input->post('tgl_pengiriman'),
			'waktu_pengiriman' => $this->input->post('waktu_pengiriman'),
			'ket_pengiriman' => $this->input->post('ket_pengiriman'),
			'status_pengiriman' => 1,
			'creat_by' => $this->session->login['nama'],
			'creat_at' => date('Y-m-d H:i:s'),
		];

		if($this->m_pengiriman->tambah($data)){
			$this->session->set_flashdata('success', 'Jadwal Pengiriman <strong>Berhasil</strong> Ditambahkan!');
			redirect('jadwal_pengiriman');
		} else {
			$this->session->set_flashdata('error', 'Jadwal Pengiriman <strong>Gagal</strong> Ditambahkan!');
			redirect('jadwal_pengiriman');
		}
	}


}