<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html">
<META name="author" content="szeto008">
<link rel="stylesheet" type="text/css" href="/../style.css">
<title>szeto008</title>
<?php
	$rando=rand(10000,99999);	//neeed a random number with five lenght
	
	session_start();	//session start here 'cuz need the random num another php page

	$_SESSION['num'] = $rando;		//so session num will be $rando
	
?>

<script>

function send()
{
	//mail sending with code when the website was loaded or click the resend button
	<?php
		mail($_POST["mail"],"Email verification","The code is:".$rando."\n If you don't do this, then don't do anything." );   //send to a mail (to the mail texinput mailaddress)
	?>	
}

function codec()
{
	
	if(document.sp.code.value.length==5)		//if the input text length is 5
	{
		document.sp.code.value=parseInt(document.sp.code.value);	//text will be numbers
		document.sp.submit();		//goto another (mail3.php) php file
	}
	else
	{
		document.getElementById("htwo").innerHTML="Check your mails(also spamfolder)(IT IS NOT 5 NUMBER)";	//another way show the problem
	}
	
	
}


</script>
</head>
<body onLoad="send();">
<h1>Email verification</h1>
<h2 id="htwo">Check your mails(also spamfolder)</h2>
<form name="sp" method="post" action="mail3.php">
Code:<input type="text" id="code" name="code"><input type="button" value="Check" onClick="codec();"><input type="button" value="REsend" onClick="send();"><input type="reset" value="Del" onClick="return confirm('Really?');">
</form>
<h3><a name="bak" href="mail.php">Back</a></h3>
<h4><a name="home" href="/../index.html">Homepage</a></h4>
</body>
</html>
