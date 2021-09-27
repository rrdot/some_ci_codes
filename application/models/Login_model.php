<?php 


/**
 * 
 */
class Login_model extends CI_Model
{
	
	function validate()
	{
		$arr['username'] = $this->input->post('username');
		$arr['password'] = md5($this->input->post('password'));
		return $this->db->get_where('users',$arr)->row();
	}


	function getUserId($username)
	{
    	$this->db->where('username',$username);
    	$query = $this->db->get('users');       
    	foreach ($query->result() as $row)
    	{
        	$user_id = $row->user_id;
    	}
    	return $user_id;
	}

	function getUserType($username)
	{
    	$this->db->where('username',$username);
    	$query = $this->db->get('users');       
    	foreach ($query->result() as $row)
    	{
        	$usertype = $row->usertype;
    	}
    	return $usertype;
	}
}

?>