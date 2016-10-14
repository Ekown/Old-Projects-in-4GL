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

	//query for the current year and current sem
	$curr_request = mysqli_query($conn,"SELECT current_year, current_sem FROM tbl_current_year");


	$curr_rows = mysqli_fetch_row($curr_request);

	//current year level and sem
	$curr_year_level = ($curr_rows[0] - $year) + 1;
	$curr_sem = $curr_rows[1] - 1;
	$curr_year = $curr_rows[0];
	
	//gets all the possible years of a student
	$search_year_request = mysqli_query($conn,"SELECT DISTINCT tbl_syllabus.acad_year
								FROM tbl_syllabus
								JOIN tbl_stud_program ON tbl_syllabus.program_id = tbl_stud_program.program_id
								WHERE tbl_stud_program.student_id = $st_num");

	$year_num_rows = mysqli_num_rows($search_year_request);

	for($i=0;$i<$year_num_rows;$i++)
	{
		$year_result = mysqli_fetch_row($search_year_request);

		$search_year[$i] = $year_result[0];
	}

	json_encode($search_year);
	
	//display type of grades (default is all)
	$disp_type = "all";
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
		<link href="css/accord.css" rel="stylesheet">

		<script src="js/jspdf.min.js"></script>
		<script src="js/jspdf.plugin.autotable.js"></script>

		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		

	</head>

	<body onload="generateAccord();">
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
			welp
			</div>
			
			<button class="accordion">All My Grades</button>
				<div class="panel" style="overflow-y: auto">
					<div class="container">

						<?php 		

							echo $disp_type;

							$total = 0.00;

							$sem = 1;
							$flag = 3;

							$ctr=0;

							//loop by year
							for($i=$year;$i<($year+$curr_year_level);$i++)
							{	
								echo $i;
									
								if($i==$curr_year)
									$flag = 2;
								//loop by sem
								for($j=1;$j<$flag;$j++,$ctr++)
								{	
									echo $j;
								
									echo "<div class=\"table table-responsive\">
										<table align ='center' class=\"table table-hover\" id=\"100\">
											<thead>
												<tr>
													<th>Subject Code</th>
													<th>Section</th>
													<th>Subject Title</th>
													<th>Units</th>
													<th>Grades</th>
													<th>Remarks</th>
												</tr>	
											</thead>";

									$grades_request = mysqli_query($conn,"SELECT tbl_subject.subject_code, tbl_classes.section, tbl_subject.subject_title, tbl_subject.units, tbl_grades.grades,
										tbl_grades.remark
										FROM tbl_subject
										JOIN tbl_classes ON tbl_subject.subject_code = tbl_classes.subject_code
										JOIN tbl_grades ON tbl_classes.class_id = tbl_grades.class_id 
										WHERE tbl_grades.student_id = '$st_num'
										AND tbl_classes.acad_year = '$i' AND tbl_classes.sem = '$j' ;");

									$grades_num[$ctr] = mysqli_num_rows($grades_request);

									$total_units = 0;
									$num_units = 0;
									$num_grades = 0;
									$sum_grades = 0;

									//loop by table row
									for($k=0;$k<mysqli_num_rows($grades_request);$k++)
									{	

										$grades_result = mysqli_fetch_row($grades_request);

										echo "<tr>";

										//loop by table data
										for($l=0;$l<6;$l++)
										{
											echo "<td>";
											
											$arr_data[$ctr][$k][$l] = $grades_result[$l];
											echo $arr_data[$ctr][$k][$l];
											echo "</td>";

											if($l == 3)
											{
												$num_units = $arr_data[$ctr][$k][$l];
												$total_units = $total_units + $arr_data[$ctr][$k][$l]; 
											}
											else if($l == 4)
												$num_grades = $arr_data[$ctr][$k][$l];



										}

										$sum_grades = $sum_grades + ($num_units * $num_grades);

										echo "</tr>";
									}

									if($k == mysqli_num_rows($grades_request))
									{
									echo "<tr>";
									$total_gwa[$ctr] = $sum_grades/$total_units;
									echo "<td colspan='6' align='center'>"; echo "Total GWA: ".number_format($total_gwa[$ctr],2); echo "</td>";
									echo "</tr>";
									}
									echo "</table>
										</div>";

								}

								
							}
						?>
						<button type="button" class="btn btn-primary" onclick="printPDF(10)">Export to PDF</button>

					</div>
				</div>

			<button class="accordion">My Grades by Year</button>
				<div class="panel" style="overflow-y: auto">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-lg-offset-2">
								<form action="#" method="post" id="searchForm" class="input-group">
									<div class="input-group-btn search-panel">
										<select name="search_param" id="search_dropdown" class="btn btn-default dropdown-toggle" data-toggle="dropdown" onchange="generateYear();">
											<option value=""></option>
											<?php

												for($i=0;$i<$year_num_rows;$i++)
												{
													echo "<option value=\"$search_year[$i]\">$search_year[$i]</option>";
													}	

											?>
										</select>
									</div>
								</form>
							</div> 
						</div>
					</div>

					<div class="container">

						
						<?php

							for($i=0;$i<$ctr;$i++)
							{
								echo "<div class=\"table table-responsive\"  >
										<table class=\"table table-hover\" id=\"$i\" style=\"display: none;\">
											<thead>
												<th>Subject Code</th>
												<th>Section</th>
												<th>Subject Title</th>
												<th>Units</th>
												<th>Grades</th>
												<th>Remarks</th>
											</thead>

											<tbody>";
								$total_units = 0;
									$num_units = 0;
									$num_grades = 0;
									$sum_grades = 0;

								for($j=0;$j<$grades_num[$i];$j++)
								{	
									echo "<tr>";
									for($k=0;$k<6;$k++)
									{
										echo "<td>";
										echo $arr_data[$i][$j][$k];
										echo "</td>";


											if($k == 3)
											{
												$num_units = $arr_data[$i][$j][$k];
												$total_units = $total_units + $arr_data[$i][$j][$k]; 
											}
											else if($k == 4)
												$num_grades = $arr_data[$i][$j][$k];

									}

									$sum_grades = $sum_grades + ($num_units * $num_grades);

									echo "</tr>";
								}

									if($j == mysqli_num_rows($grades_request))
									{
									echo "<tr>";
									$total_gwa[$i] = $sum_grades/$total_units;
									echo "<td colspan='6' align='center'>"; echo "Total GWA: ".number_format($total_gwa[$i],2); echo "</td>";
									echo "</tr>";
									}

								echo "</tbody>
									</table>
								</div>

								<button class=\"btn btn-primary\" id=\"button$i\" style=\"display: none;\" onclick=\"printPDF($i);\">Export to PDF</button>
								";
							}

						?>
					</tbody>
				</table>
			</div>

		</div>
	 </div>				
			
			<!--
			<div class="container">
				<div class="row">
					<div class="col-md-12">		
						<center><?php //echo "Total GWA: ".number_format($total,2)/$loop_num; ?></center>
					</div>
				</div>
			</div>
			-->

		</div>
			

		</div>
		
		<script>	

			
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			    acc[i].onclick = function(){
			        this.classList.toggle("active");
			        this.nextElementSibling.classList.toggle("show");
			  }
			}
		
			function logout()
			{
				if(confirm("Are you sure you want to logout?"))
				{
					window.location= "logout.php";
				}
		
			}

			function generateYear()
			{
				var list = document.getElementById("search_dropdown");
				var list_val = list.options[list.selectedIndex].text;

				switch(list_val)
				{
					case <?php echo json_encode($search_year[0]) ?>:
						
						document.getElementById('0').style.display = "block";
						document.getElementById('button0').style.display = "block";

						document.getElementById('1').style.display = "block";
						document.getElementById('button1').style.display = "block";

						document.getElementById('2').style.display = "none";
						document.getElementById('button2').style.display = "none";

						document.getElementById('3').style.display = "none";
						document.getElementById('button3').style.display = "none";

						document.getElementById('4').style.display = "none";
						document.getElementById('button4').style.display = "none";

						document.getElementById('5').style.display = "none";
						document.getElementById('button5').style.display = "none";

						document.getElementById('6').style.display = "none";
						document.getElementById('button6').style.display = "none";

						document.getElementById('7').style.display = "none";
						document.getElementById('button7').style.display = "none";

						break;
					case <?php echo json_encode($search_year[1]) ?>:

						document.getElementById('0').style.display = "none";
						document.getElementById('button0').style.display = "none";

						document.getElementById('1').style.display = "none";
						document.getElementById('button1').style.display = "none";

						document.getElementById('2').style.display = "block";
						document.getElementById('button2').style.display = "block";

						document.getElementById('3').style.display = "block";
						document.getElementById('button3').style.display = "block";

						document.getElementById('4').style.display = "none";
						document.getElementById('button4').style.display = "none";

						document.getElementById('5').style.display = "none";
						document.getElementById('button5').style.display = "none";

						document.getElementById('6').style.display = "none";
						document.getElementById('button6').style.display = "none";

						document.getElementById('7').style.display = "none";
						document.getElementById('button7').style.display = "none";

						break;
					case <?php echo json_encode($search_year[2]) ?>:

						document.getElementById('0').style.display = "none";
						document.getElementById('button0').style.display = "none";

						document.getElementById('1').style.display = "none";
						document.getElementById('button1').style.display = "none";

						document.getElementById('2').style.display = "none";
						document.getElementById('button2').style.display = "none";

						document.getElementById('3').style.display = "none";
						document.getElementById('button3').style.display = "none";

						document.getElementById('4').style.display = "block";
						document.getElementById('button4').style.display = "block";

						document.getElementById('5').style.display = "block";
						document.getElementById('button5').style.display = "block";

						document.getElementById('6').style.display = "none";
						document.getElementById('button6').style.display = "none";

						document.getElementById('7').style.display = "none";
						document.getElementById('button7').style.display = "none";

						break;
				case <?php echo json_encode($search_year[3]) ?>:
				
					document.getElementById('0').style.display = "none";
					document.getElementById('button0').style.display = "none";

					document.getElementById('1').style.display = "none";
					document.getElementById('button1').style.display = "none";

					document.getElementById('2').style.display = "none";
					document.getElementById('button2').style.display = "none";

					document.getElementById('3').style.display = "none";
					document.getElementById('button3').style.display = "none";

					document.getElementById('4').style.display = "none";
					document.getElementById('button4').style.display = "none";

					document.getElementById('5').style.display = "none";
					document.getElementById('button5').style.display = "none";

					document.getElementById('6').style.display = "block";
					document.getElementById('button6').style.display = "block";
				
					document.getElementById('7').style.display = "block";
					document.getElementById('button7').style.display = "block";
					
					break;

				}

				
			}

			function printPDF(number)
			{
				var x = number;
				//creates a new jsPDF instance
				var doc = new jsPDF('p', 'pt');

				//creates a new Image instance
				var logo = new Image();

				//gets the table by id from HTML
				var res = doc.autoTableHtmlToJson(document.getElementById(x));

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
				doc.text(230,220, "SUMMARY OF GRADES");
				doc.autoTable(res.columns, res.rows, {startY: 230});

				doc.save("table.pdf");

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