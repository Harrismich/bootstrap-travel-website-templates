<?php 
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
if(isset($_SESSION['city_id'])){
$city_id = $_SESSION['city_id'];
}
$user_id = $_SESSION["user_id"];
?>

<!doctype html>
<html lang="en">

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Travelet Free Website Tempalte | Smarteyeapps.com</title>

    <style>
    .heart{
    padding-left: 30%;
    cursor: pointer;
}

.not-in-favorites {
    color: grey;
}

.in-favorites{
    color: red;
}
</style>
</head>

    <body>
    
<!-- ################# Header Starts Here#######################--->

<?php include('header.php');?>

    
    <!--  ************************* Page Title Starts Here ************************** -->
    <div class="page-nav no-margin row">
        <div class="container">
            <div class="row">
                <h2></h2>
                <ul>
                    <?php if(isset($_SESSION['city_id'])){ ?>
                    <li> <a href="index.php?city_id=<?php echo $_SESSION['city_id'];?>"><i class="fas fa-home"></i> Home</a></li>
                    <?php }else{ ?>
                        <li> <a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <?php } ?>
                    <li><i class="fas fa-angle-double-right"></i> <span id="heart-' . $data['choice_id'] . '" class="fas fa-heart" style="color:red;"></span> Favorites </li>
                </ul>
            </div>
        </div>
    </div>
    
    
     <!--*************** Blog Starts Here ***************-->

    <?php
                
                $favorites = "SELECT * FROM user_choice uc right join choice c on uc.choice_id = c.choice_id inner join pic on c.choice_id = id where user_id = '$user_id' group by id  ";
                //$query = "SELECT * FROM pictures p inner join choice ch on p.choice_id=ch.choice_id where ch.city_id = '$city' ";
                $result = mysqli_query($dbc, $favorites);
                echo'<div class="container">';        
                    echo'<div class="box-container">';
                        while ($data = mysqli_fetch_assoc($result)) {   
                            echo' <div class="box">';
                                echo' <div class="image">';
                                    echo "<img src='./pictures/" . $data['path'] . ".jpg' class='d-block w-100' />";
                                echo' </div>';
                                echo' <div class="content">';
                                    echo "<h3>". $data['name'] . " </h4> ";
                                    echo"<br>";
                                    echo "<h6><strong> Διεύθυνση: </strong>" .$data['address'] ."</h6>";
                                    echo "<h6><strong> Τηλέφωνα: </strong>" .$data['phone_number'] ."</h6>";
                                    echo "<h6> <a href = " .$data['link'] . "><strong>Link:</strong> Επισκευθείτε μας </a></h6>";
                                    echo '<button class="btn" onclick="window.location.href=\'about_us.php?name=' . urlencode($data['choice_id']) . '\'">Read More</button>';
                                    echo '<div class="icons">';
                                    echo '<input type="hidden" class="choice_id" value="'. $data['choice_id'] . '">';
                                        echo '<a href="#" class="favorites-btn">';
                                        if($data['choice_id'] >= 1){
                                            echo' <i class="fa fa-heart heart in-favorites"></i>';
                                        }else{
                                            echo' <i class="fa fa-heart heart not-in-favorites"></i>';
                                        }
                                        echo '</a>  ';
                                        ?>
                                        <!-- <?php if($_SESSION['logged_in_user']){?><button onclick="myFunction()"><span> <i class="fas fa-star"></i> Make Review </span></button><?php } ?>
                                        <script>
                                        function myFunction() {
                                        var myWindow = window.open("ytcritics.php", "Κριτικές", "width=600,height=600");
                                        }
                                        </script> -->
                                        <?php //echo'<a href="index.php"> <span> <i class="fas fa-star"></i> Make Review </span></a>';
                                    echo' </div>';
                                echo' </div>';
                            echo'</div>';
                                }
                    echo'</div>';
                    if(mysqli_num_rows($result) >3){
                        echo'<div id="load-more"> load more </div>';
                    };
                echo'</div>';
                ?>  

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                
                <script>
                    $(document).ready(function() {
                    $(".favorites-btn").click(function() {
                        
                        var heart = $(this).find(".heart");
                        var choice_id = $(this).closest('.icons').find('.choice_id').val();
                        console.log("choice_id:", choice_id);
                        if (heart.hasClass("not-in-favorites")) {
                            heart.removeClass("not-in-mfavorites");
                            heart.addClass("in-favorites");
                            $.ajax({
                                type: "POST",
                                url: "addToFavorites.php",
                                data: { action: "add", choice_id: choice_id},
                                success: function(response) {
                                console.log(response);
                                }
                            });
                        } else {
                            heart.removeClass("in-favorites");
                            heart.addClass("not-in-favorites");
                            $.ajax({
                                type: "POST",
                                url: "addToFavorites.php",
                                data: { action: "delete", choice_id: choice_id},
                                success: function(response) {
                                console.log(response);
                                }
                            });
                        }
                    });
                    });
                </script>


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

            <!--Περνάει μέσω url το filtervalue ωστε να περάσει από τα if $filtervalue για να του εμφανίσει π.χ ξενοδοχεια, εστιατόρια -->
            <script>
            const filterButtons = document.querySelectorAll('.filter-button');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                location.href = 'gallery.php?filter=' + filterValue;
                });
            });
            </script>        


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
