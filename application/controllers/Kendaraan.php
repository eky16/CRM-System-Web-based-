	<?php
	 
	use Dompdf\Dompdf;
  	require_once APPPATH."/third_party/PHPExcel.php";
  	require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
	class Kendaraan extends CI_Controller{
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

			$this->data['aktif'] = 'kendaraan';
			$this->load->model('M_kendaraan', 'm_kendaraan');
		}

		public function index(){
			$this->data['title'] = 'Data Kendaraan';

			$this->data['cst'] = $this->m_kendaraan->lihat();
			$this->data['no'] = 1;
			$this->load->view('kendaraan/lihat', $this->data);
		}
		public function nonaktif(){
			$this->data['title'] = 'Data Kendaraan Non - Aktif';

			$this->data['cst'] = $this->m_kendaraan->lihat_nonaktif();
			$this->data['no'] = 1;
			$this->load->view('kendaraan/lihat', $this->data);
		}
		public function detail($id_kendaraan){
			$this->data['title'] = 'Data Kendaraan';
			$this->data['kendaraan_id'] = $this->m_kendaraan->lihat_id($id_kendaraan);
			$this->data['no'] = 1;

	 
			$this->load->view('kendaraan/profil', $this->data); 
		}
		public function ubah($id_lsp){

			$this->data['title'] = 'Ubah';
			$this->data['kendaraan_id'] = $this->m_kendaraan->lihat_id($id_lsp);

			$this->load->view('kendaraan/ubah', $this->data);
		}
		public function proses_ubah(){
		
             
            $atdnc_data['id_kendaraan'] = $this->input->post('id_kendaraan');
			$atdnc_data['nomor_kendaraan']  = $this->input->post('nomor_kendaraan');
	        $atdnc_data['nama_kendaraan']   = $this->input->post('nama_kendaraan');
	        $atdnc_data['status_kendaraan'] = $this->input->post('status_kendaraan');
	        

	        $this->m_kendaraan->save_kendaraan($atdnc_data);
	        	        
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	       	$this->session->set_flashdata('error', 'Data kendaraan <strong>Gagal</strong> Ditambahkan!');
	        $this->session->set_flashdata('success', 'Data kendaraan  <strong>Berhasil</strong> Diubah!');
	        redirect('kendaraan'); //redirect page
			
		}


		public function tambah(){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
				redirect('dashboard');
			}
			$this->data['title'] = 'Tambah Kendaraan';
		//	$this->data['kode_leadsproject'] = $this->m_customer->kode_customer();
			$this->load->view('kendaraan/tambah', $this->data);
		}

		public function proses_tambah(){

	        $atdnc_data['nomor_kendaraan'] = $this->input->post('nomor_kendaraan');
	        $atdnc_data['nama_kendaraan'] = $this->input->post('nama_kendaraan');
	        $atdnc_data['status_kendaraan'] = $this->input->post('status_kendaraan');
	     
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	        $this->m_kendaraan->save_kendaraan_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data kendaraan <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data kendaraan <strong>Berhasil</strong> Ditambahkan!');
	        redirect('kendaraan'); //redirect page
			
		}

		public function hapus($id_kendaraan){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_kendaraan->hapus($id_kendaraan)){
				$this->session->set_flashdata('success', 'Data kendaraan <strong>Berhasil</strong> Dihapus!');
				redirect('kendaraan');
			} else {
				$this->session->set_flashdata('error', 'Data kendaraan <strong>Gagal</strong> Dihapus!');
				redirect('kendaraan');
			}
		}



	

}