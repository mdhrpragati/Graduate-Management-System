<?php require_once ("session/session.php");?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Management System</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_course.js"></script>
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
		<?php include('include/header.php');
				//include('class.student.php');
				include ('include/connect.php');
		?>
		<div class="row-fluid">
			
		<?php include ('include/nav.php'); ?>
		<?php navbar("course"); ?>
			<div class="row-fluid">
				<div class="span2" id="sidebar">SIDEBAR</div>
				<div class="span10"> <!--Main content-->
				<?php
					if(isset($_POST['update']))
					{
						//update the onfo and show the message
						$course_code = $_POST['course_code'];
						$course_name = $_POST['course_name'];
						$credit = $_POST['credit'];
						$description = $_POST['description'];
						
						//now add to database
						$query = mysql_query("UPDATE courses SET course_name='$course_name', credit='$credit', description='$description' WHERE course_code='$course_code'") or die(mysql_error());
						if($query)
						{
							echo "Update Succcessfull !!!!";
						}
					}
					else
					{
					?>						
						Search the course according to the course code
							<form>
								<input type="text" name="course" id="course" onkeyup="process()">
							</form>
						<div id="result"></div>
					<?php } ?>
				</div>
			</div>			
		</div><!--end of row-->
	</body>
</html>
