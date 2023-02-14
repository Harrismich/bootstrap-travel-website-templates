<?php
include('../database.php');

$city_id = $_GET['id'];
$city_name=$_POST['name'];
$description=$_POST['description'];
 
$dbc->query("update city set city_name='$city_name', description='$description' where city_id=$city_id");
 
 
$target_dir = "../../images/"; // specify the directory where you want to store the uploaded files
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // get the path of the uploaded file
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$filename = basename($target_file, "." . $imageFileType);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
	echo"<script>alert('File is not an image.'); history.go(-1);</script>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
	echo"<script>alert('Sorry, file already exists.'); history.go(-1);</script>";
	$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo"<script>alert('Sorry, your file is too large.'); history.go(-1);</script>";
	$uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" ) {
	echo"<script>alert('Sorry, only JPG files are allowed.'); history.go(-1);</script>";
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo"<script>alert('Sorry, your file was not uploaded.'); history.go(-1);</script>";
	// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	$sql = "INSERT INTO image ( city_id , path) VALUES (?,?)";
	$stmt = $dbc->prepare($sql);
	$stmt->bind_param("is", $city_id , $filename);
	$stmt->execute();
	echo "<script>alert('Successfully inserted data.'); location.href = 'city.php';</script>";
  } else {
	echo "<script>alert('Failed to insert data.'); history.go(-1);</script>";
}
}
?>