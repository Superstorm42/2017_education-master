<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.coursebao.php';
include_once '/../../../bao/class.coursetypebao.php';
include_once '/../../../bao/class.disciplinebao.php';

$_CourseBAO = new CourseBAO();
$_CourseTypeBAO = new CourseTypeBAO();
$_DisciplineBAO = new DisciplineBAO();
$_DB = DBUtil::getInstance();


if(isset($_POST['save']))
{
	 $Course = new Course();
	 $Course->setID(Util::getGUID());
	 
     $Course->setCourseNo($_POST['txtName']);
     $Course->setTitle($_POST['txttitle']);
     $Course->setCredit($_POST['txtcrdit']);
     $Course->setCourseTypeID($_POST['coursetype']);
     $Course->setDisciplineID($_POST['discipline']);
     echo '<br> checkbox'.$_POST['ISdeleted'];
     if($_POST['ISdeleted'] == "")
     {
     	$Course->setISdeleted(1);
     }
     else 
     {
     	$Course->setISdeleted(0);
     }
     
     

     echo '<br>"save"'. $_POST['txtName'].$_POST['txttitle'].$_POST['ISdeleted'];
     $_CourseBAO->createCourse($Course);
	 
}


/* deleting an existing Course */
if(isset($_GET['del']))
{

	$Course = new Course();	
	$Course->setID($_GET['del']);	
	$_CourseBAO->deleteCourse($Course); //reading the Course object from the result object

	header("Location: view.Course.php");
}


/* reading an existing Course information */
if(isset($_GET['edit']))
{
	$Course = new Course();	
	$Course->setID($_GET['edit']);	
	$getROW = $_CourseBAO->readCourse($Course)->getResultObject(); //reading the Course object from the result object
}

/*updating an existing Course information*/
if(isset($_POST['update']))
{
	$Course = new Course();	

    $Course->setID($_GET['edit']);
    
    $Course->setCourseNo($_POST['txtName']);
    $Course->setTitle($_POST['txttitle']);
    $Course->setCredit($_POST['txtcrdit']);
    $Course->setCourseTypeID($_POST['coursetype']);
    $Course->setDisciplineID($_POST['discipline']);
    echo '<br> checkbox'.$_POST['ISdeleted'];
    if($_POST['ISdeleted'] == "")
    {
    $Course->setISdeleted(0);
    }
    else 
    {
    $Course->setISdeleted(1);
    }
	$_CourseBAO->updateCourse($Course);

	header("Location: view.Course.php");
}



echo '<br> log:: exit blade.Course.php';

?>