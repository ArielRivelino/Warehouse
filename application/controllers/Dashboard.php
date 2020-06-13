<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Warehouse_model');
	}

	public function index() 
	{
		$data = array(	'page' 		=> 'dashboard_view', 
					'judul' 	=> 'Dashboard',
				);
		$this->load->view('index', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */