<?php

class M_dept extends CI_Model{
	protected $_table = 'alba_department';
    protected $_table_ = 'alba_divisi';
    protected $_table_log = 'cassa_log';
	protected $_table_status = 'alba_department';
    protected $_table_leads = 'leads_project';
    
       public function lihat_dept_id($id){
        $query = $this->db->get_where($this->_table_status, ['id_dept' => $id]);
        return $query->row();
    }
    

public function tambah_log($data){
        return $this->db->insert($this->_table_log, $data);
    }

    public function lihat_div_id($id = NULL) { 
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->from('alba_divisi');
        $this->db->where('alba_divisi.id_dept',$id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;

    }  

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
    public function check_by($where, $tbl_name) {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

       public function save($data, $id = NULL) {

        // Set timestamps


        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
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


	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}
    public function kode_dept(){

        $q = $this->db->query("SELECT MAX(RIGHT(id_dept,4)) AS id_dept FROM alba_department WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_dept)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "DEPT".date('dmy').$kd;  
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


	public function hapus($id){
		return $this->db->delete($this->_table, ['id_asset' => $id]);
	}

    function create_package($kode_dept,$divisi,$name){
        $this->db->trans_start();
            //INSERT TO PACKAGE
            date_default_timezone_set("Asia/Bangkok");
            $data  = array(
                'id_dept' => $kode_dept,
                'department' => $name,
                'createdtime' => date('Y-m-d H:i:s') 
            );
            $this->db->insert('alba_department', $data);
            //GET ID PACKAGE
            $package_id = $this->db->insert_id();
            $result = array();
                foreach($divisi AS $key => $val){
                     $result[] = array(
                      'id_dept'   => $package_id,
                      'divisi'   => $_POST['divisi'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('alba_divisi', $result);
        $this->db->trans_complete();
        $this->session->set_flashdata('error', 'Data Department <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Department <strong>Berhasil</strong> Ditambahkan!');
            redirect('dept/lihat_semua');
    }

    function update_package($id,$package,$product){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
    $this->db->where('id_dept',$id);
    $this->db->update('alba_department', $package);
    //return TRUE;
            //DELETE DETAIL PACKAGE
            $this->db->delete('alba_divisi', array('id_dept' => $id));

            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'id_dept'   => $id,
                      'divisi'   => $_POST['divisi'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('alba_divisi', $result);
        $this->db->trans_complete();

        $this->session->set_flashdata('error', 'Data Department <strong>Gagal</strong> Ditambahkan!');
        $this->session->set_flashdata('success', 'Data Department <strong>Berhasil</strong> Ditambahkan!');
            redirect('dept/lihat_semua');
    }
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }


        public function tampil_asset($id = NULL) { 
      //  $this->db->select('alba_karyawan.*', FALSE);
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

 
    public function kode_asset(){

        $q = $this->db->query("SELECT MAX(RIGHT(id_asset,4)) AS id_asset FROM cassa_asset WHERE DATE(createdtime)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_asset)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "ASSET".date('dmy').$kd;  
    }



}