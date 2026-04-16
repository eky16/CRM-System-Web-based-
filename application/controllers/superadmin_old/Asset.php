<?php

use Dompdf\Dompdf;

class Asset extends CI_Controller{
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
		$this->data['aktif'] = 'asset';
		$this->load->model('M_asset', 'm_asset'); 
		$this->load->model('M_izin', 'm_izin');
		 $this->load->model('M_reimburs', 'm_reimburs');
		 $this->load->model('M_payment', 'm_payment');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		$this->data['title'] = 'ASSET';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   	$this->data['all_leads_project'] = $this->m_asset->get_lsp();
   			$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_asset->view_mom_filter($id_lsp); 

		$this->load->view('asset/lihat', $this->data);
	}

	public function detail($id_asset){
		$this->data['title'] = 'Profil Asset';
		$this->data['asst'] = $this->m_asset->lihat_id($id_asset); 
		
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->load->view('asset/details', $this->data);
	}

	public function lihat_filter($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1;



   	$this->data['all_leads_project'] = $this->m_asset->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_asset->view_mom_filter($id_lsp); 

		$this->load->view('asset/lihat', $this->data);
	}

	public function lihat_filter_goal($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_asset->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_asset->view_mom_all_goal_fillter($id_lsp); 

		$this->load->view('asset/lihat_goal', $this->data);
	}
	public function lihat_semua($EmployeeID = NULL){
		$this->data['title'] = 'ASSET CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1; 
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_asset->get_lsp();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_asset'] = $this->m_asset->tampil_asset(); 

		$this->load->view('asset/lihat', $this->data); 
	}
	public function terpakai($EmployeeID = NULL){
		$this->data['title'] = 'ASSET TERPAKAI';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1; 
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_asset->get_lsp();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_asset'] = $this->m_asset->tampil_asset_terpakai(); 

		$this->load->view('asset/lihat_terpakai', $this->data); 
	}
		public function lihat_semua_rusak($EmployeeID = NULL){
		$this->data['title'] = 'ASSET RUSAK CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1; 
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_asset->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_asset'] = $this->m_asset->tampil_asset_rusak(); 

		$this->load->view('asset/lihat', $this->data); 
	}
	public function lihat_semua_goal($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_asset->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_asset->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_asset->view_mom_all_goal($id_lsp); 

		$this->load->view('asset/lihat_goal', $this->data);
	}
	public function tambah($id = NULL){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['kode_asset'] = $this->m_asset->kode_asset();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->data['title'] = 'TAMBAH ASSET';
		$this->load->view('asset/tambah', $this->data);
	}

public function ubah($id_asset){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['title'] = 'UBAH ASSET';
		$this->data['asst'] = $this->m_asset->lihat_id($id_asset);

		$this->load->view('asset/ubah', $this->data);
	}
	public function proses_tambah(){


if (!empty($_FILES['gambar_asset']['name'])) {
		$config['upload_path']          = './img/uploads/foto_asset';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 5000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar_asset');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['gambar_asset'] = $this->upload->data("file_name");
			$atdnc_data['fullpath'] = $this->upload->data('full_path');

}
			$atdnc_data['jenis_asset'] = $this->input->post('jenis_asset');
			$atdnc_data['tgl_pajak'] = $this->input->post('tgl_pajak');
			$atdnc_data['nama_asset'] = $this->input->post('nama_asset');
			$atdnc_data['kode_asset'] = $this->input->post('kode_asset');
      		$atdnc_data['createdby'] = $this->input->post('createdby');
      		$atdnc_data['createdtime'] = $this->input->post('createdtime');
			$atdnc_data['keterangan_asset'] = $this->input->post('keterangan_asset');
			$atdnc_data['status'] = $this->input->post('status');
			$this->m_asset->save_asset($atdnc_data);

      $data['user'] = $this->input->post('createdby');
			$data['waktu'] = $this->input->post('createdtime');
			$nama_asset =  $this->input->post('nama_asset');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama_asset;
			$data['kode'] = $this->input->post('kode_asset');

			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('asset/lihat_semua');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}


  

	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

			date_default_timezone_set('Asia/Jakarta');
		  $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Asset';
			$data['kode'] = $id;
			$this->m_asset->tambah_log($data); //simpan ke tabel jenis izin

		if($this->m_asset->delete($id)){
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Dihapus!');
			redirect('asset/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Dihapus!');
			redirect('asset/lihat_semua');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_asset->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



}