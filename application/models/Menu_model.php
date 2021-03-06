<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 't_menu';
	var $pk = 'menu_id';

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	public function get_data($id)
	{
		$this->db->where(array($this->pk => $id));
		return $this->db->get($this->table);
	}

	public function get_parent()
	{
		$this->db->where(array('type' => 0));
		return $this->db->get($this->table);
	}

	public function get_childern($id)
	{
		$this->db->where(array('type' => $id));
		return $this->db->get($this->table);
	}

	public function get_where($id)
	{
		$this->db->where($id);
		return $this->db->get($this->table);
	}

	public function add($da)
	{
		return $this->db->insert($this->table, $da);
	}

	public function update($data, $_id)
	{
		$this->db->set($data);
		$this->db->where($this->pk, $_id);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where(array($this->pk => $id));
		$q =  $this->db->get($this->table);
		$res = $q->result();
		foreach ($res as $row) {
			if($row->type==0){
				$this->db->delete($this->table, array("type" => $id));
			}
		}
		return $this->db->delete($this->table, array($this->pk => $id));
	}	

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */