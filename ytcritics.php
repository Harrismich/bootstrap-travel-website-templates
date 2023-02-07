<?php
session_start();
 // Connect to the database
 require_once('database.php');
$userid= $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Κριτικές</title>
    <link rel="stylesheet" href="css/style_2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  </head>
  <body>

  <script>/*
      window.onload = function() {
        // Get the container class from the original HTML file
        let container = window.opener.document.querySelector('.container');

        // Copy the content of the container class to the popup window
        document.querySelector('.container').innerHTML = container.innerHTML;
      };*/
    </script>

  <?php

if (isset($_POST['submit'])) {
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_STRING);
  // Insert the data into the database
  // ...

  // Redirect to a thank you page or display a message to the user
  // ..
  $userid= $_SESSION['user_id'];
 // Insert the data into the `criticals` table
 $stmt = mysqli_prepare($dbc, "INSERT INTO reviews (choice_id, user_id, rate, title, comment) VALUES (1, ?, ?, ?, ?)"); 
	mysqli_stmt_bind_param($stmt, "iiss", $userid, $rate, $title, $description);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

 // Close the database connection
 $dbc->close();
}
?>


    <!--This script helps to display different divs when button is clicked-->
    <script>/*
      const btn = document.querySelector("button");
      const post = document.querySelector(".post");
      const widget = document.querySelector(".star-widget");
      const editBtn = document.querySelector(".edit");
      const form = document.querySelector("form"); 
      // when the button has been clicked submit the form
      btn.onclick = ()=>{
        form.submit();
        localStorage.setItem("formSubmitted", true);
      }
      //on the reload page after submit form has finished display the message
      window.onload = () => {
        if (localStorage.getItem("formSubmitted") === "true") {
        // Display the message
        post.style.display = "block";
        widget.style.display = "none";
        editBtn.onclick = ()=>{
            widget.style.display = "block";
            post.style.display = "none";
        }
        localStorage.removeItem("formSubmitted");
      }
    };*/
    </script>
    <!-- custom js file link  -->
  <script src="js/script.js"></script>
  </body>
</html>