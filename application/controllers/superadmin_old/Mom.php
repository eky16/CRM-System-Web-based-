<?php

use Dompdf\Dompdf;

class Mom extends CI_Controller{
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
		$this->data['aktif'] = 'mom';
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('m_mom', 'm_mom');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;


		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_filter($id_lsp); 

		$this->load->view('mom/lihat', $this->data);
	}
	public function detail($id){
		$this->data['title'] = 'Data Leads Project';
		$this->data['details'] = $this->m_mom->view_mom_details($id); 
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('mom/details', $this->data);
	}

	public function detail_laporan($id){
		$this->data['title'] = 'Laporan Proyek';
		$this->data['details'] = $this->m_mom->detail_report_proyek($id); 
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('mom/detail_laporan', $this->data);
	}


	public function lihat_filter($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_filter($id_lsp); 

		$this->load->view('mom/lihat', $this->data);
	}


	public function laporan_proyek($id_lsp = NULL){
		$this->data['aktif'] = 'laporan_proyek';
		$this->data['title'] = 'Laporan Proyek';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['kode_lap'] = $this->m_mom->kode_laporan_proyek();

    	$id_lsp = $this->input->post('id_lsp');
    	$this->data['all_Mom'] = $this->m_mom->view_report_proyek(); 

		$this->load->view('mom/laporan_proyek', $this->data);
	}



	public function lihat_filter_goal($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_all_goal_fillter($id_lsp); 

		$this->load->view('mom/lihat_goal', $this->data);
	}
	public function lihat_semua($id_lsp = NULL){ 
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_all($id_lsp); 
	$this->data['isi'] = $this->m_sop->lihat_06(); //tampilkan sop menu
		$this->load->view('mom/lihat', $this->data); 
	}
	public function lihat_semua_goal($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_all_goal($id_lsp); 

		$this->load->view('mom/lihat_goal', $this->data); 
	}

		public function lihat_nogoal($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_mom->view_mom_no_goal($id_lsp); 

		$this->load->view('mom/lihat_goal', $this->data);
	}



	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
		$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('nama_project');
        $atdnc_data['alamat_project'] = $this->input->post('alamat_project');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['createdby'] = $this->input->post('createdby');
        $atdnc_data['createdtime'] = $this->input->post('createdtime');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;
      $data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('agenda');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('id_mom');
			$this->m_mom->tambah_log($data); //simpan ke tabel lo
        $this->m_mom->save_project($atdnc_data);
        
       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('mom'); //redirect page
		
	}
	  public function save_laporan($id = NULL) { 
        
        if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['berkas'] = $this->upload->data("file_name");

}
		$data['kode_lap'] = $this->input->post('kode_lap');
        $data['id_lsp'] = $this->input->post('id_lsp'); 
		$data['keterangan_proyek'] = $this->input->post('keterangan_proyek');
		$data['tgl_laporan'] = $this->input->post('tgl_laporan');
        $data['createdby'] = $this->input->post('createdby');
        $data['createdtime'] = $this->input->post('createdtime');
    	$this->m_mom->tambah_laporan($data);
			//untuk log
      		$data_log['user'] = $this->input->post('createdby');
			$data_log['waktu'] = $this->input->post('createdtime');
			$nama =  $this->input->post('id_lsp');
			$keterangan =  $this->input->post('ket');
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('kode_lap');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Laporan <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Laporan Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('mom/laporan_proyek'); //redirect page
    }


    public function save_mom($id = NULL) { 
        
        if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/foto_karyawan';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['berkas'] = $this->upload->data("file_name");

}
		$data['kode_tag'] = $this->input->post('kode_tag');
        $data['id_mom'] = $this->input->post('id_mom');
        $data['id_lsp'] = $this->input->post('id_lsp');
        $data['tanggal'] = $this->input->post('tanggal');
        $data['lokasi'] = $this->input->post('lokasi');
        $data['partisipasi'] = $this->input->post('partisipasi');
        $data['agenda'] = $this->input->post('agenda');
        $data['diskusi'] = $this->input->post('diskusi');
        $data['status'] = $this->input->post('status');
        $data['createdby'] = $this->input->post('createdby');
        $data['entrytime'] = $this->input->post('entrytime');

			//untuk log
      		$data_log['user'] = $this->input->post('user');
			$data_log['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('agenda');
			$keterangan =  $this->input->post('ket');
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('id_mom');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

		//simpan tag
		$kode_tag = $this->input->post('kode_tag',TRUE);
		$EmployeeID = $this->input->post('EmployeeID',TRUE);
		$this->m_mom->create_tag($kode_tag,$EmployeeID);
        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

        if ($data['status'] == 1 OR $data['status'] == 2 OR $data['status'] == 3 OR $data['status'] == 4 OR $data['status'] == 5 ) {
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->tambah($data);
                
        }

        if ($data['status'] == 6) {

        $data['status_berjalan'] = 2;
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_mom->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_mom->save_mom_tidak_goal($atdnc_data);        
        }

        if ($data['status'] == 7) {

        $data['status_berjalan'] = 2;
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2; 
        $this->m_mom->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_mom->save_mom_goal($atdnc_data);        
        }



       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('mom/lihat_semua'); //redirect page
    }

       public function update_mom($id = NULL) { 
        $id = $this->input->post('id');

        if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/foto_karyawan';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 10000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		 $file1 = $this->upload->data();
		//    echo '<pre>';
     //   print_r ($file1);
     //   echo '</pre>';
     //   exit;

		$data['berkas'] = $this->upload->data("file_name");

}
        
        $data['id_mom'] = $this->input->post('id_mom');
        $data['id_lsp'] = $this->input->post('id_lsp');
        $data['tanggal'] = $this->input->post('tanggal');
        $data['lokasi'] = $this->input->post('lokasi');
        $data['partisipasi'] = $this->input->post('partisipasi');
        $data['agenda'] = $this->input->post('agenda');
        $data['diskusi'] = $this->input->post('diskusi');
        $data['status'] = $this->input->post('status');
        $data['createdby'] = $this->input->post('createdby');
        $data['entrytime'] = $this->input->post('entrytime');

      $data_log['user'] = $this->input->post('user');
			$data_log['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('agenda');
			$keterangan =  $this->input->post('ket');
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('id_mom');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log
        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

        if ($data['status'] == 1 OR $data['status'] == 2 OR $data['status'] == 3 OR $data['status'] == 4 OR $data['status'] == 5 ) {
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->ubah4($data,$id);
                
        }

        if ($data['status'] == 6) {

        $data['status_berjalan'] = 2;
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_mom->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_mom->save_mom_tidak_goal($atdnc_data);        
        }

        if ($data['status'] == 7) {

        $data['status_berjalan'] = 2;
        $this->m_mom->_table_name = "cassa_mom"; // table name
        $this->m_mom->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_mom->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_mom->save_mom_goal($atdnc_data);        
        }

       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('mom/lihat_semua'); //redirect page
    }
	public function ubah($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		$this->data['all_status_mom'] = $this->m_mom->get3();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['title'] = 'Ubah Mom Project';
		$this->data['leads'] = $this->m_mom->view_mom_details($id);
		$this->data['employee'] = $this->m_mom->get_employee();
		
		$this->load->view('mom/ubah', $this->data);
	}

		public function tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		} 
				$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['employee'] = $this->m_mom->get_employee();
		$this->data['all_status_mom'] = $this->m_mom->get3();
		$this->data['all_leads_project'] = $this->m_mom->get_leads();
		$this->data['title'] = 'Tambah M O M Project';
		$this->data['kode_momproject'] = $this->m_mom->kode_momproject();
		$this->data['kode_tag'] = $this->m_mom->kode_tag();
		$this->load->view('mom/tambah', $this->data);
	}
		
		public function tambah_laporanproyek(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
				$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['employee'] = $this->m_mom->get_employee();
		$this->data['all_status_mom'] = $this->m_mom->get3();
		$this->data['all_leads_project'] = $this->m_mom->get_leads();
		$this->data['title'] = 'Tambah M O M Project';
		$this->data['kode_momproject'] = $this->m_mom->kode_momproject();
		$this->data['kode_tag'] = $this->m_mom->kode_tag();
		$this->load->view('mom/tambah_laporan', $this->data);
	}

			public function tambah_laporan_proyek(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
				$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['employee'] = $this->m_mom->get_employee();
		$this->data['all_status_mom'] = $this->m_mom->get3();
		$this->data['all_leads_project'] = $this->m_mom->get_leads();
		$this->data['title'] = 'Tambah M O M Project';
		$this->data['kode_momproject'] = $this->m_mom->kode_momproject();
		$this->data['kode_tag'] = $this->m_mom->kode_tag();
		$this->load->view('mom/tambah', $this->data);
	}
	public function edit2_mom($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		$this->data['all_status_mom'] = $this->m_mom->get3();
		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['title'] = 'Ubah Mom Project';
		$this->data['leads'] = $this->m_mom->lihat_id($id);

		$this->load->view('mom/ubah_tambah', $this->data);
	}


	public function proses_ubah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
		$atdnc_data['id_lsp'] = $this->input->post('id_lsp');
        $atdnc_data['nama_pic'] = $this->input->post('nama_pic');
        $atdnc_data['no_telp'] = $this->input->post('no_telp');
        $atdnc_data['email'] = $this->input->post('email');
        $atdnc_data['nama_project'] = $this->input->post('nama_project');
        $atdnc_data['alamat_project'] = $this->input->post('alamat_project');
        $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
        $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
        $atdnc_data['updateby'] = $this->input->post('updateby');
        $atdnc_data['updatetime'] = $this->input->post('updatetime');
      $data_log['user'] = $this->input->post('user');
			$data_log['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('agenda');
			$keterangan =  $this->input->post('ket');
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('id_mom');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_mom->save_project($atdnc_data);
        
       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Diubah!');
        redirect('mom'); //redirect page
		
	}
	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		} 
				date_default_timezone_set('Asia/Jakarta');
		  $data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Asset';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

		if($this->m_mom->hapus($id)){
			$this->session->set_flashdata('success', 'Data Mom <strong>Berhasil</strong> Dihapus!');
			redirect('mom/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Dihapus!');
			redirect('mom');
		}
	}

	public function hapus_laporan($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		} 
				date_default_timezone_set('Asia/Jakarta');
		  $data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Laporan Proyek';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

		if($this->m_mom->hapus_laporan_proyek($id)){
			$this->session->set_flashdata('success', 'Laporan Proyek <strong>Berhasil</strong> Dihapus!');
			redirect('mom/laporan_proyek');
		} else {
			$this->session->set_flashdata('error', 'Laporan Proyek<strong>Gagal</strong> Dihapus!');
			redirect('mom/laporan_proyek');
		}
	}

	public function export($id){ 
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_mom->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



}