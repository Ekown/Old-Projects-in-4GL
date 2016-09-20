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
				<center><b><font color="white">List of Subjects:</font></b>
				<select name="subject">
					<option value="ALL">ALL</option>
					<option value="SAD">System Analysis and Design</option>
					<option value="QSM">Quality Standards Management</option>
				</select>
				<input type="submit" value="ENTER">
				</center>
			
			
		<br><br><br>
					<table border="5" align="center">
					    <tr>
						<font color="white"><center><b>List of Handled Faculty</font></center></b></td>
						</tr>
						<tr> 
								<td align="center"><h4>Faculty Name</td></h4>
								<td align="center"><h4>Faculty Number</td></h4>
								<td align="center"><h4>Faculty Type</td></h4>
								<td align="center"><h4>Number of Subjects Handled</td></h4>
								<td align="center"><h4>Number of Passed Students</td></h4>
								<td align="center"><h4>Number of Failed Students</td></h4>
						</tr>
						<tr>
								<td align="center">2014-12345</td>
								<td>Dela Cruz, Juan P.</td>
								<td align="center">Instructor I</td>
								<td align="center">1</td>
								<td align="center">32</td>
								<td align="center">0</td>
						</tr>
						<tr>
								<td align="center">2012-41212</td>
								<td>Sherman, Mang P.</td>
								<td align="center">Instructor III</td>
								<td align="center">3</td>
								<td align="center">93</td>
								<td align="center">8</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Marcelo, Erwin </td>
								<td align="center">Instructor IV</td>
								<td align="center">2</td>
								<td align="center">66</td>
								<td align="center">0</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Dela Merced, Shirley</td>
								<td align="center">Instructor I</td>
								<td align="center">2</td>
								<td align="center">55</td>
								<td align="center">5</td>
						</tr>
						<tr>
								<td align="center">2014-20904</td>
								<td>Centeno, Cassiely</td>
								<td align="center">Instructor II</td>
								<td align="center">2</td>
								<td align="center">49</td>
								<td align="center">0</td>
						</tr>
					</table>
					<br>
					<center><input type="submit" value="Export to PDF"></center>
					
<br><br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>		
</body>
</html>