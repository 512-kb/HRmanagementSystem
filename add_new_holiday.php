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
         mysql_select_db('projectsalary',mysql_connect('localhost','root',''));
        $HDerror = ""; $daterror = ""; $noError = 1;
        if(isset($_POST["add_button"]))
        {
            if(empty($_POST['holiday_name']))
            {
                $HDerror = "Field Empty"; $noError = 0;
            }
            else
            {
                $f=0;
                $q = mysql_query("SELECT * FROM holidays");
                while($data = mysql_fetch_array($q)) 
                {
                    if($_POST['holiday_name']==$data['day_name'])
                    {
                        $f=1; $noError = 0;
                        $HDerror = "Holiday already exists";
                        break;
                    }
                }
                if($f==0) $holiday_name = $_POST['holiday_name'];
            }
            if(empty($_POST['date']))
            {
                $daterror = "Field Empty"; $noError = 0;
            }
            else
            {
                $f=0;
                $q = mysql_query("SELECT * FROM holidays");
                while ($data = mysql_fetch_array($q)) 
                {
                    if($_POST['date']==$data['date'])
                    {
                        $f=1; $noError = 0;
                        $HDerror = "Day already exists";
                        break;
                    }
                }
                if($f==0) $holiday_date = $_POST['date'];
            }
            if($noError==1)
            {
                mysql_query("INSERT INTO holidays(day_name,date) values('$holiday_name','$holiday_date')");
                echo '
                            <script>
                                alert("Holiday Added");
                            </script>
                     ';
            }
        }
    ?>


<head>
    <meta charset="utf-8">
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</head>
<body style="background-image:url(&quot;assets/img/art-artist-background-316466.jpg&quot;);background-size:cover;  background-repeat: no-repeat; ">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:#ffb800;height:79px;position:fixed;width: 100%;">
        <div class="container"><a class="navbar-brand" href="#" style="color:#262228;margin-right:70px;"><strong>ADMIN PANEL</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
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
                </ul><a class="btn btn-primary" role="button" href="Log_In.php" style="background-color:#1a0448;margin-left:150px;height:40px;width:105px;">SIGN OUT</a></div>
        </div>
    </nav> 
    <div class="contact-clean" style="background-color:rgba(241,247,252,0);">
        <form method="post">
            <h2 class="text-center">Add a new Holiday</h2><br>
            <div class="form-group">
                
                <input class="form-control" style="width:100%;" type="text" name="holiday_name" value="<?php echo isset($_POST['holiday_name']) ? $_POST['holiday_name'] : '' ?>" placeholder="Holiday Name">
                <div class="Error">
                        <?php echo $HDerror; ?>
                    </div>
                
                <input class="form-control" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>" style="margin-top:29px; width:100%;">
                <div class="Error">
                        <?php echo $daterror; ?>
                    </div>
            </div>

            <button
                class="btn btn-primary" type="submit" name="add_button" style="background-color:#1a0448;font-family:Roboto, sans-serif;margin-left:153px;margin-top:42px;">ADD</button>
        </form>

        

    </div>
    
</body>

</html>