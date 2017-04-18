<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.registrationsessionbao.php';


$_RegistrationSessionBAO = new RegistrationSessionBAO();
$_DB = DBUtil::getInstance();

/* saving a new RegistrationSession account*/
if(isset($_POST['save']))
{
	 $RegistrationSession = new RegistrationSession();	
	 $RegistrationSession->setID(Util::getGUID());
     $RegistrationSession->setName($_DB->secureInput($_POST['txtName']));
	 $_RegistrationSessionBAO->createRegistrationSession($RegistrationSession);		 
}


/* deleting an existing RegistrationSession */
if(isset($_GET['del']))
{

	$RegistrationSession = new RegistrationSession();	
	$RegistrationSession->setID($_GET['del']);	
	$_RegistrationSessionBAO->deleteRegistrationSession($RegistrationSession); //reading the RegistrationSession object from the result object

	header("Location: view.RegistrationSession.php");
}


/* reading an existing RegistrationSession information */
if(isset($_GET['edit']))
{
	$RegistrationSession = new RegistrationSession();	
	$RegistrationSession->setID($_GET['edit']);	
	$getROW = $_RegistrationSessionBAO->readRegistrationSession($RegistrationSession)->getResultObject(); //reading the RegistrationSession object from the result object
}

/*updating an existing RegistrationSession information*/
if(isset($_POST['update']))
{
	$RegistrationSession = new RegistrationSession();	

    $RegistrationSession->setID ($_GET['edit']);
    $RegistrationSession->setName( $_POST['txtName'] );
	
	$_RegistrationSessionBAO->updateRegistrationSession($RegistrationSession);

	header("Location: view.RegistrationSession.php");
}



echo '<br> log:: exit blade.RegistrationSession.php';

?>