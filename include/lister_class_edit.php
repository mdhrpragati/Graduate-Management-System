
<table class="table table-hover">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Class Code</th>
                  <th>Batch</th>
                  <th>Semester</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$sql="SELECT * FROM class WHERE 1 ORDER BY class_id ASC";
					$q=mysql_query($sql) or die(mysql_error());
					$loop=mysql_num_rows($q);
					$c=1;
					$o_id=0;
					while($loop!=0)
					{
						$data=mysql_fetch_array($q);
						
						
						$c_id=$data['class_id'];
						
						//echo $o_id."    ".$c_id."</br>";
						
						if($o_id!=$c_id)
						{
							$ta=$data['semester'];
							switch($ta)
							{
								case 1:
									$sem="First";
									break;
								case 2:
									$sem="Second";
									break;
								case 3:
									$sem="Third";
									break;
								case 4:
									$sem="Fourth";
									break;
							}		
							echo"<tr> 
								<td>".$c."</td>
								<td><a href='edit_class.php?course_action=".$c_id."'>".$data['class_id']."</a></td>	
								<td>".$data['batch']."</td>
								<td>".$sem."</td>
								</tr>";	
								
								$o_id=$c_id;		
								$c++;		
						}			
						$loop=$loop-1;
						
					}
				?>
				
              </tbody>
</table>
