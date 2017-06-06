
<div style="float:left; width:45%;   position:relative;">
		<div onclick="if($('#fullMapBlock').is(':visible')){ $('#fullMapBlock').slideUp(300); $('#fullClientBlock').slideUp(300); }else{ $('#fullMapBlock').slideDown(300); $('#fullClientBlock').slideDown(300); } " style="font-size:13px; text-transform:uppercase; padding:15px; cursor:pointer;  background-color:#7A8CA2; font-weight:bold; color:#ffffff; height:15px; overflow:hidden;">
			<div onclick="event.stopPropagation(); $('#mapContainer').fadeIn(500);" style="font-weight:bold; cursor:pointer; float:left;">MAP</div>
			<div onclick="event.stopPropagation(); $('#mapContainer').fadeOut(500);" style="float:left; color:#2B363C; cursor:pointer; text-decoration:underline; margin-left:10px; text-transform:none; cursor:pointer;">Vehicle</div>
			<div style="float:right; font-weight:bold; margin-left:10px"><?=trim($quote->distFromCity)?>,<?=$quote->distFromState?> - <?=trim($quote->distToCity)?>,<?=$quote->distToState?></div>

			<div style="float:right; font-weight:normal;  padding-right:15px; font-size:12px; text-transform:none; opacity:0.55; border-right:solid 2px #ffffff;"><?=$quote->carYear?> <?=$quote->carMake?> <?=$quote->carModel?></div>
			<div style="clear:both;"></div>
		</div>
		<div id="fullMapBlock" style="height:251px; border-bottom: solid 2px #7A8CA2; background-size:cover; <?php if($carpic != "-"){ echo "background-image:url('".$carpic."');"; }else{ echo "background-image:url('".base_url()."img/noimage.jpg');"; } ?> background-size:cover;">
		<script type="text/javascript">
			var directionsDisplay;
			var directionsService;
			var map;

			function initialize() {
			  directionsService = new google.maps.DirectionsService();
			  directionsDisplay = new google.maps.DirectionsRenderer();
			  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
			  var mapOptions = {
			    zoom:7,
			    disableDefaultUI: true
			  }
			  map = new google.maps.Map(document.getElementById("map"), mapOptions);
			  directionsDisplay.setMap(map);
			  calcRoute();
			}

			function calcRoute() {
			  var start = "<?=strtolower(trim($quote->distFromCity))?>, <?=strtolower(trim($quote->distFromState))?>";
			  var end =  "<?=strtolower(trim($quote->distToCity))?>, <?=strtolower(trim($quote->distToState))?>";
			  var request = {
			    origin:start,
			    destination:end,
			    travelMode: google.maps.TravelMode.DRIVING
			  };
			  directionsService.route(request, function(result, status) {
			  	$('#DistacneValue').html(result.routes[0].legs[0].distance.text);
			    if (status == google.maps.DirectionsStatus.OK) {
			      directionsDisplay.setDirections(result);
			    }
			  });
			}
			initialize();	

		</script>
		
		<!--div style="padding:5px; cursor:pointer; position:absolute; top:0px; font-size:16px; right:193px; background-color:#1970B0; color:#ffffff; z-index:9999;">
				<div style="font-size:10px;" onclick="$('#mapContainer').fadeOut(300);">show photo</div>
				
	   </div>
	   <div style="padding:5px; cursor:pointer;  position:absolute; top:0px; font-size:16px; right:255px; background-color:rgb(0,255,128); color:#1970B0; z-index:9999;">
	   <div style="font-size:10px;" onclick="$('#mapContainer').fadeIn(300);">show route</div>
	   </div-->
		<div id="mapContainer" style="position:relative;">
			<div id="map" style="width:100%; height:250px;"></div>
			<!--div style="padding:10px; position:absolute; top:0px; font-size:16px; right:0px; background-color:#1970B0; color:#ffffff;">
				<div style="font-size:10px;">distance</div>
				<div id="DistacneValue"></div>
			</div>
			<div onclick="$('#mapContainer').parent().fadeOut(500);" style="padding:7px; border:solid 1px #eeeeee; border-top:none; cursor:pointer; position:absolute; top:10px; font-size:11px; left:115px; background-color:#ffffff; color:#777777;">
				Car Photo
			</div-->
		</div>
		<?php  if($showmap == "1"){ ?>
            <!--iframe style="width:100%; height:250px; border:none;"  src="http://classic.mapquest.com/embed?q1=<?=trim($quote->distFromCity)?>+<?=trim($quote->distFromState)?>+<?=$quote->distFromZip?>+US&q2=<?=trim($quote->distToCity)?>+<?=trim($quote->distToState)?>+<?=$quote->distToZip?>+US"></iframe-->
        <?php }  ?>  
        </div>  
       
