<html>
<body>
<style>
ul {

    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #989590;
}

li {
    float: left;
}

li a {
	font-size: 18;
    display: block;
    color: white;
    text-align: center;
    padding: 5px 5px;
    text-decoration: none;
}


a:hover
{
	background-color: black;
	color:white;
}

table {
	color:white;
}
td {
	color:white;
}
</style>
<body background="gitna.jpg">
		<ul>
			<div id="menu" align="center">
				<li><a href="faculty.php">Change of Grade</a></li>
				<li><a href="viewfaculty.php">Viewing of Grades</a></li>
				<li><a href="changepassfac.php">Change Password</a></li>
				<li><a href="sample.php">Log-Out</a></li>
			</div>
		</ul>
		<br><br>		<table border="5" align="center">
						<tr> 
								<td align="center"><h4>FACULTY INFORMATION</td></h4>
						</tr>
							<tr>
								<td>Faculty Name: Dela Cruz, Juan A. </td>
							</tr>
							<tr>
								<td>Faculty Number: 2005-12345</td>
							</tr>
							<tr>
								<td>Gender: Male</td>
							</tr>
							<tr>
								<td>Faculty Type: Instructor I</td>
							</tr>	
							<tr>
								<td>Department: Information Technology Department</td>
							</tr>
							<tr>
								<td>College: College of Engineering and Technology</td>
							</tr>			
						</table>

		<br><br><br>
		<center><b><font color="white">List of Subjects:</font></b>
				<select name="subject">
					<option value="SAD">System Analysis and Design</option>
					<option value="QSM">Quality Standards Management</option>
				</select>
				<input type="submit" value="ENTER">
		</center>
		
					<br>
					<table border="5" align="center">
						<tr>
							<td align="center"><h4>System Analysis and Design</td></h4>
							<td align="center"><h4>A.Y. 2016-2017</td></h4>
							<td align="center"><h4>1st Semester</td></h4>
							<td align="center"><h4>Schedule: MTH 1:00pm-2:30pm</td></h4>
						</tr>
						
						<tr> 
								
								<td align="center"><h4>Student ID</td></h4>
								<td align="center"><h4>Student Name</td></h4>
								<td align="center"><h4>GWA</td></h4>
								<td align="center"><h4>Remarks</td></h4>
						</tr>
							<tr>
								<td align="center">2014-20904</td>
								<td align="center">Abueva, Calvin</td>
								<td align="center">1.00</td>
								<td align="center">PASSED</td>
							</tr>
							<tr>
								<td align="center">2014-12345</td>
								<td align="center">Bayola, Wally</td>
								<td align="center">2.50</td>
								<td align="center">PASSED</td>
							</tr>
							<tr>
								<td align="center">2014-10413</td>
								<td align="center">Caguioa, Mark</td>
								<td align="center">5.00</td>
								<td align="center">FAILED</td>
							</tr>
							<tr>
								<td align="center">2014-21331</td>
								<td align="center">Pingris, Jean Marc</td>
								<td align="center">2.00</td>
								<td align="center">PASSED</td>
							</tr>	
							<tr>
								<td align="center">2014-10965</td>
								<td align="center">Yap, James Carlos</td>
								<td align="center">2.25</td>
								<td align="center">PASSED</td>
							</tr>								
						</table>
						
						<br>
						<center><input type="submit" value="Export to PDF"></center>	
<br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>
</body>
</html>