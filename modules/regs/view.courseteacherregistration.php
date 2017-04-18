<?php

include_once 'blade/view.courseteacherregistration.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Course Teacher Registration CRUD Operations</title>
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
							<label>Teacher Name</label>
							<?php
							$Result = $_UserBAO->getAllUsers();
							if ($Result->getIsSuccess())
								$UserList = $Result->getResultObject();					
							?>
							<select name="teacherid" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($UserList); $i++){
									$User = $UserList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $User->getID();?>" > <?php echo $User->getFirstName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){

										if ($getROW->getTeacherID() == $User->getID() ){
											?>
											<option selected value = "<?php echo $User->getID();?>" > <?php echo $User->getFirstName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $User->getID();?>" > <?php echo $User->getFirstName(); ?> 
											</option>
											<?php
										}	
									}
								}
								?>	
							</select>
						</td>
			</tr>

			<tr>
				<td>
							<label>Session</label>
							<?php
							$Result = $_RegistrationSessionBAO->getAllRegistrationSessions();
							if ($Result->getIsSuccess())
								$SessionList = $Result->getResultObject();					
							?>
							<select name="session" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($SessionList); $i++){
									$Session = $SessionList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $Session->getID();?>" > <?php echo $Session->getName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){

										if ($getROW->getSessionID() == $Session->getID() ){
											?>
											<option selected value = "<?php echo $Session->getID();?>" > <?php echo $Session->getName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $Session->getID();?>" > <?php echo $Session->getName(); ?> 
											</option>
											<?php
										}	
									}
								}
								?>	
							</select>
						</td>
			</tr>

			<tr>
				<?php
						$Result = $_TermBAO->getAllTerms();
						if ($Result->getIsSuccess())
							$TermList = $Result->getResultObject();					
						?>
						<td>
							<label>Term </label>
							<select name="termid" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($TermList); $i++){
									$Term = $TermList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $Term->getID();?>" > <?php echo $Term->getName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){
										
										if ($getROW->getTermID() == $Term->getID() ){
											?>
											<option selected value = "<?php echo $Term->getID();?>" > <?php echo $Term->getName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $Term->getID();?>" > <?php echo $Term->getName(); ?> 
											</option>
											<?php
										}	
									}
								}
								?>	
							</select>
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


		$Result = $_CourseTeacherRegistrationBAO->getAllCourseTeacherRegistrations();

	//if DAO access is successful to load all the Terms then show them one by one
		if($Result->getIsSuccess()){

			$CourseTeacherRegistrations = $Result->getResultObject();
			?>
			<tr>
				<td>Teacher</td>
				<td>Session</td>
				<td>Term</td>
			</tr>
			<?php 
			for($i = 0; $i < sizeof($CourseTeacherRegistrations); $i++) {
				$CourseTeacherRegistration = $CourseTeacherRegistrations[$i];
				?>
				<tr>
					<td><?php echo $CourseTeacherRegistration->getTeacherID(); ?></td>
					<td><?php echo $CourseTeacherRegistration->getSessionID(); ?></td>
					<td><?php echo $CourseTeacherRegistration->getTermID(); ?></td>

					<td><a href="?edit=<?php echo $CourseTeacherRegistration->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
					<td><a href="?del=<?php echo $CourseTeacherRegistration->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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