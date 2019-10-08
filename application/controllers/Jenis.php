<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("Jenis_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->Jenis_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Type', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->type,
							anchor('admin/jenis/ubah/'.$row->id_jenis,'<span class="fa fa-pencil"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'.
							anchor('admin/jenis/hapus/'.$row->id_jenis,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'admin_views/jenis_view', 
				'link_add' 	=> anchor('admin/jenis/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Jenis',
				'table'		=> $this->gen_table()
				);
		$this->load->view('admin_views/index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'admin_views/jenis_view', 
				'judul' 	=> 'Tambah Jenis',
				'form'		=> 'admin/jenis/add',
				'id_jenis'	=> $this->Jenis_model->gen_kode(),
				);
		$this->load->view('admin_views/index', $data);
	}

	public function add()
	{
		$inputan = array(
				'id_jenis' 	=> $this->input->post('id_jenis'),
				'type' 	=> $this->input->post('type'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['id_jenis'],'foto');
			$inputan['foto']= $this->fname_file;
		}

		if($this->Jenis_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/jenis');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/jenis/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'admin_views/jenis_view', 
				'judul' 	=> 'Ubah Jenis',
				'form'		=> 'admin/jenis/update',
				);

		$q = $this->Jenis_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['id_jenis'] 	= $row->id_jenis;
			$data['type'] 	= $row->type;
		}

		$this->load->view('admin_views/index', $data);
	}

	public function update()
	{
		$inputan = array(
				'type' 	=> $this->input->post('type'),
				);

		if($_FILES['foto']['name']!=''){
			$upload = $this->upload_foto('FOTO-'.$inputan['id_jenis'],'foto');
			$inputan['foto']= $this->fname_file;
		}else{
			unset($inputan['foto']);
		}

		if($this->Jenis_model->update($inputan, $this->input->post('id_jenis'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('admin/jenis');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('admin/jenis/ubah/'.$this->input->post('id_jenis'));
		}
	}

	public function hapus($v='')
	{
		$foto='';
		$q = $this->Jenis_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$foto=$row->foto;
		}

		if($this->Jenis_model->delete($v)){
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
		redirect('admin/jenis');
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