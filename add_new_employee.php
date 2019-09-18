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
    	$fNameError = "";  $noError = 1;
    	$lNameError = "";
    	$GenderError = "";
    	$EmailError = "";
    	$deptError = "";
    	$SetPassError = "";
    	$ConfirmPassError = "";
    	$PhnError = "";
    	$AddError = "";
        $salError = "";

    	function Test_User_Input($Data)
		{
	       	return $Data;
	    }
    	if(isset($_POST['Submit']))
    	{
    		if(empty($_POST['first_name'])) { $fNameError = "First Name is Required"; $noError = 0; }
    		else
    		{    			
    			if(!preg_match("/^[A-Za-z\.]*$/",Test_User_Input($_POST["first_name"])))
    			{
    			    $fNameError="Only Letters are allowed";
    			    $noError = 0;
    			} 
    			else
    			{
    				$fName = Test_User_Input($_POST["first_name"]) ;
    			}
    		}
    		if(empty($_POST['last_name'])) { $lNameError = "Last Name is Required"; $noError = 0; }
    		else
    		{    			
    			if(!preg_match("/^[A-Za-z]*$/",Test_User_Input($_POST["last_name"])))
    			{
    			    $lNameError="Only Letters are allowed";
    			    $noError = 0;
    			} 
    			else
    			{
    				$lName = Test_User_Input($_POST["last_name"]) ;
    			}
    		}
    		if(empty($_POST['Email']))
    		{
				$EmailError="Email is Required";
				$noError = 0;
 			}
 			else
 			{				
				if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",Test_User_Input($_POST['Email'])))
                {
					$EmailError="Invalid Email Format";
					$noError = 0;
				}
				else
				{
					$f=0;
					$fetch = mysql_query("SELECT * FROM emp_list");
					while ($data = mysql_fetch_array($fetch)) 
					{
						if($data['email']==$_POST['Email'])
						{
							$EmailError = "Email ID already taken"; $f=1;
							$noError = 0; break;
						}
					}
					if($f==0) $Email = Test_User_Input($_POST['Email']);
				}
			}
			

          $Department = Test_User_Input($_POST['department']);
            

			if(empty($_POST['phone_no']))
			{
				$PhnError = "Phone No. Required";
				$noError = 0;
			}
			else
			{
				if(!preg_match("/[0-9]{10,11}/",$_POST['phone_no']))
				{
					$PhnError = "Invalid Phone Number";
					$noError = 0;
				}
				else
				{
					$f=0;
					$fetch = mysql_query("SELECT * FROM emp_list");
					while ($data = mysql_fetch_array($fetch)) 
					{
						if($data['phone_no']==$_POST['phone_no'])
						{
							$PhnError = "Phone No. already registered"; $f=1;
							$noError = 0; break;
						}
					}
					if($f==0) $phone_no = Test_User_Input($_POST['phone_no']);
				}
			}
            if(empty($_POST['salary']))
            {
                $salError = "Base Salary Required";
                $noError = 0;
            }
            else
            {
                if(!preg_match("/[0-9]{4,}/",$_POST['salary']))
                {
                    $salError = "Too Less Amount";
                    $noError = 0;
                }
                else
                {
                    $salary = Test_User_Input($_POST['salary']);
                }
            }
			if(empty($_POST['Gender']))
			{
				$GenderError="Gender is Required";
				$noError = 0;
 			}
 			else
 			{
				$Gender=Test_User_Input($_POST['Gender']);
			}		
			if(empty($_POST['Address']))
			{
				$AddError="Address is Required";
				$noError = 0;
 			}
 			else
 			{
				$Address=Test_User_Input($_POST['Address']);
			}
			if(empty($_POST['set_password']))
    		{
				$SetPassError ="Password is Required";
				$noError = 0;
 			}
 			else
 			{				
				if(!preg_match("/[a-zA-Z0-9._@]{8,}/",Test_User_Input($_POST['set_password'])))
                {
					$SetPassError="Invalid Password Format ( only '.' , '@' , '_' , a-z , A-z , 0-9 are allowed. Min Length = 8 )";
					$noError = 0;
				}
				else
				{
					$tempPass = Test_User_Input($_POST['set_password']);
				}
			}
			if(empty($_POST['confirm_password']))
    		{
				$ConfirmPassError ="Retype your Password";
				$noError = 0;
 			}
 			else
 			{				
				if( $tempPass != Test_User_Input($_POST['confirm_password']) )
                {
					$ConfirmPassError = "Password Mismatch";
					$noError = 0;
				}
				else
				{
					$Password = $tempPass;
				}
			}

			if($noError == 1) 
			{				
				$query = "INSERT into emp_list(first_name,last_name,email,department,password,salary,address,phone_no,gender) VALUES('$fName','$lName','$Email','$Department','$Password','$salary','$Address','$phone_no','$Gender')";
				if(mysql_query($query))
				{
                    mail($Email, 'Successfully Registered', 'Congratulations '.$fName.'!  You have been successfully registered in our Organistaion','From: h.r.budddddy@gmail.com');
					echo "
                            <script>
                                alert(\"Employee Added\");
                            </script>
                         ";
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
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body> 
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:#ffb800;height:79px;position:fixed;width: 100%;">
        <div class="container"><a class="navbar-brand" href="#" style="color:#262228;margin-right:70px;"><strong>ADMIN PANEL</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
                        <div class="dropdown-menu" role="menu" style="color:#ffb800;background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="add_new_holiday.php" style="color:#ffb800;">ADD NEW HOLIDAY</a>
                            <a
                                class="dropdown-item" role="presentation" href="view_holiday_list.php" style="color:#ffb800;">VIEW HOLIDAY LIST</a>
                        </div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" data-bs-hover-animate="pulse" style="color:#262228;">PAYROLL MANAGEMENT</a>
                        <div class="dropdown-menu" role="menu" style="background-color:#1a0448;"><a class="dropdown-item" role="presentation" href="create_payslip.php" style="color:#ffb800;">CREATE PAY SLIP</a><a class="dropdown-item" role="presentation" href="manage_salaries.php" style="color:#ffb800;">MANAGE SALARIES</a></div>
                    </li>
                </ul><span style="margin-left: 80px; margin-right:20px; color: black"><?php echo $_SESSION['UserId']; ?></span><a class="btn btn-primary" role="button" href="Log_In.php" style="background-color:#1a0448;margin-left:10px;height:40px;width:105px;">SIGN OUT</a></div>
        </div>
    </nav>
    <div class="register-photo" style=" background-color:rgba(241,247,252,0);background-image:url(&quot;assets/img/background-desk-desktop-background-1097930.jpg&quot;);background-size:cover;">
        <div class="form-container">
            <form  action="add_new_employee.php" method="post" style="width: 100%; background-color:rgba(149,212,231,0.21);padding:33px;  margin-top:0px;">
                <h2 class="text-center" style="color:#1a0448;font-size:42px;margin-top:-10px;"><strong>Add New Employee</strong></h2>
                <div class="form-group">
                	<div class="Error">
                		<?php echo $fNameError; ?>
                	</div>
                	<input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" style="margin-bottom:14px; background-color: white;">
                	<div class="Error">
                		<?php echo $lNameError; ?>
                	</div>
                	<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" style="margin-bottom:14px; background-color: white;">
                	<div class="Error">
                		<?php echo $GenderError; ?>
                	</div>
                	<div style="padding:8px 16px; background-color: white; margin-bottom:15px;">
                	<input style="margin-right: 7px;" type="radio" class="radio" name="Gender" value="Male" >Male
					<input style="margin-left: 5%; margin-right: 7px;" type="radio" class="radio" name="Gender" value="Female">Female   
				    </div>
                	<div class="Error">
                		<?php echo $PhnError; ?>
                	</div>
                	<input class="form-control"
                        type="text" name="phone_no" placeholder="Phone Number" value="<?php echo isset($_POST['phone_no']) ? $_POST['phone_no'] : '' ?>" style="margin-bottom:14px; background-color: white;">
                	<div class="Error">
                		<?php echo $EmailError; ?>
                	</div>
                        <input class="form-control" type="email" name="Email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '' ?>" placeholder="Email" style="background-color:#ffffff;margin:0px;margin-bottom:14px; background-color: white;">
                        <div class="Error">
                			<?php echo $deptError; ?>
                		</div>
                        <select class="form-control" style="margin-bottom:14px; background-color: white;" name="department">                                                
                        <option value="Admin" >Admin</option>             
                        <option value="General Office" selected="true">General Office</option>
                        <option value="Sales Department" >Sales Department</option>
                        <option value="Accounts Department" >Accounts Department</option>
                        <option value="Production Department" >Production Department</option>
                        <option value="Personnel Department" >Personnel Department</option>
                        <option value="Export Department" >Export Department</option></select>                          
                    <div class="Error">
                        <?php echo $salError; ?>
                    </div>
                    <input class="form-control" type="text" name="salary" placeholder="Base Salary" value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : '' ?>" style="margin-bottom:14px; background-color: white;"> 

                    <div class="Error">
                		<?php echo $AddError; ?>
                	</div>                              
                    <textarea
                        class="form-control" name="Address" placeholder="Address" value="<?php echo isset($_POST['Address']) ? $_POST['Address'] : '' ?>" style="margin-bottom:14px;height:125px; background-color: white;"></textarea>
                	<div class="Error">
                		<?php echo $SetPassError; ?>
                	</div>
                        <input class="form-control" type="password" name="set_password" value="<?php echo isset($_POST['set_password']) ? $_POST['set_password'] : '' ?>" placeholder="Password" style=" background-color: white; margin-bottom:14px;">
                	
                	<div class="Error">
                		<?php echo $ConfirmPassError; ?>
                	</div>
                        <input class="form-control" type="password" name="confirm_password" value="<?php echo isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '' ?>" placeholder="Password (repeat)" style=" background-color: white;margin-bottom:14px;">
                	</div>
                <div class="form-group"><input type="Submit" class="btn btn-primary btn-block flex-shrink-1 align-self-center" style="background-color:rgb(43,47,129);width:auto;margin-left:334px;" name="Submit" value="Submit"></div>
            </form>
        </div>
    </div>
    
</body>

</html>