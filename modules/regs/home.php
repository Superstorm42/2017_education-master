<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Registration</title>
</head>
<body>
	<div id="vm">
		<form class="" action="home.php" method="post">
			<?php
			$_SESSION['std_id'] = 140204;
			$server = 'localhost';
			$user = 'root';
			$pass = '';
			$db = 'cseku_wpl_2017_education';

			$conn = new mysqli($server, $user, $pass, $db);
			?>

			<br>
			Select Session:

			<select class="" name="session">
				<?php
				$query = "SELECT * FROM tbl_registration_session";
				$res = $conn->query($query);
				if($res->num_rows > 0){
					while ($row = $res->fetch_assoc()) {
						?>
						<option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
						<?php
					}
				}

				?>
			</select>
			<br>

			<input type="submit" name="load" value="Load"><br>
			Select Term:
			<select class="" name="term" v-model="term">
				<?php
					$query = "SELECT * FROM tbl_term";
					$res = $conn->query($query);
					while ($row = $res->fetch_assoc()) {
						?>
							<option value="<?php echo $row["ID"] ?>"><?php echo $row["Name"] ?></option>
						<?php
					}
					$conn->close();
				 ?>
			</select>
		</form>
		<?php
		$courses = [];
		if(isset($_POST['load'])){
			$session = $_POST['session'];
			$conn = new mysqli($server, $user, $pass, $db);
			$query = "SELECT tbl_course.* FROM tbl_course JOIN tbl_course_teacher ON tbl_course.id = tbl_course_teacher.courseid WHERE tbl_course_teacher.sessionid = '$session'";
			$res = $conn->query($query) or die(mysqli_error($conn));
			while ($row = $res->fetch_assoc()) {
				array_push($courses, $row);
			}
			$conn->close();
		}
		?>
		<hr>
		<hr>
		<div class="">
			<table width="100%" border="1" cellpadding="15" align="center" >
				<td>

					<table border="1px" width = "50%">
						<tr v-for="(course, index) in courses">
							<td>{{course.CourseNo + ' ' + course.Title + ' ' + course.Credit}}</td>
							<td><button @click="insert(index)">Insert</button></td>
						</tr>
					</table>
				</td>
				<td>

					<table border="1px">
						<tr v-for="(course, index) in selected_courses">
							<td>{{course.CourseNo + ' ' + course.Title + ' ' + course.Credit}}</td>
							<td>
								<button @click="remove(index)">Remove</button>
							</td>
							<td><input type="checkbox" name="" v-model="course.is_retake"></td>
						</tr>
					</table>
				</td>
			</table>
			<input type="submit" name="" value="Submit" @click="ajaxCall">

		</div>
	</div>
	<script src="https://unpkg.com/vue@2.2.6"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.1/axios.js" charset="utf-8"></script>
	<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
	<script type="text/javascript">


	var app = new Vue({
		el: '#vm',
		data: {
			courses: <?php echo json_encode($courses,  JSON_PRETTY_PRINT); ?>,
			selected_courses: [],
			term: ''
		},
		methods: {
			insert: function(i) {
				var item = this.courses[i];
				this.courses.splice(i, 1);
				this.selected_courses.splice(this.selected_courses.length, 0, item);
			},
			remove: function(i) {
				var item = this.selected_courses[i];
				this.selected_courses.splice(i, 1);
				this.courses.splice(this.courses.length, 0, item);
			},
			ajaxCall: function () {
				var sc = JSON.stringify(this.selected_courses);
				// axios.post('home2.php',{data: this.selected_courses}).then((response)=> {alert(response.data);})
				$.post('home2.php', {
					data: sc,
					session: '<?php if(isset($_POST['session'])) echo $_POST['session']; else echo 'null'; ?>',
					std_id: '<?php echo $_SESSION['std_id']; ?>',
					term: this.term
				},
					function (response) {
					alert(response)
				});
			}
		}
	})
	</script>
	</body>
	</html>
