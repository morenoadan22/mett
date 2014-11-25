<div class="content">
    <h1>Edit an Exam Schedule</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <?php if ($this->schedule) { ?>
        <form method="post" action="<?php echo URL; ?>schedule/editSave/<?php echo $this->schedule->exam_id; ?>">
        	<label>Room Number</label>
        	<input type="text" name="textLocation" value="<?php echo htmlentities($this->schedule->location)?>"/>
            <label>Date</label>
            <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
            <input type="date" name="textDate" value="<?php echo htmlentities($this->schedule->date); ?>" />
            <label>Time</label>
            <input type="time" name="textTime" value="<?php echo htmlentities($this->schedule->time);?>" /><br>
            <input type="submit" value='Change'/>
        </form>
    <?php } else { ?>
        <p>This note does not exist.</p>
    <?php } ?>
</div>
