<?php
include('../database.php');
session_start();

if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}
$house_id=$_GET['id'];
$dbc->query("delete from house where choice_id=$house_id");
header('location:house.php');
?>