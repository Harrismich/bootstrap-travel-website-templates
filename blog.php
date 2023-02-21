<?php 
require_once('database.php');
session_start();

// if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
// 	header("Location: login.php");
// }
// if(!isset($_SESSION['city'])){
//   header("Location: city.php");
// }
$user_id=$_SESSION['user_id'];


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart City</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- ################# Header Starts Here#######################--->

<?php include('header.php');?>

    
    <!--  ************************* Page Title Starts Here ************************** -->

<div class="review container-fluid">
  <div class="container1">
    <div class="session-title">
      <h2>What people say about Us</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
        sollicitudin nisi id consequat bibendum. Phasellus at convallis
        elit. In purus enim, scelerisque id arcu vitae
      </p>
    </div>
    <div class="row review-row">
      <?php
        // Retrieve the data from the database
        $query = "SELECT username, title, comment, rate , date
        FROM reviews r INNER JOIN user u on r.user_id=u.user_id ";
        $result = mysqli_query($dbc, $query);

        // Loop through the data and generate the table rows
        while($row = mysqli_fetch_array($result)) {
      ?>
        <div class="col-md-6">
          <div class="review-col">
            <div class="profil">
              <!-- <img src="assets/images/testimonial/member-01.jpg" alt="" /> -->
            </div>
            <div class="review-detail">
                <span> <h6><?php $date = date_create($row['date']);
                                echo sprintf("O/H %s έγραψε την %s", 
                                $row["username"], date_format($date,"d-m-Y")); ?></h6></span>
                <h4><?php echo $row['title']; ?></h4>
                <p><?php echo $row['comment']; ?></p>
              
              <ul class="rat" style="margin: bottom 20px";>
                <?php
                  for($i = 0; $i < $row['rate']; $i++) {
                    echo '<li><i class="fa fa-star"></i></li>';
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      <?php
        }//while loop
        // Close the connection to the database
        mysqli_close($dbc);
      ?>
    </div>
  </div>
</div>

    <!--<div class="container-fluid blog">
        <div class="container">
             
                <div class="blog-row row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d1.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                     <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d2.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                     <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d3.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d4.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d2.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="blog-col">
                            <img src="assets/images/destination/d1.jpg" alt="">
                            <span>August 9, 2019</span>
                            <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent accumsan, leo in venenatis dictum, </p>
                       </div>
                       
                    </div>
                     
            </div>
        </div>
        
    </div>  -->
       

  <!--  ************************* Footer Start Here ************************** -->
       
  <?php include('footer.php');?>  
  
    <div class="copy">
            <div class="container">
                <a href="https://www.smarteyeapps.com/">2019 &copy; All Rights Reserved | Designed and Developed by Smarteyeapps</a>
                <span>
                <a><i class="fab fa-github"></i></a>
                <a><i class="fab fa-google-plus-g"></i></a>
                <a><i class="fab fa-pinterest-p"></i></a>
                <a><i class="fab fa-twitter"></i></a>
                <a><i class="fab fa-facebook-f"></i></a>
                </span>
            </div>

    </div> 
    
</body>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
</html>
