function form_validate()
{

	var x = document.getElementById("username");
	var error = "";
	var illegalChars = /\W/;
	if((x.value).indexOf('@') > -1)
	{
		 apos=value.indexOf("@");
         dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2){
        	error = " Invalid Email field.\n";
            alert(error);
            return false;
        }
	}
	
	else
	{
	if(x.value=="")
	{
		x.style.background='Yellow';
		error = "You didn't enter a user name.\n";
		alert(error);
		return false;
	}
	else if((x.value.length < 5) || (x.value.length >  15))
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
}
	var error = "";
	var illegalChars = /[\W_]/;

	var x = document.getElementById("password");

	 if (x.value == "") {
        x.style.background = 'Yellow';
        error = "You didn't enter a password.\n";
        alert(error);
        return false;
 
    } else if ((x.value.length < 7) || (fld.value.length > 15)) {
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