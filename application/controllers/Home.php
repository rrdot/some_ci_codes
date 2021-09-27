<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('username'))
			redirect('Login');
		else{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('Home_model');
			$this->load->library('pdf');
		}
	}
	public function index()
	{	
		$data["get_vitalsigns"] = $this->Home_model->get_vitalsigns();
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/welcome_message', $data);
		$this->load->view('vsms/includes/footer');
	}
	public function viewpatients()
	{	
		$data["get_patients"] = $this->Home_model->get_patients();
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/patients', $data);
		$this->load->view('vsms/includes/footer');
	}
	public function addpatientpage()
	{
		$data["avail_rooms"] = $this->Home_model->avail_rooms();
		$data["avail_devices"] = $this->Home_model->avail_devices();
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/addpatient',$data);
		$this->load->view('vsms/includes/footer');
	}
	public function viewusers()
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('Home');
		}
		else
		{
			$data["get_users"] = $this->Home_model->get_users();
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/users', $data);
			$this->load->view('vsms/includes/footer');
		}
	}
	public function viewdevices()
	{
		$data["get_devices"] = $this->Home_model->get_devices();
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/devices', $data);
		$this->load->view('vsms/includes/footer');
	}
	public function viewrooms()
	{
		$data["get_rooms"] = $this->Home_model->get_rooms();
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/rooms', $data);
		$this->load->view('vsms/includes/footer');
	}
	public function addroompage()
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewrooms');
		}
		else
		{
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/addroom');
			$this->load->view('vsms/includes/footer');
		}
	}
	public function adddevicepage()
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewdevices');
		}
		else
		{
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/adddevice');
			$this->load->view('vsms/includes/footer');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
	public function addpatient()
	{
		$this->form_validation->set_rules("name","Name",'required|is_unique[patients.name]',
			array(
				'is_unique' => 'Patient already existed.'
			)
		);
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules('diagnosis','Diagnosis','required');
		$this->form_validation->set_rules("room","Room","required");
		$this->form_validation->set_rules("device","Device","required");
		if ($this->form_validation->run()==FALSE) 
		{
			$data["avail_rooms"] = $this->Home_model->avail_rooms();
			$data["avail_devices"] = $this->Home_model->avail_devices();
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/addpatient',$data);
			$this->load->view('vsms/includes/footer');
		}
		else
		{
		$this->session->set_flashdata('success','Patient Successfully Added!');
		$monitoring_id = $this->Home_model->addpatient();
		redirect('viewpatients');
		}	
	}
	public function addroom()
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewrooms');
		}
		else
		{
			$this->form_validation->set_rules("room","Room","required|numeric|is_unique[rooms.room]",
				array(
					'is_unique' => 'Room already existed.'
				)
			);
			if ($this->form_validation->run()==FALSE) 
			{
				$this->load->view('vsms/includes/header');
				$this->load->view('vsms/homepage/addroom');
				$this->load->view('vsms/includes/footer');
			}
			else
			{
			$this->session->set_flashdata('success','Room Successfully Added!');
			$this->Home_model->addroom();
			redirect('viewrooms');
			}
		}		
	}
	public function adddevice()
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewdevices');
		}
		else
		{
			$this->form_validation->set_rules("device","Device Name","required|is_unique[devices.device]",
				array(
					'is_unique' => 'Device name already existed.'
				)
			);
			if ($this->form_validation->run()==FALSE) 
			{
				$this->load->view('vsms/includes/header');
				$this->load->view('vsms/homepage/adddevice');
				$this->load->view('vsms/includes/footer');
			}
			else
			{
			$this->session->set_flashdata('success','Device Successfully Added!');
			$this->Home_model->adddevice();
			redirect('viewdevices');
			}	
		}	
	}
	public function editpatient($monitoring_id)
	{
		$data["avail_rooms"] = $this->Home_model->avail_rooms();
		$data["avail_devices"] = $this->Home_model->avail_devices();
		$data['patients'] = $this->Home_model->getPatientId($monitoring_id);
		$data['rooms'] = $this->Home_model->getSelectedRoom($monitoring_id);
		$data['devices'] = $this->Home_model->getSelectedDevice($monitoring_id);
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/editpatient',$data);
		$this->load->view('vsms/includes/footer');
	}
	public function updatepatient($monitoring_id)
	{
		$this->form_validation->set_rules("name","Name",'required');
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules('diagnosis','Diagnosis','required');
		$this->form_validation->set_rules("room","Room","required");
		$this->form_validation->set_rules("device","Device","required");
		if ($this->form_validation->run()==FALSE) 
		{
			$data["avail_rooms"] = $this->Home_model->avail_rooms();
			$data["avail_devices"] = $this->Home_model->avail_devices();
			$data['patients'] = $this->Home_model->getPatientId($monitoring_id);
			$data['rooms'] = $this->Home_model->getSelectedRoom($monitoring_id);
			$data['devices'] = $this->Home_model->getSelectedDevice($monitoring_id);
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/editpatient',$data);
			$this->load->view('vsms/includes/footer');
		}
		else
		{
		$this->Home_model->updatepatient($monitoring_id);
		$this->session->set_flashdata('success','Patient Successfully Updated!');
		redirect('viewpatients');
		}	
	}
	public function editroom($room_id)
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewrooms');
		}
		else
		{
			$data['rooms'] = $this->Home_model->getRoomId($room_id);
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/editroom',$data);
			$this->load->view('vsms/includes/footer');
		}
	}
	public function updateroom($room_id)
	{
		$this->form_validation->set_rules("room","Room","required|numeric|is_unique[rooms.room]",
			array(
				'is_unique' => 'Room already existed.')
			);
		if ($this->form_validation->run()==FALSE) 
		{
			$data['rooms'] = $this->Home_model->getRoomId($room_id);
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/editroom',$data);
			$this->load->view('vsms/includes/footer');
		}
		else
		{
		$this->Home_model->updateroom($room_id);
		$this->session->set_flashdata('success','Room Successfully Updated!');
		redirect('viewrooms');
		}	
	}
	public function editdevice($device_id)
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewdevices');
		}
		else
		{
			$data['devices'] = $this->Home_model->getDeviceId($device_id);
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/editdevice',$data);
			$this->load->view('vsms/includes/footer');
		}
	}
	public function updatedevice($device_id)
	{
		$this->form_validation->set_rules("device","Device Name","required|is_unique[devices.device]",
			array(
				'is_unique' => 'Device name already existed.')
			);
		if ($this->form_validation->run()==FALSE) 
		{
			$data['devices'] = $this->Home_model->getDeviceId($device_id);
			$this->load->view('vsms/includes/header');
			$this->load->view('vsms/homepage/editdevice',$data);
			$this->load->view('vsms/includes/footer');
		}
		else
		{
		$this->Home_model->updatedevice($device_id);
		$this->session->set_flashdata('success','Device Successfully Updated!');
		redirect('viewdevices');
		}	
	}
	public function deleteuser($user_id)
	{
		$a = $this->session->userdata('user_id');
		if ( $a == $user_id) {
			$this->session->set_flashdata('error','User currently logged-in!');
			redirect('viewusers');
		}
		else{
		$this->Home_model->deleteuser($user_id);
		$this->session->set_flashdata('success','User Successfully Deleted!');
		redirect('viewusers');
		}
	}
	public function deletepatient($monitoring_id)
	{
		$this->Home_model->deletepatient($monitoring_id);
		$this->session->set_flashdata('success','Patient Discharged!');
		redirect('viewpatients');
	}
	public function deleteroom($room_id)
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewrooms');
		}
		else
			{
			$check = $this->Home_model->roomcheck($room_id);
			if ($check == 'Occupied') {
				$this->session->set_flashdata('error','Room is occupied!');
				redirect('viewrooms');
			}
			else{
			$this->Home_model->deleteroom($room_id);
			$this->session->set_flashdata('success','Room Successfully Deleted!');
			redirect('viewrooms');
			}
		}
	}
	public function deletedevice($device_id)
	{
		if($this->session->userdata('usertype') != "admin")
		{
			$this->session->set_flashdata('restricted','Restricted action!');
			redirect('viewdevices');
		}
		else
			{
			$check = $this->Home_model->devicecheck($device_id);
			if ($check == 'Used') {
				$this->session->set_flashdata('error','Device is used!');
				redirect('viewdevices');
			}
			else{
			$this->Home_model->deletedevice($device_id);
			$this->session->set_flashdata('success','Device Successfully Deleted!');
			redirect('viewdevices');
			}
		}
	}
	public function history($monitoring_id)
	{
		$data['patients'] = $this->Home_model->getPatientId($monitoring_id);
		$data['get_vitalsigns'] = $this->Home_model->getHistorybyId($monitoring_id);
		$this->load->view('vsms/includes/header');
		$this->load->view('vsms/homepage/history',$data);
		$this->load->view('vsms/includes/footer');
	}
	public function report($monitoring_id)
	{
		$name = $this->Home_model->get_patientName($monitoring_id);
		$html_content = '<h2 align = "center"> Patient Vital Signs History </h2><br>';
		$html_content .= $this->Home_model->print_patientReport($monitoring_id);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$name.".pdf", array("Attachment"=>1));
	}
	public function set_interval()
	{
		$this->Home_model->set_interval();
		$this->session->set_flashdata('success','Monitoring Interval Successfully Updated!');
		redirect('Home');
	}


}
?>