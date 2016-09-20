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
										Student Number:&nbsp;<input type='number' name='num' min='200000000' max='201699999' required/>				
												By:<select name='sort_by' >
													<option value='a_year'>A-year</option>
													<option value='semester' >Semester</option>
												</select>		
											<input type='submit' name='submit' value='Submit' />
								</form>";
				?>
				
			<br><br>
			
			<div class="person"  > 
					
						<?php
				
							$stud_num = $_POST['num'];
							
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
								
								$order = $_POST['sort_by'];
															
								$academic = mysql_query("SELECT studgrade.subject_id, subject.title, faculty.name, subject.units, studgrade.grade
																			FROM studgrade
																			JOIN subject ON studgrade.subject_id = subject.subject_id
																			JOIN faculty ON studgrade.faculty_id = faculty.faculty_id
																			WHERE studgrade.student_no = '$stud_num' 
																			ORDER BY $order	
																		;");
																			
								$academic_num = mysql_num_rows($academic);
													
								echo "<br><br>";
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
								unset($_POST['submit']);
							}
						
						
					?>
				
			</div>
			
		</body>
		
</html>







