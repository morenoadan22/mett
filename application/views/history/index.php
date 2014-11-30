<div class="content">
	
	<h1 style="margin-top: 50px;">List of Previous Exams</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <table>
    <thead><th>Semester</th><th>Exam Type</th><th>Score</th><th>Result</th></thead>
    <?php
        if ($this->pastExams) {
            foreach($this->pastExams as $key => $value) {
                echo '<tr>';
                echo '<td>' . htmlentities($value->semester . '-' . $value->year) . '</td>';
                echo '<td>' . htmlentities($value->examType) . '</td>';
                echo '<td>' . htmlentities($value->score) . '</td>';
                echo '<td>' . htmlentities(($value->pass) == 1 ? 'PASS' : 'FAILED') . '</td>';
                echo '</tr>';
            }
        } else {
            echo 'No previous exam history.';
        }
    ?>
    </table>
</div>
