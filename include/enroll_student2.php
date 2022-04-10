<?php
		include ('connect.php');
		$class_id=$_GET['class_id'];
		echo "Student list :";
		$batch_id=substr($class_id,-4);
		
		//$query=mysql_query("SELECT * FROM student_grade WHERE student ='$class_id'") or die(mysql_error());
		$query=mysql_query("SELECT * FROM student WHERE batch='$batch_id'") or die(mysql_error());
		?>
	<form action='class1.php?action=enroll' method='POST'>		
		<?php
		echo "<input type='hidden' value='".$class_id."' name='class_id'></input>";
		?>
		<select name='category' id='class_id'>
		$o_r_id=0;
		<?php
		while($result=mysql_fetch_array($query))
		{
				extract($result);
		
				$c_r_id=$reg_no;
								
				if($o_r_id!=$c_r_id)
				{
						?>
							<option value=<?php echo $reg_no?>> <?php echo $reg_no?> </option>
						<?php
																			
				$o_r_id=$c_r_id;		
												
				}
								
		}
		
?>				
		</select>		


		
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
			$c=1;//for making the SN in the table
			//$sq="SELECT * FROM class WHERE class_id='$sel'";
			
			
			
			
			$query=mysql_query("SELECT * FROM class WHERE class_id='$class_id'");
			while($result=mysql_fetch_array($query))
			{
				extract($result);
				//now display the information from the db	
				echo"<tr> 
				<td>".$c."</td>
				<td><a href='course.php?course_action=".$course_code."'>".$course_code."</a></td>	
				<td><input type='checkbox' value='".$course_code."' name='set[]'/></td>
				</tr>";						
				$c++;													
			}
			
		?>
												
		</tbody>
	</table>
		
	<button class="btn btn-large btn-primary" name="enroll" type="Submit">Enroll</button>
	<button class="btn btn-large btn-primary" name="edit" type="submit">EDIT</button>
		
</form>

	
