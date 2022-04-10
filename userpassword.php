<?php require_once("session/session.php"); ?>

<?php confirm_usr_login(); ?>

<?php
     	require_once("include/variables.php");
    	require_once("include/connect.php");
?>

<?php
	
	if (isset($_POST['submit']))
	{ // Form has been submitted.

		//getting user's old password
		$username = logged_in_username();
		$sql = "SELECT password FROM user WHERE username='" .$username . "'";
		$pass_query = mysql_query($sql);
		if (!$pass_query) {
			die();
		}
		$record = mysql_fetch_assoc($pass_query);
		$old_hash = $record['password'];

		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$re_new_password = $_POST['re_new_password'];
		if ($old_hash == md5($old_password))
		{
		  	if($new_password == $re_new_password)
		  	{
		      $SQL="UPDATE user SET password='". md5($new_password) . "' WHERE id=". $_SESSION['user_id'];
		      $update=mysql_query($SQL);
		      if(!$update)
		      {
		         die();
		      }
		      else
		      {
		       	$message = "<span class=\"label label-success\">Succesfully Changed</span>";
		      }
		  	}          
		   else
		   {
			
				$message = "<span class=\"label label-warning\">Password Do Not Match. Please Enter The Correct Combination.</span>";
			}
		}
		else
		{
			$message = "<span class=\"label label-warning\">Your old password does not match!</span>";
		}
	}
?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Change Password</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap-dropdown.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/form.css">
	</head>
	<body>
		<?php
			include ("include/header.php");
			include ("include/user_nav.php");
			navbar("settings");
		?>
		<div class="container">
         <form class="form-horizontal" action="userpassword.php" method="post">
				<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
				<fieldset>
					<legend>Change Your Password</legend>
					<div class="control-group">
						<label class="control-label">Old Password:</label>
						<div class="controls">
							<input type="password" placeholder="Your Old Password" name="old_password" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">New Password:</label>
						<div class="controls">
							<input type="password" placeholder="Your New Password" name="new_password" required/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Retype New Password:</label>
						<div class="controls">
							<input type="password" placeholder="Retype The Above Password" name="re_new_password" required/>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button class="btn btn-primary" type="submit" name="submit" value="Change Password">Change Password</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</body>
</html>

<?php
    //Close connection
	if(isset($connection))
	{
		mysql_close($connection);
	}
?>
