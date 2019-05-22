<?php


include_once 'bootstrap.php';
include_once 'classes/search.class.php';



if(!empty($_POST)){


  if (!empty($_POST['searchPost'])){


   
    $res_post = Search::searchPost(htmlspecialchars($_POST['searchPost']));
     $message = "Zoeken geslaagd. ✅";
   
  }
  
  else 
  {
    $error = "Vul eerst iets in. 🔍";
  }
  
  if (!empty($_POST['city'])){
  
  
  if($res_geo = Search::searchLocation(htmlspecialchars($_POST['lng']),htmlspecialchars($_POST['lat']))){
    $message = "Zoeken geslaagd. ✅";
  }

  else

  {
    $error = "Vul eerst iets in. 🔍";
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
    <link rel="stylesheet" media="screen" href="css/CSSgram.css">
    <title>Inspiration Hunter</title>
  </head>
<body onload="getLocation()">
  <?php include_once("nav.inc.php"); ?><div class="header">
    <div class="forceMiddle">
      <?php include_once 'nav.inc.php'; ?>
    </div>
  </div>
  <div class="searchwindow" >
    <h1>ZOEKEN</h1>
      <?php if(isset($error)): ?>
        <div class="error"><p><?php echo $error; ?></p></div>
      <?php endif; ?>

      <?php if(isset($message)): ?>
        <div class="message"><p><?php echo $message; ?></p></div>
      <?php endif; ?>

    <div class="forceMiddle">
      <div class="grid-containerJ">
        <form action="" method="post" id="form">
          <input type="text" name="searchPost" placeholder=" Zoek hier naar een post. " />
          <input type="submit" value="Zoeken op posts." name="submit_search" id="submit">
        </form>
        <form action="" method="post" id="form2">
          <input type="text" id= "city" name="city"placeholder=" zoek hier naar een locatie ">
          <input   id="lng" name="lng" type="hidden">
          <input  id="lat" name="lat"type="hidden">
          <input id="btn" type="button" value="1. Bevestig eerst de locatie. " />
          <input type="submit" value="2. Zoek nu op een locatie. " name="submit_search" >
        </form>
      </div>
      <div class="searchmargin">
        <?php foreach ($res_post as $post): ?>
          <div class="grid-container color" >
            <div class="post color" >
	          <article >
              <article >
                <div class="userOfPost">
                  <img src="<?php echo $post->picture; ?>" class="profilepic">
                  <p class="name"><a href="profile.php?id=<?php echo  $post->user_id  ?>"> <?php echo $post->firstname.' '.$post->lastname; ?></a> </p>
                  <p class="date"> <?php echo $post->date_created; ?> </p>
                </div>
                <img src="<?php echo $post->image; ?>" alt="">
                <p> <?php echo $post->description; ?> </p>
                <p> <?php echo $post->city; ?> </p>
                <p> <?php echo $post->hashtag1. '  ' .$post->hashtag2. '  ' .$post->hashtag3;?> </p>
       
                <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
                <a href="delete.php?id=<?php echo $post->id; ?>">delete post</a>
                <a href="edit_post.php?post_id=<?php echo $post->id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">edit post</a>
              </article>
            </article>
            </div>
          </div>  
        <?php endforeach; ?>

        <?php foreach ($res_geo as $post): ?>
          <div class="grid-container">
            <div class="post">
	            <article >
                <div class="userOfPost">
                  <img src="<?php echo $post->picture; ?>" class="profilepic">
                  <p class="name"><a href="profile.php?id=<?php echo  $post->user_id  ?>"> <?php echo $post->firstname.' '.$post->lastname; ?></a> </p>
                  <p class="date"> <?php echo $post->date_created; ?> </p>
                </div>
                <img src="<?php echo $post->image; ?>" alt="">
                <p> <?php echo $post->description; ?> </p>
                <p> <?php echo $post->city; ?> </p>
                <p> <?php echo $post->hashtag1. '  ' .$post->hashtag2. '  ' .$post->hashtag3;?> </p>
           
                <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
                <a href="delete.php?id=<?php echo $post->id; ?>">delete post</a>
                <a href="edit_post.php?post_id=<?php echo $post->id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">edit post</a>
              </article>
            </div>
          </div>  
        <?php endforeach; ?>
      </div>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJdC938sjnGDKKf1fq5N060TkvFfdAhgk" type="text/javascript"></script>

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