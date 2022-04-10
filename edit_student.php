<?php

	require('session/session.php');
	confirm_logged_in();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Management System</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_student.js"></script>
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
		<script type="text/javascript">
			function confrm()
			{
				var con=confirm("Do you really want to edit/delete this student?");
				return con;
			}
		</script>
	</head>
	
	<body>
		<?php include('include/header.php');
				include ('include/connect.php');
			 	include 'include/nav.php';
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
		<?php if(isset($_POST['update']))
				{
					$reg_no = $_POST['reg_no'];
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
					$password = md5($password);
					$query = mysql_query("UPDATE student SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', nationality='$nationality', dob='$dob', doe='$doe', batch='$batch', permanent_address='$permanent_address', temporary_address='$temporary_address', cell_no='$cell_no', landline='$landline', email_address='$email_address', password='$password' WHERE reg_no='$reg_no'") or die(mysql_error());
					$query1 = "UPDATE user SET password='$password' WHERE username='$reg_no'";
					mysql_query($query1) or die(mysql_error());
					echo "Update Successfull";
				}
				elseif(isset($_POST['delete']))
				{
						echo "You have to deleted this student.";
						$reg_no = $_POST['reg_no'];
						$query = mysql_query("DELETE FROM student WHERE reg_no='$reg_no'");
						$query = mysql_query("DELETE FROM student_grade WHERE reg_no='$reg_no'");
						?>
							<script type='text/javascript'>
									alert('Student has been deleted !!');
								</script>
						<?php
				}
				else
				{
		?>
				<h3>Search for a student by his/her registration number</h3>
					<input type="text" id="student" onkeyup="process()">
					<div id="result"></div>	
		<?php
				}
		?>		
		</div>
			</div>			
		</div><!--end of row-->
		<?php include('include/footer.php'); ?>
	</body>
</html>
