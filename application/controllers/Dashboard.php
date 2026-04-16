<?php

class Dashboard extends CI_Controller{
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
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_mom', 'm_mom');
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_leads', 'm_leads');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_kehadiran', 'm_kehadiran');
		$this->load->model('M_log', 'm_log');
		$this->load->model('M_asset', 'm_asset');
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('M_admin', 'm_admin'); 
		$this->load->model('Notify_Model');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_pembelian', 'm_pembelian');
	}
	 public function user_notifi()
    {
                
          $v=$this->input->post('view');
        echo  $op= $this->Notify_Model->fetch_data($v);
         
          return $op;
    
    }
	public function index(){
		$this->data['title'] = 'Halaman Dashboard';

		$this->load->view('dashboard', $this->data);
	}

		function data_log(){

		$this->data= $this->m_log->lihat();
		echo json_encode($this->data);
		
	}

		function proses_update(){
 
             date_default_timezone_set('Asia/Jakarta');
            $where = array('kepada' => $this->session->login['nama']);
            $updata['status_baca'] = '2';

            $this->m_reimburs->set_action($where, $updata, 'tbl_notif');
            redirect('mod_kerja/proses');
		
	}

	    	 public function user_notifi_admin()
    {      
        $v=$this->input->post('view');
        echo  $op= $this->m_admin->fetch_data_admin($v);
        return $op;
    
    }
}