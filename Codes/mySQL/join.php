<?php
	$host = "localhost";
	$user = "root";
	$pass = null;
	
	$con = mysql_connect($host,$user,$pass);
	
	if($con)
		echo "Connection successfull!";
	else
		echo "Connection was unsuccessfull: ".mysql_error();
	
	echo "<br>";
	
	$db_select = mysql_select_db("Student Information",$con);
	
	if($db_select)
		echo "Database connection secured!";
	else	
		echo "Database connection encountered a fatal error: ".mysql_error();
	
	$pokemon_query = mysql_query("Select `Pokemon ID`.`ID`,`Pokemon Stats`.`Attack`, `Pokemon Stats`.`Defense`, `Pokemon Stats`.`Speed`
															FROM `Pokemon ID` JOIN`Pokemon Stats` ON `Pokemon ID`.`Name` = `Pokemon Stats`.`Name`");
	
	$num_poke = mysql_num_rows($pokemon_query);
	
	echo "<br>";
	echo "<br>";
	echo "<hr>";
	
?>

<html>
	<head>
		<title>SAMPLE JOIN COMMAND</title>
	</head>
	
	<body>
		<?php
			echo "<table border='2' bgcolor='cyan' align='center' >";
				echo "<tr>
							<th>ID</th>
							<th>Attack</th>
							<th>Defense</th>
							<th>Speed</th>
						</tr>";
				for($i=0;$i<$num_poke;$i++)
				{
					if($i%2==0)
						echo "<tr bgcolor='gray' >";
					else
						echo "<tr bgcolor='lightblue' >";
					
					$pokemon_result = mysql_fetch_row($pokemon_query);	
					
					for($j=0;$j<4;$j++)
					{
						echo "<td>";
						echo $pokemon_result[$j];
						echo "</td>";		
					}	
					echo "</tr>";
				}
				echo "</table>";
			?>
	</body>
	
</html>