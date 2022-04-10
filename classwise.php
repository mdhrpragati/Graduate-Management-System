<?php

	require('session/session.php');
	confirm_logged_in();
?>


<?php ob_start(); ?>
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

			<div class='well container-fluid span8'	>
				<?php
					
					$Batch=$_POST["inputBatch"];
					$Semester=$_POST["inputSemester"];
					
					$Class_id=$Semester.'s'.$Batch;

					$query = "SELECT * FROM student_grade WHERE  class_id='{$Class_id}'";				
					
					$result_set = mysql_query($query);
					$number_of_rows=mysql_num_rows($result_set);
					
					if($number_of_rows==0)
					{
						header("location:report.php?action=view_classwise_error");
					}
					else
					{
						$Grade=array();
						while($row=mysql_fetch_assoc($result_set))
						{
							extract($row);
							{		
							
								$Grade[]=array(
													"course_code"=>$course_code,    //Creating a multidimensional 
													"registration_number"=>$reg_no,//Array
													"grade"=>$grade,
												);
							}
						}
						array_multisort($Grade);
					}
				?>

				<?php
						$Course_code_notunique=array();
						$Registration_number_notunique=array();
						foreach ($Grade as $single) 
						{
							$Course_code_notunique[]=$single["course_code"];
							$Registration_number_notunique[]=$single["registration_number"];
						}

				?>

				<?php
						
						$Course_code=array_unique($Course_code_notunique);
					
						$Registration_number=array_unique($Registration_number_notunique);
						sort($Course_code);
						sort($Registration_number);

				?>
									
					<p class="text-left">Batch :<?php echo " ".$Batch; ?></p>
					<p class="text-left">Semester :<?php echo " ".$Semester; ?></p>												
				
				
				<div >
					<table class="table table-bordered" >
						<tr>
							<th >Registration Number</th>
							<th>Name</th>
							<?php
								foreach($Course_code as $single)
									{
										?>
										<th><?php echo $single; ?></th><?php
									}
							?>
						</tr>							
						<?php
							foreach ($Registration_number as $Single) //putting  grade into the tabular form
								{
									?>
									<tr>
										<td><?php echo $Single; ?></td>
										<?php
											$query = "SELECT first_name,middle_name,last_name FROM student WHERE  reg_no='{$Single}'";		
											$result_set = mysql_query($query);
											$row=mysql_fetch_assoc($result_set);
											extract($row);
											$Student_name=$first_name." ".$middle_name." ".$last_name;
										?>
										<td><?php echo $Student_name; ?></td>
										<?php
											foreach ($Course_code as $single)
											{												
												$empty=0;
												foreach ($Grade as $value)
												{
													if($Single==$value["registration_number"] && $single==$value["course_code"])	
													{													
														echo "<td>".$value["grade"]."</td>";
														$empty++;
													}        							
													
												}
												if($empty==0)
												{
													echo "<td>"."-"."</td>";
												}
											}
										?>
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
