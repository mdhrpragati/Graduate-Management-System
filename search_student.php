<?php
	include 'include/connect.php';
	$student = $_GET['student'];

	if(!$student)
	{	
		echo "Please enter a search query for course code.";
	}
	else
	{
		$query=mysql_query("SELECT * FROM student WHERE reg_no='$student'");
		$rows = mysql_num_rows($query);
		if(!$rows)
		{
			echo "Student not found";
		}
		else
		{
				while($result=mysql_fetch_array($query))
				{
					extract($result);
?>
				<form class="form-horizontal" onsubmit='return confrm()' method="POST" action="edit_student.php">
					<fieldset>
					<!--Registration number-->
					  <div class="control-group">
						<label class="control-label" for="reg_no">Registration Number</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="reg_no" name="reg_no" value="<?php echo $reg_no ?>" readonly> 
						</div>
					  </div>
					  
					  <div id="dynamic"></div>
					  <!--First Name-->
						  <div class="control-group">
						<label class="control-label" for="first_name">First Name</label>
						<div class="controls">
						  <input type="text" value="<?php echo $first_name; ?>"class="input-xlarge" id="first_name" name="first_name">
						</div>
					  </div>
					  
					  <!--Middle Name-->
						  <div class="control-group">
						<label class="control-label" for="middle_name">Middle Name</label>
						<div class="controls">
						  <input type="text" value="<?php echo $middle_name; ?>" class="input-xlarge" id="middle_name" name="middle_name">
						</div>
					  </div>
					  
					  
					  <!--Last name-->
						  <div class="control-group">
						<label class="control-label" for="last_name">Last Name</label>
						<div class="controls">
						  <input type="text" value="<?php echo $last_name; ?>"class="input-xlarge" id="last_name" name="last_name">
						</div>
					  </div>
					  
					  
					  <!--Nationality-->
								 <div class="control-group">
						<label class="control-label" for="select01">Nationality</label>
						<div class="controls">
						  <select id="select01" name="nationality">
							<option value="Nepali">Nepali</option>
							<option value="India">India</option>
							<option value="Others">Others</option>
						  </select>
						</div>
					  </div>
					  
					  
					  <!--Date of birth-->
							   <div class="control-group">
						<label class="control-label" for="select01">Date of Birth : </label>
						<div class="controls">
					<input type="date" value="<?php echo $dob; ?>" name="dob">
						</div>
					  </div>
					  
					  
					  <!--Date of enroll-->
							   <div class="control-group">
						<label class="control-label" for="select01">Date of Enroll: </label>
						<div class="controls">
					<input type="date" value="<?php echo $doe; ?>"name="doe">
						</div>
					  </div>
					  
					  
					  <!--Batch-->
					  <div class="control-group">
						<label class="control-label" for="last_name">Batch : </label>
						<div class="controls">
						  <input type="text" value="<?php echo $batch; ?>" class="input-xlarge" id="batch" name="batch">
						</div>
					  </div>
					  
					  
					  <!--Permanent address-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Permnanent address</label>
						<div class="controls">
						  <input type="text" value="<?php echo $permanent_address; ?>" class="input-xlarge" id="permanent_address" name="permanent_address">
						</div>
					  </div>
					  
					  
						  <!--Temporary address-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Temporary address</label>
						<div class="controls">
						  <input type="text" value="<?php echo $temporary_address; ?>" class="input-xlarge" id="temporary_address" name="temporary_address">
						</div>
					  </div>
					  
						  <!--Cell. no.-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Mobile No. </label>
						<div class="controls">
						  <input type="text" value="<?php echo $cell_no; ?>" class="input-xlarge" placeholder="Exactly 10 digits" id="cell_no" name="cell_no">
						</div>
					  </div>
					  
						  <!--Landline Number-->
							  <div class="control-group">
						<label class="control-label" for="last_name">Landline Number</label>
						<div class="controls">
						  <input type="text" value="<?php echo $landline; ?>" class="input-xlarge" id="landline" name="landline">
						</div>
					  </div>
					   
					   <!--Email Address-->
						  <div class="control-group">
						<label class="control-label" for="email_address">Email Address</label>
						<div class="controls">
						  <input type="text" value="<?php echo $email_address; ?>" class="input-xlarge" id="email_address" name="email_address">
						</div>
					  </div>
					  
					  <!--Password-->
						  <div class="control-group">
						<label class="control-label" for="password">Password *</label>
						<div class="controls">
						  <input type="text" class="input-xlarge" id="password" name="password" required>
						</div>
					  </div

					  <!--form actions-->
					  <div class="form-actions">
						<button type="submit" class="btn btn-primary" name="update">Update Information !!!</button>
						<button type="submit" class="btn btn-danger" name="delete">Delete Student !!!</button>
					  </div>
					</fieldset>
				  </form>
	<?php
					
				}
		}
	}
	
?>
