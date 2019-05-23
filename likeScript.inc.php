<script>
		$("a.like").on("click",function(e){
      var postId = $(this).data("id");
      var type = 1;
			var elLikes = $(this).siblings(".likes");
      var likes=elLikes.html();

			$.ajax({
  				method: "POST",
  				url: "ajax/postlike.php",
  				data: {postId: postId, type:type},
			})
  		
      .done(function (res) {
        try {
          var json_obj = JSON.parse(res);
          if(json_obj.status=="success"){
            //console.log('test1');
            likes++;
					  elLikes.text(likes);
            $("a.like."+postId).css("display","none");
            $("a.dislike."+postId).css("display","inline-block");
    
          }
        } catch (e) {
          //console.log('failed to parse');
        }
      })    
      .fail(function (jqXHR, textStatus) { 
        //console.log('failed') 
      });
      e.preventDefault();
			
    });
  </script>

  <script>
    $("a.dislike").on("click",function(e){
      var postId = $(this).data("id");
      var type = 0;
			var elLikes = $(this).siblings(".likes");
      var likes=elLikes.html();

			$.ajax({
  				method: "POST",
  				url: "ajax/postlike.php",
  				data: {postId: postId, type:type},
      })
      .done(function(res) {
        try {
          var json_obj = JSON.parse(res);
          if(json_obj.status=="success"){
            //console.log('test2');
            likes--;
					  elLikes.text(likes);
            $("a.dislike."+postId).css("display","none");
            $("a.like."+postId).css("display","inline-block");

          } 
        }catch (e) {
          //console.log('failed to parse 2');
        }
      })    
      .fail(function (jqXHR, textStatus) { 
        //console.log('failed 2') 
      });
      e.preventDefault();
      });
	</script>