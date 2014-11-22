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
            $this->view->render('schedule/index');
    }
    
    
    public function addSchedule()
    {
    	if(isset($_POST['new_schedule']) AND !empty($_POST['new_schedule'])){
    		$schedule_model = $this->loadModel('Schedule');
    		$exam = new Exam();
    		$schedule_model->createExam($exam->fromJSON($_POST['new_schedule']));
    	}	
    	
    	header('location: ' . URL . 'schedule');
    }
    
    
    /**
     * This method controls what happens when you move to /schedule/delete
     * Deletes a scheduled exam.
     * 
     * @param int $examId
     */
    public function delete($examId)
    {
    	if(isset($exam_id)){
    		$schedule_model = $this->loadModel('Schedule');
    		$schedule_model->deleteExam($examId);
    	}	
    	
    	header('location: ' . URL . 'schedule');
    }
}
