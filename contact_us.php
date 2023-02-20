<?php 
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
$city_id = $_SESSION['city_id'];
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
                <h2>Available Houses</h2>
                <ul>
                    <?php if(isset($_SESSION['city_id'])){ ?>
                    <li> <a href="index.php?city_id=<?php echo $_SESSION['city_id'];?>"><i class="fas fa-home"></i> Home</a></li>
                    <?php }else{ ?>
                        <li> <a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <?php } ?>
                    <li><i class="fas fa-angle-double-right"></i> Available Houses</li>
                </ul>
            </div>
        </div>
    </div>
    

      <!--  ************************* Contact Us Starts Here ************************** -->

    <!-- <div style="margin-top:0px;" class="row no-margin">
        <iframe src="https://maps.google.com/maps?q=37.9838,23.7275&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div> -->

<form action="house.php" method="post" enctype="multipart/form-data" >
    <div class="row contact-rooo no-margin">
        <div class="container">
            <div class="row">
                <div style="padding:20px" class="col-sm-9 mx-auto">
                    <h2>Please complete the form.</h2> <br>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label> Owner's Name </label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="name" placeholder="Enter owner's name" class="form-control input-sm" required ></div>
                    </div>
                    <div class="row cont-row">
                        <div class="col-sm-3">
                            <label>City</label><span>:</span>
                        </div>
                        <div class="col-sm-8">
                            <select name="city" class="form-control input-sm">
                            <option value="" disabled selected>Choose city</option>
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
                        <div  class="col-sm-3"><label>Address </label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="address" placeholder="Enter the address" class="form-control input-sm" required ></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Phone</label><span>:</span></div>
                        <div class="col-sm-8"><input type="text" name="phone_number" placeholder="Enter owner's phone phone numer" class="form-control input-sm"  required maxlength="10"></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Available From</label><span>:</span></div>
                        <div class="col-sm-8"><input type="date" name="availability" placeholder="Διαθέσιμο από" class="form-control input-sm"  required></div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>Description</label><span>:</span></div>
                        <div class="col-sm-8"><textarea rows="5" name ='description' placeholder="Enter some information fo the house e.g (price, floor, parking area)" class="form-control input-sm"required></textarea>
                        </div>
                    </div>
                    <div  class="row cont-row">
                        <div  class="col-sm-3"><label>House Image</label><span>:</span></div>
                        <div class="col-sm-8"><input type="file" name="fileToUpload" id="fileToUpload" ></div>
                    </div>
                    <div style="margin-top:10px;" class="row">
                        <div class="col-sm-3"><label></label></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-lg " type="submit" name="submit">Post the Form</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

       

  <!--  ********************** Footer Start Here ********************** -->
       
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
