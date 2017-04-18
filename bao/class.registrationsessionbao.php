<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.registrationsessiondao.php';


/*
	RegistrationSession Business Object 
*/
Class RegistrationSessionBAO{

	private $_DB;
	private $_RegistrationSessionDAO;

	function RegistrationSessionBAO(){

		$this->_RegistrationSessionDAO = new RegistrationSessionDAO();

	}

	//get all RegistrationSessions value
	public function getAllRegistrationSessions(){

		$Result = new Result();	
		$Result = $this->_RegistrationSessionDAO->getAllRegistrationSessions();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RegistrationSessionDAO.getAllRegistrationSessions()");		

		return $Result;
	}

	//create RegistrationSession funtion with the RegistrationSession object
	public function createRegistrationSession($RegistrationSession){

		$Result = new Result();	
		$Result = $this->_RegistrationSessionDAO->createRegistrationSession($RegistrationSession);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RegistrationSessionDAO.createRegistrationSession()");		

		return $Result;

	
	}

	//read an RegistrationSession object based on its id form RegistrationSession object
	public function readRegistrationSession($RegistrationSession){


		$Result = new Result();	
		$Result = $this->_RegistrationSessionDAO->readRegistrationSession($RegistrationSession);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RegistrationSessionDAO.readRegistrationSession()");		

		return $Result;


	}

	//update an RegistrationSession object based on its current information
	public function updateRegistrationSession($RegistrationSession){

		$Result = new Result();	
		$Result = $this->_RegistrationSessionDAO->updateRegistrationSession($RegistrationSession);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RegistrationSessionDAO.updateRegistrationSession()");		

		return $Result;
	}

	//delete an existing RegistrationSession
	public function deleteRegistrationSession($RegistrationSession){

		$Result = new Result();	
		$Result = $this->_RegistrationSessionDAO->deleteRegistrationSession($RegistrationSession);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in RegistrationSessionDAO.deleteRegistrationSession()");		

		return $Result;

	}

}

echo '<br> log:: exit the class.RegistrationSessionbao.php';

?>