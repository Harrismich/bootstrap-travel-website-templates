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
                <h2>Contact Us</h2>
                <ul>
                    <li> <a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><i class="fas fa-angle-double-right"></i> Contact US</li>
                </ul>
            </div>
        </div>
    </div>
    
    
    
      <!--  ************************* Contact Us Starts Here ************************** -->
    <div style="margin-top:0px;" class="row no-margin">
    <iframe src="https://maps.google.com/maps?q=37.9838,23.7275&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>



    </div>
<form action="house.php" method="post">
    <div class="row contact-rooo no-margin">
        <div class="container">
            <div class="row">

                    <div style="padding:20px" class="col-sm-7">
                        <h2 >Διαθέσιμο Σπίτι</h2> <br>
                        <div  class="row cont-row">
                            <div  class="col-sm-3"><label>Όνομα Ιδιοκτήτη </label><span>:</span></div>
                            <div class="col-sm-8"><input type="text" name="name" placeholder="Πληκτρολογίστε την Διεύθυνση" class="form-control input-sm" required ></div>
                        </div>
                        <div class="row cont-row">
                            <div class="col-sm-3">
                                <label>Πόλη</label><span>:</span>
                            </div>
                        <div class="col-sm-8">
                            <select name="city" class="form-control input-sm">
                            <option value="" disabled selected>Επιλέξτε Πόλη</option>
                            <?php
                                $sql= "select * from city group by city_id ";
                                $city_res = mysqli_query($dbc, $sql);
                                while($crow=$city_res->fetch_assoc()){
                                echo "<option name='city' value='".$crow['city_id']."' >" . $crow['city_name'] ." </option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Διεύθυνση </label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="address" placeholder="Πληκτρολογίστε την Διεύθυνση" class="form-control input-sm" required ></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Κινητό</label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="phone_number" placeholder="Πληκτρολογίστε το Κινητό" class="form-control input-sm"  required></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Διαθέσιμο από</label><span>:</span></div>
                        <div class="col-sm-8"><input type="date" name="	availability" placeholder="Διαθέσιμο από" class="form-control input-sm"  required></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Τιμή</label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="price" placeholder="Πληκτρολογήστε την Τιμή" class="form-control input-sm" required ></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Περιγραφή</label><span>:</span></div>
                        <div class="col-sm-8">
                            <textarea rows="5" name ='description' placeholder="Enter Your Message" class="form-control input-sm"required></textarea>
                        </div>
                    </div>
                    <div style="margin-top:10px;" class="row">
                        <div style="padding-top:10px;" class="col-sm-3"><label></label></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm">Αποστολή</button>
                        </div>
                    </div>
                
                </div>
                <div class="col-sm-5">

                    <div style="margin:50px" class="serv">
<!-- 
                        <h2 style="margin-top:10px;">Address</h2>
                       Antonya Street, <br>
                        23/H-2, Building<br>
                        TA, AUS District<br>
                        Phone:+91 9159669599<br>
                        Email:support@smarteyeapps.com<br>
                        Website:www.smarteyeapps.com.com<br>
 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

       

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
