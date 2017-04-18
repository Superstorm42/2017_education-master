<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';
include_once '/../dao/class.coursedao.php';
include_once '/../dao/class.userdao.php';
include_once '/../dao/class.registrationsessiondao.php';
include_once '/../dao/class.termdao.php';

Class CourseTeacherRegistrationDAO{

	private $_DB;
	private $_CourseTeacherRegistration;
	private $_CourseDAO;
	private $_UserDAO;
	private $_RegistrationSessionDAO;
	private $_TermDAO;
	function CourseTeacherRegistrationDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_CourseTeacherRegistration = new CourseTeacherRegistration();
		$this->_CourseDAO = new CourseDAO();
		$this->_UserDAO = new UserDAO();
		$this->_RegistrationSessionDAO = new RegistrationSessionDAO();
		$this->_TermDAO = new TermDAO();
	}

	// get all the Courses from the database using the database query
	public function getAllCourseTeacherRegistrations(){

		$CourseTeacherRegistrationList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_course_teacher_registration");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			//echo '<br>'.$row['ID']." ".$row['CourseID'];
			$this->_CourseTeacherRegistration = new CourseTeacherRegistration();
			$this->_CourseTeacherRegistration->setID($row['ID']);
			
			
		    
			$User = new User();
			$User->setID($row['TeacherID']);
			$Result_teacher = new Result();
			$Result_teacher = $this->_UserDAO->readUser($User);
			$this->_CourseTeacherRegistration->setTeacherID($User->getFirstName());


			$Session = new RegistrationSession();
			$Session->setID($row['SessionID']);
			$Result_Session = new Result();
			$Result_Session = $this->_RegistrationSessionDAO->readRegistrationSession($Session);
		    $this->_CourseTeacherRegistration->setSessionID($Session->getName ());
		    
		    $Term = new Term();
		    $Term->setID($row['TermID']);
		    $Result_term = new Result();
			$Result_term = $this->_TermDAO->readTerm($Term);
		    $this->_CourseTeacherRegistration->setTermID($Term->getName());
		    
		    
		    $CourseTeacherRegistrationList[]=$this->_CourseTeacherRegistration;

		    

   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CourseTeacherRegistrationList);

		return $Result;
	}

	//create Course funtion with the Course object
	public function createCourseTeacherRegistration($CourseTeacherRegistration){

		$ID=$CourseTeacherRegistration->getID();
		
		$TeacherID=$CourseTeacherRegistration->getTeacherID();
		$SessionID=$CourseTeacherRegistration->getSessionID();
		$TermID=$CourseTeacherRegistration->getTermID();
		
		echo '<br>'.$ID.$TeacherID.$SessionID.$TermID;

		$SQL = "INSERT INTO tbl_course_teacher_registration(ID, TeacherID, SessionID, TermID) VALUES ('$ID','$TeacherID','$SessionID','$TermID')";
		


		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an Course object based on its id form Course object
	public function readCourseTeacherRegistration($CourseTeacherRegistration){
		
		
		$SQL = "SELECT * FROM tbl_course_teacher_registration WHERE ID='".$CourseTeacherRegistration->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Course from the database
		$row = $this->_DB->getTopRow();

		$this->_CourseTeacherRegistration = new CourseTeacherRegistration();

		//preparing the Course object
			$this->_CourseTeacherRegistration->setID($row['ID']);
		    
		    $this->_CourseTeacherRegistration->setTeacherID($row['TeacherID']);
		    $this->_CourseTeacherRegistration->setSessionID($row['SessionID']);
		    $this->_CourseTeacherRegistration->setTermID($row['TermID']);
		    ///echo '<br>'. $row['CourseID'] . $row['TeacherID'] . $row['SessionID'] . $row['TermID'];


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_CourseTeacherRegistration);

		return $Result;
	}

	//update an Course object based on its 
	public function updateCourseTeacherRegistration($CourseTeacherRegistration){

		$SQL = "UPDATE tbl_course_teacher_registration SET TeacherID='".$CourseTeacherRegistration->getTeacherID()."', SessionID='".$CourseTeacherRegistration->getSessionID()."',TermID='".$CourseTeacherRegistration->getTermID()."' WHERE ID='".$CourseTeacherRegistration->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Course based on its id of the database
	public function deleteCourseTeacherRegistration($CourseTeacherRegistration){


		$SQL = "DELETE from tbl_course_teacher_registration where ID ='".$CourseTeacherRegistration->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.Coursedao.php';

?>