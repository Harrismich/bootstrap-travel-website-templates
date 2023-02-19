<?php if (!isset($_SESSION['logged_in_admin']) || !$_SESSION['logged_in_admin']) {
	header("Location: ../../login.php");
}
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
    <body>
        <h3> Welcome to the Admin Page!</h3>
    </body>
</html>
