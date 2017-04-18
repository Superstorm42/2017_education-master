<?php
		$data = $_POST['data'] or $_REQUEST['data'];
		$std_id = $_POST['std_id'] or $_REQUEST['std_id'];
		$sessionID = $_POST['session'] or $_REQUEST['session'];
		$termID = $_POST['term'] or $_REQUEST['term'];
		$data = json_decode(stripslashes($data));
		//echo $termID;
		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'cseku_wpl_2017_education';

		 $conn = new mysqli($server, $user, $pass, $db);
		 foreach ($data as $key => $dt) {
			 $course = $dt->ID;
			 $retake = isset($dt->is_retake)?$dt->is_retake : 0;
			 $query = "INSERT INTO tbl_course_student_registration values(null,'$std_id','$termID','$course','$sessionID',$retake,'0','0')";
			 $res = $conn->query($query);
		 	# code...
		 }
		 $conn->close();

 ?>
