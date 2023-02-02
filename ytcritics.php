<?php
session_start();
 // Connect to the database
 require_once('database.php');
 $_SESSION['user_id']=$userid;
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

 // Insert the data into the `criticals` table
 $stmt = mysqli_prepare($dbc, "INSERT INTO reviews (choice_id, user_id, rate, title, comment) VALUES (1, ?, ?, ?, ?)"); 
	mysqli_stmt_bind_param($stmt, "iiss", $userid, $rate, $title, $description);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

 // Close the database connection
 $dbc->close();
}
?>
<div class="account-form">

<form action="" method="post" id ="confirmationform" name ="cinfirmationform">
  <h3>post your review</h3>
  <p class="placeholder">review title <span>*</span></p>
  <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box">
  <p class="placeholder">review description</p>
  <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
  <p class="placeholder">review rating <span>*</span></p>
  <div class="star-widget">
    <input type="hidden" name="rate" id="selected-rate" form="confirmationform">
    <input type="radio" name="star" id="rate-5" value=5 onclick="document.getElementById('selected-rate').value = this.value hidden;">
    <label for="rate-5" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-4" value=4 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-4" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-3" value=3 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-3" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-2" value=2 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-2" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-1" value=1 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-1" class="fas fa-star"></label>
  </div>  
   <input type="submit" value="submit review" name="submit" class="btn">
   <a href="view_post.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
</form>

</div>

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