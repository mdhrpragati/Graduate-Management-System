<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Admin</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
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
			include('include/nav.php');
			include('include/connect.php');
		?>
		
			
			<div class="row-fluid">
				<div class="span3" id="sidebar">
				
					<div class="container-fluid span14 row-fluid well sidebar-nav">
								<ul class="nav nav-list">
								  <li class="nav-header">Class</li>
									<li><a href="student.php?action=add">Add Student</a></li>
									<li><a href="student.php?action=edit">Edit Student</a></li>							 
								</ul> 
					</div>
				
				
				
				</div>
				<div class="span9">
					<?php
						if(isset($_GET['action']))
						{
							$act=$_GET['action'];
							if($act=='add')
							{
								//Add Course Content
								?>	
								<div class='well container-fluid span7'	>
		
										<form method='POST' action='student.php' enctype='multipart/form-data'>
											<label>First Name: </label><input type="text" palceholder="name" name="student_name"></br>
											<label>Middle Name: </label><input type="text" palceholder="name" name="student_name"></br>
											<label>Last Name </label><input type="text" palceholder="name" name="student_name"></br>
											<label>Nationality: </label><input type="text" palceholder="name" name="student_name"></br>
											<label>Past Documents </label><input type="file" palceholder="name" name="file"></br>
											
										
										</form>
										
								
								
								
								
								
								</div>	
								<?php

							
							}
							else if($act=='edit')
							{
								
							}
							else if($act=='enroll')
							{
								//Enroll student to a particular course
								echo"assign vourse";

							}
							else if($act=='view')
							{
								include('include/lister_class.php');
							}	
						}	
						
					?>
				
				
				</div>
			</div>
			
			
		</div><!--end of row-->
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
<?php
	if(isset($_POST['add']))
	{
		include('include/class.php');
		$class=new classes;
		$class->class_name=$_POST['class_name'];
		$class->batch=$_POST['batch'];
		$class->level=$_POST['level'];
		$class->course_detail=$_POST['course_detail'];
		$q=mysql_query("INSERT INTO `gms`.`class` (`class_name`,`batch`,`level`,`course_detail`) VALUES('$class->class_name','$class->batch','$class->level','$class->course_detail')") or die(mysql_error());
		
		if($q==1)
		{
			echo "Course added";
		}
		else
			echo "ERROR!!!";
	}
?>


