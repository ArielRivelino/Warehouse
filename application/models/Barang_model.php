<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	public function __construct() 
	{ 
		parent::__construct(); 
	} 

	var $table = 'master_barang';
	var $join1 = 'master_jenis';
	var $join2 = 'master_satuan';
	var $pk = 'id_barang';
	var $fk1 = 'id_jenis';
	var $fk2 = 'id_satuan';

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
		$this->db->where(array($this->pk => $id));
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
		return $this->db->delete($this->table, array($this->pk => $id));
	}

}