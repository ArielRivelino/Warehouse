<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("User_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->User_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Name', 'Password', 'Staff', 'Role id', 'Email', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->name,
							$row->password,
							$row->staff,
							$row->role_id,
							$row->email,
							anchor('admin/user/ubah/'.$row->nik,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('admin/user/hapus/'.$row->nik,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'admin_views/user_view', 
				'link_add' 	=> anchor('admin/user/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User',
				'table'		=> $this->gen_table()
				);
		$this->load->view('admin_views/index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'admin_views/user_view', 
				'judul' 	=> 'Tambah User',
				'form'		=> 'admin/user/add',
				'nik'	=> $this->User_model->gen_kode(),
				);
		$this->load->view('admin_views/index', $data);
	}

	public function add()
	{
		$inputan = array(
				'nik' 	=> $this->input->post('nik'),
				'name' 	=> $this->input->post('name'),
				'password' 	=> $this->input->post('password'),
				'staff' 	=> $this->input->post('staff'),
				'role_id' 	=> $this->input->post('role_id'),
				'email' 	=> $this->input->post('email'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['nik'],'foto');
			$inputan['foto']= $this->fname_file;
		}

		if($this->User_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/user');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/user/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'admin_views/user_view', 
				'judul' 	=> 'Ubah User',
				'form'		=> 'admin/user/update',
				);

		$q = $this->User_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['nik'] 	= $row->nik;
			$data['name'] 	= $row->name;
			$data['password'] 	= $row->password;
			$data['staff'] 	= $row->staff;
			$data['role_id'] 	= $row->role_id;
			$data['email'] 	= $row->email;
		}

		$this->load->view('admin_views/index', $data);
	}

	public function update()
	{
		$inputan = array(
				'name' 	=> $this->input->post('name'),
				'password' 	=> $this->input->post('password'),
				'staff' 	=> $this->input->post('staff'),
				'role_id' 	=> $this->input->post('role_id'),
				'email' 	=> $this->input->post('email'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['nik'],'foto');
			$inputan['foto']= $this->fname_file;
		}else{
			unset($inputan['foto']);
		}

		if($this->User_model->update($inputan, $this->input->post('nik'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/user');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/user/ubah/'.$this->input->post('nik'));
		}
	}

	public function hapus($v='')
	{
		$foto='';
		$q = $this->User_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$foto=$row->foto;
		}

		if($this->User_model->delete($v)){
			$msg = "";
			if(!unlink($foto)){
				$msg = "GAGAL";
			}
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('admin/user');
	}

	public function upload_foto($fn,$in)
	{
		unset($config);
		$config['upload_path'] 	 = './assets/img/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']	 = '50000';
		$config['overwrite']	 = true;
		$config['file_name'] 	 = $fn;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($in)) {
			//echo $this->upload->display_errors();
			$rn = false;
		}else{
			$file_data = $this->upload->data();
			$this->fname_file=$file_data['file_name'];
			$rn = true;
		}

		return $rn;

	}


}