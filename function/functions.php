<?php
	
	
	
	function confirm_query($result_set) //Checks if the mysql query is successful and exits if not
	{
		if(!$result_set)
		{
			die("Database query failed: ".mysql_error());
		}
	}
	
	function convert($str) //To convert 1s2013 to Batch 2013 First Semester and vice versa
	{
		if (strlen($str) == 6) {
			$temp = explode("s", $str);
			$output = "Batch " . $temp[1];
			switch ($temp[0]) {
				case '1':
					$output .= " First";
					break;
				case '2':
					$output .= " Second";
					break;
				case '3':
					$output .= " Third";	
					break;
				case '4':
					$output .= " Fourth";
					break;
				case '5':
					$output .= " Fifth";
					break;
				case '6':
					$output .= " Sixth";
					break;
				case '7':
					$output .= " Seventh";
					break;
				case '8':
					$output .= " Eighth";
					break;
			}
			$output .= " Semester";
		}//end of if
		else //If "Batch 2013 Third Semester is passed"
		{
			$temp = explode(" ", $str);
			switch ($temp[1]) {
				case 'First':
					$output = "1";
					break;
				case 'Second':
					$output = "2";
					break;
				case 'Third':
					$output = "3";
					break;
				case 'Fourth':
					$output = "4";
					break;
				case 'Fifth':
					$output = "5";
					break;
				case 'Sixth':
					$output = "6";
					break;
				case 'Seventh':
					$output = "7";
					break;
				case 'Eighth':
					$output = "8";
					break;
			}
			$output .= "s" . $temp[1];
		}
		return $output;
	}

	// echo convert("1s2013") . "<br />";
	// echo convert("Batch 2013 First Semester") . "<br />";
?>
