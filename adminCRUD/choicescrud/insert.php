<?php
include('../database.php');
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: login.php");
}
 
$name=$_POST['name'];
$city= $_POST['city_id'];
$category=$_POST['category_id'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$link=$_POST['link'];
$map=$_POST['map'];
$description=$_POST['description'];
$dbc->query("insert into choice (name, address, phone_number ,link, map, category_id, city_id, description) 
values ('$name' , '$address' , '$phone' , '$link' , '$map' , '$category' , '$city', '$description')");
 
// $res = $dbc->query("select choice_id from choice order by choice_id desc");
// $row = $res->fetch_row();
// $id = $row[0];
 
// // Set a constant
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
 
// $result = move_uploaded_file($_FILES['pimage']['tmp_name'],FILEREPOSITORY.$filename);
// //$result = move_uploaded_file($_FILES['pimg']['tmp_name'],"http://localhost/php_crud/profile_images/28.jpg");
// if ($result == 1) echo "<p>File successfully uploaded.</p>";
// else echo "<p>There was a problem uploading the file.</p>";
// }
// }
// header('location:index.php');
?>