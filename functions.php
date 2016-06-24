<?php
	function sec_session_start() {
	
	$session_name = 'sec_session_id';
	$secure = true; // for https
	
	$httponly = true;
	//This prevents javascript from b=being able to reutrn session id

	if(ini_set('session.use_only_cookies',1) === FALSE) {
	
	// to send raw http header to the client
	header("Location: ../error.php?err=Could not initiate a safe session(ini_set));
