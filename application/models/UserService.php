<?php

class UserService extends CI_Model
{

	// checks if the user is valid one by calling the a procedure
	function CheckValidUser()
	{
		$master_data = array(
                    'emailAddress' => $this->input->post('emailAddress'),
                    'password' => $this->input->post('password'));
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

