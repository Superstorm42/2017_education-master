<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.coursedao.php';


/*
	Course Business Object 
*/
Class CourseBAO{

	private $_DB;
	private $_CourseDAO;

	function CourseBAO(){

		$this->_CourseDAO = new CourseDAO();

	}

	//get all Courses value
	public function getAllCourses(){

		$Result = new Result();	
		$Result = $this->_CourseDAO->getAllCourses();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseDAO.getAllCourses()");		

		return $Result;
	}

	//create Course funtion with the Course object
	public function createCourse($Course){

		$Result = new Result();	
		$Result = $this->_CourseDAO->createCourse($Course);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseDAO.createCourse()");		

		return $Result;

	
	}

	//read an Course object based on its id form Course object
	public function readCourse($Course){


		$Result = new Result();	
		$Result = $this->_CourseDAO->readCourse($Course);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseDAO.readCourse()");		

		return $Result;


	}

	//update an Course object based on its current information
	public function updateCourse($Course){

		$Result = new Result();	
		$Result = $this->_CourseDAO->updateCourse($Course);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseDAO.updateCourse()");		

		return $Result;
	}

	//delete an existing Course
	public function deleteCourse($Course){

		$Result = new Result();	
		$Result = $this->_CourseDAO->deleteCourse($Course);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in CourseDAO.deleteCourse()");		

		return $Result;

	}

}

echo '<br> log:: exit the class.Coursebao.php';

?>