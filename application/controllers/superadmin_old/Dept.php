<?php

use Dompdf\Dompdf;

class Dept extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		$this->data['aktif'] = 'dept';
		$this->load->model('M_dept', 'm_dept');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_payment', 'm_payment');
		$this->load->helper(array('form', 'url'));
	}

	public function index($id_lsp = NULL){
		$this->data['title'] = 'Department';
		//$this->data['all_Mom'] = $this->m_dept->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
   //	$this->data['all_leads_project'] = $this->m_dept->get_lsp();

  //  $id_lsp = $this->input->post('id_lsp');
  //  $this->data['all_Mom'] = $this->m_dept->view_mom_filter($id_lsp); 

		$this->load->view('dept/lihat', $this->data);
	}
	public function lihat_semua(){
		$this->data['title'] = 'Department';
		//$this->data['all_Mom'] = $this->m_dept->lihat();
		$this->data['no'] = 1;
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
		
        $this->data['all_dept_info'] = $this->m_dept->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_dept->get_add_department_by_id($v_dept_info->id_dept);
        }

		$this->load->view('dept/lihat', $this->data);
	}

    public function ubah($id = NULL) {
$this->data['title'] = 'Ubah Department';
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        if ($id) { // retrive data from db by id
            // get all department by id
        $this->data['department_info'] = $this->m_dept->lihat_dept_id($id);

            // get all designation by department id
         $this->data['designation_info'] = $this->m_dept->lihat_div_id($id);

        }

        //page load
 		$this->load->view('dept/ubah', $this->data);
    }	   


	public function tambah($id_lsp = NULL){
		$this->data['title'] = 'Department';
		//$this->data['all_Mom'] = $this->m_dept->lihat();
		$this->data['no'] = 1;
		$this->data['kode_dept'] = $this->m_dept->kode_dept();
		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

		$this->load->view('dept/tambah', $this->data);
	}

	public function hapus($id){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_dept->hapus($id)){
			$this->session->set_flashdata('success', 'Data Department <strong>Berhasil</strong> Dihapus!');
			redirect('dept/lihat_semua');
		} else {
			$this->session->set_flashdata('error', 'Data Department <strong>Gagal</strong> Dihapus!');
			redirect('dept/lihat_semua');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_dept->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}



	function create(){
		$name = $this->input->post('department',TRUE);
		$kode_dept = $this->input->post('kode_dept',TRUE);
		$divisi = $this->input->post('divisi',TRUE);
		$this->m_dept->create_package($kode_dept,$divisi,$name);
		redirect('dept/lihat_semua');
	}

	function update(){

		$atdnc_data2['status_berjalan'] = 2;

		$id = $this->input->post('kode_dept',TRUE);
		$package['department'] = $this->input->post('department',TRUE);
		$product = $this->input->post('divisi',TRUE);
		$this->m_dept->update_package($id,$package,$product);
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
			$this->m_dept->save_dept($atdnc_data);

			$atdnc_div['id_dept'] = $this->input->post('kode_dept');
      $atdnc_div['divisi'] = $this->input->post('divisi');

			$this->m_dept->save_div($atdnc_div);

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
}