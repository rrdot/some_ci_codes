<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		

		$this->form_validation->set_rules("fname","First Name","required");
		$this->form_validation->set_rules("lname","Last Name","required");
		$this->form_validation->set_rules('username','Username','required|is_unique[users.username]',
			array(
				'is_unique' => 'Username is already taken.'
			)
		);
		$this->form_validation->set_rules("password","Password","required|min_length[5]");
		
		if ($this->form_validation->run()==FALSE) 
		{
			$this->load->view('vsms/registerpage');
		}
		else
		{
		$this->load->model('Registration_model');
		$this->Registration_model->register_user();
		$this->session->set_flashdata('success','Registration Success!');
		redirect('Login');
		}
	}
	public function registration()
	{
		$this->load->view('vsms/registerpage');
	}
}

