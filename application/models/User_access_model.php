<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 't_access';
	var $join1 = 'user_role';
	var $join2 = 't_menu';
	var $pk = 'id_access';
	var $fk1 = 'role_id';
	var $fk2 = 'menu_id';

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		$this->db->join($this->join2, $this->table.'.'.$this->fk2.' = '.$this->join2.'.'.$this->fk2);
		return $this->db->get();
	}

	public function get_data($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		$this->db->join($this->join2, $this->table.'.'.$this->fk2.' = '.$this->join2.'.'.$this->fk2);
		$this->db->where(array($this->table.".".$this->pk => $id));
		return $this->db->get();
	}

	public function get_where($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->join1, $this->table.'.'.$this->fk1.' = '.$this->join1.'.'.$this->fk1);
		$this->db->join($this->join2, $this->table.'.'.$this->fk2.' = '.$this->join2.'.'.$this->fk2);
		$this->db->where($id);
		return $this->db->get();
	}

	public function cek_data($da)
	{
		$q = $this->db->get_where($this->table, $da);
		if($q->num_rows()>0){
			$res = $q->result();
			foreach ($res as $row) {
				return $row->id_access;
			}
		}else{
			return -1;
		}
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

}