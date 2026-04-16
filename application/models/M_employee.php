<?php

class M_employee extends CI_Model{
	protected $_table = 'employee_login';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function lihat_username001($username){ 
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}
	public function update_pass_credentials($kode, $new_password) {
    $data = [
        
        'password' => password_hash($new_password, PASSWORD_DEFAULT) // Hash password jika belum di-hash
    ];
    $this->db->where('kode', $kode);
    return $this->db->update('employee_login', $data);
}

  	public function lihat_username($id = NULL) { 
		$this->db->select('employee_login.*', FALSE);
        $this->db->select('alba_karyawan.*', FALSE);
        $this->db->select('alba_divisi.*', FALSE);
        $this->db->select('alba_department.*', FALSE);
        $this->db->from('alba_karyawan');
         $this->db->join('employee_login', 'employee_login.kode  = alba_karyawan.EmployeeID', 'left');
        $this->db->join('alba_divisi', 'alba_karyawan.divisi  = alba_divisi.id_div', 'left');
        $this->db->join('alba_department', 'alba_divisi.id_dept  = alba_department.id_dept', 'left');
	//	$this->db->where('employee_login.username', $id); 

        $kondisi = "( ( (employee_login.username='" . $id . "') AND (alba_karyawan.Active='" . 1 . "' )) )";
       
        $this->db->where($kondisi);

    	if (!empty($id)) {
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
        	$this->db->where('employee_login.username', $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }   
	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}