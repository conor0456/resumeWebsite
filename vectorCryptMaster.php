<?php
require "vectorCrypt.php";





$password=encrypt($_REQUEST["pswd"]);
$username=$_REQUEST["username"];


store($username,$password);
echo $password;
return $password;


function store($user,$passwd)
{	
	$dbhostname = "vectorCryptUser.db.10258168.hostedresource.com";
	$dbusername = "vectorCryptUser";
	$dbname = "vectorCryptUser";
	$dbpassword = "Conor6540!";
	$dbusertable = "vectorCryptUsers";
	mysql_connect($dbhostname, $dbusername, $dbpassword) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);
	$query = "SELECT password FROM $dbusertable WHERE username='$username'";
	$result = mysql_query($query);
	if(is_null($result))
	{
		$query = "INSERT INTO $dbusertable VALUES('$user','$passwd');";
		$result = mysql_query($query);
	}
	else
	{
		if(dbCheckEncrypt($_REQUEST["pswd"])==TRUE)
		{
			$myfile = fopen("Success.txt", "w") or die("Unable to open file!");
			$txt = "John Doe\n";
			fwrite($myfile, $txt);
			$txt = "Jane Doe\n";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	}
};
function dbCheckEncrypt($ptext)
{
	$dbhostname = "vectorCryptUser.db.10258168.hostedresource.com";
	$dbusername = "vectorCryptUser";
	$dbname = "vectorCryptUser";
	$dbpassword = "Conor6540!";
	$dbusertable = "vectorCryptUsers";
	mysql_connect($dbhostname, $dbusername, $dbpassword) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);
	$query = "SELECT password FROM $dbusertable WHERE username='$username'";
	$result = substr(mysql_query($query),3);
	$vect = explode(" $ ", $result);
//Store the randomly generated point that was used 	
	$lengthOfPoint=count($vect)/3;
	$i=0;
	for($n=$lengthOfPoint-1;$n<count($vect);$n++)
	{
		$point[$i]=$vect[$n];
		$i++;
	}
//follow the same encryption procedure as encrypt function
	write_matrix($matrix,$ptext);
	make_independent($matrix);
	add_point($matrix,$point);
	rref($matrix);
	grab_encrypted($matrix, $newctext);
//Check if the result is the same as the original 
	$flag=0;
	for($row=0;$row<count($matrix);$row++)
	{
		for($column=0;$column<=1;$column++)
		{
			if($ctext[$row][$column]!=$newctext[$row][$column])
			{
				$flag=1;
				break 2;
			}
		}
	}
	$ptext=0;
	if($flag==0)
	{return true;}
	else
	{return false;}
};


?>