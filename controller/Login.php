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

	public function signup()
	{
		$this->load->view('show_users');
	}
}
