<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.courseteacherregistrationbao.php';
include_once '/../../../bao/class.coursebao.php';
include_once '/../../../bao/class.coursetypebao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';
include_once '/../../../bao/class.registrationsessionbao.php';
include_once '/../../../bao/class.termbao.php';
include_once '/../../../bao/class.courseteacherbao.php';


$_CourseTeacherRegistrationBAO = new CourseTeacherRegistrationBAO();
$_RegistrationSessionBAO = new RegistrationSessionBAO();
$_CourseTypeBAO = new CourseTypeBAO();
$_TermBAO = new TermBAO();
$_UserBAO = new UserBAO();
$_CourseTeacherBAO = new CourseTeacherBAO();
$_DB = DBUtil::getInstance();


if(isset($_POST['save']))
{

    $CourseTeacherRegistration = new CourseTeacher();
    $CourseTeacherRegistration->setID(Util::getGUID());
    
    
    $CourseTeacherRegistration->setTeacherID($_POST['teacherid']);
    $CourseTeacherRegistration->setSessionID($_POST['session']);
    $CourseTeacherRegistration->setTermID($_POST['termid']);
    
    $_CourseTeacherRegistrationBAO->createCourseTeacherRegistration($CourseTeacherRegistration);
     
}


/* deleting an existing Course */
if(isset($_GET['del']))
{

    $CourseTeacherRegistration = new CourseTeacher(); 
    $CourseTeacherRegistration->setID($_GET['del']);   
    $_CourseTeacherRegistrationBAO->deleteCourseTeacherRegistration($CourseTeacherRegistration); //reading the Course object from the result object

    header("Location: view.CourseTeacherRegistration.php");
}


/* reading an existing Course information */
if(isset($_GET['edit']))
{
    $CourseTeacherRegistration = new CourseTeacher(); 
    $CourseTeacherRegistration->setID($_GET['edit']);  
    $getROW = $_CourseTeacherRegistrationBAO->readCourseTeacherRegistration($CourseTeacherRegistration)->getResultObject(); //reading the Course object from the result object

}

/*updating an existing Course information*/
if(isset($_POST['update']))
{
    $CourseTeacherRegistration = new CourseTeacher(); 
    $CourseTeacherRegistration->setID ($_GET['edit']);
    
    $CourseTeacherRegistration->setTeacherID($_POST['teacherid']);
    $CourseTeacherRegistration->setSessionID($_POST['session']);
    $CourseTeacherRegistration->setTermID($_POST['termid']);
    
    $_CourseTeacherRegistrationBAO->updateCourseTeacherRegistration($CourseTeacherRegistration);

    header("Location: view.CourseTeacherRegistration.php");
}



echo '<br> log:: exit blade.Course.php';

?>