<?php
require_once('..\database.php');
session_start();
?>
<!DOCTYPE html>

<html>
<head>

<title>PHP/MySQLi CRUD Operation using Bootstrap/Modal</title>
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<link href="css/fonts.css" rel="stylesheet">

<script>
$(document).ready(function(){
$('#empTable').dataTable();
$('.file-upload').file_upload();
});
</script>
<?php include('header.php');?>
</head>

<body style="margin:20px auto">
<center>
<h2><span style="font-size:25px; color:blue">
Admin DashBoard</span>
</h2></center>

<div class="container">
<br/><br/>
<div class="row header col-sm-12" style="text-align:center;color:green">
<span class="pull-left">
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm">
<span class="glyphicon glyphicon-plus"></span> Add New
</a></span>

<div style="height:50px;"></div>
<table class="table table-striped table-bordered table-responsive table-hover" 
id="empTable" >
<thead>
    <th><center>Picture</center></th>
    <th><center>City</center></th>
    <th><center>Description</center></th>
    <th><center>Action</center></th>
    <!-- <th><center>Action</center></th> -->
</thead>
<tbody>
<?php

$choices= "select * from city c inner join image i on c.city_id = i.city_id group by c.city_id";
$result = mysqli_query($dbc, $choices);
while($row=$result->fetch_assoc()){
?>
<tr>
    <td><?php  echo '<img src="../../images/' . $row['path'] . '.jpg" height="50px" width="70px"/>'; ?></td>
    <td><?php echo $row['city_name']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td>
        <a href="#detail<?php echo $row['city_id']; ?>" 
        data-toggle="modal" class="btn btn-success btn-sm">
        <span class="glyphicon glyphicon-floppy-open">
        </span>Detail</a> <br><br>

        <a href="#edit<?php echo $row['city_id']; ?>" 
        data-toggle="modal" class="btn btn-warning btn-sm">
        <span class="glyphicon glyphicon-pencil">
        </span> Edit</a><br><br>

        <a href="#del<?php echo $row['city_id']; ?>" 
        data-toggle="modal" class="btn btn-danger btn-sm">
        <span class="glyphicon glyphicon-remove">
        </span> Delete</a><br>
        </td>
        <!-- include edit modal -->
        <?php include('show_detail_modal.php'); ?>
        <!-- End -->
          <!-- include edit modal -->
          <?php include('show_edit_modal.php'); ?>
        <!-- End -->
        <!-- include delete modal -->
        <?php include('show_delete_modal.php'); ?>
        <!-- End -->
        </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
        <!-- include insert modal -->
        <?php include('show_add_modal.php'); ?>
        <!-- End -->
</div>
</body>
</html>