<?php
include('../database.php');
$id=$_GET['id'];
$name=$_POST['name'];
$city=$_POST['city'];
$category=$_POST['category'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$link=$_POST['link'];
$map=$_POST['map'];
$description = $_POST['description'];

 
$dbc->query("update choice set name='$name', address='$address', 
phone_number='$phone', link='$link', map='$map', category_id='$category', city_id ='$city', description = '$description' where choice_id=$id");
 
 
// Set a constant
// define ("FILEREPOSITORY","profile_images/");
 
// // Make sure that the file was POSTed.
// if (is_uploaded_file($_FILES['pimage']['tmp_name']))
// {
// // Was the file a JPEG?
// if ($_FILES['pimage']['type'] != "image/jpeg") {
// echo "<p>Profile image must be uploaded in JPEG format.</p>";
// } else {
 
// //$name = $_FILES['classnotes']['name'];
// $filename=$id.".jpg";
 
// unlink(FILEREPOSITORY.$filename);
// $result = move_uploaded_file($_FILES['pimage']['tmp_name'],
// FILEREPOSITORY.$filename);
// //$result = move_uploaded_file($_FILES['pimg']['tmp_name'],"http://localhost/php_crud/profile_images/28.jpg");
// if ($result == 1) echo "<p>File successfully uploaded.</p>";
// else echo "<p>There was a problem uploading the file.</p>";
// }
// }
 
header('location:users.php');
 
?>