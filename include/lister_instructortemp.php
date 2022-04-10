
<h1>Assign Instructor</h1>


<form type='submit' method='POST' action='include/enroll_course_class.php'>
<table class="table table-hover">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Course Code</th>
                  <th>Course name</th>
                  <th>Class</th>
                  <th>Instructor</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$sql="SELECT * FROM courses WHERE 1 ORDER BY course_code ASC";
					$q=mysql_query($sql) or die(mysql_error());
					$loop=mysql_num_rows($q);
					$c=1;
					while($loop!=0)
					{
						$data=mysql_fetch_array($q);
						$course=$data['course_name'];
						$da=$data['course_code'];
						
						
						//$stn0="<tr> 
						echo "<tr> 
								<td>".$c."</td>
								<td><a href='course.php?course_action=".$da."'>".$da."</a></td>
								
								<td>".$course."</td>";
								
						echo "<td>	
								<select name='class_id'>";
	
									$b=mysql_query("SELECT * FROM class ORDER BY class_id ASC") or die(mysql_error());
									$counter=mysql_num_rows($b);
									$bb=0;
									while($counter!=0)
									{
										$tadaa=mysql_fetch_array($b);
										$aa=$tadaa['class_id'];
										if($aa!=$bb)
										{
											echo"<OPTION value=".$tadaa['class_id'].">".$tadaa['class_id'];
											
											$bb=$aa;
										}
										$counter=$counter-1;
									}
									
									
									//$stn1="</select>								
									echo "</select>								
								
								</td>";		
								
								
								
								echo"<td>
									<select name='instructor'>";
	
									$a=mysql_query("SELECT * FROM teacher_detail ORDER BY first_name ASC") or die(mysql_error());
									$counter=mysql_num_rows($a);
									while($counter!=0)
									{
										$tada=mysql_fetch_array($a);
										echo"<OPTION value=".$tada['email_id'].">".$tada['first_name'];
										$counter=$counter-1;
									}
									
									
									//$stn1="</select>								
									echo "</select>								
								
								</td>";
							
							echo "</tr>	";
							
						$loop=$loop-1;
						$c++;
					}
				?>
				
              </tbody>
</table>
<input type='submit' value='Assign' name='assign'>
</form>
