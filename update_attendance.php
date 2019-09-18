<!DOCTYPE html>
<html>

<?php 
session_start();
function Login()
{
    if(($_SESSION['UserId'])!="")
        return true;
}
if(!Login())
{
    header("Location: Log_in.php");
}

?>

    <?php 

    $FLAG=0;
    mysql_select_db('projectsalary',mysql_connect('localhost','root',''));
    $daterror = ""; $IDerror=""; $noError = 1; $dept=""; $date=""; $id="";
    if(isset($_POST['present_button']))
    {        
        $dept=$_POST['department'];
        if(empty($_POST['date']))
        {
            $daterror = "Date Required"; $noError = 0; $FLAG = 0;
        }   
        else
        {
            $exists = 0;
            $q = mysql_query("SELECT * FROM holidays");
            while ($data  = mysql_fetch_array($q)) 
            {
                if($_POST['date']==$data['date'])
                {
                    $exists = 1;
                    $daterror = "It's a HOLIDAY";
                    $noError = 0;
                }
            }
            if($exists==0) $date=$_POST['date'];     
        } 
        if(empty($_POST['ID']))
        {
            $IDerror = "ID Required"; $noError = 0; $FLAG = 0;
        }
        else
        {
            $f=0;
            $fetch = mysql_query("SELECT * FROM emp_list WHERE department='$dept'");
            while ($data = mysql_fetch_array($fetch)) 
            {
                if($data['id']==$_POST['ID'])
                {
                    $id=$_POST['ID']; $f=1; 
                    break;
                }
            }
            if($f==0) { $IDerror = "Invalid ID"; $noError=0; $FLAG=0;  }
        }

        if($noError==1)
        {
            $exists=0;
            $fetch = mysql_query("SELECT * FROM attendance");
            while ($data = mysql_fetch_array($fetch)) 
            {
                if($data['id']==$id && $data['date']==$date)
                {
                    $exists=1; 
                    break;
                }
            }
            if($exists==0) 
            {
                $exec = mysql_query("INSERT INTO attendance VALUES('$id','$dept','$date','Present')");            
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Attendance Recorded\");
                            </script>
                        ";  
                }    
            }
            else
            {
                $exec = mysql_query("UPDATE attendance SET status='Present' WHERE id='$id' AND date='$date'");
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Attendance Recorded\");
                            </script>
                        ";  
                }
            }
        }

    }
    if(isset($_POST['absent_button']))
    {        
        $dept=$_POST['department'];
        if(empty($_POST['date']))
        {
            $daterror = "Date Required"; $noError = 0; $FLAG = 0;
        }   
        else
        {
            $exists = 0;
            $q = mysql_query("SELECT * FROM holidays");
            while ($data  = mysql_fetch_array($q)) 
            {
                if($_POST['date']==$data['date'])
                {
                    $exists = 1;
                    $daterror = "It's a HOLIDAY";
                    $noError = 0;
                }
            }
            if($exists==0) $date=$_POST['date'];    
        }
        if(empty($_POST['ID']))
        {
            $IDerror = "ID Required"; $noError = 0; $FLAG = 0;
        }
        else
        {
            $f=0;
            $fetch = mysql_query("SELECT * FROM emp_list WHERE department='$dept'");
            while ($data = mysql_fetch_array($fetch)) 
            {
                if($data['id']==$_POST['ID'])
                {
                    $id=$_POST['ID']; $f=1; 
                    break;
                }
            }
            if($f==0) { $IDerror = "Invalid ID"; $noError=0; $FLAG=0;  }
        }

        if($noError==1)
        {
            $exists=0;
            $fetch = mysql_query("SELECT * FROM attendance");
            while ($data = mysql_fetch_array($fetch)) 
            {
                if($data['id']==$id && $data['date']==$date)
                {
                    $exists=1; 
                    break;
                }
            }
            if($exists==0) 
            {
                $exec = mysql_query("INSERT INTO attendance VALUES('$id','$dept','$date','Absent')");            
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Attendance Recorded\");
                            </script>
                        ";  
                }    
            }
            else
            {
                $exec = mysql_query("UPDATE attendance SET status='Absent' WHERE id='$id' AND date='$date'");
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Attendance Recorded\");
                            </script>
                        ";  
                }
            }
        }

    }  

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Large-Dropdown-Menu-BS3.css">
    <link rel="stylesheet" href="assets/css/Large-Dropdown-Menu-BS3.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/sticky-dark-top-nav-with-dropdown.css">
    <link rel="stylesheet" href="assets/css/styles.css"></head>

