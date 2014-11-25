<?php

/**
 * ScheduleModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class ScheduleModel
{
    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * Get all exams associated with the current session's user.
     * @return array an array with serveral exam objects
     */
    public function getUserExams()
    {
    	$sql = "select exam_type, location, date, time, semester, year, score, pass from student_exam
				join exam_schedule on student_exam.exam_schedule = exam_schedule.id where student_exam.red_id = :red_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':red_id' => $_SESSION['red_id']));

    	return $query->fetchAll();
    }

    /**
     * Getter for all exams (exams are an implementation of example data, in a real world application this
     * would be data that the user has created)
     * @return array an array with several objects (the results)
     */
    public function getAllSchedules()
    {
        $sql = "SELECT user_id, exam_id, exam_text FROM exams WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $_SESSION['user_id']));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Getter for a single exam
     * @param int $exam_id id of the specific exam
     * @return object a single object (the result)
     */
    public function getSchedule($exam_id)
    {
        $sql = "SELECT user_id, exam_id, exam_text FROM exams WHERE user_id = :user_id AND exam_id = :exam_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $_SESSION['user_id'], ':exam_id' => $exam_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Setter for a exam (create)
     * @param string $exam_text exam text that will be created
     * @return bool feedback (was the exam created properly ?)
     */
    public function create($exam_text)
    {
        // clean the input to prevent for example javascript within the exams.
        $exam_text = strip_tags($exam_text);

        $sql = "INSERT INTO exams (exam_text, user_id) VALUES (:exam_text, :user_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':exam_text' => $exam_text, ':user_id' => $_SESSION['user_id']));

        $count =  $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }

    /**
     * Setter for a exam (update)
     * @param int $exam_id id of the specific exam
     * @param string $exam_text new text of the specific exam
     * @return bool feedback (was the update successful ?)
     */
    public function editSave($exam_id, $exam_text)
    {
        // clean the input to prevent for example javascript within the exams.
        $exam_text = strip_tags($exam_text);

        $sql = "UPDATE exams SET exam_text = :exam_text WHERE exam_id = :exam_id AND user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':exam_id' => $exam_id, ':exam_text' => $exam_text, ':user_id' => $_SESSION['user_id']));

        $count =  $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_EDITING_FAILED;
        }
        // default return
        return false;
    }

    /**
     * Deletes a specific exam
     * @param int $exam_id id of the exam
     * @return bool feedback (was the exam deleted properly ?)
     */
    public function delete($exam_id)
    {
        $sql = "DELETE FROM exams WHERE exam_id = :exam_id AND user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':exam_id' => $exam_id, ':user_id' => $_SESSION['user_id']));

        $count =  $query->rowCount();

        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_DELETION_FAILED;
        }
        // default return
        return false;
    }
}
