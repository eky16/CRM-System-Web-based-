<?php

class M_pengeluaran_mf extends CI_Model {
	protected $_table = 'alba_pengeluaran';

	public function lihat00000(){
		return $this->db->get($this->_table)->result();
	} 


  public function lihat_history_pengeluaran_all() { 
  
        $this->db->select('alba_customer.nama_cst', FALSE);
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->select('alba_pengeluaran_detail_keluar_mf.*', FALSE);
        $this->db->from('alba_pengeluaran_detail_keluar_mf');

        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_pengeluaran_detail_keluar_mf.nama_customer', 'left');
        
        $this->db->join('alba_pengeluaran', 'alba_pengeluaran.no_keluar = alba_pengeluaran_detail_keluar_mf.no_keluar_mf', 'left');

        $this->db->order_by('alba_pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

  public function lihat_history_pengeluaran($tanggal,$dan_tanggal = null) { 
  
        $this->db->where('alba_pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            ');	
	
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->select('alba_pengeluaran_detail_keluar_mf.*', FALSE);
        $this->db->from('alba_pengeluaran_detail_keluar_mf');
        $this->db->join('alba_pengeluaran', 'alba_pengeluaran.no_keluar = alba_pengeluaran_detail_keluar_mf.no_keluar_mf', 'left');
        $this->db->order_by('alba_pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
  public function lihat_history_pengeluaran_total($tanggal,$dan_tanggal = null) { 
  
        $this->db->where('pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 

        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k
            END) AS harga_total');
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function total_pengaluaran_biaya($project,$id_lsp = NULL) { 

        $this->db->where('leads_project.id_lsp', $project);
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k 
            END) AS total_harga_barang');
        $this->db->select('leads_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
         $this->db->join('leads_project', 'leads_project.id_proyek_accurate  = pengeluaran.nama_customer', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function total_pengaluaran_biaya002($project,$id_lsp = NULL) { 

        $this->db->where('leads_project.id_proyek_accurate', $project);
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k 
            END) AS total_harga_barang');
        $this->db->select('leads_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
         $this->db->join('leads_project', 'leads_project.id_proyek_accurate  = pengeluaran.nama_customer', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function lihat_history_pengeluaran02($project,$tanggal,$dan_tanggal = null) { 
  
        $this->db->where('pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
        $this->db->where('pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
          public function lihat_history_pengeluaran02_grand_total($project,$tanggal,$dan_tanggal = null) { 
  
        $this->db->where('pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
         $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k 
            END) AS harga_total');
        $this->db->where('pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function lihat_history_pengeluaran002($project = null) { 
  
        $this->db->where('pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('pengeluaran.tgl_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function lihat_history_pengeluaran03($project = null) { 
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.jumlah
            THEN jumlah
            END) AS total_pemakaian');
        $this->db->where('pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('detail_keluar.nama_barang', 'DESC');
        $this->db->group_by('detail_keluar.nama_barang'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
      public function lihat_history_pengeluaran03_grand_total($project = null) { 
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.jumlah
            THEN jumlah
            END) AS total_pemakaian');
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k 
            END) AS harga_total');
        $this->db->where('pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('pengeluaran', 'pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = pengeluaran.nama_customer', 'left');
        $this->db->order_by('detail_keluar.nama_barang', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_pengeluaran04($project,$tanggal,$dan_tanggal = null) { 
            $this->db->where('pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.jumlah
            THEN jumlah
            END) AS total_pemakaian');
        $this->db->where('alba_pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('alba_pengeluaran', 'alba_pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('daftar_project', 'daftar_project.projectNo = alba_pengeluaran.nama_customer', 'left');
        $this->db->order_by('detail_keluar.nama_barang', 'ASC');
        $this->db->group_by('detail_keluar.nama_barang'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function lihat_history_pengeluaran04_grand_total($project,$tanggal,$dan_tanggal = null) { 
            $this->db->where('alba_pengeluaran.tgl_keluar BETWEEN 
            \''. date('Y-m-d ', strtotime($tanggal))."'
            and 
            '". date('Y-m-d ', strtotime($dan_tanggal)).'\'
            '); 
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.jumlah
            THEN jumlah
            END) AS total_pemakaian');
        $this->db->select('SUM(CASE 
            WHEN 
            detail_keluar.harga_total_k 
            THEN harga_total_k 
            END) AS harga_total');
        $this->db->where('alba_pengeluaran.nama_customer', $project);
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->select('detail_keluar.*', FALSE);
        $this->db->from('detail_keluar');
        $this->db->join('alba_pengeluaran', 'alba_pengeluaran.no_keluar = detail_keluar.no_keluar', 'left');
        $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_pengeluaran.nama_customer', 'left');
        $this->db->order_by('detail_keluar.nama_barang', 'ASC');
       // $this->db->group_by('detail_keluar.nama_barang'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
        public function get_proyek() { 
        $this->db->select('daftar_project.*', FALSE);   
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->from('alba_pengeluaran');
        $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_pengeluaran.nama_customer', 'left');
        $this->db->order_by('alba_pengeluaran.tgl_keluar', 'DESC');
        $this->db->group_by('daftar_project.projectNo'); 
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function lihat() {
        $this->db->select('alba_customer.nama_cst', FALSE);
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->from('alba_pengeluaran');
        $this->db->join('alba_customer', 'alba_customer.kode_cst  = alba_pengeluaran.nama_customer', 'left');
        $this->db->order_by('tgl_keluar', 'DESC');
        $this->db->order_by('jam_keluar', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_keluar00000($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->row();
	}
public function lihat_no_keluar($id  = null) {
		$this->db->select('alba_customer.*', FALSE);
        $this->db->select('alba_pengeluaran.*', FALSE);
        $this->db->from('alba_pengeluaran');
        $this->db->join('alba_customer', 'alba_customer.kode_cst = alba_pengeluaran.nama_customer', 'left');
        $this->db->where('alba_pengeluaran.no_keluar', $id);

        if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;;
    }
	public function tambah($data){
		return $this->db->insert('alba_pengeluaran', $data);
	}

	public function hapus($no_keluar){
		return $this->db->delete('alba_pengeluaran', ['no_keluar' => $no_keluar]);
	}
}