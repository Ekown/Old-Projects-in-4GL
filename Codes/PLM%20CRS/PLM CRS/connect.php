<?php
	
	$conn = mysqli_connect("localhost", "root", "", "crs2");

	if(mysqli_connect_errno())
	{
		die("Connection Failed".mysqli_connect_error());
	}

	
?>