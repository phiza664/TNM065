


//Load image feed from flickr
$( document ).ready(function() {


	
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=apple,banana&format=json&jsoncallback=?", function(data){
		$.each(data.items, function(i,item){
			if(i<6){
				var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");
				$("<img/>").attr("src", sourceSquare).attr("class", "small").appendTo(".small-images-container")
				.wrap("<a href='" + item.link + "'></a>").wrap("<div  class=\"small-image\"></div>").hide();
			}
			//alert(item);
			$(".small").fadeIn(1000);
		});
	});

	
	$(".small-images-container").click(function(){
	  $(".large-image-container").hide();
	}); 
	
});