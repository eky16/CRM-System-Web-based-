<?php

use Dompdf\Dompdf;

class Absensi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == 'karyawan'){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('logout');
		}
		$this->data['aktif'] = 'absensi';
		$this->load->model('M_admin', 'm_admin'); 
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_payment', 'm_payment');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		$this->data['title'] = 'ABSENSI HARIAN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();


		$this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
		$tanggal = $this->input->post('tanggal');
		$this->data['absensi'] = $this->m_admin->absen_hari_ini($tanggal);
		$this->load->view('absensi/lihat', $this->data);
	}
	public function update_kehadiran($id = NULL) { 
    	date_default_timezone_set('Asia/Jakarta');
      //     echo '<pre>';
      //    print_r ($_POST);
      //  echo '</pre>';
     //  print POST
        //print_r($this->db->last_query()); //print query
     //  exit;
     
         
        $EmployeeID = $this->input->post('EmployeeID', TRUE);              
       // $attendance_status = $this->input->post('attendance', TRUE);
       // $leave_category_id = $this->input->post('leave_category_id', TRUE);
      
        	$cek_in = $this->input->post('cek_in', TRUE);
        	$cek_out = $this->input->post('cek_out', TRUE);
  			$id = $this->input->post('id', TRUE);
        
        if (!empty($EmployeeID)) {

            $key = 0;
            foreach ($EmployeeID as $empID) {
                $data['tanggal'] = $this->input->post('tanggal', TRUE);
               // $data['attendance_status'] = 1;
                $data['EmployeeID'] = $empID;
                $data['cek_in'] = $cek_in[$key];
                $data['cek_out'] = $cek_out[$key];
                $id = $id[$key];

                if (!empty($id)) {
                    $this->m_admin->save($data, $id);
                } else {
                    $this->m_admin->save($data, $id);
                }

                $key++;
            }
        } else {
            $key = 0;
            foreach ($EmployeeID as $empID) {
                $data['tanggal'] = $this->input->post('tanggal', TRUE);
                //$data['attendance_status'] = 1;
                $data['EmployeeID'] = $empID;
                $data['cek_in'] = $cek_in[$key];
                $data['cek_out'] = $cek_out[$key];
                $this->m_admin->save($data);
                $key++;
            }
        }

//	$lokasi = $this->input->post('lokasi'); //  array
//	$lokasi_cekout = $this->input->post('lokasi_cekout'); //  array
     if(!empty($EmployeeID) ) {

            $result = array();
                foreach($EmployeeID AS $key => $val){
                     $result[] = array(
                      'EmployeeID'   => $EmployeeID[$key],
                      'cek_in'   => $cek_in[$key],
                      'cek_out'   => $cek_out[$key],
                     //'lokasi'   => $cek_in[$key],
                     //'lokasi_cekout'   => $lokasi_cekout[$key],
                      'tanggal'   => $this->input->post('tanggal', TRUE)
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
      //  $this->db->update_batch('cassa_kehadiran', $result,'tanggal','EmployeeID'); 
     $this->session->set_flashdata('success', 'Kehadiran <strong>Berhasil</strong> Diproses!');
     }
      $this->session->set_flashdata('error', 'Kehadiran <strong>Gagal</strong> Diproses!');
      
        redirect('absensi'); //redirect page
    }
	public function insert_holiday($id_lsp = NULL){
		$this->data['title'] = 'TAMBAH HARI LIBUR';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();


		$this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
		$tanggal = $this->input->post('tanggal');
		$this->data['absensi'] = $this->m_admin->absen_hari_ini($tanggal);
		$this->load->view('absensi/insert_holiday', $this->data);
	}
	public function update_holiday($id = NULL) { 
		date_default_timezone_set('Asia/Jakarta');
        //   echo '<pre>';
       //   print_r ($_POST);
       // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
     //  exit;
    $EmployeeID = $this->input->post('EmployeeID'); //array of id
	$tanggal = $this->input->post('tanggal'); //  array
	if(!empty($tanggal) ) {

		$result = array();
		foreach($EmployeeID AS $key => $val){
			$result[] = array(
				'EmployeeID'   => $EmployeeID[$key],
				'tanggal'   => $tanggal[$key]
			);
		}      
            //MULTIPLE INSERT TO DETAIL TABLE
		$this->db->insert_batch('cassa_kehadiran', $result); 
		$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Diproses!');
	}
	$this->session->set_flashdata('error', 'Data <strong>Gagal</strong> Diproses!');

        redirect('absensi/insert_holiday'); //redirect page
    }
	public function img_view($id){
		$this->data['title'] = 'CASSA DESIGN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;

		$this->data['absensi'] = $this->m_admin->view_foto($id);
		$this->load->view('absensi/img', $this->data);
	}
	public function img_view_out($id){
		$this->data['title'] = 'CASSA DESIGN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;

		$this->data['absensi'] = $this->m_admin->view_foto($id);
		$this->load->view('absensi/img_out', $this->data);
	}

	public function lihat_divisi($id_lsp = NULL){
		$this->data['title'] = 'ABSENSI HARIAN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['all_divisi'] = $this->m_admin->lihat_department();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$dept = $this->input->post('department');
		$this->data['all_absensi'] = $this->m_karyawan->view_karyawan_div($dept);

		$tanggal = $this->input->post('tanggal'); 
		$this->data['absensi'] = $this->m_admin->absen_hari_ini($tanggal);

		$this->load->view('absensi/lihat_divisi', $this->data);
	}
	public function laporan1(){
		$this->data['title'] = 'LAPORAN ABSEN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$date =  $this->input->post('tanggal'); 
        $date1 =  $this->input->post('dan_tanggal');
        $EmployeeID =  $this->input->post('EmployeeID');
        $ket = 'LAPORAN ABSENSI '.$EmployeeID.' DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
        $absensi = $this->m_admin->absen_filter_tanggal($date,$date1,$EmployeeID);  
		$url_cetak = 'absensi/export?filter=1&EmployeeID='.$EmployeeID.'&tanggal='.$date.'&dan_tanggal='.$date1;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['absensi'] = $absensi;

        $this->data['karyawan'] = $this->m_karyawan->get_atasan()->result();
     //   $this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
		//$this->data['all_divisi'] = $this->m_admin->lihat_department();

		//$tanggal = $this->input->post('tanggal');
		

		$this->load->view('absensi/filter_tanggal', $this->data);
	}
	public function laporan3(){
		$this->data['title'] = 'LAPORAN ABSEN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$date =  $this->input->post('tanggal'); 
        $date1 =  $this->input->post('dan_tanggal');
        $this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
        $ket = 'LAPORAN ABSENSI  DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
        $absensi = $this->m_admin->absen_filter_tanggal_all($date,$date1);  
		$url_cetak = 'absensi/export_excel?filter=1&tanggal='.$date.'&dan_tanggal='.$date1;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['absensi'] = $absensi;

        $this->data['karyawan'] = $this->m_karyawan->get_atasan()->result();
     //   $this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
		//$this->data['all_divisi'] = $this->m_admin->lihat_department();

		//$tanggal = $this->input->post('tanggal');
		

		$this->load->view('absensi/filter_tanggal_all', $this->data);
	}
	public function laporan2(){  
		$this->data['title'] = 'LAPORAN ABSEN';
	//	$this->data['absensi'] = $this->m_admin->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$date =  $this->input->post('tanggal'); 
        $date1 =  $this->input->post('dan_tanggal');
        $ket = 'LAPORAN ABSENSI DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
        $absensi = $this->m_admin->sum_attendance($date,$date1);  
		$url_cetak = 'absensi/export2?filter=1&tanggal='.$date.'&dan_tanggal='.$date1;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['absensi'] = $absensi;

        $this->data['karyawan'] = $this->m_karyawan->get_atasan()->result();
     //   $this->data['all_absensi'] = $this->m_karyawan->view_karyawan_all();
		//$this->data['all_divisi'] = $this->m_admin->lihat_department();

		//$tanggal = $this->input->post('tanggal');
		

		$this->load->view('absensi/laporan2', $this->data);
	}
public function export(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];
        
             // Jika filter nya 1 (per tanggal)
                $date = $_GET['tanggal']; 
                $date1 = $_GET['dan_tanggal'];
                $EmployeeID = $_GET['EmployeeID'];
                $ket = 'LAPORAN ABSENSI '.$EmployeeID.' DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
                $url_cetak = 'absensi/cetak7?filter=1&EmployeeID='.$EmployeeID.'&tanggal='.$date.'&dan_tanggal='.$date1;
                $absensi = $this->m_admin->absen_filter_tanggal($date,$date1,$EmployeeID); // Panggil fungsi view_by_date yang ada di TransaksiModel

        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['absensi'] = $absensi;

        $this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('absensi/report', $this->data, true);
        $this->pdf->create($html,$ket);
    }
    public function export2(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];

             // Jika filter nya 1 (per tanggal)
       $date = $_GET['tanggal']; 
       $date1 = $_GET['dan_tanggal'];
       $ket = 'LAPORAN ABSENSI  DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
       $url_cetak = 'absensi/cetak7?filter=1&&tanggal='.$date.'&dan_tanggal='.$date1;
       $absensi = $this->m_admin->sum_attendance($date,$date1); // Panggil fungsi view_by_date yang ada di TransaksiModel

                $this->data['ket'] = $ket;
                $this->data['url_cetak'] = base_url($url_cetak);
                $this->data['absensi'] = $absensi;

        $this->load->library('pdf'); // change to pdf_ssl for ssl
        $filename = $ket;
        $html = $this->load->view('absensi/laporan_pdf2', $this->data, true);
        $this->pdf->create($html,$ket);
    }
    public function export3(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];
        
             // Jika filter nya 1 (per tanggal)
                $date = $_GET['tanggal']; 
                $date1 = $_GET['dan_tanggal'];
                $ket = 'LAPORAN ABSENSI DARI TANGGAL '.date('d-m-Y', strtotime($date)).' SAMPAI '.date('d-m-Y', strtotime($date1));
                $url_cetak = 'absensi/export_excel?filter=1&tanggal='.$date.'&dan_tanggal='.$date1;
                $absensi = $this->m_admin->absen_filter_tanggal_all($date,$date1); // Panggil fungsi view_by_date yang ada di TransaksiModel

        $this->data['ket'] = $ket;
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['absensi'] = $absensi;

        $this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('absensi/report', $this->data, true);
        $this->pdf->create($html,$ket);
    }
    public function export_excel(){  
    	$date = $_GET['tanggal']; 
    	$date1 = $_GET['dan_tanggal'];
    	$this->data = array( 'title' => 'LAPORAN ABSENSI',
    		'absensi' => $this->m_admin->absen_filter_tanggal_all($date,$date1));

    	$this->load->view('absensi/absensi_excel', $this->data); 
    }
	public function detail($id_asset){
		$this->data['title'] = 'Profil Asset';
		$this->data['asst'] = $this->m_admin->lihat_id($id_asset);

		$this->load->view('asset/details', $this->data);
	}

	public function lihat_filter($id_lsp = NULL){
		$this->data['title'] = 'DATA ASSET';
		//$this->data['all_Mom'] = $this->m_admin->lihat();
		$this->data['no'] = 1;



		$this->data['all_leads_project'] = $this->m_admin->get_lsp();

		$id_lsp = $this->input->post('id_lsp');
		$this->data['all_Mom'] = $this->m_admin->view_mom_filter($id_lsp); 

		$this->load->view('asset/lihat', $this->data);
	}


	public function lihat_semua($EmployeeID = NULL){
		$this->data['title'] = 'ASSET CASSA DESIGN';
		//$this->data['all_Mom'] = $this->m_admin->lihat();
		$this->data['no'] = 1; 

   //	$this->data['all_leads_project'] = $this->m_admin->get_lsp();

   // $id_lsp = $this->input->post('id_lsp');
		$this->data['all_asset'] = $this->m_admin->tampil_asset(); 

		$this->load->view('asset/lihat', $this->data); 
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
		$atdnc_data['nama_asset'] = $this->input->post('nama_asset');
		$atdnc_data['kode_asset'] = $this->input->post('kode_asset');
		$atdnc_data['createdby'] = $this->input->post('createdby');
		$atdnc_data['createdtime'] = $this->input->post('createdtime');
		$atdnc_data['keterangan_asset'] = $this->input->post('keterangan_asset');
		$atdnc_data['status'] = $this->input->post('status');
		$this->m_admin->save_asset($atdnc_data);

		$data['user'] = $this->input->post('createdby');
		$data['waktu'] = $this->input->post('createdtime');
		$nama_asset =  $this->input->post('nama_asset');
		$keterangan =  $this->input->post('ket');
		$data['ket'] = $keterangan.' '.$nama_asset;
		$data['kode'] = $this->input->post('kode_asset');

			$this->m_admin->tambah_log($data); //simpan ke tabel log

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
			$this->m_admin->tambah_log($data); //simpan ke tabel jenis izin

			if($this->m_admin->hapus($id)){
				$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Dihapus!');
				redirect('asset/lihat_semua');
			} else {
				$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Dihapus!');
				redirect('asset/lihat_semua');
			}
		}





}