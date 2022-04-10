<!--Start of Classwise report form query-->
				<div class='well container-fluid span8'	>
					
					<form class="form-horizontal" action="classwise2.php" method="post">								    
					<h2 class="form-signin-heading">Classwise Report</h2>
												
						<div class="control-group">
							<label class="control-label" for="inputBatch">Batch:</label>
								<div class="controls">			    		
									<select name="inputBatch" id="inputBatch">
									<?php
										if(count($Batch)==0)
										{
											?><option><?php echo "Database empty"; ?></option><?php
										}
										else
											{
												foreach($Batch as $single)
												{
													 ?><option><?php echo $single ?></option><?php
												}
											}
									?>
									</select>
								</div>
						</div>

						 <div class="control-group">
							<label class="control-label" for="inputSemester">Semester:</label>
								<div class="controls">
									<select name="inputSemester" id="inputSemester">
										<?php
											if(count($Semester)==0)
											{
												?><option><?php echo "Database empty"; ?></option><?php
											}
											else
											{
												foreach($Semester as $single)
												{
													?><option><?php echo $single ?></option><?php
												}
											}	    			
										?>
									</select>
									<p class="text-error"><?php if($act=='view_classwise_error') echo "Invalid Combination"; ?></p>
								</div>
						</div>

						<div class="control-group">
							<div class="controls">
								 <button type="submit" class="btn">Generate</button>
							</div>
						</div>

					</form>
				</div>
			<!--End of Classwise-->	