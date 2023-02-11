<?php
include('../database.php');
$city_name=$_POST['city_name'];
$description=$_POST['description'];
$dbc->query("insert into city (city_name, description) 
values ('$city_name', '$description')");
 
$res = $dbc->query("select city_id from city order by city_id desc");
$row = $res->fetch_row();
$city_id = $row[0];
 
// Set a constant for the file repository
define("FILEREPOSITORY", "http://localhost/project%20php/bootstrap-travel-website-templates/images/");

// Make sure that the file was POSTed
if (isset($_POST["submit"])) {
  $target_dir = "../images/";
  $target_file = $target_dir . $city_name . $city_id . ".jpg";
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["pimage"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["pimage"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow only JPG format
  if ($imageFileType != "jpg") {
    echo "Sorry, only JPG files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["pimage"]["tmp_name"], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES["pimage"]["name"])) . " has been uploaded.";
      $dbc->query("insert into image (city_id, path) values ('$city_id', '$target_file')");
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
header('location:city.php');
?>