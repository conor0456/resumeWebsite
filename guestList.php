<?php
	$dbhostname = "vectorCryptUser.db.10258168.hostedresource.com";
	$dbusername = "vectorCryptUser";
	$dbname = "vectorCryptUser";
	$dbpassword = "Conor6540!";
	$dbusertable = "websiteVisitors";
	mysql_connect($dbhostname, $dbusername, $dbpassword) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);
	$query = "SELECT * FROM $dbusertable;";
	$result = mysql_query($query);
	echo '<style>th {
    text-align: left;
}</style><table style="width:100%"><tr>
	    <th>Location</th>
	    <th>IP</th> 
	    <th>Time</th>
	  </tr>';

	while ($row = mysql_fetch_assoc($result)) 
	{
    	echo "<tr> <td>" . $row['location'] . "</td><td>" . $row['ip'] . "</td><td>" . $row['time'];
	}
	echo '</table>';
?>



