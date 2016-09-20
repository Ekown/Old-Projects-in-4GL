<?php
	if(!session_id())
	{
		session_start();
		
		if(!isset($_SESSION['first']))
			$_SESSION['first'] = true;
		
		if(!isset($_SESSION['audit']))
			$_SESSION['audit'] = false;
		
		if(!isset($_SESSION['finish']))
			$_SESSION['finish'] = false;
	}	
	
	$host = "localhost";
	$user = "root";
	$pword = NULL;
	
	$con = mysql_connect($host, $user, $pass);
	
	$db_select = mysql_select_db("changeofgrades",$con);
	
	if(!$db_select)
	{
		echo "Error: ".mysql_error();
		die();
	}
	
?>

<html>
<style>
h1 {
	font-family: "Berlin Sans FB", sans-serif;	
}
form {
	width: 98%;
    border: 3px solid Salmon;
	padding: 10px;
}
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid Brown;
    box-sizing: border-box;
	font-family: "Berlin Sans FB", sans-serif;
}
button {
    background-color: FireBrick;
    color: white;
    padding: 10px 10px;
    margin: 8px 0;
	border: 1px solid black;
    cursor: pointer;
    width: 30%;
	border-radius: 25px;
	font-family: "Berlin Sans FB", sans-serif;
	font-size: 15px;
}
.container {
	width: 60%;
    padding: 15px;
}
body {
	background-color: LightBlue;
	font-family: "Berlin Sans FB", sans-serif;
	font-size: 20px;
}
table {	
	border: 2px solid Black;
	padding: 10px;
	background-color: Maroon;
	width: 100%;
}
td {
	border: 7px solid Crimson;
	background-color: Silver;
	font-size: 20px;
}
script {
	font-family: "Berlin Sans FB", sans-serif;
}
select {
	font-family: "Berlin Sans FB", sans-serif;
	font-size: 20px;
}

