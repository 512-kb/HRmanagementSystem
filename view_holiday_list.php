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

<body style="background-image:url(&quot;assets/img/art-artist-background-316466.jpg&quot;); background-repeat: no-repeat;">
   <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:#ffb800;height:79px;position:fixed;width: 100%;">
        <div class="container" >
            <a class="navbar-brand" href="#" style="color:#262228;margin-right:50px;">ADMIN PANEL</a>
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
                </ul><span style="margin-left: 80px; margin-right:20px; color: black"><?php echo $_SESSION['UserId']; ?></span><a class="btn btn-primary" role="button" href="index.php" style="background-color:#1a0448;margin-left:10px;height:40px;width:105px;">SIGN OUT</a></div>
        </div>
    </nav>
    <div><center>
        <form method="post" style="  background-color:rgba(76,175,181,0.2); width: 80%;  padding:20px; ">
            <h2 class="text-center" style="margin-top: 20px; margin-bottom: 50px;">Holiday List</h2>
            <div class="table-responsive">
            <table class="table">




<table id="example" class="table table-striped table-bordered" width="100%">
    <thead>
        <tr>
            <th>HOLIDAY</th>
            <th>DATE</th>
            <th>REMOVE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            mysql_select_db('sql12385657',mysql_connect('sql12.freemysqlhosting.net:3306','sql12385657','d8tvtgY9U9'));
            $q=mysql_query("SELECT * FROM holidays");
            while ($data=mysql_fetch_array($q))
            {
                $name=$data['day_name']; $date=$data['date'];
                $dte = date_format(date_create($date),"d F, Y");

                echo "<tr>
                        <td>".$name."</td>
                        <td>".$dte."</td>
                        <td><a href=\"Delete_holiday.php?Delete_holiday=".$date."\"><img name=".$date." width=35 height=35 src=\"assets/img/remove.png\"></a></td>
                    </tr>
                    ";
            }

        ?>

    </tbody>
 </table>
</div>
        </form></center>
    </div>

</body>

</html>