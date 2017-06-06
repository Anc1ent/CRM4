<div style="padding:20px; background-color:#7A8CA2; width:calc(100% - 40px); margin:0px auto; padding-top:30px; padding-bottom:30px;  margin-bottom:20px; margin-left:-20px;">
<form class="cmxform" id="fullInfoForm<?=$quote->id?>" onsubmit="event.stopPropagation();    return false; " action="<?=base_url()?>admin/main/update_quote" method="POST"> 
<input type="hidden" name="qid" value="<?=$quote->id?>" />
	<!--  CLIENT INFO -->
	<div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Client Info...</div>
	<div style="font-size:18px; color:#ffffff; font-weight:bold; text-align:center; margin-bottom:30px;">LEAD FORM: <span style="color:#F7FC7F;"># <?=str_pad ($quote->id, 7,"0",STR_PAD_LEFT)?></span></div>
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
				<input  name="Phone2" class="profileInput" type="text" value="<?=$quote->Phone2?>"/>
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
<!-- ORIGIN & DESTINATION -->
	<div style="padding:10px; background-color:rgba(255,255,255,0.1); margin-top:20px;">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Origin & Destination...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:50%; float:left;">
				<div class="labelInput" style="margin-top:5px; font-size:13px;">Destination from:</div>
				<div class="labelInput" style=" float:left;margin-top:16px; margin-right:5px; width:70px; text-align:right;">City *</div>
			<div style="float:left; margin-top:10px;">
				<input name="distFromCity" class="profileInput" type="text"  required value="<?=$quote->distFromCity?>"/>
			</div>
			<div style="clear:both;"></div>
			<div class="labelInput" style="float:left; margin-right:5px;margin-top:16px; width:70px; text-align:right;">State *</div>
			<div style="float:left; margin-top:10px;">
				<input name="distFromState" class="profileInput" type="text" required  value="<?=$quote->distFromState?>"/>
			</div>
			<div style="clear:both;"></div>

			<div class="labelInput" style="float:left; margin-right:5px; width:70px;margin-top:16px; text-align:right;">Zip</div>
			<div style="float:left; margin-top:10px;">
				<input name="distFromZip" class="profileInput" type="text"  value="<?=$quote->distFromZip?>"/>
			</div>
			<div style="clear:both;"></div>		
					<div class="labelInput" style="float:left; margin-right:5px; width:70px;margin-top:16px; text-align:right;">Country</div>
					<div style="float:left; margin-top:10px;">
						<input name="distFromCountry" class="profileInput" type="text"  value="USA"/>
					</div>
			<div style="clear:both;"></div>
		</div>
		<div style="width:50%; float:left;">
				<div class="labelInput" style="margin-top:5px;  font-size:13px;">Destination to:</div>
				<div class="labelInput" style=" float:left;margin-top:16px; margin-right:5px; width:70px; text-align:right;">City *</div>
			<div style="float:left; margin-top:10px;">
				<input name="distToCity" class="profileInput" type="text" required  value="<?=$quote->distToCity?>"/>
			</div>
			<div style="clear:both;"></div>
			<div class="labelInput" style="float:left; margin-right:5px;margin-top:16px; width:70px; text-align:right;">State *</div>
			<div style="float:left; margin-top:10px;">
				<input name="distToState" class="profileInput" type="text" required value="<?=$quote->distToState?>"/>
			</div>
			<div style="clear:both;"></div>

			<div class="labelInput" style="float:left; margin-right:5px; width:70px;margin-top:16px; text-align:right;">Zip</div>
			<div style="float:left; margin-top:10px;">
				<input name="distToZip" class="profileInput" type="text"  value="<?=$quote->distToZip?>"/>
			</div>
			<div style="clear:both;"></div>		
					<div class="labelInput" style="float:left; margin-right:5px; width:70px;margin-top:16px; text-align:right;">Country</div>
					<div style="float:left; margin-top:10px;">
						<input name="distToCountry" class="profileInput" type="text"  value="USA"/>
					</div>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
	</div>
<!-- ORIGIN & DESTINATION -->

	<div style="padding:10px; background-color:rgba(255,255,255,0.1); margin-top:20px;">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Shipping information...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:40%; float:left; ">
		<?php $qid = $quote->id; ?>
		<script type="text/javascript">
				$( function() {
				    $("#datepicker<?=$qid?>" ).datepicker();
				    $("#datepicker<?=$qid?>" ).datepicker("option", "dateFormat", "m/d/y" );
				  } );

				$(document).ready(function(){
			        $("#datepicker<?=$qid?>" ).val('<?=date('m/d/y', strtotime($quote->arriveDate))?>');
			    });
			</script>
				
			<div class="labelInput" style="margin-top:0px;">Estimated Ship Date  *</div>
			<div><input id="datepicker<?=$qid?>" required name="arriveDate" type="text" class="calendarInput" d="datepicker<?=$qid?>" style="width:150px; color:#000000; border:solid 1px #24567A;" value="<?=date('m/d/y', strtotime($quote->arriveDate))?>"  /></div>
		</div>
		<div style="width:60%; float:left;">
				<div class="labelInput" style="margin-top:0px;">Shipper note</div>
			<div><textarea name="shipperNote" class="profileInput" style="height:90px; width:90%;"><?=$quote->shipperNote?></textarea></div>

		</div>
		<div style="clear:both;"></div>
	</div>
	</div>


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
	 <!--div onclick="event.stopPropagation();  $('#q-<?=$quote->id?>').find('.fullinfobut').click(); " style="font-size:14px;  margin:0px; float:left; padding:10px; padding-left:10px; padding-right:10px; font-size:12px; margin-top:2px; width:60px; " class="ibutton">Cencel</div -->
	  <div style="padding:10px; margin-top:20px; background-color:rgba(255,255,255,0.1);">
	<div class="labelInput" style="margin-top:10px; color:#ffffff; margin-bottom:0px; font-size:14px; padding-left:20px; margin-bottom:20px;">Confirmation...</div>
		<div style="padding-left:40px; padding-right:20px; padding-bottom:20px;">
		<div style="width:15%; float:left; ">
			
			
		</div>
		<div style="width:35%; float:left; margin-left:25%">
			<div>
				<div style="float:left;">
					<div class="labelInput">Initial:</div>
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
			 <input type="submit" onclick="showConfirmation('Update quote info #<?=$quote->id?>', function(){ updateQuote('<?=base_url()?>', '<?=$quote->id?>'); $('#q-<?=$quote->id?>').find('.fullinfobut').click(); });" value=" SAVE " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 <div style="position:fixed; right:20px; bottom:20px;">
			 	<input type="submit" onclick="showConfirmation('Update quote info #<?=$quote->id?>', function(){ updateQuote('<?=base_url()?>', '<?=$quote->id?>'); $('#q-<?=$quote->id?>').find('.fullinfobut').click(); });" value=" SAVE " style="font-size:16px;   margin:0px; display:inline-block; margin-left:20px; padding:10px; padding-left:20px; padding-right:20px; margin-top:5px; width:auto; margin-right:10px; border-radius:10px;" class="ibutton buttonGreen"/>
			 </div>
			
		</div>
	
		<div style="clear:both;"></div>
	</div>
	</form>
</div>

