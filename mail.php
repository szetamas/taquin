<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html">
<META name="author" content="szeto008">
<link rel="stylesheet" type="text/css" href="/../style.css">
<title>szeto008</title>
<script>
function validate()
{
	//validation, if the mail address(in textinput) length is more than 3 and it has @ sign
	if(document.sp.mail.value.length>3 && document.sp.mail.value.indexOf("@")!=-1)
	{
		document.sp.submit();	//it is valid, so submiting the form and go another(mail2.php) php file
	}
	else
	{
		//another option show that mail address is not good
		document.getElementById("out").innerHTML="Email verification(THE MAIL ADDRESS IS NOT GOOD)";		//text into a h1 tag
	}
	
}

</script>
</head>
<body>
<h1 id="out">Email verification</h1>
<form name="sp" method="post" action="mail2.php">
Email:<input type="text" name="mail"><input type="button" value="Start" onClick="validate();"><input type="reset" value="Del" onClick="return confirm('Really?');">
</form>
<h3><a name="home" href="/../index.html">Homepage</a></h3>
</body>
</html>
