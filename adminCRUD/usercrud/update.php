<?php
include('../database.php');
$id=$_GET['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_name=$_POST['user_name'];
$email=$_POST['email'];
 
$dbc->query("update user set first_name='$first_name', last_name='$last_name', 
username='$user_name', email='$email' where user_id=$id");
 
header('location:users.php');
 
?>