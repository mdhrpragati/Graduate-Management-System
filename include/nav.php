<?php 
	function navbar($active="")
	{
		$usrname = logged_in_username();
		echo "
			<div class=\"row-fluid\">
						
							<div class=\"navbar\">
								<div class=\"navbar-inner\">
									<ul class=\"nav\">
										
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "class") {
											echo " active";
										}
										echo "\">
											<a href=\"class1.php?action=view\" class=\"dropdown-toggle\">Semester</a>
											<ul class=\"dropdown-menu\">
												<li><a href=\"class1.php?action=add\">Create Class</a></li>
												<li><a href=\"edit_class.php\">Withdraw Courses</a></li>
												
												<li><a href=\"class1.php?action=enroll\">Enroll Students</a></li>
												
											</ul>
										</li>
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "course") {
											echo " active";
										}
										echo "\">
											<!--<a href=\"edit_course.php\">Course</a>-->
											<a href=\"course.php?action=view\">Course</a>
											<ul class=\"dropdown-menu\">
												<li><a href=\"course.php?action=add\">Add Course</a></li>
												<li><a href=\"course.php?action=edit_course\">Edit Course</a></li>
												<li><a href=\"course.php?action=assign_instructor\">Change/Assign Instructor</a></li>
												<li><a href=\"course.php?action=delete_course\">Delete Courses</a></li>
												
											</ul>
										</li>
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "student") {
											echo " active";
										}
										echo "\">
											<a href=\"add_student.php\">Student</a>
											<ul class=\"dropdown-menu\">
												<li><a href=\"add_student.php\">Add Student</a></li>
												<li><a href=\"edit_student.php\">Edit Student</a></li>
											</ul>
										</li>
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "teacher") {
											echo " active";
										}
										echo "\">
											<a href=\"teacher.php?action=view_teacher\" >Teacher</a>
											<ul class=\"dropdown-menu\">
												<li><a href=\"teacher.php?action=add\">Add Teacher</a></li>
												<li><a href=\"teacher.php?action=edit\">Edit Teacher</a></li>
												<li><a href=\"teacher.php?action=delete\">Delete Teacher Details</a></li>
											</ul>
										</li>
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "report") {
											echo " active";
										}
										echo "\">
											<a href=\"report.php?action=view_individual\" >Reports</a>
											<ul class=\"dropdown-menu\">
												<li><a href=\"report.php?action=view_classwise\">View Classwise Reports</a></li>
												<li><a href=\"report.php?action=view_subjectwise\">View Sujectwise Reports</a></li>
												<li><a href=\"report.php?action=view_individual\">View Individual Reports</a></li>
											</ul>
										</li>
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										if ($active == "grade") {
											echo " active";
										}
										echo "\">
											<a href=\"grade.php\" class=\"dropdown-toggle\">Grade</a>
											
										</li>
										
										
										<li class=\"divider-vertical\"></li>
										<li class=\"dropdown";
										
										if ($active == "search") {
											echo " active";
										}
										echo "\">
											<a href=\"search.php\" class=\"dropdown-toggle\">Search</a>
											</li>
											<li class=\"divider-vertical\"></li>
										";
										echo "<li class=\"dropdown\"";
										if ($active == "settings") {
											echo " active";
										}
										echo "\">
											<a class=\"dropdown-toggle\">Setting</a>
											<ul class='dropdown-menu'>
												<li><a href=\"adminpassword.php\">Change password </a></li>
												<li><a href=\"change_personal.php\">Change Personal Information</a></li>
											</ul>
										</li>
										
										
										<li class=\"divider-vertical\"></li>
										
										
								
										
									</ul><!--end of nav menu-->
									
									<ul class='nav pull-right'>
									<!--<li class=\"divider-vertical\"></li>
										<p class=\"navbar-text pull-right\"><a href=\"index.php?action=logout\">Logout</a></p> -->
										<li class='divider-vertical'><a href='index.php?action=logout'>Logout</a></li>
										<li class='divider-vertical'><p class='navbar-text'>Logged in as {$usrname}</p></li>
									</ul>
								</div><!--end of navbar - inner-->
							</div><!--end of navbar-->
			";
	}
?>
