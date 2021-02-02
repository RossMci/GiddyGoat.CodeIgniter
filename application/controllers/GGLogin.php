<?php

class GGLogin extends CI_Controller
{

	// function checks the member is logined in  and process login
	function index()
	{
		$this->load->model('UserService');
		$this->load->model('schema/MemberSchema');
		//loads the model and controller

		//sets the validation rules
		$user_validation_rules = array(
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'required|min_length[2]|max_length[15]',
				'errors' => array(
					'required' => 'You must provide an %s.',
					'min_length' => '%s must be more then 1 character in length',
					'max_length' => '%s must be between 15 character in length'
				)
			),
			array(
				'field' => 'emailAddress',
				'label' => 'email Address',
				'rules' => 'required|max_length[75]',
				'errors' => array(
					'required' => 'You must provide an %s.',
					'max_length' => '%s must be between 75 character in length'
				)
			)
		);

		$this->form_validation->set_rules($user_validation_rules);
		if ($this->form_validation->run() == FALSE) {
			redirect('GGHome/index');
		} else {
			if ($this->input->post('Login')) {
				$emailAddress = $this->input->post($this->MemberSchema->emailAddress);
				$password = $this->input->post($this->MemberSchema->password);
				$user = $this->UserService->getUserByCredentials($emailAddress, $password);

				echo "<h1>alert</h1>";
				echo "<h1>alert</h1>";
				if ($user!= null) {
					$this->session->set_userdata("UserId", $user->member_id);
				} else {
					$vars = array(
						'content' => $this->load->view('content/main_content', null, True),
						"error" => "Incorrect login details entered",
						"emailAddress" => $emailAddress
					);
					echo "<h1>alert</h1>";

					$this->load->view('Layout', $vars);
				}
			}
		}
	}

	// destorys the session and logout user 
	function logout()
	{
		unset($_SESSION['UserId']);
		$this->session->sess_destroy();
		redirect('GGHome/index');
	}
}
