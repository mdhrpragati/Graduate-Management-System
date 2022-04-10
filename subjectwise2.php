<?php

	require('session/session.php');
	confirm_logged_in();
?>


<?php ob_start(); ?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Student</title>
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
			include('include/user_nav.php');
			include('include/connect.php');
			navbar('report');
		?>
					
		<div class="row-fluid">
				
			<div class="span3" id="sidebar">
				
				<div class="container-fluid">
						 
					 <div class="well sidebar-nav">
						<ul class="nav nav-list">								  
							<li class="nav-header">Report</li>
						    <li><a href="report.php?action=view_individual">Individual Report</a></li>
							<li><a href="report.php?action=view_subjectwise">Subjectwise Report</a></li>
							<li><a href="report.php?action=view_classwise">Classwise Report</a></li>
					 	</ul>
					</div>					
						
				</div>
				
			</div>

			<div class='well container-fluid span8'>
			<?php
					
				$Batch=$_POST["inputBatch"];
				$Semester=$_POST["inputSemester"];
				$Course_code=$_POST["inputCourse_code"];

				$Class_id=$Semester.'s'.$Batch;

				$query = "SELECT * FROM student_grade WHERE course_code='{$Course_code}' AND class_id='{$Class_id}' ORDER BY reg_no ASC";				
					
				$result_set = mysql_query($query);
				$number_of_rows=mysql_num_rows($result_set);
					
				if($number_of_rows==0)
					{
						header("location:report.php?action=view_subjectwise_error");
					}
					else
					{
						$Grade=array();
						while($row=mysql_fetch_assoc($result_set))
						{
							extract($row);
							{							
								
								$Grade[]=array(												
													"registration_number"=>$reg_no,
													"grade"=>$grade,
													"remarks"=>$remarks,
												);
							}
						}
					}
				
			?>
			
			<?php
				$query = "SELECT course_name FROM courses WHERE  course_code='{$Course_code}'";	
				$result_set = mysql_query($query);
				$row=mysql_fetch_assoc($result_set);
				extract($row);
				$Course_name=$course_name;
			?>
				
				<p class="text-left">Batch :<?php echo " ".$Batch; ?></p>
				<p class="text-left">Semester :<?php echo " ".$Semester; ?></p>
				<p class="text-left">Course Code :<?php echo " ".$Course_code; ?></p>
				<p class="text-left">Course Name :<?php echo " ".$Course_name; ?></p>
					
				
				<div >
					<table class="table table-bordered" >
						<caption>Semester:<?php echo $Semester; ?></caption>
						<tr>
							<th>Registration Number</th>
							<th>Name</th>
							<th >Grade</th>
							<th >Remarks</th>
						</tr>
						<?php
							foreach ($Grade as $single) 
								{												
									?>
									<tr>
										<td><?php echo $single["registration_number"]; ?></td>
										<?php
											$query = "SELECT first_name,middle_name,last_name FROM student WHERE  reg_no='{$single["registration_number"]}'";			
														$result_set = mysql_query($query);
														
														$row=mysql_fetch_assoc($result_set);
														
															extract($row);
														
															$Stu_name=$first_name." ".$middle_name." ".$last_name;
										?>
										<td><?php echo $Stu_name; ?></td>
										<td><?php echo $single["grade"]; ?></td>
										<td><?php echo $single["remarks"]; ?></td>
									</tr>
									<?php					
													
																
								}
						?>
    				</table>
				</div>				
			</div>
		</div>	
		<?php include('include/footer.php'); ?>
	</body>
</html>
<?php ob_end_flush(); ?>		
