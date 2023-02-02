<?php 
session_start();
require_once('database.php');

//check if the form has been submited
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);	

	$stmt = mysqli_prepare($dbc, "SELECT user_id, Username, Password, role_id FROM User WHERE Username = ?");
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $userid, $username, $pw, $role);

	if (mysqli_stmt_fetch($stmt)) {
		mysqli_stmt_close($stmt);
		//check if the entered password matches the hashed password in the database
		if(password_verify($password, $pw)) {
    		if($role == 1){
				$_SESSION['logged_in_admin'] = true;
				$_SESSION['user_id']=$userid;
				$_SESSION['username']=$username;
    			header('Location: adminhome.php');
    		}else{
				$_SESSION['logged_in_user'] = true;
				$_SESSION['user_id']=$userid;
				$_SESSION['username']=$username;
       			header('Location: packages.php');
   			}	
		}else {
			echo '<script>alert("Password or Username are invalid ")</script>';
		}
	}else {
		echo '<script>alert("Password or Username are invalid ")</script>';
	}
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Travelet Free Website Tempalte | Smarteyeapps.com</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

	<body class ="bg-image50">
		
    <section class="login first grey puff-in-hor">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
						<center> <h5 style="font-family: Noto Sans;">Login to </h5><h4 style="font-family: Noto Sans;">Smart City</h4></center><br>
							<form method="post" action=" " enctype="multipart/form-data">
								<div class="form-group">
									<label style ="color: lightgrey;">Enter Your username:</label>
									<input type="text" name="username" class="form-control">
								</div>
								<div class="form-group">
									<label style ="color: lightgrey;">Enter Your Password:
									</label>
									<input type="password" name="password" class="form-control">
								</div> 
								<div class="form-group text-right">
                                <center><button type="submit" class="btn btn-secondary" name="submit">Login</button></center>
								</div>
								<div class="form-group text-center">
									<span style = "color: lightgrey;">Don't have an account?</span> <a href="register.php">Register</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>