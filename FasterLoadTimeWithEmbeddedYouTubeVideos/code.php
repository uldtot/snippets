<div class="wcioYouTubeVideoContainer" data-id="2lAe1cqCOXo" data-width="350" data-height="283">
<img src="https://img.youtube.com/vi/2lAe1cqCOXo/0.jpg">
</div>

<script type="text/javascript">
jQuery(function($) {

    jQuery('.wcioYouTubeVideoContainer').click(function(){
        wcioYoutubeSwap( $(this) );
    });

    function wcioYoutubeSwap( thisObj ) {
      var youtubeId = thisObj.data("id");
      var videoWidth = thisObj.data("width");
      var videoHeight = thisObj.data("height");

      $(thisObj).toggleClass('changed');

      thisObj.html('<iframe width="'+videoWidth+'" height="'+videoHeight+'" src="https://www.youtube.com/embed/'+youtubeId+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

      console.log(youtubeId);
            console.log(videoWidth);
            console.log(videoHeight);
    }

});

</script>

<style>
.wcioYouTubeVideoContainer {
   cursor:pointer
}

.wcioYouTubeVideoContainer::after {
content: " ";
background: url(https://websitecare.io/wp-content/uploads/playbutton.png);
width: 68px;
height: 48px;
position: absolute;
left: 0;
right: 0;
margin: 0px auto;
top: 62%;
}

.wcioYouTubeVideoContainer.changed::after {
background: none;
}
</style>
