<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Κριτικές</title>
    <link rel="stylesheet" href="critic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>

  <script>
      window.onload = function() {
        // Get the container class from the original HTML file
        let container = window.opener.document.querySelector('.container');

        // Copy the content of the container class to the popup window
        document.querySelector('.container').innerHTML = container.innerHTML;
      };
    </script>

  <?php

if (isset($_POST['submit1'])) {
  $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_STRING);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

  // Insert the data into the database
  // ...

  // Redirect to a thank you page or display a message to the user
  // ...

 // Connect to the database
 require_once('database.php');
 
 // Insert the data into the `criticals` table
 $stmt = mysqli_prepare($dbc, "INSERT INTO criticals (choice_id, rate, comment) VALUES (1, ?, ?)");  //session for userid
	mysqli_stmt_bind_param($stmt, "is", $rate, $comment);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

 // Close the database connection
 $dbc->close();
}
?>

    <div class="container">
      <div class="post">
        <div class="text">Ευχαριστούμε για τη ψήφο σας!</div>
        <div class="edit">EDIT</div>
      </div>
      
      <div class="star-widget">
        <input type="hidden" name="rate" id="selected-rate" form="confirmationForm">
        <input type="radio" name="star" id="rate-5" value=5 onclick="document.getElementById('selected-rate').value = this.value;">
        <label for="rate-5" class="fas fa-star"></label>
        <input type="radio" name="star" id="rate-4" value=4 onclick="document.getElementById('selected-rate').value = this.value;">
        <label for="rate-4" class="fas fa-star"></label>
        <input type="radio" name="star" id="rate-3" value=3 onclick="document.getElementById('selected-rate').value = this.value;">
        <label for="rate-3" class="fas fa-star"></label>
        <input type="radio" name="star" id="rate-2" value=2 onclick="document.getElementById('selected-rate').value = this.value;">
        <label for="rate-2" class="fas fa-star"></label>
        <input type="radio" name="star" id="rate-1" value=1 onclick="document.getElementById('selected-rate').value = this.value;">
        <label for="rate-1" class="fas fa-star"></label>
        <form method="post" action="ytcritics.php"  id="confirmationForm" name="confirmationForm">
          <header></header>
          <div class="textarea">
            <textarea cols="30" name= "comment" placeholder="Περιγράψτε την εμπειρία σας"></textarea>
          </div>
          <div class="btn">
            <button type="submit" name="submit1">ΥΠΟΒΟΛΗ</button>
          </div>
        </form>
      </div>
  
    </div>

    <!--This script helps to display different divs when button is clicked-->
    <script>
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
    };

    








    </script>
    
  </body>
</html>