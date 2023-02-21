<?php 
require_once('database.php');
if (!isset($_SESSION['logged_in_user']) || !$_SESSION['logged_in_user']) {
	header("Location: login.php");
}
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$family_status = $_SESSION['family_status'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="js/tau-prolog.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  </head>
  <body>

<?php
  require_once('database.php');
  $buffer = "";
  $query = "SELECT * from user u inner join reviews r on u.user_id = r.user_id  inner join choice ch on ch.choice_id = r.choice_id where rate between 4 AND 5 group by ch.choice_id";
  $results = mysqli_query($dbc, $query);
  while($row=$results->fetch_assoc()){
    $buffer = $buffer. "visited( '" . $row['first_name']. "' , '" . $row['name'] . "' , " . $row['choice_id'] . " ). ";
  }
  
  $query_family = "SELECT user_id , first_name, family_status from user where family_status='kids'  group by user_id";
  $results_family = mysqli_query($dbc, $query_family);
  while($crow=$results_family->fetch_assoc()){
    $buffer = $buffer."has( '". $crow['first_name']. "', '" . $crow['family_status'] . "'). ";
  }
  
  // echo $buffer;
?>

<script>
var buffer="<?php echo $buffer; ?>";
buffer+="has('<?php echo $_SESSION['username']; ?>','<?php echo $_SESSION['family_status']; ?>').";
buffer+="recommendation(X,Y,L):-has(X,W),has(Y,W),visited(Y,L,I),X\\=Y.";
var session;
var counting_index;
var places=new Array();
var response_from_input="";

</script>

    <script>
      
function ajax_call(rec_text){
  var request = 'rec_text=' + encodeURIComponent(rec_text) + '&city_id=<?php echo $city_id?>';
    $.ajax({
            url: 'print.php',
            type: 'POST',
            data: request,
            statusCode: {
                200: function() {
                  console.log('Successful Connection');
                },
                400: function() {
                  console.log('Could not connect to the server. Try again later');
                },
              },  
              success: function(response) {
                  console.log("Hi there"+response);
                  document.getElementById("x1").innerHTML = response;
              }
          })
} //ajax call


      function show() {
        success:
        return function (answer) {
    
        if (pl.type.is_substitution(answer)) {
      
          var p1 = answer.lookup("Y");
          var p2 = answer.lookup("L");
          places[counting_index] = p2; 
          counting_index++;
        }else {
        var rec_text="";
        for(i=0;i<counting_index;i++){ 
          rec_text+= places[i] +";";
        }
        document.getElementById("recommendations").innerHTML=rec_text;
        console.log(places);
        ajax_call(rec_text);
        }
      }
  }
      // Show the likes of a person
      function likes() {
        session = pl.create(1000);
        session.consult(buffer);
      }
      function likes2(usr) {
        alert("likes2 activated");
        counting_index=0;
        var my_query="visited('"+usr+"', K, L).";
        alert(my_query);
        session.query(my_query);
        alert("trying to present outputs");
        session.answers(show(), 1000);
      }
      function likes3(usr) {
        counting_index=0;
        var my_query="recommendation('"+usr+"', Y, L).";
        session.query(my_query);
        session.answers(show(), 1000);
      }
      // onClick #button
      function clickButton() {
        alert("clickbutton pressed");
        likes2("Αννα");
      }
      likes();
</script>
<div id="recommendations" style="display: none;">initially empty</div>

<script>likes3('<?php echo $_SESSION['username']; ?>');</script>
</body>
</html>
