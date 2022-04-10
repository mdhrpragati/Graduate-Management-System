<!--Start of Individual report form query-->
			<div class='well container-fluid span8'	>
 
				<form class="form-horizontal" action="individual.php" method="post">
				<h2 class="form-signin-heading">Individual Report</h2>
					
					<div class="control-group">
						<label class="control-label" for="inputRegistration_number">Registration Number:</label>
							<div class="controls">
								
								<input type="text"  name="inputRegistration_number" id="inputRegistration_number" placeholder="Registration Number" required >
								<p class="text-error"><?php if($act=='view_individual_error') echo "Registration Number Not found."; ?></p>
							</div>
					</div>

					<div class="control-group">
						<div class="controls">
							 <button type="submit" class="btn">Generate</button>
						</div>
					</div>

				</form>
			</div>	
			<!--End of Individual-->