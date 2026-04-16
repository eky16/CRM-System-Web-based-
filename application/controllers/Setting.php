<?php

use Dompdf\Dompdf;

class Setting extends CI_Controller{
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
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_setting', 'm_setting');
		$this->load->model('M_admin', 'm_admin');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		
		$this->data['aktif'] = 'setting';
		$this->data['title'] = 'Kelola Jumlah Cuti Tahunan';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('setting/lihat', $this->data);
	}

	public function show_api_key($id_lsp = NULL){
		
		$this->data['aktif'] = 'setting';
		$this->data['title'] = 'Api Key Token & Session Accurate Online';
		$this->data['cuti'] = $this->m_setting->api_show();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('setting/show_api_key', $this->data);
	}
	public function tambah_p($id_lsp = NULL){
		
		$this->data['aktif'] = 'pengumuman';
		$this->data['title'] = 'Tambah pengumuman';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('pengumuman/tambah', $this->data);
	}
		public function lihat_p($id_lsp = NULL){
		
		$this->data['aktif'] = 'pengumuman';
		$this->data['title'] = 'Pengumuman Aktif';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['pngumuman'] = $this->m_admin->get_pengumuman_aktif_p(); // get resutl
		$this->load->view('pengumuman/lihat', $this->data);
	}
			public function lihat_n($id_lsp = NULL){
		
		$this->data['aktif'] = 'pengumuman';
		$this->data['title'] = 'Pengumuman Non-Aktif';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['pngumuman'] = $this->m_admin->get_pengumuman_nonaktif_p(); // get resutl
		$this->load->view('pengumuman/lihat', $this->data);
	}
		public function ubah_p($id_p = NULL){
		$this->data['aktif'] = 'pengumuman';
		$this->data['title'] = 'Tambah pengumuman';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['row'] = $this->m_admin->get_pengumuman_ubah($id_p); // get resutl
		$this->load->view('pengumuman/ubah', $this->data);
	}
		public function save_p(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['created_p'] = $this->session->login['nama'];
			$atdnc_data['createdtime_p'] = date('Y-m-d H:i:s');
			$atdnc_data['uraian'] = $this->input->post('uraian');
			$atdnc_data['status_p'] = $this->input->post('status_p');
      		$this->m_setting->save_p($atdnc_data); //simpan ke tabel jenis setting
			
                                         
      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = $this->input->post('ket');
			$data['kode'] = $this->input->post('ket');
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


			$this->session->set_flashdata('error', 'Pengumuman <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Pengumuman <strong>Berhasil</strong> Ditambahkan!');
			//redirect('pengumuman/lihat');
			redirect('setting/lihat_p');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
			public function save_ubah_p(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id_p'] = $this->input->post('id_p');
			$atdnc_data['uraian'] = $this->input->post('uraian');
			$atdnc_data['status_p'] = $this->input->post('status_p');
			$atdnc_data['updateby_p'] = $this->session->login['nama'];
			$atdnc_data['updatetime_p'] = date('Y-m-d H:i:s');
      		$this->m_setting->ubah_p($atdnc_data); //simpan ke tabel jenis setting
			
                                         
      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = $this->input->post('ket');
			$data['kode'] = $this->input->post('ket');
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


			$this->session->set_flashdata('error', 'Pengumuman <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Pengumuman <strong>Berhasil</strong> Diubah!');
			//redirect('pengumuman/lihat');
			redirect('setting/lihat_p');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		public function save_sop(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['isi_sop'] = $this->input->post('isi_sop');
			$atdnc_data['jenis_sop'] = $this->input->post('jenis_sop');
			$atdnc_data['status_sop'] = $this->input->post('status_sop');
			$atdnc_data['createdby_sop'] =$this->session->login['nama'];
			$atdnc_data['createdtime_sop'] = date('Y-m-d H:i:s');
      		$this->m_sop->save_sop($atdnc_data); //simpan ke tabel jenis setting

			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
			//redirect('pengumuman/lihat');
			redirect('setting/sop');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	
	public function save_ubah_sop(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id_sop'] = $this->input->post('id_sop');
			$atdnc_data['isi_sop'] = $this->input->post('isi_sop');
			$atdnc_data['jenis_sop'] = $this->input->post('jenis_sop');
			$atdnc_data['status_sop'] = $this->input->post('status_sop');
			$atdnc_data['createdby_sop'] =$this->input->post('createdby_sop');
			$atdnc_data['createdtime_sop'] = $this->input->post('createdtime_sop');
      		$this->m_sop->ubah_sop($atdnc_data); //simpan ke tabel jenis setting

			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
			//redirect('pengumuman/lihat');
			redirect('setting/sop');
			}
	public function sop($id_lsp = NULL){
		
		$this->data['aktif'] = 'setting';
		$this->data['title'] = 'Kelola Modul ';
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->data['tampil_sop'] = $this->m_sop->lihat_semua(); //tampilkan sop menu
		$this->load->view('setting/lihat_sop', $this->data);
	}
	public function tambah_sop($id_lsp = NULL){
		
		$this->data['aktif'] = 'setting';
		$this->data['title'] = 'Tambah Sop Modul';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('setting/tambah_sop', $this->data);
	}
	public function ubah_sop($id_p = NULL){
		$this->data['aktif'] = 'pengumuman';
		$this->data['title'] = 'Tambah pengumuman';
		$this->data['cuti'] = $this->m_setting->jumlah_cuti();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['row'] = $this->m_sop->get_sop_edit($id_p); // get resutl
		$this->load->view('setting/ubah_sop', $this->data);
	}
	public function proses_tambah(){
	
			$atdnc_data['jumlah'] = $this->input->post('jumlah');
			$atdnc_data['tahun'] = $this->input->post('tahun');

      		$this->m_setting->save_cuti($atdnc_data); //simpan ke tabel jenis setting
			date_default_timezone_set('Asia/Jakarta');
                                         
      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = $this->input->post('ket');
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
			redirect('setting');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		public function proses_tambah_api(){
	
			$atdnc_data['id_api'] = $this->input->post('id_api');
			$atdnc_data['akses_token'] = $this->input->post('akses_token');
			$atdnc_data['session_api'] = $this->input->post('session_api');
			$atdnc_data['url'] = $this->input->post('url');

      		$this->m_setting->save_api($atdnc_data); //simpan ke tabel jenis setting
			date_default_timezone_set('Asia/Jakarta');
                                         
      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = $this->input->post('ket');
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
			redirect('setting/show_api_key');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	public function hapus_p($id){

			date_default_timezone_set('Asia/Jakarta');
		    $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Pengumuman';
			$data['kode'] = $id;
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


		if($this->m_setting->hapus_p($id)){
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Dihapus!');
			redirect('setting/lihat_p');
		} else {
			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Dihapus!');
			redirect('setting/lihat_p');
		}
	}
		public function hapus_sop($id){

		if($this->m_sop->hapus_sop($id)){
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Dihapus!');
			redirect('setting/sop');
		} else {
			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Dihapus!');
			redirect('setting/sop');
		}
	}
	public function hapus($id){

			date_default_timezone_set('Asia/Jakarta');
		    $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Jumlah Cuti Tahunan';
			$data['kode'] = $id;
			$this->m_setting->tambah($data); //simpan ke tabel jenis setting


		if($this->m_setting->hapus($id)){
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Dihapus!');
			redirect('setting');
		} else {
			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Dihapus!');
			redirect('setting');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_setting->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}


}