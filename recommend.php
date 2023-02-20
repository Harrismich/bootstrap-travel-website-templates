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
  $buffer = $buffer. "visited( '" . $row['first_name']. "' , '" . $row['name'] . "' , " . $row['choice_id'] . " ). ";
  
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
//buffer+="has('Αννα',kids).";
buffer+="has('Georg','kids').";
buffer+="recommendation(X,Y,L):-has(X,W),has(Y,W),visited(Y,L,I),X\\=Y.";
alert(buffer); 
var session;
var counting_index;
var places=new Array();

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
        success:
        return function (answer) {
    
        if (pl.type.is_substitution(answer)) {
      
          var p1 = answer.lookup("Y");
          var p2 = answer.lookup("L");
          places[counting_index] = p2; 
          counting_index++;
          alert( p1 + "-" + p2+ "-" + places[counting_index-1]);
    }
    else {
      //alert('first recommendation is '+places[0]);
      var rec_text="";
      for(i=0;i<counting_index;i++){ 
        rec_text+= "System recommends "+places[i] +"<br>";
      }
      alert(rec_text);
      document.getElementById("recommendations").innerHTML=rec_text;
       }
  }
}



// function show() {
//         alert("got into show");
//         return function (answer) {
    
//         if (pl.type.is_substitution(answer)) {
      
//           var p1 = answer.lookup("K");
//           var p2 = answer.lookup("L");
//           places[counting_index] = p1; 
//           counting_index++;
//           alert( p1 + "-" + p2+ "-" + places[counting_index-1]);
//     }
//   }
// }

      // Show the likes of a person
      function likes() {
        alert("buffer="+buffer);
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
        alert("likes3 activated");
        counting_index=0;
        var my_query="recommendation('"+usr+"', Y, L).";
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
<hr>
<div id="recommendations">initially empty</div>
<hr>

<script>likes3("Georg");</script>

</body>
</html>
