<?php
include('../database.php');
session_start();
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}
$name=$_POST['name'];
$city= $_POST['city_id'];
$category=$_POST['category_id'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$link=$_POST['link'];
$map=$_POST['map'];
$description=$_POST['description'];

$dbc->autocommit(FALSE); // disable auto-commit

$check_choice_stmt = $dbc->prepare("SELECT * FROM choice WHERE name = ?");
$check_choice_stmt->bind_param("s", $name);
$check_choice_stmt->execute();
$check_choice_result = $check_choice_stmt->get_result();

if ($check_choice_result->num_rows > 0) {
    // If the city already exists, display an error message and go back to the previous page
    echo "<script>alert('The choice already exists in the database.'); history.go(-1);</script>";
    exit();
}

$choice_insert_stmt = $dbc->prepare("INSERT INTO choice (name, address, phone_number ,link, map, category_id, city_id, description) VALUES (?, ?, ?, ?, ?, ?, ?, ? )");
$choice_insert_stmt->bind_param("ssissiis", $name, $address, $phone , $link , $map , $category , $city, $description);
$choice_insert_stmt->execute();

$choice_id = $dbc->insert_id; // get the last choice inserted ID

$target_dir = "../../pictures/";
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
if ($_FILES["fileToUpload"]["size"] > 1400000) {
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
        $picture_insert_stmt = $dbc->prepare("INSERT INTO pic (id, type_id , path) VALUES ( ?, ?, ?)");
        $type_id = 'choice';
        $picture_insert_stmt->bind_param("iss", $choice_id, $type_id, $filename);
        $picture_insert_stmt->execute();
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.'); history.go(-1);</script>";
        exit();
    }
}

if ($choice_insert_stmt->affected_rows > 0 && $picture_insert_stmt->affected_rows > 0) {
    $dbc->commit(); // commit the transaction
    echo "<script>alert('Successfully inserted data.'); location.href = 'choice.php';</script>";
    exit();
} else {
    $dbc->rollback(); // rollback the transaction
    echo "<script>alert('Failed to insert data.'); history.go(-1);</script>";
    exit();
}

$choice_insert_stmt->close();
$picture_insert_stmt->close();
$dbc->close();

header("choice.php");



?>