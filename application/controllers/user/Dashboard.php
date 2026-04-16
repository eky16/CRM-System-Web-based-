<?php

class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
	if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_admin', 'm_admin'); 
		$this->load->model('M_pembelian', 'm_pembelian');
		$this->load->model('M_quotation', 'm_quotation');

	}

	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
       

		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

		
          
    $this->data['kpi'] = $this->m_quotation->hitung_total_quo();
    $this->data['tidak_bisa_estimasi'] = $this->m_quotation->hitung_tidak_bisa_estimasi();
    $this->data['overdue']   = $this->m_quotation->hitung_overdue();


		$this->load->view('user/dashboard_user', $this->data);
	}


     public function barang_dibawah_stok_minimum() {
          $data['all_barang'] = $this->m_barang->get_barang_dibawah_stok_minimum();
          $this->load->view('user/dashboard_user', $data);
       
         }

	public function sidebar(){
		$id = $this->session->login['kode'];
		$this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	
		$this->load->view('partials/sidebar', $this->data);
	}



}