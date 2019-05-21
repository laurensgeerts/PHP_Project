<?php


include_once 'bootstrap.php';
include_once 'classes/search.class.php';



if(!empty($_POST)){


  if (!empty($_POST['searchPost'])){


   
    $res_post = Search::searchPost(htmlspecialchars($_POST['searchPost']));
     $message = "zoeken geslaagd. ✅";
   
  }
  
  else 
  {
    $error = "Er is iets fout gegaan. Sorry! 🆘";
  }
  
  if (!empty($_POST['city'])){
  
  
  if($res_geo = Search::searchLocation(htmlspecialchars($_POST['lng']),htmlspecialchars($_POST['lat']))){
    $message = "zoeken geslaagd. ✅";
  }

  else

  {
    $error = "Er is iets fout gegaan. Sorry! 🆘";
  }

   //$latt = floatval($_POST['lat']);
    //$long = floatval($_POST['lng']);
    
  
  //var_dump($res_geo);
    //var_dump(floatval($_POST['lat']));
    //var_dump(floatval($_POST['lat'])
  
  }

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" media="screen" href="css/CSSgram.css">
  <title>Inspiration Hunter</title>
</head>
<body onload="getLocation()">

<?php include_once("nav.inc.php"); ?>



<div class="searchwindow" >

<h1>ZOEKEN</h1>

<?php if(isset($error)): ?>
        <div class="error"><p><?php echo $error; ?></p></div>
    <?php endif; ?>

<div class="forceMiddle">
    <div class="grid-containerJ">
    <form action="" method="post" id="form">
    <input type="text" name="searchPost" placeholder=" zoek hier naar een post " />
    
    <input type="submit" value="Search" name="submit_search" id="submit">
</form>


<form action="" method="post" id="form2">
<input type="text" id= "city" name="city"placeholder=" zoek hier naar een locatie ">
<input   id="lng" name="lng" type="hidden">
  <input  id="lat" name="lat"type="hidden">
  <input id="btn" type="button" value="1. confirm location" />


 <input type="submit" value="2. Search for city" name="submit_search" id="submit">


  </form>

  <?php if(isset($message)): ?>
        <div class="message"><p><?php echo $message; ?></p></div>
    <?php endif; ?>

    </div>
  
<div class="searchmargin">

<?php foreach ($res_post as $res): ?>
    <div class="grid-container color" >
      <div class="post color" >
	      <article >
          <img src="<?php echo $res->picture; ?>" class="profilepic">
          <p> <?php echo $res->firstname.' '.$res->lastname; ?> </p>
          <p> <?php echo $res->date_created; ?> </p>
          <p> <?php echo $res->city; ?> </p>
          <img src="<?php echo $res->image; ?>" alt="">
          <p> <?php echo $res->description; ?> </p>
          <p> <?php echo $res->hashtag1. '  ' .$res->hashtag2. ' ' .$res->hashtag3;?> </p>
          <a href="detail.php?id=<?php echo $res->id; ?>">More</a>
          
        </article>
      </div>
    </div>  
  <?php endforeach; ?>





<?php foreach ($res_geo as $geo): ?>
    <div class="grid-container">
      <div class="post">
	      <article >
          <img src="<?php echo $geo->picture; ?>" class="profilepic">
          <p> <?php echo $geo->firstname.' '.$geo->lastname; ?> </p>
          <p> <?php echo $geo->date_created; ?> </p>
          <p> <?php echo $geo->city; ?> </p>
          <img src="<?php echo $geo->image; ?>" alt="">
          <p> <?php echo $geo->description; ?> </p>
          <p> <?php echo $geo->hashtag1. '  ' .$geo->hashtag2. '  ' .$geo->hashtag3;?> </p>
          <a href="detail.php?id=<?php echo $geo->id; ?>">More</a>
        
          
        </article>
      </div>
    </div>  
  <?php endforeach; ?>
  

</div>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJdC938sjnGDKKf1fq5N060TkvFfdAhgk"
  type="text/javascript"></script>

  <script type="text/javascript">

var lat = document.getElementById("lng");
var lng = document.getElementById("lat");

function getLocation(){
$("#btn").click(function(){

  

            var geocoder =  new google.maps.Geocoder();
    geocoder.geocode( { 'address': $('#city').val()}, function(results, status) {

      
          if (status == google.maps.GeocoderStatus.OK) {

        var x = results[0].geometry.location.lat();
        var y = results[0].geometry.location.lng();

        lat.value = x;
        lng.value = y;

  
        
           
        console.log(y);

          // $('.push-down').text("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
       } else {
        innerHTML = "something went wrong";
          }


        });

        
});


}
 </script>



</body>
</html>