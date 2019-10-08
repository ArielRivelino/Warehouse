<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Warehouse_model');
	}

	//function menu
	public function index() 
	{

		$this->load->view('login.php');
	}

	public function login()
	{
		$query = $this->Warehouse_model->getUser();
		$data['user'] = $query->result_array();

		$this->load->view('login',$data);
	}

	public function auth()
	{
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
	}
	
	public function barang() 
	{
		$query = $this->Warehouse_model->getBarang();
		$data['barang'] = $query->result_array();

		$this->load->view('barang', $data);
	}
	public function user()
	{
		$query = $this->Warehouse_model->getUser();
		$data['user'] = $query->result_array();

		$this->load->view('user', $data);
	}
	public function peminjaman()
	{
		$this->load->view('peminjaman');
	}
	public function formpermintaan()
	{
		$this->load->view('formpermintaan');
	}
	public function lapstok()
	{
		$this->load->view('lapstok');
	}
	public function laptransaksi()
	{
		$this->load->view('laptransaksi');
	}

	//function crud barang
	public function addbarang()
	{
		if ($this->input->post()) {;
			$data['nama_barang'] = strtoupper($this->input->post('nama_barang'));
			$data['jenis'] = strtoupper($this->input->post('jenis'));
			$data['stok'] = ($this->input->post('stok'));
			$data['satuan'] = strtoupper($this->input->post('satuan'));
			$data['blok'] = strtoupper($this->input->post('blok'));
			$data['kode'] = strtoupper($this->input->post('kode'));
			$data['baris'] = $this->input->post('baris');
			$data['kolom'] = $this->input->post('kolom');

			$query = $this->Warehouse_model->addBarang($data);

			if ($query == 0)
				echo "Data Berhasil Disimpan";
			else
				echo "Data Gagal Disimpan";
			
			redirect(site_url('Warehouse/barang/'));
		}
	}

	public function editBarang($id)
	{
		$query = $this->Warehouse_model->get1Barang($id);
		$input['barang'] = $query->row_array();

		if($this->input->post()){
			$data['nama_barang'] = strtoupper($this->input->post('nama_barang'));
			$data['jenis'] = strtoupper($this->input->post('jenis'));
			$data['stok'] = ($this->input->post('stok'));
			$data['satuan'] = strtoupper($this->input->post('satuan'));
			$data['blok'] = strtoupper($this->input->post('blok'));
			$data['kode'] = strtoupper($this->input->post('kode'));
			$data['baris'] = $this->input->post('baris');
			$data['kolom'] = $this->input->post('kolom');

			$query = $this->Warehouse_model->updateBarang($id, $data);

			if($query){
				echo "Data Berhasil Disimpan";
			}
			else
				echo "Data Berhasil Disimpan";
			
			redirect(site_url('Warehouse/barang/'));
		}

		// $this->load->view('editbarang',$input);
	}
	
	public function deleteBarang($id)
	{
		$this->Warehouse_model->deleteBarang($id, $data);
		redirect(site_url('Warehouse/barang/'));
	}

	// function crud user
	public function addUser(){
		if ($this->input->post()) {;
			$data['nik'] = $this->input->post('nik');
			$data['nama_lengkap'] = strtoupper($this->input->post('nama_lengkap'));
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['staff'] = strtoupper($this->input->post('staff'));
			$data['jabatan'] = strtoupper($this->input->post('jabatan'));

			$query = $this->Warehouse_model->addUser($data);

			if ($query == 0)
				echo "Data Berhasil Disimpan";
			else
				echo "Data Gagal Disimpan";
			
			redirect(site_url('Warehouse/user/'));
		}
	}

	public function editUser($id){
		$query = $this->Warehouse_model->get1User($id);
		$input['user'] = $query->row_array();

		if($this->input->post()){
			$data['nik'] = $this->input->post('nik');
			$data['nama_lengkap'] = strtoupper($this->input->post('nama_lengkap'));
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['staff'] = strtoupper($this->input->post('staff'));
			$data['jabatan'] = strtoupper($this->input->post('jabatan'));

			$query = $this->Warehouse_model->updateUser($id, $data);

			if($query){
				echo "Data Berhasil Disimpan";
			}
			else
				echo "Data Gagal Disimpan";
			
			redirect(site_url('Warehouse/user/'));
		}
	}

	public function deleteUser($id){
		$this->Warehouse_model->deleteUser($id, $data);
		redirect(site_url('Warehouse/user/'));
	}

}
