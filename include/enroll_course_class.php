
<?php
	global $instructor;
	require ('connect.php');
	if(isset($_POST['enroll']))
	{
		$temp=$_POST['semester'];
		
		//$temp_batch=substr($_POST['batch'],-2); //this is for taking the last two strings
		
		$temp_batch=$_POST['batch'];
		
		
		
		//echo $temp_batch;
		
		$class_id=$temp."s".$temp_batch;//this is for making the class code. this is done by manipulating the class code by the combination of the 
		//batch,semester
		echo $class_id;
		
		if(isset($_POST['set']) && isset($_POST['instructor']))
		{
			$i=0;
			foreach($_POST['instructor'] as $inst)
			{ 
				$instructor[$i]=$inst;		
				$i++;
				echo "</br>".$inst;
			}
			$i=0;
			foreach($_POST['set'] as $set) 
			{
				$enroll_course_success = 1;
				//&& $_POST['instructor'] as $instructor
				//echo $instructor[$i]."Anish </br>";
				$test = "SELECT * FROM class WHERE class_id = '{$class_id}' and course_code='{$set}'";
				$test_set = mysql_query($test);
				if (!$test_set) {
					$enroll_course_success = 0;
				}
				elseif (mysql_num_rows($test_set) != 0) {
					$enroll_course_success = -1;
				}
				else {
					$sqla="INSERT INTO `gms`.`class`(`class_id`,`semester`,`course_code`,`batch`,`instructor`) VALUES ('$class_id','$temp','$set','$temp_batch','".$instructor[$i]."')";
					$q=mysql_query($sqla) or die(mysql_error());				
					$i++;
				}	
			}						
			header("Location: ../class1.php?action=view&enroll_course_success=".$enroll_course_success);
		}
	}
	else
	{
		?>
		<h1>Enroll Courses</h1>

		<p>Please select the year and semester first and check the courses to enroll the courses
			<br>Courses can also be added to existing classes 
		</p>
		<form type='submit' method='POST' action='include/enroll_course_class.php'>
			<label>Batch: 
			<input type='number' name='batch' min="2005" max="2030" pattern="^[0-9]{4}" required>
			</label>

			<label>Semester:  
				<select name='semester'>
					<OPTION value='1'>I
					<OPTION value='2'>II
					<OPTION value='3'>III
					<OPTION value='4'>IV
				</select>
			</label>
			<table class="table table-hover">
			  	<thead>
					<tr>
					  	<th>SN</th>
					  	<th>Course Code</th>
					  	<th>Course Name</th>
					  	<th>Credit</th>
					  	<th>Select</th>
					  	<th>Instructor</th>
					</tr>
			  	</thead>
			  	<tbody>
					<?php
						// if(isset($enroll_course_success)) {
						// 	if ($enroll_course_success == 0) {
						// 		echo "Could not create the class completely.";
						// 	}
						// 	elseif ($enroll_course_success == -1) {
						// 		echo "The class with that course already exists";
						// 	}
						// 	else {
						// 		echo "Class successfull created.";
						// 	}
						// }
						// else
						// {
					
					
							$sql="SELECT * FROM courses WHERE 1 ORDER BY course_code ASC";
							$q=mysql_query($sql) or die(mysql_error());
							$loop=mysql_num_rows($q);
							$c=1;
						
							while($loop!=0)
							{
								$data=mysql_fetch_array($q);
								$course=$data['course_code'];
								echo"<tr> 
								<td>".$c."</td>
								<td><a href='course.php?course_action=".$course."'>".$data['course_code']."</a></td>
								<td>".$data['course_name']."</td>
								<td>".$data['credit']."</td>
								<td><input type='checkbox' value='".$data['course_code']."' name='set[]'/></td>";
								echo "<td>
								<select name='instructor[]'>";
								$a=mysql_query("SELECT * FROM teacher_detail ORDER BY first_name ASC") or die(mysql_error());
								$counter=mysql_num_rows($a);
								$tr=0;//kept to make the '--' of dropdown in the first position in the selection list
								global $te;
								$te=0;
								echo "<OPTION value='TBA'>TBA</OPTION>";
								while($counter!=0)
								{
									$tada=mysql_fetch_array($a);
									
									//echo $tada['email_id']."aa";
										echo"<OPTION value=".$tada['email_id'].">".$tada['first_name']."</OPTION>";
										
										$instructor[$tr]=$tada['email_id'];
										
									$tr++;
									$counter=$counter-1;
								}
								echo "</tr>";	
								$loop=$loop-1;
								$c++;
							}
							/*	while($tr!=0)
								{
									echo $instructor[$tr]." aa</br>";
									$tr--;	
								}//USED JUST FOR TESTTING
							*/
						// }
					?>
				</tbody>
			</table>
			<button class="btn btn-primary" type='submit' value='Enroll' name='enroll'>Enroll</button>
		</form>
		
			
			
			
		<?php
	}

?>

	
