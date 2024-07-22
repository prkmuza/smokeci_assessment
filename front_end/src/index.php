<?php include 'includes/head.php';?>



<main class="mdl-layout__content">



  <div class="site-content">

   <div class="container">

     <div class="mdl-grid site-max-width">

      <h3> 
        <text style="color:#1E3D79;">Home</text> &nbsp; <i class="fas fa-angle-right" style="    font-size: 18px;"></i> &nbsp; Phone number generator
      </h3>

      <div style="clear:both;"></div>

      <div class="cell_content_main"  style="border-bottom: solid 2px #1E3D79;">
       
          <div  >

            <h2 style='margin-bottom: 10px;'>Phone number generator</h2>


            <h3 style='margin-bottom: 10px;'> 
               Select a country code and the quantity of phone numbers you want to generate
            </h3>
			
          <form action=""  id="UploadMediaForm" name="UploadMediaForm" method="POST" enctype="multipart/form-data">
			
					<div class="text_container" style="border:solid 1px #B0B0B0;width:60px;height:48px;border-radius: 4px;margin-right:5px;float:left;"> 
					 <div id="ContactNumberCountryCodeText" style="cursor:pointer;color:#000000;height:11px;width:50px;background-color:#ffffff;position:absolute;margin-top: 23px;margin-left: 5px;" >
					   <b>+27</b>
					 </div>
					  <div class="selectDropDown" style="width:50px;float:left;top:-7px;margin-left: 5px;">
									<select id="country_code" name="country_code" class="select-textDropDown" required style="width:100%;float:left;padding: 7px 10px 5px 0;color: #000000;background-color: #ffffff;opacity:0;" onchange="UpdateContactNumberCountryCode();">
							<option value="+27xx_xZA">+27</option>
						  <?php
						  
							  include 'functions/countries.php';
								
								$KeysCountryArray = array_keys($countryArray);
								$KeyCounter = 0;
								foreach($countryArray as $IndividualCountryArray){
									
								  echo'
									<option value="+'.$IndividualCountryArray['code'].'xx_x'.$KeysCountryArray[$KeyCounter].'">+'.$IndividualCountryArray['code'].' - '.$IndividualCountryArray['name'].'</option>                                  
								  ';
								  $KeyCounter++;
								}

						  ?>
						</select>
						<span class="select-highlightDropDown"></span>
						<span class="select-barDropDown"></span>
						<label id="ContactNumberFlag" class="select-labelDropDown" style="top:10px;"><img src="SiteImages/flags/za.webp" style="margin: 0px 0px 0px;width:20px;"></label>
					</div>  
					   
					  <div style="clear:both;"> </div>

					</div>

					<div class="text_container" style="border:solid 1px #B0B0B0;width:130px;height:48px;border-radius: 4px;float:left;"> 
					   
					  <div style="height:100%;width:110px;"> 
						 <input id="quantity_amount" name="quantity_amount" class="text_item" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" placeholder="Enter Quantity..." style="width:110px;"> 
					  </div>

					  <div style="clear:both;"> </div>

					</div>
					
					<div id="BtnUploadData" style="float:left;margin-top: 3px;margin-left: 5px;" onclick="SubmitData();">
					  <div class="btn_Main" style="height:45px;width:90px;"> 
						  <text class="btn_Main_text" style="line-height: 43px;"> 
							Generate
						  </text>  
					  </div>
					</div>

					<div id="BtnViewData" style="float:left;margin-top: 3px;margin-left: 15px;" onclick="ViewData();">
					  <div class="btn_Main" style="height:45px;width:130px;background: #fff;border:solid 1px #000;"> 
						  <text class="btn_Main_text" style="line-height: 43px;color:#000;"> 
							View Saved Data
						  </text>  
					  </div>
					</div>
					
					</br>
					<div style="clear: both;"> 	
					
                    <div id="UploadFormResponse" style="padding:10px;background-color:#fff;border-radius:5px;color:#000;margin:0 auto;width:100%;text-align:center;display:none;">
                        ...
                    </div>
					

             </form>
					
					
			<div style="clear: both;"> 		
					
          </div> 


           
           
        </div> 

      </div>

    </div>


