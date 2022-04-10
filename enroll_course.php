<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Management System</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="enroll_course2.js"></script>
		<style type="text/css">
			#sidebar {
				border-right: 3px solid rgb(238,238,238);
				height: 250px;
			}
		</style>
	</head>
	
	<body>
		<?php include('include/header.php');
				include ('include/connect.php');
		?>
		<div class="row-fluid">
			
		<?php include ('include/nav.php'); ?>
		<?php navbar("class"); ?>
		<div class="row-fluid">
		<div class="span2" id="sidebar">SIDEBAR</div>
		<div class="span10"> <!--Main content-->
					<h3>Select the respective class and student list</h3>
					<!--Select class starts here-->
					Select class : <select name='category' id='class_id' onchange="process();">
					<?php
						//now extract from db
						$query=mysql_query("SELECT * FROM class");
						$o_id=0;
						while($result=mysql_fetch_array($query))
						{
								extract($result);
								$c_id=$class_id;
								
								if($o_id!=$c_id)
								{
									?>
										<option value=<?php echo $class_id?>> <?php echo $class_id?> </option>
									<?php
																			
									$o_id=$c_id;		
												
								}
																
						}
					?>
					<!--Select class ends here-->
					</select>
		<div id="student_list"></div>
		</div>
			</div>			
		</div><!--end of row-->
	</body>
</html>
