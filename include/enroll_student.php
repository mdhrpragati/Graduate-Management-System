<select name='category' id='class_id' onchange='process1();'>

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
<div id="student_list"></div>
