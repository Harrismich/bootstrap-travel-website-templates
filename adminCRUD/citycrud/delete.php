<?php
include('../database.php');
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: login.php");
}
$city_id=$_GET['id'];
$dbc->query("delete from city where city_id = $city_id ;");
unlink("profile_images/".$id.".jpg");
header('location:city.php');
?>