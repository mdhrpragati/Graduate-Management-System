<?php
	require_once("variables.php");
	$connection=mysql_connect(SERVER,USERNAME,PASSWORD);
	if(!$connection)
	{
		die('Cannot Connect: '.(mysql_error()));
	}
	else
	{
		mysql_select_db(DBNAME,$connection);
	}
?>