<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model("User_model", "", TRUE);
		$this->load->model("Barang_model", "", TRUE);
	}

	public function gen_table_barang()
	{
		$query=$this->Barang_model->get_all();
		$res = $query->result();
		$num_rows = $query->num_rows();

		$tmpl = array(  'table_open'    => '<table class="table table-striped table-hover dataTable">',
				'row_alt_start'  => '<tr>',
				'row_alt_end'    => '</tr>'
			);

		$this->table->set_template($tmpl);

		$this->table->set_empty("&nbsp;");

		$this->table->set_heading('No', 'Jenis', 'Item name', 'Aksi');

		if ($num_rows > 0)
		{
			$i = 0;

			foreach ($res as $row){
				$this->table->add_row(	++$i,
							$row->type,
							$row->item_name,
							'<button onclick="pilih_barang('.$row->id_barang.', '."'$row->item_name'".')" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Pilih" ><i class="fa fa-check"></i></button>'
						);
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

	public function barang()
	{
		echo $this->gen_table_barang();
		echo '<script>
			    $(document).ready(function() {
			        $("[data-toggle=\'tooltip\']").tooltip();;
			        $(".dataTable").DataTable();
			    });
			    </script>';
	}

}