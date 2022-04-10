	var xmlhttp = new XMLHttpRequest();
	
	function process()
	{
		course = document.getElementById('course').value;
		xmlhttp.open('GET','search_course.php?course='+course,'true');
		xmlhttp.onreadystatechange = handle;
		xmlhttp.send();
		//setTimeout('process()',1000);
	}
	
	function handle()
	{
		message = xmlhttp.responseText;
		document.getElementById('result').innerHTML = message;
	}
	

	
