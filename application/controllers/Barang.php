<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("Barang_model", "", TRUE);
		$this->load->model("Jenis_model", "", TRUE);
		$this->load->model("Satuan_model", "", TRUE);
	}

	public function gen_table()
	{
		$query=$this->Barang_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Jenis', 'Item name', 'Stock', 'Satuan', 'Blok', 'Code', 'Line', 'Column', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->type,
							$row->item_name,
							$row->stock,
							$row->satuan,
							$row->blok,
							$row->code,
							$row->line,
							$row->column,
							anchor('barang/ubah/'.$row->id_barang,'<span class="fa fa-pencil-alt"></span>',array( 'title' => 'Ubah', 'class' => 'btn btn-primary btn-xs', 'data-toggle' => 'tooltip')).'&nbsp;'
							//anchor('barang/hapus/'.$row->id_barang,'<span class="fa fa-trash"></span>',array( 'title' => 'Hapus', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'))
						);
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		$data = array(	'page' 		=> 'barang_view', 
				'link_add' 	=> anchor('barang/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Barang',
				'table'		=> $this->gen_table()
				);
		$this->load->view('index', $data);
	}	

	public function combo_jenis($sel)
	{

		$ret = '<div class="form-group"><label for="jenis" class="col-sm-2 control-label">Jenis Barang</label><div class="col-sm-10">';
    	$query=$this->Jenis_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->id_jenis] = $row->type;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('id_jenis',$opt,$sel,$js);
		$ret= $ret.'</div></div>';
		return $ret;
	}

	public function combo_satuan($sel)
	{

		$ret = '<div class="form-group"><label for="satuan" class="col-sm-2 control-label">Satuan</label><div class="col-sm-10">';
    	$query=$this->Satuan_model->get_all();
    	$res = $query->result();
		foreach ($res as $row) {
			$opt[$row->id_satuan] = $row->satuan;
		}
		$js = 'class="form-control"';
		$ret= $ret.''.form_dropdown('id_satuan',$opt,$sel,$js);
		$ret= $ret.'</div></div>';
		return $ret;
	}

	public function tambah()
	{
		$data = array(	'page' 		=> 'barang_view', 
						'judul' 	=> 'Tambah Barang',
						'form'		=> 'barang/add',
						'cbjenis'	=> $this->combo_jenis(""),
						'cbsatuan'	=> $this->combo_satuan(""),
				//'id_barang'	=> $this->Barang_model->gen_kode(),
				);
		$this->load->view('index', $data);
	}

	public function add()
	{
		$inputan = array(
				'id_jenis' 		=> $this->input->post('id_jenis'),
				'id_satuan' 	=> $this->input->post('id_satuan'),
				'item_name' 	=> $this->input->post('item_name'),
				'stock' 		=> $this->input->post('stock'),
				'blok' 			=> $this->input->post('blok'),
				'code' 			=> $this->input->post('code'),
				'line' 			=> $this->input->post('line'),
				'column' 		=> $this->input->post('column'),
				'status' 		=> 1,
				);

		if($this->Barang_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('barang');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('barang/tambah');
		}
	}

	public function ubah($v)
	{
		$data = array(	'page' 		=> 'barang_view', 
				'judul' 	=> 'Ubah Barang',
				'form'		=> 'barang/update',

				);

		$q = $this->Barang_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$data['id_barang'] 	= $row->id_barang;
			$data['id_jenis'] 	= $row->id_jenis;
			$data['id_satuan'] 	= $row->id_satuan;
			$data['item_name'] 	= $row->item_name;
			$data['stock'] 		= $row->stock;
			$data['blok'] 		= $row->blok;
			$data['code'] 		= $row->code;
			$data['line'] 		= $row->line;
			$data['column'] 	= $row->column;
			$data['status'] 	= $row->status;
			$data['cbjenis']	= $this->combo_jenis($row->id_jenis);
			$data['cbsatuan']	= $this->combo_satuan($row->id_satuan);
		}

		$this->load->view('index', $data);
	}

	public function update()
	{
		$inputan = array(
				'id_jenis' 	=> $this->input->post('id_jenis'),
				'id_satuan' 	=> $this->input->post('id_satuan'),
				'item_name' 	=> $this->input->post('item_name'),
				'stock' 	=> $this->input->post('stock'),
				'blok' 	=> $this->input->post('blok'),
				'code' 	=> $this->input->post('code'),
				'line' 	=> $this->input->post('line'),
				'column' 	=> $this->input->post('column'),
				'status' 	=> $this->input->post('status'),
				);

		if($this->Barang_model->update($inputan, $this->input->post('id_barang'))){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('barang');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('barang/ubah/'.$this->input->post('id_barang'));
		}
	}

	public function hapus($v='')
	{
		$foto='';
		$q = $this->Barang_model->get_data($v);
		$res = $q->result();
		foreach ($res as $row) {
			$foto=$row->foto;
		}

		if($this->Barang_model->delete($v)){
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
		redirect('barang');
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