<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    
  </head>

  <body>

    
    
    <form action="http://www.askandanswer.com/index.php/login/login_data" method="post">
  Username/Email <input type="text" name="userid" id="username" ><br>
  Password<input type="password" name="pass" id="password" ><br>
  <input type="submit" value="Submit" id = "submit" onclick="form_validate()">
</form>

Not a user yet!
<a href="">Register</a>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <<script type="text/javascript" src="registration.js"></script>

  </body>
</html>

