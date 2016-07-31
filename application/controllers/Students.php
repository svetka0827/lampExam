<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student');

	}
	
	public function index()
	{
		$this->load->view('login');
	}

	public function welcome()
	{
		$this->load->view('welcome');
	}





	// function to add student to database:
	public function add()
	{
       // to load library to validate form:
        $this->load->library('form_validation');



        // set validation rules
        // the arguments it takes: the exact name of input,the human name to show on errors, error validation. 

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');



        if ($this->form_validation->run() == FALSE)
        {

        	$this->session->set_flashdata("registration_errors", validation_errors());

			redirect('/Students/index');
            
        }
        else
        {
        	$post=$this->input->post();
        	$data=array(
				'first_name'=>$post['first_name'],
				'last_name'=>$post['last_name'],
				'email'=>$post['email'],
				'password'=>$post['password'],
				'confirm_password'=>$post['confirm_password']
			);

			$this->Student->add_student($data);

			$this->session->set_flashdata("success","You have officially registered, Now you can login");




            redirect('/Students/index');
        }
    }


		

	public function log_in()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email is not valid', 'trim|required');
		$this->form_validation->set_rules('password', 'Password doesnt match', 'trim|required');



		
		$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);

		$result = $this->Student->log_in($data);

				
		if ($result) 
		{
			$session_data = array(
							'first_name' => $result['first_name'],
							'last_name' => $result['last_name'],
							'email' => $result['email'],
							'logged_in'=>true				
						);
					

			// Add user data in session
			$this->session->set_userdata($session_data);
			redirect('/Students/welcome');
					
		} 
		else
		{
			
				
			$this->session->set_flashdata("login_errors", "Invalid User Id and Password combination");

			redirect('/Students/index');
		}
	}






	public function logout()
	{
		$user_session_data = $this->session->all_userdata();
		
		foreach($user_session_data as $key)
		{
			$this->session->unset_userdata($key);
		}
		
		$this->session->sess_destroy();
		redirect(base_url());
	}

}	
	
	







