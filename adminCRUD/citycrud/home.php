<?php
if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}?>
<!DOCTYPE html>

<html>
<head>

<title>PHP/MySQLi CRUD Operation using Bootstrap/Modal</title>
<script src="../citycrud/js/jquery.min.js"></script>
        <link rel="stylesheet" href="../citycrud/css/bootstrap.min.css" />
        <script src="../citycrud/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../citycrud/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="../citycrud/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../citycrud/js/bootstrap-filestyle.min.js"> </script>
        <link href="../citycrud/css/fonts.css" rel="stylesheet">
        <script type="text/javascript" src="../citycrud/js/js.js"></script>
<script>

$(document).ready(function(){
$('#empTable').dataTable();
$('.file-upload').file_upload();
});

</script>
<?php include('header.php');?>

</head>
<body>

<h3> Welcome to the Admin Page!</h3>
</body>
</html>
