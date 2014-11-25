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
    public function getAllExams()
    {
    	$sql = "SELECT exam_schedule.id, exam_type.type AS exam_type , location, date, time, semester, year,"; 
    	$sql .= "(select count(student_exam.exam_schedule) FROM student_exam where student_exam.exam_schedule = exam_schedule.id)";
    	$sql .= " AS student_count FROM exam_schedule JOIN exam_type ON exam_schedule.exam_type = exam_type.id";    	
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
    	$sql = "SELECT exam_schedule.id, exam_type.type AS exam_type, location, seats, date, time, semester, year FROM exam_schedule ";
    	$sql .= " JOIN exam_type ON exam_schedule.exam_type = exam_type.id WHERE exam_schedule.id = :exam_id";
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
     * Getter for the upcoming exams for a particular semester and year by exam type.
     * @return array an array with several objects (the query results)
     */
    public function getUpcomingExams()
    {
    	$curYear = new Date("Y");
    	$sql = "SELECT exam_schedule.id, exam_type.type AS exam_type , location, date, time, semester, year,"; 
    	$sql .= "(select count(student_exam.exam_schedule) FROM student_exam WHERE student_exam.exam_schedule = exam_schedule.id)";
    	$sql .= " AS student_count, (select id from student_exam where student_exam.exam_schedule = exam_schedule.id) AS student_exam_id, FROM exam_schedule JOIN exam_type ON exam_schedule.exam_type = exam_type.id WHERE year >= :current_year";
    	if(isset($examType)){
    		$sql .= " AND exam_type = :exam_type";
    	}
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':current_year' => $curYear));
    	
    	return $query->fetchAll();    	
    }
    
    /**
     * Deletes a specific exam
     * @param int $examId
     * @return boolean feedback (was the exam deleted properly ?)
     */
    public function deleteExam($examId)
    {
    	$sql = "DELETE FROM exam_schedule WHERE id = :exam_id";
    	$query = $this->db->prepare($sql);
    	$query->execute(array(':exam_id' => $examId));
    	
    	$count =  $query->rowCount();
    	
    	if ($count == 1) {
    		return true;
    	} else {
    		$_SESSION["feedback_negative"][] = FEEDBACK_SCHEDULE_DELETION_FAILED;
    	}
    	// default return
    	return false;
    }

    /**
     * Edits a specific exam
     * 
     * @param Exam $exam
     * @return boolean feedback (was the exam edited properly? )
     */
   public function editExam($exam)
   {
   		$sql = "UPDATE exam_schedule SET location = :location, date = :date, time = :time where id = :exam_id";
   		$query = $this->db->prepare($sql);
   		$query->execute(array(':location' => $exam->getLocation(), ':date' => $exam->getDate(), ':time' => $exam->getTime()));
   		
   		$count = $query->rowCount();
   		if(count == 1){
   			return true;
   		}else{
   			$_SESSION["feedback_negative"][] = FEEDBACK_SCHEDULE_EDIT_FAILED;
   		}
   		
   		return false;
   }


    /**
     * Setter for a exam (create)
     * @param Exam $exam exam json string
     * @return bool feedback (was the exam created properly ?)
     */
    public function createExam($exam)
    {
        $sql = "INSERT INTO exam_schedule (exam_type, location, date, time, semester, year)";
        $sql .= " VALUES (:exam_type, :location, :date, :time, :semester, :year)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':exam_type' => $exam->getExamType(),
        			':location' => $exam->getLocation(),        			
        			':date' => $exam->getDate(),
        			':time' => $exam->getTime(),
        			':semester' => $exam->getSemseter(),
        			':year' => $exam->getYear()));

        $count =  $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_SCHEDULE_CREATION_FAILED;
        }
        // default return
        return false;
    }

}
