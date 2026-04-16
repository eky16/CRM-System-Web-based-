<?php

use Dompdf\Dompdf;
//require_once('PHPExcel.php');

  require_once APPPATH."/third_party/PHPExcel.php";
  require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
class Leads extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		$this->data['aktif'] = 'leads';
		$this->load->model('M_leads', 'm_leads');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_sop', 'm_sop');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('Fullcalendar_model', 'm_calendar');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('m_pembelian', 'm_pembelian');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
	}

	public function index(){
		$this->data['title'] = 'Data Leads Project';

		$this->data['all_leads'] = $this->m_leads->lihat();
		$this->data['no'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_tender', $this->data);
	}
         public function update_jadwal_s($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['jadwal_survey'] = $this->input->post('jadwal_survey');
		$data['ket_survey'] = $this->input->post('ket_survey');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update Jadwal Survey';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
		$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Survey';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('jadwal_survey');
		$data_['end_event'] = $this->input->post('jadwal_survey');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Jadwal Survey <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
       public function update_fv1($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['fv1'] = $this->input->post('fv1');
		$data['ket_fv1'] = $this->input->post('ket_fv1');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update FV 1';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
												$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Follow Up 1';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('fv1');
		$data_['end_event'] = $this->input->post('fv1');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'FV 1 <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
        public function update_fv2($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['fv2'] = $this->input->post('fv2');
		$data['ket_fv2'] = $this->input->post('ket_fv2');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update FV 2';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
										$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Follow Up 2';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('fv2');
		$data_['end_event'] = $this->input->post('fv2');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'FV 2 <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
        public function update_fv3($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['fv3'] = $this->input->post('fv3');
		$data['ket_fv3'] = $this->input->post('ket_fv3');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update FV 3';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
								$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Follow Up 3';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('fv3');
		$data_['end_event'] = $this->input->post('fv3');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'FV 3s <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
        public function update_fv4($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['fv4'] = $this->input->post('fv4');
		$data['ket_fv4'] = $this->input->post('ket_fv4');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update FV 4';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
						$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Follow Up 4';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('fv4');
		$data_['end_event'] = $this->input->post('fv4');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'FV 4 <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
        public function update_fv5($id = NULL) { 
       	date_default_timezone_set('Asia/Jakarta');

       	$data['id_lsp'] = $this->input->post('id_lsp');
		$data['fv5'] = $this->input->post('fv5');
		$data['ket_fv5'] = $this->input->post('ket_fv5');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
		//untuk log
		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update FV 5';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
				$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Follow Up 5';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('fv5');
		$data_['end_event'] = $this->input->post('fv5');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'FV 5 <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
   public function update_submit_boq($id = NULL) { 
        date_default_timezone_set('Asia/Jakarta');
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/submit/boq';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['file_boq'] = $this->upload->data("file_name");

}
		$data['id_lsp'] = $this->input->post('id_lsp');
		$data['jadwal_boq'] = $this->input->post('jadwal_boq');
		$data['ket_boq'] = $this->input->post('ket_boq');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
					//untuk log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
		
		$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Submit Boq';
		$data_['title'] = $user.' - '.$isi.' - '.$project ;
		$data_['start_event'] = $this->input->post('jadwal_boq');
		$data_['end_event'] = $this->input->post('jadwal_boq');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);



		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update Submit Boq';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Jadwal Submit Design <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
    public function update_submit_design($id = NULL) { 
        date_default_timezone_set('Asia/Jakarta');
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/submit/design';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['file_design'] = $this->upload->data("file_name");

}
		$data['id_lsp'] = $this->input->post('id_lsp');
		$data['jadwal_design'] = $this->input->post('jadwal_design');
		$data['ket_design'] = $this->input->post('ket_design');
		$data['updateby'] = $this->session->login['nama'];
		$data['updatetime'] = date('Y-m-d H:i:s');
		$this->m_mom->update_fv($data); 
					//untuk log

		$data_log['user'] = $this->session->login['nama'];
		$data_log['waktu'] = date('Y-m-d H:i:s');
		$keterangan =  'Update Submit Design';
		$data_log['ket'] = $keterangan;
		$data_log['kode'] = $this->input->post('id_lsp');
		$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$myvalue = $this->session->login['nama'];
		$arr = explode(' ',trim($myvalue));
		$kalimat_pertama = $arr[0]; // will print Test
		$kalimat_new = strtolower($kalimat_pertama);
		$kalimat_new1 = ucfirst($kalimat_new);
		$project = $this->input->post('nm_pro');
		$user = $kalimat_new1;
		$isi = 'Submit Design';
		$data_['title'] = $user.' - '.$isi.' | '.$project ;
		$data_['start_event'] = $this->input->post('jadwal_design');
		$data_['end_event'] = $this->input->post('jadwal_design');
		$data_['mode'] = 'leadsproject';
		$data_['create_by'] = $this->session->login['nama'];
		$data_['time_create'] = date('Y-m-d H:i:s');
		$this->m_calendar->insert_event_leads($data_);
        //   echo '<pre>';
        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Jadwal Submit Design <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
    }
	public function my_leads_p(){
		$this->data['title'] = 'Data Leads Project';

		$nama = $this->session->login['nama'];
		$this->data['all_leads'] = $this->m_leads->lihat_my_leads($nama);
		$this->data['no'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_mkt', $this->data);
	}
	public function my_ongoing_p(){
		$this->data['title'] = 'Project On Going';
		$nama = $this->session->login['nama'];
		$this->data['all_leads'] = $this->m_leads->my_ongoing_p($nama);
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_mkt', $this->data);
	}
	public function my_retensi(){
		$this->data['title'] = 'Project Retensi';
		$nama = $this->session->login['nama'];
		$this->data['all_leads'] = $this->m_leads->my_retensi($nama);
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_mkt', $this->data);
	}
	public function my_finish_p(){
		$this->data['title'] = 'Project Finish';
		$nama = $this->session->login['nama'];
		$this->data['all_leads'] = $this->m_leads->my_finish_p($nama);
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_mkt', $this->data);
	}
	public function my_Lose_p(){
		$this->data['title'] = 'Project Lose';
		$nama = $this->session->login['nama'];
		$this->data['all_leads'] = $this->m_leads->my_Lose_p($nama);
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat_mkt', $this->data);
	}
	public function ongoing(){
		$this->data['title'] = 'Project On Going';

		$this->data['all_leads'] = $this->m_leads->ongoing();
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat', $this->data);
	}
	public function retensi(){
		$this->data['title'] = 'Project Retensi';

		$this->data['all_leads'] = $this->m_leads->retensi();
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat', $this->data);
	}
	public function finish(){
		$this->data['title'] = 'Project Finish';

		$this->data['all_leads'] = $this->m_leads->finish();
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat', $this->data);
	}
	public function Lose(){
		$this->data['title'] = 'Project Lose';

		$this->data['all_leads'] = $this->m_leads->loose();
		$this->data['no'] = 1;
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->load->view('user/leads/lihat', $this->data);
	}
	public function detail($id_lsp){
		$this->data['title'] = 'Data Leads Project';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['noo'] = 1;
		$this->data['nooo'] = 1;
		$this->data['noooo'] = 1;
		$this->data['nooooo'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();

    $this->data['all_dept_info'] = $this->m_kerja->lihat_modul_leads($id_lsp);
    $this->data['momshow'] = $this->m_mom->get_lsp_show($id_lsp);
    $this->data['all_foto'] = $this->m_kerja->lihat_sum_img($id_lsp);
    $this->data['all_issue'] = $this->m_kerja->lihat_issue_hd($id_lsp);
	$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
	$this->data['all_checklist'] = $this->m_kerja->lihat_checklist($id_lsp);

	$this->data['grand_total'] = $this->m_reimburs->view_reimbus_end_laporan_total_leads($id_lsp);
	$this->data['grand_total_pesanan'] = $this->m_pembelian->laporan_01_total_grand_leads($id_lsp);
	$this->data['grand_total_pesanan_not_fix'] = $this->m_pembelian->laporan_03_total_grand_report_sending_leads($id_lsp);
	$this->data['grand_total_pesanan_ME'] = $this->m_pembelian->laporan_total_ME($id_lsp);
	$this->data['grand_total_pesanan_furniture'] = $this->m_pembelian->laporan_total_furniture($id_lsp);
	$this->data['grand_total_pesanan_sipil'] = $this->m_pembelian->laporan_total_sipil($id_lsp);
	$this->data['grand_total_pesanan_dll'] = $this->m_pembelian->laporan_total_dll($id_lsp);
	$this->data['grand_total_barang'] = $this->m_pengeluaran->total_pengaluaran_biaya($id_lsp);

		$this->load->view('user/leads/profil', $this->data);
	}
	public function detail_meterial_all($id_lsp){
		$this->data['title'] = 'Semua Data Material';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

	$this->data['material'] = $this->m_leads->lihat_material_all($id_lsp);
	$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
	$this->load->view('user/leads/material_lantai', $this->data);
	}
	public function detail_meterial_lantai($id_lsp){ 
		$this->data['title'] = 'Finishing Lantai';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

	$this->data['material'] = $this->m_leads->lihat_material_lantai($id_lsp);
	$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}
	public function detail_meterial_dinding($id_lsp){
		$this->data['title'] = 'Finishing Dinding';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

	$this->data['material'] = $this->m_leads->lihat_material_dinding($id_lsp);
	$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}
		public function detail_meterial_pintu($id_lsp){
		$this->data['title'] = 'Finishing Pintu & Celling';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

	$this->data['material'] = $this->m_leads->lihat_material_pintu($id_lsp);
	$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}

	public function detail_meterial_furnitur($id_lsp){
		$this->data['title'] = 'Furniture';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

		$this->data['material'] = $this->m_leads->lihat_material_furnitur($id_lsp);
		$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}
	public function detail_meterial_me($id_lsp){
		$this->data['title'] = 'ME';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

		$this->data['material'] = $this->m_leads->lihat_material_me($id_lsp);
		$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}
	public function detail_meterial_lighting($id_lsp){
		$this->data['title'] = 'Lighting';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;

	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

		$this->data['material'] = $this->m_leads->lihat_material_lighting($id_lsp);
		$this->data['all_stts_proyek'] = $this->m_kerja->lihat_status_log_proyek($id_lsp);
		$this->load->view('user/leads/material_lantai', $this->data);
	}
		public function detail_checklist($id_ceklist){
		$this->data['title'] = 'Detail Checklist';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['all_checklist'] = $this->m_kerja->lihat_hd_checklist($id_ceklist);
		$this->data['all_checklist_dt'] = $this->m_kerja->lihat_dt_checklist($id_ceklist);
		$this->load->view('user/leads/detail_checklist', $this->data);
	}
	public function detail_material($id_ceklist){
		$this->data['title'] = 'Detail Material';
		$this->data['no'] = 1;
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['all_checklist'] = $this->m_kerja->lihat_detail_material($id_ceklist);
		$this->data['all_checklist_dt'] = $this->m_kerja->lihat_dt_material($id_ceklist);
		$this->load->view('user/leads/detail_material', $this->data);
	}
  	function create_issue(){
   		 //      echo '<pre>';
     //    print_r ($_POST);
     //   echo '</pre>';
    //    exit;
		date_default_timezone_set('Asia/Jakarta');
      $data_log['user'] = $this->input->post('created_issue');
			$data_log['waktu'] = $this->input->post('created_time_issue');
			$keterangan =  'Create Issue';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_lsp_issue');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		$id_lsp_issue = $this->input->post('id_lsp_issue',TRUE);
		$kode_issue = $this->input->post('kode_issue',TRUE);
		$kode_issuee = $this->input->post('kode_issuee',TRUE);
		$ket_issu = $this->input->post('ket_issu',TRUE);
		$created_time_issue = $this->input->post('created_time_issue',TRUE);
		$created_issue = $this->input->post('created_issue',TRUE);
		$issue = $this->input->post('issue',TRUE);
		$judul_issue = $this->input->post('judul_issue',TRUE);

   
          $this->m_kerja->create_package_issue_user($id_lsp_issue,$kode_issue,$ket_issu,$created_time_issue,$created_issue,$issue,$kode_issuee,$judul_issue);
       
        	$this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Ditambahkan!');
            redirect('mod_kerja');
          //  show_error($this->email->print_debugger());
        
		
	}
   	  public function update_checklist($id = NULL) { 
	  	 //   echo '<pre>';
     //      print_r ($_POST);
     //    echo '</pre>';y
     //   exit;
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['foto_sesudah'] = $this->upload->data("file_name");
    
		$data['id_cek_sub'] = $this->input->post('id_cek_sub');
    $data['upload_time_s'] = $this->input->post('upload_time_s'); 
		$data['ket_sesudah'] = $this->input->post('ket_sesudah');
    	$this->m_mom->ubah_laporan_checklist($data);
}
			$link = $this->input->post('kode_ceklist');
			//untuk log

      $data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = $this->input->post('upload_time_s');
			$keterangan =  'Upload Img Checklist';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('kode_ceklist');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log



       	$this->session->set_flashdata('error', 'Foto <strong>Gagal</strong> Diupload!');
        $this->session->set_flashdata('success', 'Foto <strong>Berhasil</strong> Diupload!');
        redirect('user/leads/detail_checklist/'.$link); //redirect page
    }
   	  public function create_checklist($id = NULL) { 
	  	 //   echo '<pre>';
     //      print_r ($_POST);
     //    echo '</pre>';y
     //   exit;
        $config['upload_path']          = './img/uploads/berkas1/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 2048;
        $config['max_height']           = 1000;
        $config['encrypt_name']         = true;
        $this->load->library('upload',$config);

        
        $idnya = $this->input->post('code_ceklist',TRUE);
        $ket_ceklist = $this->input->post('ket_ceklist',TRUE);
        $jumlah_berkas = count($_FILES['berkas']['name']);
        
        for($i = 0; $i < $jumlah_berkas;$i++)
        {
            if(!empty($_FILES['berkas']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
       
                $this->upload->do_upload('file');
                
                    $uploadData = $this->upload->data();
                    $foto = $uploadData['file_name'];
                    $data_dt['foto_sebelum'] = $uploadData['file_name'];
    //  echo '<pre>';
   //    print_r ($_POST);
    //    print_r ($uploadData);
    //   echo '</pre>';
     //   exit;
                
            }       
                    $data_dt['kode_ceklist'] = $idnya[$i];
                    $data_dt['ket_ceklist'] = $ket_ceklist[$i];
                //  $data['tipe_berkas'] = $uploadData['file_ext'];
                //  $data['ukuran_berkas'] = $uploadData['file_size'];
                    $this->db->insert('tbl_ceklist_sub',$data_dt);
               //     $this->m_kerja->dadadada($data);
        }

     $link = $this->input->post('id_lsp_ceklist');
		$data['kode_ceklist'] = $this->input->post('kode_ceklist');
    $data['id_lsp_ceklist'] = $this->input->post('id_lsp_ceklist'); 
		$data['tgl_ceklist'] = $this->input->post('tgl_ceklist');
		$data['user_ceklist'] = $this->input->post('user_ceklist');
    $data['lokasi_ceklist'] = $this->input->post('lokasi_ceklist');
    $data['duedate_ceklist'] = $this->input->post('duedate_ceklist');
    	$this->m_mom->tambah_laporan_checklist($data);
			//untuk log

      $data_log['user'] = $this->input->post('user_ceklist');
			$data_log['waktu'] = $this->input->post('tgl_ceklist');
			$keterangan =  'Create Checklist';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_lsp_ceklist');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log



       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Status Log Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads/detail/'.$link.'#checklist'); //redirect page
    }

    public function create_material($id = NULL) { 
	  	 //   echo '<pre>';
     //      print_r ($_POST);
     //    echo '</pre>';y
     //   exit;
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/material';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$atdnc_data['gambarrr'] = $this->upload->data("file_name");
    
		}
     	$link = $this->input->post('id_lsp');
     	$link2 = $this->input->post('link2');
		$atdnc_data['id_material'] = $this->input->post('id_material');
    	$atdnc_data['id_leadsproyek'] = $this->input->post('id_lsp'); 
		$atdnc_data['jenis'] = $this->input->post('jenis');
		$atdnc_data['status_approved'] = $this->input->post('status_approved');
    	$atdnc_data['jenis_material'] = $this->input->post('jenis_material');
    	$atdnc_data['kode_spesifikasi'] = $this->input->post('kode_spesifikasi');
    	$atdnc_data['lokasi_penggunaan'] = $this->input->post('lokasi_penggunaan');
    	$atdnc_data['creat_at_mt'] = $this->input->post('tgl_ceklist');
    	$atdnc_data['creat_by_mt'] = $this->input->post('user_ceklist');
    	$atdnc_data['tgl_'] = $this->input->post('tgl_');
    	$this->m_leads->save_material($atdnc_data);
			//untuk tabel material

      		$data_log['user'] = $this->input->post('user_ceklist');
			$data_log['waktu'] = $this->input->post('tgl_ceklist');
			$keterangan =  'Create Material';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_material');
			//$this->m_mom->tambah_log($data_log); //simpan ke tabel log



       	$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads/'.$link2.'/'.$link); //redirect page
    }
        public function update_material($id = NULL) { 
	  //	    echo '<pre>';
       //    print_r ($_POST);
      //   echo '</pre>';
       // exit;
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/material';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$atdnc_data['gambarrr'] = $this->upload->data("file_name");
    
		}
     	$link = $this->input->post('id_lsp');
     	$link2 = $this->input->post('link2');
		$atdnc_data['no'] = $this->input->post('idd_no');
    	$atdnc_data['id_leadsproyek'] = $this->input->post('id_lsp'); 
		$atdnc_data['status_approved'] = $this->input->post('status_approved');
    	$atdnc_data['jenis_material'] = $this->input->post('jenis_material');
    	$atdnc_data['kode_spesifikasi'] = $this->input->post('kode_spesifikasi');
    	$atdnc_data['lokasi_penggunaan'] = $this->input->post('lokasi_penggunaan');
		$atdnc_data['last_updateby'] = $this->input->post('user_ceklist');
    	$atdnc_data['last_time_update'] = $this->input->post('tgl_ceklist');
    	$atdnc_data['tgl_'] = $this->input->post('tgl_');
    	$this->m_leads->update_material($atdnc_data);
			//untuk tabel material

      		$data_log['user'] = $this->input->post('user_ceklist');
			$data_log['waktu'] = $this->input->post('tgl_ceklist');
			$keterangan =  'Update Material';
			$data_log['ket'] = $keterangan .' -'. $this->input->post('id_material');
			$data_log['kode'] = $this->input->post('id_material');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

    	$data['id_material'] = $this->input->post('id_material'); 
		$data['status_approved'] = $this->input->post('status_approved_lama');
    	$data['jenis_matrial'] = $this->input->post('jenis_material_lama');
    	$data['kode_spesifikasi'] = $this->input->post('kode_spesifikasi_lama');
    	$data['lokasi_penggunaan'] = $this->input->post('lokasi_penggunaan_lama');
    	$data['creat_date_mt_log'] = $this->input->post('tgl_ceklist');
    	$data['creat_by_mt_log'] = $this->input->post('user_ceklist');
    	$data['gambarr'] = $this->input->post('gambarrr');
    	$this->m_leads->tambah_log_material($data); 	//untuk tabel material log

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
        redirect('user/leads/'.$link2.'/'.$link); //redirect page
    }
    public function update_detail_material($id = NULL) { 
	  //	    echo '<pre>';
       //    print_r ($_POST);
      //   echo '</pre>';
       // exit;
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/material';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$atdnc_data['gambarrr'] = $this->upload->data("file_name");
    
		}
     	$link = $this->input->post('id_material');
     	$link2 = 'detail_material';
		$atdnc_data['no'] = $this->input->post('idd_no');
    	$atdnc_data['id_leadsproyek'] = $this->input->post('id_lsp'); 
		$atdnc_data['status_approved'] = $this->input->post('status_approved');
    	$atdnc_data['jenis_material'] = $this->input->post('jenis_material');
    	$atdnc_data['kode_spesifikasi'] = $this->input->post('kode_spesifikasi');
    	$atdnc_data['lokasi_penggunaan'] = $this->input->post('lokasi_penggunaan');
    	$atdnc_data['last_updateby'] = $this->input->post('user_ceklist');
    	$atdnc_data['last_time_update'] = $this->input->post('tgl_ceklist');
    	$atdnc_data['tgl_'] = $this->input->post('tgl_');
    	$this->m_leads->update_material($atdnc_data);
			//untuk tabel material

      		$data_log['user'] = $this->input->post('user_ceklist');
			$data_log['waktu'] = $this->input->post('tgl_ceklist');
			$keterangan =  'Update Material';
			$data_log['ket'] = $keterangan .' -'. $this->input->post('id_material');
			$data_log['kode'] = $this->input->post('id_material');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

    	$data['id_material'] = $this->input->post('id_material'); 
		$data['status_approved'] = $this->input->post('status_approved_lama');
    	$data['jenis_matrial'] = $this->input->post('jenis_material_lama');
    	$data['kode_spesifikasi'] = $this->input->post('kode_spesifikasi_lama');
    	$data['lokasi_penggunaan'] = $this->input->post('lokasi_penggunaan_lama');
    	$data['creat_date_mt_log'] = $this->input->post('tgl_ceklist');
    	$data['creat_by_mt_log'] = $this->input->post('user_ceklist');
    	$data['gambarr'] = $this->input->post('gambarrr');
    	$this->m_leads->tambah_log_material($data); 	//untuk tabel material log

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
        redirect('user/leads/'.$link2.'/'.$link); //redirect page
    }
  public function save_laporan_status_log($id = NULL) { 
        $link = $this->input->post('id_lsp_proyek');
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['file'] = $this->upload->data("file_name");

}
		$data['id_lsp_proyek'] = $this->input->post('id_lsp_proyek');
    $data['operator'] = $this->input->post('operator'); 
		$data['tgl_create'] = $this->input->post('tgl_create');
		$data['due_date_log'] = $this->input->post('due_date_log');
    $data['kegiatan'] = $this->input->post('kegiatan');
    	$this->m_mom->tambah_laporan_status_log($data); 
			//untuk log

      $data_log['user'] = $this->input->post('operator');
			$data_log['waktu'] = $this->input->post('tgl_create');
			$keterangan =  'Create Status Project';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_lsp_proyek');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Status Log Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads/detail/'.$link.'#section4'); //redirect page
    }
      public function update_laporan_status_log($id = NULL) { 
        $link = $this->input->post('id_lsp_proyek');
        if (!empty($_FILES['file']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['file'] = $this->upload->data("file_name");

}
	$data['due_date_log'] = $this->input->post('due_date_log');
	$data['id_stts_log'] = $this->input->post('id_stts_log');
    $data['kegiatan'] = $this->input->post('kegiatan');
    	$this->m_mom->update_laporan_status_log($data); 
			//untuk log

      $data_log['user'] = $this->input->post('operator');
			$data_log['waktu'] = $this->input->post('tgl_create');
			$keterangan =  'Update File Status Project';
			$data_log['ket'] = $keterangan;
			$data_log['kode'] = $this->input->post('id_lsp_proyek');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Status Log Project <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Status Log Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads/detail/'.$link.'#section4'); //redirect page
    }
	public function detail_foto($id_lsp,$tgl_upload){
		$this->data['title'] = 'Gallery Foto Progress';
		$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
		$this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();

    $this->data['all_dept_info'] = $this->m_kerja->lihat_modul_leads($id_lsp);
    $this->data['momshow'] = $this->m_mom->get_lsp_show($id_lsp);
    $this->data['all_foto'] = $this->m_kerja->lihat_view_img($id_lsp,$tgl_upload);

		$this->load->view('user/leads/detail_foto', $this->data);
	}
		public function detail_issue($id_lsp){
		$this->data['title'] = 'Detail Issue';
		$this->data['no'] = 1;
    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();

  //  $this->data['all_dept_info'] = $this->m_kerja->lihat_modul_leads($id_lsp);
  //  $this->data['momshow'] = $this->m_mom->get_lsp_show($id_lsp);
  //  $this->data['all_foto'] = $this->m_kerja->lihat_view_img($id_lsp,$tgl_upload);
    	$this->data['issue_hd'] = $this->m_kerja->lihat_issue_hd_dt($id_lsp);
    	$this->data['issue_dt'] = $this->m_kerja->lihat_issue_dt($id_lsp);

		$this->load->view('user/leads/detail_issue', $this->data);
	}
	public function save_problemsolve(){
		date_default_timezone_set('Asia/Jakarta');
				$link = $this->input->post('kode_issue');
				$atdnc_data['id_sub_issue'] = $this->input->post('id_sub_issue');
        $atdnc_data['issue'] = $this->input->post('issue');
        $atdnc_data['proglem_solved'] = $this->input->post('proglem_solved');
        $atdnc_data['created_issue_dt'] = $this->input->post('created_issue_dt');
        $atdnc_data['createdtime_issue_dt'] = date('Y-m-d H:i:s');
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

       $this->m_kerja->save_problemsolve($atdnc_data);
        //untuk log
      $data['user'] = $this->input->post('created_issue_dt');
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  '';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_issue');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       	$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Disimpan!');
        $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Disimpan!');
        redirect('user/leads/detail_issue/'.$link); //redirect page
		
	}
	public function tambah(){

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_status_project'] = $this->m_leads->lihat_status_project();
		$this->data['spv1'] = $this->m_karyawan->get_atasan()->result();
		$this->data['sm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['pm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['dn'] = $this->m_karyawan->get_atasan()->result();
		$this->data['hd_api'] = $this->m_payment->api_show();
		$this->data['title'] = 'Tambah Leads Project';

		$this->data['kode_leadsproject'] = $this->m_leads->kode_leadsproject();
		$this->load->view('user/leads/tambah', $this->data);
	}
	public function tambah_mkt(){

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_status_project'] = $this->m_leads->lihat_status_project();
		$this->data['spv1'] = $this->m_karyawan->get_atasan()->result();
		$this->data['sm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['pm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['dn'] = $this->m_karyawan->get_atasan()->result();
		$this->data['hd_api'] = $this->m_payment->api_show();
		$this->data['title'] = 'Tambah Leads Project';

		$this->data['kode_leadsproject'] = $this->m_leads->kode_leadsproject();
		$this->load->view('user/leads/tambah_mkt', $this->data);
	}
	public function proses_tambah(){

		$atdnc_data['tgl_start'] = $this->input->post('tgl_start');
        $atdnc_data['tgl_serah_terima'] = $this->input->post('tgl_serah_terima');
        $atdnc_data['project_manager'] = $this->input->post('project_manager');
        $atdnc_data['site_manager'] = $this->input->post('site_manager');
        $atdnc_data['spv_manager'] = $this->input->post('spv_manager');
        $atdnc_data['designerBy'] = $this->input->post('designerBy');
		$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
		$atdnc_data['id_proyek_accurate'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('name');
        $atdnc_data['alamat_project'] = $this->input->post('description');
        $atdnc_data['nama_kantor'] = $this->input->post('nama_kantor');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['status_project'] = $this->input->post('status_project');
        $atdnc_data['createdby'] = $this->input->post('createdby');
        $atdnc_data['createdtime'] = $this->input->post('createdtime');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_leads->save_project($atdnc_data);

        $daftar_project['projectNo'] = $this->input->post('id_lsp');
        $daftar_project['project_name'] = $this->input->post('name');
        $this->m_leads->save_daftar_project($daftar_project);
        
        //untuk log
      		$data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_project');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_lsp');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       	$this->session->set_flashdata('error', 'Data leads <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Leads Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads'); //redirect page
		
	}
	public function proses_tambah_mkt(){

		$atdnc_data['tgl_start'] = $this->input->post('tgl_start');
        $atdnc_data['tgl_serah_terima'] = $this->input->post('tgl_serah_terima');
        $atdnc_data['project_manager'] = $this->input->post('project_manager');
        $atdnc_data['site_manager'] = $this->input->post('site_manager');
        $atdnc_data['spv_manager'] = $this->input->post('spv_manager');
        $atdnc_data['designerBy'] = $this->input->post('designerBy');
		$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
		$atdnc_data['id_proyek_accurate'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('name');
        $atdnc_data['alamat_project'] = $this->input->post('description');
        $atdnc_data['nama_kantor'] = $this->input->post('nama_kantor');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['status_project'] = $this->input->post('status_project');
        $atdnc_data['createdby'] = $this->input->post('createdby');
        $atdnc_data['createdtime'] = $this->input->post('createdtime');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_leads->save_project($atdnc_data);

        $daftar_project['projectNo'] = $this->input->post('id_lsp');
        $daftar_project['project_name'] = $this->input->post('name');
        $this->m_leads->save_daftar_project($daftar_project);
        
        //untuk log
      		$data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_project');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_lsp');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       	$this->session->set_flashdata('error', 'Data leads <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Leads Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('user/leads/my_leads_p'); //redirect page
		
	}
	public function ubah($id_lsp){

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['all_status_project'] = $this->m_leads->lihat_status_project();
		$this->data['title'] = 'Ubah Leads Project';
		$this->data['leads'] = $this->m_leads->lihat_id($id_lsp);


		$this->data['spv1'] = $this->m_karyawan->get_atasan()->result();
		$this->data['sm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['pm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['dn'] = $this->m_karyawan->get_atasan()->result();
		$this->load->view('user/leads/ubah', $this->data);
	}

	public function ubah_mkt($id_lsp){

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['all_status_project'] = $this->m_leads->lihat_status_project();
		$this->data['title'] = 'Ubah Leads Project';
		$this->data['leads'] = $this->m_leads->lihat_id($id_lsp);


		$this->data['spv1'] = $this->m_karyawan->get_atasan()->result();
		$this->data['sm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['pm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['dn'] = $this->m_karyawan->get_atasan()->result();
		$this->load->view('user/leads/ubah_mkt', $this->data);
	}

	public function proses_ubah(){
		date_default_timezone_set('Asia/Jakarta');
		$cek_tgl = $this->input->post('tgl_serah_terima');
		if(!empty($cek_tgl)){
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);

			$data_event['start_event'] = $this->input->post('tgl_serah_terima');
			$data_event['end_event'] = $this->input->post('tgl_serah_terima');
			$nama =  $this->input->post('nama_project');
			$keterangan =  'Serah Terima Project';
			$createdBy =  $kalimat_new1;
			$data_event['title'] = $keterangan.' '.$nama.' - '.$createdBy;
			$data_event['time_create'] = date('Y-m-d H:i:s'); 
			$data_event['create_by'] = $this->session->login['nama'];
			$data_event['mode'] = 'leadsproject';
			$this->m_calendar->tambah_event($data_event); //simpan ke tabel Calendar
		}
		$tanggal_retensi = $this->input->post('tanggal_retensi');
		if(!empty($tanggal_retensi)){
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);

			$data_event['start_event'] = $this->input->post('tanggal_retensi');
			$data_event['end_event'] = $this->input->post('tanggal_retensi');
			$nama =  $this->input->post('nama_project');
			$keterangan =  'Retensi Project';
			$createdBy =  $kalimat_new1;
			$data_event['title'] = $keterangan.' '.$nama.' - '.$createdBy;
			$data_event['time_create'] = date('Y-m-d H:i:s'); 
			$data_event['create_by'] = $this->session->login['nama'];
			$data_event['mode'] = 'leadsproject';
			$this->m_calendar->tambah_event($data_event); //simpan ke tabel Calendar
		}
		$atdnc_data['designerBy'] = $this->input->post('designerBy');
		$atdnc_data['tgl_start'] = $this->input->post('tgl_start');
        $atdnc_data['tgl_serah_terima'] = $this->input->post('tgl_serah_terima');
        $atdnc_data['project_manager'] = $this->input->post('project_manager');
        $atdnc_data['site_manager'] = $this->input->post('site_manager');
        $atdnc_data['spv_manager'] = $this->input->post('spv_manager');

		$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('nama_project');
        $atdnc_data['alamat_project'] = $this->input->post('alamat_project');
        $atdnc_data['nama_kantor'] = $this->input->post('nama_kantor');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['keterangan_loose'] = $this->input->post('keterangan_loose');
        $atdnc_data['status_project'] = $this->input->post('status_project');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');
        $atdnc_data['tanggal_retensi'] = $this->input->post('tanggal_retensi');
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_leads->save_project($atdnc_data);
      $data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_project');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_lsp');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       	$this->session->set_flashdata('error', 'Data leads <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Leads Project <strong>Berhasil</strong> Diubah!');
        redirect('user/leads'); //redirect page
		
	}
	public function proses_ubah_mkt(){
		date_default_timezone_set('Asia/Jakarta');
		$cek_tgl = $this->input->post('tgl_serah_terima');
		if(!empty($cek_tgl)){
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);

			$data_event['start_event'] = $this->input->post('tgl_serah_terima');
			$data_event['end_event'] = $this->input->post('tgl_serah_terima');
			$nama =  $this->input->post('nama_project');
			$keterangan =  'Serah Terima Project';
			$createdBy =  $kalimat_new1;
			$data_event['title'] = $keterangan.' '.$nama.' - '.$createdBy;
			$data_event['time_create'] = date('Y-m-d H:i:s'); 
			$data_event['create_by'] = $this->session->login['nama'];
			$data_event['mode'] = 'leadsproject';
			$this->m_calendar->tambah_event($data_event); //simpan ke tabel Calendar
		}

		$atdnc_data['designerBy'] = $this->input->post('designerBy');
		$atdnc_data['tgl_start'] = $this->input->post('tgl_start');
        $atdnc_data['tgl_serah_terima'] = $this->input->post('tgl_serah_terima');
        $atdnc_data['project_manager'] = $this->input->post('project_manager');
        $atdnc_data['site_manager'] = $this->input->post('site_manager');
        $atdnc_data['spv_manager'] = $this->input->post('spv_manager');

				$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('nama_project');
        $atdnc_data['alamat_project'] = $this->input->post('alamat_project');
        $atdnc_data['nama_kantor'] = $this->input->post('nama_kantor');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['keterangan_loose'] = $this->input->post('keterangan_loose');
        $atdnc_data['status_project'] = $this->input->post('status_project');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');

      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_leads->save_project($atdnc_data);
      $data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_project');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_lsp');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       	$this->session->set_flashdata('error', 'Data leads <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Leads Project <strong>Berhasil</strong> Diubah!');
        redirect('user/leads/my_leads_p'); //redirect page
		
	}
	public function hapus($id_lsp){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
			date_default_timezone_set('Asia/Jakarta');
		  $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Leads Project';
			$data['kode'] = $id_lsp;
			$this->m_leads->tambah_log($data); //simpan ke tabel jenis izin
		if($this->m_leads->hapus($id_lsp)){
			$this->session->set_flashdata('success', 'Data leads <strong>Berhasil</strong> Dihapus!');
			redirect('user/leads');
		} else {
			$this->session->set_flashdata('error', 'Data leads <strong>Gagal</strong> Dihapus!');
			redirect('user/leads');
		}
	}
	public function hapus_material($id_lsp){

			date_default_timezone_set('Asia/Jakarta');
		  $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Material';
			$data['kode'] = $id_lsp;
			$this->m_leads->tambah_log($data); //simpan ke tabel jenis izin
		if($this->m_leads->hapus_material($id_lsp)){
			$this->m_leads->hapus_material_log($id_lsp);
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Dihapus!');
			header("location:javascript://history.go(-1)");
		} else {
			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Dihapus!');
			header("location:javascript://history.go(-1)");
		}
	}
function delete_material()
	{
		if($this->input->post('checkbox_value'))
		{
			$id = $this->input->post('checkbox_value');
			for($count = 0; $count < count($id); $count++)
			{
				$this->m_leads->deleted_material_hd($id[$count]);
				$this->m_leads->deleted_material_dt($id[$count]);
			}
		}
	}
	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_leads'] = $this->m_leads->lihat();
		$this->data['title'] = 'Laporan Data leads';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('leads/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data leads Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function upload_bq(){

    $id = $this->session->login['kode'];
    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['all_status_project'] = $this->m_leads->lihat_status_project();
		$this->data['spv1'] = $this->m_karyawan->get_atasan()->result();
		$this->data['sm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['pm'] = $this->m_karyawan->get_atasan()->result();
		$this->data['dn'] = $this->m_karyawan->get_atasan()->result();
		$this->data['hd_api'] = $this->m_payment->api_show();
		$this->data['title'] = 'Upload RAB';
	//	 $this->data['data01'] = $this->m_leads->getData();
		$this->data['kode_leadsproject'] = $this->m_leads->kode_leadsproject();
		$this->data['proyek'] = $this->m_pembelian->daftar_project();
		$this->load->view('user/leads/upload_bq', $this->data);
	}
 public function importExcel(){

 		$kode = $this->input->post('kode');
 		$jenis_rap = $this->input->post('jenis_rap');
 		$project = $this->input->post('project');
        $fileName = $_FILES['file']['name'];
          
        $config['upload_path'] = './img/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze
 
        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);
          
        if(! $this->upload->do_upload('file') ){
         $this->session->set_flashdata('error', ' Terjadi Kesalahan !');
				 redirect('user/leads/upload_bq');
        }
        $this->load->helper("file");

        $inputFileName = './img/'.$fileName;
 
        try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
 
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);   
 
                 // Sesuaikan key array dengan nama kolom di database                                                         
                 $data = array(
                    "deskripsi_rap"=> $rowData[0][0],
                    "spesifikasi_rap"=> $rowData[0][1],
                    "jumlah_rap"=> $rowData[0][2],
                    "satuan_rap"=> $rowData[0][3],
                    "harga_rab"=> $rowData[0][4],
                    "total"=> $rowData[0][5],
                    "sisa_total"=> $rowData[0][6] * $rowData[0][2],
                    "harga_rap"=> $rowData[0][6],
                    "kode_rap"=> $kode,
                    "proyek_rap"=> $project,
                    "jenis_rap"=> $jenis_rap,
                    "total_rap"=> $rowData[0][2] * $rowData[0][6]
                    
                );
 
                $insert = $this->db->insert("tbl_rap",$data);
                      
            }
            if($insert){
            	$filePath = './img/' . $fileName;
           
            	unlink($filePath);

				$this->session->set_flashdata('success', 'Data Berhasil di Import ke Database !');
				redirect('user/leads/rab/'.$project); //redirect page
			}else{
				$this->session->set_flashdata('error', ' Terjadi Kesalahan !');
				 redirect('user/leads/upload_bq');
			}
    
    }

   	public function rab($id_lsp){ 
		
	//	$this->data['all_leads'] = $this->m_leads->lihat_id($id_lsp);
   		$this->data['leads'] = $this->m_leads->lihat_proyekid_rab($id_lsp);
		$this->data['title'] = 'RAB - '.$this->data['leads']->nama_project;
		$this->data['no'] = 1;
		$this->data['nooo'] = 1;
		
	    $id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 

	    $this->data['all_rab_info'] = $this->m_leads->lihat_jenis_rab();
	        // get all department info and designation info
	        foreach ($this->data['all_rab_info'] as $v_dept_info) {
	            $this->data['all_subrab_info'][] = $this->m_leads->get_rab_by_id($v_dept_info->nama_rab,$id_lsp);
	        }

	    $this->data['pilih_rap'] = $this->m_leads->get_rab_jenis();
		$this->load->view('user/leads/rab', $this->data);
		}

	public function update_rap(){
		date_default_timezone_set('Asia/Jakarta');

		$data_rab['deskripsi_rap'] = $this->input->post('deskripsi_rap');
        $data_rab['spesifikasi_rap'] = $this->input->post('spesifikasi_rap');
        $data_rab['jumlah_rap'] = $this->input->post('jumlah_rap');
        $data_rab['satuan_rap'] = $this->input->post('satuan_rap');
        $data_rab['harga_rab'] = $this->input->post('harga_rab');
        $data_rab['harga_rap'] = $this->input->post('harga_rap');

		$data_rab['total'] = $this->input->post('jumlah_rap') * $this->input->post('harga_rab');
		$data_rab['no_rap'] = $this->input->post('no_rap');
		$data_rab['jenis_rap'] = $this->input->post('jenis_rap');

		$id_proyek = $this->input->post('proyek_rap');

      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        if($this->m_leads->save_rab_update($data_rab)){
            $data['user'] = $this->session->login['nama']; // not array
			$data['waktu'] = date('Y-m-d H:i:s'); // not array
			$nama =  $this->input->post('nama_project');
			$keterangan =  'Ubah RaB';
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('no_rap');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
        redirect('user/leads/rab/'.$id_proyek); //redirect page
        }else{
     //  $this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Diubah!');
       $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
       redirect('user/leads/rab/'.$id_proyek); //redirect page

        }
	}
	public function simpan_rap(){
		date_default_timezone_set('Asia/Jakarta');

		$data_rab['proyek_rap'] = $this->input->post('id_project');
		$data_rab['deskripsi_rap'] = $this->input->post('deskripsi_rap');
        $data_rab['spesifikasi_rap'] = $this->input->post('spesifikasi_rap');
        $data_rab['jumlah_rap'] = $this->input->post('jumlah_rap');
        $data_rab['satuan_rap'] = $this->input->post('satuan_rap');
        $data_rab['harga_rab'] = $this->input->post('harga_rab');
        $data_rab['harga_rap'] = $this->input->post('harga_rap');

		$data_rab['total'] = $this->input->post('jumlah_rap') * $this->input->post('harga_rab');
		$data_rab['total_rap'] = $this->input->post('jumlah_rap') * $this->input->post('harga_rap');
		$data_rab['sisa_total'] = $this->input->post('jumlah_rap') * $this->input->post('harga_rap');
		$data_rab['no_rap'] = $this->input->post('no_rap');
		$data_rab['jenis_rap'] = $this->input->post('jenis_rap');

		$id_proyek = $this->input->post('id_project');

      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;
		$insert = $this->db->insert("tbl_rap",$data_rab);
        if($insert){
            $data['user'] = $this->session->login['nama']; // not array
			$data['waktu'] = date('Y-m-d H:i:s'); // not array
			$nama =  $this->input->post('id_project');
			$keterangan =  'Tambah List RAB';
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_project');
			$this->m_leads->tambah_log($data); //simpan ke tabel log

       $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
        redirect('user/leads/rab/'.$id_proyek); //redirect page
        }else{
     //  $this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Diubah!');
       $this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
       redirect('user/leads/rab/'.$id_proyek); //redirect page

        }
	}
	public function hapus_rab_ByID(){
			date_default_timezone_set('Asia/Jakarta');
			$no_rap = $this->input->post('no_rap');
			$id_proyek = $this->input->post('proyek_rap');
		if($this->m_leads->hapus_rab_ByID($no_rap)){
			$this->session->set_flashdata('success', 'RaB ID ' . $no_rap . ' <strong>Berhasil</strong> Dihapus!');
			redirect('user/leads/rab/'.$id_proyek);
		} else {
			$this->session->set_flashdata('error', 'RaB <strong>Gagal</strong> Dihapus!');
			redirect('user/leads/rab/'.$id_proyek);
		}
	}
}