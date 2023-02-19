<?php 
session_start();

require_once('database.php');

//check if the form has been submited
if (isset($_POST['signUp'])) {
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
			$_SESSION['username'] = $username;
			header('Location: http://localhost/project%20php/bootstrap-travel-website-templates/adminCRUD/home.php');
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
if (isset($_POST['Register'])) {

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
	header("Location: login.php");  

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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Travelet Free Website Tempalte | Smarteyeapps.com</title>
	<link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="login.css">
	<style> 
	#body-content {
		width: 100%;
		height: 100%;
	}
body {
	background-size: cover;
	transition: background-image 1.3s ease-in;
}
</style>
</style>

</head>
<?php
$result = mysqli_query($dbc, "SELECT * FROM pic where type_id = 'city' ORDER BY RAND()");
$images = [];
while ($row = mysqli_fetch_array($result)) {
$images[] = 'images/' . $row['path'] . '.jpg';
}


?>

<body>
<div id="body-content">
	<div class="firstone">
		<?php include('header.php');?>
	</div>	
	<div class="secondone">
		<div class="login-wrap">
			<div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<form method="post" action=" " enctype="multipart/form-data"><br><br>
							<div class="group">
							<label for="username" class="label">Username</label>
							<input id="username" name="username" type="text" class="input" required>
							</div><br>
							<div class="group">
							<label for="password" class="label">Password</label>
							<input id="password" name="password" type="password" class="input" data-type="password" required>
							</div><br>
							<div class="group">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
							</div><br><br>
							<div class="group">
							<input type="submit" class="button" name ="signUp" value="Sign In">
							</div><br><br>
							<!-- <div class="hr"></div> -->
							<div class="foot-lnk">
							<a href="forgotpassword.php">Forgot Password?</a>
							</div>
						</form>
					</div>
					<div class="sign-up-htm">
						<form method="post" action="login.php" enctype="multipart/form-data">
							<div class="group">
							<label for="email" class="label">Email Address</label>
							<input id="email" type="email" name="email" class="input" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>" required />
							</div>
							<div class="group">
							<label for="user" class="label">Username</label>
							<input id="user" type="text" name="name" class="input"value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''?>" required />
							</div>
							<div class="group">
							<label for="pass"  class="label">Password</label>
							<input id="pass" type="password" name="password" class="input" data-type="password" required>
							</div>
							<div class="group">
							<label for="confirmpass" class="label">Confirm Password</label>
							<input id="confirmpass" type="password" name="confirmPassword" class="input" data-type="password" required>
							</div>
							<div class="group">
							<label for="firts_name" class="label">Όνομα</label>
							<input id="firts_name" type="text" name="first_name" class="input"  value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''?>" required />
							</div>
							<div class="group">
							<label for="lastname" class="label">Επώνυμο</label>
							<input id="lastname" type="text" name="last_name" class="input" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''?>" required />
							</div>
							<div class="group">
							<input type="submit" class="button" name="Register" value="Sign Up">
							</div>
							<!-- <div class="hr"></div> -->
							<div class="foot-lnk">
							<label for="tab-1">Already Member?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<script>
function changeBackground() {
var images = <?php echo json_encode($images); ?>;
var index = 0;
document.body.style.backgroundImage = "url(" + images[index] + ")";
setInterval(function () {
	document.body.style.backgroundImage = "url(" + images[index] + ")";
	index = (index + 1) % images.length;
}, 4000);
}
changeBackground();
</script>
</body>
</html>