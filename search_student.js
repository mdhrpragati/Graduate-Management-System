	var xmlhttp = new XMLHttpRequest();
	
	function process()
	{
		student = document.getElementById('student').value;
		xmlhttp.open('GET','search_student.php?student='+student,'true');
		xmlhttp.onreadystatechange = handle;
		xmlhttp.send();
		//setTimeout('process()',10);
	}
	
	function handle()
	{
		message = xmlhttp.responseText;
		document.getElementById('result').innerHTML = message;
	}
	
