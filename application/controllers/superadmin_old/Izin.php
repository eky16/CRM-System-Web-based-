<?php

use Dompdf\Dompdf;

class Izin extends CI_Controller{
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
		
		$this->load->model('M_izin', 'm_izin');
        $this->load->model('M_payment', 'm_payment');
         $this->load->model('Fullcalendar_model', 'm_calendar');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		      $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['all_izin'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['aktif'] = 'izin';
		$this->data['title'] = 'IZIN PERSETUJUAN ATASAN';
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['no'] = 1;

		$this->load->view('izin/atasan', $this->data);
	}

	public function hrd($id_lsp = NULL){
		      $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['aktif'] = 'izin';
		$this->data['title'] = 'IZIN PERSETUJUAN HRD';
		$this->data['all_izin'] = $this->m_izin->persetujuan_hrd();
		$this->data['no'] = 1;

		$this->load->view('izin/atasan', $this->data);
	}

	public function disetujui($id_lsp = NULL){
		
		$this->data['aktif'] = 'izin';
		$this->data['title'] = 'TELAH DISETUJUI';
		$this->data['all_izin'] = $this->m_izin->disetujui();
		$this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('izin/atasan', $this->data);
	}

	public function ditolak($id_lsp = NULL){
		
		$this->data['aktif'] = 'izin';
		$this->data['title'] = 'IZIN DITOLAK';
		$this->data['all_izin'] = $this->m_izin->ditolak();
		$this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->load->view('izin/atasan', $this->data);
	}
	public function lihat_semua(){
		$this->data['aktif'] = 'izin_categori'; 
		$this->data['title'] = 'KATEGORI IZIN';
		//$this->data['all_Mom'] = $this->m_izin->lihat();
		$this->data['no'] = 1;
                $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['kode_kategori'] = $this->m_izin->kode_kategori();

        $this->data['all_izin_info'] = $this->m_izin->lihat();


		$this->load->view('izin/lihat', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

			$atdnc_data['kode_kategori'] = $this->input->post('kode_kategori');
			$atdnc_data['jenis'] = $this->input->post('jenis');
			$atdnc_data['createdby'] = $this->input->post('createdby');
      		$atdnc_data['createdtime'] = $this->input->post('createdtime');
      		$this->m_izin->save_kategori_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->input->post('createdby');
			$data['waktu'] = $this->input->post('createdtime');
			$data['ket'] = $this->input->post('ket');
			$data['kode'] = $this->input->post('kode_kategori');
			$this->m_izin->tambah($data); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Kategori Izin <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Kategori Izin <strong>Berhasil</strong> Ditambahkan!');
			redirect('izin/lihat_semua');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	public function proses_approve(){ 
            date_default_timezone_set('Asia/Jakarta');
			$status = $this->input->post('status');
			$id_izin = $this->input->post('id_izin');
	  //   echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
     //   exit;
		if ($status == 2) {
			$atdnc_data['kode_izin'] = $this->input->post('kode_izin');
			$atdnc_data['status'] = $this->input->post('status');
			$atdnc_data['atasan_mengetahui'] = $this->session->login['nama'];
      		$atdnc_data['atasan_waktu'] = date('Y-m-d H:i:s');
      		$this->m_izin->approve_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->session->login['nama']; 
			$data['waktu'] = date('Y-m-d H:i:s');
			$ket3 = $this->input->post('kategori');
			$ket2 = $this->input->post('nama_karyawan');
			$ket1 = 'Mengetahui Izin';
			$data['ket'] = $ket1.' '.$ket3.' '.$ket2 ;
			$data['kode'] = $this->input->post('kode_izin');
			$this->m_izin->tambah($data); //simpan ke tabel log 
		//notif email
      	$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $all_email = $this->input->post('to', TRUE);
       // $to = $this->input->post('to');
        $subject = $this->input->post('kategori');
        $EmployeeID = $this->input->post('EmployeeID');
       	$tanggal = $this->input->post('tanggal');
 		$dan_tanggal = $this->input->post('dan_tanggal');
 		$waktu = $this->input->post('waktu');
 		$dan_waktu = $this->input->post('dan_waktu');
 		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
 		$alasan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>Nama</td>
                <td>:      '.$ket2.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$EmployeeID .'</td>
            </tr>

            <tr>
             <tr>
                <td>Waktu Pengajuan</td>
                <td>:      '.$tgl_pengajuan.'</td>
            </tr>
                <td>Jenis</td>
                <td>:      '.$ket3.'</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>:      '.$tanggal.' & '.$tanggal.'</td>
            </tr>
             
             <tr>
                <td>Waktu</td>
                <td>:      '.$waktu.' '.$dan_waktu.'</td>
            </tr>

            <tr>
                <td>Alasan</td>
                <td>:      '.$alasan.'</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:      '."Atasan Mengetahui".'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:      '.$data['user'].'</td>
            </tr>
            <tr>
                <td>Waktu Mengetahui</td>
                <td>:      '.$data['waktu'].'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
       // $message2 = 'This is an auto-generated email, please do not reply to this email.';
		$message3 = '';
foreach ($all_email as $v_email) {
		$to = $v_email;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
      if ($this->email->send()) {
      
			      if ($this->session->login['akses'] !== 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin');
            }
            if ($this->session->login['akses'] == 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin/hrd');
            }
        } else {
         $this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Disetujui!');
           redirect('izin');
        }

			}
			
      	}
      	if ($status == 3 and $id_izin == 9 OR $id_izin == 11 ) {
			$atdnc_data['kode_izin'] = $this->input->post('kode_izin');
			$atdnc_data['status'] = $this->input->post('status');
			$atdnc_data['hrd_menyetujui'] = $this->session->login['nama'];
      		$atdnc_data['hrd_waktu'] = date('Y-m-d H:i:s');
      		$this->m_izin->approve_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$ket3 = $this->input->post('kategori');
			$ket2 = $this->input->post('nama_karyawan');
			$ket1 = 'Menyetujui Izin';
			$data['ket'] = $ket1.' '.$ket3.' '.$ket2 ;
			$data['kode'] = $this->input->post('kode_izin');
			$this->m_izin->tambah($data); //simpan ke tabel log 

            $atdnc_dat['EmployeeID'] = $this->input->post('EmployeeID');
            $atdnc_dat['kategori_izin'] = $this->input->post('id_izin');
            $StartDate = $this->input->post('tanggal', TRUE);
            $FinishDate = $this->input->post('dan_tanggal', TRUE);
            $att_out = $this->input->post('waktu', TRUE);
              
                    $atdnc_dat['tanggal'] = $StartDate;
                    $atdnc_dat['out'] = $att_out;
                    $this->m_izin->save_ya($atdnc_dat);

                    $atdnc_dat['tanggal'] = $FinishDate;
                    $atdnc_dat['out'] = $att_out;
                    $this->m_izin->save_ya($atdnc_dat); 

		//notif email
      	$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $all_email = $this->input->post('to', TRUE);
       // $to = $this->input->post('to');
        $subject = $this->input->post('kategori');
        $EmployeeID = $this->input->post('EmployeeID');
       	$tanggal = $this->input->post('tanggal');
 		$dan_tanggal = $this->input->post('dan_tanggal');
 		$waktu = $this->input->post('waktu');
 		$dan_waktu = $this->input->post('dan_waktu');
 		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
 		$alasan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>Nama</td>
                <td>:      '.$ket2.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$EmployeeID .'</td>
            </tr>

            <tr>
             <tr>
                <td>Waktu Pengajuan</td>
                <td>:      '.$tgl_pengajuan.'</td>
            </tr>
                <td>Jenis</td>
                <td>:      '.$ket3.'</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>:      '.$tanggal.' & '.$tanggal.'</td>
            </tr>
             
             <tr>
                <td>Waktu</td>
                <td>:      '.$waktu.' '.$dan_waktu.'</td>
            </tr>

            <tr>
                <td>Alasan</td>
                <td>:      '.$alasan.'</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:      '."Disetujui".'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:      '.$data['user'].'</td>
            </tr>
            <tr>
                <td>Waktu Mengetahui</td>
                <td>:      '.$data['waktu'].'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
       // $message2 = 'This is an auto-generated email, please do not reply to this email.';
		$message3 = '';
foreach ($all_email as $v_email) {
		$to = $v_email;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
      if ($this->email->send()) {
      
		      if ($this->session->login['akses'] !== 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin');
            }
            if ($this->session->login['akses'] == 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin/hrd');
            }
        } else {
         $this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Disetujui!');
          redirect('izin/hrd');
        }

			}

      	}
		if ($status == 3 and $id_izin == 10 OR $id_izin == 12) {
			$atdnc_data['kode_izin'] = $this->input->post('kode_izin');
			$atdnc_data['status'] = $this->input->post('status');
			$atdnc_data['hrd_menyetujui'] = $this->session->login['nama'];
      		$atdnc_data['hrd_waktu'] = date('Y-m-d H:i:s');
      		$this->m_izin->approve_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$ket3 = $this->input->post('kategori');
			$ket2 = $this->input->post('nama_karyawan');
			$ket1 = 'Menyetujui Izin';
			$data['ket'] = $ket1.' '.$ket3.' '.$ket2 ;
			$data['kode'] = $this->input->post('kode_izin');
			$this->m_izin->tambah($data); //simpan ke tabel log 


			$atdnc_dat['EmployeeID'] = $this->input->post('EmployeeID');
			$atdnc_dat['kategori_izin'] = $this->input->post('id_izin');
            $StartDate = $this->input->post('tanggal', TRUE);
            $FinishDate = $this->input->post('dan_tanggal', TRUE);
            $att_out = $this->input->post('waktu', TRUE);
              
                    $atdnc_dat['tanggal'] = $StartDate;
                    $atdnc_dat['out'] = $att_out;
                    $this->m_izin->save_ya($atdnc_dat);

                    $atdnc_dat['tanggal'] = $FinishDate;
                    $atdnc_dat['out'] = $att_out;
                    $this->m_izin->save_ya($atdnc_dat); 
		//notif email
      	$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $all_email = $this->input->post('to', TRUE);
       // $to = $this->input->post('to');
        $subject = $this->input->post('kategori');
        $EmployeeID = $this->input->post('EmployeeID');
       	$tanggal = $this->input->post('tanggal');
 		$dan_tanggal = $this->input->post('dan_tanggal');
 		$waktu = $this->input->post('waktu');
 		$dan_waktu = $this->input->post('dan_waktu');
 		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
 		$alasan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>Nama</td>
                <td>:      '.$ket2.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$EmployeeID .'</td>
            </tr>

            <tr>
             <tr>
                <td>Waktu Pengajuan</td>
                <td>:      '.$tgl_pengajuan.'</td>
            </tr>
                <td>Jenis</td>
                <td>:      '.$ket3.'</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>:      '.$tanggal.' & '.$tanggal.'</td>
            </tr>
             
             <tr>
                <td>Waktu</td>
                <td>:      '.$waktu.' '.$dan_waktu.'</td>
            </tr>

            <tr>
                <td>Alasan</td>
                <td>:      '.$alasan.'</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:      '."Disetujui".'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:      '.$data['user'].'</td>
            </tr>
            <tr>
                <td>Waktu Mengetahui</td>
                <td>:      '.$data['waktu'].'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
       // $message2 = 'This is an auto-generated email, please do not reply to this email.';
		$message3 = '';
foreach ($all_email as $v_email) {
		$to = $v_email;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
      if ($this->email->send()) {
      
		      if ($this->session->login['akses'] !== 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin');
            }
            if ($this->session->login['akses'] == 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin/hrd');
            }
        } else {
         $this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Disetujui!');
          redirect('izin/hrd');
        }

			}
      	}

        date_default_timezone_set('Asia/Jakarta');

        if($status == 3 and $id_izin == 8){
            $myvalue = $this->session->login['nama'];
            $arr = explode(' ',trim($myvalue));
            $kalimat_pertama = $arr[0]; // will print Test
            $kalimat_new = strtolower($kalimat_pertama);
            $kalimat_new1 = ucfirst($kalimat_new);

            $data_event['start_event'] = $this->input->post('tanggal');
            
            $date_end = $this->input->post('dan_tanggal');
            $date_endd = str_replace('-', '/', $date_end);
            $data_event['end_event'] = date('Y-m-d',strtotime($date_endd . "+1 days"));

            $nama =   $this->input->post('nama_karyawan');
            $keterangan =  'CUTI';
            $createdBy =  $kalimat_new1;
            $data_event['title'] = $keterangan.' '.$nama.' - '.$createdBy;
            $data_event['time_create'] = date('Y-m-d H:i:s'); 
            $data_event['create_by'] = $this->session->login['nama'];
            $data_event['mode'] = 'cuti';
            $this->m_calendar->tambah_event($data_event); //simpan ke tabel Calendar

        }
		if ($status == 3 and $id_izin == 7 OR $id_izin == 8 OR $id_izin == 13 OR $id_izin == 14 OR $id_izin == 15) {
			$atdnc_data['kode_izin'] = $this->input->post('kode_izin');
			$atdnc_data['status'] = $this->input->post('status');
			$atdnc_data['hrd_menyetujui'] = $this->session->login['nama'];
      		$atdnc_data['hrd_waktu'] = date('Y-m-d H:i:s');
      		$this->m_izin->approve_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$ket3 = $this->input->post('kategori');
			$ket2 = $this->input->post('nama_karyawan');
			$ket1 = 'Menyetujui Izin';
			$data['ket'] = $ket1.' '.$ket3.' '.$ket2 ;
			$data['kode'] = $this->input->post('kode_izin');
			$this->m_izin->tambah($data); //simpan ke tabel log 


			$atdnc_dat['EmployeeID'] = $this->input->post('EmployeeID');
			$atdnc_dat['kategori_izin'] = $this->input->post('id_izin');
            $StartDate = $this->input->post('tanggal', TRUE);
            $FinishDate = $this->input->post('dan_tanggal', TRUE);

              
                    $atdnc_dat['tanggal'] = $StartDate;
               
                    $this->m_izin->save_ya($atdnc_dat);

                    $atdnc_dat['tanggal'] = $FinishDate;
   
                    $this->m_izin->save_ya($atdnc_dat); 


		//notif email
      	$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $all_email = $this->input->post('to', TRUE);
       // $to = $this->input->post('to');
        $subject = $this->input->post('kategori');
        $EmployeeID = $this->input->post('EmployeeID');
       	$tanggal = $this->input->post('tanggal');
 		$dan_tanggal = $this->input->post('dan_tanggal');
 		$waktu = $this->input->post('waktu');
 		$dan_waktu = $this->input->post('dan_waktu');
 		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
 		$alasan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>Nama</td>
                <td>:      '.$ket2.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$EmployeeID .'</td>
            </tr>

            <tr>
             <tr>
                <td>Waktu Pengajuan</td>
                <td>:      '.$tgl_pengajuan.'</td>
            </tr>
                <td>Jenis</td>
                <td>:      '.$ket3.'</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>:      '.$tanggal.' & '.$tanggal.'</td>
            </tr>
             
             <tr>
                <td>Waktu</td>
                <td>:      '.$waktu.' '.$dan_waktu.'</td>
            </tr>

            <tr>
                <td>Alasan</td>
                <td>:      '.$alasan.'</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:      '."Disetujui".'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:      '.$data['user'].'</td>
            </tr>
            <tr>
                <td>Waktu Mengetahui</td>
                <td>:      '.$data['waktu'].'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
       // $message2 = 'This is an auto-generated email, please do not reply to this email.';
		$message3 = '';
foreach ($all_email as $v_email) {
		$to = $v_email;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
      if ($this->email->send()) {

      if ($this->session->login['akses'] !== 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin');
            }
            if ($this->session->login['akses'] == 'admin'){
            $this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Disetujui!');
            redirect('izin/hrd');
            }

        } else {
         $this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Disetujui!');
          redirect('izin/hrd');
        }

			}
      	}
		if ($status == 4) {
			$atdnc_data['kode_izin'] = $this->input->post('kode_izin');
			$atdnc_data['status'] = $this->input->post('status');
			$atdnc_data['hrd_menyetujui'] = $this->session->login['nama'];
      		$atdnc_data['hrd_waktu'] = date('Y-m-d H:i:s');
      		$atdnc_data['atasan_mengetahui'] = $this->input->post('atasan_mengetahui');
      		$atdnc_data['atasan_waktu'] = $this->input->post('atasan_waktu');
      		$this->m_izin->approve_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] =  $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$ket3 = $this->input->post('kategori');
			$ket2 = $this->input->post('nama_karyawan');
			$ket1 = 'Tolak Izin';
			$data['ket'] = $ket1.' '.$ket3.' '.$ket2 ;
			$data['kode'] = $this->input->post('kode_izin');
			$this->m_izin->tambah($data); //simpan ke tabel log 
 					//notif email
      	$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $all_email = $this->input->post('to', TRUE);
       // $to = $this->input->post('to');
        $subject = $this->input->post('kategori');
        $EmployeeID = $this->input->post('EmployeeID');
       	$tanggal = $this->input->post('tanggal');
 		$dan_tanggal = $this->input->post('dan_tanggal');
 		$waktu = $this->input->post('waktu');
 		$dan_waktu = $this->input->post('dan_waktu');
 		$tgl_pengajuan = $this->input->post('tgl_pengajuan');
 		$alasan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $waktunya = date('Y-m-d H:i');
            $message = '                                                                         
            <h4>Berikut lampiran data Absen Cassa Design :</h4>
            <br 
            <table><strong>
            <tr>
                <td>Nama</td>
                <td>:      '.$ket2.'</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: '.$EmployeeID .'</td>
            </tr>

            <tr>
             <tr>
                <td>Waktu Pengajuan</td>
                <td>:      '.$tgl_pengajuan.'</td>
            </tr>
                <td>Jenis</td>
                <td>:      '.$ket3.'</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>:      '.$tanggal.' & '.$tanggal.'</td>
            </tr>
             
             <tr>
                <td>Waktu</td>
                <td>:      '.$waktu.' '.$dan_waktu.'</td>
            </tr>

            <tr>
                <td>Alasan</td>
                <td>:      '.$alasan.'</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:      '."Ditolak".'</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:      '.$data['user'].'</td>
            </tr>
            <tr>
                <td>Waktu Menolak</td>
                <td>:      '.$data['waktu'].'</td>
            </tr>
            </strong>
            </table>
           
        
            <p>This is an auto-generated email, please do not reply to this email.</p>
            ';
       // $message2 = 'This is an auto-generated email, please do not reply to this email.';
		$message3 = '';
foreach ($all_email as $v_email) {
		$to = $v_email;
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
      if ($this->email->send()) {
      
			if ($this->session->login['akses'] !== 'admin'){
			$this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Ditolak!');
			redirect('izin');
 			}
 			if ($this->session->login['akses'] == 'admin'){
			$this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Ditolak!');
			redirect('izin/hrd');
 			}
        } else {
    		if ($this->session->login['akses'] !== 'admin'){
 			$this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Ditolak!');
		
			redirect('izin');
 			}
 			if ($this->session->login['akses'] == 'admin'){
 			$this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Ditolak!');
			redirect('izin/hrd');
 			}
        }

			}

 			if ($this->session->login['akses'] !== 'admin'){
 			$this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Ditolak!');
			$this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Ditolak!');
			redirect('izin');
 			}

 			if ($this->session->login['akses'] == 'admin'){
 			$this->session->set_flashdata('error', ' Izin <strong>Gagal</strong> Ditolak!');
			$this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Ditolak!');
			redirect('izin/hrd');
 			}

      	}

		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		public function proses_ubah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

			$atdnc_data['kode_kategori'] = $this->input->post('kode_kategori');
			$atdnc_data['jenis'] = $this->input->post('jenis');
			$atdnc_data['updateby'] = $this->input->post('updateby');
      		$atdnc_data['updatetime'] = $this->input->post('updatetime');
      		$this->m_izin->save_kategori_izin($atdnc_data); //simpan ke tabel jenis izin

      		$data['user'] = $this->input->post('updateby');
			$data['waktu'] = $this->input->post('updatetime');
			$data['ket'] = $this->input->post('ket');
			$data['kode'] = $this->input->post('kode_kategori');
			$this->m_izin->tambah($data); //simpan ke tabel log izin


			$this->session->set_flashdata('error', 'Kategori Izin <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Kategori Izin <strong>Berhasil</strong> Diubah!');
			redirect('izin/lihat_semua');
		
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
			$data['ket'] = 'Hapus Izin';
			$data['kode'] = $id;
			$this->m_izin->tambah($data); //simpan ke tabel jenis izin


		if($this->m_izin->hapus_izin($id)){
			$this->session->set_flashdata('success', 'Izin <strong>Berhasil</strong> Dihapus!');
			redirect('izin');
		} else {
			$this->session->set_flashdata('error', 'Izin <strong>Gagal</strong> Dihapus!');
			redirect('izin');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_izin->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}


}