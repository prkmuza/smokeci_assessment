(function(){
	 var    canvas = document.getElementById('canvas'),
	       context = canvas.getContext('2d'),
	       video = document.getElementById('video'),
		  vendorUrl = window.URL || window.webkitURL;
		  
		  navigator.gettMedia = navigator.getUserMedia ||
		                       navigator.webkitGetUserMedia ||
		                       navigator.mozGetUserMedia ||
							   navigator.msGetUserMedia;
							   
		navigator.gettMedia({
			video:true,
			audio: false
		}, function (stream){
			video.src = vendorUrl.createObjectURL(stream);
			video.play();
		},function(error){
			
		});	
		
		
		 document.getElementById("snapButton").addEventListener("click", function() {
			 document.getElementById("snapButton").style.display = "none";
			 document.getElementById("snapButtonload").style.display = "block";
	     context.drawImage(video, 0, 0, 590, 450);

		 	
	var canvass = document.getElementById('canvas');
	
	//Send Image to server and DB
	     	 jQuery.ajax({
     url: '../DayFunctions/DaysPhotoUpload.php',
     type: 'POST',
     data: {
         data: canvass.toDataURL('image/jpeg')
     },
     complete: function(data, status)
     {
         if(status=='success')
         {
            //reload days page
             location.reload();
         }
         
     }

 });
 
 
         });

})();