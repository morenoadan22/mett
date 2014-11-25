<?php

/**
 * Class Register
 * The register controller
 */
class Register extends Controller
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
     * Handles what happens when user moves to URL/register/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index()
    {	    								
		$schedule_model = $this->loadModel('Schedule');
		$history_model = $this->loadModel('History');		
		$this->view->examTypes = $schedule_model->getExamTypes();
		$this->view->pastExams = $history_model->getUserExams();					
        $this->view->render('register/index');
    }
    
    /**
     * Handles what happens when user moves to URL/register/enroll
     */
    function enroll()
    {
    	if(isset($_SESSION['red_id'])){
    		$history_model = $this->loadModel('History');
    		$schedule_model = $this->loadModel('Schedule');
    		$this->view->examOptions = $schedule_model->getUpcomingExams();
    		$this->view->pastExams = $history_model->getUserExams();
    		$this->view->render('register/enroll');
    	}    			    	
    }
    
    /**
     * Sumbits the student registration
     */
    function enrollSave($examId)
    {
    	if(isset($_SESSION['red_id'])){
    		$register_model = $this->loadModel('Register'); 		
    		$register_model->register($examId, $_SESSION['red_id']);
       	}
       	
       	header('location: ' . URL . 'register/enroll');
    }
    
    function enrollRemove($studentExamId)
    {
    	if(isset($_SESSION['red_id'])){
    		$register_model = $this->loadModel('Register');
    		$register_model->unregister($studentExamId);
    	}
    	
    	header('location: ' . URL . 'register/enroll');
    }
           
}
