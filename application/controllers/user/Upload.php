<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_sop', 'm_sop');
		$this->load->model('M_asset', 'm_asset');

	}
	function create()
	{
		$this->load->view('user/mod_kerja/ubah_proses');
	}

	function proses()
	{
		$id = $this->input->post('kode_modul',TRUE); 
	//	$this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

		$config['upload_path']          = './img/uploads/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
		$config['max_size']             = 20000;
		$config['max_width']            = 2048;
		$config['max_height']           = 1000;
		$config['encrypt_name'] 		= true;
		$this->load->library('upload',$config);

		
		$idnya = $this->input->post('kode_modulnya',TRUE);
		$id_sub = $this->input->post('id_sub',TRUE);
		$tugas = $this->input->post('tugas',TRUE);
		$status_tugas = $this->input->post('status_tugas',TRUE);
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
					$data['berkas_file'] = $uploadData['file_name'];
	//	echo '<pre>';
   //    print_r ($_POST);
    //    print_r ($uploadData);
    //   echo '</pre>';
     //   exit;
				
			}		
					$data['kode_modul'] = $idnya[$i];
					$data['tugas'] = $tugas[$i];
					$data['id_sub'] = $id_sub[$i];
					$data['status_tugas'] = $status_tugas[$i];
				//	$data['tipe_berkas'] = $uploadData['file_ext'];
				//	$data['ukuran_berkas'] = $uploadData['file_size'];
					//$this->db->insert('modul_kerja_sub',$data);
					$this->m_kerja->dadadada($data);
		}
		
		date_default_timezone_set('Asia/Jakarta');
		$atdnc_data['kode_modul'] = $this->input->post('kode_modul');
		$atdnc_data['tgl_end_task'] = date('Y-m-d  H:i:s');
		$this->m_kerja->save_end_prosess($atdnc_data);

    $this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Diubah!');
    $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Diubah!');
	redirect('user/mod_kerja/proses');

	}

	public function index()
	{
		$data['berkas'] = $this->db->get('tb_berkas');
		$this->load->view('tampil_berkas',$data);
	}


	function download($id)
	{
		$data = $this->db->get_where('tb_berkas',['kd_berkas'=>$id])->row();
		force_download('uploads/'.$data->nama_berkas,"berkas");
	}
	public function update_berkas_detail_sub(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_dat['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul');
			$atdnc_dat['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_dat['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_dat['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_dat);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Update Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_create');
			$this->m_asset->tambah_log($data); //simpan ke tabel log



		

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		public function update_berkas_detail_sub_kontribut(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_dat['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul');
			$atdnc_dat['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_dat['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_dat['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_dat);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Update Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_create');
			$this->m_asset->tambah_log($data); //simpan ke tabel log



		

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		public function update_berkas_detail_sub_creat(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_dat['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul');
			$atdnc_dat['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_dat['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_dat['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_dat);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Update Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_create');
			$this->m_asset->tambah_log($data); //simpan ke tabel log



		

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_creat/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
	  	public function save_berkas_detail_sub(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kd_modul');
			$atdnc_data['kd_modul'] = $this->input->post('kd_modul');
			$atdnc_data['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_data['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_data['pembuat'] = $this->session->login['nama'];
			$atdnc_data['tgl_created'] = date('Y-m-d');
			$atdnc_data['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Add Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kd_modul');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->session->login['nama'];
			$id_modul = $this->input->post('kd_modul');
			$noted = 'Add detail,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object2);

$cek = $this->input->post('kepada3');
if (!empty($cek)) {
			$kepada3 = $this->input->post('kepada3'); 
          	$object3 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada3,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object3);
}
		

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //kirim notif ke kontributor

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		  	public function save_berkas_detail_sub_creat(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kd_modul');
			$atdnc_data['kd_modul'] = $this->input->post('kd_modul');
			$atdnc_data['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_data['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_data['pembuat'] = $this->session->login['nama'];
			$atdnc_data['tgl_created'] = date('Y-m-d');
			$atdnc_data['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Add Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kd_modul');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->session->login['nama'];
			$id_modul = $this->input->post('kd_modul');
			$noted = 'Add detail,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object2);

$cek = $this->input->post('kepada3');
if (!empty($cek)) {
			$kepada3 = $this->input->post('kepada3'); 
          	$object3 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada3,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object3);
}
		

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //kirim notif ke kontributor

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_creat/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		  	public function save_berkas_detail_sub_kontribut(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kd_modul');
			$atdnc_data['kd_modul'] = $this->input->post('kd_modul');
			$atdnc_data['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_data['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_data['pembuat'] = $this->session->login['nama'];
			$atdnc_data['tgl_created'] = date('Y-m-d');
			$atdnc_data['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Add Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kd_modul');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->session->login['nama'];
			$id_modul = $this->input->post('kd_modul');
			$noted = 'Add detail,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object2);

$cek = $this->input->post('kepada3');
if (!empty($cek)) {
			$kepada3 = $this->input->post('kepada3'); 
          	$object3 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada3,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object3);
}
		

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //kirim notif ke kontributor

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
			   	public function save_berkas_dt_tsk_kontribut(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['berkas'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul_chat');
			$atdnc_data['kode_created'] = $this->input->post('kode_dt_tsk');
			$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
			$atdnc_data['username'] = $firstname.' '. $jabatan;;
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_berkas_dt_tsk($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Upload File Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_chat');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul_chat');
			$noted = 'Add File,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object2);

$cek = $this->input->post('kepada3');
if (!empty($cek)) {
			$kepada3 = $this->input->post('kepada3'); 
          	$object3 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada3,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object3);
}
		

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //kirim notif ke kontributor

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		   	public function save_berkas_dt_tsk(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = '*';
		$config['max_size']             = 20000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload('berkas');
		// $file1 = $this->upload->data();
		//    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

			$atdnc_data['berkas'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul_chat');
			$atdnc_data['kode_created'] = $this->input->post('kode_dt_tsk');
			$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
			$atdnc_data['username'] = $firstname.' '. $jabatan;
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_berkas_dt_tsk($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Upload File Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_chat');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul_chat');
			$noted = 'Add File,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object2);

$cek = $this->input->post('kepada3');
if (!empty($cek)) {
			$kepada3 = $this->input->post('kepada3'); 
          	$object3 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada3,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
          $this->db->insert('tbl_notif', $object3);
}
		

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //kirim notif ke kontributor

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
}
