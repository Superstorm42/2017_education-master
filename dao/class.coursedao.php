<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';


Class CourseDAO{

	private $_DB;
	private $_Course;

	function CourseDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Course = new Course();

	}

	// get all the Courses from the database using the database query
	public function getAllCourses(){

		$CourseList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_course");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Course = new Course();
			$this->_Course->setID($row['ID']);
		    $this->_Course->setCourseNo($row['CourseNo']);
		    $this->_Course->setTitle($row['Title']);
		    $this->_Course->setCredit($row['Credit']);
		    
		    
		    
			$this->_Course->setISdeleted($row['IsDeleted']);
			//echo '<br> DAO = '.$this->_Course->getISdeleted()." -> ". $row['IsDeleted'];
		    $coursetypeid = $row['CourseTypeID'];
		    $this->_DB->doQuery("SELECT * FROM tbl_course_type where ID='".$coursetypeid."'");

			$newrows = $this->_DB->getAllRows();

			for($j = 0; $j < sizeof($newrows); $j++) {
				$newrow = $newrows[$j];
			
		    	$value = $newrow['Name'] ;
		    
			}
			$this->_Course->setCourseTypeID($value);
		    
		    $disciplineid = $row['DisciplineID'];
		    $this->_DB->doQuery("SELECT * FROM tbl_discipline where ID='".$disciplineid."'");

			$newrows = $this->_DB->getAllRows();

			for($j = 0; $j < sizeof($newrows); $j++) {
				$newrow = $newrows[$j];
			
		    	$value = $newrow['Name'] ;
		    
			}
			$this->_Course->setDisciplineID($value);
			
		    $CourseList[]=$this->_Course;

   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CourseList);

		return $Result;
	}

	//create Course funtion with the Course object
	public function createCourse($Course){

		$ID=$Course->getID();
		$CourseNo=$Course->getCourseNo();
		$Title=$Course->getTitle();
		$Credit=$Course->getCredit();
		$CourseTypeID=$Course->getCourseTypeID();
		$DisciplineID = $Course->getDisciplineID();
		$isdlted = $Course->getISdeleted();
		$isdeletednmbr;
		if($isdlted == "Delete")
			$isdeletednmbr=1;
		else 
			$isdeletednmbr=0;


		$SQL = "INSERT INTO tbl_course(ID, CourseNo, Title, Credit, CourseTypeID, DisciplineID, IsDeleted) VALUES ('$ID','$CourseNo','$Title','$Credit','$CourseTypeID','$DisciplineID','$isdeletednmbr')";
		


		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an Course object based on its id form Course object
	public function readCourse($Course){
		
		
		$SQL = "SELECT * FROM tbl_course WHERE ID='".$Course->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Course from the database
		$row = $this->_DB->getTopRow();
		
		$this->_Course = new Course();

		//preparing the Course object
			$this->_Course->setID($row['ID']);
		    $this->_Course->setCourseNo($row['CourseNo']);
		    $Course->setCourseNo($row['CourseNo']);
		    $this->_Course->setTitle($row['Title']);
		    $this->_Course->setCredit($row['Credit']);
		    $this->_Course->setCourseTypeID($row['CourseTypeID']);
		    $this->_Course->setDisciplineID($row['DisciplineID']);
		    $this->_Course->setISdeleted($row['IsDeleted']);
			

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Course);
		
		return $Result;

	}

	//update an Course object based on its 
	public function updateCourse($Course){
		echo "<br>".$Course->getISdeleted().$Course->getCourseNo().$Course->getTitle().$Course->getCredit().$Course->getCourseTypeID().$Course->getDisciplineID();
		$SQL = "UPDATE tbl_course SET CourseNo='".$Course->getCourseNo()."',
		Title='".$Course->getTitle()."',
		Credit='".$Course->getCredit()."',
		CourseTypeID='".$Course->getCourseTypeID()."',
		DisciplineID='".$Course->getDisciplineID()." ',
		IsDeleted='".$Course->getISdeleted()." '
		WHERE ID='".$Course->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Course based on its id of the database
	public function deleteCourse($Course){


		$SQL = "DELETE from tbl_course where ID ='".$Course->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.Coursedao.php';

?>