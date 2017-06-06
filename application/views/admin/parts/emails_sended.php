<div style="padding:20px; padding-top:10px; width:900px; margin:0px auto; margin-bottom:10px; background-color:#ffffff; padding-bottom:30px; border-bottom:solid 2px #00ACFF;">

	<div style="font-size:14px; color:#24567A; margin-bottom:10px;  margin-top:0px;">SEND NEW EMAIL</div>
	<div style="font-size:11px; color:#24567A; margin-top:10px; margin-bottom:2px;">choose email shablon</div>
	<div>
		<select onchange="if($(this).val()=='49'){ show_emails_change('<?=base_url()?>', '49'); }" style="font-size:15px; float:left; margin-right:5px; padding:8px; border:solid 1px #24567A; width:250px;">
			<?php $nowDate = getDate(); foreach($emails as $item){ ?>
			<option value="<?=$item->id?>"><?=$item->name?></option>
			<?php } ?>
			<option value="49">Without shablon</option>
		</select>
		<div style="margin-left:5px; margin-right:5px; float:left; margin-top:-30px;">
			<script type="text/javascript">
				$( function() {
				    $("#datepicker<?=$qid?>" ).datepicker();
				    $("#datepicker<?=$qid?>" ).datepicker("option", "dateFormat", "dd.mm.yy" );
				    $("#datepicker<?=$qid?>" ).datepicker("option", "minDate", "<?=date('d.m.Y', time())?>" );
				    ;
				    //$( "#datepicker<?=$qid?>" ).datepicker( "option", "defaultDate:", "<?=date('d.m.Y', time())?>" );
				  } );

				$(document).ready(function(){
			        $("#datepicker<?=$qid?>" ).val('<?=date('d.m.Y', time())?>');
			    });
			</script>
			<div style="font-size:11px;   color:#24567A; margin-top:13px; margin-bottom:2px;">Date to send</div>
			<input type="text" class="calendarInput" id="datepicker<?=$qid?>" style="width:150px; color:#000000; border:solid 1px #24567A;" value="<?=date('d.m.Y')?>" />
		</div>
		<div style="margin-left:5px; margin-right:5px; float:left; margin-top:-27px;">
			<div style="font-size:11px; color:#24567A; margin-top:10px; margin-bottom:2px;">Time to send</div>
			<select id="hours<?=$qid?>" style="font-size:15px; float:left; margin-right:5px; cursor:pointer; padding:8px; border:solid 1px #24567A;">
			<?php for($i=0; $i<24; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
				<option <?php if($nowDate['hours'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
			<?php } ?>	
			</select>
			<span style="font-size:20px; display:block; float:left; color:#24567A; margin-top:4px; padding-left:4px; margin-right:3px; padding-right:5px; ">:</span>
			<select id="minutes<?=$qid?>" style="font-size:15px;  float:left; margin-right:5px; padding:8px; cursor:pointer; border:solid 1px #24567A;">
			<?php for($i=0; $i<60; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
				<option <?php if($nowDate['minutes'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
			<?php } ?>	
			</select>
		</div>

		<div onclick="add_email_to_send('<?=base_url()?>', '<?=$qid?>', $(this).prev().prev().prev().val(), $('#datepicker<?=$qid?>').val()+' '+$('#hours<?=$qid?>').val()+':'+$('#minutes<?=$qid?>').val());" class="upmenuButton iredButton" style="margin-left:10px; padding:8px; margin-top:0px; padding-left:15px; padding-right:15px; font-size:15px;">A ADD TO LAUNCH LIST</div>	
		<div style="clear:both;"></div>
	</div>

	<div style="margin-top:0px; height:10px; border-top:dashed 1px #24567A; margin-top:20px;"></div>

	<div style="font-size:13px; color:#24567A; margin-bottom:10px; margin-top:10px;">WATING TO SEND</div>
	<table id="waitingtable<?=$qid?>" class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td >Send Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Cencel</td>
			<td style="text-align:center; width:50px;">Send now</td>
		</tr>
		<?php foreach($waitingEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:13px;"><?=$item->name?></td>
			<td style=" font-size:13px;"><?=$item->sendAtDate?></td>
			<td style="text-align:center;"><?php if($item->status == 0){ echo "Waiting"; }else{ echo "Cenceled"; } ?></td>
			<td style="text-align:center; width:50px;"><div onclick="delete_wemail('<?=base_url()?>', '<?=$item->id?>', '<?=$item->qid?>');" class="upmenuButton iredButton" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
			<td style="text-align:center; width:50px;"><div onclick="send_email('<?=base_url()?>', '<?=$qid?>', '<?=$item->eid?>', '<?=$item->id?>');" class="upmenuButton" style=" border-left:solid 1px #217ab9; white-space:nowrap; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">SEND NOW</div></td>	
		</tr>
		<?php } ?>
	</table>

	<div style="margin-top:0px; height:10px; border-top:dashed 1px #24567A; margin-top:20px;"></div>

	<div style="font-size:13px; color:#24567A; margin-bottom:10px; margin-top:10px; ">RECIVED EMAILS</div>
	<table class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td style="text-align:center;">Recive Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Answer</td>
		</tr>
		<?php foreach($recivedEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=$item->id?></td-->
			<td style="font-size:17px; padding:10px;">
				<div onclick="$(this).next().slideDown(500); <?php if($item->status == 0){ ?> update_email_as_readed('<?=base_url()?>', <?=$item->id?>); <?php } ?>" style="cursor:pointer; text-decoration:underline;" ><?=$item->subject?></div>
				<div style="display:none; padding:5px; font-size:11px; margin-top:10px;"><?=nl2br($item->text)?></div>
			</td>
			<td style="text-align:center; font-size:13px;"><?=$item->atDate?></td>
			<td style="text-align:center; color:#999999;"><?php if($item->status == 0) { ?><span style="color:#ff5050;">NEW</span><?php }else if($item->status == 1){ ?>READED<?php } ?></td>	
			<td style="text-align:center; width:50px;"><div onclick="delete_recived_email('<?=base_url()?>', <?=$item->id?>, '<?=$item->qid?>');" class="upmenuButton iredButton" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
		</tr>
		<?php } ?>
		
	</table>

	<div style="margin-top:0px; height:10px; border-top:dashed 1px #24567A; margin-top:20px;"></div>

	<div style="font-size:13px; color:#24567A; margin-bottom:10px;  margin-top:10px;">SENDED EMAILS</div>
	<table class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td style="text-align:center;">Send Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Resend</td>
		</tr>
		<?php foreach($sendedEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:14px;"><?=$item->name?></td>
			<td style="text-align:center;  font-size:13px;"><?=$item->atDate?></td>
			<td style="text-align:center;"><?php if($item->status == 0){ echo 'NOT OPEN'; }else if($item->status == 1){ echo "<div style='color:#ff5050'>OPENED</div><div style='font-size:12px; color:#999999;'>".$item->openedDate."</div>"; } ?></td> 
			<td style="text-align:center; width:50px;"><div onclick="$('#darker').fadeIn(500);" class="upmenuButton" style="margin-left:0px; border-left:solid 1px #217ab9; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">RESEND</div></td>
		</tr>
		<?php } ?>

	</table>
</div>