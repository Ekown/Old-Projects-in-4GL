<?php
	require "connect.php";
	
	if(!session_id())
	{
	
		session_start();
			
		//user id or faculty id of the current user of the CRS
		$user = $_SESSION['user'];
		

		
	}
	$des_id = $_SESSION['level'];
	json_encode($des_id);
	
	
	//query for the user_id
	$id_request = mysqli_query($conn,"SELECT user_id FROM `tbl_user` WHERE user_name = '$user' ;");

	//array containing the user_id
	$id = mysqli_fetch_row($id_request); 

	//decides the which set of user info to use
	switch($des_id)
	{


		case "Admin":

			//query for the faculty info
			$admin_request = mysqli_query($conn,"SELECT admin_id,admin_lname, admin_fname, admin_mname
				FROM `tbl_admin` WHERE user_id = '$id[0]' ;");
 
			//array containing the faculty info
			$admin_info = mysqli_fetch_row($admin_request);

			$info[0] = $admin_info[0];
			$info[1] = $admin_info[1].", ".$admin_info[2]." ".$admin_info[3];

			break;

		case "Student":

			$student_request = mysqli_query($conn,"SELECT st.student_id, st.student_lname, st.student_fname, st.student_mname, dp.dept_title, 
			col.college_title, pr.program_title, st.entry_year, st.student_gender, loc.location, pro.contact_no
				FROM `tbl_student` as st
				JOIN `tbl_stud_location` as lo ON st.student_id = lo.student_id
                JOIN `tbl_location` as loc ON lo.location_id = loc.location_id
				JOIN `tbl_stud_program` as prg ON st.student_id = prg.student_id
				JOIN `tbl_program` as pr ON prg.program_id = pr.program_id
				JOIN `tbl_department` as dp ON pr.dept_id = dp.dept_id
				JOIN `tbl_college` as col ON dp.college_id = col.college_id
				JOIN `tbl_stud_profile` as pro ON st.student_id = pro.student_id
				WHERE user_id = '$id[0]' ;"
			);

			$student_info = mysqli_fetch_row($student_request);

			$info[0] = $student_info[0];
			$info[2] = $student_info[4];
			$info[3] = $student_info[5];
			$info[4] = $student_info[6];
			$info[5] = $student_info[7];
			$info[6] = $student_info[8];
			$info[7] = $student_info[9];
			$info[8] = $student_info[10];
			
			$info[1] = $student_info[1].", ".$student_info[2]." ".$student_info[3];

			$_SESSION['stud_num'] = $info[0];
			$_SESSION['a_year'] = $info[5];
			$_SESSION['stud_name'] = $info[1];
			$_SESSION['program'] = $info[4];

			break;
			
			
			
			$acad_stud = mysqli_query ($conn,"SELECT DISTINCT tbl_college.college_title, tbl_reg_status_id.reg_status, tbl_stud_status.scholastic_status, tbl_stud_status.academic_standing, tbl_stud_status.year_level, tbl_stud_status.student_type
			FROM tbl_student
			JOIN tbl_stud_program ON tbl_student.student_id = tbl_stud_program.student_id
			JOIN tbl_program ON tbl_stud_program.program_id = tbl_program.program_id
			JOIN tbl_user ON tbl_student.user_id = tbl_user.user_id
			JOIN tbl_department ON tbl_program.dept_id = tbl_department.dept_id
			JOIN tbl_college ON tbl_department.college_id = tbl_college.college_id
			JOIN tbl_reg_status ON tbl_student.student_id = tbl_reg_status.student_id
			JOIN tbl_reg_status_id ON tbl_reg_status.reg_id = tbl_reg_status_id.reg_id
			JOIN tbl_stud_status ON tbl_student.student_id = tbl_stud_status.student_id
			WHERE tbl_student.student_id = $st_num AND tbl_stud_status.acad_year = '$year' AND tbl_stud_status.sem = '$sem' ;");
			
			$acad_stud = mysqli_fetch_row($acad_stud);
			
			echo $acad_stud[0];
			echo $acad_stud[1];
			echo $acad_stud[2];
			echo $acad_stud[3];
			echo $acad_stud[4];
			echo $acad_stud[5];
			
			
	
	default:

		//query for the faculty info
		$faculty_request = mysqli_query($conn,"SELECT f.faculty_id, f.faculty_lname, f.faculty_fname, f.faculty_mname,
			d.dept_title, c.college_title FROM `tbl_faculty` as f
			JOIN `tbl_department` as d ON f.dept_id = d.dept_id
			JOIN `tbl_college` as c ON d.college_id = c.college_id
			WHERE user_id = '$id[0]' ");

		//array containing the faculty info
		$faculty_info = mysqli_fetch_row($faculty_request);

		$info[0] = $faculty_info[0];
		$info[2] = $faculty_info[4];
		$info[3] = $faculty_info[5];
		$info[1] = $faculty_info[1].", ".$faculty_info[2]." ".$faculty_info[3];

		break;

	}

	
	
	
		
?>

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
		<link href ="css/sidenav.css" rel = "stylesheet">

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
							<a href="#">Encoding of Grades
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>
						
						<li id="cog" style="display: block;">
							<a href="cog.php">Change Grade
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>
						
						<li id="view" style="display: none;">
							<a href="viewgradesfaculty.php">Viewing of Grades
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span>
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
						
						<li id="cop" style="display: block;">
							<a href="cop.php" onclick = "changePass();">Change Password
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>						
						
						<li>
							<a href="#" id="logout" onclick="logout();">Log-Out
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span>
							</a>
						</li>
							
					</ul>
				</div>
			</div>
		</nav>

		<div class="main">

			<div class="container">
				<center><img class = "img-responsive" src = "img/plmlogo.jpg" width="100" height="100"></center>
			</div>
			<br>
			
			<!---Info -->
			
			<fieldset class = " well col-lg-12 col-md-12 col-xs-12 col-sm-12">
			<font color = "white"><center><h3><strong id="name">Student Information</strong></h3></center>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
							<span id="trans_id">Faculty ID:</span> <?php echo $info[0]; ?>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
							Name: <?php echo $info[1]; ?>
						</div>	
					</div>
				</div>

				<div class="container" id="extra_username" style="display:none;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
							Account	Username: <?php echo $user; ?>
						</div>
					</div>
				</div>

				<div class="container" id="gender" style="display:none;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
							Gender: <?php echo $info[6]; ?>
						</div>
					</div>
				</div>

				<div class="container" id="location">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12" style = "display:none;">
							Location: <?php echo $info[7]; ?>
						</div>
					</div>
				</div>	

				<div class="container" id="contact" style = "display:none;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
							Contact No: <?php echo $info[8]; ?>
						</div>
					</div>
				</div>

			</fieldset>
			
			
			<!---Academic Info -->
			<div id="acadinfo">
				<fieldset class = "well col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<center><h3><strong id="acad">Academic Information</strong></h3></center>
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
									Account	Username: <?php echo $user; ?>
								</div>
							</div>
						</div>
						<div class="container" id="program" style = "display:none;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
									Program: <?php echo $info[4]; ?>
								</div>
							</div>
						</div>

						<div class="container" id="year" style = "display:none;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
									Entry Year: <?php echo $info[5]; ?>
								</div>
							</div>
						</div>

						<div class="container" id="dept" style = "display:block;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
									Department: <?php echo $info[2]; ?>
								</div>
							</div>
						</div>

						<div class="container" id="college" style = "display:block;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
									College: <?php echo $info[3]; ?>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</font>
			
			<hr>
			
			

		</div>

		

		<script>	

			function logout()
			{
				if(confirm("Are you sure you want to logout?"))
				{
					window.location= "logout.php";
				}
		
			}
			
			function changePass()
			{
				
				window.location="cop.php";
			}
				

			//changes the header based on the user level
			switch( <?php echo json_encode($des_id); ?> )
			{
					case "Faculty":
						document.getElementById('encode').style.display = "block";
						document.getElementById('trans_id').innerHTML = "Faculty ID:";
						document.getElementById('schedule').style.display = "block";
						document.getElementById('view').style.display = "block";
						document.getElementById('name').innerHTML = "Faculty Information";
						document.getElementById('acad').innerHTML = "";
						document.getElementById('dept').style.display = "block";
						document.getElementById('college').style.display = "block";					
												
						break;
					case "Chairperson":
						document.getElementById('cog').style.display = "none";
						document.getElementById('subreport').style.display = "block";
						document.getElementById('schedule').style.display = "block";
						document.getElementById('name').innerHTML = "Chairperson Information";
						document.getElementById('trans_id').innerHTML = "Chairperson ID:";
						document.getElementById('acad').innerHTML = "";
						
						break;
					case "Dean":
						document.getElementById('cog').style.display = "none";
						document.getElementById('trans_id').innerHTML = "Dean ID:";
						document.getElementById('subreport').style.display = "block";
						document.getElementById('schedule').style.display = "block";
						document.getElementById('acad').innerHTML = "";
						break;
					case "VPAA":
						document.getElementById('trans_id').innerHTML = "VPAA ID:";
						document.getElementById('subreport').style.display = "block";
						break;
					case "Admin":		
						document.getElementById('audit').style.display = "block";
						document.getElementById('cog').style.display = "none";
						document.getElementById('trans_id').innerHTML = "Admin ID:";
						document.getElementById('extra_username').style.display = "block";
						document.getElementById('acadinfo').style.display = "none";
						
						
						break;

				default:
				
					document.getElementById('grades').style.display = "block";
					document.getElementById('schedule').style.display = "block";
					document.getElementById('cog').style.display = "none";
					document.getElementById('trans_id').innerHTML = "Student ID:";
					document.getElementById('gender').style.display = "block";
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