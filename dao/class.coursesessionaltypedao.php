<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class SessionalTypeDAO{

	private $_DB;
	private $_SessionalType;

	function SessionalTypeDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_SessionalType = new SessionalType();

	}

	// get all the SessionalTypes from the database using the database query
	public function getAllSessionalTypes(){

		$SessionalTypeList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_course_sessional_type");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_SessionalType = new SessionalType();

		    $this->_SessionalType->setID ( $row['ID']);
		    $this->_SessionalType->setName( $row['Name'] );


		    $SessionalTypeList[]=$this->_SessionalType;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SessionalTypeList);

		return $Result;
	}

	//create SessionalType funtion with the SessionalType object
	public function createSessionalType($SessionalType){

		$ID=$SessionalType->getID();
		$Name=$SessionalType->getName();


		$SQL = "INSERT INTO tbl_course_sessional_type(ID,Name) VALUES('$ID','$Name')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an SessionalType object based on its id form SessionalType object
	public function readSessionalType($SessionalType){
		
		
		$SQL = "SELECT * FROM tbl_course_sessional_type WHERE ID='".$SessionalType->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this SessionalType from the database
		$row = $this->_DB->getTopRow();

		$this->_SessionalType = new SessionalType();

		//preparing the SessionalType object
	    $this->_SessionalType->setID ( $row['ID']);
	    $this->_SessionalType->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_SessionalType);

		return $Result;
	}

	//update an SessionalType object based on its 
	public function updateSessionalType($SessionalType){

		$SQL = "UPDATE tbl_course_sessional_type SET Name='".$SessionalType->getName()."' WHERE ID='".$SessionalType->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an SessionalType based on its id of the database
	public function deleteSessionalType($SessionalType){


		$SQL = "DELETE from tbl_course_sessional_type where ID ='".$SessionalType->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.SessionalTypedao.php';

?>