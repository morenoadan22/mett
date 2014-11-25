<?php

/**
 * Class Schedule
 * The schedule controller
 */
class Schedule extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
            parent::__construct();
			Auth::handleLogin();
    }

    /**
     * Handles what happens when user moves to URL/index/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index()
    {
			$schedule_model = $this->loadModel('Schedule');
			$this->view->schedules = $schedule_model->getAllExams();	
			$this->view->examTypes = $schedule_model->getExamTypes();	
            $this->view->render('schedule/index');
    }
    
    
    /**
     * Handles what happens when user moves to URL/
     */
    public function addSchedule()
    {
    	if(isset($_POST['selectExamType']) AND isset($_POST['selectSemester'])){
    		$schedule_model = $this->loadModel('Schedule');
    		$exam = new Exam();
    		$exam->setExamType($_POST['selectExamType']);
    		$exam->setLocation($_POST['textLocation']);
    		$exam->setDate($_POST['textDate']);
    		$exam->setTime($_POST['textTime']);
    		$exam->setSemester($_POST['selectSemester']);
    		$exam->setYear($_POST['selectYear']);
    		$schedule_model->createExam($exam);
    	}	
    	
    	header('location: ' . URL . 'schedule/index');
    }
    
    
    /**
     * Handles what happens when a user moves to /schedule/edit
     * 
     * @param int $examId the examId to edit
     */
    public function edit($examId)
    {
    	$schedule_model = $this->loadModel('Schedule');
    	$this->view->schedule = $schedule_model->getExamSchedule($examId);
    	$this->view->render('schedule/edit');	
    }
    
    /**
     * Handles when changes are submited to a schedule/edit
     * 
     */
    public function editSave()
    {
    	$schedule_model = $this->loadModel('Schedule');
    	$exam = new Exam();
    	$exam->setId($_POST['examId']);    	
    	$exam->setLocation($_POST['textLocation']);
    	$exam->setDate($_POST['textDate']);
    	$exam->setTime($_POST['textTime']);
    	$schedule_model->editExam($exam); 
    		
    }
    
    
    /**
     * This method controls what happens when you move to /schedule/delete
     * Deletes a scheduled exam.
     * 
     * @param int $examId
     */
    public function delete($examId)
    {
    	
    	$schedule_model = $this->loadModel('Schedule');
    	$schedule_model->deleteExam($examId);
    		
    	
    	header('location: ' . URL . 'schedule/index');
    }
}
