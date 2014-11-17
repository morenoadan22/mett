<?php 

/**
 * Exam data object class
 * 
 *  Wrapper class for exam schedule table.
 * 
 */

class Exam
{
		
	private $id, $examType, $location, $seats, $date, $time, $semester, $year;

	
	public function getId(){
		return $this->id;
	}
	
	public function getExamType(){
		return $this->examType;
	}
	
	public function getLocation(){
		return $this->location;
	}
	
	public function getSeats(){
		return $this->seats;
	}

	public function getDate(){
		return $this->date;
	}
	
	public function getTime(){
		return $this->time;
	}
	
	public function getSemseter(){
		return $this->semester;
	}
	
	public function getYear(){
		return $this->year;
	}
	
	public function setId(int $id){
		$this->id = $id;
	}
	
	public function setExamType(int $examType){
		$this->examType = $examType;
	}
	
	public function setLocation(string $location){
		$this->location = $location;
	}
	
	public function setSeats(int $seats){
		$this->seats = $seats;
	}
	
	public function setDate($date){
		$this->date = $date;		
	}
	
	public function setTime($time){
		$this->time = $time;
	}
	
	public function setSemester(string $semester){
		$this->semester = $semester;
	}
	
	public function setYear(int $year){
		$this->year = $year;
	}
	
	public function toJSON(){
		$arr = array('id' => $this->getId(),//
					'exam_type' => $this->getExamType(),//
					'location' => $this->getLocation(),//
					'seats' => $this->getSeats(),//
					'date' => $this->getDate(),//
					'time' => $this->getTime(),//
					'semester' => $this->getSemester(),//
					'year' => $this->getYear());
		
		json_encode($arr);
	}

	public function fromJSON($json){
		
		return $exam; 
	}
	
}

?>