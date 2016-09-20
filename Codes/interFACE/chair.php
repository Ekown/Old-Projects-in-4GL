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
				<li><a href="chair.php">Viewing of Top 10 Students</a></li>
				<li><a href="viewchair.php">Viewing of Handled Faculty</a></li>
				<li><a href="changepasschair.php">Change Password</a></li>
				<li><a href="sample.php">Log-Out</a></li>
			</div>
		</ul>
<br><br>				<table border="5" align="center">
						<tr> 
								<td align="center"><h4>CHAIRPERSON INFORMATION</td></h4>
						</tr>
							<tr>
								<td>Chairperson Name: Dela Cruz, Juan A. </td>
							</tr>
							<tr>
								<td>Chairperson Number: 2005-12345</td>
							</tr>
							<tr>
								<td>Gender: Male</td>
							</tr>
							<tr>
								<td>Faculty Type: Instructor IV</td>
							</tr>	
							<tr>
								<td>Department: Information Technology Department</td>
							</tr>			
						</table>
		<br>
		<center><b><font color="white">Year Level:</font></b>
				<select name="subject">
					<option value="SAD">First Year</option>
						<option value="SAD">Second Year</option>
						<option value="SAD">Third Year</option>
						<option value="SAD">Fourth Year</option>
						<option value="SAD">Fifth Year</option>
				</select>
				<input type="submit" value="ENTER">
		</center>		
		
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
<br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>		
</body>
</html>