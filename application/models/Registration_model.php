<?php 


/**
 * 
 */
class Registration_model extends CI_Model
{
	
	public function register_user()
	{
		$arr['username'] = $this->input->post('username');
		if ($this->input->post('username') == "admin" or $this->input->post('username') == "admin1" or $this->input->post('username') == "admin2" or $this->input->post('username') == "admin3") {
			 $this->db->set('usertype', 'admin');
		}
		$arr['fname'] = $this->input->post('fname');
		$arr['lname'] = $this->input->post('lname');
		$arr['password'] = md5($this->input->post('password'));
		$this->db->insert('users',$arr);
	}
}

?>