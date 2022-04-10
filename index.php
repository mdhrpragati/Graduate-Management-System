<?php require_once("session/session.php"); ?>

<?php 
	if(isset($_GET["action"]) and $_GET["action"]=="logout")
  	{
  		logout();
  	}
  	if (logged_in()) {
  		if (logged_in_username() == "admin"){
      		header("location: course.php?action=view");
      	}
	}
?>      

<?php
	
    require("include/variables.php");
    include('include/connect.php');
?>

<?php
	include_once("function/functions.php");
	
	if (isset($_POST['submit']))
	{ 
		
		$username =$_POST['username'];
		$password = $_POST['password'];
		$password=md5($password);
		
	    $query = "SELECT id, username ";
	    $query .= "FROM user ";
	    $query .= "WHERE username = '{$username}' ";
	    $query .= "AND password ='{$password}' ";
	    $result_set = mysql_query($query);
	    confirm_query($result_set);
	    if (mysql_affected_rows()==1)
	    {
			$found_user = mysql_fetch_array($result_set);
			$_SESSION['user_id']=$found_user['id'];
            $_SESSION['username']=$found_user['username'];
            session_write_close();
			if(strtolower($username)=="admin" )
			{
				header("location: course.php?action=view");
			}
		}
	    else
	    {
		//username and password combination not found in database
		$message = "Username and password combination incorrect.<br />";
		$message .= "Please make sure your caps lock is turned off and try again.";
	    }
	}
?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/form.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
			include ('include/header.php');
		?>
		<div class="container">
			<form class="form-horizontal" action="index.php" method="post">
				<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
				<fieldset>
					<legend>Please sign in</legend>
					<div class="control-group">
						<label class="control-label">Username:</label>
						<div class="controls">
							<input type="text" placeholder="Enter your username" name="username" id="username" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Password:</label>
						<div class="controls">
							<input type="password" placeholder="Enter your password" name="password" id="password" required/>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input class="btn btn-primary" type="submit" name="submit"  value="Login" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<?php include('include/footer.php'); ?>
	</body>
</html>

<?php
    //Close connection
	if(isset($connection))
	{
		mysql_close($connection);
	}
?>


