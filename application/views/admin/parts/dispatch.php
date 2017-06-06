<div  style="padding:20px; width:calc(100% - 40px); background-color:#7A8CA2; margin:0px auto; padding-top:30px; padding-bottom:30px;  margin-bottom:20px; margin-left:-20px;">
<form id="dispatchForm<?=$quote->id?>" onsubmit="event.stopPropagation();  updateQuoteDispatch('<?=base_url()?>','<?=$quote->id?>'); return false; " method="POST" action="<?=base_url()?>admin/main/update_quote_dispatch">
	<input type="hidden" name="qid" value="<?=$quote->id?>"/>
	
	<div style="padding:10px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Carrier info...</div>
		<div style="font-size:18px; color:#ffffff; font-weight:bold; text-align:center; margin-bottom:30px;">DISPATCH ORDER: <span style="color:#F7FC7F;"><?=str_pad ($quote->id, 7,"0",STR_PAD_LEFT)?></span></div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Carrier Name:</div>
			<div style="position:relative;">
				<input type="hidden" name="driverid" value="<?=$quote->driverid?>"/>
				<input oninput="get_like_drivers_search('<?=base_url()?>', $(this).val());" id="iCarrier" name="Carrier" class="profileInput  searchInput" type="text" placeholder="Type Name here..." value="<?php if(isset($quote->driver->name)) echo $quote->driver->name; ?>"/>
				<div id="driversLikeList" style="display:none; position:absolute; top:30px; overflow-y: auto; max-height:150px; border:solid 1px #005696; background-color:#ffffff;">

				</div>
			</div>
			<div class="labelInput">Main Phone Number:</div>
			<div><input name="DriverPhone" id="DriverPhone" class="profileInput" type="text"  value="<?php if(isset($quote->driver->phone)) echo $quote->driver->phone; ?>"/></div>
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Cents Per Mile:</div>
					<input name="price_per_mile" id="price_per_mile" class="profileInput withCheckImg" type="text"  value="<?=$quote->price_per_mile?>"/>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">MC#:</div>
			<div><input name="DriverMC" id="dMC" class="profileInput" type="text"  value="<?php if(isset($quote->driver->dMC)) echo $quote->driver->dMC; ?>"/></div>
			<div class="labelInput">Secondary Phone Number:</div>
			<div><input name="DriverPhone2" id="DriverPhone2" class="profileInput" type="text"  value="<?php if(isset($quote->driver->phone2)) echo $quote->driver->phone2; ?>"/></div>

			<div>
				<div style="float:left;">
					<div class="labelInput">Cargo Coverage:</div>
					<div>
						<?php if(!isset($quote->driver->dCargo)) { $dCargo = 0; }else{ $dCargo = $quote->driver->dCargo; } ?>
						<select name="DriverCargo" id="dCargo" class="selectInput" style="width:180px !important;">
							<option <?php if($dCargo == 0) echo "selected='selected'"; ?> value="0">$50,000.00</option>
							<option <?php if($dCargo == 1) echo "selected='selected'"; ?> value="1">$150,000.00</option>
							<option <?php if($dCargo == 2) echo "selected='selected'"; ?> value="2">$250,000.00</option>
							<option <?php if($dCargo == 3) echo "selected='selected'"; ?> value="3">$500,000.00</option>
							<option <?php if($dCargo == 4) echo "selected='selected'"; ?> value="4">$1,000,000.00</option>
						</select>
					</div>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Carrier Address:</div>
			<div><input name="DriverAddr" id="addr2" class="profileInput" type="text" value="<?php if(isset($quote->driver->addr2)) echo $quote->driver->addr2; ?>"/></div>
			<div class="labelInput">Dispatch Phone Number:</div>
			<div><input name="DriverMobile" id="DriverMobile" class="profileInput" type="text"  value="<?php if(isset($quote->driver->mobile)) echo $quote->driver->mobile; ?>"/></div>

			<div>
				<div style="float:left;">
					<div class="labelInput">Policy Number:</div>
					<input name="DriverPolicNumber" id="Dciferki" class="profileInput withCheckImg" type="text"  value="<?php if(isset($quote->driver->ciferki)) echo $quote->driver->ciferki; ?>"/>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>

		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Contact Person:</div>
			<div><input name="DriverContact" id="DriverContact" class="profileInput" type="text"  value="<?php if(isset($quote->driver->contact)) echo $quote->driver->mobile; ?>"/></div>
			<div class="labelInput">Email Address:</div>
			<div><input name="DriverEmail" id="DriverEmail" class="profileInput" type="text"  value="<?php if(isset($quote->driver->mobile)) echo $quote->driver->email; ?>"/></div>
			<div>
				<div style="float:left;">
					<div class="labelInput">Trailer Type:</div>
					<div>
						<?php if(!isset($quote->driver->trailerType)) { $trailerType = 0; }else{ $trailerType = $quote->driver->trailerType; } ?>
						<select name="DriverTrailerType" id="trailerType" class="selectInput" style="width:180px !important;">
							<option <?php if($trailerType == 0) echo "selected='selected'"; ?> value="0">Open Trailer</option>
							<option <?php if($trailerType == 1) echo "selected='selected'"; ?> value="1">Enclosed Trailer</option>
							<option <?php if($trailerType == 2) echo "selected='selected'"; ?> value="2">Flat Bed Trailer</option>
							<option <?php if($trailerType == 3) echo "selected='selected'"; ?> value="3">Other</option>
						</select>
					</div>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>

	<!-- PRICE -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px; ">Price...</div>
	
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Total Price:</div>
					<input name="TotalPrice" class="profileInput withCheckImg" type="text"  value="<?=($quote->CarrierPay+$quote->deposit)?>"/>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">

			<div>
				<div style="float:left;">
					<div class="labelInput">Deposit:</div>
					<input name="deposit"  class="profileInput withCheckImg" type="text"  value="<?=$quote->deposit?>"/>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Remining Balance:</div>
					<input name="CarrierPay" class="profileInput withCheckImg" type="text"  value="<?=$quote->CarrierPay?>"/>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>

		</div>
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Payment type:</div>
					<div>
						<select name="BalancePaydBy" class="selectInput " style="width:180px !important;">
							<option value="0">Deposit - CC, Bal. - Cash</option>
							<option value="1">Deposit - CC, Bal. - CC</option>
							<option value="2">Deposit - Cash, Bal. - Cash</option>
							<option value="3">Personal Check</option>
							<option value="4">Company Check</option>
						</select>
					</div>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- [END] PRICE -->
