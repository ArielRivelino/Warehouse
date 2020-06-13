<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("Satuan_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->Satuan_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Satuan', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->satuan,
							anchor('satuan/ubah/'.$row->id_satuan,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'satuan_view', 
				'link_add' 	=> anchor('satuan/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Data Satuan',
				'table'		=> $this->gen_table()
				);
		$this->load->view('index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'satuan_view', 
				'judul' 	=> 'Tambah Satuan',
				'form'		=> 'satuan/add',
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'satuan' 	=> $this->input->post('satuan'),
				);


		if($this->Satuan_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('satuan');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('satuan/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'satuan_view', 
				'judul' 	=> 'Ubah Satuan',
				'form'		=> 'satuan/update',
				);

		$q = $this->Satuan_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['id_satuan'] 	= $row->id_satuan;
			$data['satuan'] 	= $row->satuan;
		}

		$this->load->view('index', $data);
	}

	public function update()
	{
		$inputan = array(
				'satuan' 	=> $this->input->post('satuan'),
				);


		if($this->Satuan_model->update($inputan, $this->input->post('id_satuan'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('satuan');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('satuan/ubah/'.$this->input->post('id_satuan'));
		}
	}

	public function hapus($v='')
	{

		if($this->Satuan_model->delete($v)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('satuan');
	}


}