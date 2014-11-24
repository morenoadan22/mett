<head>
    <meta charset="UTF-8"/>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../public/js/schedule.js"></script>
</head>

<body>
	
	<h1>Schedule</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); ?>
	
	<form method="post" action="<?php echo URL;?>schedule/addSchedule" onSubmit="return validateFormOnSubmit(this)">
		<label for="selectExamType">Exam Type:</label>
		<select name="selectExamType">
			<option val="0">--Select One--</option>
			<?php 
				if($this->examTypes){
					foreach($this->examTypes as $key=> $value){
						echo '<option val="';
						echo htmlentities($value->id) . '">';
						echo htmlentities($value->type);
						echo '</option>';
					}
				}
			?>
		</select>
		<input name="textLocation" type="text" placeholder="LOCATION">
		<input name="textDate" type="date">
		<input name="textTime" type="time">
		<label for="selectSemester">Semester:</label><select name="selectSemester">
			<option val="FALL">Fall</option>
			<option val="SPRING">Spring</option>
			<option val="SUMMER">Summer</option>
		</select>	
		<label for="selectYear">Year:</label><select name="selectYear"></select>		
		<input type="submit" value='Add Exam' autocomplete="off" />
	</form>
	
	
	<h1 style="margin-top: 50px;">List of Exam Schedules</h1>
	
	<table id="table">
		<tr><th>EXAM TYPE</th><th>LOCATION</th><th>STUDENT COUNT</th><th>DATE</th></tr>
		<?php
			if ($this->schedules) {
				foreach($this->schedules as $key => $value) {
					echo '<tr>';
					echo '<td>' . htmlentities($value->exam_type) . '</td>';
					echo '<td>' . htmlentities($value->location) . '</td>';
					echo '<td>' . htmlentities($value->student_count) . '</td>';
					echo '<td>' . htmlentities($value->date) . '</td>';
					echo '<td>' . htmlentities($value->time) . '</td>';
					echo '<td><a href="'. URL . 'schedule/edit/' . $value->id.'">Edit</a></td>';
					echo '<td><a href="'. URL . 'schedule/delete/' . $value->id.'">Delete</a></td>';
					echo '</tr>';
				}
			} else {
				echo 'No exams have been scheduled yet.';
			}
		?>
		</table>
	
		
</body>
	
	


