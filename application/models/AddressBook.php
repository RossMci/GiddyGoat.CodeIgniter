<?php

class AddressBook extends CI_Model
{
   //adds the members too the data base by calling the stored procdure and also collects the values from the forms
	function addMemberDetails()
	{
		$member_data['fName'] = $this->input->post('fName');
        $member_data['lName'] = $this->input->post('lName');
        $member_data['password'] = $this->input->post('password');
		$member_data['phone'] = $this->input->post('phone');
		$member_data['emailAddress'] = $this->input->post('emailAddress');
		$member_data['addressLine1'] = $this->input->post('addressLine1');
		$member_data['addressLine2'] = $this->input->post('addressLine2');
		$member_data['addressLine3'] = $this->input->post('addressLine3');
		$member_data['city'] = $this->input->post('city');
		$member_data['county'] = $this->input->post('county');
		$member_data['country'] = $this->input->post('country');
		$member_data['subscribe'] = strtoupper($this->input->post('subscribe'));
		$stored_proc_call = "CALL Register_Member(? ,? ,? ,? ,? ,? ,? ,? ,? ,?, ?, ?)";
		$this->db->query($stored_proc_call, $member_data);

		
	}
	
	function displayFab(){
		$display_block = "";
		$stored_proc_call = "CALL getFabrics()";
		$query = $this->db->query($stored_proc_call);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $fabric)
			{      
				$id = $fabric['master_id'];
				$description =$fabric['description'];
				$image =$fabric['image'];
				$display_block.="<tr>";
//				$display_block .= "<td>\"" . $description . "\"<image src=\" . $image . "/""</td>";
				$display_block.="</tr>";
			}
		}
		else
		{
			$display_block .= "<option>No Contacts to Select</option>";
		}
		mysqli_next_result($this->db->conn_id);
		return $display_block;
	}

	
}
?>

