<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIN</title>
    <link rel="stylesheet" href="css/logIN.css">
</head>
<body>

<?php

include'connect.php';

  	if(isset($_POST['submit'])){

		$email = $_POST['email'];
		$password = $_POST['password'];

		$selectEmail = "select * from registration where Email = '{$email}'";
		$query = mysqli_query($con,$selectEmail);

		if(mysqli_num_rows($query)>0){
			$email_pass = mysqli_fetch_assoc($query);
			$dbPASS = $email_pass['Password'];
			$_SESSION['Email'] = $email_pass['Email'];
			$_SESSION['Username'] = $email_pass['Username'];
			$pass_decode = password_verify($password,$dbPASS);
			if($pass_decode){
				if(isset($_POST['check'])){
				setcookie('emailcookie',$email,time()+86400);
				setcookie('passcookie',$password,time()+86400);
				header('location:index.php');
				}
				else{
					header('location:index.php');
				}
			}
			else{
				echo '<script>
				alert("Password Incorrect");
				 </script>';
			}
		}else{
			echo '<script>
				alert("Invalid Email");
				 </script>';
		}
	}
	// $email_pass = isset($email_pass) ? $email_pass : null;
?>

<div>
	<div class="container1">
		<h1>Create Account</h1>
		<p>Get started with your free account</p>
	</div>
	<div class="container">
		<div class="screen">
			<div class="screen__content">
				<form class="login" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);
				?>">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="email" class="login__input" placeholder="Email" name="email" value="<?php if(isset($_COOKIE['emailcookie'])){echo $_COOKIE['emailcookie'];} ?>">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" class="login__input" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['passcookie'])){echo $_COOKIE['passcookie'];} ?>">
					</div>
					<div class="login__field">
						<input type="checkbox"   name="check" value="">  Remember me
					</div>
					<button class="button login__submit" name="submit" type="submit" value="submit">
						<span class="button__text" >Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
					<div class="logintag">
						<span class="logintag_span">Don't have an account? <a href="Register.php">Sign Up</a></span>
					</div>					
				</form>
				<div class="social-login">
					<h3>log in via</h3>
					<div class="social-icons">
						<a href="#" class="social-login__icon fab fa-instagram"></a>
						<a href="#" class="social-login__icon fab fa-facebook"></a>
						<a href="#" class="social-login__icon fab fa-twitter"></a>
					</div>
				</div>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>		
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>		
		</div>
	</div>
</div>
<script src="https://kit.fontawesome.com/14f405822f.js" crossorigin="anonymous"></script>
</body>
</html>