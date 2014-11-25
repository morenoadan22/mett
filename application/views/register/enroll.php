<head>
    <meta charset="UTF-8"/>
		
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../public/js/register.js"></script>	
</head>

<body>
	
	<h1>Exam Options</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); 
		
		function isEnrolled($studentExamId, $pastExams)
		{
	 		foreach($pastExams as $key => $value){
	 			if($value->student_exam_id == $studentExamId){
	 				return true;
	 			}
	 		}
	 		return false;
	 	}
	 ?>
	
	<table id="studentTable">
		<tr><th>EXAM TYPE</th><th>ROOM</th><th>STUDENT COUNT</th><th>DATE</th><th>TIME</th></tr>
		<?php
			if ($this->examOptions) {
				foreach($this->examOptions as $key => $value) {
					echo '<tr>';
					echo '<td>' . htmlentities($value->exam_type) . '</td>';
					echo '<td>' . htmlentities($value->location) . '</td>';
					echo '<td>' . htmlentities($value->student_count) . '</td>';
					echo '<td>' . htmlentities($value->date) . '</td>';
					echo '<td>' . htmlentities($value->time) . '</td>';
					if(isEnrolled($value->student_exam_id, $this->pastExams)){
						echo '<td><input type="button" onClick="parent.location="'. URL . 'register/enrollRemove/' . $value->student_exam_id.'" value="Unregister"/></td>';
					}else{
						echo '<td><input type="button" onClick="parent.location="' . URL . 'register/enrollSave/' . $value->id . '" value="Enroll" /></td>';
					}
					echo '</tr>';
				}
			} else {
				echo 'No exams have been scheduled yet.';
			}
		?>
	</table>	
			
</body>