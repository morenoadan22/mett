<head>
    <meta charset="UTF-8"/>
		
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	
</head>

<body>
	
	<h1>Available Exams</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); ?>
	
	
	<ul id="availableExamTypes">
		<?php
			function isEnrolled($exam_type, $pastExams){
				foreach($pastExams as $key => $value){
					if($value->exam_type == $exam_type){
						return true;
					}
				}				
				return false;
			}
		
			if($this->examTypes){
				foreach($this->examTypes as $key => $value){
					if(isEnrolled($value->id, $this->pastExams)){
						echo '<li class="enrolled">';
					}else{
						echo '<li>';
					}
					echo htmlentities($value->type) . '</li>';				
				}		
			}
		?>
	</ul>
	
			
</body>