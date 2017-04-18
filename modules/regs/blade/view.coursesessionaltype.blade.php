<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.coursesessionaltypebao.php';


$_SessionalTypeBAO = new SessionalTypeBAO();
$_DB = DBUtil::getInstance();

/* saving a new SessionalType account*/
if(isset($_POST['save']))
{
	 $SessionalType = new SessionalType();	
	 $SessionalType->setID(Util::getGUID());
     $SessionalType->setName($_DB->secureInput($_POST['txtName']));
	 $_SessionalTypeBAO->createSessionalType($SessionalType);		 
}


/* deleting an existing SessionalType */
if(isset($_GET['del']))
{

	$SessionalType = new SessionalType();	
	$SessionalType->setID($_GET['del']);	
	$_SessionalTypeBAO->deleteSessionalType($SessionalType); //reading the SessionalType object from the result object

	header("Location: view.coursesessionaltype.php");
}


/* reading an existing SessionalType information */
if(isset($_GET['edit']))
{
	$SessionalType = new SessionalType();	
	$SessionalType->setID($_GET['edit']);	
	$getROW = $_SessionalTypeBAO->readSessionalType($SessionalType)->getResultObject(); //reading the SessionalType object from the result object
}

/*updating an existing SessionalType information*/
if(isset($_POST['update']))
{
	$SessionalType = new SessionalType();	

    $SessionalType->setID ($_GET['edit']);
    $SessionalType->setName( $_POST['txtName'] );
	
	$_SessionalTypeBAO->updateSessionalType($SessionalType);

	header("Location: view.coursesessionaltype.php");
}



echo '<br> log:: exit blade.SessionalType.php';

?>