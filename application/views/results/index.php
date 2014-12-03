<div class="content">
    <h1>Exam List</h1>
    <h3>List of the exam results you now enroll in.</h3>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <form method="post" action="<?php echo URL;?>note/create">
        <label>Text of new note: </label><input type="text" name="note_text" />
        <input type="submit" value='Create this note' autocomplete="off" />
    </form>

    <h1 style="margin-top: 50px;">List of your previous exam.</h1>

    <table class = "table">
    <?php
        if ($this->notes) {
            foreach($this->notes as $key => $value) {
                echo '<tr>';
                echo '<td>' . htmlentities($value->note_text) . '</td>';
                echo '<td><a href="'. URL . 'note/edit/' . $value->note_id.'">Edit</a></td>';
                echo '<td><a href="'. URL . 'note/delete/' . $value->note_id.'">Delete</a></td>';
                echo '</tr>';
            }
        } else {
            echo 'No exam registered yet. Register now!';
        }
    ?>
    </table>
</div>
