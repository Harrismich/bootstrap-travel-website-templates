<?php
include('../database.php');
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: login.php");
}
$id=$_GET['id'];
$dbc->query("delete from user where user_id=$id");
header('location:users.php');
?>