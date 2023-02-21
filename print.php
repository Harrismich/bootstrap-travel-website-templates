<?php
require_once('database.php');
?>


<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["rec_text"])) {
            $places = [];
            $places = $_POST["rec_text"];
            $recommends = explode(";", $places);
            $city_id=$_POST["city_id"];
echo'      <div class="container">';
echo'        <div class="session-title">';
echo'          <h2>Recommended Hotels</h2>';
echo'           <p>';
echo'             <a href="gallery.php?filter=1">more... </a>';
echo'           </p>';
echo'         </div>';
echo'         <div class="dest-row row">';
            for($i=0; $i < count($recommends); $i++){
                $query = "SELECT * FROM category c inner join choice ch on ch.category_id = c.category_id inner join pic on ch.choice_id = id where city_id='$city_id' 
                AND (ch.category_id BETWEEN 1 and 2) and type_id='choice' and ch.name= '$recommends[$i]'  ORDER BY RAND() LIMIT 1";
                $result = mysqli_query($dbc, $query);
                while ($data = mysqli_fetch_assoc($result)) {
    echo'          <div class="col-lg-4 col-md-6">';
    echo'            <div class="dest-col">';
    echo'              <div class="dest-img">';
    echo"                 <img src='./pic/" . $data['path'] . ".jpg' style='width: 330px; height: 300px;' class='d-block' />";
    echo'              </div>';
    echo'              <h3> ' . $data["name"] . ' </h3>';

    echo '          <button class="btn" onclick="window.location.href=\'about_us.php?name=' . urlencode($data['choice_id']) . '\'">Read More</button>';
    echo'            </div>';
    echo'          </div>';
                }//while
            } //for

echo'        </div>';
echo'      </div>';
        }//if
        else {
            echo "No places submitted.";
        }//else
    }//if
?>
