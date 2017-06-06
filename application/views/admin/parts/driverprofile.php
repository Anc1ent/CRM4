<style>
	.profileInput{
		padding:7px; 
		font-size:14px;
		width:220px;
		border:solid 1px #24567A;
	}

	.labelInput{
		font-size:11px; 
		margin-bottom:2px; 
		color:#ffffff;
		margin-top:10px;
		color:#24567A; 
	}
</style>
<div style="padding:20px; width:900px; margin:0px auto; padding-top:30px; padding-bottom:30px; border-bottom:solid 2px rgba(11,75,120,0.6);">
<div style="margin-top:0px; height:10px; border-top:dashed 1px #24567A;"></div>
	<form id="driverForm<?=$driver->id?>" method="POST" action="<?=base_url()?>admin/drivers/adddriver">
	<input type="hidden" name="qid" value="<?=$driver->id?>"/>
	<div class="labelInput" style="margin-top:0px; color:#24567A; margin-bottom:0px; font-size:15px; padding-left:20px;">Driver information:</div>
	<div style="margin-top:10px; height:10px; border-top:dashed 1px #24567A;"></div>
	<div style="padding-left:20px; padding-right:20px;">
		<div style="width:33%; float:left;">
			<div class="labelInput" style="margin-top:0px;">Company Name *</div>
			<div><input name="dname" class="profileInput" type="text"  value="<?=$driver->name?>"/></div>

			<div class="labelInput">Contact Name *</div>
			<div><input name="dcontact" class="profileInput" type="text"  value="<?=$driver->contact?>"/></div>

		</div>
		<div style="width:33%; float:left;">
				<div class="labelInput" style="margin-top:0px;">Email *</div>
			<div><input name="demail" class="profileInput" type="text"  value="<?=$driver->email?>"/></div>

			<div class="labelInput">Phone 1 *</div>
			<div><input name="dphone" class="profileInput" type="text"  value="<?=$driver->phone?>"/></div>

			<div class="labelInput">Phone 2</div>
			<div><input name="dphone2" class="profileInput" type="text"  value="<?=$driver->phone2?>"/></div>
			

			<div class="labelInput">Mobile</div>
			<div><input name="dMobile" class="profileInput" type="text"  value="<?=$driver->mobile?>"/></div>


			<div class="labelInput">Fax</div>
			<div><input name="dfax" class="profileInput" type="text"  value="<?=$driver->fax?>"/></div>
		</div>
		<div style="width:33%; float:left;">
			<div class="labelInput" style="margin-top:0px;">Address</div>
			<div><input name="daddr" class="profileInput" type="text"  value="<?=$driver->addr?>"/></div>

			<div class="labelInput">City</div>
			<div><input name="daddr2" class="profileInput" type="text"  value="<?=$driver->addr2?>"/></div>

			<div class="labelInput">State/Zip</div>
			<div><input name="daddrState" class="profileInput" type="text"  style="width:147px;" value="<?=$driver->addrState?>"/><input class="profileInput" type="text" style="width:70px; margin-left:3px;" name="daddrZip"  value="<?=$driver->addrState?>"/></div>

			<div class="labelInput">Country</div>
			<div><input name="addrCountry" class="profileInput" type="text"  value="<?=$driver->addrCountry?>"/></div>
		</div>
	</div>

	<div style="clear:both;"></div>
	<div style="margin-top:20px; height:20px; border-top:dashed 1px #24567A;"></div>
	 <div onclick="event.stopPropagation();  $(this).parent().parent().parent().parent().prev().prev().find('.iopen').click();" style="font-size:14px;  margin:0px; float:right; padding:10px; padding-left:10px; padding-right:10px; font-size:12px; margin-top:2px; width:60px; " class="ibutton">Cencel</div>
	 <div onclick="event.stopPropagation();  updateDriver('<?=$driver->id?>');" style="font-size:14px;  margin:0px; float:right; padding:10px; padding-left:10px; padding-right:10px; font-size:12px; margin-top:2px; width:90px; margin-right:10px;" class="ibutton">Save Driver</div>
	<div style="clear:both;"></div>
	</form>
</div>
