<?php
	$con = mysqli_connect('localhost', 'root', '', 'plm_crs');

	if($con->connect_errno)
	{
		die("$con->connect_error");
	}

	$arr_sub_year = array ( 2013, 2014, 2015, 2016 );

	//query for getting all the subjects per semester per year
	for($x=0;$x<4;$x++)
	{
		if($subjects_query = mysqli_query($con, 
			"SELECT `subject_title`, `acad_year`, `sem` FROM `tbl_syllabus` WHERE acad_year = $arr_sub_year[$x] ORDER BY sem ASC"))
		{
			for ($i=0; $i < mysqli_num_rows($subjects_query); $i++) 
			{ 
				$subjects_result = mysqli_fetch_row($subjects_query);	
				$arr_subjects[$x][$i][0] = $subjects_result[0];
			}
		}
	}
		


?>