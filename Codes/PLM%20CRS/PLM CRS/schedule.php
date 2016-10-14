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
	$st_name = $_SESSION['stud_name'];
	$st_prog = $_SESSION['program'];

	json_encode($st_num);
	json_encode($st_name);
	json_encode($st_prog);

	//query for the user_id
	$id_request = mysqli_query($conn,"SELECT user_id FROM `tbl_user` WHERE user_name = '$user' ;");

	//array containing the user_id
	$id = mysqli_fetch_row($id_request); 
	
	$year = $_SESSION['a_year'];
	$sem = 1;

	$sched_request = mysqli_query($conn,"SELECT tbl_subject.subject_code, tbl_classes.section, tbl_subject.subject_title, tbl_subject.units, tbl_classes.time_start, tbl_classes.time_end, tbl_room.room_name
		FROM tbl_grades
		JOIN tbl_classes ON tbl_grades.class_id = tbl_classes.class_id
		JOIN tbl_subject ON tbl_classes.subject_code = tbl_subject.subject_code
		JOIN tbl_room ON tbl_classes.room_id = tbl_room.room_id
		WHERE tbl_grades.student_id = '$st_num'  AND tbl_classes.acad_year = '$year' AND tbl_classes.sem = '$sem' ;");
	$num_rows = mysqli_num_rows($sched_request);

	$curr_request = mysqli_query($conn,"SELECT current_year, current_sem FROM tbl_current_year");

	$curr_rows = mysqli_fetch_row($curr_request);

	$curr_year = ($curr_rows[0] - $year) + 1;
	$curr_sem = $curr_rows[1] - $sem;

	switch($curr_year)
	{
		case 1:
			$str_year = "First Year";
			break;
		case 2:
			$str_year = "Second Year";
			break;
		case 3: 
			$str_year = "Third Year";
			break;
		case 4:
			$str_year = "Fourth Year";
			break;
	default:
		$str_year = "Fifth Year";
		break;
	}

	$str_sem = ($curr_sem == 1?"First Semester":"Second Semester");

	
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
		<link href="css/sidenav.css" rel ="stylesheet">

		<script src="js/jspdf.min.js"></script>
		<script src="js/jspdf.plugin.autotable.js"></script>

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
					<div class="navbar-brand">PLM-CRS</div>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="info.php">My Profile
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
							<a href="schedule.php">My Schedule
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
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span>
							</a>
						</li>
							
					</ul>
				</div>
			</div>
		</nav>

		<div class="main">
			<div class="jumbotron">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<span><center><strong>MY SCHEDULE</strong></center></span>
						</div>
					</div>
				</div>
			</div>

				<div class="container">
						<center>
						<?php echo $str_year.", ".$str_sem; ?>
							<div class="table table-responsive">
								<table class="table table-hover" id="sched">
									<thead>
										<tr>
											<th>Subject Code</th>
											<th>Section</th>
											<th>Subject Title</th>
											<th>Units</th>
											<th>Time Start</th>
											<th>Time End</th>
											<th>Room</th>
										</tr>	
									</thead>

								<tbody>
								
								<?php 
									for($i=0;$i<=$num_rows;$i++)
									{
										echo "<tr>";
										$sched = mysqli_fetch_row($sched_request);
											for($j=0;$j<7;$j++)
											{	
												echo "<td>";
												echo $sched[$j];
												echo "</td>";
											}

										echo "</tr>";		
									}	
								?>

						</tbody>
					</table>
				 </div>
				</center>
			 <button type="button" class="btn btn-primary" onclick="printPDF()">Export to PDF</button>

				</div> 
			<br>	

		</div>
		
		<script>	

			function logout()
			{
				if(confirm("Are you sure you want to logout?"))
				{
					window.location= "logout.php";
				}
		
			}

			function printPDF()
			{
				//creates a new jsPDF instance
				var doc = new jsPDF('p', 'pt');

				//creates a new Image instance
				var logo = new Image();

				//gets the table by id from HTML
				var res = doc.autoTableHtmlToJson(document.getElementById("sched"));

				//gets the source path of the plm logo
				logo.src = 'img/plmlogo.jpg';

				//adds the logo to the pdf
				doc.addImage(logo, 'PNG', 113, 22, 70, 70);

				doc.setFontSize(13);
				doc.setFont("helvetica","italic");
				doc.text(212, 59, "(University of the City of Manila)");

				doc.setFontSize(11);
				doc.setFont("helvetica", "italic");
				doc.text(255, 70, "Intramuros, Manila");

				doc.setFontSize(15);
				doc.setFont("Helvetica","Bold");
				doc.text(198, 42, "Pamantasan ng Lungsod ng Maynila");

				doc.setFontSize(11);
				doc.setFont("helvetica","Bold");
				doc.text(40, 140, "Student Number: " + <?php echo json_encode($st_num); ?>);
				doc.text(40, 160, "Name: " + <?php echo json_encode($st_name); ?>);
				doc.text(40, 180, "Program: " + <?php echo json_encode($st_prog); ?>);
				doc.text(380, 140,"Date: _______________");
				doc.text(380, 160, "Address: ________________");
				doc.setFontSize(13);
				doc.text(230,220, "STUDENT SCHEDULE");
				doc.autoTable(res.columns, res.rows, {startY: 230});

				doc.save("Schedule.pdf");
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