<?php

if(!session_id())
	session_start();
	
$host ="localhost";
$user = "root";
$pword = null;
$con = mysql_connect($host,$user,$pword);
$db_select=mysql_select_db("crs database",$con);

?>

<html>
	<head>
		<title>Encoding of Grades</title>
	</head>
	
	<body>
		<center>
		<form action="#" method="POST" >
			<br>Faculty ID:&nbsp; <input type="number" min="101010101" max="999999999" name="fac_id" required/>	<br>
			<br> <input type="submit" name="submit" value="Submit" />
		</form>
			
		<?php
			
				
			if(isset($_POST['submit']))
			{
				
				$fac_id = $_POST['fac_id'];
				
				$encode_query = mysql_query("SELECT studgrade.student_no, studentpersonal.fname, studentpersonal.lname, studentpersonal.mname, subject.subject_id,  subject.title, subject.units, studgrade.faculty_id
																	FROM studgrade
																	JOIN studentpersonal ON studgrade.student_no = studentpersonal.student_no
																	JOIN subject ON studgrade.subject_id = subject.subject_id
																	JOIN faculty ON  studgrade.faculty_id  =  faculty.faculty_id 
																	WHERE faculty.faculty_id = $fac_id
																;");
				
				$encode_num = mysql_num_rows($encode_query);
				
				if($encode_num != 0)
				{
					$valid = true;
					echo "<table border='2' >";
					echo "<tr>
							<th>Student Number</th>
							<th>Name</th>
							<th>Subject ID</th>
							<th>Title</th>
							<th>Units</th>
							<th>Faculty ID</th>
							<th>Grade</th>
						</tr>";
						
					$arr_grade = array();
					$arr_num = array();
					$arr_sub = array();
					$flag = 0;
					for($i=0;$i<$encode_num;$i++)
					{
						echo "<tr>";
						
						$encode_result = mysql_fetch_row($encode_query);
						
						$arr_num[$i] = $encode_result[0];
						$arr_sub[$i] = $encode_result[4];
						
						for($j=0;$j<9;$j++)
						{
							echo "<td>";
							if($j==1)
							{
								echo $encode_result[2].", ".$encode_result[1]." ".$encode_result[3];
								$j+=2;
							}
							else if($j==8)
							{
								echo "<form action='#' method='POST' >";							
								echo "<select name= 'arr_grade[$i]'>
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
										</select>";
								
								$flag++;
							}
							else
								echo $encode_result[$j];
							
								
							echo "</td>";
									
						}
						echo "</tr>";
					}
					
					echo "</table>";
					
					$_SESSION['num'] = $arr_num;
					$_SESSION['sub'] = $arr_sub;
					$_SESSION['ctr'] = $flag;
					
				}
				else
				{
					echo "<i>The faculty id was invalid!</i>";
					
					$valid = false;
				}
					
			}
		
			if(isset($_POST['submit']) && $valid!=false)
				echo "<br><br><input type='submit' name='egrade' value='Submit' required/>";
		
			if($_POST['egrade'])
			{
				
				for($i=0;$i<$_SESSION['ctr'];$i++)
				{	
					
					$numbers = $_SESSION['num'][$i];
					$subjects = $_SESSION['sub'][$i];
					
					$update = mysql_query("UPDATE studgrade SET grade= $arr_grade[$i]
															WHERE student_no = $numbers
															AND subject_id = '$subjects' ");
				}				
						
			unset($_POST['egrade']);
			
			$remarks_pass = mysql_query("UPDATE studgrade SET remarks = 'PASSED'
																WHERE grade <> 5.00");
																
			$remarks_fail = mysql_query("UPDATE studgrade SET remarks = 'FAILED'
																WHERE grade = 5.00");
			
		}
					
		echo "</form>";
		
		?>
		</center>
	</body>
	
</html>
