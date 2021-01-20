<?php

class GGLogin extends CI_Controller
{

	//	function __construct()
	//	{
	//		parent::__construct();
	//		$this->load->library('../controllers/GGHome');
	//
	////		if ($this->session->userdata('loggedIn'))
	////		{
	////			redirect('GGHome/index');
	////		}
	//	}

	// function checks the member is logined in  and process login
	function index()
	{
		//loads the model and controller

		//		$this->load->library('../controllers/GGHome');
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

				$this->load->model('schema/MemberSchema');

				$emailAddress = $this->input->post($this->MemberSchema->emailAddress);
				$password = $this->input->post($this->MemberSchema->password);
				$this->load->model('UserService');
				$user = $this->UserService->getUserByCredentials($emailAddress, $password);

				if (isset($user)) {
					$this->session->set_userdata("UserId", $user->member_id);
				} else {
					// tell jedi of their failure
				}

				redirect('GGHome/index');
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
