<?php
	session_start();
	
	function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
                session_write_close();
		header("location: index.php");
	}
	
	function logged_in()
	{
		return isset($_SESSION['user_id']);
	}
	
	function logged_in_username()
	{
		return $_SESSION['username'];
	}
	
	function confirm_logged_in()
	{
		if(!logged_in())
		{
			header("location: index.php");
		}
		else
		{
			if (logged_in_username() == 'user') {
				header("Location: report.php");
			}
		}
	}
	function confirm_usr_login()
	{
		if (!logged_in()) {
			header("location: index.php");
		}
	}
?>