<body style="background-image:url(&quot;assets/img/art-artist-background-316466.jpg&quot;); background-repeat: no-repeat;">
   <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:#ffb800;height:79px;position:fixed;width: 100%;">
        <div class="container" >
            <a class="navbar-brand" href="#" style="color:#262228;margin-right:50px;"><strong>ADMIN PANEL</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown" data-bs-hover-animate="pulse"><a class="dropdown-toggle nav-link dropdown-toggle flex-grow-1" data-toggle="dropdown" aria-expanded="false" href="#" data-bs-hover-animate="pulse" style="color:#262228;">EMPLOYEES</a>
                        <div class="dropdown-menu" role="menu" style="background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="add_new_employee.php" style="background-color:#1a0448;color:#ffb800;">ADD NEW EMPLOYEE</a><a class="dropdown-item" role="presentation" href="list_of_employees.php" style="color:#ffb800;background-color:#1a0448;">LIST OF EMPLOYEES</a></div>
                    </li>
                    <li class="dropdown d-inline-flex float-none flex-grow-1 align-self-center" data-bs-hover-animate="pulse"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" data-bs-hover-animate="pulse" style="color:#262228;">ATTENDANCE</a>
                        <div class="dropdown-menu dropdown-menu-left" role="menu"
                            style="background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="update_attendance.php" style="background-color:#1a0448;color:#ffb800;">UPDATE</a><a class="dropdown-item" role="presentation" href="view_attendance.php" style="background-color:#1a0448;color:#ffb800;">VIEW</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" data-bs-hover-animate="pulse" style="color:#262228;">HOLIDAYS</a>
                        <div class="dropdown-menu" role="menu" style="color:#ffb800;background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="add_new_holiday.php" style="color:#ffb800;">ADD NEW HOLIDAY</a><a class="dropdown-item" role="presentation" href="view_holiday_list.php" style="color:#ffb800;">VIEW HOLIDAY LIST</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" data-bs-hover-animate="pulse" style="color:#262228;">PAYROLL MANAGEMENT</a>
                        <div class="dropdown-menu" role="menu" style="background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="create_payslip.php" style="color:#ffb800;">CREATE PAY SLIP</a><a class="dropdown-item" role="presentation" href="manage_salaries.php" style="color:#ffb800;">MANAGE SALARIES</a></div>
                    </li>
                </ul><span style="margin-left: 80px; margin-right:20px; color: black"><?php echo $_SESSION['UserId']; ?></span><a class="btn btn-primary" role="button" href="Log_In.php" style="background-color:#1a0448;margin-left:10px;height:40px;width:105px;">SIGN OUT</a></div>
        </div>
    </nav>
     <div class="contact-clean" style="background-color:rgba(241,247,252,0);">
        <form method="post">
            <h2 class="text-center">Update Attendance</h2>
            <div class="form-group">
                Department:<br>
                <select class="form-control" style="margin-bottom:14px;width:100%;" name="department">
                    <option value="Admin">Admin</option>
                    <option value="General Office">General Office</option>
                    <option value="Sales Department">Sales Department</option>
                    <option value="Accounts Departmet">Accounts Department</option>
                    <option value="Production Department">Production Department</option>
                    <option value="Personnel Department">Personnel Department</option>
                    <option value="Export Department">Export Department</option>
                </select> 
                Date:
                <input class="form-control" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>" style="margin-bottom:0px;width:100%;">
                <div class="Error">
                    <?php echo $daterror; ?>
                </div>
                ID:
                <input class="form-control" type="number" name="ID" value="<?php echo isset($_POST['ID']) ? $_POST['ID'] : '' ?>" style="margin-top:0px;width:100%;">
                <div class="Error">
                    <?php echo $IDerror; ?>
                </div>
            </div>
            <center>
            <button
                class="btn btn-primary" type="submit" name="present_button" style="background-color:#1a0448;font-family:Roboto, sans-serif;">PRESENT</button>
            <button
                class="btn btn-primary" type="submit" name="absent_button" style="background-color:#1a0448;font-family:Roboto, sans-serif;">ABSENT</button>
            </center>
        </form>      
    </div>
                    </tbody>
                </table>
            </div>
        </form></center>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>