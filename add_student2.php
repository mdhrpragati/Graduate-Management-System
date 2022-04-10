<?php
		$field_id = $_GET['field_id']; //first_name
		$field_id_value = $_GET['field_id_value']; //Roshan
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"standalone="yes" ?>';
?>
		<response>
			<image_loc>
			<?php
				if($field_id=='first_name' || $field_id=='last_name')
				{
						if(!$field_id_value)
						{
							//empty
							echo 'images/cross.jpg';
						}
						else
						{
							if(is_numeric($field_id_value))
							{
									echo 'images/cross.jpg';
							}
							else
							{
									echo 'images/ok.jpg';
							}

						}
				}
				
				elseif( $field_id=='middle_name')
				{
						if(!$field_id_value)
						{
							//empty
							//echo 'images/cross.jpg';
						}
						else
						{
							if(is_numeric($field_id_value))
							{
									echo 'images/cross.jpg';
							}
							else
							{
									echo 'images/ok.jpg';
							}

						}
				}

				elseif($field_id=='batch')
				{
						if(!$field_id_value)
						{
								//empsty
								echo 'images/cross.jpg';
						}
						else
						{
							if(is_numeric($field_id_value) && strlen($field_id_value)==4)
							{
									echo 'images/ok.jpg';
							}
							else
							{
									echo 'images/cross.jpg';
							}
						}
				}

				/*elseif($field_id=='cell_no')
				{
						if(!$field_id_value)
						{
								//empsty
								echo 'images/cross.jpg';
						}
						else
						{
							if(is_numeric($field_id_value) && strlen($field_id_value)==10)
							{
									echo 'images/ok.jpg';
							}
							else
							{
									echo 'images/cross.jpg';
							}
						}
				}

				elseif($field_id=='landline')
				{
						if(!$field_id_value)
						{
								//empsty
								echo 'images/cross.jpg';
						}
						else
						{
							if(is_numeric($field_id_value) && strlen($field_id_value)==6)
							{
									echo 'images/ok.jpg';
							}
							else
							{
									echo 'images/cross.jpg';
							}
						}
				}*/

				elseif($field_id=='reg_no_second')
				{
					if(!$field_id_value)
					{
								//empsty
					}
					else
					{
							if(is_numeric($field_id_value) && strlen($field_id_value)==2)
							{
									echo 'images/ok.jpg';
							}
							else
							{
									echo 'images/cross.jpg';
							}
					}
				}

				elseif($field_id=='reg_no_first')
				{
					if(!$field_id_value)
					{
								//empsty
					}
					else
					{
							if(is_numeric($field_id_value) && strlen($field_id_value)==6)
							{
									echo 'images/ok.jpg';
							}
							else
							{
									echo 'images/cross.jpg';
							}
					}
				}
			?>
			</image_loc>				
		</response> 
<?php ?>
