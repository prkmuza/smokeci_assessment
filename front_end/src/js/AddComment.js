function AddCommentMain(x,y){
                $(function(e) {

	var working = false;
	
	$("#AddCommentForm").submit(function(e) {		
	
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;
		$('.error').remove();
		$("#loadingComment").show();
		//post it up for validation...
        $.post('../UserFunctions/AddComment.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingComment").hide();
				 var xhttp18 = new XMLHttpRequest();
  xhttp18.onreadystatechange = function() {
    if (xhttp18.readyState == 4 && xhttp18.status == 200) {
     document.getElementById("ViewMediaComments").innerHTML = xhttp18.responseText;
    }
  };
  xhttp18.open("GET", "../UserFunctions/ViewMediaComments.php?mediaID="+x+"&uid="+y, true);
  xhttp18.send(); 

				
			}
			
			else{
			$("#loadingComment").hide();
			
			}
		}, 'json');
    });
});
                
            }