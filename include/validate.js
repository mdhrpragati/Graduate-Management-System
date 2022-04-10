function validate_email()
{
	var x=document.forms['add']['email'].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		alert("Not a valid e-mail address!! Please insert it again");
		return false;
	}
}
function confrm()
{
		var con=confirm("Do you really want to perform this operation?");
		return con;
}

function validate_course_code()
{	
	var x=document.forms['add_sub']['course_code'].value;
	var y=document.forms['add_sub']['credit'].value;

	//alert(add_sub.course_code.length);
	

	if(y.length>1)			
	{
		alert('Please enter the Credit Correctly!!!');
		return false;
	}
	else if(x.length<4)
	{
		alert(' Please enter the correct course code!!!');
		return false;	
	}
	
		
}