<!-- DATES -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px; ">Dates...</div>
		<?php $qid = $quote->id; ?>
			<script type="text/javascript">
				$( function() {
				    

				    $("#Bdatepicker<?=$qid?>" ).datepicker();
				    $("#Bdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/y" );

				    $("#BEdatepicker<?=$qid?>" ).datepicker();
				    $("#BEdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/y" );

				    $("#Cdatepicker<?=$qid?>" ).datepicker();
				    $("#Cdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/y" );

				    $("#CEdatepicker<?=$qid?>" ).datepicker();
				    $("#CEdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/y" );
				
				  } );


				<?php
				
				if((!isset($quote->LoadDate))||(substr($quote->LoadDate, 0,10) == "0000-00-00")) $quote->LoadDate = date('Y-m-d');
				if((!isset($quote->DeliveryDate))||(substr($quote->DeliveryDate, 0,10) == "0000-00-00")) $quote->DeliveryDate = date('Y-m-d');

				if((!isset($quote->LoadDateEnd))||(substr($quote->LoadDateEnd, 0,10) == "0000-00-00")) $quote->LoadDateEnd = date('Y-m-d');
				if((!isset($quote->DeliveryDateEnd))||(substr($quote->DeliveryDateEnd, 0,10) == "0000-00-00")) $quote->DeliveryDateEnd = date('Y-m-d');
				 ?>
				$(document).ready(function(){
			        
			        $("#Bdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->LoadDate))?>');
			        $("#BEdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->LoadDateEnd))?>');
			        $("#Cdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->DeliveryDate))?>');
			        $("#CEdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->DeliveryDateEnd))?>');
			    });
			</script>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Earliest Pickup Date:</div>
					<input id="Bdatepicker<?=$qid?>" name="LoadDate" class="profileInput withCheckImg calendarInput" type="text"  value="<?=date('m/d/y', strtotime($quote->LoadDate))?>"/>
				</div>
				<div style="float:left;">
					<div class="CheckboxImage Calendar" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">

			<div>
				<div style="float:left;">
					<div class="labelInput">Latest Pickup Date:</div>
					<input id="BEdatepicker<?=$qid?>" name="LoadDateEnd" class="profileInput withCheckImg calendarInput" type="text"  value="<?=date('m/d/y', strtotime($quote->LoadDateEnd))?>"/>
				</div>
				<div style="float:left;">
					<div class="CheckboxImage Calendar" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Earliest Delivery Date:</div>
					<input id="Cdatepicker<?=$qid?>" name="DeliveryDate" class="profileInput withCheckImg calendarInput" type="text"  value="<?=date('m/d/y', strtotime($quote->DeliveryDate))?>"/>
				</div>
				<div style="float:left;">
					<div class="CheckboxImage Calendar" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>

		</div>
		<div style="width:25%; float:left; ">
			
			<div>
				<div style="float:left;">
					<div class="labelInput">Latest Delivery Date:</div>
					<input id="CEdatepicker<?=$qid?>" name="DeliveryDateEnd" class="profileInput withCheckImg calendarInput" type="text"  value="<?=date('m/d/y', strtotime($quote->DeliveryDateEnd))?>"/>
				</div>
				<div style="float:left;">
					<div class="CheckboxImage Calendar" ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- [END] DATES -->


	<!-- VECHILE -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Vehicle Info...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Year:</div>
			<div style="position:relative;">
				<input  name="carYear" class="profileInput" type="text" value="<?=$quote->carYear?>"/>
			</div>
			<div class="labelInput">Running Condition:</div>
			<div >
			
				<select name="vechinesRun" class="selectInput">
					<option <?php if($quote->vechinesRun == 0) echo "selected='selected';"; ?> value="0">Run</option>
					<option <?php if($quote->vechinesRun == 1) echo "selected='selected';"; ?> value="1">INOP - Does not start</option>
					<option <?php if($quote->vechinesRun == 2) echo "selected='selected';"; ?> value="2">INOP - Does not drive</option>
					<option <?php if($quote->vechinesRun == 3) echo "selected='selected';"; ?> value="3">INOP - Needs Forklift</option>
					<option <?php if($quote->vechinesRun == 4) echo "selected='selected';"; ?> value="4">*** Totalled ***</option>
				</select>
	
					
				
			</div>
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Make:</div>
			<div style="position:relative;">
				<input  name="carMake" class="profileInput" type="text" value="<?=$quote->carMake?>"/>
			</div>
			<div class="labelInput">Transport Type:</div>
			<div>
				
				<select name="shipVia" class="selectInput">
					<option <?php if($quote->shipVia == 0) echo "selected='selected';"; ?> value="0">Open Transport</option>
					<option <?php if($quote->shipVia == 1) echo "selected='selected';"; ?> value="1">Enclosed Transport</option>
					<option <?php if($quote->shipVia == 2) echo "selected='selected';"; ?> value="2">Flat Bed Transport</option>
					<option <?php if($quote->shipVia == 3) echo "selected='selected';"; ?> value="3">Other</option>
				</select>
					
					
				
			</div>
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Model:</div>
			<div style="position:relative;">
				<input  name="carModel" class="profileInput" type="text" value="<?=$quote->carModel?>"/>
			</div>
			<div class="labelInput">Buyer / Lot / Vin Number:</div>
			<div>
			<input  name="carVin" class="profileInput" type="text" value="<?=$quote->carVin?>"/>
			</div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Vehicle Type:</div>
			<div>
				<select name="carType" class="selectInput">
					<option <?php if($quote->carType == "Mini Coupe") echo "selected='selected';"; ?> value="Mini Coupe">Mini Coupe</option>
					<option <?php if($quote->carType == "Coupe") echo "selected='selected';"; ?> value="Coupe">Coupe</option>
					<option <?php if($quote->carType == "Sedan Small") echo "selected='selected';"; ?> value="Sedan Small">Sedan Small</option>
					<option <?php if($quote->carType == "Sedan Standart") echo "selected='selected';"; ?> value="Sedan Standart">Sedan Standart</option>
					<option <?php if($quote->carType == "Sedan Large") echo "selected='selected';"; ?> value="Sedan Large">Sedan Large</option>
					<option <?php if($quote->carType == "SUV XL") echo "selected='selected';"; ?> value="SUV XL">SUV XL</option>
					<option <?php if($quote->carType == "Pickup Small") echo "selected='selected';"; ?> value="Pickup Small">Pickup Small</option>
					<option <?php if($quote->carType == "Pickup Standart") echo "selected='selected';"; ?> value="Pickup Standart">Pickup Standart</option>
					<option <?php if($quote->carType == "Pickup Large") echo "selected='selected';"; ?> value="Pickup Large">Pickup Large</option>
					<option <?php if($quote->carType == "Pickup XL") echo "selected='selected';"; ?> value="Pickup XL">Pickup XL</option>
					<option <?php if($quote->carType == "Dually") echo "selected='selected';"; ?> value="Dually">Dually</option>
					<option <?php if($quote->carType == "Motorcycle") echo "selected='selected';"; ?> value="Motorcycle">Motorcycle</option>
					<option <?php if($quote->carType == "Other") echo "selected='selected';"; ?> value="Other">Other</option>
				</select>
			</div>
			<div class="labelInput">Vehicle Notes:</div>
			<div>
			<input  name="Vnote" class="profileInput" type="text" value="<?=$quote->Vnotes?>"/>
			</div>
			
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
	<!-- [END] VECHILE -->
	<?php 
			if($quote->pAddrCity == "") $quote->pAddrCity = $quote->distFromCity; 
			if($quote->pAddrState == "") $quote->pAddrState = $quote->distFromState; 
		?>
<!--  PICKUP CONTACT -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Pickup Contact Info...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Name:</div>
			<div style="position:relative;">
				<input  name="pFname" class="profileInput" type="text" value="<?=$quote->pFname?>"/>
			</div>
			<div class="labelInput">Pickup Address:</div>
			<div><input name="pAddrStreet"  class="profileInput" type="text"  value="<?=$quote->pAddrStreet?>"/></div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Home Phone Number:</div>
			<div style="position:relative;">
				<input  name="pPhone" class="profileInput" type="text" value="<?=$quote->pPhone?>"/>
			</div>
			<div class="labelInput">Pickup City:</div>
			<div><input name="pAddrCity"  class="profileInput" type="text"  value="<?=$quote->pAddrCity?>"/></div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Work Phone Number:</div>
			<div style="position:relative;">
				<input  name="pPhone2" class="profileInput" type="text" value="<?=$quote->pPhone2?>"/>
			</div>
			<div class="labelInput">Pickup State:</div>
			<div><input name="pAddrState" placeholder="Please Choose..."  class="profileInput selectInput" type="text"  value="<?=$quote->pAddrState?>"/></div>
			
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Mobile Phone Number:</div>
			<div>
			<input  name="pMobile" class="profileInput" type="text" value="<?=$quote->pMobile?>"/>
			</div>
			
			<div class="labelInput">Pickup Zip Code:</div>
			<div>
			<input  name="pAddrZip" class="profileInput" type="text"  value="<?=$quote->pAddrZip?>"/>
			</div>
			
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- [END] PICKUP CONTACT -->
<?php 
			if($quote->dAddrCity == "") $quote->dAddrCity = $quote->distToCity; 
			if($quote->dAddrState == "") $quote->dAddrState = $quote->distToState; 
		?>
<!--  DELIVERY CONTACT -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Delivery Contact Info...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Name:</div>
			<div style="position:relative;">
				<input  name="dFname" class="profileInput" type="text" value="<?=$quote->dFname?>"/>
			</div>
			<div class="labelInput">Delivery Address:</div>
			<div><input name="dAddrStreet"  class="profileInput" type="text"  value="<?=$quote->dAddrStreet?>"/></div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Home Phone Number:</div>
			<div style="position:relative;">
				<input  name="dPhone" class="profileInput" type="text" value="<?=$quote->dPhone?>"/>
			</div>
			<div class="labelInput">Delivery City:</div>
			<div><input name="dAddrCity"  class="profileInput" type="text"  value="<?=$quote->dAddrCity?>"/></div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Work Phone Number:</div>
			<div style="position:relative;">
				<input  name="dPhone2" class="profileInput" type="text" value="<?=$quote->dPhone2?>"/>
			</div>
			<div class="labelInput">Delivery State:</div>
			<div><input name="dAddrState" placeholder="Please Choose..." class="profileInput selectInput" type="text"  value="<?=$quote->dAddrState?>"/></div>
			
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Mobile Phone Number:</div>
			<div>
			<input  name="dMobile" class="profileInput" type="text" value="<?=$quote->dMobile?>"/>
			</div>
			
			<div class="labelInput">Delivery Zip Code:</div>
			<div>
			<input  name="dAddrZip" class="profileInput" type="text" value="<?=$quote->dAddrZip?>"/>
			</div>
			
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- [END] DELIVERY CONTACT -->

	
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Confirmation...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:15%; float:left; ">
			
			
		</div>
		<div style="width:35%; float:left; margin-left:25%">
			<div>
				<div style="float:left;">
					<div class="labelInput">Dispatch Email:</div>
					<div style="position:relative;">
					<select name="sendDriverEmail" style="width:250px !important;" class="profileInput selectInput withCheckImg">
						<?php foreach($demails as $email){ ?>
						<option value="<?=$email->id?>"><?=$email->name?></option>
						<?php } ?>
					  	<option value="0" selected="selected">*** DO NOT SEND ***</option>
					</select>
				
					  
					
				</div>
			</div>
				</div>
				<div style="float:left;">
					<div onclick="if($(this).hasClass('Cactive')){ $(this).removeClass('Cactive'); }else{ $(this).addClass('Cactive'); } " class="CheckboxImage " ></div>
				</div>
				<div style="clear:both;"></div>
			</div>
			
		</div>
		<div style="width:30%; float:left; ">
			 <input type="submit" value=" DISPACTH ORDER " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 <div style="position:fixed; right:20px; bottom:20px;">
			   <input type="submit" value=" DISPACTH ORDER " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 </div>
			
		</div>
	
		<div style="clear:both;"></div>
	</div>
	</div>


	
	<div style="clear:both;"></div>
	</form>
</div>
