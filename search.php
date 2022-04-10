<?php

	require('session/session.php');
	confirm_logged_in();
	include('function/functions.php');	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Management System</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
	</head>
	
	<body>
		<?php 
				include 'include/header.php';
				include 'include/connect.php';
		 		include 'include/nav.php';
				navbar('search');
		 ?>
		<div class="row-fluid">
		<div class="span3" id="sidebar">
				<div class="container-fluid">
						  <div class="row-fluid">
							<div class="span14">
							  <div class="well sidebar-nav">
								<ul class="nav nav-list">
								  <li class="nav-header">Search</li>
								  <li><a href="add_student.php">Go To Home Page</a></li>
								</ul>
							  </div><!--/.well -->
							</div><!--/span-->
						  </div>
					</div>	
		</div>

		<div class="span9"> <!--Main content-->
			<form class="well form-search" action="search.php">
										<input type="text" class="span2" name="query" placeholder="Search">
										<select name="type">
											<option value="class">Class</option>
											<option value="courses">Course</option>
											<option value="student">Student</option>
											<option value="teacher_detail">Teacher</option>
										</select>
										<button name='submit' type="submit" class="btn">Search</button>
									</form>
									
			<?php
			if(isset($_GET['submit']))
			{
			
				$query = $_GET['query'];
				$type= $_GET['type'];

				if($type=="class") //for table class
				{
					$field = 'class_id';
					$query=mysql_query("SELECT DISTINCT $field FROM $type WHERE $field='$query'") or mysql_error();
					$rows = mysql_num_rows($query);

					if(!$rows)
					{
						echo "Not found";
					}
					else
					{
						while($result=mysql_fetch_array($query))
						{
							extract($result);
			?>
					<table class="table table-hover">
			            <thead>
			                <tr>
			                  <th>Class Id</th>
			                </tr>
			            </thead>
			              
			            <tbody>
			                <tr> 
								<td><?php echo "<a href='class1.php?course_action=$class_id'>".convert($class_id)."</a>"; ?>
							</tr>		
			            </tbody>
					</table>
			<?php
						}
					}
				}

				elseif($type=='courses')
				{
					$field = 'course_code';
					$query=mysql_query("SELECT DISTINCT $field FROM $type WHERE $field='$query'") or mysql_error();
					$rows = mysql_num_rows($query);

					if(!$rows)
					{
						echo "Not found";
					}
					else
					{
						while($result=mysql_fetch_array($query))
						{
							extract($result);
			?>
					<table class="table table-hover">
			            <thead>
			                <tr>
			                  <th>Course Code</th>
			                </tr>
			            </thead>
			              
			            <tbody>
			                <tr> 
								<td><a href='<?php echo "course.php?course_action=".$course_code."'"; 
								?></a><?php echo $course_code;?></td>
							</tr>		
			            </tbody>
					</table>
			<?php
						}
					}
				}


				elseif($type=='student') //for student
				{
					$field = 'reg_no';
					$query=mysql_query("SELECT * FROM $type WHERE $field='$query'") or mysql_error();
					$rows = mysql_num_rows($query);

					if(!$rows)
					{
						echo "Not found";
					}
					else
					{
						while($result=mysql_fetch_array($query))
						{
							extract($result);
			?>
					<table class="table table-hover">
			            <thead>
			                <tr>
			                  <th>Registration Number</th>
			                  <th>First Name</th>
			                  <th>Middle Name</th>
			                  <th>Last Name</th>

			                </tr>
			            </thead>
			              
			            <tbody>
			                <tr> 
								<td><?php echo $reg_no; ?></td>
								<td><?php echo $first_name; ?></td>
								<td><?php echo $middle_name; ?></td>
								<td><?php echo $last_name; ?></td>
							</tr>		
			            </tbody>
					</table>
			<?php
						}
					}
				}
				
				elseif($type=='teacher_detail') //for student
				{
					$field = 'email_id';
					$query=mysql_query("SELECT * FROM $type WHERE $field='$query'") or mysql_error();
					$rows = mysql_num_rows($query);

					if(!$rows)
					{
						echo "Not found";
					}
					else
					{
						while($result=mysql_fetch_array($query))
						{
							extract($result);
			?>
					<table class="table table-hover">
			            <thead>
			                <tr>
			                  <th>E-Mail Id</th>
			                  <th>First Name</th>
			                  <th>Last Name</th>
			                  <th>Department</th>
			                  <th>Designation</th>
			                </tr>
			            </thead>
			              
			            <tbody>
			                <tr> 
								<td><?php echo $email_id; ?></td>
								<td><?php echo $first_name; ?></td>
								<td><?php echo $last_name; ?></td>
								<td><?php echo $department; ?></td>
								<td><?php echo $designation; ?></td>
							</tr>		
			            </tbody>
					</table>
			<?php
						}
					}
				}

		}

			?>
		</div>
			</div>			
		</div><!--end of row-->
	</body>
</html>
