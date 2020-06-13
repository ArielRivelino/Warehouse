<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("User_model", "", TRUE);
		$this->load->model("User_role_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->User_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('NIK', 'Name', 'Staff', 'Role id', 'Email', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(
							$row->nik,
							$row->name,
							$row->staff,
							$row->role,
							$row->email,
							anchor('user/ubah/'.$row->nik,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('user/hapus/'.$row->nik,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'user_view', 
				'link_add' 	=> anchor('user/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User',
				'table'		=> $this->gen_table()
				);
		$this->load->view('index', $data);
	}

	public function combo_role($sel)
	{

		$ret = '<div class="form-group row"><label for="role_id" class="col-sm-2 control-label">Role</label><div class="col-sm-10">';
    	$query=$this->User_role_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->role_id] = $row->role;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('role_id',$opt,$sel,$js);
		$ret= $ret.'</div></div>';
		return $ret;
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'user_view', 
				'judul' 	=> 'Tambah User',
				'form'		=> 'user/add',
				'cb_role'	=> $this->combo_role("")
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'nik' 		=> $this->input->post('nik'),
				'name' 		=> $this->input->post('name'),
				'password' 	=> $this->input->post('password'),
				'staff' 	=> $this->input->post('staff'),
				'role_id' 	=> $this->input->post('role_id'),
				'email' 	=> $this->input->post('email'),
				);

		if($this->User_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'user_view', 
				'judul' 	=> 'Ubah User',
				'form'		=> 'user/update',
				);

		$q = $this->User_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['nik'] 	= $row->nik;
			$data['name'] 	= $row->name;
			$data['password'] 	= $row->password;
			$data['staff'] 	= $row->staff;
			$data['email'] 	= $row->email;
			$data['cb_role'] = $this->combo_role($row->role_id);

		}

		$this->load->view('index', $data);
	}

	public function update()
	{
		$inputan = array(
				'name' 		=> $this->input->post('name'),
				'password' 	=> $this->input->post('password'),
				'staff' 	=> $this->input->post('staff'),
				'role_id' 	=> $this->input->post('role_id'),
				'email' 	=> $this->input->post('email'),
				);

		if($this->User_model->update($inputan, $this->input->post('nik'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user/ubah/'.$this->input->post('nik'));
		}
	}

	public function hapus($v='')
	{

		if($this->User_model->delete($v)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('user');
	}


}