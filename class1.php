<?php require_once ("session/session.php");?>
<?php require_once ("function/functions.php");?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Admin</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_class.js"></script>
		<script type="text/javascript" src="include/enroll_student.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap-alert.js"></script>
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
			navbar("class");
			include('include/connect.php');
			
		?>
		<div class="row-fluid">
			<div class="span3" id="sidebar">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
							<ul class="nav nav-list">
							  	<li class="nav-header">Class</li>
							  	<li
							  		<?php
							  			if (isset($_GET['action']) and $_GET['action'] == "add")
							  			{
							  				echo " class= \"active\"";
							  			}
							  		?>
							  	><a href="class1.php?action=add">Create Class</a></li>
							  	<li><a href="edit_class.php">Withdraw Courses</a></li>
							  	<li
							  		<?php
							  			if (isset($_GET['action']) and $_GET['action'] == "enroll") {
							  				echo " class=\"active\"";
							  			}
							  		?>
							  	><a href="class1.php?action=enroll">Enroll Student</a></li>
							</ul>
						  </div><!--/.well -->
						</div><!--/span-->
				  	</div>
				</div>
			</div><!-- end of sidebar -->
			<div class="span9">
				<?php
					if(isset($_GET['action']))
					{
						$edit_button=0;//<To check either the enroll button is pressed or not in the enroll student section

						$act=$_GET['action'];
						if($act=='add')
						{
							include('include/enroll_course_class.php');
						}
						else if($act=='edit')
						{
							if(isset($_POST['update']))
							{
								$class_id = $_POST['course_id'];
								$batch = $_POST['batch'];
								echo $course.$batch;
							}
							else
							{
								?>						
								Search the course according to the course code
									<form>
										<input type="text" name="course" id="course" onkeyup="process()">
									</form>
								<div id="result"></div>
							<?php } 					
						}
						else if($act=='enroll')
						{
							
							$temp_course_code=0;
							$button_press_checkor=0;//Checks either the enroll or edit button is clicked or not
							
							if(isset($_POST['enroll']))
							{
								$button_press_checkor=1;
								$reg_id=$_POST['category'];
								$class_id=$_POST['class_id'];
								$s="DELETE FROM `gms`.`student_grade` WHERE reg_no='".$reg_id."' AND class_id='".$class_id."'";//this must be deleted first in order to remove the subjects selected by the student first and then the new updated data is set to the table
								mysql_query($s) or die(mysql_error());
								foreach($_POST['set'] as $course_code) 
								{
									$sqla="INSERT INTO `gms`.`student_grade`(`reg_no`,`course_code`,`class_id`) VALUES ('$reg_id','$course_code','$class_id')";
									$q=mysql_query($sqla) or die(mysql_error());					
								}
								//header("location: class1.php.php");		
							}
							else if(isset($_POST['edit']))
							{
								$edit_button=1;
								$button_press_checkor=1;
								$class_id=$_POST['class_id'];
								$reg_no=$_POST['category'];
								echo "<h1>".$reg_no."</h1>";
								$qu=mysql_query("SELECT * FROM student WHERE reg_no='$reg_no'");
								while($r=mysql_fetch_array($qu))
								{
									extract($r);
									echo "<p>The courses previously selected by ".$first_name." ".$middle_name." ".$last_name." are as below: </p>";	
								}
									?>		
						
						
									<form action='class1.php?action=enroll' method='POST'>				
										<table class="table table-hover">
											<thead>
												<tr>
													<th>SN</th>
													<th>Offered Courses</th>
													<th>Select</th>
												</tr>
											</thead>
											<tbody>
																
												<?php
												$c=1;//for making the SN in the table
												//$sq="SELECT * FROM class WHERE class_id='$sel'";
												
												$query=mysql_query("SELECT * FROM class WHERE class_id='$class_id'");
												echo "<input name='category' type='hidden' value=".$reg_no.">";
												echo "<input name='class_id' type='hidden' value=".$class_id.">";
												while($result=mysql_fetch_array($query))
												{
													extract($result);
											    //  now display the information from the db
													$temp_course_code=$course_code;
											
													$flag=0;	
													$query1=mysql_query("SELECT * FROM student_grade WHERE reg_no='$reg_no'");
														$flag_temp=0;
														while($result1=mysql_fetch_array($query1))
														{
															extract($result1);
															
																$new_course_code=$course_code;
																if($new_course_code==$temp_course_code)
																{
																	echo"<tr> 
																	<td>".$c."</td>
																	<td><a href='course.php?course_action=".$course_code."'>".$course_code."</a></td>	
																	<td><input type='checkbox' value='".$course_code."' name='set[]' checked/></td>
																	</tr>";	
																	$flag_temp=1;
																	$flag=1;
																}
																else
																{
																	$flag=0;	
																}	
														}
												
														if($flag==0 && $flag_temp==0)
														{
															
															echo"<tr> 
															<td>".$c."</td>
															<td><a href='course.php?course_action=".$temp_course_code."'>".$temp_course_code."</a></td>	
															<td><input type='checkbox' value='".$temp_course_code."' name='set[]'/></td>
															</tr>";	
															//$flag=0;	
														}				
														$c++;													
												}//end of upper while loop
												
												?>									
											</tbody>
										</table>
										
										<button class="btn btn-large btn-primary" name="enroll" type="Submit">Enroll</button>
										<button class="btn btn-large btn-primary" name="edit" type="submit">EDIT</button>
									</form>
									<?php									
							}
							echo "<h1>Enroll Student</h1><p>Please select the class form the drop down below:</p></p>";
							if(!(isset($_POST['enroll'])||isset($_POST['enroll']))||$button_press_checkor)
							{
								?>
								<select name='category' id='class_id' onchange='process1();'>
									<option>Select the class</option>

									<?php
										$query=mysql_query("SELECT * FROM class");
										$o_id=0;
					 					while($result=mysql_fetch_array($query))
										{
											extract($result);
											$c_id=$class_id;
											if($o_id!=$c_id)
											{
												?>
													<option value=<?php echo $class_id?>> <?php echo convert($class_id)?> </option>
												<?php
																											
												$o_id=$c_id;		
																				
											}
																								
										}		
									?>
								</select>
								<div id="student_list"></div>
								<?php
							}
						}
						else if($act=='view')
						{
							?>
							<h1>Registered Classes</h1>
							<p>The followings are the class that are registered. Please click on the link below to view details on it.</p>
							<?php
							if (isset($_GET['enroll_course_success'])) {
								echo "<div class=\"alert fade in\">";
								echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
								if ($_GET['enroll_course_success'] == 0) {
									echo "The class could not be created.";
								}
								elseif ($_GET['enroll_course_success'] == -1) {
									echo "The class you tried to create already exists. So it has been updated.";
								}
								else {
									echo "Class succcessfully created.";
								}
								echo "</div>";
							}
							include('include/lister_class.php');
						}	
					}
					else if(isset($_GET['course_action']))
					{
						$sel=$_GET['course_action'];						
						$current_class = convert($sel);

						$sq="SELECT * FROM class WHERE class_id='$sel' ORDER BY course_code ASC";
						$q=mysql_query($sq) or die(mysql_error());
						
						$loop=mysql_num_rows($q);
						
						
						
						echo "<h1>".$current_class."</h1>"."<h3>(".$sel.")</h3>";
						
						?>
						<br>
						<p>	The courses offered to this semester are as follows: </p>
						<br>
						<table class="table table-hover">
									  <thead>
										<tr>
										  <th>SN</th>
										  <th>Enrolled Courses</th>
										  <th>Batch</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											
											$c=1;
											
											while($loop!=0)
											{
												$data=mysql_fetch_array($q);
												$course=$data['course_code'];
													echo"<tr> 
														<td>".$c."</td>
														<td><a href='course.php?course_action=".$course."'>".$data['course_code']."</a></td>
														
														<td>".$data['batch']."</td>
														
														</tr>";		
												$c++;			
												$loop=$loop-1;
											}
										?>
										
									  </tbody>
						</table>
						
						
							
						<?php
					}	
				?>
			</div>
		</div>
		<?php include('include/footer.php'); ?>
		</div><!--end of row-->
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>

