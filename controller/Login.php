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
	private $uu_id;
	public function index()
	{
		$this->load->view('login_view');
		//$this->load->helper(array('form', 'url')); 
	}


	public function login_call(){
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
			$user_data=$model->getUserData();
			if($user_data['isactivated'])
				{
					var_dump($model->getUserData());
				}

			else
			{
				echo "kindly activate your account first!";
			}
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

	public function validate()
	{
		$data=array(
			'code'=> $this->input->get('code'),
			'emailid'=> $this->input->get('email_id')
			
			);
		$this->load->model('register_model');

		$model= new register_model;

		$flag=$model->activate($data);

		if($flag)
		{
			echo "your account is successfully updated.";
			sleep(2);
			$this->load->view('login_view');

		}
		else
		{
			echo "there has been a error in validating your account";
		}


	}

	public function send_mail($emailid, $name ,$title, $message)
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
        $this->email->to($emailid , $name);

        $this->email->subject($title);
        $this->email->message($message);  

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
			//send validation mail
			$url=$model->getActivationUrl();
			$message="Kindly validate your Email-ID by clicking on this link->".$url;
			$title="ASKandANSWER-Email Verification";
			$this->send_mail($input_data['emailid'], $input_data['f_name'], $title, $message);

			echo "Verification Email sent.";



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
	

	//Resertt password after the link click

	public function reset_password()
	{
		$data=array(
			'code'=> $this->input->get('code'),
			'emailid'=> $this->input->get('email_id')
			
			);
		$this->load->model('Forgot_pass_model');


		$model= new Forgot_pass_model;

		$flag=$model->verify_hash($data);

		if($flag)
		{
			$this->load->view('Reset_Password_View',$data);
		}
		else
		{
			echo "there has been a error in validating your account";
		}


	}

	
	public function forget_password_load_view()
	{
		// $error='hello';
		$this->load->view('forgot_pass_view');
	}

	public function forgot_password()
	{
		$input_data = $this->input->post('emailid');

		$this->load->model('Forgot_pass_model');

		$model= new Forgot_pass_model;
		//$model->setUserData($input_data);

		if($model->email_exists($input_data))
		{

			//NOW SEND THE EMAIL TO REGISTERED EMAIL ID
			//$model->generate_activation_url($input_data);
			$url=$model->generate_activation_url($input_data);
			$f_name = $model->getFirstName();
			$message="Kindly reset your ASKandANSWER password by clicking on this link->".$url;
			$title="ASKandANSWER- Reset Password";
			$this->send_mail($input_data, $f_name, $title, $message);

			echo "Reset Password Email sent.";
			
				echo "Click the link sent to you in your registered email id to reset the Password.!!\n";
				//sleep(5);
				//$this->load->view('login_view');
		}

	}



	public function enter_new_pass()
	{
		$this->load->model('Forgot_pass_model');
		$model= new Forgot_pass_model;
		//$user_id = $model->getUserId();
		$newpassword = $this->input->post('pass');
		echo "Here is new  password set\n";
		$email_id = $this->input->post('email_id');
		echo $email_id;
		echo "Password=";
		echo $newpassword;
		//echo "$uu_id"+"\n";
		$flag = $model->set_new_password($newpassword,$email_id);
		if($flag)
			echo "Password Reset Successfully!!";
		else
			echo "Password reset Failed!!";

	}	

/*

	public function tag()
	{
		$tag_name = $this->input->post("tag_name");
		$this->load->model("Tag_model");
		$model = new Tag_model;
		$tag_data = Tag_model->get_tag_detail($tag_name);
		$this->load->view("Tag_view",$tag_data);

	}

	*/

}
