<?php
include('../database.php');
$city_id=$_GET['id'];
$dbc->query("delete from city where city_id = $city_id ;");
unlink("profile_images/".$id.".jpg");
header('location:city.php');
?>