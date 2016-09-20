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
	font-size: 13;
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
				<li><a href="faculty1.php">Change of Grade</a></li>
				<li><a href="viewfaculty1.php">Viewing of Grades</a></li>
				<li><a href="chair1.php">Viewing of Top 10 Students</a></li>
				<li><a href="viewchair1.php">Viewing of Handled Faculty</a></li>
				<li><a href="dean1.php">Viewing of Top 15 Students</a></li>
				<li><a href="viewdean1.php">Viewing of Handled Chairperson</a></li>
				<li><a href="graph1.php">Graph of Passed and Failed Students</a></li>
				<li><a href="audit.php">Audit</a></li>
				<li><a href="changepassdean1.php">Change Password</a></li>
				<li><a href="sample.php">Log-Out</a></li>
			</div>
		</ul>
				

					<br><br><br><br>
					<table border="5" align="center">
					<tr>
					<td><center><b><font color="white">College:</font></b></td>
							<td align="center"><select name="subject">
								<option value="SAD">College of Engineering and Technology</option>
								<option value="QSM">College of Education</option>
								<option value="QSM">College of Science</option>
								<option value="QSM">College of Medicine </option>
								<option value="QSM">College of Physical Theraphy</option>
							</td></select>
							<td><input type="submit" value="ENTER"></td>
					</tr>
					</center>
					
					<tr>
					<br>
					<td><center><b><font color="white">Department:</font></b></td>.
							<td><select name="subject">
								<option value="SAD">Information Technology Department</option>
								<option value="QSM">Computer Science Department</option>
								<option value="QSM">Civil Engr. Department</option>
								<option value="QSM">CompEng Department </option>
								<option value="QSM">Electronics and Comm. Engr. Department</option>
							</td></select>
							<td><input type="submit" value="ENTER"></td>
					</tr>
					</center>
					
					<tr>
					<br>
					<td><center><b><font color="white">Faculty Name:</font></b></td>
							<td align="center"><select name="subject">
								<option value="SAD">Dela Cruz, Juan P.</option>
								<option value="QSM">Sherman, Mang P.</option>
								<option value="QSM">Marcelo, Erwin </option>
								<option value="QSM">Dela Merced, Shirley </option>
								<option value="QSM">Centeno, Cassiely</option>
							</td></select>
							<td><input type="submit" value="ENTER"></td>
					</tr>
					</center>
					</table>
					<br><br>
		
					<table border="5" align="center" width="460">
					<tr>
							<td><center><b><font color="white">List of Subjects:</font></b></td>
							<td align="center"><select name="subject">
								<option value="SAD">System Analysis and Design</option>
								<option value="QSM">Quality Standards Management</option>
							</td></select>
							<td><input type="submit" value="ENTER"></td>
					</tr>
					</center>
					</table>
					
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
					
<br><br><br><br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>
</body>
</html>