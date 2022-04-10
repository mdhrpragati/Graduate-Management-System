<?php
	include 'include/connect.php';
	$course = $_GET['course'];

	if(!$course)
	{	
		echo "Please enter a search query for class code.";
	}
	else
	{
		//now search that course in database
		$query=mysql_query("SELECT * FROM class WHERE class_id='$course'");
		$rows = mysql_num_rows($query);
		if(!$rows)
		{
			echo "Course not found";
		}
		else
		{
				echo "The list of the enrolled courses are as below:"; 
				?>
				<form action="edit_class.php" method="POST">
						<!--Course Code : <input type="text" name="class_id" id="course_code" value="<?php echo $course_code ?>" readonly>
						Course Instructor : <input type="text" name="batch" id="course_name" value="<?php echo $batch ?>">
						Credit : <input type="text" name="credit" id="credit" value="<?php echo $credit ?>">
						Description : <input type="text" name="description" id="description"value="<?php echo $description ?>">-->
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
																
				}
					echo"<input name='class_code' value=".$course.">";
									?>
									
								  </tbody>
					</table>
						
						
						
						
						<input type="submit" value="Withdraw Courses" name="withdraw"/>
					</form>
					<?php	
									
				}
		}
	
	
?>





