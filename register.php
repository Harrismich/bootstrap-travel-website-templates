<?php
session_start();
//------ PHP code for User registration form---
$error = "";
if (isset($_POST['submit'])) {
 
     // Database Link
    require('database.php');  

	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$username = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
	$first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
	$last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    // PHP form validation PHP code
     if ($password !== $confirmPassword) {
        $error = "1";
		echo '<script>alert("Password and Confirm passwors is not the same ")</script>';
     } else {
     
        //Check if email is already exist in the Database
		$stmt = mysqli_prepare($dbc, "SELECT user_id FROM user WHERE email = ?");
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user_id);
		
        if (mysqli_stmt_fetch($stmt)) {
			mysqli_stmt_close($stmt);
			echo '<script>alert("Your email has taken already! ")</script>';		
        } else {
			mysqli_stmt_close($stmt);
            //Password encryption or Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
			$stmt = mysqli_prepare($dbc, "INSERT INTO user (role_id , first_name , last_name, username , password , email) VALUES (2,?,?,?,?,?)");
			mysqli_stmt_bind_param($stmt, "sssss",  $first_name, $last_name, $username, $hashedPassword, $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

            //Redirecting user to home page after successfully logged in 
            header("Location: login.php");  

            }    
        }

}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Register |</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="form.css" /> 
    <link rel="stylesheet" type="text/css" href="animista.css" />
</head>
<body class = "bg-image50">
			<div class="container puff-in-hor">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
							<center> <h5 style="font-family: Noto Sans; color: lightgrey;">Register to </h5><h4 style="font-family: Noto Sans; color: lightgrey;">Smart City</h4></center><br>
							<form method="post" action="register.php" enctype="multipart/form-data">
                                <div class="form-group">
									<label style = "color: lightgrey; ">Enter Your Email:</label>
									<input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>" required />
								</div>
                                <div class="form-group">
									<label style = "color: lightgrey; " >Enter Your Username:</label>
									<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''?>" required />
								</div>
								<div class="form-group">
									<label style = "color: lightgrey; ">Enter Your Password:</label>
									<input type="password" name="password" class="form-control" required />
                                </div>
								<div class="form-group">
									<label style = "color: lightgrey; ">Confirm Your Password:</label>
									<input type="password" name="confirmPassword" class="form-control" required />
                                </div>
                                <div class="form-group">
									<label style = "color: lightgrey; ">Firstname:</label>
									<input type="text" name="first_name" class="form-control" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''?>" required />
								</div>
                                <div class="form-group">
									<label style = "color: lightgrey; ">Lastname:</label>
									<input type="text" name="last_name" class="form-control" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''?>" required />
                                </div>
								<div class="form-group text-right">
									<button class="btn btn-secondary btn-block" name="submit">Register</button>
								</div>
								<div class="form-group text-center">
									<span style="color: lightgrey;" class="text-muted">Already have an account! </span> <a href="login.php">Login </a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
</body>
</html>