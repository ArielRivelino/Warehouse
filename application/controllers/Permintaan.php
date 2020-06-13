<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller {

	var $fname_file;

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("Permintaan_model", "", TRUE);
		$this->load->model("Barang_model", "", TRUE);
		$this->load->model("Jenis_model", "", TRUE);
		$this->load->model("Satuan_model", "", TRUE);
	}

	public function gen_table($typ, $role)
	{
		$query=$this->Permintaan_model->get_where(array("t_request.request_type" => $typ));
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		if($role==0){
			$this->table->set_heading('No', 'Nama Peminta', 'Barang', 'Jumlah', 'Status');
		}else{
			$this->table->set_heading('No', 'Nama Peminta', 'Barang', 'Jumlah', 'Status', 'Aksi');
		}

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$sts = '';
				$btn = '';
				if($row->status_request==0){
					$tty = $typ==0?'stok':'baru';
					$sts = '<span class="badge badge-warning">Belum di Approve</span>';
					$btn = anchor('permintaan/approve/'.$row->request_id.'/'.$tty,'<span class="fa fa-check"></span>',array( 'title' => 'Approve', 'class' => 'btn btn-success btn-xs', 'data-toggle' => 'tooltip'));
					$btn .= "&nbsp;";
					$btn .= anchor('permintaan/tolak/'.$row->request_id.'/'.$tty,'<span class="fa fa-ban"></span>',array( 'title' => 'Tolak', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip'));
				}else if($row->status_request==1){
					$sts = '<span class="badge badge-success">Sudah di Approve</span>';
				}else{
					$sts = '<span class="badge badge-danger">Ditolak</span>';
				}
				if($role==0){
					$this->table->add_row(
								++$i,
								$row->name,
								$row->item_name,
								$row->amount,
								$sts
							);
				}else{
					$this->table->add_row(
								++$i,
								$row->name,
								$row->item_name,
								$row->amount,
								$sts,
								$btn
							);
				}
			}
		}
		return  $this->table->generate();
	}

	public function index()
	{
		/*$data = array(	'page' 		=> 'user_view', 
				'link_add' 	=> anchor('user/tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'User',
				'table'		=> $this->gen_table()
				);
		$this->load->view('index', $data);*/
	}

	public function Stok()
	{
		$data = array(	'page' 		=> 'permintaan_view', 
				'link_add' 	=> anchor('permintaan/stok_tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Permintaan Stok ',
				'table'		=> $this->gen_table(0, 0)
				);
		if(parent::get_aksi()!="1,2,3"){
			$aksi = explode(",", parent::get_aksi());
			foreach ($aksi as $k => $v) {
				if(!in_array(1, $aksi)){
					redirect('permintaan/stok_tambah');
				}else if(!in_array(2, $aksi)){
					unset($data['link_add']);
				}else if(!in_array(3, $aksi)){
					$data['table'] = $this->gen_table(0, 0);
				}

				if($v==1){
					$data['table'] = $this->gen_table(0, 0);
				}else if($v==2){
					$data['link_add'] = anchor('permintaan/stok_tambah', 'Tambah Data', array('class' => 'btn btn-success',  ));
				}else if($v==3){
					$data['table'] = $this->gen_table(0, 1);
				}
			}
		}
		$this->load->view('index', $data);
	}

	public function stok_tambah()
	{
		$data = array(	'page' 		=> 'permintaan_view', 
						'judul' 	=> 'Tambah Permintaan Stok',
						'form'		=> 'permintaan/stok_add',
						'request_type' => 0
				);
		$this->load->view('index', $data);
	}

	public function stok_add()
	{
		$inputan = array(
				'request_type' 		=> 0,
				'nik' 				=> $this->input->post('nik'),
				'id_barang' 		=> $this->input->post('id_barang'),
				'amount' 			=> $this->input->post('amount'),
				'information' 		=> $this->input->post('information'),
				'proof' 			=> $this->input->post('proof'),
				'request_date' 		=> date("Y-m-d H:i:s"),
				'status' 			=> 0
				);

		if($this->Permintaan_model->add($inputan)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('permintaan/stok');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('permintaan/stok_tambah');
		}
	}

	public function Baru()
	{
		$data = array(	
				'page' 		=> 'permintaan_view', 
				'link_add' 	=> anchor('permintaan/baru_tambah', 'Tambah Data', array('class' => 'btn btn-success',  )),
				'judul' 	=> 'Permintaan Baru',
				'table'		=> $this->gen_table(1, 0)
				);
		if(parent::get_aksi()!="1,2,3"){
			$aksi = explode(",", parent::get_aksi());
			foreach ($aksi as $k => $v) {
				if(!in_array(1, $aksi)){
					redirect('permintaan/baru_tambah');
				}else if(!in_array(2, $aksi)){
					unset($data['link_add']);
				}else if(!in_array(3, $aksi)){
					$data['table'] = $this->gen_table(1, 0);
				}

				if($v==1){
					$data['table'] = $this->gen_table(1, 0);
				}else if($v==2){
					$data['link_add'] = anchor('permintaan/baru_tambah', 'Tambah Data', array('class' => 'btn btn-success',  ));
				}else if($v==3){
					$data['table'] = $this->gen_table(1, 1);
				}
			}
		}
		$this->load->view('index', $data);
	}


	public function combo_jenis($sel)
	{

		$ret = '<div class="form-group row"><label for="jenis" class="col-sm-2 control-label">Jenis Barang</label><div class="col-sm-10">';
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

		$ret = '<div class="form-group row"><label for="satuan" class="col-sm-2 control-label">Satuan</label><div class="col-sm-10">';
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

	public function baru_tambah()
	{
		$data = array(	'page' 		=> 'permintaan_view', 
						'judul' 	=> 'Tambah Permintaan Baru',
						'form'		=> 'permintaan/baru_add',
						'request_type' => 1,
						'cbjenis'	=> $this->combo_jenis(""),
						'cbsatuan'	=> $this->combo_satuan(""),
				);
		$this->load->view('index', $data);
	}

	public function baru_add()
	{

		$inputan = array(
				'id_jenis' 		=> $this->input->post('id_jenis'),
				'id_satuan' 	=> $this->input->post('id_satuan'),
				'item_name' 	=> $this->input->post('item_name'),
				'stock' 		=> $this->input->post('amount'),
				'blok' 			=> $this->input->post('blok'),
				'code' 			=> $this->input->post('code'),
				'line' 			=> $this->input->post('line'),
				'column' 		=> $this->input->post('column'),
				'status' 		=> 0,
				);


		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE);
		
		$this->Barang_model->add($inputan);

		$id_barang = $this->db->insert_id();

		$inputan2 = array(
				'request_type' 		=> 1,
				'nik' 				=> $this->input->post('nik'),
				'id_barang' 		=> $id_barang,
				'amount' 			=> $this->input->post('amount'),
				'information' 		=> $this->input->post('information'),
				'proof' 			=> $this->input->post('proof'),
				'request_date' 		=> date("Y-m-d H:i:s"),
				'status' 			=> 0
				);

		$this->Permintaan_model->add($inputan2);
		$this->db->trans_complete(); 

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal disimpan! ');
			redirect('permintaan/baru_tambah');
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
			redirect('permintaan/baru');
		}
	}

	public function approve($id, $re)
	{
		$q = $this->Permintaan_model->get_data($id);
		$res = $q->result();
			$id_barang = 0;
		foreach ($res as $row) {
			$id_barang = $row->id_barang;
		}

		if(
			$this->Permintaan_model->update(array('status' => 1), $id)
			&&
			$this->Barang_model->update(array('status' => 1), $id_barang)

		){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('permintaan/'.$re);
	}

	public function tolak($id, $re)
	{
		if($this->Permintaan_model->update(array('status' => 2), $id)){
			$this->session->set_flashdata('msg_title', 'Sukses!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Data berhasil disimpan! ');
		}else{
			$this->session->set_flashdata('msg_title', 'Terjadi Kesalahan!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'Data gagal dihapus! ');
		}
		redirect('permintaan/');
	}

}