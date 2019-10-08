<?php

Class Warehouse_model extends CI_Model {

	// master barang
	public function getBarang(){

		return $this->db->query("SELECT * from barang");

	}

	public function get1Barang($id)
	{
		return $this->db->query("SELECT * from barang where id_barang = $id");
	}

	public function addBarang($data)
	{
		$this->db->insert('barang', $data);
		return $this->db->insert_id();
	}

	public function updateBarang($id, $data)
	{		
		$this->db->where('id_barang',$id);
		$this->db->update('barang',$data);
		return $this->db->affected_rows();
	}

	public function deleteBarang($id, $data)
	{
		$this->db->where('id_barang',$id);
		$this->db->delete('barang');
		return $this->db->affected_rows();
	}

	// master user
	public function getUser(){
		return $this->db->query("SELECT * FROM user");
	}

	public function get1User($id){
		return $this->db->query("SELECT * from user where id_user = $id");
	}

	public function addUser($data){
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	public function updateUser($id, $data){
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		return $this->db->affected_rows();
	}

	public function deleteUser($id, $data){
		$this->db->where('id_user',$id);
		$this->db->delete('user');
		return $this->db->affected_rows();
	}
}