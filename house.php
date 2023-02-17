<?php
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
// $city_id = $_SESSION['city_id'];
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];
    $ch_date = $_POST['availability'];

    $dbc->autocommit(FALSE); // disable auto-commit

    // Insert the data into the `choice` table
    $choice_insert_stmt = $dbc->prepare("INSERT INTO choice (name, address, phone_number, category_id, city_id, description) VALUES (?, ?, ?, 8, ?, ?)"); 
    $choice_insert_stmt->bind_param("sssis", $name, $address, $phone_number, $city, $description);
    $choice_insert_stmt->execute();

    $choice_id = $dbc->insert_id; // get the last inserted ID

    $house_insert_stmt = $dbc->prepare("INSERT INTO house (choice_id, user_id, ch_date, activation) VALUES (?, ?, ?, 'not active')");
    $house_insert_stmt->bind_param("iis", $choice_id, $user_id, $ch_date);
    $house_insert_stmt->execute();

    $dir = getcwd();
    $target_dir = $dir . "/pictures/"; 
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
        $dir = getcwd();
        echo"<script>alert('Sorry, file already exists.');history.go(-1); </script>";
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
            $image_insert_stmt = $dbc->prepare("INSERT INTO pic (id, type_id, path) VALUES (?, ?, ?)");
            $type_id = "choice";
            $image_insert_stmt->bind_param("iss", $choice_id, $type_id, $filename);
            $image_insert_stmt->execute();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); </script>";
            exit();
        }
    }
    
}
    if ($choice_insert_stmt->affected_rows > 0 && $house_insert_stmt->affected_rows > 0 && $image_insert_stmt->affected_rows > 0) {
        $dbc->commit(); // commit the transaction
        echo "<script>alert('Successfully inserted data.'); location.href = 'contact_us.php';</script>";
        exit();
    } else {
        $dbc->rollback(); // rollback the transaction
        echo "<script>alert('Failed to insert data.'); history.go(-1);</script>";
        exit();
    }
    
    $choice_insert_stmt->close();
    $house_insert_stmt->close();
    $image_insert_stmt->close();
    $dbc->close();
    // header('Location: contact_us.php');

?>

