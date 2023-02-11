<?php
include('../database.php');
$id=$_GET['id'];
$dbc->query("delete from user where user_id=$id");
header('location:users.php');
?>