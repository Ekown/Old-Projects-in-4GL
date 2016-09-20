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
		
		<br><br>
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
					
						
					<td><center><b><font color="white">Year Level:</font></b></td>
					<td align="center"><select name="subject">
						<option value="SAD">First Year</option>
						<option value="SAD">Second Year</option>
						<option value="SAD">Third Year</option>
						<option value="SAD">Fourth Year</option>
						<option value="SAD">Fifth Year</option>
					</td></select>
					<td><input type="submit" value="ENTER"></td>
					</center>		
					</table>
					
					<br>
					
					<table border="5" align="center" width="320">
					    <tr>
						<td align="center" colspan="0"><b>3rd Year</b></td>
						</tr>
					</table>
					<table border="5" align="center">
						<tr> 
								<td align="center"><h4>Student ID</td></h4>
								<td align="center"><h4>Student Name</td></h4>
								<td align="center"><h4>GWA</td></h4>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Velasco, Rob Russell A.</td>
								<td align="center">1.25</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Menpin, Renzo D.</td>
								<td align="center">1.27</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Saldana, Roldan P.</td>
								<td align="center">1.30</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Calanza, Cyzril Brian C.</td>
								<td align="center">1.33</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Santiago, Aerron James O.</td>
								<td align="center">1.37</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Tancioco, Eron A.</td>
								<td align="center">1.51</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Uri, Patrick V.</td>
								<td align="center">1.55</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Sarangani, Zainnoden</td>
								<td align="center">1.60</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Pineda, Zeke</td>
								<td align="center">1.69</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Blanche, Eilon Geos F.</td>
								<td align="center">1.74</td>
						</tr>
					</table>
					<br>
					<center><input type="submit" value="Export to PDF"></center>
					
					
					
					
					
<br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>		
</body>
</html>