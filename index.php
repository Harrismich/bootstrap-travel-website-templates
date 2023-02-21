<?php
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
if (isset($_GET['city_id']) || isset( $_SESSION['city_id'])) {
    $city_id = $_GET['city_id'];
    $query = "SELECT city_name, description FROM city WHERE city_id = '$city_id'";
    $result = mysqli_query($dbc, $query);
    $data = mysqli_fetch_assoc($result);
    $city= $data['city_name'];
}
$_SESSION['city_id'] = $city_id;
if(!isset( $_SESSION['city_id'])){
  header("Location: packages.php");
}
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Smart City</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/images/fav.jpg" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <style>
    html {
  scroll-behavior: smooth;
}
</style>
  </head>

  <body>
    <!-- ################# Header Starts Here#######################--->

    <?php include('header.php');?>


    <div class="slider container-fluid">
        <div class="carousel-inner">
          <div class="carousel-item active">
              <?php 
                  $query = "SELECT * from pic inner join city on city_id = id where $city_id = city_id and type_id='city'  ORDER BY RAND() limit 1 ";
                  $result = mysqli_query($dbc, $query);
                  while ($data = mysqli_fetch_assoc($result)){
                    echo"<img src='./pic/" . $data['path'] . ".jpg' class='d-block w-100' />";
                  }
              ?>
          </div>
          </div>
    </div>

    <!-- ################# Why Choos US Starts Here #######################--->

    <div class="why-choos-us container-fluid">
      <div class="container">
        <div class="session-title">
          <h2><?php echo $city ;?></h2>
        </div>
        <div class="why-ro row">
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <a href="gallery.php?filter=1"><i class="fas fa-hotel"></i></a>
              </div>
              <div class="detail">
              <a href="gallery.php?filter=1"><h4>Hotels</h4><a>
                <p>
                  Providing informations about the hotels in the area.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <a href="gallery.php?filter=4"><i class="fas fa-utensils"></i></a>
              </div>
              <div class="detail">
                <a href="gallery.php?filter=4"><h4>Restaurants</h4></a>
                <p>
                  Choose where your next meal is going to be.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <a href="#section2" >
            <div class="col-card" id="section1">
              <div class="icon">
                  <i class="fas fa-eye"></i>
                </div>
                <div class="detail">
                  <h4>Sights</h4>
                  <p>
                    Landmarks you should visit with your family in the city.
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <i class="fas fa-hospital"></i>
              </div>
              <div class="detail">
              <a href="gallery.php?filter=5"><h4>Hospitals</h4></a>
                <p>
                  Here is some information about hospitals in the area.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
                <i class="fas fa-car"></i>
              </div>
              <div class="detail">
                <h4>Parking</h4>
                <p>
                  You don't have to worry where to park tour vehicle.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <i class="fas fa-home"></i>
              </div>
              <div class="detail">
              <a href="gallery.php?filter=8"><h4>Available Houses </h4></a>
                <p>
                  Here you can check houses other's coworkers in the city.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ################# Προτάσεις Εστιατορίων #######################--->
<?php

    $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pic on ch.choice_id = id where city_id='$city_id' AND c.category_id = 4 and type_id='choice' ORDER BY RAND() LIMIT 3";
$result = mysqli_query($dbc, $query);


