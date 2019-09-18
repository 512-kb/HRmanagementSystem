
<?php
	
	mysql_select_db('projectsalary',mysql_connect('localhost','root',''));
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