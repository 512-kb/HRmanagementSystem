
<?php
	
	mysql_select_db('sql12385657',mysql_connect('sql12.freemysqlhosting.net:3306','sql12385657','d8tvtgY9U9'));
	$del_id = $_GET['Delete'];
	$exec = mysql_query("DELETE FROM emp_list WHERE id='$del_id'");
	if($exec)
	{
		echo "
                <script>
                	alert(\"Employee Deleted\");
                	window.open(\"list_of_employees.php\",\"_self\");
                </script>
              ";            
	}

?>