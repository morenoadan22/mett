/**
 * 
 */
$(document).ready(function(){
	$("#buttonEnroll").on('click', function(e){
		window.location.href = "enroll";
	});
	
});

function handleEnrollment(examId){
	window.location.href = "enrollSave/" + examId;
}

function handleUnregister(studentExamId){
	window.location.href = "enrollRemove/" + studentExamId;
}
