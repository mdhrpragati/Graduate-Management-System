<?php
	
	class course{
		
		var $course_code;
		var $course_name;
		var $credit;
		var $description;
		
		function enter_data($cc,$cn,$c,$d){
			$this->course_code=$cc;
			$this->course_code=$cn;
			$this->course_code=$c;
			$this->course_code=$d;
		}
		function update($cc,$cn,$c,$d)
		{
			$this->course_code=$cc;
			$this->course_code=$cn;
			$this->course_code=$c;
			$this->course_code=$d;	
		}
		
	}
	class classes{
		var $class_name;
		var $batch;
		var $level;
		var $course_description;
	}
	class teacher{
		var $email;
		var $first_name;
		var $last_name;
		var $department;
		var $designation;
			
	}
	
	class student{
		var $reg_no;
		var $first_name;
		var $middle_name;
		var $nationality;
		var $dob;
		var $doe;
		var $batch;
		var $permanent_address;
		var $temporary_address;
		var $cell_no;
		var $landline;
		var $photo;
		var $past_document;



		
		function enter_data($cc,$cn,$c,$d){
			$this->course_code=$cc;
			$this->course_code=$cn;
			$this->course_code=$c;
			$this->course_code=$d;
		}
		function update($cc,$cn,$c,$d)
		{
			$this->course_code=$cc;
			$this->course_code=$cn;
			$this->course_code=$c;
			$this->course_code=$d;	
		}
		
	}
	
	class marks{
		var $reg_no;
		var $course_code;
		var $grade;
		function enter_marks($rn,$cc,$g){
			$this->reg_no=$rn;
			$this->course_code=$cc;
			$this->grade=$g;
		}
	}
?>
