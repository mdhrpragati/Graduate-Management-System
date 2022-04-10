
<table class="table table-hover">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Teachers Name</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$sql="SELECT * FROM teacher_detail WHERE 1 ORDER BY first_name ASC";
					$q=mysql_query($sql) or die(mysql_error());
					$loop=mysql_num_rows($q);
					$c=1;
					while($loop!=0)
					{
						$data=mysql_fetch_array($q);
						
						echo"<tr> 
								<td>".$c."</td>
								
								<td>".$data['first_name']."  ".$data['last_name']."</td>
								<td>".$data['department']."</td>
								<td>".$data['designation']."</td>
								<td>".$data['email_id']."</td>
							
							</tr>";	
						$loop=$loop-1;
						$c++;
					}
				?>
				
              </tbody>
</table>
