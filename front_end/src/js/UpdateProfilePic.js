 function SaveProfilePic(){
                $(function(e) {

	var working = false;
	
	$("#PotentialProfilePicForm").submit(function(e) {		
	$("#loadingProfilePicU").show();
	$("#Errmsg").hide();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;
		$('.error').remove();
		
		//post it up for validation...
        $.post('../UserFunctions/UpdateProfilePic.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilePicU").hide();
				window.location.replace("index.php");
			}
			
			else{
			$("#loadingProfilePicU").hide();
			$("#Errmsg").show();
				
			}
		}, 'json');
    });
});
                
            }