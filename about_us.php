
<?php 

require_once('database.php');
session_start();
// if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
// 	header("Location: login.php");
// }
// if(!isset($_SESSION['city'])){
//   header("Location: city.php");
// }

$name = urldecode($_GET['name']); ?>



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
                <?php $query ="SELECT * FROM choice ch inner join pictures p on p.choice_id = ch.choice_id where ch.choice_id = '$name'" ;
                        $result = mysqli_query($dbc, $query);
                        $data = mysqli_fetch_assoc($result)
                ?>
                <h2><?php echo $data['name']  ?></h2>
                <ul>
                    <li> <a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><i class="fas fa-angle-double-right"></i> About Us</li>
                </ul>
            </div>
        </div>
    </div>
        <div class="about-us container-fluid">
    <div class="container">

        <div class="row natur-row no-margin w-100">
            <div class="text-part col-md-6">
                <h2><?php echo $data['name']  ?></h2>
                <p><?php echo $data['description']  ?></p>
            </div>
            <div class="image-part col-md-6">
            <?php echo "<img src='./pictures/" . $data['path'] . ".jpg' class='d-block w-100' />";?>
            </div>
        </div>
    </div>
    </div>
   
    
             <!--  *************************Our Team Start Here ************************** -->
        
        <div class="our-team">
           <div class="container">
       
                 <div class="row session-title">
                    <h2>Οι Κριτικές μας</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sollicitudin nisi id consequat bibendum. Phasellus at convallis elit. In purus enim, scelerisque id arcu vitae</p>
                 </div>  
                    <?php $query= "SELECT * FROM criticals where choice_id= 1 ";
                            $result = mysqli_query($dbc, $query);

                            $counter = 0;
                            while ($d = mysqli_fetch_assoc($result)) {
                              if ($counter % 4 == 0) {
                                echo '<div class="row">';
                              }
                            ?>
                              <div class="col-md-3 col-sm-6">
                                <div class="card-1 team-member">
                                  <img src="assets/images/team/team-1.jpg" alt="Team Member 1">
                                  <p> <?php echo $d['comment'];?> (CEO & Chairman)</p>
                                </div>
                              </div>  
                            <?php 
                              $counter++;
                              if ($counter % 4 == 0) {
                                echo '</div> <br>';
                              }
                            } 
                            if ($counter % 4 != 0) {
                              echo '</div>';
                            }
                          ?>
                          
                          
                          
            </div>
        </div>
        
  <!-- ######## Our Team End ####### -->  

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
