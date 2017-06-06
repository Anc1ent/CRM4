<div style="padding:20px; padding-top:10px; width:900px; background-color:#005696; margin:0px auto; margin-bottom:10px; padding-bottom:30px;">
	<?php $qids = explode('`', $qid); if(count($qids) > 1) $qid = 0; ?>
	<div style="font-size:14px; color:#FFFFFF; margin-bottom:10px;  margin-top:0px;">
		<div style="float:left; margin-top:10px;">SEND TO DRIVER EMAIL <span><?php if(count($qids) > 1){ echo "(MASS LAUNCH ".(count($qids)-1)." recipients)"; }else{ echo "(#".str_pad ($qid, 7,"0",STR_PAD_LEFT).")"; } ?></span>
		</div>
		<?php if((count($qids) == 1)&&($qids[0]!=0)){ ?>
		<div style="float:right; <?php if(count($qids) > 1){ ?> display:none; <?php } ?>">
		<div title="client Email: <?=$driver->email?>" style="font-size:12px; color:#ffffff;">Email to send:</div>
		<span style="padding-left:0px; "><input type="text" name="specEmail" id="DspecEmail" style="font-size:12px; width:250px;" value="<?=$driver->email?>"/></span>
		</div>
		<?php } ?>
		<div style="clear:both"></div>
	</div>
	<div style="font-size:11px; color:#FFFFFF; margin-top:10px; margin-bottom:2px;">choose email shablon</div>
	<div>
		<select id="DEID" onchange="if($(this).val()=='0'){ LauncherDriverShowEditEmail('<?=base_url()?>', 0); }" style="font-size:15px; float:left; margin-right:5px; padding:8px; border:solid 1px #ffffff; width:300px;" class="selectInput">
			<?php $nowDate = getDate(); foreach($emails as $item){ ?>
			<option value="<?=$item->id?>"><?=$item->name?></option>
			<?php } ?>
		</select>
		<div onclick="LauncherDriverShowEditEmail('<?=base_url()?>', $(this).prev().val());" class="buttonGreen" style="padding:8px; float:left;margin-left:5px; background-color:#005696; margin-right:10px; font-size:15px; padding-left:15px; padding-right:15px; cursor:pointer; color:#ffffff; border-radius:10px;">
		EDIT
		</div>
		

		<div id="launchButtonML" onclick="send_drivers_email('<?=base_url()?>', '<?=$qid?>', $('#DEID').val(), $('#DspecEmail').val(), '<?=$quote_id?>');" class="upmenuButton iredButton buttonGreen" style="margin-left:10px; border:none !important; border-radius:10px; padding:8px; margin-top:0px; padding-left:15px;  padding-right:15px; font-size:15px;">LAUNCH!</div>	
		<div style="clear:both;"></div>
	</div>

	<div id="EditEmailContainer" style="padding:10px; display:none; margin-top:20px; width:calc(100%-20px);">
		<div style="text-align:center; background-color:#ffffff; padding:40px;"><img src="<?=base_url()?>img/loading.gif"/></div>
	</div>

	<div style="margin-top:20px;">

		<div id="iPerrscabTitle" style="font-size:18px; padding:10px; color:#ffffff; background-color:#00ACFF;">
<div style="float:left;padding-left:13px; ">LAUNCH CONSOLE</div>
<!--div id="closeEmailWindow" onclick="$('#editemailblock').fadeOut(500);" style="float:right; padding-right:15px; font-size:13px; cursor:pointer; padding:3px; padding-left:10px; padding-right:10px; background-color:rgba(255,255,255,0.2);">close</div-->
<div style="clear:both;"></div>
</div>
	<div style="background-color:#ffffff; padding:20px;">

	<div style="font-size:13px; color:#24567A; margin-bottom:10px; ">RECIVED EMAILS</div>
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
			<td style="text-align:center; width:50px;"><div onclick="delete_recived_email('<?=base_url()?>', <?=$item->id?>, '<?=$item->qid?>');" class="upmenuButton iredButton buttonOther" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
		</tr>
		<?php } ?>
		
	</table>

	<div style="margin-top:0px; height:10px; border-top:dashed 1px #24567A; margin-top:20px;"></div>

	<div style="font-size:13px; color:#24567A; margin-bottom:10px;  margin-top:10px;">SENDED EMAILS</div>
	<table class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td>Email send to</td>
			<td style="text-align:center;">Send Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Resend</td>
		</tr>
		<?php foreach($sendedEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:14px;"><?=$item->name?></td>
			<td style="font-size:13px;"><?=$item->specEmail?></td>
			<td style="text-align:center;  font-size:13px;"><?=$item->atDate?></td>
			<td style="text-align:center;"><?php if($item->status == 0){ echo 'NOT OPEN'; }else if($item->status == 1){ echo "<div style='color:#ff5050'>OPENED</div><div style='font-size:12px; color:#999999;'>".$item->openedDate."</div>"; } ?></td> 
			<td style="text-align:center; width:50px;"><div onclick="$('#darker').fadeIn(500);" class="upmenuButton buttonGreen" style="margin-left:0px; border-left:solid 1px #217ab9; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">RELAUNCH</div></td>
		</tr>
		<?php } ?>

	</table>
	</div>
	</div>


	
</div>