<?php
include('../database.php');
$choice_id=$_GET['id'];
$dbc->query("delete from choice where choice_id=$choice_id");
header('location:index.php');
?>