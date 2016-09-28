<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->library('form_validation');

	}
	
	public function index()
	{
		$this->load->view('login');
	}

	public function welcome()
	{
		$quotes=$this->User->all_quotes();
		$user_id=$this->session->userdata('id');
		$favorites=$this->User->all_favorites($user_id);

		$data=array(
			'quotes'=>$quotes,
			'favorites'=>$favorites
			);

		$this->load->view('welcome',$data);
	}



	public function add_user()
	{
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('alias', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('dob','DOB','trim|required'); 
				



        if ($this->form_validation->run() == FALSE)
        {

        	$this->session->set_flashdata("registration_errors", validation_errors());

			redirect('/Users/index');
            
        }
        else
        {
        	$post=$this->input->post();
        	$date=$post['dob'];
        	$arr1=str_split($date);
        	for($i=0; $i<count($arr1); $i++){
        		if($arr1[$i]==="/"){
        			unset($arr1[$i]);
        		}
        	}

        	$date=implode("",$arr1);
    
        	$data=array(
				'name'=>$post['name'],
				'Alias'=>$post['Alias'],
				'email'=>$post['email'],
				'password'=>$post['password'],
				'confirm_password'=>$post['confirm_password'],
				'dob'=>$date
			);

			$this->User->add_user($data);

			$this->session->set_flashdata("success","You have officially registered, Now you can login");

            redirect('/Users/index');
        }
    }



 	// public function check_dob($value)
 	// {
 	// 	$dob= new DateTime($value);
 	// 	$now= new DateTime(date('Y-m-d'));
 	// 	$interval=$dob->diff($now);
 	// 	if($interval->invert ==1)
 	// 	{
 	// 		$this->session->set_flashdata("dob_error", "You cannot be born in the future");
 	// 		return FALSE;
 	// 	}
 
 	// }
		

	public function log_in()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email is not valid', 'trim|required');
		$this->form_validation->set_rules('password', 'Password doesnt match', 'trim|required');


		$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);

		$result = $this->User->log_in($data);


				
		if ($result) 
		{
			$session_data = array(
							'name' => $result['name'],
							'alias' => $result['alias'],
							'email' => $result['email'],
							'id'=>$result['id'],
							'logged_in'=>true				
						);
					

			// Add user data in session
			$this->session->set_userdata($session_data);
			$this->User->log_in($session_data);
			redirect('/Users/welcome');
					
		} 
		else
		{
			
				
			$this->session->set_flashdata("login_errors", "Invalid User Id and Password combination");

			redirect('/Users/index');
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


	public function add_quote(){
		$quote=$this->input->post();

		$data=array(
			'quote'=>$quote['quote'],
			'user_id'=>$this->session->userdata('id')
			);

		$this->User->add_quote($data);

		redirect('/Users/welcome');
	}


	public function add_favorites($quote_id){
	
		$data=array(
			'quote_id'=>$quote_id,
			'user_id'=>$this->session->userdata('id')
			);

		$this->User->add_favorite($data);

		redirect('/Users/welcome');
	}


	public function delete_favorite($favorite_id){
		$this->User->delete_favorite($favorite_id);
		redirect('/Users/welcome');
	}


	public function display_user($user_id){
		$user_info=$this->User->user_quotes($user_id);
		$user_qoute_count=$this->User->user_quote_count($user_id);

		$data=array(
			'user_info'=>$user_info,
			'user_qoute_count'=>$user_qoute_count
			);

		$this->load->view('user',$data);

	}


}	
	
	







