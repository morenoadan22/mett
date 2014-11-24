$(document).ready(function(){
	populateYears();
});

function populateYears(){
	var today = new Date();
	var yearfield = document.getElementById("years");
    var year = 1990;
    for(var y = 0; y < 30; y++){
		yearfield.options[y] = new Option(year, year);
		year += 1;
	}
	yearfield.options[0] = new Option(today.getFullYear(), today.getFullYear(), true,true);
	
}

function validateFormOnSubmit(form){
	var valid = true;
	if($("[name='selectExamType']").val() == 0){
		valid = false;
		$("[name='selectExamType']").addClass("error");		
	}
		
	
	return valid;
}