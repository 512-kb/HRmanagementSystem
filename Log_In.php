<!DOCTYPE html>
<html>

<?php 

    session_start();
    $_SESSION['UserId'] = "";
?>

<?php
        $emailerror = ""; $passerror = "";
        if(isset($_POST['Submit']))
        {
            $exec = mysql_select_db('projectsalary',mysql_connect('localhost','root',''));
            if(empty($_POST['email']))  
            {
                $emailerror = "Email Required";
            }
            else
            {
                $select = mysql_query("SELECT * FROM emp_list WHERE department='Admin'");   
                $id=""; $pass=""; $f=0;
                while($data=mysql_fetch_array($select))
                {
                    if($_POST['email']==$data['email'])
                    {
                        $id = $data['email'];
                        $pass = $data['password'];
                        $f = 1;
                        break;
                    }
                }
                if($f==0)
                {
                    if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$_POST['email']))
                    {
                        $emailerror = "Invalid Email";
                    }
                    else
                    {
                        $emailerror = "User is not an ADMIN";
                    }
                }
                else
                {
                    if(empty($_POST['password']))
                    {
                        $passerror = "Password Required";
                    }
                    else
                    {
                        if($_POST['password']!=$data['password'])
                        {
                            $passerror = "Wrong Password";
                        }
                        else
                        {
                            $_SESSION['UserId'] = $data['first_name'];
                            header("Location:add_new_employee.php");
                        }
                    }
                }
            }
        }
    ?>
    <head>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
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
    <link rel="stylesheet" href="assets/css/styles.css"></head>
<body style="background-image:url(&quot;assets/img/BG2.jpg&quot;);background-size:cover;background-color:#ffffff;">
    <div class="login-clean" style="background-color:rgba(241,247,252,0);background-image:url(&quot;none&quot;);">
        <!--    <center><h1 style="color: white; font-size: 90px; margin-bottom: 60px;">Welcome to HR BUDDY</h1></center>   -->
        <form method="post" style="background-color:rgba(12,13,31,0.83);">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="fa fa-user" style="color:rgb(52,170,255);"></i></div>
            <div class="form-group">
                <div class="Error">
                        <?php echo $emailerror; ?>
                    </div>
                <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>
            <div class="form-group">
                <div class="Error">
                        <?php echo $passerror; ?>
                    </div>
                <input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="Submit" name="Submit" style="color:rgb(14,10,37);background-color:rgb(255,181,38);">Log In</button></div>
        </form>
    </div>
    
</body>

</html>