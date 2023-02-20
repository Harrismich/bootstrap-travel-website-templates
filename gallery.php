<?php 
require_once('database.php');
session_start();

if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
if(!isset($_SESSION['city_id'])){
    header("Location: packages.php");
}
$city_id = $_SESSION['city_id'];
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Travelet Free Website Tempalte | Smarteyeapps.com</title>
            <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
            <link rel="shortcut icon" href="assets/images/fav.jpg">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/all.min.css">
            <link rel="stylesheet" href="assets/css/animate.css">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

            <style>
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
                <h2>Our Gallery</h2>
                <ul>
                    <li> <a href="index.php?city_id=<?php echo $_SESSION['city_id'];?>"><i class="fas fa-home"></i> Home</a></li>
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
                <button class="btn btn-default filter-button" data-filter="1"> Hotels </button>
                <button class="btn btn-default filter-button" data-filter="2"> Army Hotels </button>
                <button class="btn btn-default filter-button" data-filter="3"> Officers' Mess </button>
                <button class="btn btn-default filter-button" data-filter="4"> Restaurant </button>
                <button class="btn btn-default filter-button" data-filter="5"> Hospitals </button>
                <button class="btn btn-default filter-button" data-filter="8"> Available Houseσ </button>
            </div>
            <br/>

 <!--  ************************* Review Submit ************************** -->
<div id="simpleModal_2" class="modal">
    <div class="modal-window">
        <form action="" method="post" id ="confirmationform" name ="confirmationform">
        <h3>post your review</h3>
        <p class="placeholder">review title <span>*</span></p>
        <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box1">
        <p class="placeholder">review description <span>*</span></p>
        <textarea name="description" class="box1" placeholder="enter review description" required maxlength="1000" cols="30" rows="10"></textarea>
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
        <input type="hidden" id="choice_id" name="choice_id">
        <input type="submit" value="submit review" name="submit" class="btn1">
        </form>
    </div>
</div>

<?php
    $city = $_SESSION['city_id'];
    $filterValue = "all";
    // Ανάλογα την επιλογή του χρήστη αλλάζει το query στην βάση για να εμφανίσει μόνο τα αποτελέσματα που επέλεξε
    if (isset($_GET["filter"])) {
    $filterValue = $_GET["filter"];
    }
    $query = "SELECT * FROM pic inner join choice ch on choice_id=id  where city_id = '$city' and type_id='choice' ";
    if($filterValue == "1"){
        $query .= "AND category_id = '$filterValue' " ;
    }else if($filterValue == "2"){
        $query .= " AND category_id = '$filterValue'  ";
    }else if($filterValue == "3"){
        $query .= " AND category_id = '$filterValue' ";
    }else if($filterValue == "4"){
        $query .= " AND category_id = '$filterValue' ";
    }else if($filterValue == "5"){
        $query .= " AND category_id = '$filterValue' ";
    }else if($filterValue == "8"){
        $query = "SELECT * FROM pic inner join choice ch  on id=choice_id inner join house h on ch.choice_id=h.choice_id where ch.city_id = '$city' AND ch.category_id = '$filterValue' and type_id='choice'";
        // $query .= " AND category_id = '$filterValue' ";
    }else{
        $query .= "AND category_id = '$filterValue' " ;
    }
    $query .= "GROUP BY ch.choice_id";
    $_SESSION['category'] = $filterValue;
    $result = mysqli_query($dbc, $query);
                echo'<div class="container">';        
                    echo'<div class="box-container">';
                        while ($data = mysqli_fetch_assoc($result)) { 
                            if( ($filterValue!=8 ) || ($data['activation']=='active')){  
                                $favorite = "SELECT * from user_choice where choice_id = {$data['choice_id']}" ;
                                $fav_result = mysqli_query($dbc, $favorite);
                                echo' <div class="box">';
                                    echo' <div class="image">';
                                    echo "<img src='./pic/" . $data['path'] . ".jpg' class='d-block w-100' />";
                                    echo' </div>';
                                    echo' <div class="content">';
                                    if(($filterValue==8) && ($data['activation']=='active')) { //only when user click available houses
                                        echo "<h6><strong> Αddress: </strong>" .$data['address'] ."</h6>";
                                        echo "<h6><strong> Owner: </strong>" .$data['name'] ."</h6>";
                                        echo "<h6><strong> Phone: </strong>" .$data['phone_number'] ."</h6>";
                                        $date = $data['ch_date'];
                                        $formatted_date = date("d/m/y", strtotime($date));
                                        echo "<h6><strong> Available from: </strong>" .$formatted_date."</h6>";
                                        echo '<button class="btn"><a href= "about_us.php?name=' . urlencode($data['choice_id']) . '"> Read More </a></button>';
                                        echo '<div class="icons">';
                                        echo '<input type="hidden" class="choice_id" value="'. $data['choice_id'] . '">';
                                        echo '<a href="#" class="favorites-btn">';
                                            if (mysqli_num_rows($fav_result) > 0 ){
                                                echo' <i class="fa fa-heart heart in-favorites"></i>';   
                                            }else{
                                                echo' <i class="fa fa-heart heart not-in-favorites"></i>';       
                                            }                                  
                                        echo '</a>  ';
                                        echo '</div>';
                                    }else {
                                        echo "<h3>". $data['name'] . " </h4> ";
                                        echo "<br>";
                                        echo "<h6><strong> Address: </strong>" .$data['address'] ."</h6>";
                                        echo "<h6><strong> Phone: </strong>" .$data['phone_number'] ."</h6>";
                                        echo "<h6> <a href = " .$data['link'] . "><strong>Link:</strong> Visit us </a></h6>";
                                        echo '<button class="btn" onclick="window.location.href=\'about_us.php?name=' . urlencode($data['choice_id']) . '\'">Read More</button>';
                                        echo '<div class="icons">';
                                        echo '<input type="hidden" class="choice_id" value="'. $data['choice_id'] . '">';
                                        echo '<a href="#" class="favorites-btn">';
                                            if (mysqli_num_rows($fav_result) > 0 ){
                                                echo' <i class="fa fa-heart heart in-favorites"></i>';   
                                            }else{
                                                echo' <i class="fa fa-heart heart not-in-favorites"></i>';       
                                            }                                  
                                        echo '</a>  ';
                                        echo "<button data-target='simpleModal_2' data-toggle='modal' onclick = 'review(\"".$data['choice_id']."\")'> <i class='fas fa-star'></i> Make Review</button>";
                                        echo '</div>';
                                    }
                                    echo' </div>';
                                echo'</div>';
                            }// activation
                        }//while loop
                    echo'</div>';
                    if(mysqli_num_rows($result) >3){
                        echo'<div id="load-more"> load more </div>';
                    };
                echo'</div>';
                ?>  
        </div>
    </div>  
