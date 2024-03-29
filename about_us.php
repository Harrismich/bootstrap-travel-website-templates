<?php 
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
if(!isset(($_GET['name']))){
    header("Location: gallery.php");
}
$user_id = $_SESSION['user_id'];
$name = urldecode($_GET['name']); ?>


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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
#load-more {
    margin-top: 20px;
    margin-left: 550px;
    display: inline-block;
    padding: 13px 30px;
    border: 1px solid #334;
    color: #334;
    font-size: 16px;
    background-color: #fff;
    cursor: pointer;
    }

    #load-more:hover {
    background-color: crimson;
    border-color: crimson;
    color: #fff;
    }

    .review-row .col-md-6 {
    display: none;
    }

    .row.review-row .col-md-6:nth-child(1),
    .row.review-row .col-md-6:nth-child(2),
    .row.review-row .col-md-6:nth-child(3),
    .row.review-row .col-md-6:nth-child(4)    {
    display: inline-block;
    }
    
    .reviews_filters {
        margin-left:930px;}
        
    .main-image-container {
    width: 100%;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.main-image {
    max-width: 100%;
    max-height: 100%;
}

.thumbnail-row {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.thumbnail {
    width: 100px;
    height: 100px;
    margin: 0 5px;
    object-fit: cover;
    cursor: pointer; 
}

#f_rate {
    border-radius: .5rem;
    box-shadow: 0 0 5px #ccc;
}

/* .rating_2 {
    margin-top:120px;
    
} */

.rating_2 .star {
    margin-right: 5px;
}

.rating_2 br {
    display: block;
    margin-bottom: 10px;
    content: "";
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
                <?php $query ="SELECT * FROM choice ch inner join pic p on choice_id = id where choice_id = '$name' and type_id='choice'" ;
                        $result = mysqli_query($dbc, $query);
                        $data = mysqli_fetch_assoc($result)
                ?>
                <h2><?php if ($data['category_id']!=8) { echo $data['name']; } else {echo 'Details';}  ?></h2>
                <ul>
                    <?php if(isset($_SESSION['category'])){ ?> 
                        <li> <a href="gallery.php?filter=<?php echo $_SESSION['category']; ?>"><i class="fas fa-home"></i> Home</a></li>
                    <?php }else{ ?>
                        <li><a href="gallery.php"><i class= "fas fa-home"></i> Home </a></li>
                    <?php } ?>
                    <li><i class="fas fa-angle-double-right"></i> About Us</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="about-us container-fluid">
        <div class="container">
            <div class="row natur-row no-margin w-100">
                <div class="text-part col-md-6">
                    <h2><?php if ($data['category_id']!=8) { echo $data['name']; } else {echo 'Details';}  ?></h2>
                    <p><?php echo $data['description']  ?></p>
                    <div class="rating_2">
                        <?php
                        $query = "SELECT FORMAT(CAST(SUM(rate) AS FLOAT) / COUNT(*), 1) AS sum_rate, COUNT(*) AS total_reviews, rate FROM reviews WHERE choice_id = '$name' GROUP BY rate;";
                        $result = mysqli_query($dbc, $query);
                        if(mysqli_num_rows($result) > 0) {
                            $data2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $review_counts = array_fill(1, 5, 0);
                            $sum = array_fill(1, 5, 0);
                            $total_stars=0;
                            foreach ($data2 as $row) {
                                $review_counts[$row['rate']] = $row['total_reviews'];
                                $sum[$row['rate']] = $row['sum_rate'];
                            }
                            $total_reviews = array_sum($review_counts);
                            for ($i = 1; $i <= 5; $i++) {
                                $total_stars += $sum[$i] * $review_counts[$i];
                            }
                            echo '<div class="rating-summary">';
                            echo '<span class="btn btn-danger">Average rating: ' . ROUND(($total_stars/$total_reviews),1) . ' | Total reviews: ' . $total_reviews . '</span>';
                            echo '</div>';
                            // iterate over each star rating
                            for ($i = 1; $i <= 5; $i++) {
                                for ($j = 1; $j <= $i; $j++) {
                                    echo '<span class="star" data-value="' . $j . '"><i class="fas fa-star" style="color:  #ffd700;"></i></span>';
                                }
                                // output the number of reviews for this rating
                                echo ' (' . $review_counts[$i] . ')';
                                echo '<br>';
                            }
                        }
                        ?>
                    </div>
                </div>
            <div class="image-part col-md-6">
                <?php
                // Get all pictures for this choice
                $query = "SELECT * FROM pic WHERE id = '$name' AND type_id = 'choice'";
                $result = mysqli_query($dbc, $query);
                $pictures = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // If there is more than one picture, show thumbnail carousel
                if (count($pictures) > 1) {
                    $current_index = 0;
                    foreach ($pictures as $index => $picture) {
                        if ($picture['path'] == $data['path']) {
                            $current_index = $index;
                            break;
                        }
                    }
                    ?>
                <?php
                }
                ?>
                <div class="main-carousel">
                    <div id="picture-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">
                            <?php foreach ($pictures as $index => $picture) : ?>
                                <div class="carousel-item <?php if ($picture['path'] == $data['path']) echo 'active'; ?>">
                                    <img src="./pic/<?php echo $picture['path']; ?>.jpg" class="d-block w-100" alt="Main Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($pictures) > 1) { ?>
                            <a class="carousel-control-prev" href="#picture-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#picture-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="thumbnail-carousel">
                    <div class="row">
                        <?php foreach ($pictures as $index => $picture) : ?>
                            <div class="col-3 thumbnail-item <?php if ($picture['path'] == $data['path']) echo 'active'; ?>" data-index="<?php echo $index; ?>">
                                <img src="./pic/<?php echo $picture['path']; ?>.jpg" class="img-fluid" alt="Thumbnail Image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php echo '<br><center><a href="' . $data['map'] . '" target="_blank"><button type="button" class="btn btn-danger">Google Map</button></a></center>'; ?>
            </div>
        </div>
    </div>
</div>
<!--*****************Our Reviews Start Here ****************** -->
<?php
    if ($data['category_id']!=8) {  // dont show reviews for houses
?>     
<div class="review container-fluid" style="background-color: #fcfcfc;">
    <div class="container">
        <div class="session-title">
            <h2>Reviews</h2>
            <div class="reviews_filters">
                <label>Filter By Rate: </label>
                <select name="f_rate" id="f_rate">
                <option class="filter-button" data-filter="all" <?php if(!isset($_GET['filter']) || $_GET['filter'] == 'all') { echo 'selected'; } ?>>All</option>
                    <option class="filter-button" data-filter=1 <?php if(isset($_GET['filter']) && $_GET['filter'] == 1) { echo 'selected'; } ?>>1</option>
                    <option class="filter-button" data-filter=2 <?php if(isset($_GET['filter']) && $_GET['filter'] == 2) { echo 'selected'; } ?>>2</option>
                    <option class="filter-button" data-filter=3 <?php if(isset($_GET['filter']) && $_GET['filter'] == 3) { echo 'selected'; } ?>>3</option>
                    <option class="filter-button" data-filter=4 <?php if(isset($_GET['filter']) && $_GET['filter'] == 4) { echo 'selected'; } ?>>4</option>
                    <option class="filter-button" data-filter=5 <?php if(isset($_GET['filter']) && $_GET['filter'] == 5) { echo 'selected'; } ?>>5</option>
                </select>
            </div>
        </div>
<?php
    $filterValue = "all";
    // Ανάλογα την επιλογή του χρήστη αλλάζει το query στην βάση για να εμφανίσει μόνο τα αποτελέσματα που επέλεξε
    if (isset($_GET["filter"])) {
    $filterValue = $_GET["filter"];
    }
    $query = "SELECT username, title, comment, rate , r_date
    FROM choice ch INNER JOIN reviews r ON ch.choice_id=r.choice_id  INNER JOIN user u ON r.user_id=u.user_id 
    where ch.choice_id = '$name' ";
    if ($filterValue == "all") {
        $query = "SELECT username, title, comment, rate , r_date FROM choice ch INNER JOIN reviews r ON ch.choice_id=r.choice_id INNER JOIN user u ON r.user_id=u.user_id where ch.choice_id = '$name' ORDER BY r_date DESC";
    }else if($filterValue == 1){
        $query .= "AND rate = '$filterValue' ORDER BY r_date DESC";
    }else if($filterValue == 2){
        $query .= " AND rate = '$filterValue' ORDER BY r_date DESC";
    }else if($filterValue == 3){
        $query .= " AND rate = '$filterValue' ORDER BY r_date DESC";
    }else if($filterValue == 4){
        $query .= " AND rate = '$filterValue' ORDER BY r_date DESC";
    }else if($filterValue == 5){
        $query .= " AND rate = '$filterValue' ORDER BY r_date DESC";
    }
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0) {
    echo'<div class="row review-row">';        
        while ($data = mysqli_fetch_assoc($result)) {   
            echo'<div class="col-md-6">';
                echo'<div class="review-col">';
?>
                    <div class="profil">
                        <!-- <img src="assets/images/testimonial/member-01.jpg" alt="" /> -->
                    </div>
                    <div class="review-detail ">
<?php
                        echo "<h4>". $data['title'] . " </h4> ";
                        echo "<p id='p_comment' style='word-break: break-all;'>".$data['comment']."</p>";
                        $date = date_create($data['r_date']);
                        echo "<h6>". $data['username'] . " at ". date_format($date,'d-m-Y')  ."</h6>";
                        echo "<ul class='rat'>";
                        for($i = 0; $i < $data['rate']; $i++) {
                            echo '<li><i class="fa fa-star" style="color: #f3da35"></i></li>';
                        }
                        echo "</ul>";
?>
                    </div>
                </div>
            </div>
        <?php
    }//end of while loop
        if(mysqli_num_rows($result) > 4){
        echo'<div id="load-more"> Load more </div>';
        };
    ?>
        </div>
    </div>   
<?php                    
    } else {
        echo' <div class="container p-3 my-3 border text-center">';
        echo '<h6>Δεν υπάρχουν κριτικές ακόμη</h6>';
        echo '</div>';
    }
    ?> 
</div> 
<?php 
    }//if category !=8
?>  
<div id="map"></div>

    



<script>
    let loadMoreBtn = document.querySelector('#Load-more');
    let currentItem = 4;
    loadMoreBtn.onclick = () =>{
    let boxes = [...document.querySelectorAll('.row.review-row .col-md-6')];
    for (var i = currentItem; i < currentItem + 4; i++){
        boxes[i].style.display = 'inline-block';
    }
    currentItem += 4;

    if(currentItem >= boxes.length){
        loadMoreBtn.style.display = 'none';
    }
    }
</script>

<!--Περνάει μέσω url το filtervalue ωστε να περάσει από τα if $filtervalue -->
<script>
    const selectElement = document.querySelector('#f_rate');

    selectElement.addEventListener('change', function() {
    var name = '<?php echo $name; ?>';
    const selectedOption = this.options[this.selectedIndex];
    const selectedValue = selectedOption.value;

    if (selectedOption.selected) {
        console.log(`Option with value "${selectedValue}" has been selected.`);
        location.href = 'about_us.php?name=' + name + '&filter=' + selectedValue;
    }
    });
</script>              

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