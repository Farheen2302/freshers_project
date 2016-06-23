<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Login_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/

	private $user_data=array();

	private $user_login_data=array();
	
	function __construct()
	{
		parent::__construct();
	}

	/*
	* SET's & GET's
	* Set's and get's allow you to retrieve or set a private variable on an object
	*/


	/**
		ID
	**/

	/**
	* @return int [$this->_id] Return this objects ID
	*/
	public function getData()
	{
		return $this->user_login_data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setData($value)
	{
		$this->user_login_data = $value;
	}

	public function getUserData()
	{
		return $this->user_data;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setUserData($value)
	{
		$this->user_data = $value;
	}
	

	/*
	* Class Methods
	*/

	/**
	*	Commit method, this will comment the entire object to the database
	*/
	public function check()
	{
		//var_dump($this->getData());
		$user_info=array();
		$data=$this->getData();
		$query="";
		if($data['query_type']=='user_name')
		{

		$query="select * from authentication where user_name='".$data['user_name']."' and pass_hash='".$data['password']."'";
		}
		else
		{
			$query="select * from authentication where email_id='".$data['user_name']."' and pass_hash='".$data['password']."'";
		}
		$execute = $this->db->query($query);
		if($execute->num_rows() > 0)
		{
			$row=$execute->row();
			$a_id=(int)$row->auth_id;
			$execute2= $this->db->query("select * from user_profile where auth_id=".$a_id);
			$row2=$execute2->row();
			$temp_data=array(
				'u_id'=> "$row2->u_id",
				'first_name'=> "$row2->first_name",
				'last_name'=> "$row2->last_name",
				'about'=> "$row2->about",
				'pic_url'=>"$row2->profile_pic_url"

				);

			$this->setUserData($temp_data);
			return 1;

		}
		else
		{
			return 0;
		}
		
	}
}
