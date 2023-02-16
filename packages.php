<?php
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
$user_id = $_SESSION['user_id'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Travelet Free Website Tempalte | Smarteyeapps.com</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

    <body>
    
                                            <!-- ################# Header Starts Here#######################--->
<?php include('header.php');?>
    
                                <!--  ************************* Page Title Starts Here ************************** -->
    <div class="page-nav no-margin row">
        <div class="container">
            <div class="row">
                <h2>Chooce a City</h2>
            </div>
        </div>
    </div>
                                            <!-- ################# Chooce city #######################--->   
    <?php $query = " SELECT c.city_id, city_name , path, description FROM image i inner join city c ON c.city_id = i.city_id GROUP BY c.city_id ORDER BY city_name ";
        $result = mysqli_query($dbc, $query);
        while ($data = mysqli_fetch_assoc($result)){ 
    ?>  
    <div class="popular-pack  container-fluid">
        <div class="container">
            <div class="row pack-row style='flex-direction:row; '">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="pack-col">
                        <?php
                            echo "<a href='index.php?city_id=" . $data['city_id'] . "'> <img src='./images/" . $data['path'] . ".jpg' class='d-block w-100' />";
                            echo '<div class="detail row no-margin">';
                            echo "<h4>". $data['city_name'] . " </h4> ";
                            echo'</div></a>';
                        ?>
                        <div class="options row no-margin">
                        </div>
                    </div>
                </div>    
                <?php  echo "<div style= 'overflow-wrap:break-words; width: 700px;'> <p >". $data['description'] . " </p> </div>";?>
            </div>
        </div>
    </div>
    <?php }?> 

  <!--  ************************* Footer Start Here ************************** -->
<?php include('footer.php');?>  
    <div class="copy">
            <div class="container">
                <a href="https://www.smarteyeapps.com/">2019 &copy; All Rights Reserved | Designed and Developed by Smarteyeapps</a>
            </div>
        </div> 
    </body>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
</html