</div>

        </div>

          <?php include 'includes/foot.php';?>

      <script>
                $(document).ready(function () {

                  $('.text_item').focus(function() {
                      $(this).css('border', 'none'); // Remove input border
                      $(this).closest('.text_container').css('border', '1px solid #1E3D79'); // Highlight container
                  }).blur(function() {
                      $(this).css('border', 'none'); // Remove input border on blur
                      $(this).closest('.text_container').css('border', 'solid 1px #B0B0B0'); // Reset container border
                  });

				    
			        $('.mobi_link').click(function() {
			            $('.mdl-layout__obfuscator').trigger('click'); // Simulate click
			        });
				   

                });

				function UpdateContactNumberCountryCode(){
					var country_code = $("#country_code").val();
					var country_codeArray = country_code.split("xx_x");
					var DialingCode = country_codeArray[0];
					var CountryCode = country_codeArray[1];
						CountryCode = CountryCode.toLowerCase();
					
					$("#ContactNumberCountryCodeText").html("<b>"+DialingCode+"</b>");
					
					$("#ContactNumberFlag").html('<img src="SiteImages/flags/'+CountryCode+'.webp" style="margin: 0px 0px 0px;width:20px;">');
					
				}

				function SubmitData(){  

	               $(".btn_Main").hide();
				   $("#UploadFormResponse").show();
				   $("#UploadFormResponse").html('<img src="SiteImages/loading.gif" height="30px">Working....');    

				 var quantity_amount= $("#quantity_amount").val();
				 var country_code = $("#country_code").val();
 
                  //prep country code for giggsey\libphonenumber\ as it does not like the +
					if (country_code.startsWith('+')) {
					    country_code = country_code.substring(1); // Using substring
					    // country_code = country_code.slice(1); // Using slice
					}

					// Split the country_code string using 'xx_x' as the delimiter
					var country_codeArray = country_code.split('xx_x');
					var country_code_number = country_codeArray[0]; 
					var country_code_string = country_codeArray[1]; 		

				 if(!quantity_amount){
					$("#UploadFormResponse").show();
					$(".btn_Main").show();
					$("#UploadFormResponse").html('Please enter a quantity...');

				 }else{

	                  var xhttp5 = new XMLHttpRequest();
					    xhttp5.onreadystatechange = function() {
					    if (xhttp5.readyState == 4 && xhttp5.status == 200) {

							var responseText = xhttp5.responseText;

						    // Parse the JSON response
						    var responseObj = JSON.parse(responseText);
						    var phoneNumbers = responseObj.phoneNumbers;
						    var validStatusCounter = 0;
						    var invalidStatusCounter = 0;

						    // Clear previous content
						    $("#UploadFormResponse").empty();

						// Iterate over each phone number object
						phoneNumbers.forEach(function(phoneNumber) {
						// Construct HTML for displaying phone number details
						    var phoneNumberHTML = '<div class="phone-number-item">';

								phoneNumberHTML += '<div ><b>Phone Number:</b> ' + phoneNumber.phone_number + '</div>';

								if(phoneNumber.status=='valid'){
								   var statusColor="green";
								   validStatusCounter++;
								}else{
									var statusColor="red";
									invalidStatusCounter++;
								}

								phoneNumberHTML += '<div ><b>Status:</b> <b style="color:'+statusColor+';">' + phoneNumber.status + '</b></div>';

								phoneNumberHTML += '<div ><b>Country Code:</b> ' + phoneNumber.country_code_number + ' (' + phoneNumber.country_code_string + ')</div>';

								phoneNumberHTML += '<div ><b>Type:</b> ' + phoneNumber.phone_number_type + '</div>';

						    phoneNumberHTML += '</div>';

						// Append HTML to UploadFormResponse div
						$("#UploadFormResponse").append(phoneNumberHTML);
						});

						$('#UploadFormResponse').prepend("<h3 style='margin-bottom:0px;'>Valid Numbers: <text style='color:green;margin-right: 10px; padding-right: 10px;border-right: solid 2px #000;'>"+validStatusCounter+"</text> InValid Numbers: <text style='color:red;'>"+invalidStatusCounter+"</text></h3></br>");

						    $("#UploadFormResponse").append('<div style="clear:both;"></div>');

				            $(".btn_Main").show();
				            $("#quantity_amount").val('');

				        }else if (xhttp5.readyState == 4 && xhttp5.status == 500) {
				            $(".btn_Main").show();
				            var responseText = xhttp5.responseText;
				            $("#UploadFormResponse").html(responseText);
				            $("#quantity_amount").val('');

				        }

					  };
					  xhttp5.open("GET", "http://localhost:9000/api/validate-phone-numbers/"+country_code_number+"/"+country_code_string+"/"+quantity_amount, true);
					  xhttp5.send();

				  }

				}

				function ViewData(){

	               $(".btn_Main").hide();
				   $("#UploadFormResponse").show();
				   $("#UploadFormResponse").html('<img src="SiteImages/loading.gif" height="30px">Working....');  

	                  var xhttp4 = new XMLHttpRequest();
					    xhttp4.onreadystatechange = function() {
					    if (xhttp4.readyState == 4 && xhttp4.status == 200) {

							var responseText = xhttp4.responseText;

						    // Parse JSON response
						    var phoneNumbers = JSON.parse(responseText);

						    // Variable to store HTML content
						    var htmlContent = '';

						    // Iterate through each phone number object
				    phoneNumbers.forEach(function(number) {
						        // Construct HTML for each phone number
						 htmlContent += '<div id="db_item_'+ number._id.$oid+'" class="all-phone-number-item">';
						        htmlContent += '<div id="delete_confirm_query'+ number._id.$oid+'" style="display:none;"></div>';

                            htmlContent += '<div id="db_content_'+ number._id.$oid+'">';

						        htmlContent += '<div><img src="/SiteImages/close.png" style="height:20px;width:20px;float:right;cursor:pointer;" onclick="IniDeleteNumber(\''+ number._id.$oid+'\');"></div>';
						        htmlContent += '<div style="clear:both;"></div>';
						        htmlContent += '<div><b>ID:</b> ' + number._id.$oid + '</div>';
						        htmlContent += '<div><b>Phone Number:</b> ' + number.phone_number + '</div>';
						        htmlContent += '<div><b>Status:</b> ' + number.status + '</div>';
						        htmlContent += '<div><b>Country Code:</b> ' + number.country_code_string + ' (' + number.country_code_number + ')</div>';
						        htmlContent += '<div><b>Type:</b> ' + number.phone_number_type + '</div>';
						        htmlContent += '<div><b>Created At:</b> ' + number.created_at + '</div>';

                            htmlContent += '</div>';
						        
						  htmlContent += '</div>';
					 });

						    // Update the UploadFormResponse div with the HTML content
						    document.getElementById('UploadFormResponse').innerHTML = htmlContent;
						    $("#UploadFormResponse").append('<div style="clear:both;"></div>');

				            $(".btn_Main").show();
				            $("#quantity_amount").val('');

				        }else if (xhttp4.readyState == 4 && xhttp4.status == 500) {
				            $(".btn_Main").show();
				            var responseText = xhttp4.responseText;
				            $("#UploadFormResponse").html(responseText);
				            $("#quantity_amount").val('');

				        }

					  };
					  xhttp4.open("GET", "http://localhost:9000/api/get-all-numbers", true);
					  xhttp4.send();

				}


				function IniDeleteNumber(mongoDBID){

                     $("#delete_confirm_query"+mongoDBID).show();

                     $("#delete_confirm_query"+mongoDBID).html('Are you sure you want to delete this phone number from Database?</br><div style="clear:both;"></div>'+
                     	'<div style="float:left;margin-top: 3px;margin-left: 5px;" > <div class="btn_Main_query" onclick="confirmDeleteNumber(\''+mongoDBID+'\');"> <text class="btn_Main_text_query" > Yes </text> </div> </div>'+
                     	'<div style="float:left;margin-top: 3px;margin-left: 5px;" > <div class="btn_Main_query" onclick="cancelDeleteNumber(\''+mongoDBID+'\');"> <text class="btn_Main_text_query" > No </text> </div> </div>');

                     $("#db_content_"+mongoDBID).hide();
				}

				function cancelDeleteNumber(mongoDBID){

                     $("#delete_confirm_query"+mongoDBID).hide();

                     $("#delete_confirm_query"+mongoDBID).html('');
                     
                     $("#db_content_"+mongoDBID).show();

				}

				function confirmDeleteNumber(mongoDBID){


				    $("#delete_confirm_query"+mongoDBID).html('<img src="SiteImages/loading.gif" height="30px">Working....');  

	                  var xhttp3 = new XMLHttpRequest();
					    xhttp3.onreadystatechange = function() {
					    if (xhttp3.readyState == 4 && xhttp3.status == 200) {

                            $("#delete_confirm_query"+mongoDBID).html('&#9989;&#x2705; Delete Successfull...'); 
				            $("#db_item_"+mongoDBID).hide(4000);

				        }else if (xhttp3.readyState == 4 && xhttp3.status == 500) {

				            var responseText = xhttp3.responseText;
                            $("#delete_confirm_query"+mongoDBID).html(responseText);
                            $("#db_content_"+mongoDBID).show();

				        }

					  };
					  xhttp3.open("GET", "http://localhost:9000/api/confirm-delete-number/"+mongoDBID, true);
					  xhttp3.send();

				}
				
				
      </script>