/*Parse number to currency format:
		By JavaScript Kit (www.javascriptkit.com)
		Over 200+ free scripts here!
		*/
		var prefix=""
		var wd
		function parseelement(thisone){
		if (thisone.value.charAt(0)=="$")
		return
		wd="w"
		var tempnum=thisone.value
		for (i=0;i<tempnum.length;i++){
		if (tempnum.charAt(i)=="."){
		wd="d"
		break
		}
		}
		if (wd=="w")
		thisone.value=prefix+tempnum+".00"
		else{
		if (tempnum.charAt(tempnum.length-2)=="."){
		thisone.value=prefix+tempnum+"0"
		}
		else{
		tempnum=Math.round(tempnum*100)/100
		thisone.value=prefix+tempnum
		}
		}
		}
		
		/**--------------------------
		//* Validate Date Field script- By JavaScriptKit.com
		//* For this script and 100s more, visit http://www.javascriptkit.com
		//* This notice must stay intact for usage
		---------------------------**/
		
		function checkdate(input, which){
			var validformat=/^\d{2}\/\d{2}\/\d{4}$/ //Basic check for format validity
			var returnval=false
			if (!validformat.test(input.value)){
				alert("Invalid Date Format. Please correct and submit again.");
				return false;
			}else{ //Detailed check for valid date ranges
				var monthfield=input.value.split("/")[0]
				var dayfield=input.value.split("/")[1]
				var yearfield=input.value.split("/")[2]
				var dayobj = new Date(yearfield, monthfield-1, dayfield)
				if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield)){
					alert("Invalid Day, Month, or Year range detected. Please correct and submit again.");
					return false;
				}
				
			}
			
			var pass=true
			if (document.images){
				for (i=0;i<which.length;i++){
					var tempobj=which.elements[i]
						if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
						pass=false
						break
						}
				}
			}
			<?php
			if($auth_com == "Treasurer" || $auth_com == "Advisor"){
				
			}else{
			?>
			if(!pass){
				alert("One or more of the required elements are not completed. Please complete them, then submit again.")
				return false;
			}
			<?php
			}
			?>
			if (returnval==false){
				input.select();
			}
			var subform = confirm("Please double check the information before submitting it.");
			if(subform){
				return true;
			}else{
				return false;
			}
			return true;
		}