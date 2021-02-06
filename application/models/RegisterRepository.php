<?php

class RegisterRepository extends CI_Model
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
}