echo '<div class="popular-pack no-bgpack container-fluid">';
echo '  <div class="container">';
echo '    <div class="session-title">';
echo '      <h2>Recommended Restaurants</h2>';
echo '      <p>';
echo'         <a href="gallery.php?filter=4">more...</a>';
echo '      </p>';
echo '    </div>';
echo '    <div class="row pack-row">';
while ($data = mysqli_fetch_assoc($result)) {
  echo '      <div class="col-lg-4 col-md-6 col-sm-6">';
  echo '        <div class="pack-col">';
  echo"             <img src='./pic/" . $data['path'] . ".jpg' style='width: 350px; height: 270px;' class='d-block' />";
  echo '          <div class="revire row no-margin">';
                    $query_rate = "SELECT (sum(rate)/count(rate) ) as rev FROM reviews where choice_id = {$data['choice_id']}";
                    $results = mysqli_query($dbc, $query_rate);
                    $rating = 0;
                    if (mysqli_num_rows($results) > 0) {
                      $row = mysqli_fetch_assoc($results);
                      $rating = round($row['rev']);
                    }
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $rating) {
                        echo '<li style="display: inline-block"><i class="fa fa-star" style="color: #f3da35"></i></li>';
                      } else {
                        echo '<li style="display: inline-block"><i class="fa fa-star-o" style="color: #f3da35"></i></li>';
                      }
                    }
  echo '            </ul>';
  
  echo '          </div>';
  echo '          <div class="detail row no-margin">';
  echo '            <h4>' . $data['name'] . '</h4>';
  echo '          </div>';
  echo '          <div class="options row no-margin d-flex justify-content-center">';
  echo'           <div class="dest-col">';              
  echo '          <button class="btn" onclick="window.location.href=\'about_us.php?name=' . urlencode($data['choice_id']) . '\'">Read More</button>';
  echo'          </div>';
                
  echo '          </div>';
  echo '        </div>';
  echo '      </div>';
};
echo '    </div>';
echo '  </div>';
echo '</div>';
?>
    <!--################### Προτάσεις Ξενοδοχείων #######################--->

    <?php

    $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pic on ch.choice_id = id where city_id='$city_id' AND ch.category_id = 1 and type_id='choice' ORDER BY RAND() LIMIT 3";

    $result = mysqli_query($dbc, $query);
echo'    <div class="destinations container-fluid">';
echo'      <div class="container">';
echo'        <div class="session-title">';
echo'          <h2>Recommended Hotels</h2>';
echo'          <p>';
echo'            <a href="gallery.php?filter=1">more...</a>';
echo'           </p>';
echo'         </div>';
echo'         <div class="dest-row row">';
          while ($data = mysqli_fetch_assoc($result)) {
echo'          <div class="col-lg-4 col-md-6">';
echo'            <div class="dest-col">';
echo'              <div class="dest-img">';
echo"                 <img src='./pic/" . $data['path'] . ".jpg' style='width: 330px; height: 300px;' class='d-block' />";
echo'              </div>';
echo'              <h3> ' . $data["name"] . ' </h3>';

echo'              <button class="btn btn-outline-success">Book Now</button>';
echo'            </div>';
echo'          </div>';
          }
echo'        </div>';
echo'      </div>';
echo'    </div>';
 ?>

    <!-- ################### Tour Type Starts Here ####################### -->

    <div id="why" class="our-capablit container-fluid">
      <div class="layy">
        <div class="container">
          <div class="session-title">
            <h2>Tour Type</h2>
          </div>
          <div class="row mt-5">
            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-walking"></i>
                </div>
                <h6>Walking</h6>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-car"></i>
                </div>
                <h6>Safari</h6>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-fire"></i>
                </div>
                <h6>Camp Fire</h6>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fab fa-fly"></i>
                </div>
                <h6>Air Ride</h6>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-ship"></i>
                </div>
                <h6>Cruise</h6>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-suitcase-rolling"></i>
                </div>
                <h6>Hiking</h6>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-hippo"></i>
                </div>
                <h6>Wild Life</h6>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="cap-det">
                <div class="icon">
                  <i class="fas fa-baseball-ball"></i>
                </div>
                <h6>Sports</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
        </div>

    <!--*************** Sight Starts Here ***************-->
    <div id="section2" >
      <?php
      $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pic on ch.choice_id =id where city_id='$city_id' AND c.category_id = 6 and type_id='choice' ORDER BY RAND() LIMIT 3";
      $result = mysqli_query($dbc, $query);
      ?>
      <div class="container-fluid blog">
        <div class="container">
          <div class="blog-row row">
          <?php while ($data = mysqli_fetch_assoc($result)) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="blog-col">
                <?php echo '<a href=' . $data['map']. '><img src="./pic/' . $data['path'] . '.jpg" alt="" /></a>'; ?>
                <h4><?php echo $data['name']; ?></h4>
                <p>
                  <?php echo $data['description']; ?>
                </p>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>


    <!--  ************************* Footer Start Here ************************** -->

    <?php include('footer.php');?>  
    
    <div class="copy">
      <div class="container">
        <a href="https://www.smarteyeapps.com/"
          >2019 &copy; All Rights Reserved | Designed and Developed by
          Smarteyeapps</a
        >

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
