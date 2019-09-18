<?php
	mysql_select_db('projectsalary',mysql_connect('localhost','root',''));
	$del_date = $_GET['Delete_holiday'];
	$exec = mysql_query("DELETE FROM holidays WHERE date='$del_date'");
	if($exec)
	{
		echo "
                <script>
                	alert(\"Holiday Deleted\");
                	window.open(\"view_holiday_list.php?Deleted=Recorded Deleted Successfully\",\"_self\");
                </script>
              ";
              //header("Location:view_holiday_list.php");
	}
?>