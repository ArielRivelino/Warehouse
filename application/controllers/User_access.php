<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("User_access_model", "", TRUE);
		$this->load->model("User_role_model", "", TRUE);
		$this->load->model("Menu_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->User_access_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Role', 'Menu', 'Access', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	
							++$i,
							$row->role,
							$row->menu_name,
							$row->aksi,
							anchor('user_access/ubah/'.$row->id_access,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('user_access/hapus/'.$row->id_access,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'user_access_view', 
				'link_add' 	=> anchor('user_access/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User Access',
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

	public function combo_menu($sel)
	{
		$ret = '<div class="form-group row"><label for="menu_id" class="col-sm-2 control-label">Role</label><div class="col-sm-10">';
    	$query=$this->Menu_model->get_parent();
    	$res = $query->result();
    	$opt = [];
		foreach ($res as $row) {
			$opt[$row->menu_id] = $row->menu_name;

			$q = $this->Menu_model->get_childern($row->menu_id);
    		$rs = $q->result();
    		foreach ($rs as $rw) {
				$opt[$rw->menu_id] = "&nbsp; - ".$rw->menu_name;
			}
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('menu_id',$opt,$sel,$js);
		$ret= $ret.'</div></div>';
		return $ret;
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'user_access_view', 
				'judul' 	=> 'Tambah User Access',
				'form'		=> 'user_access/add',
				'combo_role' => $this->combo_role(""),
				'combo_menu' => $this->combo_menu(""),
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'role' 	=> $this->input->post('role'),
				);
		if($this->user_access_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user_access');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user_access/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'user_access_view', 
				'judul' 	=> 'Ubah user_access',
				'form'		=> 'user_access/update',
				);

		$q = $this->user_access_model->get_data($v);
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

		if($this->user_access_model->update($inputan, $this->input->post('role_id'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('user_access');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('user_access/ubah/'.$this->input->post('role_id'));
		}
	}

	public function hapus($v='')
	{
		if($this->user_access_model->delete($v)){
			
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('user_access');
	}

}