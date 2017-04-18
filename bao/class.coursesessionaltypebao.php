<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.coursesessionaltypedao.php';


/*
	SessionalType Business Object 
*/
Class SessionalTypeBAO{

	private $_DB;
	private $_SessionalTypeDAO;

	function SessionalTypeBAO(){

		$this->_SessionalTypeDAO = new SessionalTypeDAO();

	}

	//get all SessionalTypes value
	public function getAllSessionalTypes(){

		$Result = new Result();	
		$Result = $this->_SessionalTypeDAO->getAllSessionalTypes();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SessionalTypeDAO.getAllSessionalTypes()");		

		return $Result;
	}

	//create SessionalType funtion with the SessionalType object
	public function createSessionalType($SessionalType){

		$Result = new Result();	
		$Result = $this->_SessionalTypeDAO->createSessionalType($SessionalType);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SessionalTypeDAO.createSessionalType()");		

		return $Result;

	
	}

	//read an SessionalType object based on its id form SessionalType object
	public function readSessionalType($SessionalType){


		$Result = new Result();	
		$Result = $this->_SessionalTypeDAO->readSessionalType($SessionalType);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SessionalTypeDAO.readSessionalType()");		

		return $Result;


	}

	//update an SessionalType object based on its current information
	public function updateSessionalType($SessionalType){

		$Result = new Result();	
		$Result = $this->_SessionalTypeDAO->updateSessionalType($SessionalType);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SessionalTypeDAO.updateSessionalType()");		

		return $Result;
	}

	//delete an existing SessionalType
	public function deleteSessionalType($SessionalType){

		$Result = new Result();	
		$Result = $this->_SessionalTypeDAO->deleteSessionalType($SessionalType);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SessionalTypeDAO.deleteSessionalType()");		

		return $Result;

	}

}

echo '<br> log:: exit the class.SessionalTypebao.php';

?>