<div  style="padding:20px; width:calc(100% - 40px); background-color:#7A8CA2; margin:0px auto; padding-top:30px; padding-bottom:30px;  margin-bottom:20px; margin-left:-20px;">
<form id="bookitForm<?=$quote->id?>" onsubmit="event.stopPropagation();  updateQuoteOrder('<?=base_url()?>','<?=$quote->id?>'); return false; " method="POST" action="<?=base_url()?>admin/main/update_quote_order">
	<input type="hidden" name="qid" value="<?=$quote->id?>"/>
<!--  CLIENT INFO -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Client Info...</div>
	<div style="font-size:18px; color:#ffffff; font-weight:bold; text-align:center; margin-bottom:30px;">SHIPPING ORDER FORM: <span style="color:#F7FC7F;"># <?=str_pad ($quote->id, 7,"0",STR_PAD_LEFT)?></span></div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Name:</div>
			<div style="position:relative;">
				<input  name="FirstName" class="profileInput" type="text" value="<?=$quote->FirstName?>"/>
			</div>
			<div class="labelInput">Mobile Phone Number:</div>
			<div>
			<input  name="Mobile" class="profileInput" type="text" value="<?=$quote->Mobile?>"/>
			</div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Email Address:</div>
			<div><input name="Email"  class="profileInput" type="text"  value="<?=$quote->Email?>"/></div>
			
			<div class="labelInput">Time zone:</div>
			<div>
				<select name="timeZone" class="selectInput">
					<option <?php if($quote->timeZone == 0) echo "selected='selected'"; ?> value="0">Eastern</option>
					<option <?php if($quote->timeZone == 1) echo "selected='selected'"; ?> value="1">Central</option>
					<option <?php if($quote->timeZone == 2) echo "selected='selected'"; ?> value="2">Mountain</option>
					<option <?php if($quote->timeZone == 3) echo "selected='selected'"; ?> value="3">Pacific</option>
				</select>
			</div>
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Home Phone Number:</div>
			<div style="position:relative;">
				<input  name="Phone" class="profileInput" type="text" value="<?=$quote->Phone?>"/>
			</div>
			
			<div class="labelInput">Preferred Contact Method:</div>
			<div>
			<select name="predContact" class="selectInput">
					<option <?php if($quote->predContact == 0) echo "selected='selected'"; ?> value="0">Email</option>
					<option <?php if($quote->predContact == 1) echo "selected='selected'"; ?> value="1">Phone</option>
					<option <?php if($quote->predContact == 2) echo "selected='selected'"; ?> value="2">Mobile</option>
					<option <?php if($quote->predContact == 3) echo "selected='selected'"; ?> value="3">Fax</option>
				</select>
			</div>
			
			
		</div>
		<div style="width:25%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Work Phone Number:</div>
			<div style="position:relative;">
				<input  name="Phone2" class="profileInput" type="text" value="<?=$quote->Phone?>"/>
			</div>
			
			
			<div class="labelInput">Client Notice:</div>
			<div>
			<input  name="clientNotice" class="profileInput" type="text"  value="<?=$quote->clientNotice?>"/>
			</div>
			
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- [END] CLIENT INFO -->
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
		<?php 
			if($quote->pAddrCity == "") $quote->pAddrCity = $quote->distFromCity; 
			if($quote->pAddrState == "") $quote->pAddrState = $quote->distFromState; 
		?>
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
		<?php 
			if($quote->dAddrCity == "") $quote->dAddrCity = $quote->distToCity; 
			if($quote->dAddrState == "") $quote->dAddrState = $quote->distToState; 
		?>
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

	<?php /* ?>
	<div style="padding:10px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Shipping information:</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:50%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Tariff *</div>
			<div><input  required name="price" class="profileInput" type="text"  value="<?=$quote->price?>"/></div>
			<div class="labelInput">Deposit *</div>
			<div><input  required name="deposit" class="profileInput" type="text"  value="<?=$quote->deposit?>"/></div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>

	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Pickup contact & location:</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:33%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Address</div>
			<div><input name="pAddrStreet" class="profileInput" type="text"  value="<?=$quote->pAddrStreet?>"/></div>

			<div class="labelInput">City</div>
			<div><input name="pAddrCity" class="profileInput" type="text"  value="<?=$quote->distFromCity?>"/></div>

			<div class="labelInput">State/Zip</div>
			<div><input name="pAddrState" class="profileInput" type="text"  style="width:147px;" value="<?=$quote->distFromState?>"/><input class="profileInput" name="pAddrZip" type="text" style="width:70px; margin-left:3px;"  value="<?=$quote->distFromZip?>"/></div>

			<div class="labelInput">Country</div>
			<div><input name="pAddrCountry" class="profileInput" type="text"  value="<?=$quote->distFromCountry?>"/></div>

			
		</div>
		<div style="width:33%; float:left;">
			
			<div class="labelInput" style="margin-top:0px;">Contact name</div>
			<div><input name="pFname" class="profileInput" type="text"  value="<?=$quote->pFname?>"/></div>

			<div class="labelInput">Company name</div>
			<div><input name="pCompany" class="profileInput" type="text"  value="<?=$quote->pCompany?>"/></div>

			<div class="labelInput">Buyer Name</div>
			<div><input name="BuyerName" class="profileInput" type="text"  value="<?=$quote->BuyerName?>"/></div>

		</div>

		<div style="width:33%; float:left;">
			
			<div class="labelInput" style="margin-top:0px;">Phone</div>
			<div><input name="pPhone" class="profileInput" type="text"  value="<?=$quote->pPhone?>"/></div>

			<div class="labelInput">Phone 2</div>
			<div><input name="pPhone2" class="profileInput" type="text"  value="<?=$quote->pPhone2?>"/></div>

			<div class="labelInput">Phone 3</div>
			<div><input name="pPhone3" class="profileInput" type="text"  value="<?=$quote->pPhone3?>"/></div>

			<div class="labelInput">Mobile</div>
			<div><input name="pMobile" class="profileInput" type="text"  value="<?=$quote->pMobile?>"/></div>

		</div>
		<div style="clear:both;"></div>
	</div>
	</div>


	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Delivery contact & location:</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:33%; float:left;">
			<div class="labelInput" style="margin-top:0px;">Address</div>
			<div><input name="dAddrStreet" class="profileInput" type="text"  value="<?=$quote->dAddrStreet?>"/></div>

			<div class="labelInput">City</div>
			<div><input name="dAddrCity" class="profileInput" type="text"  value="<?=$quote->distToCity?>"/></div>

			<div class="labelInput">State/Zip</div>
			<div><input name="dAddrState" class="profileInput" type="text"  style="width:147px;" value="<?=$quote->distToState?>"/><input class="profileInput" type="text" name="dAddrZip" style="width:70px; margin-left:3px;"  value="<?=$quote->distToZip?>"/></div>

			<div class="labelInput">Country</div>
			<div><input name="dAddrCountry" class="profileInput" type="text"  value="<?=$quote->distToCountry?>"/></div>
		</div>
		<div style="width:33%; float:left;">
			<div class="labelInput" style="margin-top:0px;">Contact Name *</div>
			<div><input  required name="dFname" class="profileInput" type="text"  value="<?=$quote->dFname?>"/></div>

			<div class="labelInput">Company Name</div>
			<div><input name="dCompany" class="profileInput" type="text"  value="<?=$quote->dCompany?>"/></div>
		</div>
		<div style="width:33%; float:left;">
				<div class="labelInput" style="margin-top:0px;">Email *</div>
			<div><input  required name="dEmail" class="profileInput" type="text"  value="<?=$quote->dEmail?>"/></div>

			<div class="labelInput">Phone 1 *</div>
			<div><input  required name="dPhone" class="profileInput" type="text"  value="<?=$quote->dPhone?>"/></div>

			<div class="labelInput">Phone 2</div>
			<div><input name="dPhone2" class="profileInput" type="text"  value="<?=$quote->dPhone2?>"/></div>
			

			<div class="labelInput">Mobile</div>
			<div><input name="dMobile" class="profileInput" type="text"  value="<?=$quote->dMobile?>"/></div>


			<div class="labelInput">Fax</div>
			<div><input name="dFax" class="profileInput" type="text"  value="<?=$quote->dFax?>"/></div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>

	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Dispatch order:</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:50%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">1st Avail. Pickup Date *</div>
			<?php $qid = $quote->id; ?>
			<script type="text/javascript">
				$( function() {
				    $("#Adatepicker<?=$qid?>" ).datepicker();
				    $("#Adatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/yy" );

				    $("#Bdatepicker<?=$qid?>" ).datepicker();
				    $("#Bdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/yy" );

				    $("#Cdatepicker<?=$qid?>" ).datepicker();
				    $("#Cdatepicker<?=$qid?>" ).datepicker("option", "dateFormat", "mm/dd/yy" );
				
				  } );


				<?php
					if((!isset($quote->AvailPicDate))||(substr($quote->AvailPicDate, 0,10) == "0000-00-00")) $quote->AvailPicDate = date('Y-m-d');
					if((!isset($quote->LoadDate))||(substr($quote->LoadDate, 0,10) == "0000-00-00")) $quote->LoadDate = date('Y-m-d');
					if((!isset($quote->DeliveryDate))||(substr($quote->DeliveryDate, 0,10) == "0000-00-00")) $quote->DeliveryDate = date('Y-m-d');
				 ?>
				$(document).ready(function(){
			        $("#Adatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->AvailPicDate))?>');
			        $("#Bdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->LoadDate))?>');
			        $("#Cdatepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->DeliveryDate))?>');
			    });
			</script>
			<div><input  required name="AvailPicDate" type="text"  class="calendarInput" id="Adatepicker<?=$qid?>" style="width:150px; color:#000000; border:solid 1px #24567A;" value="<?=date('m/d/y', strtotime($quote->AvailPicDate))?>"/></div>

			<div class="labelInput">Load Date *</div>
			<div>
				<select  required name="LoadDateType" class="profileInput" style="margin-right:5px; width:150px;">
					<option <?php if($quote->LoadDateType == 0) echo " selected='selected' "; ?> value="0" >Estimated</option>
					<option <?php if($quote->LoadDateType == 1) echo " selected='selected' "; ?> value="Exactly">Exactly</option>
					<option <?php if($quote->LoadDateType == 2) echo " selected='selected' "; ?> value="No Earlier Than">No Earlier Than</option>
					<option <?php if($quote->LoadDateType == 3) echo " selected='selected' "; ?> value="No Later Than">No Later Than</option>
				</select>
				<input  required name="LoadDate" type="text"  class="calendarInput" id="Bdatepicker<?=$qid?>" style="width:150px; color:#000000; border:solid 1px #24567A;" value="<?=date('m/d/y', strtotime($quote->LoadDate))?>" />
			</div>

			<div class="labelInput">Delivery Date *</div>
			<div>
				<select  required name="DeliveryDateType" class="profileInput" style="margin-right:5px; width:150px;">
					<option <?php if($quote->DeliveryDateType == 0) echo " selected='selected' "; ?> value="0" >Estimated</option>
					<option <?php if($quote->DeliveryDateType == 1) echo " selected='selected' "; ?> value="Exactly">Exactly</option>
					<option <?php if($quote->DeliveryDateType == 2) echo " selected='selected' "; ?> value="No Earlier Than">No Earlier Than</option>
					<option <?php if($quote->DeliveryDateType == 3) echo " selected='selected' "; ?> value="No Later Than">No Later Than</option>
				</select>
				<input  required name="DeliveryDate"  type="text" class="calendarInput" id="Cdatepicker<?=$qid?>" style="width:150px; color:#000000; border:solid 1px #24567A;" value="<?=date('m/d/y', strtotime($quote->DeliveryDate))?>" />
			</div>


			<div class="labelInput">Carrier:</div>
			<div style="position:relative;">
				<input type="hidden" name="driverid" value="<?=$quote->driverid?>"/>
				<input oninput="get_like_drivers_search('<?=base_url()?>', $(this).val());" id="iCarrier" name="Carrier" class="profileInput" type="text"  value="<?=$quote->Carrier?>"/>
				<div id="driversLikeList" style="display:none; position:absolute; top:30px; overflow-y: auto; max-height:150px; border:solid 1px #005696; background-color:#ffffff;">

				</div>
			</div>

		</div>
		<div style="width:50%; float:left;">
			<div class="labelInput" style="margin-top:0px;">Inormation for shipper:</div>
			<div><textarea name="forShipperInfo" class="profileInput" style="height:90px; width:90%;"><?=$quote->forShipperInfo?></textarea></div>

			<div class="labelInput" style="margin-top:10px;">Notes for shipper:</div>
			<div><textarea name="forShipperNotes" class="profileInput" style="height:90px; width:90%;"><?=$quote->forShipperNotes?></textarea></div>

		</div>
		<div style="clear:both;"></div>
	</div>
	</div>


	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Pricing information:</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:33%; float:left; ">
			<div class="labelInput" style="margin-top:0px;">Tariff  *</div>
			<div><input  required class="profileInput" type="text"  value="<?=$quote->price?>"/></div>
			<div class="labelInput">Deposit *</div>
			<div><input  required class="profileInput" type="text"  value="<?=$quote->deposit?>"/></div>
		</div>
		<div style="float:left; width:33%;">
			<div class="labelInput">Carrier pay:</div>
			<div><input name="CarrierPay" class="profileInput" type="text"  value="<?=$quote->CarrierPay?>"/></div>

			<div class="labelInput">Balance paid by:</div>
			<div>
			<select name="BalancePaydBy" class="profileInput" style="margin-right:5px; width:150px;">
					<option <?php if($quote->BalancePaydBy == 0) echo " selected='selected' "; ?> value="0">COD</option>
					<option <?php if($quote->BalancePaydBy == 1) echo " selected='selected' "; ?> value="1">COP</option>
				</select>
			</div>

			<div class="labelInput">COD/COP Method:</div>
			<div>
			<select name="CODPmethod" class="profileInput" style="margin-right:5px; width:200px;">
					<option <?php if($quote->CODPmethod == 0) echo " selected='selected' "; ?> value="0">Cash/Certified Funds</option>
					<option <?php if($quote->CODPmethod == 1) echo " selected='selected' "; ?> value="1">Check</option>
				</select>
			</div>

		</div>
		<div style="float:left; width:33%;">

	        <div class="labelInput">Pickup terminal free:</div>
			<div><input name="PikupTerminalFree" class="profileInput" type="text"  value="<?=$quote->PikupTerminalFree?>"/></div>

			<div class="labelInput">Delivery terminal free:</div>
			<div><input name="DeliveryTerminalFree" class="profileInput" type="text"  value="<?=$quote->DeliveryTerminalFree?>"/></div>
			
		</div>

		<div style="clear:both;"></div>
	</div>
	</div>

	
	<div style="padding:10px; background-color:rgba(255,255,255,0.1); margin-top:20px;">
	<div class="labelInput" style="display:none; margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:18px; padding-left:20px; margin-bottom:20px; text-transform:uppercase;">Dispath information:</div>
	<div style="padding-left:40px; display:none; padding-right:20px; padding-bottom:20px;">
		<div style="width:50%; float:left; ">
			<div class="labelInput" >Dispatch contact:</div>
			<div><input name="DHcontact" class="profileInput" type="text"  value="<?=$quote->DHcontact?>"/></div>

			<div class="labelInput">Dispatch phone:</div>
			<div><input name="DHphone" class="profileInput" type="text"  value="<?=$quote->DHphone?>"/></div>

			<div class="labelInput">Dispatch fax:</div>
			<div><input name="DHfax" class="profileInput" type="text"  value="<?=$quote->DHfax?>"/></div>

			<div class="labelInput">Dispatch email:</div>
			<div><input name="DHemail" class="profileInput" type="text"  value="<?=$quote->DHemail?>"/></div>
		</div>
		<div style="float:left; width:50%;">

			<div class="labelInput">Driver's first name:</div>
			<div><input name="DFname" class="profileInput" type="text"  value="<?=$quote->DFname?>"/></div>

	        <div class="labelInput">Driver's last name:</div>
			<div><input name="DLname" class="profileInput" type="text"  value="<?=$quote->DLname?>"/></div>

			<div class="labelInput">Driver's phone:</div>
			<div><input name="Dphone" class="profileInput" type="text"  value="<?=$quote->Dphone?>"/></div>
			
			<div class="labelInput" style="margin-top:10px;">Dispatch instructions:</div>
			<div><textarea name="Dinstruction" class="profileInput" style="height:50px; width:90%;"><?=$quote->Dinstruction?></textarea></div>


		</div>

		<div style="clear:both;"></div>
	</div>
	<?php */ ?>
	 <div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Confirmation...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:15%; float:left; ">
			
			
		</div>
		<div style="width:35%; float:left; margin-left:25%">
			<div>
				<div style="float:left;">
					<div class="labelInput">Terms & Conditions:</div>
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
			 <input type="submit" value=" BOOK IT NOW " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 <div style="position:fixed; right:20px; bottom:20px;">
			 	<input type="submit" value=" BOOK IT NOW " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 </div>
			
		</div>
	
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
	</form>
</div>
