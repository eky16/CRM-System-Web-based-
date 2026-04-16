<?php
	 
	use Dompdf\Dompdf;
  	require_once APPPATH."/third_party/PHPExcel.php";
  	require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
	class Sales extends CI_Controller{
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

			$this->data['aktif'] = 'sales';
			$this->load->model('M_sales', 'm_sales');
		}

		public function index(){
			$this->data['title'] = 'Data Sales';

			$this->data['sales'] = $this->m_sales->lihat();
			$this->data['no'] = 1;
			$this->load->view('sales/lihat', $this->data);
		}
		public function nonaktif(){
			$this->data['title'] = 'Data Sales Non - Aktif';

			$this->data['sales'] = $this->m_sales->lihat_nonaktif();
			$this->data['no'] = 1;
			$this->load->view('sales/lihat', $this->data);
		}
		public function detail($id_sales){
			$this->data['title'] = 'Data Sales';
			$this->data['sales_id'] = $this->m_sales->lihat_id($id_sales);
			$this->data['no'] = 1;

	 
			$this->load->view('sales/profil', $this->data); 
		}
		public function ubah($id_lsp){

			$this->data['title'] = 'Ubah ';
			$this->data['sales_id'] = $this->m_sales->lihat_id($id_lsp);

			$this->load->view('sales/ubah', $this->data);
		}
		public function proses_ubah(){
			date_default_timezone_set('Asia/Jakarta');

			$atdnc_data['id_sales'] = $this->input->post('id_sales');
			$atdnc_data['nama_sales'] = $this->input->post('nama_sales');
	        $atdnc_data['status_sales'] = $this->input->post('status_sales');

	        $this->m_sales->save_sales($atdnc_data);
	        	        
	      //  echo '<pre>';
	     //   print_r ($_POST);
	     //   echo '</pre>';
	      //  exit;

	       	$this->session->set_flashdata('error', 'Data Sales <strong>Gagal</strong> Ditambahkan!');
	        $this->session->set_flashdata('success', 'Data Sales <strong>Berhasil</strong> Diubah!');
	        redirect('sales'); //redirect page
			
		}


		public function tambah(){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
				redirect('dashboard');
			}
			$this->data['title'] = 'Tambah sales';
		//	$this->data['kode_leadsproject'] = $this->m_sales->kode_sales();
			$this->load->view('sales/tambah', $this->data);
		}

		public function proses_tambah(){
			date_default_timezone_set('Asia/Jakarta');
            $atdnc_data['creatby_cst'] = $this->session->login['nama'];
	        $atdnc_data['creattime_cst'] = date('Y-m-d  H:i:s');
			$atdnc_data['kode_sales'] = $this->input->post('kode_sales');
			$atdnc_data['nama_sales'] = $this->input->post('nama_sales');
			$atdnc_data['status_sales'] = $this->input->post('status_sales');
			$this->m_sales->save_sales_baru($atdnc_data);

			$this->session->set_flashdata('error', 'Data Sales <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Sales <strong>Berhasil</strong> Ditambahkan!');
	        redirect('sales'); //redirect page

	    }

		public function hapus($id_sales){
			if ($this->session->login['role'] == 'petugas'){
				$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
				redirect('dashboard');
			}
				date_default_timezone_set('Asia/Jakarta');
			if($this->m_sales->hapus($id_sales)){
				$this->session->set_flashdata('success', 'Data sales <strong>Berhasil</strong> Dihapus!');
				redirect('sales');
			} else {
				$this->session->set_flashdata('error', 'Data sales <strong>Gagal</strong> Dihapus!');
				redirect('sales');
			}
		}



	

}