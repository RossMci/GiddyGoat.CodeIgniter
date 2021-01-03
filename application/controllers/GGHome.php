<?php

class GGHome extends CI_Controller
{

//	function __construct()
//	{
//		parent::__construct();
//
////                $this->load->library('form_validation');
////		$this->form_validation->lo
////			if ($this->session->userdata('loggedIn'))
////		{
////			redirect('GGHome/index');
////		}
//	}

//	    // manges the user acess 
//	public function UserHasAccess()
//	{
//		// loads the user in the session 
//		$user = $this->session->user;
//		//checks if it null to see if logged in 
//		if ($user == NULL)
//		{
//			$this->load->view('Login');
//			return false;
//		}
//		return true;
//	}

	public function index()
	{
		/* Load the GiddyGoat Main Page  */

		$view_data = array(
			'content' => $this->load->view('content/main_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);

		$this->load->view('Layout', $view_data);
	}
    //loads the registers content
	function Register()
	{
		$view_data = array(
			'content' => $this->load->view('content/Register_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('Register', $view_data);
	}

	function ClassIndex()
	{
		$view_data = array(
			'content' => $this->load->view('content/class_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('Class_Layout', $view_data);
	}

	function fabrics()
	{
		$view_data = array(
			'content' => $this->load->view('content/fabrics_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('fabrics', $view_data);
	}

	function notions()
	{
		$view_data = array(
			'content' => $this->load->view('content/notion_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('notions', $view_data);
	}

	function Gallery()
	{
		$view_data = array(
			'content' => $this->load->view('content/Gallery_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('Gallery', $view_data);
	}

	function contact()
	{
		$view_data = array(
			'content' => $this->load->view('content/contact_content', null, True)
//			'Classes'=>$this->load->view('Classes.php',null,True)
		);
		$this->load->view('contact', $view_data);
	}

	// registers memebers 
	function Addmember()
	{
       //sets the validation rules
		$user_validation_rules = array(
			array('field' => 'fName',
				'label' => 'f Name',
				'rules' => 'required|max_length[75]',
//                  |text_size[30]
				'errors' => array('required' => 'You must provide a %s.',
//				'text_size' => '%s must be text size 30',
					'max_length' => '%s must be more then 1 character in length',)),
			array('field' => 'lName',
				'label' => 'l Name',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide a %s.')),
			array('field' => 'password',
				'label' => 'password',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'phone',
				'label' => 'phone',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'emailAddress',
				'label' => 'email Address',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'addressLine1',
				'label' => 'address Line 1',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'addressLine2',
				'label' => 'address Line 2',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'addressLine3',
				'label' => 'address Line 3',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'city',
				'label' => 'city',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'county',
				'label' => 'county',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'country',
				'label' => 'country',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
			array('field' => 'subscribe',
				'label' => 'subscribe',
				'rules' => 'required',
				'errors' => array('required' => 'You must provide an %s.')),
		);





		$this->form_validation->set_rules($user_validation_rules);



		if ($this->form_validation->run() == FALSE)
		{
			//Load the Main Menu view 
			$this->Register();
		}
		else
		{
//			$this->load->model('AddressBook');  //Loads the AddressBook  Model  

			$this->AddressBook->addMemberDetails();
			//Reload the main menu 

			$this->index();
		}
	}
	
	function displayFabrics(){
		$data['display_block'] = $this->AddressBook->displayFab();
		$this->fabrics($data);
	}

}

?>