<?php

include_once 'blade/view.coursetype.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Course Type CRUD Operations</title>
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
					<td><input type="text" name="txtName" placeholder="Course Type Name" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getName();  ?>" /></td>
				</tr>
				<tr>
					<td>
							<label>Sessional Type Name</label>
							<?php
							$Result = $_SessionalTypeBAO->getAllSessionalTypes();
							if ($Result->getIsSuccess())
								$SessionlTypeList = $Result->getResultObject();					
							?>
							<select name="sessionaltype" style="width:170px">
								<?php
								for ($i = 0; $i<sizeof($SessionlTypeList); $i++){
									$SessionlType = $SessionlTypeList[$i];
									?>
									<?php
									if (!isset($_GET['edit'])){

										?>
										<option value="<?php echo $SessionlType->getID();?>" > <?php echo $SessionlType->getName(); ?> 
										</option>
										<?php
									}
									if (isset($_GET['edit'])){

										if ($getROW->getSessionalTypeID() == $SessionlType->getID() ){
											?>
											<option selected value = "<?php echo $SessionlType->getID();?>" > <?php echo $SessionlType->getName();?> 
											</option>
											<?php
										}
										else {

											?>
											<option value="<?php echo $SessionlType->getID();?>" > <?php echo $SessionlType->getName(); ?> 
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
	
	
	$Result = $_CourseTypeBAO->getAllCourseTypes();

	//if DAO access is successful to load all the Terms then show them one by one
	if($Result->getIsSuccess()){

		$CourseList = $Result->getResultObject();
	?>
		<tr>
			<td>Course Types</td>
			<td>Sessional Types</td>
		</tr>
		<?php 
		for($i = 0; $i < sizeof($CourseList); $i++) {
			$Course = $CourseList[$i];
			?>
		    <tr>
			    <td><?php echo $Course->getName(); ?></td>
			    <td><?php echo $Course->getSessionalTypeID(); ?></td>
			    
			    
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