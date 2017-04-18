<?php
		$data = $_POST['data'] or $_REQUEST['data'];
		$data = json_decode(stripslashes($data));

		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'cseku_wpl_2017_education';

		 $conn = new mysqli($server, $user, $pass, $db);
		 foreach ($data as $key => $dt) {

			 $approved = $dt->tbl_course_student_registration_id;
			 $query = "UPDATE tbl_course_student_registration set isapproved='1' WHERE ID='$approved'";
			 $res = $conn->query($query);
		 	# code...
		 }
		 $conn->close();

 ?>
