<?php
require_once('database.php');
session_start();
$action = mysqli_real_escape_string($dbc, $_POST["action"]);
$choice_id = mysqli_real_escape_string($dbc, $_POST["choice_id"]);
$user_id = $_SESSION["user_id"];




  if ($action == "add") {
    // Check if the card choice already exists in the database
    $sql = "INSERT INTO user_choice ( user_id , choice_id ) VALUES ( '$user_id' , '$choice_id' )";
      if (mysqli_query($dbc, $sql)) {
        echo "Record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
      }
  } else if ($action == "delete") {
    // Delete the card choice from the database
    $sql = "DELETE FROM user_choice WHERE choice_id= '$choice_id' and user_id = '$user_id'";
    if (mysqli_query($dbc, $sql)) {
      echo "Record deleted successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
    }
  }  
  mysqli_close($dbc);
?>
