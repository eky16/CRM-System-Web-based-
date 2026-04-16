<?php

class Fullcalendar_model extends CI_Model
{
	function fetch_all_event(){
		$this->db->order_by('id');
		return $this->db->get('events');
	}

	function fetch_all_event_me($id){
		$this->db->order_by('id');
		$this->db->where('EmployeeID', $id);
		return $this->db->get('events_my');
	}
	function fetch_all_event_sch(){
    $this->db->select('leads_project.nama_project as proyek', FALSE);
    $this->db->select('jadwal_pengiriman.*', FALSE);
    $this->db->join('leads_project', 'leads_project.id_lsp  = jadwal_pengiriman.project_id', 'left');
    $this->db->order_by('jadwal_pengiriman.waktu_pengiriman','ASC');
    $this->db->where('jadwal_pengiriman.status_pengiriman', 2);
    $this->db->from('jadwal_pengiriman');
    return $this->db->get();
	}

	function insert_event($data)
	{
		$this->db->insert('events', $data);
	}
	function insert_myevent($data)
	{
		$this->db->insert('events_my', $data);
	}
	function insert_event_leads($data_)
	{
		$this->db->insert('events', $data_);
	}

	function update_event($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('events', $data);
	}

	function update_myevent($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('events_my', $data);
	}
	function delete_event($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('events');
	}
	function delete_myevent($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('events_my');
	}
	public function tambah_event($data_event){
        return $this->db->insert('events', $data_event);
    }
}