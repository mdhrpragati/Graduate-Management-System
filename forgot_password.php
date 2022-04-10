<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Login</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css"> -->
		<link rel="stylesheet" type="text/css" href="css/form.css">
	</head>
	<?php
		if (isset($_POST['submit'])) {
			include ("include/connect.php");
			$sql = "SELECT user_name, email_id FROM user_detail WHERE user_name = '" . $_POST['username'] . "' LIMIT 1";
			$sql_set = mysql_query($sql);
			if (!$sql_set)
			{
				die("Could not connect to the database");
			}
			if (mysql_num_rows($sql_set) != 0)
			{
				$result = mysql_fetch_assoc($sql_set);
				$new_password = mt_rand(10000000,99999999);
				$new_password = crypt($new_password, "arandomstring");
				$new_hashed_password = md5($new_password);
				//echo $new_password . "<br />";
				//echo $new_hashed_password . "<br />";
				if (!is_null($result['email_id']))
				{
					mail($result['email_id'], "Hello There!", $new_password);
					$sql2 = "UPDATE user SET password='".$new_hashed_password . "' WHERE username='".$result['user_name']. "'";
					mysql_query($sql2) or die();
				}
				else
				{
					$error = 1;
				}
			}
		}
	?>
	<body>
		<?php
			include ("include/header.php");
		?>
		<div class="container">
			<form class="form-horizontal" method="post" action="forgot_password.php">
				<fieldset>
					<legend>Please Enter Your Username</legend>
					<div class="control-group">
						<label><span class="control-label">Username: </span>
						<div class="controls">
							<input type="text" placeholder="Enter your username" name="username" id="username" required/>
						</div></label>
					</div>
					<div class="form-actions">
						<button class="btn btn-primary" type="submit" name="submit"  value="Submit">Submit</button>
						<a class="btn pull-right" href="index.php" class="">Cancel</a>
					</div>
					<?php
						if (isset($sql_set) && mysql_num_rows($sql_set) == 0)
						{
							echo "<span class=\"label label-warning\">Your Username was not found in the database</span>";
						}
						elseif (isset($error)) {
							echo "<span class=\"label label-warning\">Your email-id was not found in the database. Sorry</span>" ;
						}
					?>
				</fieldset>
			</form>
		</div>
	</body>
</html>
