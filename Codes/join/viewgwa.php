<?php
$host ="localhost";
$user = "root";
$pword = null;
$con = mysql_connect($host,$user,$pword);
$db_select=mysql_select_db("crs database",$con);
?>


<html>

	<style>
		form.insert, div.person,table
		{
			text-align: center;
		}
		
		span
		
		{
			font-weight: bold;
			
		}
		
		table
		{
			position: relative;
			top: -20px;
			left: 450px;
		}
		
		table,tr,td,th
		{
			border: 2px solid black;
		}
		
	</style>

	<head>
		<title> View Grades </title>
	</head>
	
		<body>
			<br><br>
			
				<?php
				
					if(!isset($_POST['submit']))
						echo "<form class='insert' action='#' method='POST'>
										Student Number:&nbsp;<input type='number' name='num' min='200000000' max='201699999' required/><br><br>				
										Academic Year: &nbsp; <input type='number' min='2014' max='2016' step='1' name='acad' required/><br><br>
										Semester:&nbsp;<select name='sem' >
											<option value='First Semester' >First</option>
											<option value='Second Semester' >Second</option>
											<option value='Summer' >Summer</option>
										</select><br><br>
										<input type='submit' name='submit' value='Submit' />
								</form>";
				?>
				
			<br><br>
			
			<div class="person"  > 
					
						<?php
				
							$stud_num = $_POST['num'];
							$a_year = $_POST['acad'];
							$semester = $_POST['sem'];
							
							$personal = mysql_query("SELECT studentpersonal.student_no, studentpersonal.fname, studentpersonal.lname,
																	studentpersonal.mname, studacad.course, studacad.yr_level, college.code
																	FROM studentpersonal
																	JOIN studacad ON studentpersonal.student_no = studacad.student_no
																	JOIN college ON studacad.college_id = college.college_id
																	WHERE studentpersonal.student_no = '$stud_num'
																;");
																
							
							if($_POST['submit'])
							{
								$personal_num = mysql_num_rows($personal);
								
								for($i=0;$i<$personal_num;$i++)
								{
									
									$personal_result = mysql_fetch_row($personal);
									
									for($j=0;$j<7;$j++)
									{	
										switch($j)
										{
											case 0:
												echo "<span>Student Number:</span> ";
												echo $personal_result[$j];
												break;
											case 1:
												echo "<span>Name:</span> ";
												echo $personal_result[2].", ".$personal_result[1]." ".$personal_result[3];
												$j+=2;
												break;
											case 4:
												echo "<span>Course:</span> ";
												echo $personal_result[$j];
												break;
											case 5:
												echo "<span>Year:</span> ";
												echo $personal_result[$j];
												break;
											case 6:
												echo "<span>College:</span> ";
												echo $personal_result[$j];
												break;
										}		
										echo "<br><br>";
									
									}
									
								
								}								
															
								$academic = mysql_query("SELECT studgrade.subject_id, subject.title, faculty.name, subject.units, studgrade.grade
																			FROM studgrade
																			JOIN subject ON studgrade.subject_id = subject.subject_id
																			JOIN faculty ON studgrade.faculty_id = faculty.faculty_id
																			WHERE studgrade.student_no = '$stud_num' 
																			AND a_year = '$a_year'
																			AND semester = '$semester'
																		;");
																			
								$academic_num = mysql_num_rows($academic);
													
								echo "<br><br>";
								
								$units = 0;
								$gwa = 0;
								
								if($academic_num !=0)
								{
									echo "<table>
												<tr>
													<th>Subject Code</th>
													<th>Subject Name</th>
													<th>Faculty</th>
													<th>Units</th>
													<th>Grade</th>
												<tr>";
											
									for($i=0;$i<$academic_num;$i++)
									{
										echo "<tr>";
										
										$academic_result = mysql_fetch_row($academic);
											
										$units += $academic_result[3];
										$gwa += ($academic_result[3] * $academic_result[4]);
										
										for($j=0;$j<5;$j++)
										{
											echo "<td>";
													
												echo $academic_result[$j];				
													
											echo "</td>";
										}							
										
										echo "</tr>";									
										}
									
										echo "</table>";
										echo "<br><br>";	
										
										echo "Computed GWA: ".number_format(($gwa/$units),2);
									}
									else
										echo "NO RECORDS FOUND!";
									
								
								unset($_POST['submit']);
								
							}
						
						
					?>
				
			</div>
			
		</body>
		
</html>
