<?php require_once ("session/session.php");?>
<?php
	ob_start();
?>
<?php confirm_usr_login(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Grades</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript">
			function confrm()
			{
				var con=confirm("Do you really want to perform this operation?");
				return con;
			}
			
		
		</script>
	
	</head>
	<body>
		<?php include('include/header.php'); ?>
		<?php include('include/nav.php'); ?>
		<?php navbar("grade"); ?>
		<?php include("include/connect.php"); ?>
		<?php
			$sql = "SELECT batch FROM class ORDER BY batch ASC";
			$batch_set = mysql_query($sql);
			if (!$batch_set) { die("Could not read from database.". mysql_error()); }
		?>
		<?php

			//after the initial form has been filled
			if (isset($_GET['initial_Submit']))
			{
				// $subject_sql = "SELECT class.course_code FROM class WHERE batch='";
				// $subject_sql .= $_POST['batch'];
				// $subject_sql .= "' and semester = '" . $_POST['semester']."'";
				$subject_sql = "SELECT courses.course_code, course_name FROM courses LEFT JOIN class ON courses.course_code = class.course_code  WHERE class.class_id = '" .$_GET['semester']."s".$_GET['batch']."' ". "ORDER BY class.course_code ASC"; 

				//THE left join has been used in order to get the course name and the course code in one go otherwise we could have just taken the course code from one table then used in to get the course name
				$subject_set = mysql_query($subject_sql);
				if (!$subject_set) {
					die ("Could not read from database to read courses".mysql_error());
				}
			}

			//after a course has been selected
			elseif (isset($_GET['action']) && isset($_GET['code']) && $_GET['action'] == "addgrade") {
				// $student_sql = "SELECT * FROM student_grade WHERE course_code='";
				// $student_sql .= $_GET['code'];
				// $student_sql .= "' and class_id='";
				// $student_sql .= $_GET['semester'];
				// $student_sql .= "s" . $_GET['batch']; //making 1s2011
				// $student_sql .= "' ORDER BY reg_no ASC";
				// $student_set = mysql_query($student_sql);
				// if (!$student_set) {
				// 	die("Unable to read grades\n".mysql_error());
				// }
				$student_sql = "SELECT student_grade.*, student.first_name, student.middle_name, student.last_name FROM student_grade, student WHERE course_code='";
				$student_sql .= $_GET['code'];
				$student_sql .= "' and class_id='";
				$student_sql .= $_GET['semester'];
				$student_sql .= "s" . $_GET['batch']; //making 1s2011
				$student_sql .= "'AND student_grade.reg_no = student.reg_no ORDER BY student.reg_no ASC";
				$student_set = mysql_query($student_sql);
				if (!$student_set) {
					die("Unable to read grades\n".mysql_error());
				}
			}

			//after the grades have been entered
			elseif (isset($_POST['grade_submit'])) {
				//EXECUTE MULTIPLE QUERIES USING FOR LOOP
				// echo "<pre>";
				// print_r($_POST);
				// echo "</pre>";
				//There are three required inputs and a submit
				//So the number of times the loop should run is
				$num = (count($_POST) - 1)/3;
				for ($i=1; $i <= $num; $i++) { 
					$cur_grade = "grade_".$i;
					$cur_remarks = "remarks_".$i;
					$cur_reg_no = "reg_no_".$i;
					$sql = "UPDATE student_grade SET ";
					$sql .= "grade='".strtoupper($_POST[$cur_grade])."', ";
					$sql .= "remarks=";
					if (!empty($_POST[$cur_remarks]))
					{	
						$sql .=  "'{$_POST[$cur_remarks]}'";
					}
					else
					{
						$sql .=  "NULL";
					}	 
					$sql .= " WHERE reg_no='" . $_POST[$cur_reg_no] . "' ";
					$sql .= "and course_code='" . $_GET['code'] . "'";
					$result_set = mysql_query($sql);
					if (!$result_set) {
						die("Couldn't update student records.".mysql_error());
					}
				}
				header("Location: grade.php?action=addgrade&code=".$_GET['code']."&semester=".$_GET['semester']."&batch=".$_GET['batch']."&message=success");
			}
		?>
		<div class="row-fluid">
			<div class="span3">
				<?php 
					if (logged_in_username() == 'admin') 
					{ 
						?>
						<div class="span1"></div>
						<div class="span11">
							<div class="well sidebar-nav">
								<ul class="nav nav-list">
									<li class="nav-header">Quick Links</li>
									<li 
										<?php if (!isset($_GET['initial_Submit']) && !isset($_GET['action']))
											{ echo "class=\"active\""; }
											?>
											><a href="grade.php">Enter Grades</a></li>
									<?php
										if (isset($_GET['initial_Submit']) || isset($_GET['action'])) {
									?>
										<ul class="nav nav-list">
											<li 
												<?php if (isset($_GET['initial_Submit'])) {
													echo "class=\"active\"";
												}?>
											><a href="grade.php?<?php
																			echo "initial_Submit=Go&";
																			echo "batch=".$_GET['batch'];
																			echo "&semester=".$_GET['semester'];
																			echo "#second_head";
																	?>">Select Course</a></li>
											<?php if (isset($_GET['action'])) {
													?>
											<li class="active">
												<a>Update Grades</a>
											</li>
											<?php
												}
											?>
										</ul>	
									<?php
										}
									?>
									<li><a href="add_student.php">Add a New Student</a></li>
									<li><a href="class1.php?action=add">Add a New Class</a></li>
									<li><a href="course.php?action=add">Add a New Course</a></li>
								</ul>
							</div>
						</div>
						<?php 
					}
				?>
			</div>
			<div class="span8">
				<!-- Start of upper form -->
				<form class="form-horizontal well" action="grade.php#second_head" method="get">
					<fieldset>
						<label class="control-group">
							<div class="control-label">
								Batch: 
							</div>
							<div class="controls">
								<select name="batch">
									<?php

										//Generating list of batch
										$temp = "";
										while ($batches = mysql_fetch_assoc($batch_set))
										{
											$selected = "";
											$batch1 = $batches['batch'];
											if (isset($_GET['batch']) && $batch1 == $_GET['batch']) {
												$selected = "selected";
											}
											if ($batch1 != $temp)
											{
												echo "<option value=\"{$batch1}\" {$selected}>{$batch1}</option>";
												$temp = $batch1;
											}
										}
									?>
								</select>
							</div>
						</label>
						<label class="control-group">
							<div class="control-label">
								Semester: 
							</div>
							<div class="controls">
								<select name="semester">
									<option value="1"<?php echo (isset($_GET['semester']) && $_GET['semester']==1) ? " selected": ""; ?>>I</option>
									<option value="2"<?php echo (isset($_GET['semester']) && $_GET['semester']==2) ? " selected": ""; ?>>II</option>
									<option value="3"<?php echo (isset($_GET['semester']) && $_GET['semester']==3) ? " selected": ""; ?>>III</option>
									<option value="4"<?php echo (isset($_GET['semester']) && $_GET['semester']==4) ? " selected": ""; ?>>IV</option>
								</select>
							</div>
						</label>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="initial_Submit" value="Go">Go</button>
							</div>
						</div>
					</fieldset>
				</form><!-- end of upper form -->
				<?php
					//Generating the list of courses in the batch and semester
					if (isset($_GET['initial_Submit'])) 
					{

						?>
						<div class="container-fluid">
							<a name="second_head" class="name_tags"><h2>Batch: <?php echo $_GET['batch']; ?>&nbsp;&nbsp;&nbsp;Semester: <?php echo $_GET['semester']; ?></h2></a>
							<?php
								if (mysql_num_rows($subject_set) != 0)
								{
									?>
									<table class="table table-hover">
										<thead>
											<tr>
												<th>S.N</th>
												<th>Course Code</th>
												<th>Course Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$i=1;
												while ($course = mysql_fetch_array($subject_set))
												{
													echo "<tr>";
													echo "<td>{$i}</td>";
													echo "<td><a href=\"grade.php?action=addgrade&code={$course['course_code']}";
													echo "&semester=".$_GET['semester']."&batch=".$_GET['batch'];
													echo "#second_head\">";
													echo "{$course['course_code']}</a></td>";
													echo "<td>{$course['course_name']}</td>";
													echo "</tr>";
													$i = $i+1;
												}
											?>
										</tbody>
									</table>
									<?php
								}
								else
								{
									?>
									<p>There are no courses in this class.<br />
									<?php 
									if (logged_in_username() == "admin") 
									{
										?>
										<a class="btn" href="class1.php?action=add">Add this class</a>
										<?php 
									}
								}	
							?>
						</div>
						<?php
					}
					//End of lower table of courses

					//Generating list of students in the course
					elseif (isset($_GET['action']) && isset($_GET['code']) && $_GET['action'] == "addgrade") {
						?>
						<div class="container-fluid">
							<a name="second_head" class="name_tags">
								<h2>Batch: <?php echo $_GET['batch']; ?>&nbsp;&nbsp;&nbsp;Semester: <?php echo $_GET['semester']; ?></h2>
							</a>
							<h3><?php echo $_GET['code']; ?></h3>
						<?php

							//to check if there are any students registered in the course
						 	if (mysql_num_rows($student_set) != 0)
						 	{
						 		?>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Registration Number</th>
											<th>Grade</th>
											<th>Remarks</th>
										</tr>
									</thead>
									<tbody>
										<form action="grade.php?code=<?php echo $_GET['code']; ?>&semester=<?php echo $_GET['semester']; ?>&batch=<?php echo $_GET['batch']; ?>#second_head" onsubmit='return confrm()'method="post">
											<?php
												$i = 1;
												if (isset($_GET['message'])) {
													echo "<p>Records successfully updated.</p>";
												}
												while ($student = mysql_fetch_assoc($student_set)) 
												{
													
													echo "<tr>";
													echo "<td>";
													echo $student['first_name']. " ";
													if (!empty($student['middle_name'])) 
													{
														echo $student['middle_name'] . " ";
													}
													echo $student['last_name'];
													echo "</td>";
													echo "<td>";
													echo $student['reg_no'];
													echo "</td>";
													//echo "<td>";
													echo "<input type=\"hidden\" name=\"reg_no_{$i}\" value=\"{$student['reg_no']}\" />";
													//echo "</td>";
													echo "<td>";
													echo "<input type=\"text\" placeholder=\"Grade\" name=\"grade_{$i}\" value=\"{$student['grade']}\" id=\"grade\"/ pattern=\"(^[ABCDF]{1}$|^[abcdf]{1}$|^[ABC][-]$|^[abc][-]$|^[BC][+]$|^[bc][+]$)\" title=\"Allowed grades: A, A-, B+, B, B-, C+, C, C-, D, F\" >";
													echo "</td>";
													echo "<td>";
													echo "<input type=\"text\" placeholder=\"Remarks\" name=\"remarks_{$i}\" value=\"{$student['remarks']}\" />";
													echo "</td>";
													echo "</tr>";
													$i = $i + 1;
												}
											?>
											<tr>
												<td>
													<button class="btn btn-primary" type="submit" name="grade_submit">Submit Grades</button>
												</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>
													<a class="btn btn-primary" href="grade.php?<?php
															echo "initial_Submit=Go&";
															echo "batch=".$_GET['batch'];
															echo "&semester=".$_GET['semester'];
															echo "#second_head";
													?>">Go Back to Courses</a>
												</td>
											</tr>
										</form>
									</tbody>
								</table>
								<?php
							}
							else {
								echo "<p class=\"well\">There are no students in this course.</p>";
								echo "<a class=\"btn btn-primary\" href=\"grade.php?";
								echo "initial_Submit=Go&";
								echo "batch=".$_GET['batch'];
								echo "&semester=".$_GET['semester'];
								echo "#second_head\">Go Back to Courses</a>";
							}
						?>
						</div>
						<?php
					}
					//end of list of students
				?>
			</div>
			<div class="span1"></div>
		</div>
		<?php include('include/footer.php'); ?>
	</body>
</html>

<?php
	ob_end_flush();
?>
