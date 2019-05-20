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
  <title>Inspiration Hunter</title>
</head>
<body onload="getLocation()">



  <?php include_once 'nav.inc.php'; ?>
  <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
  <form method="post" enctype="multipart/form-data">
    	Select image to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload" value="upload picture">
      <input type="text" name="description" id="description" placeholder="describe your picture">
      <input type="hidden" name="city" id="city">
      <input type="hidden" name="lng" id="lng">
            <input type="hidden" name="lat" id="lat">
 
     
    	<input type="submit" value="Upload Image" name="submit" value="submit">
  </form>
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
          <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
        </article>
        </div>
    <?php endforeach; ?>
    
  </div> 

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJdC938sjnGDKKf1fq5N060TkvFfdAhgk"
  type="text/javascript"></script>

 
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


</body>
</html>