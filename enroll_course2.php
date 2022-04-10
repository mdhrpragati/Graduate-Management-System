<?php
		include ('include/connect.php');
		$class_id=$_GET['class_id'];
		echo $class_id;
		echo "Student list :";
		$query=mysql_query("SELECT * FROM student_grade WHERE class_id='$class_id'") or die(mysql_error());
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


	
