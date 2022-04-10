<?php
	if(isset($_POST['Select']))
	{
		$act=$_POST['class_id'];
		echo $act;	
	}
	else if(isset($_POST['go']))
	{
		
	}



?>

<form action='class1.php?action=enroll' method='POST'>

	
	
	<select name='category' id='class_id' >
	<?php
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

	</select>	
	<button class="btn btn-large btn-primary" name="Select" type="submit">GO</button>
</form>



<form action='class1.php?action=enroll' method='POST'>
		<input type='text' name='reg_id' placeholder='Reg NO'></input>
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
			$query=mysql_query("SELECT * FROM class WHERE class_id='$act'");
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
			echo"<input name='class_code' value=".$act.">";
		?>
												
		</tbody>
	</table>
		
	<button class="btn btn-large btn-primary" name="enroll" type="Submit">Enroll</button>
		
</form>
