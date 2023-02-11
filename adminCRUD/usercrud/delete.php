<?php
include('../database.php');
$user_id=$_GET['id'];
$dbc->query("delete from user where user_id=$user_id");
header('location:users.php');
?>