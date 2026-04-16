<?php

use Dompdf\Dompdf;

class Karyawan extends CI_Controller{
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
		$this->data['aktif'] = 'Employee';
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_setting', 'm_setting');
		$this->load->model('M_asset', 'm_asset');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('Fullcalendar_model', 'm_calendar');
		$this->load->helper(array('form', 'url'));
	}

	public function lihat_semua($EmployeeID = NULL){
		$this->data['title'] = 'KARYAWAN USER';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;
   //	$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();
	//	$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
	//	$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
	//	$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
	//	$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_employee'] = $this->m_karyawan->view_karyawan_all($EmployeeID);  

		$this->load->view('karyawan/lihat', $this->data); 
	}


	public function detail($id){
		$this->data['title'] = 'Profil User';  
		$this->data['emp'] = $this->m_karyawan->view_profile($id);
		$this->load->view('karyawan/details', $this->data);
	}

	public function lihat_filter($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;


	//	$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
	//	$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
	//	$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
	//	$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_karyawan->view_mom_filter($id_lsp); 

		$this->load->view('karyawan/lihat', $this->data);
	}

	public function lihat_filter_goal($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;

   	//$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_karyawan->view_mom_all_goal_fillter($id_lsp); 

		$this->load->view('karyawan/lihat_goal', $this->data);
	}

	   public function export_excel(){  
           $this->data = array( 'title' => 'DATA KARYAWAN AKTIF',
                'emp' => $this->m_karyawan->view_karyawan_all());

        		$this->load->view('karyawan/employee_excel', $this->data); 
    }
	public function lihat_user($EmployeeID = NULL){
		$this->data['title'] = 'User Login ';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;

   //	$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_employee'] = $this->m_karyawan->view_user_login($EmployeeID); 

		$this->load->view('karyawan/lihat_user', $this->data); 
	}
		public function lihat_semua_nonaktif($EmployeeID = NULL){
		$this->data['title'] = 'KARYAWAN NON-AKTIF CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;

   //	$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
    $this->data['all_employee'] = $this->m_karyawan->view_karyawan_all_non($EmployeeID); 

		$this->load->view('karyawan/lihat', $this->data); 
	}
	public function lihat_semua_goal($id_lsp = NULL){
		$this->data['title'] = 'Data M O M Project';
		//$this->data['all_Mom'] = $this->m_karyawan->lihat();
		$this->data['no'] = 1;

   	$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

    $id_lsp = $this->input->post('id_lsp');
    $this->data['all_Mom'] = $this->m_karyawan->view_mom_all_goal($id_lsp); 

		$this->load->view('karyawan/lihat_goal', $this->data);
	}
	public function tambah($id = NULL){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
		
		// Ambil nomor urut terakhir
    $nourut = $this->m_karyawan->cekkodeemployee();
    if (!$nourut) $nourut = 0; // jika belum ada data

    $kodenikSekarang = $nourut + 1; // nomor urut baru

    $this->data['kode_nik'] = $kodenikSekarang;


		$this->data['spv'] = $this->m_karyawan->get_atasan()->result();

		$all_dept_info = $this->m_karyawan->get3();
        // get all department info and designation info
        foreach ($all_dept_info as $v_dept_info) {
           $this->data['all_department_info'][$v_dept_info->department] = $this->m_karyawan->get_add_department_by_id($v_dept_info->id_dept);
        }

		$this->data['all_status_mom'] = $this->m_karyawan->get3();
		$this->data['title'] = 'DATA USER';
		$this->load->view('karyawan/tambah', $this->data);
	}

