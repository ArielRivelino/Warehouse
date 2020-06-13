<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_custom extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function error_404()
	{
		$data = array(	
					'page' 		=> 'error_view', 
					'judul' 	=> '404',
					'sub_judul' => 'Page Not Found',
				);
		$this->load->view('index', $data);
	}

	public function error_403()
	{
		$data = array(	
					'page' 		=> 'error_view', 
					'judul' 	=> '403',
					'sub_judul' => 'Access Denined.',
				);
		$this->load->view('index', $data);
	}

}

/* End of file Error.php */
/* Location: ./application/controllers/Error.php */