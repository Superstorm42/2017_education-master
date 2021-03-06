<?php

include_once 'blade/view.file.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>File CRUD Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</a></label>
	</div>

	<div id="form">
		<form method="post">
			<table width="100%" border="1" cellpadding="15">
				<tr>
					<td>
						<h3>To</h3>
					</td>
				
					<td>
						<select name="users">
						<?php $Result = $_UserBAO->getAllUsers();

								//if DAO access is successful to load all the Disciplines then show them one by one
								if($Result->getIsSuccess()){

									$UserList = $Result->getResultObject();
								

						for($i = 0; $i < sizeof($UserList); $i++) {
								$User = $UserList[$i];
							# code...?>
							
							<option value="<?php echo $User->getID(); ?>">
							<?php echo $User->getFirstName(); ?>
							</option> <?php
						}
						}
						else{

							echo $Result->getResultObject(); //giving failure message

						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Link</h3>
					</td>
					<td>
						<input type="file" name="link" id="linkId">
					</td>
				</tr>
				<tr>
					<td>
						<h3>Discipline</h3>
					</td>
					<td>
						<select name="discipline">
							<?php
								
								
								$Result = $_DisciplineBAO->getAllDisciplines();

								//if DAO access is successful to load all the Disciplines then show them one by one
								if($Result->getIsSuccess()){

									$DisciplineList = $Result->getResultObject();
								

						for($i = 0; $i < sizeof($DisciplineList); $i++) {
								$Discipline = $DisciplineList[$i];
							# code...?>
							
							<option value="<?php echo $Discipline->getID(); ?>">
							<?php echo $Discipline->getName(); ?>
							</option> <?php
						}	
						}
						else{

							echo $Result->getResultObject(); //giving failure message

						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Comments</h3>
					</td>
					<td>
						<input type="text" name="comment">
					</td>
				</tr>
				<tr>
					<td>
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update">update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save">save</button>
							<?php
						}
						?>
					</td>
				</tr>
			</table>
		</form>

<br />

	<table width="100%" border="1" cellpadding="15" align="center">
	<?php
	
	
	$Result = $_FileBAO->getAllFiles();

	//if DAO access is successful to load all the Terms then show them one by one
	if($Result->getIsSuccess()){

		$FileList = $Result->getResultObject();
	?>
		<tr>
			<td>Creator</td>
			<td>Name</td>
			<td>Link</td>
			<td>Discipline</td>
		</tr>
		<?php 
		for($i = 0; $i < sizeof($FileList); $i++) {
			$File = $FileList[$i];
			?>
		    <tr>
			    <td><?php echo $File->getCreator(); ?></td>
			    <td><?php echo $File->getName(); ?></td>
			    <td><?php echo $File->getLink(); ?></td>
			    <td><?php echo $File->getDiscipline(); ?></td>
			    
			    <td><a href="?edit=<?php echo $File->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $File->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
		    </tr>
	    <?php

		}

	}
	else{

		echo $Result->getResultObject(); //giving failure message
	}

	?>
	</table>
	</div>
</center>
</body>
</html>