<style>
.DriversRow:hover{
	background-color:#cccccc !important;
}
</style>
<?php if($quote->distance == 0) $quote->distance = 1; ?>
<div style="padding:00px; background-color:#ffffff;">
<div>
<div id="RouteHistoryButton" onclick="show_drivers_tableF('<?=base_url()?>', $(this), '<?=$quote->id?>')" style="float:left; background-color:#80ACD1; color:#ffffff; text-align:center; padding:10px; padding-left:20px; padding-right:20px; font-size:14px; cursor:pointer; font-weight:bold;  ">ROUTE HISTORY</div>
<div id="LocalCompaniesButton" onclick="show_drivers_tableLC('<?=base_url()?>', $(this), '<?=$quote->id?>', 'Origin')"  style="float:left; background-color:#ffffff; color:#333333; text-align:center; padding:10px; padding-left:20px; padding-right:20px; font-size:14px; cursor:pointer; font-weight:bold;  ">LOCAL COMPANIES</div>
<div id="FavoritesButton" onclick="show_drivers_tableFav('<?=base_url()?>', $(this), '<?=$quote->id?>')" style="float:left; background-color:#ffffff; color:#333333; text-align:center; padding:10px; padding-left:20px; padding-right:20px; font-size:14px; cursor:pointer; font-weight:bold;  ">FAVORITES</div>
<div style="clear:both;"></div>
</div>
<table class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head" style="background-color:#80ACD1; color:#ffffff;">
				<td style="text-align:center; width:5px;"><input type="checkbox" onclick="event.stopPropagation(); if($(this).prop('checked')){ $('.DSelectedItem').prop('checked', true).change(); }else{ $('.DSelectedItem').prop('checked', false).change(); } " style="margin-left:10px; width:15px; cursor:pointer;" /></td>
				<td style="text-align:left; "><div onclick="show_drivers_mass_launch_block('<?=base_url()?>', $(this), '<?=$qid?>');" style="margin-top:-3px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: 0px;  margin-right: 0px;   padding: 2px;   display: inline-block;  padding-right: 10px;  padding-left: 10px; font-size:10px;" class="iRedButton buttonOther">MASS LAUNCH</div></td>
				<td style="text-align:center; width:20px;">ID</td>
				<td style="padding-left:20px; width:200px;">Company Name</td>
				<td style="width:120px;">Phone</td>
				<td style="width:70px;">Email</td>
				<td >Price per mile</td>
				<td style="text-align:left;     width: 70px;">CHECKED</td>
                <td style="width:35px;"></td>
				
			</tr>
		<?php
		foreach($drivers as $item){ 
			$PPcoment = "";
			if($item->price_per_mile == 0) {
				
				$item->price_per_mile = round($item->COD / $quote->distance, 2);
				$PPcoment = "<span title='".$item->from_city.','.$item->from_state." | ".$item->to_city.','.$item->to_state."' style='padding:3px; padding-left:10px; padding-right:10px; background-color:#ffffff; border:solid 1px #dddddd; cursor:pointer;'>?</span>"; 
			} 
			?>
		<tr style="cursor:pointer;" class="contentRow DriversRow" onclick=" $('#priceValF').html('<?=round($item->COD, 2)?>'); recountTBprices(2); $('#FsaveButton').fadeIn(500); $('#FcencelButton').fadeIn(500);">
			<td style="text-align:center; width:5px; font-size:12px;"> <input type="checkbox" style="margin-left:10px; width:15px; margin-top:0px; cursor:pointer;" id="<?=$item->driver_id?>" class="DSelectedItem"/></td>

			<td onclick="event.stopPropagation();" style=" width:100px; font-size:11px; text-align:left; padding-left:10px; padding-right:10px;">
		         <div  title="Emails Sent" style="<?php if($item->emailsSent > 0) { echo "background-color:#1970B0; color:#ffffff;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> margin:3px auto; border-radius:7px; cursor:pointer; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px;  "><?=$item->emailsSent?></div>
		           <div  title="Emails Opened" style="margin:3px auto; cursor:pointer; border-radius:7px; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($item->emailsOpened > 0) { echo "background-color:#FFFF00; color:#000000;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$item->emailsOpened?></div>
		          <div  title="Emails Recived" style="margin:3px auto; cursor:pointer; border-radius:7px;  font-size:9px;display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($item->emailsRecived > 0) { echo "background-color:rgb(0,255,128); color:#000000;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$item->emailsRecived?></div>
	         	<?php $countNotices = 0; ?>

	           	 <div title="Notices" onclick="show_quote_notice('<?=base_url()?>', '<?=(($item->driver_id)*(-1))?>', $(this));" style="cursor:pointer; margin:3px auto; font-size:9px; border-radius:7px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($item->countNotices > 0) { echo "background-color:#ff5050; color:#ffffff;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$item->countNotices?></div>
	        
      			 <div onclick="event.stopPropagation(); show_driver_launch_block('<?=base_url()?>', $(this), '<?=$item->driver_id?>', '<?=$qid?>');" style="margin-top:2px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: 0px;  margin-right: 0px;   padding: 5px; border:none !important;  display: inline-block;  margin-left:0px; padding-right: 10px;  padding-left: 10px;" class="iRedButton buttonGreen">LAUNCH DITAILS</div>
    		</td>
			<td style="text-align:center; width:20px; font-size:12px;"><?=$item->driver_id?></td>
			 
			<td style="font-size:12px; padding-left:20px; width:200px;" title="<?=$item->name?>"><?php echo substr($item->name, 0, 50)."...";?> <?php if($item->coment != "") { ?><span  title="<?=$item->coment?>" style="cursor:pointer; padding:3px; display:inline-block; background-color:#ff5050; color:#ffffff; margin-left:5px; padding-left:10px; padding-right:10px;">i</span><?php } ?></td>
			<td style="font-size:12px; width:120px;"><?=$item->phone?><br/><?=$item->phone2?></td>
			<td style="font-size:12px; width:70px;" title="<?=$item->email?>"><?php echo substr($item->email, 0, 15)."..."?></td>
			<td style=" font-size:13px; width:100px; padding-right:10px; padding-left:10px;"><span style="font-size:15px;">$<?=round($item->COD, 2)?></span> ($<?=$item->price_per_mile?>) <?=$PPcoment?></td>
			<!--td style=" font-size:13px; width:130px;">
				<div onclick="$('#darker').fadeIn(500);  $('#dropListBlockD').fadeIn(500);" style="margin-top:2px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: 0px;  margin-right: 0px;   padding: 5px; border:none !important;  display: inline-block;  margin-left:0px; padding-right: 10px;  padding-left: 10px;" class="iRedButton buttonGreen">DISPATCH</div>

				
		        
			</td-->
			
			<td style="text-align:left; font-size:12px; width:70px;">
			<?=date('d/m/y', strtotime($item->atDate));?><br/>
			<?=date('h:i A', strtotime($item->atDate));?>
			</td>
            <td style="font-size:12px;width:35px;"><img class="drv_id_<?=$item->driver_id?>" src=<?php if(is_null($item->drivers_id_f)){echo("\"".base_url()."img/favorites_empty.png\"");}else{echo("\"".base_url()."img/favorites_full.png\"");}?> onclick="favorites('<?=base_url()?>', $(this), '<?=$item->driver_id?>', '<?=$item->drivers_id_f?>')" /></td>

			
		</tr>
		<?php } ?>
	</table>

	<!--div onclick="$('#FfindDriverButton').click();" style="position:absolute; top:225px; right:150px; cursor:pointer;"><img src="<?=base_url()?>img/S006.png"/></div>
       
        </div-->

</div>