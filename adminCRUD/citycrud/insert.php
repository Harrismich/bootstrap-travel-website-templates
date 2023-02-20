<?php
include('../database.php');

  $city_name=$_POST['city_name'];
  $description=$_POST['description'];
  
  $dbc->autocommit(FALSE); // disable auto-commit

  $check_city_stmt = $dbc->prepare("SELECT * FROM city WHERE city_name = ?");
  $check_city_stmt->bind_param("s", $city_name);
  $check_city_stmt->execute();
  $check_city_result = $check_city_stmt->get_result();
  
  if ($check_city_result->num_rows > 0) {
    // If the city already exists, display an error message and go back to the previous page
    echo "<script>alert('The city already exists in the database.'); history.go(-1);</script>";
    exit();
  }

  $city_insert_stmt = $dbc->prepare("INSERT INTO city (city_name, description) VALUES (?, ?)");
  $city_insert_stmt->bind_param("ss", $city_name, $description);
  $city_insert_stmt->execute();
  
  $city_id = $dbc->insert_id; // get the last inserted ID
  
  $target_dir = "../../pic/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $filename = basename($target_file, "." . $imageFileType);
  
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $uploadOk = 0;
      echo"<script>alert('File is not an image.'); history.go(-1);</script>";
      exit();
  }
  
  // Check if file already exists
  if (file_exists($target_file)) {
      $uploadOk = 0;
      echo"<script>alert('Sorry, file already exists.'); history.go(-1);</script>";
      exit();
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      $uploadOk = 0;
      echo"<script>alert('Sorry, your file is too large.'); history.go(-1);</script>";
      exit();
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" ) {
      $uploadOk = 0;
      echo"<script>alert('Sorry, only JPG files are allowed.'); history.go(-1);</script>";
      exit();
  }
  
  if ($uploadOk == 0) {
      echo"<script>alert('Sorry, your file was not uploaded.'); history.go(-1);</script>";
      exit();
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $image_insert_stmt = $dbc->prepare("INSERT INTO pic (id,type_id, path) VALUES (?,?, ?)");
          $type_id = 'city';
          $image_insert_stmt->bind_param("iss", $city_id,$type_id, $filename);
          $image_insert_stmt->execute();
      } else {
          echo "<script>alert('Sorry, there was an error uploading your file.'); history.go(-1);</script>";
          exit();
      }
  }
  
  if ($city_insert_stmt->affected_rows > 0 && $image_insert_stmt->affected_rows > 0) {
      $dbc->commit(); // commit the transaction
      echo "<script>alert('Successfully inserted data.'); location.href = 'city.php';</script>";
      exit();
  } else {
      $dbc->rollback(); // rollback the transaction
      echo "<script>alert('Failed to insert data.'); history.go(-1);</script>";
      exit();
  }
  
  $city_insert_stmt->close();
  $image_insert_stmt->close();
  $dbc->close();
header("city.php");

?>