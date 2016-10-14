<?php
	require "connect.php";
	
	if(!session_id())
	{
	
		session_start();
			
		//user id or faculty id of the current user of the CRS
		$user = $_SESSION['user'];
		$des_id = $_SESSION['level'];

		json_encode($des_id);
	}

	$st_num = $_SESSION['stud_num'];

	json_encode($st_num);


	//query for the user_id
	$id_request = mysqli_query($conn,"SELECT user_id FROM `tbl_user` WHERE user_name = '$user' ;");

	//array containing the user_id
	$id = mysqli_fetch_row($id_request); 
	$year = $_SESSION['a_year'];
	
	$subject_request = mysqli_query($conn,"SELECT faculty.");
		
?>

<script>
$(document).ready(function(){
$(#drop).change(function(){
$(#myform).submit();


});



});



$(document).ready(function(){
$(#studentt).change(function(){
$(#myform).submit();


});



});


$(document).ready(function(){
$(#gradess).change(function(){
$(#myform).submit();


});



});


$(document).ready(function(){
$(#cogg).change(function(){
$(#myform).submit();


});



});


</script>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>PLM CRS</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<link href="css/basic_template.css" rel="stylesheet" type="text/css">
		<link href  = "css/sidenav.css" rel = "stylesheet">

		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		
	</head>

	<body>

		<nav class="navbar navbar-inverse sidebar" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">PLM-CRS</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="info.php">Profile
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span>
							</a>
						</li>

						<li id="grades" style="display: none;">
							<a href="grades.php" >Summary of Grades
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span>
							</a>
						</li>

						<li id="audit" style="display: none;">
							<a href="#" >Audit
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span>
							</a>
						</li>
						
						<li id="encode" style="display: none;">
							<a href="encode.php">Encoding of Grades
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>
						
						<li id="cog" style="display: block;">
							<a href="cog.php">Change Grade
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>
						
						<li id="schedule" style="display: none;">
							<a href="schedule.php">Schedule
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list"></span>
							</a>
						</li>
						
						<li id="subreport" style="display: none;">
							<a href="stat_report.php">Subject Report
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list"></span>
							</a>
						</li>

						<li>
							<a href="#" id="logout" onclick="logout();">Log-Out
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="main">

			<div class="jumbotron">
				<div class="title" id="header">Summary of Grades</div>
			</div>
			
			<div class="container">
				
				
			<form id="myform" action=#  method="POST">	
				<?php
				$subject_request = mysqli_query($conn, "SELECT tbl_subject.subject_title
							   FROM `tbl_user`
							   JOIN `tbl_faculty` ON tbl_faculty.user_id = tbl_user.user_id
							   JOIN `tbl_classes` ON tbl_faculty.faculty_id = tbl_classes.faculty_id
							   JOIN `tbl_subject` ON tbl_classes.subject_code = tbl_subject.subject_code
							   WHERE tbl_user.user_id = '$id[0]' ");
		
				$numrows = mysqli_num_rows($subject_request);
	
				echo "<br><br>";

				echo "<select name = 'subjectoption' id='drop' onchange='this.form.submit()'>";
				echo "<option>"; 
				if(isset($_POST['subjectoption'])) 
				{
					$subjectoption = $_POST['subjectoption'];
					echo $subjectoption; 
				}
				echo "</option>";
					for($i=0;$i<$numrows;$i++)
					{
						$row = mysqli_fetch_row($subject_request);
						for($j=0; $j<1; $j++)
						{
						echo "<option value = '$row[$j]'>"; 
						echo $row[$j];
						echo "</option>";
						}			
					}
					
				echo "</select>";
			
			if(isset($_POST['subjectoption']))
			{	
			
			$subjects = $_POST['subjectoption'];
			
			echo "SUBJECT GRADE: ".$subjects;
			
			$_SESSION['session_subjectoption'] = $subjects;
			
			}
			
			if(isset($_POST['subjectoption']))
			{
				
				$new_subjectoption = $_SESSION['session_subjectoption'];
			
								$query2 = mysqli_query($conn, "SELECT tbl_subject.subject_title,tbl_subject.subject_code,tbl_subject.units, tbl_subject.type
								FROM `tbl_user`
								JOIN `tbl_faculty` ON tbl_faculty.user_id = tbl_user.user_id
								JOIN `tbl_classes` ON tbl_classes.faculty_id = tbl_faculty.faculty_id
								JOIN `tbl_subject` ON tbl_subject.subject_code = tbl_classes.subject_code
								WHERE tbl_user.user_id = '$id[0]' AND tbl_subject.subject_title = '$new_subjectoption' ");
		
				$tow = mysqli_fetch_row($query2);
		
				echo "Subject Title: ".$tow[0]."<br>Subject Name: ".$tow[1]."<br>Credits: ".$tow[2]."<br>Type: ".$tow[3];

				$student_request = mysqli_query($conn, "SELECT tbl_student.student_id
												FROM `tbl_user`
												JOIN `tbl_faculty` ON tbl_faculty.user_id = tbl_user.user_id
												JOIN `tbl_classes` ON tbl_faculty.faculty_id = tbl_classes.faculty_id
												JOIN `tbl_subject` ON tbl_classes.subject_code = tbl_subject.subject_code
												JOIN `tbl_grades` ON tbl_classes.class_id = tbl_grades.class_id
												JOIN `tbl_student` ON tbl_student.student_id = tbl_grades.student_id
											   WHERE tbl_user.user_id = '$id[0]' AND tbl_subject.subject_title = '$new_subjectoption' ");
			
				$numrows = mysqli_num_rows($student_request);
	
				echo "<br><br>";

				echo "<select name = 'studentoption' id='studentt' onchange='this.form.submit()'>";
				echo "<option>"; 
				if(isset($_POST['studentoption'])) 
				{
					$studentoption = $_POST['studentoption'];
					echo $studentoption; 
				}
				echo "</option>";
					for($i=0;$i<$numrows;$i++)
					{
						$row = mysqli_fetch_row($student_request);
						for($j=0; $j<1; $j++)
						{
						echo "<option value = '$row[$j]'>"; 
						echo $row[$j];
						echo "</option>";
						}			
					}
					
				echo "</select>";
				
				if(isset($_POST['studentoption']))
				{	
				
				$students = $_POST['studentoption'];
				
				echo "STUDENT: ".$students;

				
				$_SESSION['session_studentoption'] = $students;
				
				}
			
			}

			if(isset($_POST['studentoption']))
			{
				$new_subjectoption = $_SESSION['session_subjectoption'];
				$new_studentoption = $_SESSION['session_studentoption'];

				$query4 = mysqli_query($conn, "SELECT tbl_student.student_id, tbl_student.student_fname, tbl_student.student_mname, tbl_student.student_lname
							   FROM `tbl_user`
							   JOIN `tbl_faculty` ON tbl_faculty.user_id = tbl_user.user_id
							   JOIN `tbl_classes` ON tbl_faculty.faculty_id = tbl_classes.faculty_id
							   JOIN `tbl_subject` ON tbl_classes.subject_code = tbl_subject.subject_code
							   JOIN `tbl_grades` ON tbl_classes.class_id = tbl_grades.class_id
							   JOIN `tbl_student` ON tbl_student.student_id = tbl_grades.student_id
							   WHERE tbl_user.user_id = '$id[0]' AND tbl_subject.subject_title = '$new_subjectoption' AND tbl_student.student_id = '$new_studentoption' ");
		
				$sow = mysqli_fetch_row($query4);
		
				echo "Student ID: ".$sow[0]." Student First Name: ".$sow[1]." Student Middle Name: ".$sow[2]." Student Last Name: ".$sow[3];

				$query5 = mysqli_query($conn, "SELECT tbl_grades.grades
							   FROM `tbl_user`
							   JOIN `tbl_faculty` ON tbl_faculty.user_id = tbl_user.user_id
							   JOIN `tbl_classes` ON tbl_faculty.faculty_id = tbl_classes.faculty_id
							   JOIN `tbl_subject` ON tbl_classes.subject_code = tbl_subject.subject_code
							   JOIN `tbl_grades` ON tbl_classes.class_id = tbl_grades.class_id
							   JOIN `tbl_student` ON tbl_student.student_id = tbl_grades.student_id
							   WHERE tbl_user.user_id = '$id[0]' AND tbl_subject.subject_title = '$new_subjectoption' AND tbl_student.student_id = '$new_studentoption' ");
			
				$numrows = mysqli_num_rows($query5);
	
				echo "<br><br>";

				echo "<select name = 'gradesoption' id='gradess' onchange='this.form.submit()'>";
				echo "<option>"; 
				if(isset($_POST['gradesoption'])) 
				{
					$gradesoption = $_POST['gradesoption'];
					echo $gradesoption; 
				}
				echo "</option>";
					for($i=0;$i<$numrows;$i++)
					{
						$row = mysqli_fetch_row($query5);
						for($j=0; $j<1; $j++)
						{
						echo "<option value = '$row[$j]'>"; 
						echo $row[$j];
						echo "</option>";
						}			
					}
					
				echo "</select>";

				if(isset($_POST['gradesoption']))
				{	
				
				$grades = $_POST['gradesoption'];
				
				echo "GRADE: ".$grades;

				
				$_SESSION['session_gradesoption'] = $grades;
				
				}

			}

			if(isset($_POST['studentoption']))
			{
				$new_subjectoption = $_SESSION['session_subjectoption'];
				$new_studentoption = $_SESSION['session_studentoption'];
				$new_gradeoption = $_SESSION['session_gradesoption'];

				echo "<select name='cog' id='cogg' onchange='this.form.submit()'>";
				echo "<option value='1.00'>";
				echo "1.00";
				echo "</option>";
				echo "<option value='1.00'>";
				echo "1.00";
				echo "</option>";
				echo "<option value='1.25'>";
				echo "1.25";
				echo "</option>";
				echo "<option value='1.50'>";
				echo "1.50";
				echo "</option>";
				echo "<option value='1.75'>";
				echo "1.75";
				echo "</option>";
				echo "<option value='2.00'>";
				echo "2.00";
				echo "</option>";
				echo "<option value='2.25'>";
				echo "2.25";
				echo "</option>";
				echo "<option value='2.50'>";
				echo "2.50";
				echo "</option>";
				echo "<option value='2.75'>";
				echo "2.75";
				echo "</option>";
				echo "<option value='3.00'>";
				echo "3.00";
				echo "</option>";
				echo "<option value='5.00'>";
				echo "5.00";
				echo "</option>";
				echo "</select>";

				if(isset($_POST['cog']))
				{
				$new_cog = $_POST['cog'];
				$update_grades = mysqli_query($conn, "UPDATE tbl_grades SET tbl_grades.grades = '$new_cog' WHERE tbl_grades.student_id = '$new_studentoption' AND tbl_grades.class_id = 'CLS1-1' AND tbl_grades.acad_year = 2013 AND tbl_grades.sem = 1");

				echo "You Changed to: ".$new_cog;
				}
			}

			?>	
			
				
			</form>
				
			</div>

		</div>
		

		<script>	

			function logout()
			{
				if(confirm("Are you sure you want to logout?"))
				{
					window.location= "login.php";
				}
		
			}

			//changes the header based on the user level
			switch( <?php echo json_encode($des_id); ?> )
			{
					case "Faculty":
						document.getElementById('header').innerHTML = "Faculty Info";
						document.getElementById('encode').style.display = "block";
						document.getElementById('schedule').style.display = "block";
						break;
					case "Chairperson":
						document.getElementById('subreport').style.display = "block";
						document.getElementById('header').innerHTML = "Chairperson Info";
						document.getElementById('schedule').style.display = "block";
						break;
					case "Dean":
						document.getElementById('subreport').style.display = "block";
						document.getElementById('header').innerHTML = "Dean Info";
						document.getElementById('schedule').style.display = "block";
						break;
					case "VPAA":
						document.getElementById('header').innerHTML = "VPAA Info";
						document.getElementById('trans_id').innerHTML = "VPAA ID:";
						document.getElementById('subreport').style.display = "block";
						break;
					case "Admin":
						document.getElementById('header').innerHTML = "Admin Info";
						document.getElementById('audit').style.display = "block";
						document.getElementById('cog').style.display = "none";
						document.getElementById('trans_id').innerHTML = "Admin ID:";
						document.getElementById('dept').style.display = "none";
						document.getElementById('college').style.display = "none";
						break;

				default:
					
					document.getElementById('schedule').style.display = "block";
					document.getElementById('grades').style.display = "block";
					document.getElementById('header').innerHTML = "Student Info";
					document.getElementById('trans_id').innerHTML = "Student ID:";
					document.getElementById('gender').style.display = "block";
					document.getElementById('cog').style.display = "none";
					document.getElementById('location').style.display = "block";
					document.getElementById('contact').style.display = "block";
					document.getElementById('program').style.display = "block";
					document.getElementById('year').style.display = "block";
					break;
				
				
			}

				

		</script>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-3.1.0.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>