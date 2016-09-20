<?php
	//defining the host,user, and root values
	$host = "localhost";
	$user = "root";
	$pword = null;
	
	//connecting to the sql server with the user values
	$con = mysql_connect($host,$user,$pword);
	
	//checks if the connection is successful
	if($con)
		echo "<br>Succesfully Connected to the SQL Server!";
	else
		echo "<br>There was a problem connecting to the SQL Server";
	
	//connects to the database in the selected server
	$db_select = mysql_select_db("Student Information", $con);
	
	//checks if the connection was successful
	if($db_select)
		echo "<br><br>Succesfully connected to the Database!";
	else
		echo "<br><br>There was a problem connecting to the Database";
	
	//selects the table from the database
	$student_query = mysql_query("Select * FROM `Student Info` ");
	
	$num_stud = mysql_num_rows($student_query);
	
?>


<html>
	<head>
		<title> Database Manipulation Practice </title>
	</head>
	
	<body>
	
		<br><br>
		<hr>
		<br><br>
		
		<fieldset>
			<legend>Student Information </legend>
			<form action="#" method="POST" align="center" >
				Student ID: &nbsp; <input type="number" min="200000000" step="1" name="stud_id" required > <br><br>
				Student Name: &nbsp; <input type="text" name="stud_name" required > <br><br>
				Student Course: &nbsp; <input type="text" name="stud_course" required > <br><br>
				Student College: &nbsp; <input type="text" name="stud_college" required > <br><br>
				Student Dept: &nbsp; <input type="text" name="stud_dept" required >
				
		<form action="#" method="POST" align="center" >
			<br><br><input type="submit" name="add" value="Add" />&nbsp;
			<input type="submit" name="edit" value="Edit" />&nbsp;
			<input type="submit" name="delete" value="Delete" />
		</form>
	</fieldset>		
		<?php
			echo "<div align='center'>";
			
			echo "<br>Record/s: ".$num_stud."<br><br>";
			
			echo "<div>";
			
			echo "<table border='2' bgcolor='cyan' >";
			echo "<tr>
						<th>Student Number</th>
						<th>Student Name</th>
						<th>College</th>
						<th>Department</th>
						<th>Program</th>
					</tr>";
			for($i=0;$i<$num_stud;$i++)
			{
				if($i%2==0)
					echo "<tr bgcolor='gray' >";
				else
					echo "<tr bgcolor='lightblue' >";
				
				//gets the row from the table in the database (needs looping to traverse rows)
				$student_result = mysql_fetch_row($student_query);	
				
				for($j=0;$j<5;$j++)
				{
					echo "<td>";
					echo $student_result[$j];
					echo "</td>";		
				}	
				echo "</tr>";
			}
			echo "</table>";
			
			$arr = array($_POST['stud_id'],$_POST['stud_name'],$_POST['stud_college'],$_POST['stud_dept'],$_POST['stud_course']);
				
			if($_POST['add'])
			{
				$intval = mysql_query("INSERT INTO `student info` (`Student Number`, `Student Name`, `College`, `Department`, `Program` ) 
									VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]'); ");
									
				if(!$intval )
					die('Could not enter data: ' . mysql_error());
				
				unset($_POST['add']);	
				
				header("Location: http://localhost/mySQL/tancioco.php");	
				
			}	
			else if($_POST['edit'])
			{
				$upval = mysql_query("UPDATE `student info` SET `Student Number` = '$arr[0]', `Student Name` = '$arr[1]', `College` = '$arr[2]', 
														`Department` = '$arr[3]', `Program` = '$arr[4]' WHERE `Student Number` = $arr[0] ;");
														
				if(!$upval)
					die('Could not edit record:'.mysql_error());
				
				unset($_POST['edit']);
				
				header("Location: http://localhost/mySQL/tancioco.php");
			}
			else if($_POST['delete'])
			{
				
				$delval = mysql_query("DELETE FROM `student info` WHERE `Student Number` = '$arr[0]' ;");
					
				if(!$delval )
					die('Could not delete data: ' . mysql_error());
				
				unset($_POST['delete']);
					
				header("Location: http://localhost/mySQL/tancioco.php");
			}

			echo "</div>";
		?>
		</form>
	</body>
</html>
	
	