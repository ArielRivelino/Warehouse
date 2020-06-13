<?php
class login extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model("User_model", "", TRUE);
	}

	public function index(){
		$data = array(	
				"form"		=> 'login/p_login'
				);
		$this->load->view('login_view', $data);
	}

	public function p_login()
	{
		$inputan = array(
						'nik' => $this->input->post("nik"),
						'password' => $this->input->post("password"),
						);
		if($this->User_model->login($inputan)){
			$this->session->set_flashdata('msg_title', 'Login Berhasil!');
			$this->session->set_flashdata('msg_status', 'alert-success');
			$this->session->set_flashdata('msg', 'Selamat datang <strong>'.$_SESSION["name"].'</strong> ');
			redirect('dashboard');
		}else{
			$this->session->set_flashdata('msg_title', 'Login gagal!');
			$this->session->set_flashdata('msg_status', 'alert-danger');
			$this->session->set_flashdata('msg', 'nik/password salah! ');
			echo $this->db->last_query();
			redirect('login');
		}
	}

	public function logout()
	{
		$_SESSION["user"] = "";
		$_SESSION["name"] = "";
		$_SESSION["role_id"] = "";
		unset($_SESSION["user"]);
		unset($_SESSION["name"]);
		unset($_SESSION["role_id"]);
		redirect("login");
	}
}

?>