<?php
	mysql_select_db('sql12385657',mysql_connect('sql12.freemysqlhosting.net:3306','sql12385657','d8tvtgY9U9'));
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