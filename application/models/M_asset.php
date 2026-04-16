<?php

class M_asset extends CI_Model{
	protected $_table = 'alba_asset';
	protected $_table_status = 'alba_department';
    protected $_table_log = 'cassa_log';
    protected $_table_leads = 'leads_project';
   

   
      public function get_add_department_by_id($id_dept) {
        $this->db->select('alba_department.department', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->from('alba_department');
        $this->db->join('alba_divisi', 'alba_department.id_dept = alba_divisi.id_dept', 'left');
        $this->db->where('alba_department.id_dept', $id_dept);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

   function get_department(){
        $query = $this->db->get('alba_department');
        return $query;  
    }
    
   function get_jabatan(){
        $query = $this->db->get('alba_divisi');
        return $query;  
    }

   function get_atasan(){
        $query = $this->db->get('alba_karyawan');
        return $query;  
    }
	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}
	public function get3(){
		$query = $this->db->get($this->_table_status);
		return $query->result();
	}
    public function get_leads(){
        $query = $this->db->get($this->_table_leads);
        return $query->result();
    }
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}
 
	public function lihat_id($id_asset){
		$query = $this->db->get_where($this->_table, ['id_asset' => $id_asset]);
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}
    public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }
	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function min_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}
	public function ubah111($atdnc_data2, $id_mom){
    $this->db->where('id_mom',$id_mom);
    $this->db->update('cassa_mom', $atdnc_data2);
    return TRUE;
	}
    public function ubah4($data, $id){
    $this->db->where('id',$id);
    $this->db->update('cassa_mom', $data);
    return TRUE;
    }
	public function save_mom_goal($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_mom_history WHERE id_mom = '{$atdnc_data['id_mom']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_mom_history', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( id_mom ='" . $atdnc_data['id_mom'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_mom_history', $atdnc_data); 
    }
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['kode_asset' => $id]);
	}

public function delete($id){
            $_id = $this->db->get_where('cassa_asset',['kode_asset' => $id])->row();
            $query = $this->db->delete('cassa_asset',['kode_asset'=>$id]);
            if($query){
                unlink("./img/uploads/foto_asset/".$_id->gambar_asset);
            }
                $this->session->set_flashdata('success', 'Data Asset <strong>Berhasil</strong> Dihapus!');
                    $this->session->set_flashdata('error', 'Data Asset <strong>Gagal</strong> Dihapus!');
            redirect('asset/lihat_semua');
        }

	public function save_asset($atdnc_data) 
    {
    $query = $this->db->query("SELECT * FROM cassa_asset WHERE kode_asset = '{$atdnc_data['kode_asset']}' ");
    $result = $query->result_array();
    $count = count($result);

    if (empty($count)) {

        $this->db->insert('cassa_asset', $atdnc_data); 
    }
    elseif ($count == 1) {
        $kondisi = "( ( ( kode_asset ='" . $atdnc_data['kode_asset'] . "')) )";
        $this->db->where($kondisi);
        $this->db->update('cassa_asset', $atdnc_data); 
    }
	}

	public function view_karyawan_all($EmployeeID = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
        $this->db->order_by('alba_karyawan.nama_karyawan','DESC');
      //  $this->db->order_by('cassa_mom.status', 'DESC');
        $kondisi = "( ( ( alba_karyawan.Active = 1) ) )";
        $this->db->where($kondisi);

    	if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        	//$this->db->where('cassa_mom.id_lsp', $id_lsp);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
  	public function view_profile($id = NULL) { 
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
		$this->db->where('alba_karyawan.id', $id);
    	if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        	$this->db->where('alba_karyawan.id', $id);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    }   

            public function tampil_asset($id = NULL) { 

        $this->db->from('cassa_asset');

        $this->db->where('cassa_asset.status', 'TERSEDIA');
        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('cassa_asset.status','TERSEDIA');
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    } 
        


    public function tampil_wajib_pajak($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_asset');
        $kondisi = "( (  ( cassa_asset.jenis_asset ='" . "Asset Bergerak" . "') 
        AND (datediff(cassa_asset.tgl_pajak, now()) <= 30 ) ) )";
        $this->db->where($kondisi);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function tampil_asset_rusak($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
        $this->db->from('cassa_asset');

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        $kondisi = "( ( ( cassa_asset.status ='" . "RUSAK" . "' OR cassa_asset.status ='" . "PERBAIKAN" . "' OR cassa_asset.status ='" . "TIDAK TERSEDIA" . "') ) )";
        $this->db->where($kondisi);
            $query_result = $this->db->get();
            $result = $query_result->result(); 
        }

        return $result;
    } 
    public function kode_asset(){

        $q = $this->db->query("SELECT MAX(RIGHT(kode_asset,4)) AS kode_asset FROM cassa_asset WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode_asset)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "ASSET".date('dmy').$kd;  
    }



}