<div style="padding:20px; padding-top:10px; width:900px; background-color:#ff5050; margin:0px auto; margin-bottom:10px; padding-bottom:30px;">
	<div style="font-size:14px; color:#FFFFFF; margin-bottom:10px;  margin-top:0px;">
		<div style="float:left; margin-top:10px;">SEND SMS
		</div>
		<input type="hidden" id="EID" value="<?=$qid?>"/>
		
		<div style="float:right; ">
		<div style="font-size:12px; color:#ffffff;">moblie number:</div>
		<span style="padding-left:0px; "><input type="text" name="specEmail" id="specEmail" style="font-size:12px; width:250px;" value="<?php if(isset($quote->Phone)){ echo "1".str_replace('-', '',$quote->Phone); } ?>"/></span>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="font-size:11px; color:#FFFFFF; margin-top:10px; margin-bottom:2px;">SMS text</div>
	<div>
		<input type="text" name="smstext" id="smstext" style="float:left; margin-right:5px;"/>
		<div id="launchButtonML" onclick="send_sms('<?=base_url()?>', $('#EID').val(), $('#specEmail').val(), $('#smstext').val());" class="upmenuButton iredButton buttonGreen" style="margin-left:10px; border-radius:10px; padding:8px; margin-top:0px; padding-left:15px;  padding-right:15px; font-size:15px;">LAUNCH!</div>	
		<div style="clear:both;"></div>
	</div>

	<div id="EditEmailContainer" style="padding:10px; display:none; margin-top:20px; width:calc(100%-20px);">
		<div style="text-align:center; background-color:#ffffff; padding:40px;"><img src="<?=base_url()?>img/loading.gif"/></div>
	</div>

	<div style="margin-top:20px;">


		</div>


	
</div>