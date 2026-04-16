<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	

	public function index() {
		$this->load->dbutil();
		$this->load->helper('file');
		
		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database.sql'
		);
		
		$backup = $this->dbutil->backup($config);
		
		$save = FCPATH.'data/backup-'.date("ymdHis").'-db.zip';
		
		write_file($save, $backup);
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	    public function database_backup() {
	    	date_default_timezone_set('Asia/Jakarta');
        $this->load->dbutil();
        //aturan database
        $prefs = array(
            'format' => 'zip',
            'filename' => 'albasist_system_prod.sql'
        );
        $backup = $this->dbutil->backup($prefs);

        //setting format nama database yang akan didownload
        $db_name = 'alba' . date("d-m-y H.i.s") . '.zip';
        $save = 'img/uploads/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);

    }
}