public function ubah($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		$this->data['spv'] = $this->m_karyawan->get_atasan()->result();
			$all_dept_info = $this->m_karyawan->get3();
        // get all department info and designation info
        foreach ($all_dept_info as $v_dept_info) {
           $this->data['all_department_info'][$v_dept_info->department] = $this->m_karyawan->get_add_department_by_id($v_dept_info->id_dept);
        }
		$this->data['title'] = 'Ubah Data Karyawan';
		$this->data['emp'] = $this->m_karyawan->view_profile($id); 
	//	$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
	//	$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
	//	$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
	//	$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		
		$this->load->view('karyawan/ubah', $this->data);
	}
	

	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
			}

		date_default_timezone_set('Asia/Jakarta');

		if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/foto_karyawan';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 5000;
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

			$atdnc_data['foto'] = $this->upload->data("file_name");
			$atdnc_data['ukuran_berkas'] = $this->upload->data('full_path');

}
			$atdnc_data['nama_karyawan'] = $this->input->post('nama_karyawan');
		//	$atdnc_data['gender'] = $this->input->post('gender');
      	//	$atdnc_data['nomor_ktp'] = $this->input->post('nomor_ktp');
      	//	$atdnc_data['ulang_tahun'] = $this->input->post('ulang_tahun');
		//	$atdnc_data['status_kawin'] = $this->input->post('status_kawin');
      	//	$atdnc_data['email'] = $this->input->post('email');
      	//	$atdnc_data['no_telp1'] = $this->input->post('no_telp1');
		//	$atdnc_data['no_telp2'] = $this->input->post('no_telp2');

		//	$atdnc_data['no_telp_darurat'] = $this->input->post('no_telp_darurat');
		//	$atdnc_data['hubungan'] = $this->input->post('hubungan');

		//	$Emailkantor = $this->input->post('email_kantor');
		//	$buntutemail = $this->input->post('buntut_email');
       // 	$atdnc_data['email_kantor'] = $Emailkantor.''.$buntutemail;

      	$palanik = $this->input->post('EmployeeID');
      	$buntutnik = $this->input->post('buntut_nik');
			$atdnc_data['EmployeeID'] = $palanik.''.$buntutnik;



      //	$atdnc_data['nomor_ktp'] = $this->input->post('nomor_ktp');
      //	$atdnc_data['alamat_ktp'] = $this->input->post('alamat_ktp');
		//	$atdnc_data['alamat_domisili'] = $this->input->post('alamat_domisili');
      //	$atdnc_data['bank'] = $this->input->post('bank');
      //	$atdnc_data['ats_nama'] = $this->input->post('ats_nama');
		//	$atdnc_data['no_rek'] = $this->input->post('no_rek');
      //	$atdnc_data['bpjs_kes'] = $this->input->post('bpjs_kes');
      //	$atdnc_data['bpjs_ket'] = $this->input->post('bpjs_ket');
      //	$atdnc_data['npwp'] = $this->input->post('npwp');
      //	$atdnc_data['tgl_bergabung'] = $this->input->post('tgl_bergabung');
		//	$atdnc_data['perjanjian_kerja'] = $this->input->post('perjanjian_kerja');

      	$atdnc_data['divisi'] = $this->input->post('divisi');
		//	$atdnc_data['supervisorID'] = $this->input->post('supervisorID');
      //	$atdnc_data['akhir_kerja'] = $this->input->post('akhir_kerja');

      	// $atdnc_data['Active'] = $this->input->post('Active');
      	//$atdnc_data['resign_date'] = $this->input->post('resign_date');
      	//$atdnc_data['alasan_resign'] = $this->input->post('alasan_resign');

      	$atdnc_data['createdby'] = $this->input->post('createdby');
      	$atdnc_data['createdtime'] = $this->input->post('createdtime');
      	$atdnc_data['updateby'] = $this->input->post('updateby');
      	$atdnc_data['updatetime'] = $this->input->post('updatetime');
			$this->m_karyawan->save_project($atdnc_data);

			//data untuk log
      		$data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_karyawan');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $palanik.''.$buntutnik;

			$this->m_karyawan->tambah_log($data); //simpan ke tabel log

			//tambah user login
      	$atdnc_login['kode'] = $palanik.''.$buntutnik;
      	$atdnc_login['nama'] = $this->input->post('nama_karyawan');
      	$atdnc_login['username'] = $this->input->post('username');
        
        // Hash password
    $password = 'alba123';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $atdnc_login['password'] = $hashed_password;


      	//$atdnc_login['password'] = 'alba123';
			$this->m_karyawan->save_employee_login($atdnc_login);

			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Karyawan  <strong>Berhasil</strong> Ditambahkan!');
			redirect('karyawan/lihat_semua');
		
	
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		public function proses_update(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}


