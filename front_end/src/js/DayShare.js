function satShare(){
                $(function(e) {

	var working = false;
	
	$("#satShareF").submit(function(e) {		
	$("#loadingProfilesat").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/satShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilesat").hide();
				document.getElementById("ConfirmSavesat").style.display = "block";
				document.getElementById("ConfirmSavesat").style.marginLeft = "90px";
				$("#ConfirmSavesat").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('satShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatesatShareInfo.php', true);
		xmlhttp.send();
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }

function sunShare(){
                $(function(e) {

	var working = false;
	
	$("#sunShareF").submit(function(e) {		
	$("#loadingProfilesun").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/sunShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilesun").hide();
				document.getElementById("ConfirmSavesun").style.display = "block";
				document.getElementById("ConfirmSavesun").style.marginLeft = "90px";
				$("#ConfirmSavesun").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('sunShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatesunShareInfo.php', true);
		xmlhttp.send();
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }
			
 function monShare(){
                $(function(e) {

	var working = false;
	
	$("#monShareF").submit(function(e) {		
	$("#loadingProfilemon").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/monShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilemon").hide();
				document.getElementById("ConfirmSavemon").style.display = "block";
				document.getElementById("ConfirmSavemon").style.marginLeft = "90px";
				$("#ConfirmSavemon").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('monShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatemonShareInfo.php', true);
		xmlhttp.send();
		
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }
			
function tueShare(){
                $(function(e) {

	var working = false;
	
	$("#tueShareF").submit(function(e) {		
	$("#loadingProfiletue").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/tueShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfiletue").hide();
				document.getElementById("ConfirmSavetue").style.display = "block";
				document.getElementById("ConfirmSavetue").style.marginLeft = "90px";
				$("#ConfirmSavetue").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('tueShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatetueShareInfo.php', true);
		xmlhttp.send();
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }
			
function wedShare(){
                $(function(e) {

	var working = false;
	
	$("#wedShareF").submit(function(e) {		
	$("#loadingProfilewed").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/wedShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilewed").hide();
				document.getElementById("ConfirmSavewed").style.display = "block";
				document.getElementById("ConfirmSavewed").style.marginLeft = "90px";
				$("#ConfirmSavewed").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('wedShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatewedShareInfo.php', true);
		xmlhttp.send();
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }
			
function thuShare(){
                $(function(e) {

	var working = false;
	
	$("#thuShareF").submit(function(e) {		
	$("#loadingProfilethu").show();
		//prevent the default of form submission...
		e.preventDefault();	
		
		if (working) return false;
		working = true;

		//post it up for validation...
        $.post('../DayFunctions/thuShare.php', $(this).serialize(), function(msg)
		{
			working = false;
			//if a message in status comes back (status will be 1), then great...callback function to tell them to check their email and activate their account...
			if (msg.status)
			{//if it has worked, then redirect the person back to the place they were..
				$("#loadingProfilethu").hide();
				document.getElementById("ConfirmSavethu").style.display = "block";
				document.getElementById("ConfirmSavethu").style.marginLeft = "90px";
				$("#ConfirmSavethu").delay().hide(5000);
				
				if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}else {
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function (){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('thuShareInfo').innerHTML =xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'UpdatethuShareInfo.php', true);
		xmlhttp.send();
			}
			
			else{
			
			
			}
		}, 'json');
    });
});
                
            }