<?php

class userModel extends CI_Model
{

	// checks if the user is valid one by calling the a procedure
	function CheckValidUser()
	{
		$master_data['emailAddress'] = $this->input->post('emailAddress'); // retrieve f_name from form post
		$master_data['password'] = $this->input->post('password');
		if (!empty($master_data))
		{
			$check = "CALL GetUsermemberByCredentials(?,?)";
			$query = $this->db->query($check, $master_data);
			if ($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

}
?>

