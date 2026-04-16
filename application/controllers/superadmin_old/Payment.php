<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
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
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_izin', 'm_izin');
	}

	
	public function index($id = NULL){ 
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Waiting Approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

    		$id_lsp = $this->input->post('id_lsp');
    		$this->data['all_paym'] = $this->m_payment->view_payment_status(); 

		date_default_timezone_set('Asia/Jakarta');
    		
		$atdnc_data['approvalBy'] = $this->session->login['nama'];
		$atdnc_data['approvalTime'] = date('Y-m-d H:i:s');
		$atdnc_data['status_approval'] = '3';

		$this->m_payment->save_approve_payment($atdnc_data,$id);


		$this->load->view('paym/lihat_paym', $this->data);
		}

	public function pending_($id = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Pending';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

    		$id_lsp = $this->input->post('id_lsp');
    		$this->data['all_paym'] = $this->m_payment->count_payment_status_pend(); 

		date_default_timezone_set('Asia/Jakarta');
    		
		$atdnc_data['approvalBy'] = $this->session->login['nama'];
		$atdnc_data['approvalTime'] = date('Y-m-d H:i:s');
		$atdnc_data['status_approval'] = '3';

		$this->m_payment->save_approve_payment($atdnc_data,$id);


		$this->load->view('paym/lihat_paym', $this->data);
		}

	public function finish($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

	    	$id_lsp = $this->input->post('id_lsp');
	    	$this->data['all_paym'] = $this->m_payment->view_payment_status_f(); 

		$this->load->view('paym/lihat_paym_approved', $this->data);
	}
	 public  function data_payment_finishh(){
        $this->data=$this->m_payment->view_payment_status_f();
        echo json_encode($this->data);
    }
	public function finish_($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'Print report payment approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();


	    	$tanggal = $this->input->post('tanggal');
	    	$header_payment = $this->input->post('header_payment');
   		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment); 
        	$count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);  
		$url_cetak = 'payment/export?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('paym/report_paym', $this->data);  
	}
		public function export_excel(){  
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
      	$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$url_cetak = 'payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$url_cetak_excel = 'payment/export_excel?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment);  
        	$count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);
        	$this->data['ket'] = $ket;
        	$this->data['status'] = 'APPROVED';
        	$this->data['url_cetak'] = base_url($url_cetak);
        	$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;

        	$this->load->view('paym/export_excel', $this->data); 
    }
	public function export(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];
        
             // Jika filter nya 1 (per tanggal)
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
        $ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        $url_cetak = 'payment/export?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        $absensi = $this->m_payment->view_payment_status_ff($tanggal,$header_payment);  
        $count = $this->m_payment->view_payment_status_fff($tanggal,$header_payment);
        $this->data['ket'] = $ket;
        $this->data['status'] = 'APPROVED';
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
    }
	public function save_laporan($id = NULL) { 
		  	
        $data['header_payment'] = $this->input->post('header_payment'); 
		$data['kod_payment'] = $this->input->post('kod_payment');
        $data['no_spk'] = $this->input->post('no_spk'); 
		$data['tgl_payment'] = $this->input->post('tgl_payment');
		$data['project_payment'] = $this->input->post('project_payment');
        $data['vendor'] = $this->input->post('vendor');
        $data['almount'] = $this->input->post('almount');
        $data['note_payment'] = $this->input->post('note_payment');
        $data['createdBy_payment'] = $this->session->login['nama'];
        $data['createdTime_payment'] = $this->input->post('createdTime_payment');
    	$this->m_payment->simpan_payment($data);

			//untuk log
      		$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = $this->input->post('createdTime_payment');
			$nama =  $this->input->post('kod_payment');
			$keterangan =  'Add Payment';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('kod_payment');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Ditambahkan!');
        redirect('payment'); //redirect page
    }

	public function print_p($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'Print report waiting approved';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat(); 


	    	$tanggal = $this->input->post('tanggal');
	    	$header_payment = $this->input->post('header_payment');
        	$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment); 
        	$count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);  
		$url_cetak = 'user/payment/export_p?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('paym/report_paym', $this->data);
	}
		public function export_p(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];
        
             // Jika filter nya 1 (per tanggal)
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
       $ket = 'waiting approved CSA/MSA/GFY/'.date('d-m-Y', strtotime($tanggal));
        $url_cetak = 'user/payment/export_p?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        $absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment);  
        $count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);
        $this->data['ket'] = $ket;
        $this->data['status'] = 'BELUM DIAPPROVE';
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
    }
    	public function export_excel_pending(){  
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
		$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$url_cetak = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$url_cetak_excel = 'user/payment/export_excel_pending?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$absensi = $this->m_payment->view_payment_status_pp($tanggal,$header_payment);  
        	$count = $this->m_payment->view_payment_status_fffp($tanggal,$header_payment);
        	$this->data['ket'] = $ket;
        	$this->data['status'] = 'BELUM DIAPPROVE';
        	$this->data['url_cetak'] = base_url($url_cetak);
        	$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;

        		$this->load->view('paym/export_excel', $this->data); 
    }
    	public function add_pay($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();


   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

		$this->load->view('paym/add_payment', $this->data);
	}
            public function save_laporan2($id = NULL) { 
		 date_default_timezone_set('Asia/Jakarta');

        	$header_payment = $this->input->post('header_payment'); 
        	$tgl_payment = $this->input->post('tgl_payment');
        	$no_spk = $this->input->post('no_spk'); 
		$project_payment = $this->input->post('project_payment');
        	$vendor = $this->input->post('vendor');
        	$almount = $this->input->post('almount');
        	$total_pajak = $this->input->post('total_pajak');
        	$total_payment = $this->input->post('total_payment');
        	$note_payment = $this->input->post('note_payment');
        	$createdBy_payment = $this->session->login['nama'];
        	$createdTime_payment = date('Y-m-d H:i:s');
    		$this->m_payment->insert_paymentt($header_payment,$tgl_payment,$no_spk,$project_payment,$vendor,$almount,$note_payment,$createdBy_payment,$createdTime_payment,$total_pajak,$total_payment );

			//untuk log
      		$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$nama =  $this->input->post('header_payment');
			$keterangan =  'Add Payment';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('header_payment');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;

       	$this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Ditambahkan!');
        redirect('payment'); //redirect page
    }
    public function update_payment($id = NULL) { 
		date_default_timezone_set('Asia/Jakarta');
    		$status_payment = $this->input->post('status_approval');

	if ($status_payment == 1) {
         	$data['header_payment'] = $this->input->post('header_payment');
         	$data['status_approval'] = $this->input->post('status_approval');
		$data['id_payment'] = $this->input->post('id_payment');
        	$data['no_spk'] = $this->input->post('no_spk'); 
		$data['tgl_payment'] = $this->input->post('tgl_payment');
		$data['project_payment'] = $this->input->post('project_payment');
   		$data['vendor'] = $this->input->post('vendor');
		$data['almount'] = $this->input->post('almount');
		$data['total_pajak'] = $this->input->post('total_pajak');
		$data['total_payment'] = $this->input->post('total_payment');
		$data['note_payment'] = $this->input->post('note_payment');
		$data['update_payBy'] = $this->session->login['nama'];
		$data['timeupdate_pay'] = $this->input->post('timeupdate_pay');
    		$this->m_payment->simpan_payment($data);

    					//untuk log
      		$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = $this->input->post('timeupdate_pay');
			$nama =  $this->input->post('id_payment');
			$keterangan =  'Update Payment';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('id_payment');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log
    	}

    		if ($status_payment == 2  OR $status_payment == 3 ) {
         	$data['header_payment'] = $this->input->post('header_payment');
		$data['kod_payment'] = $this->input->post('kod_payment');
        	$data['no_spk'] = $this->input->post('no_spk'); 
		$data['tgl_payment'] = $this->input->post('tgl_payment');
		$data['project_payment'] = $this->input->post('project_payment');
   		$data['vendor'] = $this->input->post('vendor');
		$data['almount'] = $this->input->post('almount');
		$data['total_pajak'] = $this->input->post('total_pajak');
		$data['total_payment'] = $this->input->post('total_payment');
		$data['note_payment'] = $this->input->post('note_payment');
		$data['update_payBy'] = $this->session->login['nama'];
		$data['timeupdate_pay'] = $this->input->post('timeupdate_pay');
    		$data['status_approval'] = $this->input->post('status_approval');
        	$data['approvalBy'] = $this->session->login['nama']; 
        	$data['approvalTime'] = date('Y-m-d H:i:s');
        	$this->m_payment->simpan_payment($data);
    	}
    	if ($status_payment == 3 ) {
    		$data['kod_payment'] = $this->input->post('kod_payment');
    		$data['status_klik'] = '1';
    		$this->m_payment->simpan_payment($data);


    		$ntfdata['id_payment'] = $this->input->post('kod_payment');
    		$ntfdata['creat_at'] = date('Y-m-d H:i:s');
    		$ntfdata['noted'] = 'Payment approved';
    		$this->m_payment->simpan_notif_payment($ntfdata); //simpan ke tabel notif payment

    					//untuk log
      		$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = $this->input->post('timeupdate_pay');
			$nama =  $this->input->post('kod_payment');
			$keterangan =  'Payment approved ';
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('kod_payment');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log
    	}
        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;
       	$this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Diubah!');
        $this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Diubah!');
        redirect('payment'); //redirect page
    }
     function delete_all()
 {
  if($this->input->post('checkbox_value'))
  {
   $id = $this->input->post('checkbox_value');
   for($count = 0; $count < count($id); $count++)
   {
    $this->m_payment->deletedd($id[$count]);
   }
  }
 }
    public function update_payment_cek($id = NULL) { 
    	date_default_timezone_set('Asia/Jakarta');
     //      echo '<pre>';
    //      print_r ($_POST);
     //   echo '</pre>';
     //  print POST
        //print_r($this->db->last_query()); //print query
     //  exit;
    	$id_payment = $this->input->post('id_payment'); //array of id
	$status_approval = $this->input->post('status_approval'); //  array
	$approvalBy = $this->session->login['nama']; // not array
	$approvalTime = date('Y-m-d H:i:s'); // not array
     if(!empty($status_approval) ) {

            $result = array();
                foreach($id_payment AS $key => $val){
                     $result[] = array(
                      'id_payment'   => $id_payment[$key],
                      'status_approval'   => $status_approval[$key],
                      'approvalBy'   => $approvalBy,
                      'approvalTime'   => $approvalTime
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->update_batch('tbl_payment', $result,'id_payment'); 
     $this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Diproses!');
     }
      $this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Diproses!');
      
        redirect('payment'); //redirect page
    }

        public function update_payment_cek_user($id = NULL) { 
	date_default_timezone_set('Asia/Jakarta');
       //    echo '<pre>';
        //   print_r ($_POST);
      //   echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
      //  exit;
    	$id_payment = $this->input->post('id_payment'); //array of id
	$status_approval = $this->input->post('status_approval'); // not array
	$update_payBy = $this->session->login['nama']; // not array
	$timeupdate_pay = date('Y-m-d H:i:s'); // not array
     if(!empty($status_approval) ) {

            $result = array();
                foreach($id_payment AS $key => $val){
                     $result[] = array(
                      'id_payment'   => $id_payment[$key],
                      'status_approval'   => $status_approval[$key],
                      'update_payBy'   => $update_payBy,
                      'timeupdate_pay'   => $timeupdate_pay
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->update_batch('tbl_payment', $result,'id_payment');


      $this->session->set_flashdata('success', 'Payment <strong>Berhasil</strong> Diproses!');
       	   }
     $this->session->set_flashdata('error', 'Payment <strong>Gagal</strong> Diproses!');
      
        redirect('user/payment/finish'); //redirect page
    }

    	public function finishh($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Payment Paid';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat();

	    	$id_lsp = $this->input->post('id_lsp');
	    	$this->data['all_paym'] = $this->m_payment->view_payment_status_4(); 

		$this->load->view('paym/lihat_paym_finish', $this->data);
	}
    	public function detail_finish($id){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'Payment Detail';
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['employee'] = $this->m_kerja->get_employee();
		$this->data['info_modul'] = $this->m_kerja->get_add_department_by_idd($id); 
		$this->data['all_chat'] = $this->m_kerja->chat_modul($id); 
	//	echo json_encode($data);
		$this->data['count_comment']= count($this->m_kerja->notif_penerima_count()); // get resutl
		$this->data['view_comment']= $this->m_kerja->notif_penerima_count1();

	    	$this->data['all_paym'] = $this->m_payment->view_paym_finish_id($id);  

		$this->load->view('paym/detail_payment_finish', $this->data);
	}

	   	public function print_paid($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'Print report payment paid';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();
   		$this->data['all_leads_project'] = $this->m_mom->get_lsp();
		$this->data['proyek'] = $this->m_mom->get_project();
		$this->data['vendor'] = $this->m_payment->lihat(); 


	    	$tanggal = $this->input->post('tanggal');
	    	$header_payment = $this->input->post('header_payment');
        	$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment); 
        	$count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);  
		$url_cetak = 'user/payment/export_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$url_cetak_excel = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
		$this->data['url_cetak'] = base_url($url_cetak);
		$this->data['url_cetak_excel'] = base_url($url_cetak_excel);
		$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
	    //	$this->data['all_paym'] = $this->m_payment->view_payment_status_f($tanggal,$header_payment); 

		$this->load->view('paym/report_paym', $this->data);
	}
		public function export_paid(){
       $this->data['title'] = "CASSA DESIGN"; 
     
        //$tgl_sekarang = $_GET['tanggal_sekarang'];
        
             // Jika filter nya 1 (per tanggal)
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
       $ket = 'PAYMENT PAID'.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        $url_cetak = 'user/payment/export_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        $absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment);  
        $count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);
        $this->data['ket'] = $ket;
        $this->data['status'] = 'PAID';
        $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;
        $this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename = $ket;
		$html = $this->load->view('paym/report_pdf', $this->data, true);
        $this->pdf->create($html,$ket);
    }
    	public function export_excel_paid(){  
        $tanggal = $_GET['tanggal']; 
        $header_payment = $_GET['header_payment'];
    //    $tanggal = $this->input->post('tanggal');
	//   $header_payment = $this->input->post('header_payment');
$ket = 'LAPORAN PAYMENT '.$header_payment.' TANGGAL '.date('d-m-Y', strtotime($tanggal));
        	$url_cetak = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$url_cetak_excel = 'user/payment/export_excel_paid?filter=1&tanggal='.$tanggal.'&header_payment='.$header_payment;
        	$absensi = $this->m_payment->view_payment_status_ppaid($tanggal,$header_payment);  
        	$count = $this->m_payment->view_payment_status_paid($tanggal,$header_payment);
        	$this->data['ket'] = $ket;
        	$this->data['status'] = 'PAID';
        	$this->data['url_cetak'] = base_url($url_cetak);
        	$this->data['all_paym'] = $absensi;
		$this->data['count'] = $count;

        		$this->load->view('paym/export_excel', $this->data); 
    }
	public function apprved_payment($id = NULL){

		date_default_timezone_set('Asia/Jakarta');
		$atdnc_data['approvalBy'] = $this->session->login['nama'];
		$atdnc_data['approvalTime'] = date('Y-m-d H:i:s');
		$atdnc_data['status_approval'] = '3';
		$this->m_payment->save_approve_payment($atdnc_data,$id);

		$ntfdata['id_payment'] = $id;
    		$ntfdata['creat_at'] = date('Y-m-d H:i:s');
    		$ntfdata['noted'] = 'Payment approved';
    		$this->m_payment->simpan_notif_payment($ntfdata); //simpan ke tabel notif payment
		redirect('payment');
		}

		public function pending_payment($id = NULL){

		date_default_timezone_set('Asia/Jakarta');
		$atdnc_data['approvalBy'] = $this->session->login['nama'];
		$atdnc_data['approvalTime'] = date('Y-m-d H:i:s');
		$atdnc_data['status_approval'] = '2';
		$this->m_payment->save_approve_payment($atdnc_data,$id);
		
		redirect('payment');
		}
    	public function hapus_laporan($id){

				date_default_timezone_set('Asia/Jakarta');
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Payment';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

		if($this->m_payment->hapus_laporan_payment($id)){
			$this->session->set_flashdata('success', 'Laporan Payment <strong>Berhasil</strong> Dihapus!');
			redirect('payment'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Laporan Payment<strong>Gagal</strong> Dihapus!');
			redirect('payment'); //redirect page
		}
	}

	public function d_supp($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Supplier';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
		$this->data['view_task'] = $this->m_kerja->my_modul();

		$this->data['supplier'] = $this->m_payment->lihat_supp();

		$this->load->view('paym/lihat_supplier', $this->data);
	}
		public function d_vend($id_lsp = NULL){
		$this->data['aktif'] = 'list_payment';
		$this->data['title'] = 'List Vendor';
		//$this->data['all_Mom'] = $this->m_mom->lihat();
		$this->data['no'] = 1;
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        	$this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->data['vendor'] = $this->m_payment->lihat();

		$this->load->view('paym/lihat_vendor', $this->data);
	}

		public function proses_simpan_vendor(){
			date_default_timezone_set('Asia/Jakarta');
			$atdnc_data['nama_bank_vendor'] = $this->input->post('nama_bank_vendor');
			$atdnc_data['atas_nama_bank'] = $this->input->post('atas_nama_bank');
			$atdnc_data['nama_vendor'] = $this->input->post('nama_vendor');
			$atdnc_data['norek_vendor'] = $this->input->post('norek_vendor');
			$atdnc_data['createdBy_vn'] = $this->session->login['nama'];
      		$atdnc_data['createdTime_vn'] = date('Y-m-d H:i:s');
      		$this->m_payment->save_vendor($atdnc_data); //simpan ke tabel jenis izin

			
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Add Vendor';
			$data_log['kode'] = $this->input->post('nama_vendor');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Ditambahkan!');
			redirect('payment/d_vend');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
			public function proses_update_vendor(){
			date_default_timezone_set('Asia/Jakarta');
			$atdnc_data['id_ven'] = $this->input->post('id_ven');
			$atdnc_data['nama_bank_vendor'] = $this->input->post('nama_bank_vendor');
			$atdnc_data['atas_nama_bank'] = $this->input->post('atas_nama_bank');
			$atdnc_data['nama_vendor'] = $this->input->post('nama_vendor');
			$atdnc_data['norek_vendor'] = $this->input->post('norek_vendor');
			$atdnc_data['updateBy_vn'] = $this->session->login['nama'];
      		$atdnc_data['updateTime_vn'] = date('Y-m-d H:i:s');
      		$this->m_payment->update_vendor($atdnc_data); //simpan ke tabel jenis izin

			
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Update Vendor';
			$data_log['kode'] = $this->input->post('nama_vendor');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Diubah!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Diubah!');
			redirect('payment/d_vend');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	    	public function hapus_vendor($id){
			date_default_timezone_set('Asia/Jakarta');
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Vendor';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

		if($this->m_payment->hapus_vendor($id)){
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Dihapus!');
			redirect('payment/d_vend'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Vendor<strong>Gagal</strong> Dihapus!');
			redirect('payment/d_vend'); //redirect page
		}
	}
			public function proses_simpan_supplier(){
			date_default_timezone_set('Asia/Jakarta');
			$atdnc_data['supp_name'] = $this->input->post('supp_name');
			$atdnc_data['supp_rekname'] = $this->input->post('supp_rekname');
			$atdnc_data['supp_norek'] = $this->input->post('supp_norek');
			$atdnc_data['createdBy_supp'] = $this->session->login['nama'];
      		$atdnc_data['createdTime_supp'] = date('Y-m-d H:i:s');
      		$this->m_payment->save_supplier($atdnc_data); //simpan ke tabel jenis izin

			
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Add Supplier';
			$data_log['kode'] = $this->input->post('supp_name');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Ditambahkan!');
			redirect('payment/d_supp');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
				public function proses_update_supplier(){
			date_default_timezone_set('Asia/Jakarta');
			$atdnc_data['id_supp'] = $this->input->post('id_supp');
			$atdnc_data['supp_name'] = $this->input->post('supp_name');
			$atdnc_data['supp_rekname'] = $this->input->post('supp_rekname');
			$atdnc_data['supp_norek'] = $this->input->post('supp_norek');
			$atdnc_data['updateBy_supp'] = $this->session->login['nama'];
      		$atdnc_data['updateTime_supp'] = date('Y-m-d H:i:s');
      		$this->m_payment->update_supplier($atdnc_data); //simpan ke tabel jenis izin

			
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Update Supplier';
			$data_log['kode'] = $this->input->post('supp_name');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin


			$this->session->set_flashdata('error', 'Vendor <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Vendor <strong>Berhasil</strong> Ditambahkan!');
			redirect('payment/d_supp');
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		   public function hapus_supplier($id){
			date_default_timezone_set('Asia/Jakarta');
		  	$data_log['user'] = $this->session->login['nama'];
			$data_log['waktu'] = date('Y-m-d H:i:s');
			$data_log['ket'] = 'Hapus Supplier';
			$data_log['kode'] = $id;
			$this->m_mom->tambah_log($data_log); //simpan ke tabel jenis izin

		if($this->m_payment->hapus_supplier($id)){
			$this->session->set_flashdata('success', 'Supplier <strong>Berhasil</strong> Dihapus!');
			redirect('payment/d_supp'); //redirect page
		} else {
			$this->session->set_flashdata('error', 'Supplier <strong>Gagal</strong> Dihapus!');
			redirect('payment/d_supp'); //redirect page
		}
	}
}
