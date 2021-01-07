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
    header("Location: index.php");
}
?>

<?php
    $GPFerror=""; $GSIerror=""; $TAerror=""; $DAerror=""; $leaverror=""; $dederror=""; $yearerror="";
    $noError=1; $leaves=0; $ded=0; $year = 0;
    $id = $_SESSION['idSAL'];
    if(isset($_POST['Submit']))
    {
        $month = $_POST['month'];
         mysql_select_db('sql12385657',mysql_connect('sql12.freemysqlhosting.net:3306','sql12385657','d8tvtgY9U9'));
         if(empty($_POST['GPF']))
         {
            $GPFerror = "GPF required";
            $noError  = 0;
         }
         else
         {
            if($_POST['GPF']<=0 || $_POST['GPF']>100)
            {
                $GPFerror = "Invalid Percentage";
                $noError  = 0;
            }
            else
            {
                $gpf = $_POST['GPF'];
            }
         }
         if(empty($_POST['GSI']))
         {
            $GSIerror = "GSI required";
            $noError  = 0;
         }
         else
         {
            if($_POST['GSI']<=0)
            {
                $GSIerror = "Invalid Amount";
                $noError  = 0;
            }
            else
            {
                $gsi = $_POST['GSI'];
            }
         }
         if(!empty($_POST['TA']) && $_POST['TA']!=0)
         {
            if($_POST['TA']<=0)
            {
                $TAerror = "Invalid Amount";
                $noError  = 0;
            }
            else $ta = $_POST['TA'];
         }
         else
         {
            $ta = 0;
         }
         if(!empty($_POST['DA']) && $_POST['DA']!=0)
         {
            if($_POST['DA']<=0)
            {
                $DAerror = "Invalid Amount of Leaves";
                $noError  = 0;
            }
            else $da = $_POST['DA'];
         }
         else
         {
            $da = 0;
         }
         if(empty($_POST['year']))
         {
            $yearerror="Year Required";
            $noError = 0;
         }
         else
         {
            if($_POST['year'] != date("Y"))
            {
                $yearerror = "Not the Current Year";
                $noError = 0;
            }
            else $year = $_POST['year'];
         }
         $leaves = 0;
         $q = mysql_query("SELECT * FROM attendance WHERE status='Absent' AND id='$id'");
         while ($data = mysql_fetch_array($q))
         {
            if($year == substr($data['date'],0,4) && $month == substr($data['date'],5,2) )
            {
                $leaves = $leaves + 1;
            }
         }

         if(!empty($_POST['ded']) && $_POST['ded']!=0)
         {
            if($_POST['ded']<=0)
            {
                $dederror = "Invalid Amount";
                $noError  = 0;
            }
            else $ded = $_POST['ded'];
         }
         else
         {
            $ded = 0;
         }

         $deduction = $leaves * $ded;

        if($noError==1)
        {
            $exists=0;
            $fetch = mysql_query("SELECT * FROM salary");
            while ($data = mysql_fetch_array($fetch))
            {
                if($data['id']==$id)
                {
                    $exists=1;
                    break;
                }
            }
            if($exists==0)
            {
                $exec = mysql_query("INSERT INTO salary VALUES($id,$gpf,$gsi,$ta,$da,$deduction)");
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Record Entered\");
                            </script>
                        ";
                }
            }
            else
            {
                $exec = mysql_query("UPDATE salary SET gpf=$gpf,gsi=$gsi,ta=$ta,da=$da,leave_deduction=$deduction WHERE id='$id'");
                if($exec)
                {
                    echo "
                            <script>
                                alert(\"Record Entered\");
                            </script>
                        ";
                }
            }
        }
    }

?>

<head>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</head>
<body style="background-image:linear-gradient(rgb(0,0,0,0),rgb(0,0,0,0)),url('assets/img/cup.jpg'); background-size: cover ; background-repeat: no-repeat";>
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
                </ul><span style="margin-left: 80px; margin-right:20px; color: black"><?php echo strtoupper($_SESSION['UserId']); ?></span><a class="btn btn-primary" role="button" href="index.php" style="background-color:#1a0448;margin-left:10px;height:40px;width:105px;">SIGN OUT</a></div>
        </div>
    </nav>

    <div class="register-photo" style=" background-color:rgba(241,247,252,0);background-size:cover; ">
        <div class="form-container">
            <form class="inline-check" action="salary_form.php" method="post" style="background-color:rgba(149,212,231,0.21);padding:33px; width: 100%; ">
                <h2 class="text-center" style="color:#1a0448;font-size:42px;margin-top:-10px;"><strong><?php echo $_SESSION['nameSAL']; ?>'s Salary</strong></h2>
                <div class="form-group">
                    <legend>General Deductions</legend>

                	GPF (percent):<div class="Error">
                        <?php echo $GPFerror; ?>
                    </div><input class="form-control" type="number" name="GPF" placeholder="Enter Here" value="<?php echo isset($_POST['GPF']) ? $_POST['GPF'] : '' ?>" style="margin-bottom:14px; width: 200px; background-color: white;">

                    GSI (amount):<div class="Error">
                        <?php echo $GSIerror; ?>
                    </div><input class="form-control" type="number" name="GSI" placeholder="Enter Here" value="<?php echo isset($_POST['GSI']) ? $_POST['GSI'] : '' ?>" style="margin-bottom:14px; width: 200px; background-color: white;">

                    <legend>Allowances</legend>

                    TA (amount):<div class="Error">
                        <?php echo $TAerror; ?>
                    </div><input class="form-control" type="number" name="TA" placeholder="Enter Here" value="<?php echo isset($_POST['TA']) ? $_POST['TA'] : '' ?>" style="margin-bottom:14px; width: 200px; background-color: white;">


                    DA (amount):<div class="Error">
                        <?php echo $DAerror; ?>
                    </div><input class="form-control" type="number" name="DA" placeholder="Enter Here" value="<?php echo isset($_POST['DA']) ? $_POST['DA'] : '' ?>" style="margin-bottom:14px; width: 200px; background-color: white;">

                    <legend>Leave Deduction</legend>
                    Month:
                    <select class="form-control" style="margin-bottom:14px; background-color: white; width:200px; " name="month">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                        Year:<div class="Error">
                        <?php echo $yearerror; ?>
                    </div><input class="form-control" type="text" name="year" placeholder="Enter Here" value="<?php echo isset($_POST['year']) ? $_POST['year'] : '' ?>" style=" margin-bottom:14px; width: 200px; background-color: white;">

                    Deduction Per Leave (amount):<div class="Error">
                        <?php echo $dederror; ?>
                    </div> <input class="form-control" type="number" name="ded" placeholder="Enter Here" value="<?php echo isset($_POST['ded']) ? $_POST['ded'] : '' ?>" style="margin-bottom:14px; width: 200px; background-color: white;">


                    <input type="Submit" class="btn btn-primary btn-block flex-shrink-1 align-self-center" style="background-color:rgb(43,47,129);width:auto;margin-left:334px;" name="Submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>

</body>
</html>