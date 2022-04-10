<?php require_once("session/session.php"); ?>

<?php confirm_logged_in(); ?>

<?php
     require("include/variables.php");
    include('include/connect.php');
?>

<?php
	
	if (isset($_POST['submit']))
	{ // Form has been submitted.
		
		
		$username1 = $_POST['password'];
		$password1 = $_POST['repassword'];
		   
                    
		$password1=md5($password1);
                        $SQL="INSERT INTO `gms`.`user` (username,password) VALUES('$username1','$password1')";
                        $update=mysql_query($SQL) or die(mysql_error());
                        if(!$update)
                        {
                            die();
                        }
                        else
                        {
							$message = "SUCCESFULLY CHANGED";
							echo $message;
						}
                    
                   
		    
		
	}
?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: CHANGE PASSWORD</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			.form-horizontal{
				position: relative;
				left: 20%;
				width: 450px;
				border: 1px rgb(200, 200, 200) solid;
				border-radius: 3%/10px;
				padding: 10px;
				background-color: white;
				box-shadow: 10px 10px 20px 0px gray;
			}
			body {
				background-color: lightgray;
			}
		</style>
	</head>
	<body>
		<?php
			include ('include/header.php');
			include ("include/nav.php");
			navbar("settings");
		?>
		<div class="container">
			<a href="admin.php">Back</a>
                        <form class="form-horizontal" action="new_user.php" method="post">
						<input type='text' name="password">
						<input type='password' name="repassword">
						<input type='submit' name="submit" value='Sign up'>
						
						
				
					<!--	<fieldset>
							<legend>CHANGE YOUR PASSWORD</legend>
							<div class="control-group">
								<label class="control-label">Username:</label>
								<div class="controls">
									<input type="text" placeholder="Password" name="password" id="password" required/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">PASSWORD:</label>
								<div class="controls">
									<input type="password" placeholder="Password" name="repassword" id="repassword" required/>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input class="btn btn-primary" type="submit" name="submit"  value"login" />
								</div>
							</div>
						</fieldset>  -->
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