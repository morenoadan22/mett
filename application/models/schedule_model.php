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
     * Gets all exams EVER no filters.
     * 
     * @return multitype: 
     */
    public function getAllExams(){
    	$sql = "SELECT exam_schedule.id, exam_type, location, count(student_exam.*) AS student_count, date, time, semester, year FROM exam_schedule";
    	$sql .= " LEFT JOIN student_exam.exam_schedule = exam_schedule.id";
    	$query = $this->db->prepare($sql);
    	$query->execute();

    	return $query->fetchAll();
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
    	
    	$sql = "SELECT seats FROM exam_schedule WHERE id = :exam_schedule";
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
    	$sql = "SELECT id, exam_type, location, seats, date, time, semeseter, year FROM exam_schedule WHERE id = :exam_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_id' => $exam_id));
    
    	// fetch() is the PDO method that gets a single result
    	return $query->fetch();
    }
    
    /**
     * Getter for all the exam types;
     * 
     * @return multitype:
     */
    public function getExamTypes(){
    	$sql = "SELECT id, type FROM exam_type";
    	$query = $this->db->prepare($sql);
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    
    /**
     * Gets the student count for an upcoming exam.
     * 
     * @param int $examId the exam schedule id
     * @return the int count of studentexam records linked to an exam.
     */
    public function getStudentCount($examId)
    {
    	$sql = "SELECT count(*) FROM student_exam WHERE exam_schedule = :exam_schedule";
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
    	$sql = "SELECT * FROM exam_schedule WHERE semester = :semester AND year = :year";
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
    	$sql = "SELECT * FROM exam_schedule WHEERE semester = :semester AND year = :year AND exam_type = :exam_type";
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
    	$sql = "DELETE FROM exam_schedule WHERE id = :examId";
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
     * @param Exam $exam exam json string
     * @return bool feedback (was the exam created properly ?)
     */
    public function createExam($exam)
    {
        $sql = "INSERT INTO exam_schedule (exam_type, location, seats, date, time, semester, year)";
        $sql .= " VALUES (:exam_type, :location, :seats, :date, :time, :semester, :year)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':exam_type' => $exam->getExamType(),
        			':location' => $exam->getLocation(),
        			':seats' => $exam->getSeats(),
        			':date' => $exam->getDate(),
        			':time' => $exam->getTime(),
        			':semester' => $exam->getSemseter(),
        			':year' => $exam->getYear()));

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
