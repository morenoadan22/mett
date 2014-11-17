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
	public function register($examId, $redId){
		$sql = "INSERT INTO studentExams (redId, examSchedule, score, pass) VALUES (:red_id, :exam_schedule, 0.0, 0)";
		$query = $this->db->prepare($sql);
		$query->execute(array(':red_id' => 'red_Id', ':exam_schedule' => $examId));

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
	 * Overloaded version of register(examId, redId)
	 * @param int $examId
	 * @return boolean
	 */
	public function register($examId){
		return $this->register($examId, $_SESSION['red_Id']);
	}
	
	/**
	 * Unregister a student from an upcoming exam.
	 *
	 * @param int $examId the exam schedule id
	 * @param long $redId the redId of the student
	 * @return boolean feedback (was the student unregistered propertly?)
	 */
	public function unregister($examId, $redId){
		$sql = "DELETE FROM studentExams WHERE examSchedule = :exam_schedule AND redId = :red_id";
		$query = $this->db->prepare($sql);
		$query->execute(array(':exam_schedule' => $examId, ':red_id' => $redId));
		$count =  $query->rowCount();

        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_DELETION_FAILED;
        }
        // default return
        return false;
	}
	
	/**
	 * Overloaded version of unregiser(examId, redId)
	 * @param int $examId the exam schedule id
	 * @return boolean feedback (was the student unregistered propertly?)
	 */
	public function unregister($examId){
		return $this->unregister($examId, $_SESSION['red_Id']);		
	}

}