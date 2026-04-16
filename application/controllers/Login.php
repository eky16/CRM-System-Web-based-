<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_employee', 'm_employee');
		$this->load->model('M_pengguna', 'm_pengguna');
		
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){ 
		if($this->input->post('role') === 'karyawan') $this->_proses_login_karyawan($this->input->post('username'));
		elseif($this->input->post('role') === 'admin') $this->_proses_login_admin($this->input->post('username'));
		else {
			?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php
		}
	}

	protected function _proses_login_karyawan($username){
		$get_employee = $this->m_employee->lihat_username($username);
		if($get_employee){
			// Memverifikasi password dengan password_verify
			if (password_verify($this->input->post('password'), $get_employee->password)) {
				$session = [
					'kode' => $get_employee->kode,
					'department' => $get_employee->department,
					'divisi' => $get_employee->divisi,
					'nama' => $get_employee->nama,
					'akses' => $get_employee->akses,
					'username' => $get_employee->username,
					'password' => $get_employee->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('user/dashboard');
			} else { 
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}

	protected function _proses_login_admin($username) {
    $get_pengguna = $this->m_pengguna->lihat_username($username);
    
    if ($get_pengguna) {
        // Memverifikasi password dengan password_verify
        if (password_verify($this->input->post('password'), $get_pengguna->password)) {
            $session = [
                'kode' => $get_pengguna->kode,
                'nama' => $get_pengguna->nama,
                'username' => $get_pengguna->username,
                'akses' => $get_pengguna->akses,
                'password' => $get_pengguna->password, // Hanya disarankan untuk pengembangan keamanan, tidak disarankan untuk disimpan di session
                'jabatan' => $get_pengguna->jabatan,
                'role' => $this->input->post('role'),
                'jam_masuk' => date('H:i:s')
            ];

            $this->session->set_userdata('login', $session);
            $this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Password Salah!');
            redirect();
        }
    } else {
        $this->session->set_flashdata('error', 'Username Salah!');
        redirect();
    }
}

}