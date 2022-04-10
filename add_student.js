        function process()
        {
                reg_no_first = document.getElementById('reg_no_first').value;
                reg_no_second = document.getElementById('reg_no_second').value;
                first_name = document.getElementById('first_name').value;
               // middle_name = document.getElementById('middle_name').value;
                last_name = document.getElementById('last_name').value;
                nationality = document.getElementById('nationality').value;
                batch = document.getElementById('batch').value;
				email_address = document.getElementById('email_address').value;
				password = document.getElementById('password').value;
                //permanent_address = document.getElementById('permanent_address').value;
                //temporary_address = document.getElementById('temporary_address').value;
                //cell_no = document.getElementById('cell_no').value;
                //landline = document.getElementById('landline').value;

                var error = new Array();

                if(isNaN(reg_no_first) || reg_no_first.length!=6 || isNaN(reg_no_second) || reg_no_second.length!=2)
                {
                        error.push("Registration should always be in numeric form and exactly 8 digits");  
                }


                if(!isNaN(first_name) || !isNaN(last_name))
                {
                        error.push("Name should compulsorily be a string");  
                }

                if(!isNaN(nationality)) 
                {
                        error.push("Use string for nationality");  
                }

                if(isNaN(batch) || batch.length!=4) 
                {
                        error.push("Batch should be a 4 digit year");  
                }
/
                /*if(!isNaN(permanent_address) || !isNaN(temporary_address))
                {
                        error.push("Addresss should compulsorily be a string");  
                }

                if(isNaN(cell_no) || cell_no.length!=10) 
                {
                        error.push("Mobile Number should be a 10 digit number");  
                }

                if(isNaN(landline) || (landline.length<6 || landline.length>=10)) 
                {
                        error.push("Landline Number should be a 6-8 digit number");  
                }
				*/



                if(error.length==0)
                {
                    return true;
                }
                else
                {
                    var final = error.join('\n');
                    alert(final);
                    return false;
                }
        }
