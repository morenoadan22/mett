<head>
    <meta charset="UTF-8"/>
	
	<link rel="stylesheet" href="../public/css/schedule.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../public/js/schedule.js"></script>
</head>

<body>
	
	<h1>Schedule</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); ?>
	
	<form method="post" action="<?php echo URL;?>schedule/addSchedule" onSubmit="return validateFormOnSubmit(this)">
		<label for="selectExamType">Exam Type</label>
		<select name="selectExamType">
			<option value="0">--Select One--</option>
			<?php 
				if($this->examTypes){
					foreach($this->examTypes as $key=> $value){
						echo '<option value="';
						echo htmlentities($value->id) . '">';
						echo htmlentities($value->type);
						echo '</option>';
					}
				}
			?>
		</select>
		<label for="textLocation">Room Number</label><input name="textLocation" type="text">
		<label for="textDate">Date</label><input name="textDate" type="date">
		<label for="textTime">Time</label><input name="textTime" type="time">
		<label for="selectSemester">Semester</label><select name="selectSemester">
			<option value="FALL">Fall</option>
			<option value="SPRING">Spring</option>
			<option value="SUMMER">Summer</option>
		</select>	
		<label for="selectYear">Year</label><select id="years" name="selectYear"></select>		
		<input type="submit" value='Add Exam' autocomplete="off" />
	</form>
	
	
	<h1 style="margin-top: 50px;">List of Exam Schedules</h1>
	
	<table id="examTable">
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
	
	


