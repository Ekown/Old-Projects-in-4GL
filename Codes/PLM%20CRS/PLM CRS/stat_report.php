<?php

	if(!session_id())
	{
	
		session_start();
			
		//des id of the current user of the CRS
		
		$des_id = $_SESSION['level'];

		json_encode($des_id);
	}
	
	require  "connect.php";
		
	$arr_sub_year = array ( 2013, 2014, 2015, 2016 );

	//query for getting all the subjects per semester per year
	for($x=0;$x<4;$x++)
	{
		if($subjects_query = mysqli_query($conn, 
			"SELECT `subject_title`, `acad_year`, `sem` FROM `tbl_syllabus` WHERE acad_year = $arr_sub_year[$x] ORDER BY sem ASC"))
		{
			for ($i=0; $i < mysqli_num_rows($subjects_query); $i++) 
			{ 
				$subjects_result = mysqli_fetch_row($subjects_query);	
				$arr_subjects[$x][$i][0] = $subjects_result[0];
			}
		}
	}


	$arr_students = array(	
													array( array(array(1,2),array(3,4),array(5,6)),
																 array(array(7,8),array(9,10),array(11,12))
															 ),

													array(array(array(11,21),array(31,14),array(51,16)),
															  array(array(71,18),array(19,10),array(11,12))
															 ),

													array(array(array(11,21),array(3,4),array(5,6)),
																array(array(72,8),array(9,10),array(11,12))
															 ),

													array(array(array(13,2),array(32,24),array(25,6)),
																array(array(2,22),array(29,10),array(21,12))
															 )	
											 );

	json_encode($arr_students);

	function generateTable($x,$y,&$arr,&$sub,$id)
	{

		$total = array($arr[$x][$y][0][0] + $arr[$x][$y][0][1],
									 $arr[$x][$y][1][0] + $arr[$x][$y][1][1],
									 $arr[$x][$y][2][0] + $arr[$x][$y][2][1]
									);

		$sem = array(array(0,1,2),array(3,4,5));

		echo "<div class='table table-responsive'>
											<table class='table table-hover' id='$id'>
												<thead>
													<tr>
														<th>Subject</th>
														<th>Passed</th>
														<th>Failed</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>".$sub[$x][$sem[$y][0]][0]."</td>
														<td>".$arr[$x][$y][0][0]." </td>
														<td>".$arr[$x][$y][0][1] ." </td>
														<th>".$total[0]." </th>
													</tr>

													<tr>
														<td>".$sub[$x][$sem[$y][1]][0]."</td>
														<td>".$arr[$x][$y][1][0]."</td>
														<td>".$arr[$x][$y][1][1]."</td>
														<th>".$total[1]."</th>
													</tr>

													<tr>
														<td>".$sub[$x][$sem[$y][2]][0]."</td>
														<td>".$arr[$x][$y][2][0]."</td>
														<td>".$arr[$x][$y][2][1]."</td>
														<th>".$total[2]."</th>
													</tr>
												</tbody>
											</table>
											</div>";
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

		<!-- This is where all the CSS code are -->
		<link href="css/basic_template.css" rel="stylesheet" type="text/css">
		<link href  = "css/sidenav.css" rel = "stylesheet">

		<script src="js/chart.bundle.min.js"></script>
		<script src="js/jspdf.min.js"></script>
		<script src="js/jspdf.plugin.autotable.js"></script>

		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		
	</head>
	<body onload="generateChart();">

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
							<a href="info.php">Profile
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span>
							</a>
						</li>

						<li id="grades">
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
							<a href="cog.php">Encoding of Grades
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
							</a>
						</li>
						
						<li id="cog" style="display: block;">
							<a href="cog.php">Change Grade
								<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span>
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
				<center>
				<strong>PASSED AND FAILED STUDENTS PER SUBJECT</strong>
				</center>
			</div>

			<div class="container">
				<ul class="nav nav-tabs nav-justified">
					<li class="active"><a href="#FirstYear" data-toggle="tab">First Year</a></li>
					<li><a href="#SecondYear" data-toggle="tab">Second Year</a></li>
					<li><a href="#ThirdYear" data-toggle="tab">Third Year</a></li>
					<li><a href="#FourthYear" data-toggle="tab">Fourth Year</a></li>
				</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="FirstYear">
							<div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="false" >
								<!-- Indicators -->
								<ol class="carousel-indicators" >
									<li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel1" data-slide-to="1"></li>	
								</ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<div class="item active">
										<div class="container"><center>First Year, First Semester</center> </div>	
									 <br><br>
									 <center><?php generateTable(0,0,$arr_students,$arr_subjects,0); ?></center> 
										 <hr>
											<canvas id="myChart1" class="chart"></canvas>
											<br>
												<center><button type="button" onclick="downloadPDF(0);">Export to PDF</button></center>
									</div>  

									<div class="item">
										<div class="container"><center>First Year, Second Semester</center> </div>	
										<br><br>
									 	<center><?php generateTable(0,1,$arr_students,$arr_subjects,1); ?></center> 

										<canvas id="myChart2" class="chart"></canvas>
										<br>
										<center><button type="button" onclick="downloadPDF(1);">Export to PDF</button></center>
									</div>	
								</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
					</div>
				</div>

				<div class="tab-pane fade" id="SecondYear">
					<div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="false" >
								<!-- Indicators -->
								<ol class="carousel-indicators" >
									<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel2" data-slide-to="1"></li>
								</ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<div class="item active" >
										<div class="container"><center>Second Year, First Semester</center> </div>	
										<br><br>
									 	<center><?php generateTable(1,0,$arr_students,$arr_subjects,2); ?></center> 

										<canvas id="myChart3" class="chart"></canvas>
										<br>

										<center><button type="button" onclick="downloadPDF(2);">Export to PDF</button></center>
									</div>  

									<div class="item">
										<div class="container"><center>Second Year, Second Semester</center> </div>	
										<br><br>
									 	<center><?php generateTable(1,1,$arr_students,$arr_subjects,3); ?></center>

										<canvas id="myChart4" class="chart"></canvas>
											<br>
										<center><button type="button" onclick="downloadPDF(3);">Export to PDF</button></center>
									</div>
								</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
					</div>
				</div>

				<div class="tab-pane fade" id="ThirdYear">
					<div id="myCarousel3" class="carousel slide" data-ride="carousel" data-interval="false" >
								<!-- Indicators -->
								<ol class="carousel-indicators" >
									<li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel3" data-slide-to="1"></li>
								</ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<div class="item active" >
										<div class="container"><center>Third Year, First Semester</center> </div>
										<br><br>
									 	<center><?php generateTable(2,0,$arr_students,$arr_subjects,4); ?></center> 

										<canvas id="myChart5" class="chart"></canvas>
										<br>
										<center><button type="button" onclick="downloadPDF(4);">Export to PDF</button></center>
									</div>   

									<div class="item">
										<div class="container"><center>Third Year, Second Semester</center> </div>
										<br><br>
									 	<center><?php generateTable(2,1,$arr_students,$arr_subjects,5); ?></center>
										<canvas id="myChart6" class="chart"></canvas>

										<br> 
											<center><button type="button" onclick="downloadPDF(5);">Export to PDF</button></center>
									</div>
								</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
					</div>
				</div>

				<div class="tab-pane fade" id="FourthYear">
					<div id="myCarousel4" class="carousel slide" data-ride="carousel" data-interval="false" >
								<!-- Indicators -->
								<ol class="carousel-indicators" >
									<li data-target="#myCarousel4" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel4" data-slide-to="1"></li>
								</ol>

								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<div class="item active" > 
										<div class="container"><center>Fourth Year, First Semester</center> </div>
										<br><br>
									 	<center><?php generateTable(3,0,$arr_students,$arr_subjects,6); ?></center>
										<canvas id="myChart7" class="chart"></canvas>
										<br>
										<center><button type="button" onclick="downloadPDF(6);">Export to PDF</button></center>
									</div>  

									<div class="item">
										<div class="container"><center>Fourth Year, Second Semester</center> </div>
										<br><br>
									 	<center><?php generateTable(3,1,$arr_students,$arr_subjects,7); ?></center>

										<canvas id="myChart8" class="chart"></canvas>
											<br> 
											<center><button type="button" onclick="downloadPDF(7);">Export to PDF</button></center>
									</div>
								</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel4" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel4" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
					</div>
				</div>

				</div>
			</div>

		</div>

		

		<script>
			
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
			
			
			function logout()
			{
				if(confirm("Are you sure you want to logout?"))
				{
					window.location= "logout.php";
				}
		
			}
		
			//function that will generate all 12 charts for the department
			function generateChart()
			{
				var arr_id = [
									"myChart1", "myChart2", "myChart3", "myChart4",
									"myChart5", "myChart6", "myChart7", "myChart8"
							];

				var arr_data = <?php echo json_encode($arr_students); ?>;
				
				var ctr = 0;

				for(i=0;i<4;i++)
				{
					for(j=0;j<2;j++)
					{
							var ctx = document.getElementById(arr_id[ctr]);

							ctr++; 

							var myChart = new Chart(ctx, {
								type: 'bar',
								data: {
									labels: ["Information Resource Management","System Analysis and Design","Fourth Generation Languages"],
									datasets: [
									{
											label: '# of Passed',
											data: [ arr_data[i][j][0][0], arr_data[i][j][1][0], arr_data[i][j][2][0] ],
											backgroundColor: ['lightgreen','lightgreen','lightgreen'],
											borderColor: ['green','green','green'],
											borderWidth: 1
									},

									{
										label: '# of Failed',
										data: [arr_data[i][j][0][1], arr_data[i][j][1][1], arr_data[i][j][2][1] ],
										backgroundColor: ['pink','pink','pink'],
										borderColor: ['red','red','red'],
										borderWidth: 1
									}]
								},
								options: {
										scales: {
												yAxes: [{
														ticks: {
																beginAtZero:true
														 }
												 }]
											 }
										}
							});
						}
				}
			}
					
						 
			//donwload pdf from original canvas
			function downloadPDF(number) 
			{
				//alert(number);

				var arr_id = [
											"#myChart1", "#myChart2", "#myChart3", "#myChart4",
											"#myChart5", "#myChart6", "#myChart7", "#myChart8"
										 ];

				var tab = doc.autoTableHtmlToJson(document.getElementById(number));
										 
				doc.autoTable(tab.columns, tab.data);


				var canvas = document.querySelector(arr_id[number]);

				//creates canvas variable
				var canvasImg = canvas.toDataURL("image/png", 1.0);

				//creates logo variable
				var logo = new Image();

				//gets the source path of the plm logo
				logo.src = 'img/plmlogo.jpg';

				//creates PDF from img
				var doc = new jsPDF('portrait','p', 'pt');		

				doc.setFontSize(13);
				doc.setFont("helvetica","italic");
				doc.text(212, 59, "(University of the City of Manila)");

				doc.setFontSize(11);
				doc.setFont("helvetica", "italic");
				doc.text(255, 70, "Intramuros, Manila");


				doc.setFontSize(15);
				doc.setFont("Helvetica","Bold");
				doc.text(198, 42, "Pamantasan ng Lungsod ng Maynila");

				//adds the logo to the pdf
				doc.addImage(logo, 'PNG', 113, 22, 70, 70);

				//adds the canvas to the pdf
				doc.addImage(canvasImg, 'JPEG', 42, 425, 510, 283);

				//saves/downloads the generated pdf
				doc.save('canvas.pdf');
			}  

		</script>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-3.1.0.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
