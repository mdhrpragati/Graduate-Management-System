<?php 
	function navbar($item) {

 ?>
<div class="navbar">
				<div class="navbar-inner">
					<ul class="nav">
						<li class="dropdown
							<?php if ($item=="settings")
								{
									echo " active ";
								}
							 ?>
						">
							<a href="userpassword.php" class="dropdown-toggle">Change Password</a>
							
						</li>
									
					<li class="divider-vertical"></li>
									<li class="dropdown";
											<?php if ($item == "report2") 
												{
													echo " active";
												}
											?>
									">
											<a href="report2.php?action=view_individual" >Reports</a>
											<!--<ul class="dropdown-menu">
												<li><a href="report.php?action=view_individual\">View Individual Reports</a></li>
											</ul>-->
									</li>
					
						<li class="divider-vertical"></li>
					</ul>
					<ul class="nav pull-right">
						<li class="dropdown pull-right">
							<a href="index.php?action=logout">Logout</a>
							
						</li>
						
					</ul><!--end of nav menu-->
				</div><!--end of navbar - inner-->
			</div><!--end of navbar-->

			<?php } ?>