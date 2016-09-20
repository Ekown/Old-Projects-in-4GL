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
			</table>
			
				<br><br>
				<center><b><font color="white">Chairperson: </font></b>
				<select name="subject">
					<option value="SAD">Dela Cruz, Juan A.</option>
					<option value="SAD">Santiago, Aerron O.</option>
					<option value="SAD">Saldana, Roldan P.</option>
					<option value="SAD">Tancioco, Eron A.</option>
				</select>
				<input type="submit" value="ENTER">
		</center>		
		
		<br><br>
					<table border="5" align="center">
					    <tr> 
								<td  align="center" width="245" ><b>List of Handled Faculty</td></b>
						</tr>
					</table>
					<table border="5" align="center">
						<tr> 
								<td align="center"><h4>Faculty ID</td></h4>
								<td align="center"><h4>Faculty Name</td></h4>

						</tr>
						
						<tr>
								<td align="center">2014-20424</td>
								<td>Saldana, Roldan P.</td>
								
						</tr>
						<tr>
								<td align="center">2014-14323</td>
								<td>Calanza, Cyzril Brian C.</td>
								
						</tr>
						<tr>
								<td align="center">2014-11224</td>
								<td>Tancioco, Eron A.</td>
								
						</tr>
						<tr>
								<td align="center">2014-13311</td>
								<td>Uri, Patrick V.</td>
								
						</tr>
						<tr>
								<td align="center">2014-12313</td>
								<td>Sarangani, Zainnoden</td>
								
						</tr>
						<tr>
								<td align="center">2014-12412</td>
								<td>Pineda, Zeke</td>
								
						</tr>
						<tr>
								<td align="center">2014-15123</td>
								<td>Banche, Eilon Geos F.</td>
								
						</tr>
					</table>
					
<br><br><br><br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>
			
</body>
</html>