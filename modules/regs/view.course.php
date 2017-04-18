<?php

include_once 'blade/view.course.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Course CRUD Operations</title>
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
						<td><input type="text" name="txtName" placeholder="Course No" value="<?php 
						if(isset($_GET['edit'])) echo $getROW->getCourseNo();  ?>" /></td>
					</tr>
					<tr>
						<td><input type="text" name="txttitle" placeholder="Course Title" value="<?php 
						if(isset($_GET['edit'])) echo $getROW->getTitle();  ?>" /></td>
					</tr>
					<tr>
						<td><input type="text" name="txtcrdit" placeholder="Course Credit" value="<?php 
						if(isset($_GET['edit'])) echo $getROW->getCredit();  ?>" /></td>
					</tr>

					<tr>
						<td>
							<label>Course Type Name</label>
							<?php
							$Result = $_CourseTypeBAO->getAllCourseTypes();
							if ($Result->getIsSuccess())
								$CourseTypeList = $Result->getResultObject();					
							?>
							<select name="coursetype" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($CourseTypeList); $i++){
									$CourseType = $CourseTypeList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $CourseType->getID();?>" > <?php echo $CourseType->getName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){

										if ($getROW->getCourseTypeID() == $CourseType->getID() ){
											?>
											<option selected value = "<?php echo $CourseType->getID();?>" > <?php echo $CourseType->getName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $CourseType->getID();?>" > <?php echo $CourseType->getName(); ?> 
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
							<label>Discipline Name</label>
							<?php
							$Result = $_DisciplineBAO->getAllDisciplines();
							if ($Result->getIsSuccess())
								$DisciplineList = $Result->getResultObject();					
							?>
							<select name="discipline" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($DisciplineList); $i++){
									$Discipline = $DisciplineList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $Discipline->getID();?>" > <?php echo $Discipline->getName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){

										if ($getROW->getDisciplineID() == $Discipline->getID() ){
											?>
											<option selected value = "<?php echo $Discipline->getID();?>" > <?php echo $Discipline->getName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $Discipline->getID();?>" > <?php echo $Discipline->getName(); ?> 
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
							<label>Deleted ?</label>
							<input type="checkbox" name="ISdeleted"
							<?php
							if (isset($_GET['edit'])){
								if($getROW->getISdeleted() == 1)
								{
									?>
									checked = "checked"
									<?php
								}
							}
							?>

							>

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


				$Result = $_CourseBAO->getAllCourses();

//if DAO access is successful to load all the Terms then show them one by one
				if($Result->getIsSuccess()){

					$Courses = $Result->getResultObject();
					?>
					<tr>
						<td>Course No</td>
						<td>Title</td>
						<td>Credit</td>
						<td>Course Type</td>
						<td>Discipline</td>
						<td>Is Deleted</td>
					</tr>
					<?php 
					for($i = 0; $i < sizeof($Courses); $i++) {
						$Course = $Courses[$i];
		//echo '<br>'. $Course->getCourseNo().$Course->getISdeleted();
						?>
						<tr>
							<td><?php echo $Course->getCourseNo(); ?></td>
							<td><?php echo $Course->getTitle(); ?></td>
							<td><?php echo $Course->getCredit(); ?></td>
							<td><?php echo $Course->getCourseTypeID(); ?></td>
							<td><?php echo $Course->getDisciplineID(); ?></td>
							<?php

							if($Course->getISdeleted() == 1)
								$deletertik = "checked";
							else 
								$deletertik = "";
							?>
							<td><input type="checkbox" name="name1" onclick="return false;" 
								<?php 
								if($Course->getISdeleted() == 1)
								{
									?>
									checked = "checked"
									<?php
								}
								?>/></td>

								<td><a href="?edit=<?php echo $Course->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
								<td><a href="?del=<?php echo $Course->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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