<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';
include_once '/../dao/class.coursedao.php';
include_once '/../dao/class.userdao.php';
include_once '/../dao/class.registrationsessiondao.php';
include_once '/../dao/class.termdao.php';

Class CourseTeacherDAO{

	private $_DB;
	private $_CourseTeacher;
	private $_CourseDAO;
	private $_UserDAO;
	private $_RegistrationSessionDAO;
	private $_TermDAO;
	function CourseTeacherDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_CourseTeacher = new CourseTeacher();
		$this->_CourseDAO = new CourseDAO();
		$this->_UserDAO = new UserDAO();
		$this->_RegistrationSessionDAO = new RegistrationSessionDAO();
		$this->_TermDAO = new TermDAO();
	}

	// get all the Courses from the database using the database query
	public function getAllCourseTeachers(){

		$CourseTeacherList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_course_teacher");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			//echo '<br>'.$row['ID']." ".$row['CourseID'];
			$this->_CourseTeacher = new CourseTeacher();
			$this->_CourseTeacher->setID($row['ID']);
			
			$Course = new Course();
	 		$Course->setID($row['CourseID']);
			$Result_course = new Result();
			$Result_course = $this->_CourseDAO->readCourse($Course);
			$this->_CourseTeacher->setCourseID($Course->getCourseNo());
		    
			$User = new User();
			$User->setID($row['TeacherID']);
			$Result_teacher = new Result();
			$Result_teacher = $this->_UserDAO->readUser($User);
			$this->_CourseTeacher->setTeacherID($User->getFirstName());


			$Session = new RegistrationSession();
			$Session->setID($row['SessionID']);
			$Result_Session = new Result();
			$Result_Session = $this->_RegistrationSessionDAO->readRegistrationSession($Session);
		    $this->_CourseTeacher->setSessionID($Session->getName ());
		    
		    $Term = new Term();
		    $Term->setID($row['TermID']);
		    $Result_term = new Result();
			$Result_term = $this->_TermDAO->readTerm($Term);
		    $this->_CourseTeacher->setTermID($Term->getName());
		    
		    
		    $CourseTeacherList[]=$this->_CourseTeacher;

		    

   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CourseTeacherList);

		return $Result;
	}

	//create Course funtion with the Course object
	public function createCourseTeacher($CourseTeacher){

		$ID=$CourseTeacher->getID();
		$CourseNo=$CourseTeacher->getCourseID();
		$TeacherID=$CourseTeacher->getTeacherID();
		$SessionID=$CourseTeacher->getSessionID();
		$TermID=$CourseTeacher->getTermID();
		
		

		$SQL = "INSERT INTO tbl_course_teacher(ID, CourseID, TeacherID, SessionID, TermID) VALUES ('$ID','$CourseNo','$TeacherID','$SessionID','$TermID')";
		


		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an Course object based on its id form Course object
	public function readCourseTeacher($CourseTeacher){
		
		
		$SQL = "SELECT * FROM tbl_course_teacher WHERE ID='".$CourseTeacher->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Course from the database
		$row = $this->_DB->getTopRow();

		$this->_CourseTeacher = new CourseTeacher();

		//preparing the Course object
			$this->_CourseTeacher->setID($row['ID']);
		    $this->_CourseTeacher->setCourseID($row['CourseID']);
		    $this->_CourseTeacher->setTeacherID($row['TeacherID']);
		    $this->_CourseTeacher->setSessionID($row['SessionID']);
		    $this->_CourseTeacher->setTermID($row['TermID']);
		    echo '<br>'. $row['CourseID'] . $row['TeacherID'] . $row['SessionID'] . $row['TermID'];


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_CourseTeacher);

		return $Result;
	}

	//update an Course object based on its 
	public function updateCourseTeacher($CourseTeacher){

		$SQL = "UPDATE tbl_course_teacher SET CourseID='".$CourseTeacher->getCourseID()."', TeacherID='".$CourseTeacher->getTeacherID()."', SessionID='".$CourseTeacher->getSessionID()."',TermID='".$CourseTeacher->getTermID()."' WHERE ID='".$CourseTeacher->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Course based on its id of the database
	public function deleteCourseTeacher($CourseTeacher){


		$SQL = "DELETE from tbl_course_teacher where ID ='".$CourseTeacher->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.Coursedao.php';

?>