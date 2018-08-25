<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html" charset="UTF-8">
<META name="author" content="szeto008">
<title>szeto008</title>
<?php
$dir=glob("*.png");		//list all png format file this directory and put in dir array(string)
?>
<script>
function chose(id,num,w)
{
	document.sp.gid.value=picid[id];		//change the id to a correct id
	document.sp.siz.value=num;		//change the puzzle width(3 or 4 or 5)
	document.sp.wid.value=picwid[w];		//and width
	document.sp.submit();		//and goto the another php file
}
pic="<?php for($cv=0;$cv<sizeof($dir);$cv++){if($cv==(sizeof($dir)-1)){echo $dir[$cv];}else{echo $dir[$cv].',';}} ?>".split(",");
//pic will be list of png files without png format
</script>
<style type="text/css">
a, a:visited, a:active, a:hover {color: black;}
</style>
</head>
<body  style="background-color:#3399ff">
<form name="sp" method="get" action="taquin2.php">
<h1>Taquin</h1>
<input type="text" name="gid" value="id" readonly hidden>
<input type="text" name="siz" value="size" readonly hidden>
<input type="text" name="wid" value="width" readonly hidden>
<script>
picid=[];
picwid=[];
document.write('<table><tr>');
for(cv=0;cv<pic.length;cv++)
{
	if(cv%3==0 && cv!=0)		//3 pic on a row
	{
		document.write('</tr><tr>');
	}
	picid[cv]=pic[cv].substring(0,pic[cv].indexOf('_'));		//actual pic id be the filename without .png and _width
	picwid[cv]=pic[cv].substring(pic[cv].indexOf('_')+1,pic[cv].indexOf('.'));		//pic wid is filename _ to .
	
	//actual img element has actual png filename with format
	document.write('<td><img src="'+pic[cv]+'" draggable="false" width="500px" height="500px">');
	document.write('<h1><b onClick="chose('+cv+',3,'+cv+');">3X3</b> <b onClick="chose('+cv+',4,'+cv+');">4X4</b> <b onClick="chose('+cv+',5,'+cv+');">5X5</b></h1></td>');
	//and onlick chose 3x3 4x4 or 5x5 with id and width
}
document.write('</tr></table>');
</script>
</form>
<h1><a name="bak" href="/../game.html">Back</a></h1>
<h1><a name="home" href="/../index.html">Homepage</a></h1>	
</body>
</html>
