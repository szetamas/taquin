<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="content-type" content="text/html" charset="UTF-8">
<META name="author" content="szeto008">
<title>szeto008</title>
<?php

$id=$_GET["gid"];		//i get the id 
$siz=$_GET["siz"];		//and get width
$wid=$_GET["wid"];		//and width

?>
<script>
gid="<?php echo $gid; ?>";		//get id php value goto a javascript value
size="<?php echo $siz; ?>";		//and get it size
origwid="<?php echo $wid; ?>";	//and picture width
wid=parseInt(origwid/size);		//the width get big pictures width / size (it is a little pic width)

function rando(a){	
	return Math.floor(Math.random()*a);		//random numbers
}

function ani(id,tox,toy,sx,sy)		//animation funct. with id and destination x/y coord and speed of x and y axis
{
	if(squares[id].acx>tox-sx && sx<0)		//if the picture go right to left, so x axis speed is negative and actual x more than that destination
	{	
		squares[id].acx+=sx;	//actual coord give speed value(it is negative so it is decrement)
		squares[id].mov(squares[id].acx,squares[id].acy);		//take the picture new coords
		window.setTimeout(ani,1,id,tox,toy,sx,sy);		//and repeat this
	}
	else
	{
		if(squares[id].acx>tox && sx<0)		//if actual x coords not more than destination with speed value
		{	
			squares[id].acx=tox;		//actual give it destination coords 
			squares[id].mov(squares[id].acx,squares[id].acy);	//and take it him
			check();		//finally check, that it is a win or not
		}
	}
	if(squares[id].acx<tox-sx && sx>0)		//it is right to left move
	{
		squares[id].acx+=sx;
		squares[id].mov(squares[id].acx,squares[id].acy);
		window.setTimeout(ani,1,id,tox,toy,sx,sy);
	}
	else
	{
		if(squares[id].acx<tox && sx>0)
		{	
			squares[id].acx=tox;
			squares[id].mov(squares[id].acx,squares[id].acy);
			check();
		}
	}
	
	if(squares[id].acy>toy-sy && sy<0)		//it is down to up move
	{	
		squares[id].acy+=sy;
		squares[id].mov(squares[id].acx,squares[id].acy);
		window.setTimeout(ani,1,id,tox,toy,sx,sy);
	}
	else
	{
		if(squares[id].acy>toy && sy<0)
		{	
			squares[id].acy=toy;
			squares[id].mov(squares[id].acx,squares[id].acy);
			check();
		}
	}
	
	if(squares[id].acy<toy-sy && sy>0)		//it is up to down move
	{	
		squares[id].acy+=sy;
		squares[id].mov(squares[id].acx,squares[id].acy);
		window.setTimeout(ani,1,id,tox,toy,sx,sy);
	}
	else
	{
		if(squares[id].acy<toy && sy>0)
		{	
			squares[id].acy=toy;
			squares[id].mov(squares[id].acx,squares[id].acy);
		
			check();
		}
	}
	
	
}

function check(){
	for(var compl=true,cv=0;cv<(size*size)-1;cv++)		//go trough squares array and complete be true
	{
		if(!(squares[cv].realx==squares[cv].acx && squares[cv].realy==squares[cv].acy))		//check that all pictures have rights coords
		{
			compl=false;	//if actual squares has not right coords, complete be false
		}
	}
	if(compl)	//if all square have rights cooord
	{
		go=false;		//stop again
		hidchange(1);		//reveal the last pic with hidd func 1 param(0 is hidden another else is visible)
		document.getElementById("ag").innerHTML="WIN, again?"		//write that this is a WIN
		document.sp.nick.value=prompt("You win, what is your (nick) name?(if you don't want this click the cancel)");		//ask user nickname
		
		if(document.sp.nick.value!="noname" && document.sp.nick.value!="")	//if not then push the cancel
		{
			document.sp.score.value=score;		//try numbers be score
			document.sp.siz.value=size;
			document.sp.filenm.value=gid;	//write the filename
			document.sp.submit();		//goto another(taquin3) php file
		}
	}
}

function square(id, realx, realy, acx, acy){		//constructor with id, official x and y coords and the actual x and y coords
    this.id=id;
    this.realx=realx; 
    this.realy=realy;
    this.acx=acx;
    this.acy=acy;
    this.mov=function(x,y){	
				this.acx=x;
				this.acy=y;
				document.getElementById(this.id).style.left=this.acx+"px";		//this pic x coord change the new coord
				document.getElementById(this.id).style.top=this.acy+"px";		//y too				
	};
} 

function init(){		
	//after hidden the last picture (9)
	go=true;
	
	score=0;	//start, or start again game
	document.getElementById("score").innerHTML=score;	//score appear in html tag
	
	document.getElementById("ag").innerHTML="Again";			//Write "again" in the bottom
	var db=0;		//piece of try sliding be 0
	var limit=0;		//limit of rights picture
	do{
		slide(rando((size*size)-1),true);	//try sliding a random square of 9 squares
		db++;		//piece incrementing
		var db2=0;		//right square numbers is equal 0
		for(var cv=0;cv<(size*size)-1;cv++)		//go through squares array
		{
			if(squares[cv].realx==squares[cv].acx && squares[cv].realy==squares[cv].acy)	//and check that actual square is right
			{
				db2++;	//piece of right square incrementing
			}
		}
		switch(db)		//if db is much(200) then the limit incrementing
		{
				case 200:
					limit=2;
					break;
				case 400:
					limit=4;
					break;
				case 600:
					limit=6;
					break;
		}
			
	}while(db2>limit || db<150);		//if right square nums more than limit and db is less
}

