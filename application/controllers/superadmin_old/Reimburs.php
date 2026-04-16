<?php

use Dompdf\Dompdf;

class Reimburs extends CI_Controller{
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
        $this->load->model('M_reimburs', 'm_reimburs');
        $this->load->model('M_karyawan', 'm_karyawan');
        $this->load->model('M_kerja', 'm_kerja');
        $this->load->model('M_izin', 'm_izin');
        $this->load->model('M_asset', 'm_asset');
        $this->load->model('M_payment', 'm_payment');
        $this->load->model('M_petty_cash', 'm_petty_cash');
        $this->load->model('M_sop', 'm_sop');
        $this->load->model('m_pembelian', 'm_pembelian');
        $this->load->helper(array('form', 'url','string'));
	}
    public function laporan_01($id_lsp = NULL){
        $this->data['aktif'] = 'rembes';
        $this->data['title'] = 'Riwayat Reimbursement';
        //$this->data['all_Mom'] = $this->m_mom->lihat();
        $this->data['no'] = 1;
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
      //  $this->data['all_leads_project'] = $this->m_mom->get_lsp();
    //  $this->data['proyek'] = $this->m_mom->get_project();
      //  $this->data['vendor'] = $this->m_payment->lihat();
        $this->data['proyek'] = $this->m_reimburs->get_proyek();
        $project = $this->input->post('project');
        $this->data['all_reimbus'] = $this->m_reimburs->view_reimbus_end_laporan($project); 
        $this->data['grand_total'] = $this->m_reimburs->view_reimbus_end_laporan_total($project);

    //  $url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
        $url_cetak = 'reimburs/export_excel_01?filter=1&project='.$project;
        $this->data['url_cetak_excel'] = base_url($url_cetak);

        $this->load->view('reimburs/laporan01', $this->data);
    }
    public function laporan_001($project = null){
        $this->data['aktif'] = 'rembes';
        $this->data['title'] = 'Riwayat Reimbursement';
        //$this->data['all_Mom'] = $this->m_mom->lihat();
        $this->data['no'] = 1;
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
      //  $this->data['all_leads_project'] = $this->m_mom->get_lsp();
    //  $this->data['proyek'] = $this->m_mom->get_project();
      //  $this->data['vendor'] = $this->m_payment->lihat();
        $this->data['proyek'] = $this->m_reimburs->get_proyek001();
      //  $project = $this->input->post('project');
        $this->data['all_reimbus'] = $this->m_reimburs->view_reimbus_end_laporan001($project); 
        $this->data['grand_total'] = $this->m_reimburs->view_reimbus_end_laporan_total001($project);

    //  $url_cetak = 'pembelian/export_excel_01?filter=1&project='.$project;
        $url_cetak = 'reimburs/export_excel_001?filter=1&project='.$project;
        $this->data['url_cetak_excel'] = base_url($url_cetak);

        $this->load->view('reimburs/laporan02', $this->data);
    }
public function export_excel_001(){
       $this->data['title'] = "CASSA DESIGN";

        $project = $_GET['project'];
     
        $ket = 'Laporan Reimbursement Proyek'. $project;

        $penerimaan =$this->data['penerimaan'] = $this->m_reimburs->view_reimbus_end_laporan001($project); //Lihat History Petty Cash

    //  $url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
    //  $url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
        
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_reimburs->view_reimbus_end_laporan_total001($project);
        $this->load->view('reimburs/laporan_excel_01', $this->data);
    }
