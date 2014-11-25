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
     * Handles what happens when user moves to URL/index/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index()
    {	    								
							
        $this->view->render('register/index');
    }
    
    
    function enroll()
    {
    	if(isset($_SESSION['user_redId'])){
    		$history_model = $this->loadModel('History');
    		$schedule_model = $this->loadModel('Schedule');
    		$this->view->examTypes = $schedule_model->getExamTypes();
    		$this->view->pastExams = $history_model->getUserExams();
    		$this->view->render('register/enroll');
    	}    			    	
    }
           
}
