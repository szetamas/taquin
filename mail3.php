<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html">
<META name="author" content="szeto008">
<link rel="stylesheet" type="text/css" href="/../style.css">
<title>szeto008</title>
<?php

	session_start();		//session starting
	
	$num=$_SESSION['num']; 	
	
	if($num==$_POST["code"])
	{
		$val=1;		//if the numbers is equal, validate will be 1
	}
	else
	{
		$val=0;		//another way, validate=0
	}
	

?>

<script>
if(<?php echo $val;?>==1)
{
	alert("Verification SUCCES");	//the numbers eq(val==1)
}
else
{
	alert("Verification FAILED");	//another way it is fail
}

window.location.href="mail.php";		//goto the first(mail.php) php

</script>
</head>
<body>
<h3><a name="bak" href="mail2.php">Back</a></h3>
<h4><a name="home" href="/../index.html">Homepage</a></h4>
</body>
</html>
