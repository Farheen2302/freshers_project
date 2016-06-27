<?php

	class Tag_model extends CI_Model
	{
		private $tag_id;
		private $tag_name;
		private $followers;
		private $description;

		function __construct()
		{
			parent::__construct();
		}

		public function get_tag_detail($tag_name)
		{

			$tag_data = "select * from tags where name ='".$tag_name."'";
		}
	}