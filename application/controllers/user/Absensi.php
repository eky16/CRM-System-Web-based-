<?php

use Dompdf\Dompdf;

class Absensi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		$this->data['aktif'] = 'absensi';
		$this->load->model('M_kehadiran', 'm_kehadiran'); 
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
	}

	  function send_mail() {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
 
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>JENIS</td>
                <td>:      '."Absen Datang".'</td>
            </tr>
            <tr>
                <td>Waktu Absensi</td>
                <td>:      '.$waktunya.'</td>
            </tr>
            <tr>
                <td>KANTOR</td>
                <td>:      '."Cassa Design".'</td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>:      '.$emp->nama_karyawan.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$emp->EmployeeID.'</td>
            </tr>
             <tr>
                <td>DIV</td>
                <td>:      '.$emp->divisi .' '.$emp->department.'</td>
            </tr>
            <tr>
                <td>STATUS</td>
                <td>:      '."Berhasil Cek In".'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
   
            
			$this->session->set_flashdata('success', 'Email <strong>Berhasil</strong> Dikirim!');
			redirect('user/izin/email');
        } else {
            show_error($this->email->print_debugger());
        }
    }
	public function sidebar(){ 
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	
		$this->load->view('partials/sidebar', $this->data);
	}
	public function index($id_lsp = NULL){
		$this->data['title'] = 'ABSENSI';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat(); 
		$this->data['isi'] = $this->m_sop->lihat_04(); //tampilkan sop menu
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$id = $this->session->login['kode'];
		$this->data['all_absensi'] = $this->m_kehadiran->view_asset_id($id);

		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['cek_absen'] = $this->m_kehadiran->absen_hari_ini($id);
		$this->load->view('user/absensi/lihat', $this->data);
	}

	public function detail($id_asset){
		$this->data['title'] = 'Profil Asset';
		$this->data['asst'] = $this->m_kehadiran->lihat_id($id_asset);

		$this->load->view('asset/details', $this->data);
	}

	public function lihat_filter($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat();
		$this->data['no'] = 1;



   	$this->data['all_leads_project'] = $this->m_kehadiran->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_kehadiran->view_mom_filter($id_lsp); 

		$this->load->view('asset/lihat', $this->data);
	}

	public function lihat_filter_goal($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_kehadiran->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_kehadiran->view_mom_all_goal_fillter($id_lsp); 

		$this->load->view('asset/lihat_goal', $this->data);
	}
	public function lihat_semua($EmployeeID = NULL){
		$this->data['title'] = 'ASSET CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat();
		$this->data['no'] = 1; 

   //	$this->data['all_leads_project'] = $this->m_kehadiran->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_asset'] = $this->m_kehadiran->tampil_asset(); 

		$this->load->view('asset/lihat', $this->data); 
	}

		public function lihat_semua_rusak($EmployeeID = NULL){
		$this->data['title'] = 'ASSET RUSAK CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat();
		$this->data['no'] = 1; 

   //	$this->data['all_leads_project'] = $this->m_kehadiran->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_asset'] = $this->m_kehadiran->tampil_asset_rusak(); 

		$this->load->view('asset/lihat', $this->data); 
	}
	public function lihat_semua_goal($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_kehadiran->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_kehadiran->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_kehadiran->view_mom_all_goal($id_lsp); 

		$this->load->view('asset/lihat_goal', $this->data);
	}
	public function tambah($id = NULL){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['kode_asset'] = $this->m_kehadiran->kode_asset();


		$this->data['title'] = 'TAMBAH ASSET';
		$this->load->view('asset/tambah', $this->data);
	}

public function ubah($id_asset){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'UBAH ASSET';
		$this->data['asst'] = $this->m_kehadiran->lihat_id($id_asset);

		$this->load->view('asset/ubah', $this->data);
	}
	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

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
			$atdnc_data['nama_asset'] = $this->input->post('nama_asset');
			$atdnc_data['kode_asset'] = $this->input->post('kode_asset');
      $atdnc_data['createdby'] = $this->input->post('createdby');
      $atdnc_data['createdtime'] = $this->input->post('createdtime');
			$atdnc_data['keterangan_asset'] = $this->input->post('keterangan_asset');
			$atdnc_data['status'] = $this->input->post('status');
			$this->m_kehadiran->save_asset($atdnc_data);

      $data['user'] = $this->input->post('createdby');
			$data['waktu'] = $this->input->post('createdtime');
			$nama_asset =  $this->input->post('nama_asset');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama_asset;
			$data['kode'] = $this->input->post('kode_asset');

			$this->m_kehadiran->tambah_log($data); //simpan ke tabel log

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
			$this->m_kehadiran->tambah_log($data); //simpan ke tabel jenis izin

		if($this->m_kehadiran->hapus($id)){
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Dihapus!');
			redirect('asset/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Dihapus!');
			redirect('asset/lihat_semua');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_kehadiran->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



}