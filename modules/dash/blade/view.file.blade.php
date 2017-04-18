<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.filebao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';


session_start();

$globalUser = $_SESSION['globalUser'];


$_FileBAO = new FileBAO();
$_DB = DBUtil::getInstance();

$_DisciplineBAO = new DisciplineBAO();
$_UserBAO = new UserBAO();

//$array = array("userId1", "userId2", "userId3");
//$discipline = array("CSE","ECE","MATH");

/* saving a new File account*/
if(isset($_POST['save']))
{
	 $File = new File();
	 $File->setID(Util::getGUID());
	 $File->setCreator($globalUser->getID());
     $File->setName($_DB->secureInput($_POST['users']));
     $File->setLink($_DB->secureInput($_POST['link']));
     $File->setDiscipline($_POST['discipline']);
     
     
     
	 $_FileBAO->createFile($File);
	 //echo <br>"save";
	 //print_r(school);		 
}


/* deleting an existing File */
if(isset($_GET['del']))
{

	$File = new File();	
	$File->setID($_GET['del']);	
	$_FileBAO->deleteFile($File); //reading the File object from the result object

	header("Location: view.file.php");
}


/* reading an existing File information */
if(isset($_GET['edit']))
{
	$File = new File();	
	$File->setID($_GET['edit']);	
	$getROW = $_FileBAO->readFile($File)->getResultObject(); //reading the File object from the result object
}

/*updating an existing File information*/
if(isset($_POST['update']))
{
	$File = new File();	

    $File->setID($_GET['edit']);
    $File->setName($_POST['txtName']);
	
	$_FileBAO->updateFile($File);

	header("Location: view.file.php");
}



echo '<br> log:: exit blade.file.php';

?>