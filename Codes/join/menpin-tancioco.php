<?php
$host ="localhost";
$user = "root";
$pword = null;
$con = mysql_connect($host,$user,$pword);
$db_select=mysql_select_db(student_database,$con);
?>
<html>
<body>
	<center><a href="egrade.php">Encoding of Grades</a>
	<a href="viewgrades.php" >Viewing of Grades<a>
	<a href="viewgwa.php" >Viewing of GWA</a>
	<a href="report.php" >Reports Viewing</a></center>
</body>
</html>	



