<?php
	include 'connect.php';
	$ip=$_SERVER['REMOTE_ADDR'];
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$city=$details->city; 
	$blockedIp=array("45.49.131.170","75.24.46.99","131.179.32.127");


	if(in_array($ip,$blockedIp))
	{
		exit(0);
	}
	//Check if this user has visited before 
	
	
	$query = "SELECT * FROM $dbusertable WHERE ip='$ip'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) != 0)
	{	
		$message = "A returning user looked at your website! \nLocation: $city\nIP: $ip \nTime: " . date('l jS \of F Y h:i:s A');
		$message = wordwrap($message, 70, "\r\n");
		mail('conor0456@gmail.com', 'Returning visitor', $message, "From: darcyConor <conor@darcyconor.com>\r\n");
	}
	else
	{
		$message = "A new user looked at your website! \nLocation: $city\nIP: $ip \nTime: " . date('l jS \of F Y h:i:s A');
		$message = wordwrap($message, 70, "\r\n");
		mail('conor0456@gmail.com', 'New visitor', $message, "From: darcyConor <conor@darcyconor.com>\r\n");
	}
	mail("5593925105@sms.mycricket.com", " ", $message);
	
	
	
	$query = "Insert into $dbusertable values('" . $ip ."','" . date('l jS \of F Y h:i:s A') ."','".$city."');";
	$result = mysql_query($query);
	
	

	




?>



