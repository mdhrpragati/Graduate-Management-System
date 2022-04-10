<?php

	require('session/session.php');
	confirm_logged_in();
?>


<?php ob_start();  //turns output buffering on ?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Graduate Management System</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="add_student.js"></script>
		<script type="text/javascript">
			function confrm()
			{
				var con=confirm("Do you really want to add this student?");
				return con;
			}
		</script>
		<style type="text/css">
			#sidebar {
				border-right: 3px solid rgb(238,238,238);
				height: 250px;
			}
			.hero-unit
			{
				margin-bottom:0;
			}
		</style>
	</head>
	
	<body>
		<?php 
				include('include/header.php');
				include ('include/connect.php');
		 		include ('include/nav.php'); 
				navbar('student');
		 ?>
		<div class="row-fluid">
		<div class="span3" id="sidebar">
				<div class="container-fluid">
						  <div class="row-fluid">
							<div class="span14">
							  <div class="well sidebar-nav">
								<ul class="nav nav-list">
								  <li class="nav-header">Student</li>
								  <li><a href="add_student.php">Add Student</a></li>
								  <li><a href="edit_student.php">Edit/Delete Student</a></li>	
								</ul>
							  </div><!--/.well -->
							</div><!--/span-->
						  </div>
					</div>	
		</div>


		<div class="span9"> <!--Main content-->
		<?php if(isset($_POST['submit']))
				{
						//now add student
						$reg_no_first = $_POST['reg_no_first'];
						$reg_no_second = $_POST['reg_no_second'];
						$reg_no = $reg_no_first.'-'. $reg_no_second;
						$first_name = $_POST['first_name'];
						$middle_name = $_POST['middle_name'];
						$last_name = $_POST['last_name'];
						$nationality = $_POST['nationality'];
						$dob = $_POST['dob'];
						$doe = $_POST['doe'];
						$batch = $_POST['batch'];
						$permanent_address = $_POST['permanent_address'];
						$temporary_address = $_POST['temporary_address'];
						$cell_no = $_POST['cell_no'];
						$landline = $_POST['landline'];
						$email_address = $_POST['email_address'];
						$password = $_POST['password'];
						$password =md5($password);
						$query = "INSERT INTO student (reg_no,first_name, middle_name, last_name, nationality, dob, doe, batch, permanent_address, temporary_address, cell_no, landline, email_address,password) VALUES ('$reg_no','$first_name','$middle_name','$last_name','$nationality','$dob','$doe','$batch','$permanent_address','$temporary_address','$cell_no','$landline','$email_address','$password')"; 
						$query1 = "INSERT INTO user (username,password) VALUES ('$reg_no','$password')";
						mysql_query($query) or die(mysql_error());
						mysql_query($query1) or die(mysql_error());
						echo "The student has been added to the database succesfully.";
				}
				else
				{
		?>
					<h2>Add Student Form</h2>
					<form class="form-horizontal" method="POST" action="add_student.php" onsubmit="return process()">
					<fieldset>
					<!--Registration number-->
					  <div class="control-group">
						<label class="control-label" for="reg_no">Registration Number:</label>
						<div class="controls">
						  <input type="text" class="input-small" id="reg_no_first" name="reg_no_first" required> - 
						  <input type="text" id="reg_no_second" class="input-mini" name="reg_no_second" required>
						</div>
					  </div>
					  
					  <!--First Name-->
						  <div class="control-group">
						<label class="control-label" for="first_name">First Name*:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="first_name" name="first_name" required>
						</div>
					  </div
					  

					  <!--Middle Name-->
						  <div class="control-group">
						<label class="control-label" for="middle_name">Middle Name:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="middle_name" name="middle_name">
						</div>
					  </div>
					  
					  
					  <!----Last name-->
						  <div class="control-group">
						<label class="control-label" for="last_name">Last Name*:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="last_name" name="last_name" required>
						</div>
					  </div>
					  
					  
					  <!--Nationality-->
								 <div class="control-group">
						<label class="control-label" for="select01">Nationality*:</label>
						<div class="controls">
						  <input type="text" name="nationality" id="nationality" required>
						</div>
					  </div>
    
					  
					  <!--Date of birth-->
							   <div class="control-group">
						<label class="control-label" for="select01">Date of Birth: </label>
						<div class="controls">
						<input type="date" name="dob">
						</div>
					  </div>
					  
					  
					  <!--Date of enroll-->
							   <div class="control-group">
						<label class="control-label" for="select01">Date of Enroll: </label>
						<div class="controls">
							<input type="date" name="doe">
						</div>
					  </div>
					  
					  
					  <!--Batch-->
					  <div class="control-group">
						<label class="control-label" for="last_name">Batch*:  </label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="batch" name="batch" required>
						</div>
					  </div>
					  
					  
					  <!--Permanent address-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Permanent address:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="permanent_address" name="permanent_address" >
						</div>
					  </div>
					  
					  
						  <!--Temporary address-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Temporary address:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="temporary_address" name="temporary_address">
						</div>
					  </div>
					  					 
						 <!--Email Address-->
						  <div class="control-group">
						<label class="control-label" for="email_address">Email Address*:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="email_address" name="email_address" required>
						</div>
					  </div>
					  
						  <!--Cell. no.-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Mobile Number: </label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="cell_no" name="cell_no">
						</div>
					  </div>
					  
						  <!--Landline Number-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Landline Number:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="landline" name="landline">
						</div>
					  </div>
					  
					 <!--Password-->
						  <div class="control-group">
						<label class="control-label" for="password">Password*:</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="password" name="password" required>
						</div>
					  </div
					  
					  <!--form actions-->
					  <div class="form-actions" id="form_action">
						<button type="submit" class="btn btn-primary" name="submit">Add Student !!!</button>
					  </div>
					  
					</fieldset>
				  </form>
				<?php } ?>
		</div>
			</div>			
		</div><!--end of row-->
	</body>
</html>
<?php ob_end_flush(); ?>