function slide(id,auto)		//sliding picture(id is 0-7) with a bool(auto)
{
	var x=squares[id].acx;		//puffer x be clicked picture's actual x coord
	var y=squares[id].acy;		//puffer y too
	if(squares[id].acx-wid==squares[(size*size)-1].acx && squares[id].acy==squares[(size*size)-1].acy)		//if the clicked picture is to RIGHT of the hidden picture 
	{
		if(auto)	//if it is an utomata slide
		{
			squares[id].mov(squares[(size*size)-1].acx,squares[(size*size)-1].acy);		//its just a swap without anim
		}
		else
		{
			ani(id,squares[(size*size)-1].acx,squares[(size*size)-1].acy,-10,0);		//clicked picture move to hidden picture coords, with andimation
			//anim func get id, place where go to the picture and x/y axis speed	
			score++;	//increment points
		}
		squares[(size*size)-1].mov(x,y);		//hidden picture goto the puffer coords(clicked picture coords)
	}
	else if(squares[id].acx+wid==squares[(size*size)-1].acx && squares[id].acy==squares[(size*size)-1].acy)		//else if the clicked picture is to LEFT of the hidden picture 
	{
		if(auto)
		{
			squares[id].mov(squares[(size*size)-1].acx,squares[(size*size)-1].acy);
		}
		else
		{
			ani(id,squares[(size*size)-1].acx,squares[(size*size)-1].acy,10,0);		//swap 2 pictures...
			score++;
		}
		squares[(size*size)-1].mov(x,y);
	}
	else if(squares[id].acx==squares[(size*size)-1].acx && squares[id].acy-wid==squares[(size*size)-1].acy)		//else if the clicked picture is to UNDER of the hidden picture
	{
		if(auto)
		{
			squares[id].mov(squares[(size*size)-1].acx,squares[(size*size)-1].acy);
		}
		else
		{
			ani(id,squares[(size*size)-1].acx,squares[(size*size)-1].acy,0,-10);
			score++;
		}
		squares[(size*size)-1].mov(x,y);
	}
	else if(squares[id].acx==squares[(size*size)-1].acx && squares[id].acy+wid==squares[(size*size)-1].acy)		//else if the clicked picture is to ABOVE of the hidden picture
	{
		if(auto)
		{
			squares[id].mov(squares[(size*size)-1].acx,squares[(size*size)-1].acy);
		}
		else
		{
			ani(id,squares[(size*size)-1].acx,squares[(size*size)-1].acy,0,10);
			score++;
		}
		squares[(size*size)-1].mov(x,y);
	}
	
	document.getElementById("score").innerHTML=score;	//if it is an automata slide the score is equal that in html score, so nothing happens
	//but if it is a user slide score increment(in onclick atr.) and write the new score
	
	
}

function hidchange(st)		//st is status(hidden or visible) 'cuz to more quotation marks in the onclick atr.(start button)
{
	if(st==0)
	{
		document.getElementById((size*size)-1).style.visibility="hidden";	//if the hidchange(0) then hidden
	}
	else
	{
		document.getElementById((size*size)-1).style.visibility="visible";	//hidchange(1) then visible
	}
}

function spec()
{
	document.sp.nick.value="spectator";		//it is the nick if he/she want spectate score list
	document.sp.score.value=-1;		//it is the mark
	document.sp.siz.value=size;
	document.sp.filenm.value=gid;	
	document.sp.submit();		//goto another(taquin3) php file
}

</script>
<style type="text/css">
a, a:visited, a:active, a:hover {color: black;}
</style>
</head>
<body  style="background-color:#3399ff">
<form name="sp" method="post" action="taquin3.php">
<input type="text" name="filenm" value="file" readonly hidden>
<input type="text" name="siz" value="0" readonly hidden>
<input type="text" name="nick" value="noname" readonly hidden>
<input type="text" name="score" value="0" readonly hidden>
</form>
<script>
go=false;		//do not click the pictures(yet)
for(cv=0;cv<(size*size)-1;cv++)		//3x3 or 4x4 or 5x5
{	
	document.write('<img id="'+cv+'" src="'+gid+'/'+size+gid+cv+'.png" style="position: absolute;" onClick="if(go) slide('+cv+',false);" draggable="false"> ');
	//generate imgs
}
document.write('<img id="'+cv+'" src="'+gid+'/'+size+gid+cv+'.png" style="position: absolute;">');
//and generate last img without onclick
	
document.write('<h1 id="ag" onClick="hidchange(0);window.setTimeout(init,500);" style="position: absolute; left: 20px; top: '+((wid*size)+20)+'px;">Start</h1>');
document.write('<h1 style="position: absolute; left: 300px; top: '+((wid*size)+20)+'px;">Try:<b id="score">0</b></h1>');
document.write('<h1 onClick="spec();" style="position: absolute; left: 20px; top: '+((wid*size)+60)+'px;">Scorelist</h1>');
document.write('<h1><a name="bak" href="taquin.php" style="position: absolute; left: 20px; top: '+((wid*size)+120)+'px;">Back</a></h1>');
document.write('<h1><a name="home" href="/../index.html" style="position: absolute; left: 20px; top: '+((wid*size)+160)+'px;">Homepage</a></h1>');
//and generate start/again, back and home "buttons"

score=0;		//point is zero, cuz didnt start it nothing yet
document.getElementById("score").innerHTML=score;		//score appear in html tag

squares = [];  	//create array
var cv3=0;		//it is the id
for(var cv=0;cv<size;cv++)		//go through row
{
	for(var cv2=0;cv2<size;cv2++)		//and column
	{
		squares[cv3] = new square(cv3,cv2*wid,cv*wid,cv2*wid,cv*wid);		//create object with id x coord and y coord
		squares[cv3].mov(cv2*wid,cv*wid);										//pictures go to the correct place
		cv3++;		//increment the id nums
	}	
}
</script>
</body>
</html>