public function export_excel_01(){
       $this->data['title'] = "CASSA DESIGN";

        $project = $_GET['project'];
     
        $ket = 'Laporan Reimbursement Proyek'. $project;

        $penerimaan =$this->data['penerimaan'] = $this->m_reimburs->view_reimbus_end_laporan($project); //Lihat History Petty Cash

    //  $url_cetak = 'penerimaan/export1?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal;
    //  $url_cetak_excel = 'penerimaan/export_excel_01?filter=1&tanggal='.$tanggal.'&dan_tanggal='.$dan_tanggal.'&supplier='.$supplier;
        
        $this->data['ket'] = $ket;
      //  $this->data['url_cetak'] = base_url($url_cetak);
        $this->data['mdl'] = $penerimaan;
        $this->data['grand_total'] = $this->m_reimburs->view_reimbus_end_laporan_total($project);
        $this->load->view('reimburs/laporan_excel_01', $this->data);
    }
    public function index($id_lsp = NULL){

        $this->data['aktif'] = 'rembes';
        $this->data['title'] = 'LIST REIMBURSEMENT'; 
        $this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

         $this->data['all_dept_info'] = $this->m_reimburs->view_reimbus_p();

        $this->load->view('reimburs/pending', $this->data);
    }

    public function tambah_r(){
        $this->data['title'] = 'Tambah Reimbursement Baru';
        $this->data['aktif'] = 'rembes';
        $this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['kode_reimburs'] = $this->m_reimburs->kode_reimburs();
       // $this->data['employee'] = $this->m_reimburs->get_employee();
        $this->data['category'] = $this->m_reimburs->get_kategori();
        $this->data['category_sub'] = $this->m_reimburs->get_kategori_sub();  
        $this->data['proyek'] = $this->m_kerja->get_proyek();
        $this->data['isi'] = $this->m_sop->lihat_05(); //tampilkan sop menu


        $this->load->view('reimburs/tambah_reimburs', $this->data);
    }
        function proses()
    {
        $id = $this->input->post('kode_reimburs1',TRUE);
    //  $this->db->delete('modul_kerja_sub', array('kode_modul' => $id));

        $config['upload_path']          = './img/uploads/reimburs/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
        $config['max_size']             = 10000;
        $config['max_width']            = 6048;
        $config['max_height']           = 4000;
        $config['encrypt_name']         = true;
        $this->load->library('upload',$config);

        
        $idnya = $this->input->post('kode_reimburs',TRUE);
        $createddate_reimbus = $this->input->post('createddate_reimbus',TRUE);
        $tanggal_reimbus = $this->input->post('tanggal_reimbus',TRUE);
        $kategori_reimburss = $this->input->post('kategori_reimburss',TRUE);
        $kategori_reimburs = $this->input->post('kategori_reimburs',TRUE);
        $nominal = $this->input->post('nominal',TRUE);
        $name_project = $this->input->post('name_project',TRUE);
        $total_km = $this->input->post('total_km',TRUE);
        $keterangan = $this->input->post('keterangan',TRUE);

        $jumlah_berkas = count($_FILES['berkas']['name']);
        
        for($i = 0; $i < $jumlah_berkas;$i++)
        {
                  if (!empty($_FILES['foto_km_after']['name'][$i])) {
            $this->upload->do_upload('foto_km_after');
            $data_dt['foto_km_after'] = $this->upload->data("file_name");
            }

            if(!empty($_FILES['berkas']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
       

                $this->upload->do_upload('file');
                
                    $uploadData = $this->upload->data();
                    $foto = $uploadData['file_name'];
                    $data_dt['foto_reimburs'] = $uploadData['file_name'];
    //  echo '<pre>';
    //   print_r ($_POST);
     //   print_r ($foto);
    ////   echo '</pre>';
     //   exit;
                    $data_dt['kode_reimbus'] = $idnya[$i];
                    $data_dt['kategori_reimburs'] = $kategori_reimburs[$i];
                    $data_dt['total_km'] = $total_km[$i];
                    $data_dt['nominal'] = $nominal[$i];
                    $data_dt['tipe_berkas'] = $uploadData['file_ext'];
                    $data_dt['ukuran_berkas'] = $uploadData['file_size'];
                    //$this->db->insert('modul_kerja_sub',$data);
                    $this->db->insert('cassa_reimbursement_sub',$data_dt);
                  //  $this->m_reimburs->insert_dt($data_dt);
                    date_default_timezone_set('Asia/Jakarta');
                    $data['user_reimbus'] = $this->session->login['nama'];
                    $data['kode_reimbus'] = $id;
                    $data['keterangan'] = $keterangan;
                    $data['name_project'] = $name_project;
                    $data['tanggal_reimbus'] = $tanggal_reimbus;
                    $data['createddate_reimbus'] = date('Y-m-d H:i:s');;
                    $this->m_reimburs->insert_hd($data);
            }       
             
        }
                

    $this->session->set_flashdata('error', 'Reimburs <strong>Gagal</strong> Disimpan!');
    $this->session->set_flashdata('success', 'Reimburs <strong>Berhasil</strong> Disimpan!');
    redirect('reimburs');

    }

        public function finish($id_lsp = NULL){

        $this->data['aktif'] = 'rembes';
        $this->data['title'] = 'LIST REIMBURSEMENT';
        $this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();

         $this->data['all_dept_info'] = $this->m_reimburs->view_reimbus_s();

        $this->load->view('reimburs/pending', $this->data);
    }
        public function rfinish($id_lsp = NULL){

        $this->data['aktif'] = 'rembes';
        $this->data['title'] = 'LIST REIMBURSEMENT';
        $this->data['no'] = 1;
        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        
         $this->data['all_dept_info'] = $this->m_reimburs->view_reimbus_end();

        $this->load->view('reimburs/pending', $this->data);
    }
      public function save_proses_cek(){

      //     echo '<pre>';
     //   print_r ($_POST);
     //   echo '</pre>';
     //   exit;
            date_default_timezone_set('Asia/Jakarta');
            $cek = $this->input->post('kategori_reimburs');

            $hasil = 'BENSIN (Kendaraan Pribadi)';
            if ($cek == $hasil ) {
            $link = $this->input->post('kode_reimbus');
            $atdnc_data['id_sub'] = $this->input->post('id_sub');
            $atdnc_data['status_cek'] = $this->input->post('status_cek');
            $atdnc_data['user_cek'] = $this->session->login['nama'];
            $atdnc_data['nominal_tf'] = $this->input->post('nominal');
            $atdnc_data['nominal'] = $this->input->post('nominal');
            $atdnc_data['date_cek'] = date('Y-m-d H:i:s');
            $this->m_reimburs->save_proses_cek($atdnc_data); //simpan ke tabel log
        }

            if ($cek != $hasil ) {
            $link = $this->input->post('kode_reimbus');
            $atdnc_data['id_sub'] = $this->input->post('id_sub');
            $atdnc_data['status_cek'] = $this->input->post('status_cek');
            $atdnc_data['user_cek'] = $this->session->login['nama'];
            $atdnc_data['nominal_tf'] = $this->input->post('nominal_tf');
            $atdnc_data['catatan'] = $this->input->post('catatan');
            $atdnc_data['date_cek'] = date('Y-m-d H:i:s');
            $this->m_reimburs->save_proses_cek($atdnc_data); //simpan ke tabel log
 }
            $data['user'] = $this->session->login['nama'];
            $data['waktu'] = date('Y-m-d H:i:s');
            $keterangan =  'Cek Reimburs';
            $data['ket'] = $keterangan;
            $data['kode'] = $link;

            $this->m_asset->tambah_log($data); //simpan ke tabel log

            $this->session->set_flashdata('error', 'Status Reimburs <strong>Gagal</strong> Diubah!');
            $this->session->set_flashdata('success', 'Status Reimburs <strong>Berhasil</strong> Diubah!');
            redirect('reimburs/detail/'.$link);
    }

          public function save_proses_transfer(){
date_default_timezone_set('Asia/Jakarta');
            $cek_metode = $this->input->post('metode_pembayaran');
            $dibayarkan = $this->input->post('total_bayar');
            $saldo_sekarang = $this->input->post('saldo_petty');

            if ($cek_metode == 'Petty Cash' and $saldo_sekarang >= $dibayarkan) {
if (!empty($_FILES['berkas']['name'])) {
        $config['upload_path']          = './img/uploads';
        $config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
        $config['max_size']             = 10000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('berkas');
        // $file1 = $this->upload->data();
        //    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

            $atdnc_data['bukti_bayar'] = $this->upload->data("file_name");
}
            $link = $this->input->post('kode_reimbus');

            $where = array('kode_reimbus' => $link);
            $atdnc_data['status_reimbus'] = '3';
            $atdnc_data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
            $atdnc_data['tgl_transfer_real'] = $this->input->post('tgl_transfer_real');
            $atdnc_data['user_bayar'] = $this->session->login['nama'];
            $atdnc_data['tgl_bayar'] = date('Y-m-d H:i:s');
           $this->m_reimburs->set_action($where, $atdnc_data, 'cassa_reimbursement');

            $atdnc_dat['jenis'] = 'Petty Cash';
            $hitung_saldo = $saldo_sekarang - $dibayarkan;
            $atdnc_dat['saldo'] = $hitung_saldo;
            $atdnc_dat['saldo_updateby'] = $this->session->login['nama'];
            $atdnc_dat['saldo_UpTime'] = date('Y-m-d H:i:s');
            $this->m_petty_cash->save_topup($atdnc_dat); //simpan ke tbl_petty_cash

            $atdnc_dataa['jenis_pety_cash'] = 'Saldo Keluar'; 
            $atdnc_dataa['nominal_petty_cash'] = $dibayarkan;
            $atdnc_dataa['kode_topup'] = $this->input->post('kode_reimbus');
            $atdnc_dataa['saldo_before'] = $saldo_sekarang;
            $atdnc_dataa['created_log_petty_cash'] = $this->session->login['nama'];
            $atdnc_dataa['tgl_log_petty_cash'] = date('Y-m-d H:i:s');
            $atdnc_dataa['tgl_transaksi_petty'] = $this->input->post('tgl_transfer_real');
            $atdnc_dataa['tgl_prosess'] = date('Y-m-d');
            $this->m_petty_cash->save_topup_log($atdnc_dataa); //simpan ke topup tbl_petty_cash_in_out

            $ket1 = $this->input->post('keterangan2');
            $ket2 = 'Reimburs';
            $namekar1 = $this->input->post('namekar1');
            $petty_data['noted_pety_cash'] = $ket2.'/'.$namekar1 .' - '.$ket1;  
            $petty_data['nominal_pembayaran'] = $dibayarkan;
            $petty_data['kode_pembayaran'] = $this->input->post('kode_reimbus');
            $petty_data['creat_by_pety_cash'] = $this->session->login['nama'];
            $petty_data['date_petty_cash'] = date('Y-m-d H:i:s');
            $this->m_petty_cash->save_topup_all_log($petty_data); //simpan ke semua riwayat tbl_petty_cash_list

            $data['user'] = $this->session->login['nama'];
            $data['waktu'] = date('Y-m-d H:i:s');
            $keterangan =  'Transfer Reimburs';
            $data['ket'] = $keterangan;
            $data['kode'] = $link;
            $this->m_asset->tambah_log($data); //simpan ke tabel log
            $this->session->set_flashdata('success', 'Bukti Transfer By Petty Cash <strong>Berhasil</strong> Disimpan!');
             redirect('reimburs/detail/'.$link);
            }

           if ($cek_metode == 'Dll') {
        if (!empty($_FILES['berkas']['name'])) {
        $config['upload_path']          = './img/uploads';
        $config['allowed_types']        = 'gif|jpg|png|JPG|pdf|jpeg';
        $config['max_size']             = 10000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('berkas');
        // $file1 = $this->upload->data();
        //    echo '<pre>';
    //    print_r ($file1);
    //   echo '</pre>';
     //   exit;

            $atdnc_data['bukti_bayar'] = $this->upload->data("file_name");
}
            $link = $this->input->post('kode_reimbus');

            $where = array('kode_reimbus' => $link);
            $atdnc_data['status_reimbus'] = '3';
            $atdnc_data['metode_pembayaran'] = $this->input->post('metode_pembayaran');
            $atdnc_data['user_bayar'] = $this->session->login['nama'];
            $atdnc_data['tgl_bayar'] = date('Y-m-d H:i:s');
           $this->m_reimburs->set_action($where, $atdnc_data, 'cassa_reimbursement');

            $data['user'] = $this->session->login['nama'];
            $data['waktu'] = date('Y-m-d H:i:s');
            $keterangan =  'Transfer Reimburs';
            $data['ket'] = $keterangan;
            $data['kode'] = $link;
            $this->m_asset->tambah_log($data); //simpan ke tabel log
            $this->session->set_flashdata('success', 'Bukti Transfer By Dll <strong>Berhasil</strong> Disimpan!');
             redirect('reimburs/detail/'.$link);
            }
            if($cek_metode == 'Petty Cash' and $saldo_sekarang <= $dibayarkan){
            $link = $this->input->post('kode_reimbus');
                $this->session->set_flashdata('error', 'Saldo Petty Cash Kurang!');
                 redirect('reimburs/detail/'.$link);
            }


            
     
    }

        
        public function save_proses_pengecekan(){

        date_default_timezone_set('Asia/Jakarta');
            $link = $this->input->post('kode_reimbus');

            $where = array('kode_reimbus' => $link);
            $atdnc_data['status_reimbus'] = '4';
            $atdnc_data['end_apprv'] = $this->session->login['nama'];
            $atdnc_data['end_time_apprv'] = date('Y-m-d H:i:s');
            $this->m_reimburs->set_action($where, $atdnc_data, 'cassa_reimbursement');


            $data['user'] = $this->session->login['nama'];
            $data['waktu'] = date('Y-m-d H:i:s');
            $keterangan =  'Mengetahui Reimburs';
            $data['ket'] = $keterangan;
            $data['kode'] = $link;
            $this->m_asset->tambah_log($data); //simpan ke tabel log

            $this->session->set_flashdata('error', 'Bukti Transfer <strong>Gagal</strong> Disimpan!');
            $this->session->set_flashdata('success', 'Bukti Transfer <strong>Berhasil</strong> Disimpan!');
            redirect('reimburs/finish');
    }
        public function detail_proses($id){ 
        $this->data['title'] = 'Details Reimbursement';
        //$this->data['all_Mom'] = $this->m_kerja->lihat();
        $this->data['no'] = 1;

        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        //update Status Reimbursment menjadi proses
            date_default_timezone_set('Asia/Jakarta');
            $where = array('kode_reimbus' => $id);
            $updata['proses_apprv'] = $this->session->login['nama'];
            $updata['status_reimbus'] = '2';
            $updata['time_apprv'] = date('Y-m-d H:i:s');

            $this->m_reimburs->set_action($where, $updata, 'cassa_reimbursement');

            $data['user'] = $this->session->login['nama'];
            $data['waktu'] = date('Y-m-d H:i:s');
            $keterangan =  'Proses Reimburs'; 
            $data['ket'] = $keterangan;
            $data['kode'] = $id;

            $this->m_asset->tambah_log($data); //simpan ke tabel log
        $this->data['hitung_reimbus'] = $this->m_reimburs->Hitung_total($id); //hitung total yang harus di bayar
        $this->data['all_dept_info'] = $this->m_reimburs->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_reimburs->detail_reimbus($v_dept_info->kode_reimbus,$id);
        }
        $id_saldo = 'Petty Cash';
        $this->data['petty_cash'] = $this->m_petty_cash->lihat_saldo($id_saldo); //Lihat Saldo Petty Cash
        $this->load->view('reimburs/details_reimbus', $this->data);
    }
        public function detail($id){
        $this->data['title'] = 'Details Reimbursement';
        //$this->data['all_Mom'] = $this->m_kerja->lihat();
        $this->data['no'] = 1;

        $this->data['izin_atasan'] = count($this->m_izin->persetujuan_atasan()); // get resutl
        $this->data['izin_hrd'] = count($this->m_izin->persetujuan_hrd()); // get resutl
        $this->data['atasan'] = $this->m_izin->persetujuan_atasan();
        $this->data['hrd'] = $this->m_izin->persetujuan_hrd();
        $this->data['reimbursment_count'] = count($this->m_reimburs->lihat_reimburs1()); // get resutl
        $this->data['reimbursment'] = $this->m_reimburs->lihat_reimburs1();
        $this->data['hitung_reimbus'] = $this->m_reimburs->Hitung_total($id); //hitung total yang harus di bayar

        $this->data['all_dept_info'] = $this->m_reimburs->lihat();
        // get all department info and designation info
        foreach ($this->data['all_dept_info'] as $v_dept_info) {
            $this->data['all_department_info'][] = $this->m_reimburs->detail_reimbus($v_dept_info->kode_reimbus,$id);
        }
                $id_saldo = 'Petty Cash';
        $this->data['petty_cash'] = $this->m_petty_cash->lihat_saldo($id_saldo); //Lihat Saldo Petty Cash
        $this->load->view('reimburs/details_reimbus', $this->data);
    }

	public function hapus($id){

			date_default_timezone_set('Asia/Jakarta');
		    $data['user'] = $this->session->login['nama'];
			$data['waktu'] = date('Y-m-d H:i:s');
			$data['ket'] = 'Hapus Reimbus';
			$data['kode'] = $id;
			$this->m_reimburs->tambah($data); //simpan ke tabel jenis izin


		if($this->m_reimburs->hapus_reimbus($id)){
            $this->m_reimburs->hapus_reimbus_sub($id);
			$this->session->set_flashdata('success', 'Reimburs <strong>Berhasil</strong> Dihapus!');
			redirect('reimburs');
		} else {
			$this->session->set_flashdata('error', 'Reimburs <strong>Gagal</strong> Dihapus!');
			redirect('reimburs');
		}
	}

	public function export($id){
	//	$dompdf = new Dompdf();
		$this->data['all_Mom'] = $this->m_reimburs->export_mom($id); 
		$this->data['title'] = 'MINUTES OF MEETING';
		$this->data['no'] = 1;

		$this->load->library('pdf'); // change to pdf_ssl for ssl
		$filename =  'M O M'.' '. $this->data['all_Mom']->status . ' ' . $this->data['all_Mom']->nama_project ;
		$html = $this->load->view('mom/report', $this->data, true);
		$this->pdf->create($html, $filename);
	}


}