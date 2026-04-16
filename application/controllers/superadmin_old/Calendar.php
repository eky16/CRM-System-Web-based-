<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct()
	{
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
		$this->data['aktif'] = 'calendar';
		$this->load->model('Fullcalendar_model', 'm_calendar'); 
		$this->load->model('M_asset', 'm_asset'); 
		$this->load->model('M_izin', 'm_izin');
		$this->load->model('M_reimburs', 'm_reimburs');
		$this->load->model('M_payment', 'm_payment');
		$this->load->model('M_sop', 'm_sop');
		$this->load->helper(array('form', 'url'));
	}


	public function index($id_lsp = NULL){
		$this->data['title'] = 'Calendar';

		$this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
		$this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
		$this->data['atasan'] = $this->m_izin->persetujuan_atasan();
		$this->data['hrd'] = $this->m_izin->persetujuan_hrd();

   		$this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['isi'] = $this->m_sop->lihat_07(); //tampilkan sop menu	

		$this->load->view('calendar/fullcalendar', $this->data);
	}
	function load()
	{
		$event_data = $this->m_calendar->fetch_all_event();

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
			$data['create_by'] = $this->session->login['nama'];
			$data['time_create'] = date('Y-m-d H:i:s');
			$this->m_calendar->insert_event($data);
			$this->session->set_flashdata('error', 'Event <strong>Gagal</strong> Ditambahkan!');
        	$this->session->set_flashdata('success', 'Event <strong>Berhasil</strong> Ditambahkan!');
        	redirect('calendar'); //redirect page
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


}

?>