</div> 
<script>
function review(rating) {
    var choice = document.querySelector('#choice_id');
    choice.value = rating;
}
</script>
<?php
    if (isset($_POST['submit']) && (isset($_POST['rate'])) && (isset($_POST['title'])) && (isset($_POST['description']))) {
    $choice_id = $_POST['choice_id'];
    $rate = $_POST['rate'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    // Insert the data into the 'reviews' table
    $stmt = mysqli_prepare($dbc, "INSERT INTO reviews (choice_id, user_id, rate, title, comment) VALUES (?, ?, ?, ?, ?)"); 
    mysqli_stmt_bind_param($stmt, "iiiss", $choice_id, $user_id, $rate, $title, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    }
?>
<script>
    // Attach click event listener to the document
    document.addEventListener('click', function (e) {
        e = e || window.event;
        // Get the target of the event (the element that was clicked)
        var target = e.target || e.srcElement;
        
        // Check if the target has a "data-toggle" attribute and its value is "modal"
        if (target.hasAttribute('data-toggle') && target.getAttribute('data-toggle') == 'modal') {
            if (target.hasAttribute('data-target')) {
                var m_ID = target.getAttribute('data-target');
                document.getElementById(m_ID).classList.add('open');
                e.preventDefault();
            }
        }
        
        // Close modal window with 'data-dismiss' attribute, when the backdrop is clicked or when the esc key is pressed
        if ((target.hasAttribute('data-dismiss') && target.getAttribute('data-dismiss') == 'modal') || target.classList.contains('modal') || e.keyCode == 27) {
            // Get the currently open modal
            var modal = document.querySelector('[class="modal open"]');
            // Remove the "open" class to hide the modal
            modal.classList.remove('open');
            // Prevent default event behavior
            e.preventDefault();
        }
    }, false);
    
    // Attach keydown event listener to the document
    document.addEventListener('keydown', function (e) {
        e = e || window.event;
        // Check if the esc key was pressed
        if (e.keyCode == 27) {
            var modal = document.querySelector('[class="modal open"]');
            if (modal) {
                // Remove the "open" class to hide the modal
                modal.classList.remove('open');
                e.preventDefault();
            }
        }
    });
</script>                             
                                            <!-- ######## Gallery End ####### -->  

                    <!-- echo  '<button class="btn"><a href= '. $data['map'] .'> google map </a></button>'; -->
                                                                <!-- ######## scripts ####### -->  
                    <!-- // Select the ".heart" element within the DOM element the event handler is being triggered on
                    var heart = $(this).find(".heart");
                    
                    // Select the closest ".card" element to the DOM element the event handler is being triggered on, 
                    // and then select the ".card-title" element within that ".card" and retrieve its text content
                    var cardTitle = $(this).closest(".card").find(".card-title").text();
                    
                    // Select the closest ".card" element to the DOM element the event handler is being triggered on,
                    // and then select the ".choiceId" element within that ".card" and retrieve its value attribute
                    var choiceId = $(this).closest(".card").find(".choiceId").val(); -->
                    
                    
                <!-- Με το κλικ η καρδιά ενεργοποιείται -->
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                
                
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
                    if (button) {
                        button.addEventListener('click', function() {
                            const filterValue = this.getAttribute('data-filter');
                            location.href = 'gallery.php?filter=' + filterValue;
                        });
                    }
                });
            </script>
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
    <!-- <script src="assets/js/script.js"></script> -->
    
    </body>
    
</html>
