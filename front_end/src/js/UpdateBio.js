 function UpdateBioMain(){
                $(function(e) {

	var working = false;
	
	$("#UpdateBio").submit(function(e) {		
	
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;
		$('.error').remove();
		$("#loadingBioU").show();
		//post it up for validation...
        $.post('../UserFunctions/UpdateBio.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingBioU").hide();
				 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("MainContent").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "../MainContent/Profile.php", true);
  xhttp.send();
				
			}
			
			else{
			$("#loadingBioU").hide();
			
			}
		}, 'json');
    });
});
                
            }