if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/foto_karyawan';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 5000;
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

			$atdnc_data['foto'] = $this->upload->data("file_name");
			$atdnc_data['ukuran_berkas'] = $this->upload->data('full_path');

}
			$atdnc_data['nama_karyawan'] = $this->input->post('nama_karyawan');
			$atdnc_data['gender'] = $this->input->post('gender');
      	$atdnc_data['nomor_ktp'] = $this->input->post('nomor_ktp');
      	$atdnc_data['ulang_tahun'] = $this->input->post('ulang_tahun');
			$atdnc_data['status_kawin'] = $this->input->post('status_kawin');
      	$atdnc_data['email'] = $this->input->post('email');
      	$atdnc_data['email_kantor'] = $this->input->post('email_kantor');
      	$atdnc_data['no_telp1'] = $this->input->post('no_telp1');
			$atdnc_data['no_telp2'] = $this->input->post('no_telp2');
			$atdnc_data['no_telp_darurat'] = $this->input->post('no_telp_darurat');
			$atdnc_data['hubungan'] = $this->input->post('hubungan');
      	$atdnc_data['nomor_ktp'] = $this->input->post('nomor_ktp');
      	$atdnc_data['alamat_ktp'] = $this->input->post('alamat_ktp');
			$atdnc_data['alamat_domisili'] = $this->input->post('alamat_domisili');
      	$atdnc_data['bank'] = $this->input->post('bank');
      	$atdnc_data['ats_nama'] = $this->input->post('ats_nama');
			$atdnc_data['no_rek'] = $this->input->post('no_rek');
      	$atdnc_data['bpjs_kes'] = $this->input->post('bpjs_kes');
      	$atdnc_data['bpjs_ket'] = $this->input->post('bpjs_ket');
      	$atdnc_data['npwp'] = $this->input->post('npwp');
      	$atdnc_data['tgl_bergabung'] = $this->input->post('tgl_bergabung');
			$atdnc_data['perjanjian_kerja'] = $this->input->post('perjanjian_kerja');
      	$atdnc_data['EmployeeID'] = $this->input->post('EmployeeID');
      	$atdnc_data['divisi'] = $this->input->post('divisi');
			$atdnc_data['supervisorID'] = $this->input->post('supervisorID');
      	$atdnc_data['akhir_kerja'] = $this->input->post('akhir_kerja');

      	$atdnc_data['Active'] = $this->input->post('Active');
      	$atdnc_data['resign_date'] = $this->input->post('resign_date');
      	$atdnc_data['alasan_resign'] = $this->input->post('alasan_resign');

      	$atdnc_data['updateby'] = $this->input->post('updateby');
      	$atdnc_data['updatetime'] = $this->input->post('updatetime');

			$this->m_karyawan->save_project($atdnc_data);
			//untuk log
      	$data['user'] = $this->input->post('user');
			$data['waktu'] = $this->input->post('waktu');
			$nama =  $this->input->post('nama_karyawan');
			$keterangan =  $this->input->post('ket');
			$data['ket'] = $keterangan.' '.$nama;
			$data['kode'] = $this->input->post('EmployeeID');
			$this->m_karyawan->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Karyawan <strong>Berhasil</strong> Ditambahkan!');
			redirect('karyawan/lihat_semua');
		
	
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	public function simpan_berkas(){
		if ($this->session->login['role'] !== 'admin'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}


		$config['upload_path']          = './img/uploads/doc_karyawan';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
		$config['max_size']             = 5000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		// $file1 = $this->upload->data();
		 //       echo '<pre>';
       // print_r ($_POST);
       // echo '</pre>';
      // exit;
if (!empty($_FILES['berkas_cv']['name'])) {
			$this->upload->do_upload('berkas_cv');
			$atdnc_data['berkas_cv'] = $this->upload->data("file_name");
		}
if (!empty($_FILES['berkas_ktp']['name'])) {
			$this->upload->do_upload('berkas_ktp');
			$atdnc_data['berkas_ktp'] = $this->upload->data("file_name");
		}
if (!empty($_FILES['berkas_kk']['name'])) {
			$this->upload->do_upload('berkas_kk');
			$atdnc_data['berkas_kk'] = $this->upload->data("file_name");
		}
if (!empty($_FILES['berkas_ijazah']['name'])) {
			$this->upload->do_upload('berkas_ijazah');
			$atdnc_data['berkas_ijazah'] = $this->upload->data("file_name");
}
if (!empty($_FILES['berkas_perjanjian1']['name'])) {
			$this->upload->do_upload('berkas_perjanjian1');
			$atdnc_data['berkas_perjanjian1'] = $this->upload->data("file_name");
}
if (!empty($_FILES['berkas_perjanjian2']['name'])) {
			$this->upload->do_upload('berkas_perjanjian2');
			$atdnc_data['berkas_perjanjian2'] = $this->upload->data("file_name");
}
if (!empty($_FILES['berkas_perjanjian3']['name'])) {
			$this->upload->do_upload('berkas_perjanjian3');
			$atdnc_data['berkas_perjanjian3'] = $this->upload->data("file_name");
}
			$userid = $this->input->post('userid');
      	$atdnc_data['EmployeeID'] = $this->input->post('EmployeeID');
			$this->m_karyawan->save_doc($atdnc_data);


			$this->session->set_flashdata('error', 'Data Karyawan <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Karyawan  <strong>Berhasil</strong> Ditambahkan!');
			redirect(base_url()."karyawan/detail/".$userid);
	
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	public function simpan_asset(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
			$atdnc['status'] = 'TERPAKAI';
			$atdnc['kode_asset'] = $this->input->post('kode_asset');
			$this->m_karyawan->update_asset_terpakai($atdnc);

			$atdnc_data['kd_transaksi'] = $this->input->post('kd_transaksi');
			$atdnc_data['EmployeeID'] = $this->input->post('EmployeeID');
      	$atdnc_data['kode_asset'] = $this->input->post('kode_asset');
      	$atdnc_data['createdtime'] = $this->input->post('createdtime');
			$atdnc_data['createdby'] = $this->input->post('createdby');
			$this->m_karyawan->save_inventaris($atdnc_data);

			$userid = $this->input->post('userid', TRUE);
			$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
			redirect(base_url()."karyawan/detail/".$userid);
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}

		public function ubah_password(){
			// Ambil data dari form
            $kode = $this->input->post('kode');
            $username = $this->input->post('username');
            $new_password = $this->input->post('password');

			//$atdnc_data['kode'] = $this->input->post('kode');
			//$atdnc_data['username'] = $this->input->post('username');
			//$atdnc_data['password'] = $this->input->post('password');
      //	$atdnc_data['updateby'] = $this->input->post('updateby');
      //	$atdnc_data['updatetime'] = $this->input->post('updatetime');

			// Hash password baru sebelum menyimpan ke database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Data yang akan disimpan ke tabel employee_login
            $atdnc_data = [
            'kode' => $kode,
            'username' => $username,
            'password' => $hashed_password,
        ];

      	$this->m_karyawan->save_user_login($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->input->post('updateby');
			$data['waktu'] = $this->input->post('updatetime');

			$data['ket'] = $this->input->post('ket');
			$data['kode'] = $this->input->post('kode');
			$this->m_karyawan->tambah_log($data); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diubah!');
			redirect('karyawan/lihat_user');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
    public function save_mom($id = NULL) { 
        
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

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

        if ($data['status'] == 1 OR $data['status'] == 2 OR $data['status'] == 3 OR $data['status'] == 4 OR $data['status'] == 5 ) {
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->tambah($data);
                
        }

        if ($data['status'] == 6) {

        $data['status_berjalan'] = 2;
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_karyawan->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_karyawan->save_mom_tidak_goal($atdnc_data);        
        }

        if ($data['status'] == 7) {

        $data['status_berjalan'] = 2;
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_karyawan->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_karyawan->save_mom_goal($atdnc_data);        
        }

       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('karyawan/lihat_semua'); //redirect page
    }

       public function update_mom($id = NULL) { 
        $id = $this->input->post('id');
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

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

        if ($data['status'] == 1 OR $data['status'] == 2 OR $data['status'] == 3 OR $data['status'] == 4 OR $data['status'] == 5 ) {
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->ubah4($data,$id);
                
        }

        if ($data['status'] == 6) {

        $data['status_berjalan'] = 2;
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_karyawan->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_karyawan->save_mom_tidak_goal($atdnc_data);        
        }

        if ($data['status'] == 7) {

        $data['status_berjalan'] = 2;
        $this->m_karyawan->_table_name = "cassa_mom"; // table name
        $this->m_karyawan->tambah($data);

        $id_mom = $this->input->post('id_mom');
        $atdnc_data2['status_berjalan'] = 2;
        $this->m_karyawan->ubah111($atdnc_data2,$id_mom); //update status berjalan jika proyek goal & tidak akan tampil pada list m o m  berjalan

        $atdnc_data['id_mom'] = $this->input->post('id_mom');
        $this->m_karyawan->save_mom_goal($atdnc_data);        
        }

       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('karyawan/lihat_semua'); //redirect page
    }

	public function edit2_mom($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		$this->data['all_status_mom'] = $this->m_karyawan->get3();
		//$this->data['all_leads_project'] = $this->m_karyawan->get_lsp();

		$this->data['title'] = 'Ubah Mom Project';
		$this->data['leads'] = $this->m_karyawan->lihat_id($id);

		$this->load->view('karyawan/ubah_tambah', $this->data);
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
      //  echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
      //  exit;

        $this->m_karyawan->save_project($atdnc_data);
        
       	$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Mom Project <strong>Berhasil</strong> Diubah!');
        redirect('karyawan'); //redirect page
		
	}
	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

			date_default_timezone_set('Asia/Jakarta');
		  	$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Karyawan';
			$data['kode'] = $id;
			$this->m_asset->tambah_log($data); //simpan ke tabel jenis izin

		if($this->m_karyawan->hapus($id)){
			$this->session->set_flashdata('success', 'Data Mom <strong>Berhasil</strong> Dihapus!');
			redirect('karyawan/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Data Mom <strong>Gagal</strong> Dihapus!');
			redirect('karyawan');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_karyawan->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



}