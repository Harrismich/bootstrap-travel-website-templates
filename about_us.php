<?php 
require_once('database.php');
session_start();
// if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
// 	header("Location: login.php");
// }

$user_id = $_SESSION['user_id'];
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
   
    
<!--*****************Our Reviews Start Here ****************** -->
        
<div class="our-team">
  <div class="container">
      <h2>Οι Κριτικές μας</h2>
      <div class="reviews_filters">
        <label>Filter By Rate: </label>
        <select name="f_rate" id="f_rate">
          <option class="filter-button" data-filter=1>1</option>
          <option class="filter-button" data-filter=2>2</option>
          <option class="filter-button" data-filter=3>3</option>
          <option class="filter-button" data-filter=4>4</option>
          <option class="filter-button" data-filter=5>5</option>
          <option class="filter-button" data-filter="all">All</option>
        </select> 
      </div>
<!--*******************Reviews From Users**********************-->
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
    echo'<div class="container">';        
        while ($data = mysqli_fetch_assoc($result)) {   
            echo' <div class="container p-3 my-3 border">';
?>
<span class="user_date"> <h6 style="text-decoration-line: underline;"> <?php $date = date_create($data['r_date']);
echo sprintf("O/H %s έγραψε την %s.", $data['username'], date_format($date,'d-m-Y')); ?> </h6> </span>
<br>
<br>
<?php
                echo' <div class="content">';
                    echo "<h3>". $data['title'] . " </h3> ";
                    for($i = 0; $i < $data['rate']; $i++) {
                        echo '<i class="fa fa-star" style="color: #f3da35"></i>';
                    }
?>
<?php                    
    echo "<br>";
    echo "<p id='p_comment'>".$data['comment']."</p>";
?>
<ul class="rat" style="margin: bottom 20px";>
</ul>
<?php
                echo' </div>';
            echo'</div>';
        }//end of while loop
      } else {
        echo' <div class="container p-3 my-3 border">';
        echo '<h6>Δεν υπάρχουν κριτικές με αυτή τη βαθμολογία</h6>';
        echo '</div>';
        }
    if(mysqli_num_rows($result) >3){
        echo'<div id="load-more"> load more </div>';
    };
    echo'</div>';
?>
<script>
    let loadMoreBtn = document.querySelector('#load-more');
    let currentItem = 3;
    loadMoreBtn.onclick = () =>{
    let boxes = [...document.querySelectorAll('.container .container p-3 my-3')];
    for (var i = currentItem; i < currentItem + 3; i++){
        boxes[i].style.display = 'inline-block';
    }
    currentItem += 3;

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
