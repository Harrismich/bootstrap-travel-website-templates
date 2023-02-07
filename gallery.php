<?php 
require_once('database.php');
session_start();
// if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
// 	header("Location: login.php");
// }
// if(!isset($_SESSION['city'])){
//   header("Location: city.php");
// }
$userid=$_SESSION['user_id'];
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</head>

    <body>
    
<!-- ################# Header Starts Here#######################--->

<?php include('header.php');?>
 

    
    <!--  ************************* Page Title Starts Here ************************** -->
    <div class="page-nav no-margin row">
        <div class="container">
            <div class="row">
                <h2>Our Gallery</h2>
                <ul>
                    <li> <a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><i class="fas fa-angle-double-right"></i> Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!--  ************************* Gallery Starts Here ************************** -->
<div id="portfolio" class="gallery">    
    <div class="container">              
        <div class="row">
            <div class="gallery-filter d-none d-sm-block">
                <button class="btn btn-default filter-button" data-filter="all"> All </button>
                <button class="btn btn-default filter-button" data-filter="1"> Ξενοδοχεία </button>
                <button class="btn btn-default filter-button" data-filter="2"> Ξενώνες </button>
                <button class="btn btn-default filter-button" data-filter="3"> Λέσχες </button>
                <button class="btn btn-default filter-button" data-filter="4"> Εστιατόρια </button>
                <button class="btn btn-default filter-button" data-filter="5"> Νοσοκομεία </button>
            </div>
            <br/>

 <!--  ************************* Review Submit ************************** -->
 <div class="account-form">

<form action="" method="post" id ="confirmationform" name ="confirmationform">
  <h3>post your review</h3>
  <p class="placeholder">review title <span>*</span></p>
  <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box1">
  <p class="placeholder">review description</p>
  <textarea name="description" class="box1" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
  <p class="placeholder">review rating <span>*</span></p>
  <center>
  <div class="star-widget">
    <input type="hidden" name="rate" id="selected-rate" form="confirmationform">
    <input type="radio" name="star" id="rate-5" value=5 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-5" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-4" value=4 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-4" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-3" value=3 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-3" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-2" value=2 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-2" class="fas fa-star"></label>
    <input type="radio" name="star" id="rate-1" value=1 onclick="document.getElementById('selected-rate').value = this.value;">
    <label for="rate-1" class="fas fa-star"></label>
  </div> 
  </center> 
   <input type="submit" value="submit review" name="submit" class="btn1">
   <a href="view_post.php?get_id=<?= $get_id; ?>" class="option-btn1">go back</a>
</form>
</div>
            <?php
                $city = $_SESSION['city_id'];
                $filterValue = "all";
                if (isset($_GET["filter"])) {
                    $filterValue = $_GET["filter"];
                }
                $query = "SELECT * FROM pictures p inner join choice ch on p.choice_id=ch.choice_id where ch.city_id = '$city' ";
                if ($filterValue == "all") {
                    $query = "SELECT * FROM pictures p inner join choice ch on p.choice_id=ch.choice_id where ch.city_id = '$city' ";
                }else if($filterValue == "1"){
                    $query .= "AND category_id = '$filterValue' " ;
                }else if($filterValue == "2"){
                    $query .= " AND category_id = '$filterValue'  ";
                }else if($filterValue == "3"){
                    $query .= " AND category_id = '$filterValue' ";
                }else if($filterValue == "4"){
                    $query .= " AND category_id = '$filterValue' ";
                }else if($filterValue == "5"){
                    $query .= " AND category_id = '$filterValue' ";
                }
                $result = mysqli_query($dbc, $query);
                echo'<div class="container">';        
                    echo'<div class="box-container">';
                        while ($data = mysqli_fetch_assoc($result)) {   
                            echo' <div class="box">';
                                echo' <div class="image">';
                                echo "<img src='./pictures/" . $data['path'] . ".jpg' class='d-block w-100' />";
                                echo'</div>';
                                echo' <div class="content">';
                                    echo "<h3>". $data['name'] . " </h4> ";
                                    echo "<br>";
                                    echo "<h6><strong> Διεύθυνση: </strong>" .$data['address'] ."</h6>";
                                    echo "<h6><strong> Τηλέφωνα: </strong>" .$data['phone_number'] ."</h6>";
                                    echo "<h6> <a href = " .$data['link'] . "><strong>Link:</strong> Επισκευθείτε μας </a></h6>";
                                    echo '<button class="btn"><a href= '. $data['map'] .'> google map </a></button>';
                                    echo '<div class="icons">';
                                    echo '<button input type="hidden" class="makereview" value = "'.$data["choice_id"].'"><span> <i class="fas fa-star" "></i> Make Review 
                                            </span></button>';
                                    echo '</div>';
                                echo' </div>';
                            echo'</div>';
                        }
                    echo'</div>';
                    if(mysqli_num_rows($result) >3){
                    echo'<div id="load-more"> load more </div>';
                    };
                echo'</div>';
            ?>    
            <!-- This script is used to show/load more items in a webpage by clicking a button with the id "load-more". 
            The script initializes the variable currentItem to 3, meaning it displays the first three items. 
            When the load more button is clicked, the script retrieves all elements with the class .box and adds them to the array boxes. 
            The script then loops through the next three items and sets their display style to 'inline-block' to show them.
            The currentItem value is then updated by adding 3 to its current value. 
            Finally, if currentItem becomes equal to or greater than the length of the boxes array, 
            the load more button is hidden by setting its display style to 'none'.              -->
            <script>
            let loadMoreBtn = document.querySelector('#load-more');
            let currentItem = 3;
            loadMoreBtn.onclick = () =>{
            let boxes = [...document.querySelectorAll('.container .box-container .box')];
            for (var i = currentItem; i < currentItem + 3; i++){
            boxes[i].style.display = 'inline-block';
            }
            currentItem += 3;

            if(currentItem >= boxes.length){
            loadMoreBtn.style.display = 'none';
            }
            }
            </script>



            <script>
            const filterButtons = document.querySelectorAll('.filter-button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                location.href = 'gallery.php?filter=' + filterValue;
                });
            });
            </script>
            <script src="app.js"></script>    
        </div>
    </div>  
</div>
        <!-- ######## Gallery End ####### -->    

        
        

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
    
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    </body>

    
</html>
