<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.courseteacherbao.php';
include_once '/../../../bao/class.coursebao.php';
include_once '/../../../bao/class.coursetypebao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';
include_once '/../../../bao/class.registrationsessionbao.php';
include_once '/../../../bao/class.termbao.php';
include_once '/../../../bao/class.courseteacherbao.php';

$_CourseBAO = new CourseBAO();
$_CourseTeacherBAO = new CourseTeacherBAO();
$_RegistrationSessionBAO = new RegistrationSessionBAO();
$_CourseTypeBAO = new CourseTypeBAO();
$_TermBAO = new TermBAO();
$_UserBAO = new UserBAO();
$_DisciplineBAO = new DisciplineBAO();
$_CourseTeacherBAO = new CourseTeacherBAO();
$_DB = DBUtil::getInstance();

$globalCourse = '';
if(isset($_POST['save']))
{

    $CourseTeacher = new CourseTeacher();
    $CourseTeacher->setID(Util::getGUID());

    $CourseTeacher->setCourseID($_POST['courseid']);
    $CourseTeacher->setTeacherID($_POST['teacherid']);
    $CourseTeacher->setSessionID($_POST['session']);
    $CourseTeacher->setTermID($_POST['termid']);

    $_CourseTeacherBAO->createCourseTeacher($CourseTeacher);

}


/* deleting an existing Course */
if(isset($_GET['del']))
{

    $CourseTeacher = new CourseTeacher();
    $CourseTeacher->setID($_GET['del']);
    $_CourseTeacherBAO->deleteCourseTeacher($CourseTeacher); //reading the Course object from the result object

    header("Location: view.courseteacher.php");
}


/* reading an existing Course information */
if(isset($_GET['edit']))
{
    $CourseTeacher = new CourseTeacher();
    $CourseTeacher->setID($_GET['edit']);
    $getROW = $_CourseTeacherBAO->readCourseTeacher($CourseTeacher)->getResultObject(); //reading the Course object from the result object

}

/*updating an existing Course information*/
if(isset($_POST['update']))
{
    $CourseTeacher = new CourseTeacher();
    $CourseTeacher->setID ($_GET['edit']);
    $CourseTeacher->setCourseID($_POST['courseid']);
    $CourseTeacher->setTeacherID($_POST['teacherid']);
    $CourseTeacher->setSessionID($_POST['session']);
    $CourseTeacher->setTermID($_POST['termid']);

    $_CourseTeacherBAO->updateCourseTeacher($CourseTeacher);

    header("Location: view.CourseTeacher.php");
}



echo '<br> log:: exit blade.Course.php';

?>
