<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("User_role_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->User_role_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Role', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->role,
							anchor('user_role/ubah/'.$row->role_id,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('user_role/hapus/'.$row->role_id,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'user_role_view', 
				'link_add' 	=> anchor('user_role/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User Role',
				'table'		=> $this->gen_table()
				);
		$this->load->view('index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'user_role_view', 
				'judul' 	=> 'Tambah User Role',
				'form'		=> 'user_role/add',
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'role' 	=> $this->input->post('role'),
				);
		if($this->User_role_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user_role');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user_role/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'user_role_view', 
				'judul' 	=> 'Ubah User Role',
				'form'		=> 'user_role/update',
				);

		$q = $this->User_role_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['role_id'] 	= $row->role_id;
			$data['role'] 	= $row->role;
		}

		$this->load->view('index', $data);
	}

	public function update()
	{
		$inputan = array(
				'role' 	=> $this->input->post('role'),
				);

		if($this->User_role_model->update($inputan, $this->input->post('role_id'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user_role');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user_role/ubah/'.$this->input->post('role_id'));
		}
	}

	public function hapus($v='')
	{
		if($this->User_role_model->delete($v)){
			
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('user_role');
	}

}