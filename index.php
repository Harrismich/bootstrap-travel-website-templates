<?php
require_once('database.php');
session_start();
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
if (isset($_GET['city_id'])) {
  $city_id = $_GET['city_id'];
  $_SESSION['city_id'] = $city_id;
  $query = "SELECT city_name, description FROM city WHERE city_id = '$city_id'";
    $result = mysqli_query($dbc, $query);
    $data = mysqli_fetch_assoc($result);
    $city= $data['city_name'];
}
if(!isset($city_id)){
  header("Location: packages.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Bootstrap Travel Website Template | Smarteyeapps.com</title>
    <link
      rel="shortcut icon"
      href="assets/images/fav.png"
      type="image/x-icon"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="assets/images/fav.jpg" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  </head>

  <body>
    <!-- ################# Header Starts Here#######################--->

    <?php include('header.php');?>


    <div class="slider container-fluid">
        <div class="carousel-inner">
          <div class="carousel-item active">
              <?php 
                  $query = " select * from image i inner join city c on c.city_id = i.city_id where $city_id = i.city_id ORDER BY RAND() limit 1 ";
                  $result = mysqli_query($dbc, $query);
                  while ($data = mysqli_fetch_assoc($result)){
                    echo"<img src='./images/" . $data['path'] . ".jpg' class='d-block w-100' />";
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
          <!-- <p>
            Sagittis vulputate magna sagittis sagittis erat feugiat nullam
            cubilia amet dignissim Euismod.
          </p> -->
        </div>
        <div class="why-ro row">
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=1"><i class="fas fa-hotel"></i></a>
              </div>
              <div class="detail">
              <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=1"><h4>Ξενοδοχεία</h4><a>
                <p>
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=4"><i class="fas fa-utensils"></i></a>
              </div>
              <div class="detail">
                <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=4"><h4>Εστιατόρια</h4></a>
                <p>
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <i class="fas fa-eye"></i>
              </div>
              <div class="detail">
                <h4>Αξιοθέατα</h4>
                <p>
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
              <i class="fas fa-hospital"></i>
              </div>
              <div class="detail">
                <h4>Νοσοκομεία</h4>
                <p>
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
              <!-- <script>
                document.querySelector('.col-card').addEventListener('click', function() {
                  var latitude = <?php echo $location['latitude']; ?>;
                  var longitude = <?php echo $location['longitude']; ?>;
                  window.location.href = 'https://maps.google.com/?q=' + latitude + ',' + longitude;
                });
              </script> -->
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
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="col-card">
              <div class="icon">
                <i class="far fa-comments"></i>
              </div>
              <div class="detail">
                <h4>24 x 7 Support</h4>
                <p>
                  Turpis accumsan. Proin id ligula suspendisse. Aliquet
                  fringilla, aptent eu dignissim.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ################# Popular Packages Starts Here #######################--->
<?php
    $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pictures p on ch.choice_id = p.choice_id where city_id='$city_id' AND c.category_id = 4 ORDER BY RAND() LIMIT 3";
$result = mysqli_query($dbc, $query);

echo '<div class="popular-pack no-bgpack container-fluid">';
echo '  <div class="container">';
echo '    <div class="session-title">';
echo '      <h2>Προτάσεις Εστιατορίων</h2>';
echo '      <p>';
echo'         <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=4">Περισσότερα</a>';
echo '      </p>';
echo '    </div>';
echo '    <div class="row pack-row">';
while ($data = mysqli_fetch_assoc($result)) {
  echo '      <div class="col-lg-4 col-md-6 col-sm-6">';
  echo '        <div class="pack-col">';
  echo '          <img src="./pictures/' . $data['path'] . '.jpg" alt="" />';
  echo '          <div class="revire row no-margin">';
  echo '            <ul class="rat">';
  echo '              <li><i class="fa fa-star"></i></li>';
  echo '              <li><i class="fa fa-star"></i></li>';
  echo '              <li><i class="fa fa-star"></i></li>';
  echo '              <li><i class="fa fa-star"></i></li>';
  echo '              <li><i class="fa fa-star"></i></li>';
  echo '            </ul>';
  echo '          </div>';
  echo '          <div class="detail row no-margin">';
  echo '            <h4>' . $data['name'] . '</h4>';
 // echo '            <p>' . $data['description'] . '</p>';
  echo '          </div>';
  echo '          <div class="options row no-margin d-flex justify-content-center">';
  echo'           <div class="dest-col">';              
  echo'               <button class="btn btn-outline-success">Book Now</button>';
  echo'          </div>';
  // echo '            <ul>';
  // echo '              <li><i class="fas fa-utensils"></i></li>';
  // echo '              <li><i class="fas fa-glass-cheers"></i></li>';
  // echo '              <li><i class="fas fa-concierge-bell"></i></li>';
  // echo '            </ul>';
  echo '          </div>';
  echo '        </div>';
  echo '      </div>';
}
echo '    </div>';
echo '  </div>';
echo '</div>';
?>
    <!--################### Destinations Starts Here #######################--->

    <?php
    $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pictures p on ch.choice_id = p.choice_id where city_id='$city_id' AND c.category_id = 1 ORDER BY RAND() LIMIT 3";
    $result = mysqli_query($dbc, $query);
echo'    <div class="destinations container-fluid">';
echo'      <div class="container">';
echo'        <div class="session-title">';
echo'          <h2>Προτάσεις Ξενοδοχείων</h2>';
echo'          <p>';
echo'            <a href="http://localhost/project%20php/bootstrap-travel-website-templates/gallery.php?filter=1">Περισσότερα</a>';
echo'           </p>';
echo'         </div>';
echo'         <div class="dest-row row">';
          while ($data = mysqli_fetch_assoc($result)) {
echo'          <div class="col-lg-4 col-md-6">';
echo'            <div class="dest-col">';
echo'              <div class="dest-img">';
echo'                <img src="./pictures/' . $data['path'] . '.jpg" alt="" />';
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

    <!--################### Tour Type Starts Here #######################--->
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

    <!--################### Tour Review Starts Here #######################--->

    <div class="review container-fluid">
      <div class="container">
        <div class="session-title">
          <h2>What people say about Us</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
            sollicitudin nisi id consequat bibendum. Phasellus at convallis
            elit. In purus enim, scelerisque id arcu vitae
          </p>
        </div>
        <div class="row review-row">
          <div class="col-md-6">
            <div class="review-col">
              <div class="profil">
                <img src="assets/images/testimonial/member-01.jpg" alt="" />
              </div>
              <div class="review-detail">
                <h4>Canadian Rockies</h4>
                <p>
                  The sightseeing and activities were better than we even
                  thought! I still can’t believe we did so much in such a short
                  time, but we did not feel stressed. We really loved the tour
                  and would do it all over again in a minute! Thanks.
                </p>
                <h6>John Smith</h6>
                <ul class="rat">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="review-col">
              <div class="profil">
                <img src="assets/images/testimonial/member-01.jpg" alt="" />
              </div>
              <div class="review-detail">
                <h4>Lake Tahoe Adventure</h4>
                <p>
                  The sightseeing and activities were better than we even
                  thought! I still can’t believe we did so much in such a short
                  time, but we did not feel stressed. We really loved the tour
                  and would do it all over again in a minute! Thanks.
                </p>
                <h6>John Smith</h6>
                <ul class="rat">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="review-col">
              <div class="profil">
                <img src="assets/images/testimonial/member-01.jpg" alt="" />
              </div>
              <div class="review-detail">
                <h4>Discover Costa Rica</h4>
                <p>
                  The sightseeing and activities were better than we even
                  thought! I still can’t believe we did so much in such a short
                  time, but we did not feel stressed. We really loved the tour
                  and would do it all over again in a minute! Thanks.
                </p>
                <h6>John Smith</h6>
                <ul class="rat">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="review-col">
              <div class="profil">
                <img src="assets/images/testimonial/member-01.jpg" alt="" />
              </div>
              <div class="review-detail">
                <h4>Canadian Rockies</h4>
                <p>
                  The sightseeing and activities were better than we even
                  thought! I still can’t believe we did so much in such a short
                  time, but we did not feel stressed. We really loved the tour
                  and would do it all over again in a minute! Thanks.
                </p>
                <h6>John Smith</h6>
                <ul class="rat">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--*************** Blog Starts Here ***************-->

    <div class="container-fluid blog">
      <div class="container">
        <div class="blog-row row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="blog-col">
              <img src="assets/images/destination/d1.jpg" alt="" />
              <span>August 9, 2019</span>
              <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
              <p>
                Orci varius natoque penatibus et magnis dis parturient montes,
                nascetur ridiculus mus. Praesent accumsan, leo in venenatis
                dictum,
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="blog-col">
              <img src="assets/images/destination/d2.jpg" alt="" />
              <span>August 9, 2019</span>
              <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
              <p>
                Orci varius natoque penatibus et magnis dis parturient montes,
                nascetur ridiculus mus. Praesent accumsan, leo in venenatis
                dictum,
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="blog-col">
              <img src="assets/images/destination/d3.jpg" alt="" />
              <span>August 9, 2019</span>
              <h4>Orci varius consectetur adipiscing natoque penatibus</h4>
              <p>
                Orci varius natoque penatibus et magnis dis parturient montes,
                nascetur ridiculus mus. Praesent accumsan, leo in venenatis
                dictum,
              </p>
            </div>
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
