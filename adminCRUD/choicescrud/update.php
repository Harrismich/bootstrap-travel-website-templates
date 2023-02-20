<?php
include('../database.php');
session_start();
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}

$id=$_GET['id'];
$name=$_POST['name'];
$city=$_POST['city'];
$category=$_POST['category'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$link=$_POST['link'];
$map=$_POST['map'];
$description = $_POST['description'];

$name = mysqli_real_escape_string($dbc, $name);
$address = mysqli_real_escape_string($dbc, $address);
$phone = mysqli_real_escape_string($dbc, $phone);
$link = mysqli_real_escape_string($dbc, $link);
$map = mysqli_real_escape_string($dbc, $map);
$category = mysqli_real_escape_string($dbc, $category);
$city = mysqli_real_escape_string($dbc, $city);
$description = mysqli_real_escape_string($dbc, $description);

$sql = "UPDATE choice SET name='$name', address='$address', phone_number='$phone', link='$link', map='$map', category_id='$category', city_id ='$city', description = '$description' WHERE choice_id=$id";

$result = $dbc->query($sql);


$target_dir = "../../pic/"; // specify the directory where you want to store the uploaded files
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
		exit();
    }
}
// Check if file already exists
if($imageFileType != null){
	if (file_exists($target_file)) {
		echo"<script>alert('Sorry, file already exists.'); history.go(-1);</script>";
		$uploadOk = 0;
		exit();
	}
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo"<script>alert('Sorry, your file is too large.'); history.go(-1);</script>";
	$uploadOk = 0;
	exit();
}
if($imageFileType != null){
// Allow certain file formats
if($imageFileType != "jpg" ) {
	echo"<script>alert('Sorry, only JPG files are allowed.'); history.go(-1);</script>";
	$uploadOk = 0;
	exit();
	}
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo"<script>alert('Sorry, your file was not uploaded.'); history.go(-1);</script>";
	// if everything is ok, try to upload file
} else {
	if($imageFileType != null){
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$sql = "INSERT INTO pic (id,type_id, path) VALUES (?,?,?)";
			$type_id = 'choice';
			$stmt = $dbc->prepare($sql);
			$stmt->bind_param("iss", $id, $type_id, $filename);
			$stmt->execute();
			echo "<script>alert('Successfully update data.'); location.href = 'choice.php';</script>";
			exit();  
		}else {
			echo "<script>alert('Failed to update data.'); history.go(-1);</script>";
			exit();
		}
	}else{
		echo "<script>alert('Successfully update data.'); location.href = 'choice.php';</script>";
		exit();
	}
}



header('location:choice.php');

?>