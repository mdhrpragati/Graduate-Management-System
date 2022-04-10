<?php require_once("session/session.php"); ?>

<?php confirm_logged_in(); ?>
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
		?>
		<div class="row-fluid">
			
				<div class="navbar">
					<div class="navbar-inner">
						<ul class="nav">
							<li class="dropdown">
								<a href="userpassword.php" class="dropdown-toggle">CHANGE PASSWORD</a>
								
							</li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#">ASSIGNED COURSES</a>
								
							</li>
							<li class="divider-vertical"></li>
							
							
							<li class="dropdown">
								<a href="#" >VIEW REPORTS</a>
								<ul class="dropdown-menu">
									<li><a href="#">CLASSWISE REPORT</a></li>
									<li><a href="#">INDIVIDUAL REPORT</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="index.php?action=logout">LOGOUT</a>
								
							</li>
							
						</ul><!--end of nav menu-->
					</div><!--end of navbar - inner-->
				</div><!--end of navbar-->
			
			<div class="row-fluid">
				<div class="span2" id="sidebar">SIDEBAR</div>
				<div class="span10">MAIN CONTENT</div>
			</div>
			
			
		</div><!--end of row-->
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
