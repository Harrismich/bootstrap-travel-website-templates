<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <script src="js/tau-prolog.js"></script>
    
    
<?php
require_once('database.php');
$buffer = "";
$query = "SELECT * from user u inner join reviews r on u.user_id = r.user_id  inner join choice ch on ch.choice_id = r.choice_id where rate between 4 AND 5 ";
$results = mysqli_query($dbc, $query);
while($row=$results->fetch_assoc()){
  $buffer = $buffer. "visited( '". $row['first_name']. "' , '" . $row['name'] . "'). ";
  
}
$query_family = "SELECT user_id , first_name, family_status from user where family_status='kids'  group by user_id";
$results_family = mysqli_query($dbc, $query_family);
while($crow=$results_family->fetch_assoc()){
  $buffer = $buffer."has( '". $crow['first_name']. "', '" . $crow['family_status'] . "'). ";

}

echo $buffer;
?>

<script>
var buffer="<?php echo $buffer; ?>";
alert(buffer); 
var session;

</script>

<textarea id="program">
<?php echo $buffer; ?>
</textarea>

    <!-- Button -->
    <input
      class="example-button"
      type="button"
      value="See all likes"
      id="button"
      onClick="clickButton();"
    />


    <script>
      
      function show() {
        alert("got into show");
        return function (answer) {
          // Valid answer
          if (pl.type.is_substitution(answer)) {
            // Get the value of the food
            //var p1 = answer.lookup("K");
            var p2 = answer.lookup("L");
            alert(" visited " + p2 );
          }
        }
      }

      // Show the likes of a person
      function likes() {
        alert("buffer="+buffer);
        session = pl.create(1000);
        session.consult(buffer);
      }

      function likes2(usr) {
        alert("likes2 activated");
        var my_query="visited('"+usr+"', L).";
        alert(my_query);
        session.query(my_query);
        alert("trying to present outputs");
        session.answers(show(), 1000);
      }

      // onClick #button
      function clickButton() {
        alert("clickbutton pressed");
        likes2("Αννα");
      }

      likes();

</script>

  </body>
</html>