</div>
<div style="float:left; width:calc(55% - 5px);  margin-left:5px;  ">		
	<div onclick="if($('#fullMapBlock').is(':visible')){ $('#fullMapBlock').slideUp(300); $('#fullClientBlock').slideUp(300); }else{ $('#fullMapBlock').slideDown(300); $('#fullClientBlock').slideDown(300); } " style="font-size:13px; text-transform:uppercase; padding:15px; cursor:pointer;  background-color:#7A8CA2; font-weight:bold; color:#ffffff; height:15px; overflow:hidden;">
		<div style="float:left; ">
			<?=$partName?> <?=substr($Gpart, 0, (strlen($Gpart)-1))?> #<?=str_pad ($quote->id, 5,"0",STR_PAD_LEFT)?>
		</div>
		<div style="float:right; padding-right:5px; margin-left:5px; text-transform: none; opacity:0.75;"><?php if($quote->CarrierPay == 0){ echo "<span style=' font-weight:bold;'>NONE</span>"; } else{ echo ($quote->price + $quote->deposit); } ?></div>
		<div style="float:right; padding-right:5px; margin-left:5px; text-transform: none; border-right:solid 2px #ffffff; opacity:0.75;"><?=date('m/d/y', strtotime($quote->arriveDate))?></div>
		<div style="float:right; padding-right:5px; margin-left:5px; text-transform: none; border-right:solid 2px #ffffff; opacity:0.75;"><?=$quote->Phone?></div>
		<div style="float:right; padding-right:5px; margin-left:5px; text-transform: none; border-right:solid 2px #ffffff; opacity:0.75;"><?=$quote->FirstName?></div>
		<div style="clear:both;"></div>
	</div>
	<div id="fullClientBlock" style=" height:251px; background-color:#ffffff; border-bottom: solid 2px #7A8CA2;">							
	<div style="float:left; width:55%;">
	
		<div style="padding:15px; padding-top:10px;  padding-left:20px; padding-right:20px;">
				<div style="font-size:15px; font-weight:bold; color:#75879F;"><?=$partName?> <span style="color:#75879F;"><?=substr($Gpart, 0, (strlen($Gpart)-1))?></span> <span style="padding-left:3px; color:#91CBE5">#<?=str_pad ($quote->id, 5,"0",STR_PAD_LEFT)?></span>  <div class="buttonBlue" style="display:inline-block; padding:5px; margin-left:3px; font-size:11px; cursor:pointer; background-color:#005696; color:#75879F; font-weight:normal; border-radius:10px; margin-top:-5px; padding-left:7px; padding-right:7px;" onclick="show_fullinfoG('<?=base_url()?>', $(this), '<?=$quote->id?>');">Edit</div></div>

				<div style="margin-top:10px; font-size:14px; margin-bottom:10px; margin-left:20px; color:#75879F;">
						<div style="margin-top:0px;">Name: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;" id="Fname" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->FirstName?></span></div>
						<div style="margin-top:0px;">Email: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;" id="Femail" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->Email?></span></div>
						<div style="margin-top:0px;">Phone Number: <span title="<?=$quote->Phone2?>" style="padding-left:3px; color:#91CBE5; font-weight:bold;" id="Fphone" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->Phone?></span></div>
						<div style="margin-top:0px;">Vechicle: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;"><span id="FcarMake" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->carMake?></span> <span id="FcarModel" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->carModel?></span></span> <?php if($quote->vechinesRun == 0) {  }else if( $quote->vechinesRun == 1 ){  }else{ echo "<span style=' color:#ff5050; font-weight:bold;'>INOP</span>"; } ?></div>
						<div style="margin-top:0px;">shipVia: <span style="color:#91CBE5; font-weight:bold;" id="shipVia" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500);"><?php if($quote->shipVia == 0) { echo "not selected"; }else if( $quote->shipVia == 1 ){ echo "Open"; }else if($quote->shipVia == 2){ echo "Close"; }else{ echo "DriveAway"; } ?></span></div>

						<div style="margin-top:0px;">Origin: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;"><span id="FdistFromCity" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distFromCity?></span>, <span id="FdistFromState" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distFromState?></span> <span id="FdistFromZip" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distFromZip?></span></span></div>
						<div style="margin-top:0px;">Destination: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;"><span id="FdistToCity" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distToCity?></span>, <span id="FdistToState" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distToState?></span> <span id="FdistToZip" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distToZip?></span></span></div>
						<div style="margin-top:0px;">Total Mileage: <span style="padding-left:3px; color:#91CBE5; font-weight:bold;" id="Fdistance" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);"><?=$quote->distance?></span><span style="padding-left:7px; font-size:10px;">(<span id="DistacneValue" style="padding:3px;"></span>)</span></div>
						<script type="text/javascript">
							$( function() {
							    $("#datepickerLSd" ).datepicker();
							    $("#datepickerLSd" ).datepicker("option", "dateFormat", "mm/dd/y" );
							    $("#datepickerLSd" ).datepicker("option", "minDate", "<?=date('m/d/y', strtotime($quote->arriveDate))?>" );


							  
							  } );

							$(document).ready(function(){
						        $("#datepickerLSd" ).val('<?=date('m/d/y', strtotime($quote->arriveDate))?>');
						    });
						</script>
						<div style="margin-top:15px; margin-left:-20px; float:left;">Ready Date: <input class="buttonBlue" id="datepickerLSd" style="margin-left:3px; cursor:pointer; display:inline-block; padding:5px; width:57px; border-radius:10px; background-color:#1970B0; padding-left:10px; padding-right:10px; color:#F7FC7F; font-size:15px;" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);" value="<?=date('m/d/y', strtotime($quote->arriveDate))?>" /></div>

						<div class="buttonOther" onclick="event.stopPropagation(); $('#SEBlock').fadeOut(300);   show_sms_launch_block('<?=base_url()?>', $(this), '<?=$quote->id?>');" style="float:right; margin-left:3px; margin-top:5px; cursor:pointer; font-size:16px; display:inline-block; padding:5px; border-radius:10px; background-color:#ff5050; text-align:center; padding-left:10px; padding-right:10px; margin-right:-20px; margin-top:15px; font-weight:bold; color:#ffffff">SEND SMS</div>
						<div style="clear:both;"></div>
				</div>
			
            
        </div>
       


	
	</div>	
	<div style="float:left; width:45%; position:relative;">
		<div id="FsaveButton" onclick="saveFullQuoteBlock('<?=base_url()?>', '<?=$quote->id?>');" style="position:absolute; display:none; bottom:10px; left:-120px; background-color:#FF5050; border-radius:50px; color:#ffffff; padding:5px; font-size:14px; cursor:pointer; padding-left:10px; padding-right:10px;"><img style="margin-top:0px; margin-bottom:-2px; margin-left:-2px; max-width:35px;" src="<?=base_url()?>img/S007.png"/>
		</div>
		<div id="FcencelButton" onclick="activateQuote('<?=base_url()?>','<?=$quote->id?>', 0);" style="position:absolute; display:none; bottom:10px; left:-60px; background-color:#FF5050; border-radius:50px; color:#ffffff; padding:5px; font-size:14px; cursor:pointer; padding-left:10px; padding-right:10px;">
			<img style="margin-top:0px; margin-left:-2px; margin-bottom:-2px; max-width:35px;" src="<?=base_url()?>img/S008.png"/>
		</div>
			<?php $quote->price_per_mile = (float) $quote->price_per_mile; if(!is_float($quote->price_per_mile)) $quote->price_per_mile = "0.00";  ?>
			<div style="padding:20px; padding-top:10px;">
			
			<div class="buttonOther"  onclick="event.stopPropagation(); $('#darker').fadeIn(500); $('html, body').animate({ scrollTop: 0 }, 300); $('#dropListBlock<?=$quote->id?>').fadeIn(500);" style="margin-left:3px; cursor:pointer; font-size:12px; display:inline-block;  padding:7px; border-radius:10px; background-color:#1970B0; text-align:center; width:calc(100% - 20px); padding-left:10px; padding-right:10px; color:#ffffff">MOVE TO FOLDER</div>
			<div class="dropListBlock"  id="dropListBlock<?=$quote->id?>" style="width:auto; left:auto; right:-12px; top:-10px; white-space:nowrap;">

            <div onclick="event.stopPropagation();" class="moveToButton">MOVE TO</div>
          <?php 
              foreach($sPartsNames as $key=>$value){
            ?>
            <div style="display:inline-block; margin-right:1px;">
            <div onclick="event.stopPropagation();" style="font-size:12px; color:#ffffff; text-transform:uppercase; text-align:left; padding:5px; padding-left:20px; padding-right:20px;"><?=$value?></div>
            <?php foreach($upmenu[$key] as $item){ ?>
                <div onclick="event.stopPropagation(); $(this).parent().parent().fadeOut(); moveQuoteTo('<?=base_url()?>', '<?=$quote->id?>' , '<?=$item->id?>', $(this));" class="dropListItem"><?=$item->sname?></div>
            <?php } ?>
            </div>
            <?php } ?>
            </div>
			<div onclick="window.open('https://www.centraldispatch.com/protected/listing-search/result?qid=<?=$quote->id?>&pickupAreas%5B%5D=state_USA_<?=trim($quote->distFromState)?>&pickupRadius=25&pickupCity=&pickupState=&pickupZip=&origination_valid=1&FatAllowCanada=1&deliveryAreas%5B%5D=state_USA_<?=trim($quote->distToState)?>&deliveryRadius=25&deliveryCity=&deliveryState=&deliveryZip=&destination_valid=1&FatAllowCanada=1&trailerType=&vehiclesRun=&minVehicles=1&maxVehicles=&shipWithin=60&paymentType=&minPayPrice=&minPayPerMile=&highlightPeriod=0&listingsPerPage=500&postedBy=&primarySort=9&secondarySort=9&CSRFToken=<?=$user->CDtoken?>'); refresh_on_focus('<?=base_url()?>');"  style="margin-left:3px; cursor:pointer; font-size:11px; float:left; margin-top:5px;  padding:7px; border-radius:10px; background-color:#1970B0; text-align:center; padding-left:10px; width:auto; padding-right:10px; color:#ffffff" class="buttonBlue">GET RATES</div>
			<div id="FfindDriverButton" class="buttonBlue" onclick="if($('#driversF').is(':hidden')){ show_drivers_tableF('<?=base_url()?>', $(this) , '<?=$quote->id?>'); }else{ $('#driversF').fadeOut(500); } " style="margin-left:3px; cursor:pointer; font-size:11px;  padding:7px; border-radius:10px; margin-top:5px; background-color:#1970B0; text-align:center; padding-left:10px; float:right; padding-right:10px; color:#ffffff; width:auto;">FIND DRIVERS</div>
			<div style="clear:both;"></div>
			
				<div style="font-size:16px; color:#75879F; margin-top:10px;">
					<div style="float:left;">Total price:</div> 
					<div style="float:right;">
					<?php if($quote->CarrierPay != 0){ ?><span style="padding-left:3px; color:#91CBE5; font-size:20px;" on>$</span><?php } ?> <span id="FtotalPrice" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500); recountTBprices(0);" style=" color:#91CBE5; font-size:20px;"><?php if($quote->CarrierPay == 0){ echo "<span style='color:#ff5050; font-weight:bold;'>NONE</span>"; } else{ echo ($quote->price + $quote->deposit); } ?></span> 
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="font-size:16px; color:#75879F;">
					<div style="float:left;">Deposit:</div> 
					<div style="float:right; font-weight:bold;">
						<span style="padding-left:3px; color:#91CBE5; font-size:20px;">$<span  id="Fdeposit" contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500); recountTBprices(1);"><?=$quote->deposit?></span></span>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="font-size:16px; color:#75879F; margin-bottom:10px;">
					<div style="float:left;">COD:</div> 
					<div style="float:right; font-weight:bold;">
					<span style="font-size: padding-right:3px; font-size:12px;">(<span contenteditable="true" onchange=" recountTBprices(3); " id="pricePMValG"><?=$quote->price_per_mile?></span>)</span>
						<span style="padding-left:3px; color:#91CBE5; font-size:20px; font-weight:bold;">$<span id="priceValF"  contenteditable="true" onchange="$('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500); recountTBprices(2);"><?php if($quote->CarrierPay == 0){ echo ($quote->price_per_mile*$quote->distance); }else{ echo $quote->CarrierPay; } ?></span></span> 
					</div>
					<div style="clear:both;"></div>	
				</div>
				<div onclick="convertToQuote('<?=base_url()?>', '<?=$quote->id?>', '<?=$quote->spart?>');" class="buttonGreen" style="margin-left:3px; cursor:pointer; font-size:16px; display:block; padding:5px; border-radius:10px; background-color:rgb(0,255,128); text-align:center; padding-left:10px; padding-right:10px; font-weight:bold; color:#005696">CONVERT TO QUOTE</div>

				<div class="buttonOther" onclick="show_launch_block('<?=base_url()?>', $(this), '<?=$quote->id?>');" style="margin-left:3px; margin-top:5px; cursor:pointer; font-size:16px; display:block; padding:5px; border-radius:10px; background-color:#ff5050; text-align:center; padding-left:10px; padding-right:10px; font-weight:bold; color:#ffffff">LAUNCH DITAILS</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<div style="clear:both;"></div>
<div style="position:relative;">
<div id="hideDriversBut"  style="position:fixed; display:none; top:50%; z-index:99999; right:50px; cursor:pointer;bottom: 10px;"><img onclick="$(this).fadeOut(500); $('#FfindDriverButton').click();" src="http://swatmoves.com/CRM3/img/S006.png"></div>
<div class="scrollBlock" style="border-left:none; position:absolute; top:5px; left:0px; z-index:2; width:100%; display:none; border-top:none; background-color:#ffffff;  height:250px; border-bottom:solid 3px #1970B0; overflow-y: auto;  overflow-x:hidden; position:relative;" id="driversF" >

       <div >
       		<div>
		        <div  class="backEmailsList" >
		          <div id="driversBlockF" style="display:none;">
		            <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
		          </div>
		        </div>
        	</div>

      </div>
</div>


