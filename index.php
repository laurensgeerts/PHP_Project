<?php

include_once 'bootstrap.php';

$user = new User();
$user->setUser_id($_SESSION['user_id']);
$profile = $user->getUserInfo();

$target_dir = 'data/uploads/'; // zet in config

if (!empty($_POST)) {
    $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
    if (!empty($_POST['description'])) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $message = 'The file '.basename($_FILES['fileToUpload']['name']).' has been uploaded.';
            //  echo "<script type='text/javascript'>alert('$message');</script>";
            // zet potentieel in image classe bv Image::upload($file)

            $post = new Post();
            $post->setImage($target_dir.basename($_FILES['fileToUpload']['name']));
            $post->setCity($_POST['city']);
            $post->setLng($_POST['lng']);
            $post->setLat($_POST['lat']);
            $post->setHashtag1($_POST['hashtag1']);
            $post->setHashtag2($_POST['hashtag2']);
            $post->setHashtag3($_POST['hashtag3']);
            $post->setDescription($_POST['description']);
            $post->setUserId($_SESSION['user_id']);
            $post->newPost();
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'Please write a description';
    }
}
$posts = Post::getAll();



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" media="screen" href="css/reset.css">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" media="screen" href="css/CSSgram.css">
  <title>Inspiration Hunter</title>
</head>

<body onload="getLocation()">
  <div class="header">
    <div class="forceMiddle">
      <?php include_once 'nav.inc.php'; ?>
    </div>
  </div>
  <?php include_once("includes/error.inc.php"); ?>
  <div class="overlay" id="overlay">
    <div class="uploadWindow" id="uploadWindow">
      <a href="javascript:void(0)" class="closebtn" onclick="closeOverlay()"><img src="data/images/Asset 9.svg"></a>
      <form method="post" enctype="multipart/form-data">
        <p>Select image to upload:</p>
  	    <input type="file" name="fileToUpload" id="fileToUpload" value="upload picture"><br>
        <input type="text" name="description" id="description" placeholder="describe your picture"><br>    	  
        <p>add hashtags:</p>
        # <input type="text" name="hashtag1" id="hashtag1">
        #<input type="text" name="hashtag2" id="hashtag2">
        #<input type="text" name="hashtag3" id="hashtag3">

        <input type="hidden" name="city" id="city">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="lat" id="lat">

        <input type="submit" value="Upload Image" name="submit" value="submit">
      </form>
    </div>
  </div>
  <a class="openbtn" onclick="openOverlay()"><img src="data/images/Asset 3.svg"></a>
  <div class="forceMiddle">
    <div class="grid-container">
	    <?php foreach ($posts as $post): ?>
        <div class="post">
	        <article >
            <img src="<?php echo $post->picture; ?>" class="profilepic">
            <p> <?php echo $post->date_created; ?> </p>
            <p class="name"> <?php echo $post->firstname.' '.$post->lastname; ?> </p>
            <img src="<?php echo $post->image; ?>" alt="">
            <p> <?php echo $post->description; ?> </p>
            <p> <?php echo $post->city; ?> </p>
            <p> <?php echo $post->hashtag1. '  ' .$post->hashtag2. '  ' .$post->hashtag3;?> </p>
            <div>
              <a href="#" data-id="<?php echo $post->id ?>" class="like <?php echo $post->id ?>"><img src="data/images/Asset 6.svg"></a>  
              <a href="#" data-id="<?php echo $post->id ?>" class="dislike <?php echo $post->id ?>" style="display:none;"><img src="data/images/Asset 7.svg"></a>
              <span class='likes' data-id="<?php echo $post->id ?>"><?php echo $post->getLikes(); ?></span> people like this
            </div>
            <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
          </article>
        </div>
      <?php endforeach; ?>
    </div> 
  </div>

  <script
		src="http://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous">
  </script>

  <script>
    var x = document.getElementById("city");
    var lo = document.getElementById("lng");
    var la = document.getElementById("lat");
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      } 
    }

    function showPosition(position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
   
      getReverseGeocodingData(lat, lng);
    }  

    function getReverseGeocodingData(lat, lng) {
      var latlng = new google.maps.LatLng(lat, lng);
   
      lo.value = lng;
      la.value = lat;
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status !== google.maps.GeocoderStatus.OK) {
            alert(status);
        }
       
        if (status == google.maps.GeocoderStatus.OK) {
          console.log(results);
          var address_components = (results[0].address_components);
          for (var i = 0; i < address_components.length; i++) {
            if (address_components[i].types[0] === "locality") {
              var city = address_components[i].long_name;
              //console.log(city);
              x.value = city;
            }
          }
        }
      });
    }
  </script>

  <script>
    function openOverlay() {
      document.getElementById("overlay").style.height = "100%";
    }

    function closeOverlay() {
      document.getElementById("overlay").style.height = "0%";
    }
  </script>
  <script src="js/moreposts.js"></script>
  <?php include_once 'likeScript.inc.php'; ?>
</body>
</html>