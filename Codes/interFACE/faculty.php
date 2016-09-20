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
<br><br>				<table border="5" align="center">
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
		
		<center><b><font color="white">Student Name:&nbsp;&nbsp;</font></b>
				<select name="student">
					<option value="stud1">Velasco, Rob Russell A.</option>
					<option value="stud2">Menpin, Renzo D.</option>
				<input type="submit" value="ENTER">
				</select>
		</center>
		<br>
					<table border="5" align="center">
						<tr> 
								<td align="center"><h4>Current Grade</td></h4>
								<td align="center"><h4>Change Grade To</td></h4>
								<td align="center"><h4>Remark</td></h4>
						</tr>
						<tr>
								<td align="center">3.00 </td>
								<td><select name="qsm">
									<option value="1.00">1.00</option>
									<option value="1.25">1.25</option>
									<option value="1.50">1.50</option>
									<option value="1.75">1.75</option>
									<option value="2.00">2.00</option>
									<option value="2.25">2.25</option>
									<option value="2.50">2.50</option>
									<option value="2.75">2.75</option>
									<option value="3.00">3.00</option>
									<option value="5.00">5.00</option>
									<option value="DU">DU</option>
									<option value="DO">DO</option>
									<option value="INC">INC</option>
								<input type="submit" value="CHANGE">
								</select></td>
								<td align="center">PASSED</td>
						</tr>
											
					</table>
					
<br><br><br><br><br><br><br><br><br><br>
<center><font color="white">The premier scholars' university of the capital city of the Philippines.<br>
Copyright since 2009, Pamantasan ng Lungsod ng Maynila. All Rights Reserved.</font></center>		
</body>
</html>