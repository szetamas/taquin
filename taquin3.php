<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html" charset="UTF-8">
<META name="author" content="szeto008">
<title>szeto008</title>
<style type="text/css">
a, a:visited, a:active, a:hover {color: black;}
</style>
</head>
<body  style="background-color:#3399ff">
<?php

$filenm=$_POST["filenm"];		//it is the filename without .txt 
$siz=$_POST["siz"];		//i need the size
$nick=$_POST["nick"];		//the nick
$score=$_POST["score"];		//and score

$filenm=$filenm."/".$siz.$filenm.".txt";		//filename will be full with num and .txt +path(directory)

if($score!=-1)	//if it is not a spect.
{
	mail("tamas94@protonmail.com","Taquin","Filename:".$filenm." size:".$siz." nickname:".$nick." score:".$score." http://szeto008.uw.hu/taquin/taquin.php");		//mail to me
}

		
echo "<h1>Scorelist</h1>";
if(file_exists($filenm))		//if the file is exist
{ 
	$filread = fopen($filenm,"r");		//open read (filepointer at the beginning)
	$cv=0;		//index of array
	while(!feof($filread))   //if it is not the endoffile
	{
		$mystring=fgets($filread);		//i read 1 line to the array
		if(strpos($mystring,"<=>"))		//if the line has <=>
		{
			$listname[$cv]=substr($mystring,0,strpos($mystring,"<=>"));		//name is first char to "<=>"
			$listscore[$cv]=substr($mystring,strpos($mystring,"<=>")+3,-1);		//score start the "<=>"+3 to end
			$cv++;
		}
	}
	fclose($filread);	//close the file
	
	if($score==-1)		//spectate and exist file
	{
		for($cv=0;$cv<count($listname);$cv++)
		{
			echo "<h2>".($cv+1).".: ".$listname[$cv]." : ".$listscore[$cv]."</h2>";		//I write the list
		}
	}
	else
	{		//exist file and correct nick and point
	
		for($cv=0;$cv<count($listname);$cv++)		//i go trough listscore array
		{
			if((int)$score<(int)$listscore[$cv])  	//if the actual user score less than an list user's score
			{
				$newlistscore[$cv]=$score;		//user data put the new array
				$newlistname[$cv]=$nick;
				for($cv2=$cv;$cv2<count($listname);$cv2++)		//and continue
				{
					$newlistscore[$cv2+1]=$listscore[$cv2];		//new arraylength + 1 = old arraylength
					$newlistname[$cv2+1]=$listname[$cv2];
			
				
				}
				break;
			}
			
			$newlistscore[$cv]=$listscore[$cv];		//all array element put in the new array
			$newlistname[$cv]=$listname[$cv];		//and the names
			if($cv==count($listname)-1)		//if it is the last 
			{
				$newlistscore[$cv+1]=$score;		//user data put the new array last + 1 element
				$newlistname[$cv+1]=$nick;
			}
		}	
		
		$filwrite = fopen($filenm,"w");		//open write(delete original) (filepointer at the beginning)
		
		for($cv=0;$cv<count($newlistname) && $cv<10;$cv++)		//the last element do not write, so trough the array BUT max 10
		{
			fwrite($filwrite, $newlistname[$cv]."<=>".$newlistscore[$cv]."\n");		//write in file newlistname <=> and points and enter		
			echo "<h2>".($cv+1).".: ".$newlistname[$cv]." : ".$newlistscore[$cv]."</h2>";		//I write the new list
		}
		fclose($filwrite);		//close the file
		echo "<br><h3 style='text-decoration: overline;'>Your points:".$score."</h3>";		//write above user points
	}

	
}
else
{
	if($score==-1)		//spectate and doesnt exist file
	{
		echo "<h2>List doesn't exist :/</h2>";
	}
	else        //new list
	{
		
		$newfilwrite = fopen($filenm,"w");		//open write(delete original) (filepointer at the beginning)
		fwrite($newfilwrite, $nick."<=>".$score."\n");		//write in file newlistname <=> and points and enter		
		fclose($newfilwrite);	//close the file
		echo "<h2>1.:".$nick." : ".$score."</h2>";		//I write the new list
		echo "<br><h3 style='text-decoration: overline;'>Your points:".$score."</h3>";		//write above user points
		
	}
}	

?>
<h1><a name="bak" href="taquin.php">Back</a></h1>
<h1><a name="home" href="/../index.html">Homepage</a></h1>	
</body>
</html>
