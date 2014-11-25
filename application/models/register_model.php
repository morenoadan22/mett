<?php

/**
 * RegisterModel
 * This is a simple register and unregistered demonstration.
 */
class RegisterModel
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
     * Register a student to an upcoming exam.
     * 
     * @param int $examId the exam schedule id
     * @param long $redId the redId of the student 
     * @return boolean feedback (was the student registered propertly?)
     */
	public function register($examId){
		if(!isset($examId)){
			$examId = -1;
		}
		
		$sql = "INSERT INTO student_exam (red_id, exam_schedule, score, pass) VALUES (:red_id, :exam_schedule, 0.0, 0)";
		$query = $this->db->prepare($sql);
		$query->execute(array(':red_id' => $_SESSION['red_id'], ':exam_schedule' => $examId));

		$count =  $query->rowCount();
		if ($count == 1) {
			return true;
		} else {
			$_SESSION["feedback_negative"][] = FEEDBACK_STUDENT_REGISTER_FAILED;
		}
		// default return
		return false;
	}
	
	
	/**
	 * Unregister a student from an upcoming exam.
	 *
	 * @param int $studentExamId the student exam schedule id
	 * @return boolean feedback (was the student unregistered propertly?)
	 */
	public function unregister($studentExamId)
	{
		$sql = "DELETE FROM student_exam WHERE id = :student_exam";
		$query = $this->db->prepare($sql);
		$query->execute(array(':student_exam' => $studentExamId));
		$count =  $query->rowCount();

        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_STUDENT_UNREGISTER_FAILED;
        }
        // default return
        return false;
	}

}