	<?php
	 
	use Dompdf\Dompdf;
  	require_once APPPATH."/third_party/PHPExcel.php";
  	require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
	class Customer extends CI_Controller{
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

			$this->data['aktif'] = 'customer';
			$this->load->model('M_customer', 'm_customer');
		}

		public function index(){
			$this->data['title'] = 'Data Customer';

			$this->data['cst'] = $this->m_customer->lihat();
			$this->data['no'] = 1;
			$this->load->view('customer/lihat', $this->data);
		}
		public function nonaktif(){
			$this->data['title'] = 'Data Customer Non - Aktif';

			$this->data['cst'] = $this->m_customer->lihat_nonaktif();
			$this->data['no'] = 1;
			$this->load->view('customer/lihat', $this->data);
		}
		public function detail($id_cst){
			$this->data['title'] = 'Data Customer';
			$this->data['customer_id'] = $this->m_customer->lihat_id($id_cst);
			$this->data['no'] = 1;

	 
			$this->load->view('customer/profil', $this->data); 
		}
		public function ubah($id_lsp){

			$this->data['title'] = 'Ubah';
			$this->data['customer_id'] = $this->m_customer->lihat_id($id_lsp);

			$this->load->view('customer/ubah', $this->data);
		}
		public function proses_ubah(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id_cst'] = $this->input->post('id_cst');
			$atdnc_data['nama_cst'] = $this->input->post('nama_cst');
	        $atdnc_data['email_cst'] = $this->input->post('email_cst');
	        $atdnc_data['alamat_cst'] = $this->input->post('alamat_cst');
	        $atdnc_data['no_tlp_cst'] = $this->input->post('no_tlp_cst');
	        $atdnc_data['status_cst'] = $this->input->post('status_cst');

	        $this->m_customer->save_customer($atdnc_data);
	        	        
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	       	$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
	        $this->session->set_flashdata('success', 'Data Customer  <strong>Berhasil</strong> Diubah!');
	        redirect('customer'); //redirect page
			
		}


		public function tambah(){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
				redirect('dashboard');
			}
			$this->data['title'] = 'Tambah Customer';
		//	$this->data['kode_leadsproject'] = $this->m_customer->kode_customer();
			$this->load->view('customer/tambah', $this->data);
		}

		public function proses_tambah(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['kode_cst'] = $this->input->post('kode_cst');
	        $atdnc_data['creatby_cst'] = $this->session->login['nama'];
	        $atdnc_data['creattime_cst'] = date('Y-m-d  H:i:s');
	        $atdnc_data['nama_cst'] = $this->input->post('nama_cst');
	        $atdnc_data['email_cst'] = $this->input->post('email_cst');
	        $atdnc_data['no_tlp_cst'] = $this->input->post('no_tlp_cst');
	        $atdnc_data['alamat_cst'] = $this->input->post('alamat_cst');
	        $atdnc_data['status_cst'] = $this->input->post('status_cst');
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	        $this->m_customer->save_customer_baru($atdnc_data);

				$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
				$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
	        redirect('customer'); //redirect page
			
		}

		public function hapus($id_cst){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_customer->hapus($id_cst)){
				$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Dihapus!');
				redirect('customer');
			} else {
				$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Dihapus!');
				redirect('customer');
			}
		}



	

}