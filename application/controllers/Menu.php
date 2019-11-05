<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("Menu_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->Menu_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Url', 'Status', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->menu_name,
							$row->url,
							$row->status,
							anchor('menu/ubah/'.$row->menu_id,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'menu_view', 
				'link_add' 	=> anchor('menu/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Data menu',
				'table'		=> $this->Menu_model->get_all() //get_parent
				);
		$this->load->view('index', $data);
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'menu_view', 
				'judul' 	=> 'Tambah menu',
				'form'		=> 'menu/add',
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'menu' 	=> $this->input->post('menu'),
				);


		if($this->Menu_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('menu');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('menu/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'menu_view', 
				'judul' 	=> 'Ubah menu',
				'form'		=> 'menu/update',
				);

		$q = $this->Menu_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['id_menu'] 	= $row->id_menu;
			$data['menu'] 	= $row->menu;
		}

		$this->load->view('index', $data);
	}

	public function update()
	{
		$inputan = array(
				'menu' 	=> $this->input->post('menu'),
				);


		if($this->Menu_model->update($inputan, $this->input->post('id_menu'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('menu');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('menu/ubah/'.$this->input->post('id_menu'));
		}
	}

	public function hapus($v='')
	{

		if($this->Menu_model->delete($v)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil dihapus! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('menu');
	}
}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */