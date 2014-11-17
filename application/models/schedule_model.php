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
     * Gets the number of available seats for an upcoming exam.
     * 
     * @param int $examId the exam schedule id
     * @return the number of seats that are available for that particular exam
     */
    public function getAvailableSeats($examId)
    {
    	$studentCount = $this->getStudentCount($examId);
    	
    	$sql = "SELECT seats FROM examSchedule WHERE id = :exam_schedule";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_schedule' => $examId));
    	
    	return $query->fetch() - $studentCount;    	
    }   
    
    
    /**
     * Getter for a single exam
     * @param int $exam_id id of the specific exam
     * @return object a single object (the result)
     */
    public function getExamSchedule($exam_id)
    {
    	$sql = "SELECT id, examType, location, seats, date, time, semeseter, year AND exam_id = :exam_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_id' => $exam_id));
    
    	// fetch() is the PDO method that gets a single result
    	return $query->fetch();
    }
    
    
    /**
     * Gets the student count for an upcoming exam.
     * 
     * @param int $examId the exam schedule id
     * @return the int count of studentexam records linked to an exam.
     */
    public function getStudentCount($examId)
    {
    	$sql = "SELECT count(*) FROM studentExam WHERE examSchedule = :exam_schedule";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_schedule' => $examId));
    	
    	return $query->fetch();
    }
    
    
    /**
     * Getter for the upcoming exams for a particular semester and year
     * 
     * @param string $semester
     * @param int $year
     * @return array an array with several objects (the results)
     */
    public function getUpcomingExams($semester, $year)
    {
    	$sql = "SELECT * FROM examSchedule WHERE semester = :semester AND year = :year";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':semester' => $semester, ':year' => $year));
    	
    	return $query->fetchAll();
    }
    
    
    /**
     * Getter for the upcoming exams for a particular semester and year by exam type.
     * @param string $semester
     * @param int $year
     * @param int $examType
     * @return array an array with several objects (the query results)
     */
    public function getUpcomingExams($semester, $year, $examType)
    {
    	$sql = "SELECT * FROM examSchedule WHEERE semester = :semester AND year = :year AND examType = :exam_type";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':semester' => $semester, ':year' => $year, ':exam_type' => $examType));
    	
    	return $query->fetchAll();    	
    }
    
    /**
     * Deletes a specific exam
     * @param int $examId
     * @return boolean feedback (was the exam deleted properly ?)
     */
    public function deleteExam($examId)
    {
    	$sql = "DELETE FROM examSchedule WHERE examId = :examId";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_id' => $exam_id));
    	
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
     * Setter for a exam (create)
     * @param Exam $exam_text exam text that will be created
     * @return bool feedback (was the exam created properly ?)
     */
    public function createExam($exam)
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

}
