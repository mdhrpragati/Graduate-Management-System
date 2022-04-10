			var xmlhttp = new XMLHttpRequest();
			function process1()
			{
				
				class_id = document.getElementById('class_id').value;
				xmlhttp.open('GET','include/enroll_student2.php?class_id='+class_id,true);
			
				xmlhttp.onreadystatechange = handle;
				xmlhttp.send();
				//setTimeout('process()',1000);
				//alert('ddd');
			}
			
			function handle()
			{
				message = xmlhttp.responseText;
				document.getElementById("student_list").innerHTML=message;
				//document.write(message);
			}
