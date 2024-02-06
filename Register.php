

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIN</title>
    <link rel="stylesheet" href="css/logIN.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
</head>
<body>
<?php
    include'connect.php';

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $PhoneNumber = mysqli_real_escape_string($con,$_POST['phone_Number']);
        $PassWord  = mysqli_real_escape_string($con,$_POST['passWord']);
        $CPassWord = mysqli_real_escape_string($con,$_POST['Cpassword']);

        $selectQuery = "select * from registration where Email = '$email'";
        $query1 = mysqli_query($con,$selectQuery); 
        if (mysqli_num_rows($query1) > 0) {
            echo '<script>alert("Email Already Registered Use Another One")</script>';
        }
        if($PassWord === $CPassWord){
            $hashedPassword = password_hash(mysqli_real_escape_string($con,$_POST['passWord']),PASSWORD_BCRYPT);
            $hashedPasswordC = password_hash(mysqli_real_escape_string($con,$_POST['Cpassword']),PASSWORD_BCRYPT);
            $InsertQuery = "INSERT into registration(Username,Email,PhoneNumber,Password,CPassword) values('$username','$email','$PhoneNumber','$hashedPassword','$hashedPasswordC')";
            $query = mysqli_query($con,$InsertQuery);
            if ($query) {
                echo '<script>alert("Successfully Registered")</script>';
                header('location:login.php');
            } else {
                echo '<script>alert("Registration failed")</script>';
            }
               
        }else{
            echo '<script>alert("Password and Confirm Password is Different")</script>';
        }
      
    }
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
                        <input type="text" class="login__input" placeholder="Username" value="" name="username">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-envelope"></i>
                        <input type="email" class="login__input" placeholder="Email" value="" name="email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-phone"></i>
                        <input type="text" class="login__input" placeholder="Phone Number" value="" name="phone_Number">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Password" value="pass" name="passWord">
                    </div>
                    <div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" class="login__input" placeholder="Confirm Password" name="Cpassword" value="Cpass">
					</div>
                    <button class="button login__submit"  type="submit" name="submit">
                        <span class="button__text">Register Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <div class="logintag">
                        <span class="logintag_span">Already have an account? <a href="login.php">Login</a></span>
                    </div>					
                </form>
                <!-- <div class="social-login">
                    <h3>log in via</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div>
                </div> -->
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
<script src="https://kit.fontawesome.com/14f405822f.js" crossorigin="anonymous">
</body>
</html>