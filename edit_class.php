<?php require_once ("session/session.php");?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GMS: Admin</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-dropdown.css">
		<script type="text/javascript" src="search_class.js"></script>
		<script type="text/javascript">
				function confrm()
				{
					var con=confirm("Are you sure you want to remove the course???");
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
			include('function/functions.php');
			navbar("class");
			include('include/connect.php');
			$q=0;
		?>
		<div class="row-fluid">
			<div class="span3" id="sidebar">
				<div class="container-fluid">
					  <div class="row-fluid">
						<div class="span14">
						  <div class="well sidebar-nav">
							<ul class="nav nav-list">
							  <li class="nav-header">Class</li>
							  <li><a href="class1.php?action=add">Create Class</a></li>
							  <li class="active"><a href="edit_class.php">Withdraw Courses</a></li>
							  <li><a href="class1.php?action=enroll">Enroll Student</a></li>
							</ul>
						  </div><!--/.well -->
						</div><!--/span-->
					  </div>
				</div>
			</div>
			<div class="span9">
				<?php
					if(isset($_GET['course_action']))
					{
							global $act;
							$act=$_GET['course_action'];
							
							
							$class_name=convert($act);
							echo"<h1>$class_name</h1></br>";
							
							
							$query=mysql_query("SELECT * FROM class WHERE class_id='$act' ORDER BY course_code ASC");
							echo "The list of the enrolled courses are as below:</br></br></br>"; 
							?>
							<form action="edit_class.php" onsubmit="return confrm()" method="POST">	
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
											$c=1;
											while($result=mysql_fetch_array($query))
											{
												extract($result);
												//now display the information from the db	
												echo"<tr> 
												<td>".$c."</td>
												<td><a href='course.php?course_action=".$course_code."'>".$course_code."</a></td>	
												<td><input type='checkbox' value='".$course_code."' name='set_code[]'/></td>
												</tr>";	
																	
												$c++;			
												//											
											}
												echo"<input type='hidden' name='class_code' value=".$act.">";
										?>		
								  	</tbody>
								</table>
								<button class="btn btn-primary" type="submit" value="Withdraw Courses" name="withdraw">Withdraw Courses</button>
							</form>
							<?php	
					}
					else
					{	
						if(isset($_POST['withdraw']))
						{
							//update the onfo and show the message
							$class_code = $_POST['class_code'];
							//$class_code = $act;
							
							
							//now add to database
							//$query = mysql_query("UPDATE courses SET course_name='$course_name', credit='$credit', description='$description' WHERE course_code='$course_code'") or die(mysql_error());
							
							
							if(isset($_POST['set_code']))
							{
								foreach($_POST['set_code'] as $course_code ) 
								{
									
									$sqla="DELETE FROM `gms`.`class` WHERE course_code = '$course_code' && class_id='$class_code'";
									$q=mysql_query($sqla) or die(mysql_error());				
								}						
							}
						}
							
						if($q)
						{
							echo "Withdraw Succcessfull !!!!";
						}
						
						else
						{
							?>
							<h1>Withdraw Courses</h1>						</br>
							Please click on the respective class to withdraw courses from the class: </br></br>
								<!--<form>
									<input type="text" name="course" id="course" onkeyup="process()">
								</form>
								-->
							<?php
								include('include/lister_class_edit.php');
							?>	
						<?php } 
					}//end of else
				?>
			</div>
			
		</div><!-- end of row -->
		<?php include('include/footer.php'); ?>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>

