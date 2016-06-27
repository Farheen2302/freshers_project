


function validate_username(x)
{
	var error = "";
	var illegalChars = /[\W]/;

	if(x.value=="")
	{
		x.style.background='Yellow';
		error = "You didn't enter a user name.\n";
		alert(error);
		return false;
	}
	else if(((x.value).length < 5) || ((x.value).length >  15))
	{
		x.style.background = 'Yellow';
		error = "The username is the wrong length.\n";
		alert(error);
		return false;
	}
	else if(illegalChars.test(x.value))
	{
		x.style.background = "Yellow";
		error = "The username contains illegal Characters.\n";
		alert(error);
		return false;

	}
	else
	{
		x.style.background = "White";
	}
	return true;
}

function validate_email(x)
{
	var error = "";
	var illegalChars = /\W/;
	

	 if (x.value == "") {
        x.style.background = 'Yellow';
        error = "You didn't enter a Email Id.\n";
        alert(error);
        return false;
 
    }


	if((x.value).indexOf("@") > -1)
	{
		 apos=(x.value).indexOf("@");
         dotpos=(x.value).lastIndexOf(".");
        if (apos<1||dotpos-apos<2){
        	error = " Invalid Email field.\n";
            alert(error);
            return false;
        }
	}

	else
		{
			alert("Enter email id.\n");
			return false;
		}
	//alert("b");
	return true;
}


function validate_pass()
{
	var error = "";
	var illegalChars = /[\W]/;

	var x = document.getElementById("password");

	 if (x.value == "") {
        x.style.background = 'Yellow';
        error = "You didn't enter a password.\n";
        alert(error);
        return false;
 
    } else if ((x.value.length < 7) || (x.value.length > 15)) {
        error = "The password is the wrong length. \n";
        x.style.background = 'Yellow';
        alert(error);
        return false;
 
    } else if (illegalChars.test(x.value)) {
        error = "The password contains illegal characters.\n";
        x.style.background = 'Yellow';
        alert(error);
        return false;
 
    } else if ( (x.value.search(/[a-zA-Z]+/)==-1) || (x.value.search(/[0-9]+/)==-1) ) {
        error = "The password must contain at least one numeral.\n";
        x.style.background = 'Yellow';
        alert(error);
        return false;
 
    } else {
        x.style.background = 'White';

    }
    return true;
}

function validate_repass(y,y1)
{
	if(y.value==y1.value)
		{y1.style.background= "White";
		return true;
	}
	else
	{
		error = "password do not match.\n";
		alert(error);
		y1.style.background = "Yellow";
		return false;
	}
}



function phonenumber(n)  
{  
  var phoneno = /^\d{10}$/;  
  if(n.value.match(phoneno))
   {  
   		return true;  
   }  
    
   else  
        {  
        alert("Wrong Phone Number");  
        return false;  
        }  
}





function form_validate()
{

	//alert("inside");
	//var a = b = c = d = e =b1=f=true;

	var x = document.getElementById('username');
	
	if(x!=null){

	if((x.value).indexOf('@') > -1)
	{
		//alert("A");
		if(!validate_email(x))
			return false;
	}
	else
	{
		if(!validate_username(x))
			return false
	}
}

	var y = document.getElementById('password');
	if(y!=null)
	{
		if(!validate_pass(y))
			return false;
	}

	var y1 = document.getElementById('repassword');
	if(y1!=null)
	{
		if(!validate_repass(y,y1))
			return false;
	}

	var z = document.getElementById('email');
		if(z!=null)
		{
			if(!validate_email(z))
				return false;
		}

	var p = document.getElementById("phonenumber");
	if(p!=null)
	{
		if(!validate_phone(p))
			return false;
	}

	var q = document.getElementById("firstname");
	if(q!=null)
	{
		if(!validate_username(q))
			return false;
}

	var r = document.getElementById("lastname");
	if(r!=null)
	{
		if(!validate_username(r))
			return false;
	}

	
	
		//alert("right");
		document.getElementById("login_form").submit();
		 document.getElementById("login_form").reset();
		return true;



	
}
