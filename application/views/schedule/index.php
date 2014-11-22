<head>
		<meta charset="UTF-8"/>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../public/js/schedule.js"></script>
</head>

<body>
	
	<h1>Schedule</h1>
	
	 <!-- echo out the system feedback (error and success messages) -->
	 <?php $this->renderFeedbackMessages(); ?>
	
	<form method="post" action="<?php echo URL;?>note/create">			
		<input type="submit" value='Add Exam' autocomplete="off" />
	</form>
	
	
	<select id="selectYear"></select>
	<select id="selectSemester"></select>
	
	
	<table id="table">
		<tr><th>EXAM TYPE</th><th>LOCATION</th><th>STUDENT COUNT</th><th>DATE</th></tr>
		<?php
			if ($this->schedules) {
				foreach($this->notes as $key => $value) {
					echo '<tr>';
					echo '<td>' . htmlentities($value->note_text) . '</td>';
					echo '<td><a href="'. URL . 'note/edit/' . $value->note_id.'">Edit</a></td>';
					echo '<td><a href="'. URL . 'note/delete/' . $value->note_id.'">Delete</a></td>';
					echo '</tr>';
				}
			} else {
				echo 'No notes yet. Create some !';
			}
		?>
		</table>
	
		
</body>
	
	


