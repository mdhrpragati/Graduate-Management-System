<form action='teacher.php?action=edit' method='POST'>
	<select name='teacher_email'>
			<OPTION value='1'>-
			
		
			<?php
					$sql="SELECT * FROM teacher_detail WHERE 1 ORDER BY first_name ASC";
					$q=mysql_query($sql) or die(mysql_error());
					$loop=mysql_num_rows($q);
					
					while($loop!=0)
					{
						$data=mysql_fetch_array($q);
						extract($data);
						echo "<OPTION value='".$email_id."'>".$first_name." ".$last_name;	
						$loop=$loop-1;
					}
			?>
	</select><br>
	<button class="btn btn-primary" name="change" type="Submit">Change</button>	
</form>

