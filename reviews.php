// Code for Reviews

<?php
include ('lib/sentiment_analyser.class.php');
$sa = new SentimentAnalysis();
$sa->initialize();

$name='bahubali';
$revr=$_POST['revr'];
$rev=$_POST['rev'];

$check = $sa->analyse($rev);
$scores = $sa->return_sentiment_rating();
$rating= $scores*2;
echo '
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
</style>
<body class="w3-light-grey">


<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1600px">



  <!-- Image header -->
  <header class="w3-display-container w3-wide" id="home">
    <img class="w3-image" src="p10.jpg" alt="Fashion Blog" width="1600" height="1060">
    <div class="w3-display-right w3-padding-large">
	
      <h1 class="w3-text-white ">Ratings4u</h1>
      <h1 class="w3-jumbo w3-text-white  w3-hide-small"><b>MOVIES</b></h1>
        </div>
  </header>

  <!-- Grid -->
  <div class="w3-row w3-padding w3-border">

    <!-- Blog entries -->
    <div >
    
      <!-- Blog entry -->
      <div class="w3-container w3-white w3-margin w3-padding-large">
        <div class="w3-center">
		
        </div>

        <div class="w3-justify">
		<p class="w3-clear"></p>
          <div class="w3-row w3-margin-bottom">
            <hr>
         ';
		
	$con = mysqli_connect('localhost','root','');
	mysqli_select_db($con,'rudb');
		 
	$sql = "SELECT * FROM products where name='".$name."'";
	$records = mysqli_query($con,$sql);
 while($row = mysqli_fetch_array($records))
  {
    $totrating=$row['rating'];	   
 }
		$sql1 = "SELECT * FROM reviews where name='".$name."'";
		$records1 = mysqli_query($con,$sql1);
	    $count=0;
  while($row1 = mysqli_fetch_array($records1))
  { 
    $count++;
  }
$totrating=($totrating+$rating)/($count+1);
		if(($rev!='')&&($revr!='')){
			$sql="INSERT INTO reviews VALUES('','".mysql_real_escape_string($name)."','".mysql_real_escape_string($revr)."','".mysql_real_escape_string($rev)."','".mysql_real_escape_string($rating)."');";
			$sql1="UPDATE products SET rating='".$totrating."' WHERE name='".$name."'";

		    
		if(mysqli_query($con,$sql)&&mysqli_query($con,$sql1))
			echo '<b><i><h3 class="w3-text-green w3-center">Your review for '.$name.' has been successfully submitted.</h3></i></b>';
		 else
			  echo '<b><i>Updation failed</i></b>';
		}


          echo'</div>
        </div>
      </div>
      <hr>

    
    </div>


  <!-- END GRID -->
  </div>

<!-- END w3-content -->
</div>



<!-- Footer -->
<footer class="w3-container w3-dark-grey" style="padding:32px">
  <a href="#" class="w3-button w3-black w3-padding-large w3-margin-bottom"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
 
</footer>

<script>


</script>

</body>
</html>';

?>
