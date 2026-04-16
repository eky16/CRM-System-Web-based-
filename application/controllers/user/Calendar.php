<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->login['role'] == ''){
			$this->session->set_flashdata('error01', 'Sessi Berakhir, Login Kembali!');
		redirect('login');
		}
		
		$this->load->model('Fullcalendar_model', 'm_calendar'); 
		$this->load->model('M_asset', 'm_asset'); 
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_sop', 'm_sop');
		$this->load->model('M_karyawan', 'm_karyawan');
		$this->load->model('M_kerja', 'm_kerja');
		$this->load->model('m_pembelian', 'm_pembelian');
		$this->load->helper(array('form', 'url'));
	}


	public function index($id_lsp = NULL){
		$this->data['title'] = 'Calendar';

		$this->data['aktif'] = 'calendar';
		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
        $this->data['isi'] = $this->m_sop->lihat_07(); //tampilkan sop menu	

		$this->load->view('user/calendar/fullcalendar', $this->data);
	}
	function load()
	{
		$event_data = $this->m_calendar->fetch_all_event();

		foreach($event_data->result_array() as $row)
		{
			if($row['mode'] == '' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'backgroundColor'	=>	"#FAF6A2"
			
				
			);
			}
		if($row['mode'] == 'leadsproject' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'backgroundColor'	=>	"#45FCE3"
			
				
			);
			}
		if($row['mode'] == 'task' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'backgroundColor'	=>	"#E4F534"
			
				
			);
			}
		if($row['mode'] == 'cuti' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'backgroundColor'	=>	"#F5DB34"
			
				
			);
			}
		}
		echo json_encode($data);
	}
	    public function kalender1()
    {
        $data['result'] = $this->db->get("events")->result();
   
        foreach ($data['result'] as $key => $value) {
        	$data['data'][$key]['id'] = $value->id;
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['start'] = $value->start_event;
            $data['data'][$key]['end'] = $value->end_event;
            $data['data'][$key]['backgroundColor'] = "#FAF6A2";
        }
           
        $this->load->view('my_calendar1', $data);
    }
	function insert()
	{
		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		if($this->input->post('title'))
		{	
			date_default_timezone_set('Asia/Jakarta');
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);
			
			$user = $kalimat_new1;
			$isi = $this->input->post('title');
			$data['title'] = $user.' - '.$isi ;
			$data['start_event'] = $this->input->post('start');
			$data['end_event'] = $this->input->post('end');
			$data['mode'] = $this->input->post('divisi');
			$data['create_by'] = $this->session->login['nama'];
			$data['time_create'] = date('Y-m-d H:i:s');
			$this->m_calendar->insert_event($data);
		}
	}
	function insert_reload()
	{
		if($this->input->post('title'))
		{	
			date_default_timezone_set('Asia/Jakarta');
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);
			
			$user = $kalimat_new1;
			$isi = $this->input->post('title');
			$data['title'] = $user.' - '.$isi ;
			$data['start_event'] = $this->input->post('start');
			$data['end_event'] = $this->input->post('end');
			$data['mode'] = $this->input->post('divisi');
			$data['create_by'] = $this->session->login['nama'];
			$data['time_create'] = date('Y-m-d H:i:s');
			$this->m_calendar->insert_event($data);
			$this->session->set_flashdata('error', 'Event <strong>Gagal</strong> Ditambahkan!');
        	$this->session->set_flashdata('success', 'Event <strong>Berhasil</strong> Ditambahkan!');
        	redirect('user/calendar'); //redirect page
		}
	}
	function update()
	{
		if($this->input->post('id'))
		{
			$data = array(
				'title'			=>	$this->input->post('title'),
				'start_event'	=>	$this->input->post('start'),
				'end_event'		=>	$this->input->post('end')
			);

			$this->m_calendar->update_event($data, $this->input->post('id'));
		}
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			$this->m_calendar->delete_event($this->input->post('id'));
		}
	}

	public function myevent($id_lsp = NULL){
		$this->data['title'] = 'Personal Notes Calendar';

		$this->data['aktif'] = 'mycalendar';

		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);

	    $this->data['count_task'] = count($this->m_kerja->my_modul()); // get resutl 
	    $this->data['view_task'] = $this->m_kerja->my_modul();
		$this->data['pm_data1'] = count($this->m_pembelian->lihat_data_pr_status1()); // hitung jumlah approve project manager data status 1
		$this->data['estimator_data2'] = count($this->m_pembelian->lihat_data_pr_status2()); // hitung jumlah approve estimator data status 2
		$this->data['estimator_data4'] = count($this->m_pembelian->lihat_data_po_status4()); // hitung jumlah approve estimator data status 4
		$this->data['purchasing_data3'] = count($this->m_pembelian->lihat_data_pr_status3()); // hitung jumlah approve purchasing data status 3
		$this->data['purchasing_data9'] = count($this->m_pembelian->lihat_data_po_status9()); // hitung jumlah approve purchasing data status 3
        $this->data['isi'] = $this->m_sop->lihat_07(); //tampilkan sop menu	

		$this->load->view('user/calendar/mycalendar', $this->data);
	}
	function myload()
	{
		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
		$event_data = $this->m_calendar->fetch_all_event_me($id);

		foreach($event_data->result_array() as $row)
		{
			if($row['mode'] == '' OR $row['mode'] == 'Business Development' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#FAF6A2"
			
				
			);
			}
		if($row['mode'] == 'leadsproject' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#45FCE3"
			
				
			);
			}
		if($row['mode'] == 'task' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#E4F534"
			
				
			);
			}  
		if($row['mode'] == 'cuti' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#EFF534"
			
				
			);
			}
		if($row['mode'] == 'karyawan' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#A4FCB1"
			
				
			);
			}
		if($row['mode'] == 'Design' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#A9CCE3"
				
			);
			}
		if($row['mode'] == 'Purchasing' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#D0D3D4"
				
			);
			}
		if($row['mode'] == 'Project' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" , 
				'backgroundColor'	=>	"#BB8FCE"
				
			);
			}
		if($row['mode'] == 'Qs' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" , 
				'backgroundColor'	=>	"#F8C471"
				
			);
			}
		if($row['mode'] == 'Finance & Acc' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" , 
				'backgroundColor'	=>	"#55F738"
				
			);
			}
		if($row['mode'] == 'Workshop' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" , 
				'backgroundColor'	=>	"#55F738"
				
			);
		}
		if($row['mode'] == 'IT' ){
			$data[] = array(
				'id'	=>	$row['id'],
				'title'	=>	$row['title'],
				'start'	=>	$row['start_event'],
				'end'	=>	$row['end_event'],
				'mode'	=>	$row['mode'],
				'textColor'	=>	"#17202A" , 
				'backgroundColor'	=>	"#3886F7"
				
			);
			}
		}
		echo json_encode($data);
	}
	function myload_sch()
	{
		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);
	    $id_status = 2;
		$event_data = $this->m_calendar->fetch_all_event_sch();

		foreach($event_data->result_array() as $row)
		{
			
			$data[] = array(
				'id'	=>	$row['id_pengiriman'],
				'title'	=>	$row['proyek'] .' - '. $row['ket_pengiriman'] .' | '. $row['waktu_pengiriman'],
				'start'	=>	$row['tgl_pengiriman'],
				'textColor'	=>	"#17202A" ,
				'backgroundColor'	=>	"#FAF6A2"
			
				
			);
			
		}
		echo json_encode($data);
	}
	function myinsert()
	{
		$id = $this->session->login['kode'];
	    $this->data['emp'] = $this->m_karyawan->view_profile_employee($id);


		if($this->input->post('title'))
		{	
			date_default_timezone_set('Asia/Jakarta');
			$myvalue = $this->session->login['nama'];
			$arr = explode(' ',trim($myvalue));
			$kalimat_pertama = $arr[0]; // will print Test
			$kalimat_new = strtolower($kalimat_pertama);
			$kalimat_new1 = ucfirst($kalimat_new);
			
			$user = $kalimat_new1;
			$isi = $this->input->post('title'); 
			$data['title'] = $isi.' - '.$user ;
			$data['start_event'] = $this->input->post('start');
			$data['end_event'] = $this->input->post('end');
			$data['mode'] = $this->input->post('divisi');
			$data['EmployeeID'] = $id;
			$data['create_by'] = $this->session->login['nama'];
			$data['time_create'] = date('Y-m-d H:i:s');
			$this->m_calendar->insert_myevent($data);
		}
	}

	function myupdate()
	{
		if($this->input->post('id'))
		{
			$data = array(
				'title'			=>	$this->input->post('title'),
				'start_event'	=>	$this->input->post('start'),
				'end_event'		=>	$this->input->post('end')
			);

			$this->m_calendar->update_myevent($data, $this->input->post('id'));
		}
	}

	function mydelete()
	{
		if($this->input->post('id'))
		{
			$this->m_calendar->delete_myevent($this->input->post('id'));
		}
	}

}


?>