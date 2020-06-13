<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 'user';
	var $join1 = 'user_role';
	var $pk = 'nik';
	var $fk1 = 'role_id';

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		return $this->db->get();
	}

	public function get_data($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		$this->db->where(array($this->table.".".$this->pk => $id));
		return $this->db->get();
	}

	public function get_where($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		$this->db->where($id);
		return $this->db->get();
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
		return $this->db->delete($this->table, array($this->pk => $id));
	}
	
	public function login($dada)
	{
		$this->db->where($dada);
		$q = $this->db->get($this->table);
		if($q->num_rows()>0){
			$res = $q->result();
			foreach ($res as $row) {
				$_SESSION["user"] = $row->nik;
				$_SESSION["name"] = $row->name;
				$_SESSION["role_id"] = $row->role_id;
			}
			return true;
		}else{
			return false;
		}
	}

}