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

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
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
							anchor('admin/user_role/ubah/'.$row->role_id,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('admin/user_role/hapus/'.$row->role_id,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'admin_views/user_role_view', 
				'link_add' 	=> anchor('admin/user_role/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User_role',
				'table'		=> $this->gen_table()
				);
		$this->load->view('admin_views/index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'admin_views/user_role_view', 
				'judul' 	=> 'Tambah User_role',
				'form'		=> 'admin/user_role/add',
				'role_id'	=> $this->User_role_model->gen_kode(),
				);
		$this->load->view('admin_views/index', $data);
	}

	public function add()
	{
		$inputan = array(
				'role_id' 	=> $this->input->post('role_id'),
				'role' 	=> $this->input->post('role'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['role_id'],'foto');
			$inputan['foto']= $this->fname_file;
		}

		if($this->User_role_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/user_role');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/user_role/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'admin_views/user_role_view', 
				'judul' 	=> 'Ubah User_role',
				'form'		=> 'admin/user_role/update',
				);

		$q = $this->User_role_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['role_id'] 	= $row->role_id;
			$data['role'] 	= $row->role;
		}

		$this->load->view('admin_views/index', $data);
	}

	public function update()
	{
		$inputan = array(
				'role' 	=> $this->input->post('role'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['role_id'],'foto');
			$inputan['foto']= $this->fname_file;
		}else{
			unset($inputan['foto']);
		}

		if($this->User_role_model->update($inputan, $this->input->post('role_id'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/user_role');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/user_role/ubah/'.$this->input->post('role_id'));
		}
	}

	public function hapus($v='')
	{
		$foto='';
		$q = $this->User_role_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$foto=$row->foto;
		}

		if($this->User_role_model->delete($v)){
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
		redirect('admin/user_role');
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