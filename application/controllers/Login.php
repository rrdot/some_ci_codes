<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username'))
			redirect('Home');
	}
	
	public function index()
	{

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules("password","Password","required|min_length[5]");
		
		if ($this->form_validation->run()==FALSE) 
		{
			$this->load->view('vsms/loginpage');
		}
		else
		{
			$this->load->model('Login_model');
			$check = $this->Login_model->validate();
				if ($check)
				{
					$usertype = $this->Login_model->getUserType($this->input->post('username'));
					//if ($usertype == "admin") 
					//{					
						$user_id = $this->Login_model->getUserId($this->input->post('username'));
						$data = array(
	           			'username' => $this->input->post('username'), 
	           			'user_id' => $user_id,
	           			'usertype' => $usertype,
	           			'logged_in' => TRUE);
						$this->session->set_userdata($data);
						redirect('Home');
					//}
					//else
					//{
					//	$user_id = $this->Login_model->getUserId($this->input->post('username'));
					//	$data = array(
	           		//	'username' => $this->input->post('username'), 
	           		//	'user_id' => $user_id,
	           		//	'logged_in' => TRUE);
					//	$this->session->set_userdata($data);
					//	redirect('Home');
					//}
				}
				else
				{
					$this->session->set_flashdata('failed','User Account Does Not Exist!');
					redirect('Login');
			}
		}
	}
	public function login()
	{
		$this->load->view('vsms/loginpage');
	}
}








