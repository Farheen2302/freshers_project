<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login_view');
		//$this->load->helper(array('form', 'url')); 
	}


	public function login_data(){
		$data = array(
		'user_name' => $this->input->post('userid'),
		'password' => $this->input->post('pass'),
		'query_type' => ''
			);
		if(strstr($data['user_name'],'@'))
		{
			$data['query_type']='emailid';
		}
		else{
			$data['query_type']='user_name';
		}
		$this->load->model("login_model");

		//var_dump($data);
		$model= new login_model;
		$model->setData($data);
		//var_dump($model->getData());

		$flag=$model->check();
		if($flag)
		{
			var_dump($model->getUserData());
		}
		else
		{
			print("Not Found!");
		}

	}

	public function signup_view()
	{
		// $error='hello';
		$this->load->view('register_view');
	}



	public function send_mail($data='')
	{
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'discusswebservice@gmail.com',
		    'smtp_pass' => 'thisisubuntu',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

	    $config['newline'] = "\r\n";

		$this->load->library('email', $config);
		$this->email->from('discusswebservice@gmail.com');
        $this->email->to('tarun.kr0094@gmail.com','tarun');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

        $this->email->send();

        echo $this->email->print_debugger();
	}




	public function register()
	{

		$input_data = array(
		'userid' => $this->input->post('userid'),
		'pass' => $this->input->post('pass'),
		'emailid'=> $this->input->post('emailid'),
		'f_name'=>$this->input->post('f_name'),
		'l_name' => $this->input->post('l_name'),
		'about_me' => $this->input->post('about_me'),
		
			);
		//var_dump($input_data);

		 $this->load->model('register_model');

		$model= new register_model;
		$model->setUserData($input_data);
		$flag=$model->write();

		$file_name=$model->getProfileUrl();
		if($flag)
		{

         $config['upload_path']   = './uploads'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 4000; 
         $config['max_width']     = 1920; 
         $config['max_height']    = 1080; 
         $config['file_name'] =  $file_name;
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload("profile")) {
            $error = array('error' => $this->upload->display_errors()); 
            echo "ERROR Encountered!";
            
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
            var_dump($data);
            echo "Profile Successfully registered!";

           } 
  	       
         
		}
	}
}
