<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.courseteacherregistraiondao.php';


/*
	CourseTeacherRegistration Business Object 
*/
Class CourseTeacherRegistrationBAO{

	private $_DB;
	private $_CourseTeacherRegistrationDAO;

	function CourseTeacherRegistrationBAO(){

		$this->_CourseTeacherRegistrationDAO = new CourseTeacherRegistrationDAO();

	}

	//get all CourseTeacherRegistrations value
	public function getAllCourseTeacherRegistrations(){

		$Result = new Result();	
		$Result = $this->_CourseTeacherRegistrationDAO->getAllCourseTeacherRegistrations();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseTeacherRegistrationDAO.getAllCourseTeacherRegistrations()");		

		return $Result;
	}

	//create CourseTeacherRegistration funtion with the CourseTeacherRegistration object
	public function createCourseTeacherRegistration($CourseTeacherRegistration){

		$Result = new Result();	
		$Result = $this->_CourseTeacherRegistrationDAO->createCourseTeacherRegistration($CourseTeacherRegistration);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseTeacherRegistrationDAO.createCourseTeacherRegistration()");		

		return $Result;

	
	}

	//read an CourseTeacherRegistration object based on its id form CourseTeacherRegistration object
	public function readCourseTeacherRegistration($CourseTeacherRegistration){


		$Result = new Result();	
		$Result = $this->_CourseTeacherRegistrationDAO->readCourseTeacherRegistration($CourseTeacherRegistration);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseTeacherRegistrationDAO.readCourseTeacherRegistration()");		

		return $Result;


	}

	//update an CourseTeacherRegistration object based on its current information
	public function updateCourseTeacherRegistration($CourseTeacherRegistration){

		$Result = new Result();	
		$Result = $this->_CourseTeacherRegistrationDAO->updateCourseTeacherRegistration($CourseTeacherRegistration);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseTeacherRegistrationDAO.updateCourseTeacherRegistration()");		

		return $Result;
	}

	//delete an existing CourseTeacherRegistration
	public function deleteCourseTeacherRegistration($CourseTeacherRegistration){

		$Result = new Result();	
		$Result = $this->_CourseTeacherRegistrationDAO->deleteCourseTeacherRegistration($CourseTeacherRegistration);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseTeacherRegistrationDAO.deleteCourseTeacherRegistration()");		

		return $Result;

	}

}

echo '<br> log:: exit the class.CourseTeacherRegistrationbao.php';

?>