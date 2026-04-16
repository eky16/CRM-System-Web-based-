<?php

use Dompdf\Dompdf;

class Mod_kerja extends CI_Controller{
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
		$this->data['aktif'] = 'mod_kerja';
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_asset', 'm_asset');
		 $this->load->model('M_reimburs', 'm_reimburs');
		 $this->load->model('M_payment', 'm_payment');
		 $this->load->model('Fullcalendar_model', 'm_calendar');
		$this->load->helper(array('form', 'url'));
	}
		function data_barang(){
		$id = $this->input->post('id');

		$this->data= $this->m_kerja->chat_modul_test($id);
	//	$this->data=$this->m_kerja->barang_list(); 
		
	}
			function data_sub_task(){
		$id = $this->input->post('id');

		$this->data= $this->m_kerja->chat_modul_test($id);
	//	$this->data=$this->m_kerja->barang_list(); 
		
	}
			function data_chat_sub(){
		$id = $this->input->post('id');

		$this->data= $this->m_kerja->chat_modul_sub_task($id);
	//	$this->data=$this->m_kerja->barang_list(); 
		
	}
		function data_kontributor(){
		$id = $this->input->post('id');

		$this->data= $this->m_kerja->kontributor($id);
	//	$this->data=$this->m_kerja->barang_list(); 
		
	}
	public function index(){
		$this->data['title'] = 'Modul Kerja';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_kerja->get_lsp();
        $this->data['all_dept_info'] = $this->m_kerja->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_kerja->get_add_department_by_id($v_dept_info->kode_modul);
        }
  //  $id_lsp = $this->input->post('id_lsp');
  //  $this->data['all_Mom'] = $this->m_kerja->view_mom_filter($id_lsp); 

		$this->load->view('mod_kerja/lihat', $this->data);
	}

		public function detail($id){
		$this->data['title'] = 'Modul Kerja';
		//$this->data['all_Mom'] = $this->m_kerja->lihat(); 
		$this->data['no'] = 1;
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
        $this->data['all_dept_info'] = $this->m_kerja->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_kerja->detail_tugas($v_dept_info->kode_modul,$id);
        }
 			$kepada = $this->session->login['nama'];
			$atdnc_data['status_baca'] = '2';

			$this->m_kerja->save_unlink_chat($atdnc_data,$id,$kepada);

			$this->data['dt_sub'] = $this->m_kerja->view_task_dt_admin($id); 
		$this->load->view('mod_kerja/lihat', $this->data);
	} 
			public function detail_kontribut($id){
		$this->data['title'] = 'Modul Kerja';
		//$this->data['all_Mom'] = $this->m_kerja->lihat(); 
		$this->data['no'] = 1;
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
        $this->data['all_dept_info'] = $this->m_kerja->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_kerja->detail_tugas($v_dept_info->kode_modul,$id);
        }
 			$kepada = $this->session->login['nama'];
			$atdnc_data['status_baca'] = '2';

			$this->m_kerja->save_unlink_chat($atdnc_data,$id,$kepada);

			$this->data['dt_sub'] = $this->m_kerja->view_task_dt_admin_kontribut($id);
		$this->load->view('mod_kerja/lihat_kontribut', $this->data);
	} 
			public function detail_sub($id){
		$this->data['title'] = 'Detail Task';
		//$this->data['all_Mom'] = $this->m_kerja->lihat(); 
		$this->data['no'] = 1;
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
        $this->data['all_dept_info'] = $this->m_kerja->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_kerja->detail_tugas_sub($v_dept_info->kode_modul,$id);
        }
 			$kepada = $this->session->login['nama'];
			$atdnc_data['status_baca'] = '2';
			$this->m_kerja->save_unlink_chat_sub($atdnc_data,$id,$kepada);


		$this->data['dt_sub'] = $this->m_kerja->view_task_dt($id);

		$this->load->view('mod_kerja/detail_sub', $this->data);
	} 
				public function detail_sub_kontribut($id){
		$this->data['title'] = 'Detail Task';
		//$this->data['all_Mom'] = $this->m_kerja->lihat(); 
		$this->data['no'] = 1;
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
        $this->data['all_dept_info'] = $this->m_kerja->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_kerja->detail_tugas_sub($v_dept_info->kode_modul,$id);
        }
 			$kepada = $this->session->login['nama'];
			$atdnc_data['status_baca'] = '2';
			$this->m_kerja->save_unlink_chat_sub($atdnc_data,$id,$kepada);


		$this->data['dt_sub'] = $this->m_kerja->view_task_dt($id);

		$this->load->view('mod_kerja/detail_sub_kontribut', $this->data);
	} 
	public function lihat_semua(){
		$this->data['title'] = 'Task Employee Pending';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['all_dept_info'] = $this->m_kerja->lihat_modul();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_all', $this->data); 
	}

	public function proses(){  
		$this->data['title'] = 'Task Employee Process';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
			$this->data['count_comment']= count($this->m_kerja->notif_penerima_count()); // get resutl
		$this->data['view_comment']= $this->m_kerja->notif_penerima_count1();
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['all_dept_info'] = $this->m_kerja->lihat_modul_proses();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_all', $this->data);
	}
		public function mykontribusi(){  
		$this->data['title'] = 'Task Employee Process';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
			$this->data['count_comment']= count($this->m_kerja->notif_penerima_count()); // get resutl
		$this->data['view_comment']= $this->m_kerja->notif_penerima_count1();
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['all_dept_info'] = $this->m_kerja->lihat_modul_proses_kontribusi();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_kontribusi', $this->data);
	}
    public function ubah($id = NULL) {
		$this->data['title'] = 'Ubah Modul Kerja';
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
				$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['proyek'] = $this->m_kerja->get_proyek();
		$this->data['employee'] = $this->m_kerja->get_employee();
        if ($id) { // retrive data from db by id
            // get all department by id
        $this->data['department_info'] = $this->m_kerja->lihat_dept_id($id);

            // get all designation by department id
         $this->data['designation_info'] = $this->m_kerja->lihat_div_id($id);

        }

        //page load
 		$this->load->view('mod_kerja/ubah', $this->data);
    }	   

	public function modul_finish(){
		$this->data['title'] = 'Task Finish';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

        $this->data['all_dept_info'] = $this->m_kerja->modul_finish();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_allend', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Tugas Baru';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['kode_modul'] = $this->m_kerja->kode_modul();
		$this->data['employee'] = $this->m_kerja->get_employee();
		$this->data['proyek'] = $this->m_kerja->get_proyek();
		$this->data['count_comment']= count($this->m_kerja->notif_penerima_count()); // get resutl
		$this->data['view_comment']= $this->m_kerja->notif_penerima_count1();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

 
		$this->load->view('mod_kerja/tambah', $this->data);
	}
	public function progress_view(){
		$this->data['title'] = 'Laporan Foto Progress Harian';
		$this->data['aktif'] = 'laporan_proyek';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

        $this->data['all_dept_info'] = $this->m_kerja->lihat_progress_harian();
        $this->data['all_dept_info1'] = $this->m_kerja->lihat_progress_harian1();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_report_foto', $this->data);
	}
		public function progress_finish(){
		$this->data['title'] = 'Laporan Foto Progress Harian';
		$this->data['aktif'] = 'laporan_proyek';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

        $this->data['all_dept_info'] = $this->m_kerja->lihat_progress_harian_end();
        // get all department info and designation info
		$this->load->view('mod_kerja/lihat_report_foto_finish', $this->data);
	}
		public function progress_view_detail($kode_daily){
		$this->data['title'] = 'Detail Laporan Progress harian';
		$this->data['aktif'] = 'laporan_proyek';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

       $this->data['asst'] = $this->m_kerja->lihat_id_daily($kode_daily);

       	$tanggal = $this->input->post('tanggal',TRUE);
		$dan_tanggal = $this->input->post('dan_tanggal',TRUE);
       $this->data['laporan_foto'] = $this->m_kerja->laporan_foto_byid($kode_daily,$tanggal,$dan_tanggal);
        $this->data['count_foto'] = count($this->m_kerja->laporan_foto_byid($kode_daily,$tanggal,$dan_tanggal)); // get resutl
       
        // get all department info and designation info
		$this->load->view('mod_kerja/details_repot_img', $this->data);
	}
	public function tambah_(){
		$this->data['title'] = 'Laporan Foto Progress Harian';
		//$this->data['all_Mom'] = $this->m_kerja->lihat();
		$this->data['aktif'] = 'laporan_proyek';
		$this->data['no'] = 1;
		$this->data['kode_modul'] = $this->m_kerja->kode_modul();
		$this->data['employee'] = $this->m_kerja->get_employee();
		$this->data['proyek'] = $this->m_kerja->get_proyek();
		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();


		$this->load->view('mod_kerja/tambah_', $this->data); 
	}
	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_kerja->hapus($id) AND $this->m_kerja->hapus_sub($id)){
			$this->m_kerja->hapus_kontributor($id);
			$this->m_kerja->hapus_chat($id);
			$this->session->set_flashdata('success', 'Modul Kerja <strong>Berhasil</strong> Dihapus!');
			redirect('mod_kerja/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Modul Kerja  <strong>Gagal</strong> Dihapus!');
			redirect('mod_kerja/lihat_semua');
		}
	}

	public function hapus_daily($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_kerja->hapus_sub_daily($id) AND $this->m_kerja->hapus_sub2($id)){
			$this->session->set_flashdata('success', 'Data <strong>Berhasil</strong> Dihapus!');
			redirect('mod_kerja/progress_view');
		} else {
			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Dihapus!');
			redirect('mod_kerja/progress_view');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_kerja->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



	function create(){
		date_default_timezone_set('Asia/Jakarta');
		$cek_tgl = $this->input->post('tempo',TRUE);
		if(!empty($cek_tgl)){
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);

			$data_event['start_event'] = $this->input->post('tempo');
			$data_event['end_event'] = $this->input->post('tempo');
			$nama =  $this->input->post('kode_modul',TRUE);
			$keterangan =  'Dateline Task';
			$createdBy =  'By'.' '.$kalimat_new1;
			$data_event['title'] = $keterangan.' '.$nama.' - '.$createdBy;
			$data_event['time_create'] = date('Y-m-d H:i:s'); 
			$data_event['create_by'] = $this->session->login['nama'];
			$data_event['mode'] = 'task';
			$this->m_calendar->tambah_event($data_event); //simpan ke tabel Calendar
		}
	   	$data['user'] = $this->session->login['nama'];
		$data['waktu'] = date('Y-m-d H:i:s');
		$keterangan = 'Created Task';
		$data['ket'] = $keterangan;
		$data['kode'] = $this->input->post('kode_modul',TRUE);
		$this->m_kerja->tambah_log($data); //simpan ke tabel log

		$email = $this->input->post('email',TRUE);
		$kode_modul = $this->input->post('kode_modul',TRUE);
		$nama_proyek = $this->input->post('nama_proyek',TRUE);
		$tugas = $this->input->post('tugas',TRUE);
		$createdby = $this->session->login['nama'];
		$tempo = $this->input->post('tempo',TRUE);

		$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = $email;
        $subject = 'Hai ,Ada Tugas Untuk Kamu';
        $message = 'Segera cek Task kerja kamu pada sistem Cassa Design untuk melihat tugas yang diberikan';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) { 
   
          $this->m_kerja->create_package($kode_modul,$tugas,$email,$createdby,$nama_proyek,$tempo);
        } else {
        	$this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Ditambahkan!');
            redirect('mod_kerja');
          //  show_error($this->email->print_debugger());
        }
		
		
	}
	function create_(){
		date_default_timezone_set('Asia/Jakarta');

	   	$data['user'] = $this->session->login['nama'];
		$data['waktu'] = date('Y-m-d H:i:s');
		$keterangan = 'Create Daily Report';
		$data['ket'] = $keterangan;
		$data['kode'] = $this->input->post('kode_daily',TRUE);
		$this->m_kerja->tambah_log($data); //simpan ke tabel log

		$email = $this->input->post('karyawan',TRUE);
		$atnd['karyawan'] = $this->input->post('karyawan',TRUE);
		$atnd['kode_daily'] = $this->input->post('kode_daily',TRUE);
		$atnd['proyek'] = $this->input->post('proyek',TRUE);
		$atnd['jumlah_foto'] = $this->input->post('jumlah_foto',TRUE);
		$atnd['durasi'] = $this->input->post('durasi',TRUE);
		$atnd['keterangan'] = $this->input->post('keterangan',TRUE);

		$atnd['dibuat'] = $this->session->login['nama'];
		$atnd['waktu'] = date('Y-m-d H:i:s');

		$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = $email;
        $subject = 'Hai ,Ada Tugas Untuk Anda';
        $message = 'Segera cek Laporan Foto Progress harian anda pada sistem Cassa Design untuk melihat tugas yang diberikan';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) { 
   
          $this->m_kerja->savedaily($atnd);
          $this->session->set_flashdata('success', 'Tugas <strong>Berhasil</strong> Ditambahkan!');
            redirect('mod_kerja/progress_view');
        } else {
        	$this->session->set_flashdata('error', 'Tugas <strong>Gagal</strong> Ditambahkan!');
            redirect('mod_kerja');
          //  show_error($this->email->print_debugger());
        }
		
		
	}
	function update(){

		$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul');
		$keterangan =  'Update Task';
		$atdnc_data['chat'] = $keterangan;
		$atdnc_data['username'] = $this->session->login['nama'];
		$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
		$this->m_kerja->save_chat($atdnc_data);

		$createdby = $this->session->login['nama'];

		$id = $this->input->post('kode_modul',TRUE);
		$to['to'] = $this->input->post('email',TRUE);
		$tugas = $this->input->post('tugas',TRUE);
		$status = $this->input->post('status_tugas',TRUE);
		$to['nama_proyek'] = $this->input->post('nama_proyek',TRUE);
		$to['tempo'] = $this->input->post('tempo',TRUE);
		$this->m_kerja->update_package($id,$to,$tugas);
		redirect('dept/lihat_semua');
	}
	public function proses_tambah5(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

			$atdnc_data['department'] = $this->input->post('department');
			$atdnc_data['kode_dept'] = $this->input->post('kode_dept');
			$atdnc_data['createdtime'] = $this->input->post('createdtime');
			$this->m_kerja->save_dept($atdnc_data);

			$atdnc_div['id_dept'] = $this->input->post('kode_dept');
      		$atdnc_div['divisi'] = $this->input->post('divisi');

			$this->m_kerja->save_div($atdnc_div);

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('karyawan/lihat_semua');
		
	
    //    $atdnc_data['no_telp'] = $this->input->post('no_telp');
    //    $atdnc_data['email'] = $this->input->post('email');
   //     $atdnc_data['nama_project'] = $this->input->post('nama_project');
   //     $atdnc_data['alamat_project'] = $this->input->post('alamat_project');
    //    $atdnc_data['tlp_kantor'] = $this->input->post('tlp_kantor');
    //    $atdnc_data['alamat_kantor'] = $this->input->post('alamat_kantor');
    //    $atdnc_data['createdby'] = $this->input->post('createdby');
    //    $atdnc_data['createdtime'] = $this->input->post('createdtime');
    //    $atdnc_data['updateby'] = $this->input->post('updateby');
    //    $atdnc_data['updatetime'] = $this->input->post('updatetime');
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
		public function update_reportimg($id){
			date_default_timezone_set('Asia/Jakarta');
   //echo '<pre>';
    //    print_r ($_POST);
     //   echo '</pre>';
     //   exit;


			$atdnc_data['finish_report'] = date('Y-m-d H:i:s');
			$atdnc_data['status'] = '3';

			$this->m_kerja->save_finish_daily($atdnc_data,$id);

      		$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Finish Daily Report';
			$data['ket'] = $keterangan;
			$data['kode'] = $id;

			$this->m_kerja->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', '<strong>Gagal</strong> Diproses!');
			$this->session->set_flashdata('success', '<strong>Berhasil</strong> Diproses!');
			redirect('mod_kerja/progress_view');
	

	}
	  public function saved()
	{ 	

		date_default_timezone_set('Asia/Jakarta');
			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Comment Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_chat');
			$this->m_asset->tambah_log($data); //simpan ke tabel log


			$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul_chat');
			$noted = 'Comment,Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
         $data2 = $this->db->insert('tbl_notif', $object2);

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
          $this->db->insert('tbl_notif', $object3);

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log


          $chat = $this->input->post('chat');
          $modul = $this->input->post('kode_modul_chat');
                    $firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
          $nama = $firstname.' '. $jabatan;
          $waktu = date('Y-m-d  H:i:s');
          $object = array(
             'kode_modul_chat' => $modul,
			'chat' => $chat,
             'username' => $nama,
             'waktu_chat' => $waktu
          );
          $this->db->insert('modul_kerja_chat', $object);
         echo json_encode($object,$data2,$data3);

        }
        	  public function saved_sub_task()
	{ 	

		date_default_timezone_set('Asia/Jakarta');
			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Comment Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_chat');
			$this->m_asset->tambah_log($data); //simpan ke tabel log


			$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul');
			$noted = 'Comment,Detail Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
         $data2 = $this->db->insert('tbl_notif', $object2);

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
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log

// notif detail
					$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul_chat');
			$noted = 'Comment,Detail Task Id'.' '.$id_modul;
			$creat_at = date('Y-m-d  H:i:s');
          	$object2 = array(
             'id_modul' => $id_modul,
			'kepada' => $kepada,
             'dari' => $dari,
             'noted' => $noted,
             'creat_at' => $creat_at
          );
         $data2 = $this->db->insert('tbl_notif_detail_sub', $object2);

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
          $this->db->insert('tbl_notif_detail_sub', $object3);
}

			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chats');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif_sub_detail($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log
//end notif detail 
          	$chat = $this->input->post('chat');
          	$modul = $this->input->post('kode_modul_chat');
        	$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
          	$nama = $firstname.' '. $jabatan;
          	$waktu = date('Y-m-d  H:i:s');

          	$object = array(
             'kode_created' => $modul,
			'chat' => $chat,
             'username' => $nama,
             'waktu_chat' => $waktu
          );
         // $this->db->insert('modul_kerja_detail_sub_chat', $object);
        // echo json_encode($object,$data2,$data3);

		 $data_task['kode_created'] = $this->input->post('kode_modul_chat');
		 $data_task['chat'] = $this->input->post('chat');
		 $firstname = $this->input->post('firstname');
		 $jabatan = $this->input->post('jabatan');
		 $data_task['username'] = $firstname.' '. $jabatan;
		 $data_task['waktu_chat'] = date('Y-m-d H:i:s');
		 $this->m_kerja->save_detail_chat_sub($data_task); //simpan ke tabel log

        }
    	  public function saved_kontributor()
	{ 	
			date_default_timezone_set('Asia/Jakarta');	
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_kontribusi');
			$penerima = $this->input->post('penerima');
			$keterangan =  'Add';

			$atdnc_data1['kode_modul_kontribusi'] = $this->input->post('kode_modul_kontribusi');
			$atdnc_data1['penerima'] =  $this->input->post('penerima');
			$atdnc_data1['createdby_kontribut'] = $this->session->login['nama'];
			$atdnc_data1['createdtime_kontribut'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_contributor($atdnc_data1);

			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Add Contributor';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_kontribusi');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$kepada = $this->input->post('kepada'); 
			$dari  = $this->input->post('firstname');
			$id_modul = $this->input->post('kode_modul_kontribusi');
			$noted = 'Add Contribut,Task Id'.' '.$id_modul;
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
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log

          $chat = $keterangan.' '.$penerima;
          $modul = $this->input->post('kode_modul_kontribusi');
          $firstname = $this->input->post('firstname');
          $nama = $firstname.' '. $this->session->login['jabatan'];
          $waktu = date('Y-m-d  H:i:s');
          $object = array(
             'kode_modul_chat' => $modul,
			'chat' => $chat,
             'username' => $nama,
             'waktu_chat' => $waktu
          );
          $this->db->insert('modul_kerja_chat', $object);
         echo json_encode($object, $object2);

        }
		public function save_chat(){
			date_default_timezone_set('Asia/Jakarta');
			$link = $this->input->post('kode_modul_chat');
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$atdnc_data['chat'] = $this->input->post('chat');
			$atdnc_data['username'] = $this->session->login['nama'];
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Comment Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_chat');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('mod_kerja/detail/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
	  public function save_laporan($id = NULL) {
		date_default_timezone_set('Asia/Jakarta');
		$data['kode_modul'] = $this->input->post('kode_modul');
        $data['tgl_selesai'] = date('Y-m-d H:i:s');
        $data['status_modul'] = '3';
		$data['keterangan_modul'] = $this->input->post('keterangan_modul');
        $data['user'] = $this->session->login['nama'];
        $data['updatetime'] = date('Y-m-d H:i:s');
    	$this->m_kerja->save_mymodul($data);

			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul');
			$keterangan =  'Finish Task';
			$atdnc_data['chat'] = $keterangan;
			$atdnc_data['username'] = $this->session->login['nama'];
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

			//untuk log
      		$data_log['user'] = $this->input->post('createdby');
			$data_log['waktu'] = $this->input->post('createdtime');
			$nama =  $this->input->post('kode_modul');
			$keterangan =  $this->input->post('ket');
			$data_log['ket'] = $keterangan.' '.$nama;
			$data_log['kode'] = $this->input->post('kode_modul');
			$this->m_mom->tambah_log($data_log); //simpan ke tabel log

        //   echo '<pre>';
        //  // print_r ($_POST);
        // echo '</pre>';
       //print POST
        //print_r($this->db->last_query()); //print query
        //exit;
        $this->session->set_flashdata('error', 'Laporan <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Laporan Project <strong>Berhasil</strong> Ditambahkan!');
        redirect('mod_kerja/proses'); //redirect page
      

          //  show_error($this->email->print_debugger());
        

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
			redirect('mod_kerja/detail/'.$link);
		

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
			redirect('mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
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

			$atdnc_data['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kodet');
			$atdnc_data['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_data['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_data['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Update Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_create');
			$this->m_asset->tambah_log($data); //simpan ke tabel log



		

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('mod_kerja/detail/'.$link);
		

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

			$atdnc_data['file_detail_sub'] = $this->upload->data("file_name");
		}
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kodet');
			$atdnc_data['status_task_sub'] = $this->input->post('status_task_sub');
			$atdnc_data['deskripsi_detail_sub'] = $this->input->post('deskripsi_detail_sub');
			$atdnc_data['kode_create'] = $this->input->post('kode_create');
			$this->m_kerja->save_chat_detail_sub($atdnc_data);


			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Update Detail Task';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_create');
			$this->m_asset->tambah_log($data); //simpan ke tabel log



		

			$this->session->set_flashdata('error', 'Data  <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data  <strong>Berhasil</strong> Ditambahkan!');
			redirect('mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
    	public function save_berkas(){
	
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
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$firstname = $this->input->post('firstname');
			$atdnc_data['username'] = $firstname.' '. $this->session->login['jabatan'];
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);


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
			redirect('mod_kerja/detail/'.$link);
		

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
			$atdnc_data['username'] = $firstname.' '. $this->session->login['jabatan'];
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
			redirect('mod_kerja/detail/'.$link);
		

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
			$atdnc_data['username'] = $firstname.' '. $this->session->login['jabatan'];
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
			redirect('mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
   	public function save_berkas_kontribut(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
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
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$firstname = $this->input->post('firstname');
			$atdnc_data['username'] = $firstname.' '. $this->session->login['jabatan'];
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);


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
			redirect('mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
	    	public function save_berkas_user(){
	
	if (!empty($_FILES['berkas']['name'])) {
		$config['upload_path']          = './img/uploads/berkas1';
		$config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg|xlsx|xls|docx|doc';
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
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
			$atdnc_data['username'] = $firstname.' '. $jabatan;
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

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

			$kepada1 = $this->input->post('kepada2'); 
			$dari1  = $this->input->post('firstname');
			$id_modul1 = $this->input->post('kode_modul_chat');
			$noted1 = 'Add File,Task Id'.' '.$id_modul;
			$creat_at1 = date('Y-m-d  H:i:s');
          	$object3 = array(
             'id_modul' => $id_modul1,
			'kepada' => $kepada1,
             'dari' => $dari1,
             'noted' => $noted1,
             'creat_at' => $creat_at1
          );
 
			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		    	public function save_berkas_user_kontribut(){
	
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
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
			$atdnc_data['username'] = $firstname.' '. $jabatan;
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

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

			$kepada1 = $this->input->post('kepada2'); 
			$dari1  = $this->input->post('firstname');
			$id_modul1 = $this->input->post('kode_modul_chat');
			$noted1 = 'Add File,Task Id'.' '.$id_modul;
			$creat_at1 = date('Y-m-d  H:i:s');
          	$object3 = array(
             'id_modul' => $id_modul1,
			'kepada' => $kepada1,
             'dari' => $dari1,
             'noted' => $noted1,
             'creat_at' => $creat_at1
          );
 
			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_kontribut/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		    	public function save_berkas_user_creat(){
	
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
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_chat');
			$firstname = $this->input->post('firstname');
			$jabatan = $this->input->post('jabatan');
			$atdnc_data['username'] = $firstname.' '. $jabatan;
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

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

			$kepada1 = $this->input->post('kepada2'); 
			$dari1  = $this->input->post('firstname');
			$id_modul1 = $this->input->post('kode_modul_chat');
			$noted1 = 'Add File,Task Id'.' '.$id_modul;
			$creat_at1 = date('Y-m-d  H:i:s');
          	$object3 = array(
             'id_modul' => $id_modul1,
			'kepada' => $kepada1,
             'dari' => $dari1,
             'noted' => $noted1,
             'creat_at' => $creat_at1
          );
 
			$kepadanya= $this->input->post('kepada2'); 
			$dari2  = $this->input->post('firstname2');
			$id_modul2 = $this->input->post('kode_modul_chat2');
			$noted2 =  $this->input->post('noted2');
			$creat_at2 =  $this->input->post('creat_at2');
			$this->m_kerja->insert_notif($kepadanya,$dari2,$id_modul2,$noted2,$creat_at2); //simpan ke tabel log

			$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('user/mod_kerja/detail_creat/'.$link);
		

      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;
	}
		public function save_kontribusi(){
			date_default_timezone_set('Asia/Jakarta');	
			$link = $this->input->post('kode_modul_kontribusi');
			$atdnc_data['kode_modul_chat'] = $this->input->post('kode_modul_kontribusi');
			$penerima = $this->input->post('penerima');
			$keterangan =  'Add';
			$atdnc_data['chat'] = $keterangan.' '.$penerima;
			$atdnc_data['username'] = $this->session->login['nama'];
			$atdnc_data['waktu_chat'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_chat($atdnc_data);

			$atdnc_data1['kode_modul_kontribusi'] = $this->input->post('kode_modul_kontribusi');
			$atdnc_data1['penerima'] =  $this->input->post('penerima');
			$atdnc_data1['createdby_kontribut'] = $this->session->login['nama'];
			$atdnc_data1['createdtime_kontribut'] = date('Y-m-d  H:i:s');
			$this->m_kerja->save_contributor($atdnc_data1);

			$data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$keterangan =  'Add Contributor';
			$data['ket'] = $keterangan;
			$data['kode'] = $this->input->post('kode_modul_kontribusi');
			$this->m_asset->tambah_log($data); //simpan ke tabel log

      	$this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Ditambahkan!');
			$this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Ditambahkan!');
			redirect('mod_kerja/detail/'.$link);
		
      //  echo '<pre>';
     //   print_r ($_POST);
      //  echo '</pre>';
     //   exit;

	}
}