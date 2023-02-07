<?php
session_start();
//------ PHP code for User registration form---

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