</style>
	<script type="text/javascript" >
		
		function dispStatus()
		{
			var list = document.getElementById("grades");
			var list_value = list.options[list.selectedIndex].text;
			var text_value;
		
			switch(list_value)
			{
				case '5.00':
					text_value = "FAILED";
					break;
				case 'DO':
					text_value = "Dropped Officially";
					break;
				case 'DU':
					text_value = "Dropped Unofficially";
					break;
				case 'INC':
					text_value = "Incomplete";
					break;
			default:
				text_value = "PASSED";
			}		
			document.getElementById("status").value = text_value;
		}	
	</script>

	
	<head>
		<title>Change of Grades</title>
	</head>

	<body>
		
		<?php
			
			function dispLogin()
			{
				echo
					"<center><h1>Faculty Login</h1>
					<form action='cog.php' method='post'>
					<div class='container'>
					<label><b>Password</b></label>
					<input type='password' placeholder='Enter Password' name='password' required>        
					<button type='submit' name='pass_submit'>Login</button>
					</div>
					</form></center>"; 
						
				//first submit button
			}
			
			function backButton()
			{
				echo "<center><form method='POST'>
						<button type='submit' name='back' value='Logout'/>Logout</button>
						</form></center>";
								
				if(isset($_POST['back']))
				{
					$_POST['password'] = null;
					$_SESSION = array();
					
					session_destroy();
					
					header("Location: cog.php");
				}
					
			}
			
			if(!isset($_POST['password']) && $_SESSION['first'] == true)
				dispLogin(); 
			else if($_SESSION['finish'] == false)
			{
				if(isset($_POST['password']))
					$passcode  = $_POST['password'];		
				else
					$passcode  = $_SESSION['pass_val'];
				
				$login_query = mysql_query("SELECT p.facultyid
											FROM passcode AS p
											WHERE p.passcode = '$passcode'
											;");
				
				if(mysql_num_rows($login_query) == 0 && $_SESSION['first'] == true)
				{
					dispLogin();
					echo "Error: The entered passcode is invalid!";
					die();
				}	
				else
				{ 
				
					$_SESSION['first'] = false;
					
					$_SESSION['pass_val'] = $passcode;
					
					//if passcode is valid
					$login_result = mysql_fetch_row($login_query);
					
					$id = $login_result[0];
					
					//faculty id for the audit
					$_SESSION['id'] = $id;
					
					//get data from the database based on the faculty id 
					$fac_query = mysql_query("SELECT f.lastname, f.firstname, f.middlename, u.college
												FROM faculty as f
												JOIN unit as u ON f.unitid = u.unitid 
												WHERE f.facultyid = $id
											;");
	
					$fac_result = mysql_fetch_row($fac_query);
					
					echo "<table border='2'>
							<tr>
								<td>";
					echo "<b>Faculty Name:&nbsp;</b> ".$fac_result[1]." ".$fac_result[2]." ".$fac_result[0];
					echo "<b>&nbsp;&nbsp;College:&nbsp;</b> ".$fac_result[3];
					
					$_SESSION['facultyname'] = $fac_result[1]." ".$fac_result[0]." ".$fac_result[2];
					
					$_SESSION['college'] = $fac_result[3];
					
					$subject_query = mysql_query("SELECT subjecttitle FROM subject");
				
					echo "</td>
							</tr>
							<tr>
								<td><b>Subject:</b> &nbsp; 
									<form action = '#' method='POST'>
									<select name='sub_choice'>";
									
					if(!isset($sub_choice))
						$sub_choice = $_SESSION['sub_val'];
					
					//dropdown for subject title			
					for($i=0;$i<(mysql_num_rows($subject_query));$i++)
					{
						$subject_result = mysql_fetch_row($subject_query);
						
						if($subject_result[0]  == $sub_choice)
							echo "<option value='$subject_result[0]' selected>$subject_result[0]</option>";
						else
							echo "<option value='$subject_result[0]'>$subject_result[0]</option>";
					}
					
					//second submit button
					echo "</select>
						<button type='submit' value='Select' name='sub_submit'/>Select</button>";
						
					//second submit button onclick condition
					if(isset($_POST['sub_submit']) || isset($_SESSION['sub_val']))
					{
						if(isset($_POST['sub_choice']))
							$subject_id = $_POST['sub_choice'];
						else
							$subject_id = $_SESSION['sub_val'];
						
						$_SESSION['sub_val'] = $subject_id;
			
						$subj_query = mysql_query("SELECT s.subjectid, s.subjectname, s.subjecttitle, s.credits, s.type, c.schedule, c.classid
																		FROM classes AS c
																		JOIN subject AS s ON c.subjectid = s.subjectid
																		WHERE s.subjecttitle = '$subject_id'
																		;");
				
						
						$subj_result = mysql_fetch_row($subj_query);
							
						for($i=0;$i<7;$i++)
							$arr_sub[$i] = $subj_result[$i];
						
						//claas id for the audit
						$_SESSION['classid'] = $arr_sub[6];
						
						$_SESSION['subjectname'] = $arr_sub[1];
						
						echo "<br><br><b>Subject Code:</b> ".$arr_sub[0]." ";
						echo "&nbsp;&nbsp;&nbsp;<b>Title: </b>".$arr_sub[1]." ";
						echo "&nbsp;&nbsp;&nbsp;<b>Unit/s: </b>".$arr_sub[3];
						echo "<br><br><b>Schedule: </b>".$arr_sub[5]." ";
						echo "&nbsp;&nbsp;&nbsp;<b>Type: </b>".$arr_sub[4];
						
						$student_query = mysql_query("SELECT sb.subjecttitle, st.studentid, st.lastname, st.firstname, st.middlename, st.program, g.finalgrade
																				FROM grades as g
																				JOIN students as st ON g.studentid = st.studentid
																				JOIN classes as c ON g.classid = c.classid
																				JOIN subject as sb ON c.subjectid = sb.subjectid
																				WHERE sb.subjecttitle = '$sub_choice'
																			;");
						 
						echo"
						</form>
							</td> 
								</tr>
							<tr> 
								<td><b>Student No:</b> &nbsp; 
									<form action = '#' method='POST'>
									<select name='stud_choice'>";
							
						$_SESSION['count'] = mysql_num_rows($student_query);	
							
						//dropdown for student id
						for($i=0;$i<($_SESSION['count']);$i++)
						{
							$student_result = mysql_fetch_row($student_query);
							
							for($k=0, $j=1;$j<7;$j++, $k++)
							{
								$arr_stud[$i][$k] = $student_result[$j];
							}
							
							if($student_result[1]  == $stud_choice)
								echo "<option value='$student_result[1]' selected>$student_result[1]</option>";
							else
								echo "<option value='$student_result[1]'>$student_result[1]</option>";
						}
					
						//third submit button
						echo "</select>
							<button type='submit' value='Select' name='stud_submit' />Select</button>";
								
						//third submit button onclick condition		
						if(isset($_POST['stud_submit']) || isset($_SESSION['stud_val']))
						{			
							
							if(isset($_POST['stud_choice']))
							{
								$student_id= $_POST['stud_choice'];
								
								//student id for the audit
								$_SESSION['stud_val'] = $student_id;
							}
							else
								$student_id = $_SESSION['stud_val'];
							
							$i = 0;
							
							for($x=0;$x<($_SESSION['count']);$x++)
							{
								if($arr_stud[$x][0] == $student_id)
								{
									$i = $x;
									break;
								}
									
							}
							
							//old grade for the audit
							$_SESSION['oldgrade'] = $arr_stud[$i][5];
							
							$_SESSION['studentname'] = $arr_stud[$i][2]." ".$arr_stud[$i][3][0].". ".$arr_stud[$i][1];
							
							echo "<br><br><b>Last Name: </b>".$arr_stud[$i][1];
							echo "&nbsp;&nbsp;&nbsp;<b>First Name: </b>".$arr_stud[$i][2]." ";
							echo "&nbsp;&nbsp;&nbsp;<b>MI: </b>".$arr_stud[$i][3][0].". ";
							echo "&nbsp;&nbsp;&nbsp;<b>Course: </b>".$arr_stud[$i][4]." ";
							echo "<br><br><b>Current Grade: </b>".$arr_stud[$i][5];
							echo "&nbsp;&nbsp;&nbsp;<b>Change to: </b>";
							
							//dropdown for the grades
							echo "<form method='POST'>
										<select id='grades' name='grade' onchange='dispStatus()'>
											<option value='1.00'>1.00</option>
											<option value='1.25'>1.25</option>
											<option value='1.50'>1.50</option>
											<option value='1.75'>1.75</option>
											<option value='2.00'>2.00</option>
											<option value='2.25'>2.25</option>
											<option value='2.50'>2.50</option>
											<option value='2.75'>2.75</option>
											<option value='3.00'>3.00</option>
											<option value='5.00'>5.00</option>
											<option value='DO'>DO</option>
											<option value='DU'>DU</option>
											<option value='INC'>INC</option>
										</select>
											<input type='text' id='status' name='status' value=' ' readonly='readonly'  />
											<input type='submit' name='grade_submit' value='Change' /> 
										</form>";
								
								if(isset($_POST['grade_submit']) || isset($_SESSION['g_val']))	
								{
									//date for the audit
									
									$_SESSION['date'] = date("Y/m/d H:i:s");
									
									$grade_val = $_POST['grade'];
									
									//new grade for the audit
									$_SESSION['g_val'] = $grade_val;
																													
									$_SESSION['finish'] = true;
									
									header("Location: cog.php");
								}
							
							}
						}

					}
						
			}
			else
			{
				
				$grade_val = $_SESSION['g_val'];
				$student_id = $_SESSION['stud_val'];
			
				$grades_query = mysql_query("UPDATE grades
																SET finalgrade = '$grade_val'
																WHERE studentid = '$student_id'
																;");
			
				if($_SESSION['audit'] == false)
				{
					//values for the audit
					$var_faculty = $_SESSION['id'];
					$var_class = $_SESSION['classid'];
					$var_student = $_SESSION['stud_val'];
					$var_old = $_SESSION['oldgrade'];
					$var_new = $_SESSION['g_val'];
					$var_date = $_SESSION['date'];
					
					$audit_query = mysql_query("INSERT INTO cogaudit
												VALUES ('$var_faculty','$var_class', '$var_student', '$var_old', '$var_new', '$var_date');");
																	
					$_SESSION['audit'] = true;
				}			
											
				echo "<form method='POST'>
					<center><fieldset>
						<legend>CHANGE OF GRADE AUDIT</legend>
						<br>";
					echo "Student: <u>".$_SESSION['studentname']."</u><br><br>";
					echo "Faculty: <u>".$_SESSION['facultyname']."</u><br><br>";
					echo "Subject: <u>".$_SESSION['subjectname']."</u><br><br>";
					echo "College: <u>".$_SESSION['college']."</u>&nbsp&nbsp&nbsp&nbsp&nbsp"."Old Grade: <u>".$_SESSION['oldgrade']."</u>&nbsp&nbsp&nbsp&nbsp&nbsp"."New Grade: <u>".$_SESSION['g_val']."</u><br><br></fieldset></center></form>";	
				backButton();
			}
						
		?>
		
	</body>
	
</html>