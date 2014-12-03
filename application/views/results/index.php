<div class="content">
    <h1>Exam Results</h1>
    <h3>List of the exam scores.</h3>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <form method="post" action="<?php echo URL;?>note/create">
        <label>Exam Result: </label><input type="text" name="note_text" />
        <input type="submit" value='Create this note' autocomplete="off" />
    </form>

</div>
