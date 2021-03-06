<?php
include_once 'bootstrap.php';

if ($_SESSION['loggedin'] === false) {
  header('Location: login.php');
}

$user = new User();
$user_id = $_SESSION['user_id']; 
$following = $_SESSION['user_id'];
$profile = $user->getUserInfo($user_id);

$target_dir = 'data/uploads/'; // zet in config

if (!empty($_POST)) {
    $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
    if (!empty($_POST['description'])) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $message = 'The file '.basename($_FILES['fileToUpload']['name']).' has been uploaded.';
            //echo "<script type='text/javascript'>alert('$message');</script>";
            // zet potentieel in image classe bv Image::upload($file)

            $post = new Post();
            $post->setImage($target_dir.basename($_FILES['fileToUpload']['name']));
            $post->setCity(htmlspecialchars( $_POST['city']));
            $post->setLng(htmlspecialchars($_POST['lng']));
            $post->setLat(htmlspecialchars($_POST['lat']));
            $post->setHashtag1(htmlspecialchars($_POST['hashtag1']));
            $post->setHashtag2(htmlspecialchars($_POST['hashtag2']));
            $post->setHashtag3(htmlspecialchars($_POST['hashtag3']));
            $post->setDescription(htmlspecialchars($_POST['description']));
            $post->setUserId($_SESSION['user_id']);
            $post->newPost();
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'Please write a description';
    }
}
$posts = Post::getAll($following, 28, 0);



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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJdC938sjnGDKKf1fq5N060TkvFfdAhgk" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script
		src="http://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous">
  </script>
  
</head>

<body onload="getLocation()">
  <div class="header">
    <div class="forceMiddle">
      <?php include_once 'nav.inc.php'; ?>
    </div>
  </div>
  
  <div class="overlay" id="overlay">
    <div class="uploadWindow" id="uploadWindow">
      <a href="javascript:void(0)" class="closebtn" onclick="closeOverlay()"><img src="data/images/Asset 9.svg"></a>
      <form method="post" enctype="multipart/form-data">
        <p>Select image to upload:</p>
        <!--  preview()-->
        <input type="file" name="fileToUpload" id="fileToUpload" value="upload picture" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])" ><br>
        <img src="#" id="preview">
        <input type="text" name="description" id="description" placeholder="describe your picture"><br>    	  
        <p>add hashtags:</p>
        <input type="text" name="hashtag1" id="hashtag1" class="hashtag"value="#" >
        <input type="text" name="hashtag2" id="hashtag2" class="hashtag"value="#" >
        <input type="text" name="hashtag3" id="hashtag3"class="hashtag"value="#"  >

        <!-- <p>add filter:</p> -->
        <!-- <div class="filterBox"> -->
          <!-- <div>
            <img src="#" class="filters aden">
            <p>Aden</p>
          </div>
          <div>
            <img src="#" class="filters inkwell" >
            <p>Inkwell</p>
          </div> -->
          <!-- <div>
            <img src="#" id="preview" class="perpetua">
            <p>Perpetua</p>
          </div>
          <div>
            <img src="#" id="preview" class="reyes">
            <p>Reyes</p>
          </div>
          <div>
            <img src="#" id="preview" class="gingham">
            <p>Gingham</p>
          </div>
          <div>
            <img src="#" id="preview" class="toaster">
            <p>Toaster</p>
          </div>
          <div>
            <img src="#" id="preview" class="walden">
            <p>Walden</p>
          </div>
          <div>
            <img src="#" id="preview" class="hudson">
            <p>Hudson</p>
          </div> -->
        <!-- </div> -->

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
      <?php foreach ($posts as $post): 
        $time_post = $post->date_created;
        $time_post_str = strtotime($time_post);?>
        <div class="post">
	        <article >
            <div class="userOfPost">
              <img src="<?php echo $post->picture; ?>" class="profilepic">
              <p class="name"><a href="profile.php?id=<?php echo  $post->user_id  ?>"> <?php echo $post->firstname.' '.$post->lastname; ?></a> </p>
              <p class="date"> <?php echo $convertedTime = Post::timeConverter($time_post_str); ?> </p>
            </div>
            <img src="<?php echo $post->image; ?>" alt="">
            <p> <?php echo $post->description; ?> </p>
            <p> <?php echo $post->city; ?> </p>
            <p> <?php echo $post->hashtag1. '  ' .$post->hashtag2. '  ' .$post->hashtag3;?> </p>
            <div>
              <?php if(Post::checkLike($post->id, $_SESSION['user_id'])==0) { ?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'"><img src="data/images/Asset 6.svg"></a>'?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" style="display:none;"><img src="data/images/Asset 7.svg"></a>'?>
              <?php } else if(Post::checkLike($post->id, $_SESSION['user_id'])==1) {?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="like '.$post->id.'" style="display:none;"><img src="data/images/Asset 6.svg"></a>'?>
                <?php echo '<a href="#" data-id="'.$post->id.'" class="dislike '.$post->id.'" ><img src="data/images/Asset 7.svg"></a>' ?>
              <?php }?>
              <span class='likes' data-id="<?php echo $post->id ?>"><?php echo Post::getLikes($post->id); ?></span> people like this
            </div>
            <a href="detail.php?id=<?php echo $post->id; ?>">More</a>
            <a href="delete.php?id=<?php echo $post->id; ?>">delete post</a>
            <a href="edit_post.php?post_id=<?php echo $post->id; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">edit post</a>


          </article>
        </div>
      <?php endforeach; ?>
      </div> 
      <input type="hidden" id="start" value="3">
      <input type="hidden" id="end" value="3">
      <input type="hidden" id="ids" value="<?php echo $following; ?>">
      <button class="loadmore"> Load more </button>
    
  </div>

  <!-- <script>
    function preview(){
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.preview').attr('src', e.target.result);
          $('.filters').attr('src', e.target.result);
        }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#fileToUpload").change(function() {
    readURL(this);
  });
  </script> -->

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