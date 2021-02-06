<?php

class UserService extends CI_Model
{

public function __construct()
{
	$this->load->model("schema/GiddygoatSchema");
	$this->load->model("schema/MemberSchema");

	//Do your magic here
}

	// checks if the user is valid one by calling the a procedure
	function CheckValidUser()
	{
		$master_data = array(
			'emailAddress' => $this->input->post('emailAddress'),
			'password' => $this->input->post('password')
		);
		if (!empty($master_data)) {
			$check = "CALL GetUsermemberByCredentials(?,?)";
			$query = $this->db->query($check, $master_data);
			if ($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
	// gets the user by the getUserByCredentials
	public function getUserByCredentials($emailAddress, $password)
	{
		$parameters = array(
			$this->MemberSchema->emailAddress => $emailAddress,
			$this->MemberSchema->password => ($password)
		);
		$query = $this->db->get_where($this->GiddygoatSchema->Member, $parameters);
		return $query->row();
	}
}
