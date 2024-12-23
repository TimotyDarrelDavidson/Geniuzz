<?php
    include_once 'database.php';
    session_start();
    if(isset($_SESSION["email"]))
	{
		session_destroy();
    }
    
    $ref=@$_GET['q'];
    if(isset($_POST['submit']))
	{	
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1)
        {
			$user = mysqli_fetch_assoc($result);
			if(password_verify($password, $user['password'])){
				
				session_start();
            if(isset($_SESSION['email']))
            {
                session_unset();
            }
            $_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;
			echo '<script type="text/javascript">'; 
			echo 'alert("Successfully Logged In as Admin");';
			echo 'window.location.href = "dashboard.php?q=1";';
			echo '</script>';
			}
			else{
				echo "<center><h3><script>alert('Sorry.. Wrong Password');</script></h3></center>";
			header("refresh:0;url=admin.php");	
			}
            
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Admin Login | Online Quiz System</title>
		<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="css/form.css">
        <style type="text/css">
            body{
                  width: 100%;
                  background: url(image/1_6Jp3vJWe7VFlFHZ9WhSJng.jpg) ;
                  background-position: center center;
                  background-repeat: no-repeat;
                  background-attachment: fixed;
                  background-size: cover;
                }
          </style>
	</head>

	<body>
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
						<center> <h5 style="font-family: Noto Sans;">Login to </h5><h4 style="font-family: Noto Sans;">Admin Page</h4></center><br>
							<form method="post" action="admin.php" enctype="multipart/form-data">
								<div class="form-group">
									<label>Enter Your Email Id:</label>
									<input type="email" name="email" class="form-control">
								</div>
								<div class="form-group">
									<label class="fw">Enter Your Password:
										<a href="javascript:void(0)" class="pull-right">Forgot Password?</a>
									</label>
									<input type="password" name="password" class="form-control">
								</div> 
								<div class="form-group text-right">
									<button class="btn btn-primary btn-block" name="submit">Login</button>
								</div>
								<div class="form-group text-center">
									<span class="text-muted">Don't have an admin account?</span> <a href="register_admin.php">Register</a> Here..
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="js/jquery.js"></script>
		<script src="scripts/bootstrap/bootstrap.min.js"></script>
	</body>
</html>