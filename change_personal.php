<?php require_once("session/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
     	require_once("include/variables.php");
    	require_once("include/connect.php");
?>
<?php
	if (isset($_POST['submit']))
	{
		$sql = "SELECT * FROM user WHERE username='". logged_in_username() . "' AND password='".md5($_POST['password']) ."' LIMIT 1";
		$user_set = mysql_query($sql) or die("Couldn't connect to database");
		if (mysql_num_rows($user_set) == 0) {
			$message = "Your password is incorrect. Please make sure that the Caps Lock is off and retry.";
		}
		else
		{
			$sql = "UPDATE user_detail SET ";
			//$sql .= "user_name='" . $_POST['username'] ."', ";
			$sql .= "first_name='" . $_POST['first_name'] . "', ";
			$sql .= "middle_name='" . $_POST['middle_name'] . "', ";
			$sql .= "last_name='" . $_POST['last_name'] . "', ";
			$sql .= "email_id='" . $_POST['email_id'] . "', ";
			$sql .= "address='" . $_POST['address'] . "' ";
			$sql .= "WHERE user_id = '" . $_SESSION['user_id'] . "' ";
			$sql_set = mysql_query($sql) or die("Couldn't connect to database");
			$message = "Record successfullly updated";
		}
	}
	$sql = "SELECT * FROM user_detail WHERE user_name='".logged_in_username()."'";
	$sql_set = mysql_query($sql) or die("oops");
	$teacher_record = mysql_fetch_assoc($sql_set);
	extract($teacher_record);
?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Change Password</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap-dropdown.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
			include ("include/header.php");
			include ("include/nav.php");
			navbar("settings");
		?>
		<div class="row-fluid">
			<div class="span2"></div>
			<div class="span9">
				<div class="container">
		         <form class="form-horizontal" action="change_personal.php" method="post">
						<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
						<fieldset>
							<legend>Change Your Personal Message</legend>
							<div class="control-group">
								<label class="control-label">Username:</label>
								<div class="controls">
									<input type="text" disabled
									<?php
										if (isset($user_name)) {
											echo "value=\"".$user_name."\"";
										}
									?>
									placeholder="New Username" name="username" required/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">First Name:</label>
								<div class="controls">
									<input type="text" 
									<?php
										if (isset($first_name)) {
											echo "value=\"".$first_name."\"";
										}
									?>
									 placeholder="Your First Name" name="first_name" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Middle Name:</label>
								<div class="controls">
									<input type="text" 
									<?php
										if (isset($middle_name)) {
											echo "value=\"".$middle_name."\"";
										}
									?>
									  placeholder="Your Middle Name" name="middle_name" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Last Name:</label>
								<div class="controls">
									<input type="text" 
									<?php
										if (isset($last_name)) {
											echo "value=\"".$last_name."\"";
										}
									?>
									  placeholder="Your Last Name" name="last_name" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email-Id:</label>
								<div class="controls">
									<input type="text" 
									<?php
										if (isset($email_id)) {
											echo " value=\"".$email_id."\" ";
										}
									?>
									  placeholder="example@example.com" name="email_id" pattern="^.+@[^\.].*\.[a-z]{3}" required/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Address:</label>
								<div class="controls">
									<input type="text"  
									<?php
										if (isset($address)) {
											echo "value=\"".$address."\"";
										}
									?>
									  placeholder="Your Address" name="address" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Password:</label>
								<div class="controls">
									<input type="password" placeholder="Your Password" name="password" required/><span class="inline-help">For security reasons</span>
								</div>
							</div>
							<div class="form-actions">
									<button class="btn btn-primary" type="submit" name="submit" value="Save">Save</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<div class="span1"></div>
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
