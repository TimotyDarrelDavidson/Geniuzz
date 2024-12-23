<?php
	include ('database.php');
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
						
		
		$result = mysqli_query($con,"SELECT * FROM user WHERE email = '$email'") or die('Error');
        $count=mysqli_num_rows($result);
		
		if($count==1){
			$user =mysqli_fetch_assoc($result);
			if(password_verify($password,$user['password'])){
				session_start();
				if(isset($_SESSION['email']))
          		  {
                session_unset();
         		   }
					$row=mysqli_fetch_array($result);
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
					echo '<script type="text/javascript">'; 
					echo 'alert("Successfully Logged In. Welcome Student!");';
					echo 'window.location.href = "welcome.php?q=1";';
					echo '</script>';	
			}
			else{
				echo "<center><h3><script>alert('Sorry.. Wrong Password');</script></h3></center>";
				header("refresh:0;url=login.php");	
			}
		}
		else 
		{
			echo "<center><h3><script>alert('Sorry.. Username Not Found');</script></h3></center>";
			header("refresh:0;url=login.php");	
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login | Online Quiz System</title>
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
						<center> <h5 style="font-family: Noto Sans;">Login to </h5><h4 style="font-family: Noto Sans;">Online Quiz System</h4></center><br>
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Enter Your Email Id:</label>
									<input type="email" name="email" class="form-control">
								</div>
								<div class="form-group">
									<label class="fw">Enter Your Password:
									</label>
									<input type="password" name="password" class="form-control">
								</div> 
								<div class="form-group text-right">
									<button class="btn btn-primary btn-block" name="submit">Login</button>
								</div>
								<div class="form-group text-center">
									<span class="text-muted">Don't have an account?</span> <a href="register.php">Register</a> Here..
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