<head>
    <meta charset="UTF-8"/>
		
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../public/js/register.js"></script>	
</head>

<body>
	
	<h1>Enroll</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); 
		
		function isEnrolled($exam_type, $pastExams)
		{
	 		foreach($pastExams as $key => $value){
	 			if($value->exam_type == $exam_type){
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
					echo '<td><a href="'. URL . 'register/enrollSave/' . $value->id.'">Enroll</a></td>';
					echo '<td><a href="'. URL . 'register/enrollRemove/' . $value->student_exam_id.'">Unregister</a></td>';
					echo '</tr>';
				}
			} else {
				echo 'No exams have been scheduled yet.';
			}
		?>
	</table>	
			
</body>