<?php
include('../database.php');
session_start();
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}
$choice_id=$_GET['id'];
$dbc->query("delete from choice where choice_id=$choice_id");
header('location:choice.php');
?>