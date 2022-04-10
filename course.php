<?php require_once ("session/session.php");?>
<?php ob_start(); ?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Admin</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap-alert.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="include/validate.js"></script>
		<script type="text/javascript" src="include/assign_instructor.js"></script>
		<script>	
			function confrm()
			{
				var con=confirm("Do you really want to add this course?");
				return con;
			}
			function confrm_del()
			{
				var con=confirm("Do you really want to delete this course?");
				return con;
			}
			function confrm_ch()
			{
				var con=confirm("Do you really want to update this course?");
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
			include('include/nav.php');
			navbar("course");
			include('include/connect.php');
			include('function/functions.php');
			
		?>
		<div class="row-fluid">
			<div class="span3" id="sidebar">
				<div class="container-fluid">
				  	<div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
							<ul class="nav nav-list">
								<?php $active=" class=\"active\" "; ?>
							 	<li class="nav-header">Courses</li>
							  	<li <?php if (isset($_GET['action']) and $_GET['action'] == "add") {
							  		echo $active;
							  	}?> ><a href="course.php?action=add">Add Course</a></li>
							  	<li <?php if ((isset($_GET['action']) and $_GET['action'] == "edit_course") || (isset($_GET['course_action']))) {
							  		echo $active;
							  	}?> ><a href="course.php?action=edit_course">Edit Course</a></li>	
							  	<li <?php if ((isset($_GET['action']) and $_GET['action'] == "delete_course")) {
							  		echo $active;
							  	}?> ><a href="course.php?action=delete_course">Delete Courses</a></li>	
							</ul>
						  </div><!--/.well -->
						</div><!--/span-->
				  	</div>
				</div>		
			</div>
			<!-- end of sidebar -->
			<div class="span9">
				<script type="text/javascript" src="js/bootstrap.js"></script>
				<?php
					if(isset($_GET['action']))
					{
						$act=$_GET['action'];
						if($act=='add')
						{
							//Add Course Content
							if (isset($_GET['add_success']) and $_GET['add_success'] == 0) {
								echo "<div class=\"alert fade in\">
											<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
											<strong>Course Added!</strong> You have sucessfully added the course.
										</div>";
							}
							?>
							<div class='well container-fluid span7'	>
		
								<form class="form-signin" action="course.php" onsubmit='return confrm()' name="add_sub" method="post">
									<h2 class="form-signin-heading">Add new course</h2>
									<p>Please enter the following details to add the course. </p><br>	
									
									<input type="text" class="input-block-level-large" placeholder="Course Name" name="course_name" required><br>
									<input type="text" class="input-block-level-large" placeholder="Course Code" name="course_code" pattern="^[a-zA-z]{4}\s[0-9]{3}" title="E.g. comp 201(space necessary)" required><br>
									<select name="credit" id="credit">
										
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>6</option>
										<option>15</option>
										</select></br>
									<!--<input type="text" class="input-block-level-large" placeholder="Course Description" name="course_description">-->		
									<textarea type="text" class="input-block-level-level" placeholder="Course Description" name="course_description"></textarea>
									
									<br><br>
									<button class="btn btn-large btn-primary" name="add" type="submit">Add</button>
								</form>	
							</div>	
							<?php
						}
						else if($act=='edit_course')
						{
							//Enroll class to the student
							?>
							<h1>Edit Course</h1>
							</br>
							<p>Please click on the respective course code to edit the course.</p>
							</br>
							<?php
							include('include/lister.php');
						}
						else if($act=='assign_course')
						{
							//Enroll student to a particular course
							//echo"assign course";

							include('include/enroll_course_class.php');
						}
						else if($act=='assign_instructor')
						{
							if(isset($_POST['change']))
							{
								$class_id=$_POST['class_id'];
								$course_code=$_POST['course_code'];
								$new_teacher=$_POST['teacher'];
								echo $class_id;
								echo $course_code;
								echo $new_teacher;
											
								$sql="UPDATE `gms`.`class` 
								SET instructor='$new_teacher' 
								WHERE (course_code='$course_code' && class_id='$class_id')";
								mysql_query($sql) or die(mysql_error());
							
							
							}
							
							else
							{
							
								echo "<select name='category' id='class_id' onchange='process1();'>";
	
								$b=mysql_query("SELECT * FROM class ORDER BY class_id ASC") or die(mysql_error());
								$counter=mysql_num_rows($b);
								$bb=0;
								echo "<OPTION> Select the batch </OPTION>";
								while($counter!=0)
								{
									$tadaa=mysql_fetch_array($b);
									$aa=$tadaa['class_id'];
									if($aa!=$bb)
									{
										echo"<OPTION value=".$tadaa['class_id'].">".convert($tadaa['class_id']);
										$bb=$aa;
									}
									$counter=$counter-1;
								}					
								echo "</select>";	
								echo "<div id='student_list'></div>";
							}		
							
							//include("include/lister_instructor.php");	
						}
						else if($act=='view')
						{
							if (isset($_GET['add_success'])) {
							 	if ($_GET['add_success'] == 1) {
									echo "<div class=\"alert\">
         								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         								<strong>Course Added!</strong> You have sucessfully added the course.
   									</div>";
								}
   							else {
   								echo "<div class=\"alert\">
												<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         									<strong>Error!</strong> The course could not be added.
   										</div>";
   							}
							}
							elseif (isset($_GET['update_success'])) {
								if ($_GET['update_success'] == 1) {
									echo "<div class=\"alert\">
         								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         								<strong>Course Updated!</strong> You have sucessfully updated the course.
   										</div>";
   							}
   							else {
   								echo "<div class=\"alert\">
         								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         								<strong>Error!</strong> The course could not be updated.
   										</div>";
   							}
							}
							elseif (isset($_GET['delete_success'])) {
								if ($_GET['delete_success'] == 1) {
									echo "<div class=\"alert\">
         								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         								<strong>Course successfully deleted!</strong>
   									</div>";
   							}
   							else {
   								echo "<div class=\"alert\">
         								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
         								<strong>Course Updated Failed!</strong> The course has not been updated.
   									</div>";
   							}
							}
							?>

							<h1>Course Available</h1>
							<p>These are the courses available:</p>
							<?php
							include('include/lister.php');
						}
						else if($act=='delete_course')
						{
							?>	
							<h1>Delete Course</h1>
							Please check the course you want to delete and press delete button:
							<?php
							include('include/lister_delete.php');
						}							
					}
					else if(isset($_GET['course_action']))
					{
						$course=$_GET['course_action'];
						$sql="SELECT * FROM courses WHERE course_code='$course'";
						$q=mysql_query($sql) or die(mysql_error());
						$data=mysql_fetch_array($q);
						echo "<h1>".$data['course_name']."</h1>";
						echo "<h2>".$data['course_code']."</h2>";
						echo "<h3>".$data['credit']."</h3>";
						echo "<p>".$data['description']."</p>";
						$query=mysql_query($sql);
						$rows = mysql_num_rows($query);
						if(!$rows)
						{
							echo "Course not found";
						}
						else
						{
								while($result=mysql_fetch_array($query))
								{
									extract($result);
									//now display the information from the db
						?>
								<form class="form-horizontal" onsubmit='return confrm_ch()' action="course.php" method="post">
									<div class="control-group">
										<div class="control-label">Course Code:</div>
										<div class="controls">
											<input type="text" name="course_code" id="course_code" value="<?php echo $course_code ?>" readonly>
										</div>
									</div>
									<div class="control-group">
										<div class="control-label">Course Name:</div>
										<div class="controls">
											<input type="text" name="course_name" id="course_name" value="<?php echo $course_name ?>">
										</div>
									</div>
									<div class="control-group">
										<div class="control-label">Credit:</div>
										<div class="controls">
											<select name= "credit" id="credit">
											<OPTION value='0' selected="selected">Select the Credit</OPTION>
											<OPTION value='1'>1</OPTION>
											<OPTION value='2'>2</OPTION>
											<OPTION value='3'>3</OPTION>
											<OPTION value='6'>6</OPTION>
											<OPTION value='15'>15</OPTION>
											</select>										 </div>
										</div>
									<div class="control-group">
										<div class="control-label">Description:</div>
										<div class="controls">
											<input type="text" name="description" id="description"value="<?php echo $description ?>">
										</div>
									</div>
									<div class="form-actions">
									<button class="btn btn-warning" type="submit" value="Update Information" name="update">Update Information</button>
									</div>
								</form>
						<?php
								}
						}			
					}
					else if(isset($_POST['delete']))
					{
						$q=0;
						if(isset($_POST['set_code']))
						{
							foreach($_POST['set_code'] as $course_code ) 
							{
								
								$sqla = "DELETE FROM courses WHERE course_code = '$course_code'";
								$q=mysql_query($sqla) or die(mysql_error());				
								$sqla = "DELETE FROM class WHERE course_code = '$course_code' ;\n";
								$q=mysql_query($sqla) or die(mysql_error());				
								$sqla = "DELETE FROM student_grade WHERE course_code = '$course_code' ;";
								$q=mysql_query($sqla) or die(mysql_error());				
							}						
						}
						$delete_success = ($q) ? 1 : 0;
						header("Location: course.php?action=view&delete_success=".$delete_success);
					}
				?>
			</div>
			
		</div><!-- end of row -->
		<?php
				include('include/footer.php');
			?>
	</body>
</html>
<?php
	include('include/class.php');
	$course=new course;
	if(isset($_POST['add']))
	{
		$course->course_code=strtoupper($_POST['course_code']);
		$course->course_name=ucwords($_POST['course_name']);
		$course->credit=$_POST['credit'];
		$course->description=$_POST['course_description'];
		$sql="INSERT INTO `gms`.`courses` (`course_code`,`course_name`,`credit`,`description`) VALUES('$course->course_code','$course->course_name','$course->credit','$course->description')";
		$q=mysql_query($sql) or die(mysql_error());
		if($q==1)
		{
			header("Location: course.php?action=view&add_success=1");
			exit();
		?>
		
		
		
		
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
			
		<?php	
		}
		
		else
		{
			header("Location: course.php?action=add&add_success=0");
		}
	}
	else if(isset($_POST['update']))
	{
		//update the info and show the message
		$course_code = $_POST['course_code'];
		$course_name = $_POST['course_name'];
		$credit = $_POST['credit'];
		$description = $_POST['description'];
			
		//now add to database
		$query = mysql_query("UPDATE courses SET course_name='$course_name', credit='$credit', description='$description' WHERE course_code='$course_code'") or die(mysql_error());
		if($query)
		{
			header("Location: course.php?action=view&update_success=1");
		}
		else
		{
			header("Location: course.php?action=view&update_success=0");
		}
	}
	ob_end_flush();
?>
