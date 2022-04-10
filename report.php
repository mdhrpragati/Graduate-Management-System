<?php require_once ("session/session.php");?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>GMS:Report</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<style type="text/css">
			#sidebar {
				border-right: 3px solid rgb(238,238,238);
				height: 200px;
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
			navbar("report");
			include('include/connect.php');
		?>

		<div class="row-fluid">
				
			<div class="span3 bs-docs-sidebar" id="sidebar" >
				
				<div class="container-fluid bs-docs-sidebar">
						
					<div class="well sidebar-nav bs-docs-sidebar">
						
						<ul class="nav nav-list  bs-docs-sidenav">
							<li class="nav-header">Report</li>
						    <li><a href="report.php?action=view_individual">Individual Report</a></li>
							<li><a href="report.php?action=view_subjectwise">Subjectwise Report</a></li>
							<li><a href="report.php?action=view_classwise">Classwise Report</a></li>
						</ul>
							  
					</div>
				
				</div>
				
			</div>
			
			
			<?php
				
				$query="SELECT course_code,class_id from student_grade";//extracting from database
				$result=mysql_query($query);
				
				$Course_code_notunique=array();//creating an array
				$Class_id_notunique=array();//creating an array

				while($row=mysql_fetch_array($result))//assigning values to the array created
					{
						extract($row);//extract the array
						{								
							$Course_code_notunique[]=$course_code;								
							$Class_id_notunique[]=$class_id;						
						}

					}

				$Course_code=array_unique($Course_code_notunique);//creating array with unique elements
				sort($Course_code);
				$Class_id=array_unique($Class_id_notunique);
													
			?>

			<?php

				$Batch_not_unique=array();
				$Semester_not_unique=array();
				foreach($Class_id as $single)
					{
						$Batch_not_unique[]=substr($single,2);//breaking classid into batch
						$Semester_not_unique[]=substr($single,0,1);//breaking classid into semester
					}
				$Batch=array_unique($Batch_not_unique);//creating array with unique elements
				sort($Batch);
				$Semester=array_unique($Semester_not_unique);
				sort($Semester);
									
			?>					

			<?php
				if(isset($_GET['action']))
				{
					$act=$_GET['action'];
					if($act=='view_individual' or $act=='view_individual_error' )
					{
						include('individual_form.php'); 
					}
			
					elseif($act=='view_subjectwise' or $act=='view_subjectwise_error')
					{
						include('subjectwise_form.php'); 
					}	
					elseif ($act=='view_classwise' or $act=='view_classwise_error') 
					{
						include('classwise_form.php'); 
					}
				}				
			?>		
				
		</div>
		<?php include('include/footer.php'); ?>
			
	</body>		
		
</html>
