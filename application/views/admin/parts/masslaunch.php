<style>
.ButtonSEND.bactive{
	color:#1A1A1A; 
	background-color:#ffffff;  
	text-align:center; 
	padding-top:15px; 
	padding-bottom:15px;
	width:50%; 
	float:left;
}

.ButtonSEND{
	color:#ffffff; 
	background-color:#A8B3C2; 
	width:50%; 
	cursor:pointer; 
	float:left; 
	text-align:center; 
	padding-top:15px; 
	padding-bottom:15px;
}
</style>
<div style="width:900px; margin:0px auto; background-color:#ffffff;">
	<?php $qids = explode('`', $qid); if(count($qids) > 1) $qid = 0; ?>
	<div onclick=" $('.bactive').removeClass('bactive'); $(this).addClass('bactive');  $('#sendSMSblock').stop().fadeIn(500); $('#sendEmailBlock').stop().fadeOut(500);" class="ButtonSEND">
		SEND SMS
	</div>
	<div onclick=" $('.bactive').removeClass('bactive'); $(this).addClass('bactive');  $('#sendEmailBlock').stop().fadeIn(500); $('#sendSMSblock').stop().fadeOut(500);" class="ButtonSEND bactive">
		SEND EMAIL
	</div>
	<div style="clear:both;"></div>
	
    <!-- --BEGIN------------------------ -->
    <div style="padding:20px; display:none;" id="sendSMSblock">
        <div style="float:left; width:50%;">
            <input type="hidden" id="QID" value="<?=$qid?>"/>
            <div style="color:#838383; font-size:13px;">Mobile number:</div>
            <div >
                <span style="padding-left:0px; "><input type="text" name="specEmail2" id="specEmail2" style="font-size:14px; border:solid 1px #CCCCCC;  width:250px;" value="<?php if(isset($quote->Phone)){ echo "1".str_replace('-', '',$quote->Phone); } ?>"/></span>
            </div>

            <!--Old LAUNCH-- <div id="launchButtonML" onclick="send_sms('<?=base_url()?>', $('#QID').val(), $('#specEmail2').val(), $('#smstext2').val());"	 class="upmenuButton buttonOther" style="margin-left:0px; color:#ffffff; border:none; border-radius:0px; padding:8px; margin-top:20px; padding-left:45px;  padding-right:45px; font-size:15px;">LAUNCH!</div>-->

        </div>

        <div style="float:left; width:50%;">
            <div style="color:#838383; font-size:13px;">SMS text:</div>
            <div>
                <textarea id="smstext2" name="smstext2" style="width:90%; height:100px; border:solid 1px #cccccc; font-size:14px;"></textarea>
            </div>
        </div>


        <div style="float:right; width:50%;">
            <div style="color:#838383; font-size:13px;">Choose template:</div>
            <select id="EID2" onchange="smstotextarea('<?=base_url()?>')" style="font-size:15px; float:left; margin-right:5px; padding:8px; border:solid 1px #cccccc; width:300px;" class="selectInput">
                <?php $nowDate = getDate(); foreach($sms as $item){ ?>
                    <option value="<?=$item->id?>"><?=$item->name?></option>
                <?php } ?>
                <option value="0">Without shablon</option>
            </select>
            <!--<div onclick="LauncherShowEditSMS('<?=base_url()?>', $('#EID2').val());" style="padding:8px; float:left;margin-left:5px; text-decoration:underline; margin-right:10px; font-size:15px; font-weight:bold; padding-left:15px; padding-right:15px; cursor:pointer; color:#0093C9; border-radius:10px;">
                Edit SMS
            </div>-->
            <div onclick="smstextsave('<?=base_url()?>', $('#EID2').val(),  $('#smstext2').val());" style="padding:8px; margin-left:5px; text-decoration:underline; margin-right:10px; font-size:15px; font-weight:bold; padding-left:15px; padding-right:15px; cursor:pointer; color:#0093C9; border-radius:10px;">
                Save changes
            </div>
            <div style="margin-top:10px;">
                <div id="launchButtonSL" onclick="send_sms('<?=base_url()?>', $('#QID').val(), $('#specEmail2').val(), $('#smstext2').val());" <?php /* onclick="showConfirmation('Send SMS?',  function(){ add_sms_to_send_launch('<?=base_url()?>', '<?=$qid?>', $('#EID2').val(), $('#datepickerS<?=$qid?>').val()+' '+$('#hoursS<?=$qid?>').val()+':'+$('#minutesS<?=$qid?>').val(), $('#specEmail2').val())});" */ ?>class="upmenuButton buttonOther" style="margin-left:0px; color:#ffffff; border:none; border-radius:0px; padding:8px; margin-top:20px; padding-left:45px;  padding-right:45px; font-size:15px;">LAUNCH!</div>
            </div>
        </div>


        <div>
            <div style="margin-left:0px; margin-right:5px; float:left; margin-top:10px;">
                <script type="text/javascript">
                    $( function() {
                        $("#datepickerS<?=$qid?>" ).datepicker();
                        $("#datepickerS<?=$qid?>" ).datepicker("option", "dateFormat", "dd.mm.yy" );
                        $("#datepickerS<?=$qid?>" ).datepicker("option", "minDate", "<?=date('d.m.Y', time())?>" );
                        //$( "#datepicker<?=$qid?>" ).datepicker( "option", "defaultDate:", "<?=date('d.m.Y', time())?>" );
                    } );

                    $(document).ready(function(){
                        $("#datepickerS<?=$qid?>" ).val('<?=date('d.m.Y', time())?>');
                    });
                </script>
                <div style="font-size:11px;   color:#1A1A1A; margin-top:13px; margin-bottom:2px;">Date to send</div>
                <input type="text" class="calendarInput" id="datepickerS<?=$qid?>" style="width:100px; color:#000000; border:solid 1px #cccccc;" value="<?=date('d.m.Y')?>" />
            </div>
            <div style="margin-left:5px; margin-right:5px; float:left; margin-top:10px;">
                <div style="font-size:11px; color:#1A1A1A; margin-top:10px; margin-bottom:2px;">Time to send</div>
                <select id="hoursS<?=$qid?>" class="selectInput" style="font-size:15px; width:70px !important; float:left; margin-right:5px; cursor:pointer; padding:8px; border:solid 1px #cccccc;">
                    <?php for($i=0; $i<24; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
                        <option <?php if($nowDate['hours'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
                    <?php } ?>
                </select>
                <span style="font-size:20px; display:block; float:left; color:#1A1A1A; margin-top:4px; padding-left:4px; margin-right:3px; padding-right:5px; ">:</span>
                <select id="minutesS<?=$qid?>" class="selectInput" style="font-size:15px;  float:left; margin-right:5px; padding:8px; cursor:pointer; border:solid 1px #cccccc; width:70px !important;">
                    <?php for($i=0; $i<60; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
                        <option <?php if($nowDate['minutes'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div style="clear:both;"></div>
        <div id="EditSMSContainer" style="padding:10px; display:none; margin-top:20px; width:calc(100%-20px);">
            <div style="text-align:center; background-color:#ffffff; padding:40px;"><img src="<?=base_url()?>img/loading.gif"/></div>
        </div>

        <div style="clear:both;"></div>
        <!---->



        <!---->
        <div style="clear:both;"></div>
        <div style="background-color:#ffffff; padding:0px;">

            <div style="font-size:16px; color:#4D4D4D; margin-bottom:5px; margin-top:30px; font-weight:bold;">WATING TO SEND</div>
            <!--<div onclick="showConfirmation('SEND ALL SMS?', function(){ launch_all_SMS('<?=base_url()?>', '<?=$qid?>', '<?=$item->sms_id?>', '<?=$item->id?>'); });" class="upmenuButton buttonOther" style=" border-left:solid 1px #217ab9; white-space:nowrap; padding:5px; font-size:13px; padding-left:10px; border:solid 2px #0095D6; padding-right:10px;">LAUNCH</div>-->
            <table id="SMSwaitingtable<?=$qid?>" class="insideTableWhiteGrey" border="0" style="width:100%; border-bottom:solid 3px #80ACD1;" cellpadding="0" cellspacing="0">
                <tr class="head" style="background-color:#80ACD1; color:#ffffff;">
                    <!--td style="text-align:center; width:70px;">ID</td-->
                    <td>SMS-name</td>
                    <td>SMS send to</td>
                    <td >Send Date</td>
                    <td style="text-align:center;">Status</td>
                    <td style="text-align:center; width:50px;"></td>
                    <td style="text-align:center; width:50px;"></td>
                </tr>
                <?php foreach($waitingSms as $item){ ?>
                    <tr class="contentRow">
                        <!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
                        <td style="font-size:13px; font-weight:bold;"><?=$item->name?></td>
                        <td style="font-size:13px; font-weight:bold;"><?=$item->phone?></td>
                        <td style=" font-size:13px; font-weight:bold;"><?=$item->sendAtDate?></td>
                        <td style="text-align:center;"><?php if($item->status == 0){ echo "Waiting"; }else{ echo "Cenceled"; } ?></td>
                        <td style="text-align:center; width:50px;"><div onclick="delete_wSMS('<?=base_url()?>', '<?=$item->id?>', '<?=$item->qid?>');" class="upmenuButton iredButton buttonOther" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>
                        <td style="text-align:center; width:50px;"><div onclick="showConfirmation('SEND SMS...', function(){ launch_SMS('<?=base_url()?>', '<?=$qid?>', '<?=$item->sms_id?>', '<?=$item->id?>'); });" class="upmenuButton buttonOther" style=" border-left:solid 1px #217ab9; white-space:nowrap; padding:5px; font-size:13px; padding-left:10px; border:solid 2px #0095D6; padding-right:10px;">LAUNCH</div></td>
                    </tr>
                <?php } ?>
            </table>

            <div style="font-size:16px; color:#4D4D4D; margin-bottom:5px; margin-top:30px; font-weight:bold;">SENDED SMS</div>
            <table class="insideTableWhiteGrey" border="0" style="width:100%; border-bottom:solid 3px #80ACD1;" cellpadding="0" cellspacing="0">
                <tr class="head" style="background-color:#80ACD1; color:#ffffff;">
                    <!--td style="text-align:center; width:70px;">ID</td-->
                    <td>SMS-name</td>
                    <td>SMS sent to</td>
                    <td style="text-align:center;">Send Date</td>
                    <td style="text-align:center;">Status</td>
                    <td style="text-align:center; width:50px;">Resend</td>
                </tr>
                <?php foreach($sendedSms as $item){ ?>
                    <tr id="smsrow<?=$item->id?>" class="contentRow">
                        <!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
                        <td style="font-size:14px; font-weight:bold;"><?=$item->name?></td>
                        <td style="font-size:13px; font-weight:bold;"><?=$item->phone?></td>
                        <td style="text-align:center; font-weight:bold;  font-size:13px;"><?=$item->atDate?></td>
                        <td style="text-align:center;  font-weight:bold;"><?php if($item->status == 0){ echo 'NOT OPEN'; }else if($item->status == 1){ echo "<div style='color:#ff5050'>OPENED</div><div style='font-size:12px; color:#999999;'>".$item->openedDate."</div>"; } ?></td>
                        <td style="text-align:center; width:50px;"><div onclick="showConfirmation('SEND EMAIL TO WAITING...', function(){sms_relaunch('<?=base_url()?>', '<?=$item->id?>', '<?=$item->sms_id?>', '<?=$qid?>', $('#datepickerS<?=$qid?>').val()+' '+$('#hoursS<?=$qid?>').val()+':'+$('#minutesS<?=$qid?>').val()); });" class="upmenuButton buttonOther" style="margin-left:0px; border-left:solid 1px #217ab9; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">RELAUNCH</div></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <!---->

    </div>
    <!---------END-------------------->
	<div style="padding:20px;" id="sendEmailBlock">
		<div style="width:50%; float:left;">
		<div style="color:#838383; font-size:13px;">Email name:</div>
			<?php $nowDate = getDate();  if((count($qids) == 1)&&($qids[0]!=0)){ ?>
			<div style="<?php if(count($qids) > 1){ ?> display:none; <?php } ?>">
			<span style="padding-left:0px; "><input type="text" name="specEmail" id="specEmail" style="font-size:14px; border:solid 1px #CCCCCC;  width:250px;" value="<?=$quote->Email?>"/></span>
			</div>
			<?php } ?>	

			<div>
				<div style="margin-left:0px; margin-right:5px; float:left; margin-top:10px;">
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
					<div style="font-size:11px;   color:#1A1A1A; margin-top:13px; margin-bottom:2px;">Date to send</div>
					<input type="text" class="calendarInput" id="datepicker<?=$qid?>" style="width:100px; color:#000000; border:solid 1px #cccccc;" value="<?=date('d.m.Y')?>" />
				</div>
				<div style="margin-left:5px; margin-right:5px; float:left; margin-top:10px;">
					<div style="font-size:11px; color:#1A1A1A; margin-top:10px; margin-bottom:2px;">Time to send</div>
					<select id="hours<?=$qid?>" class="selectInput" style="font-size:15px; width:70px !important; float:left; margin-right:5px; cursor:pointer; padding:8px; border:solid 1px #cccccc;">
					<?php for($i=0; $i<24; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
						<option <?php if($nowDate['hours'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
					<?php } ?>	
					</select>
					<span style="font-size:20px; display:block; float:left; color:#1A1A1A; margin-top:4px; padding-left:4px; margin-right:3px; padding-right:5px; ">:</span>
					<select id="minutes<?=$qid?>" class="selectInput" style="font-size:15px;  float:left; margin-right:5px; padding:8px; cursor:pointer; border:solid 1px #cccccc; width:70px !important;">
					<?php for($i=0; $i<60; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
						<option <?php if($nowDate['minutes'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
					<?php } ?>	
					</select>
				</div>
			</div>

		</div>

		<div style="float:left; width:50%;">
			<div style="color:#838383; font-size:13px;">Choose template:</div>
			<select id="EID" onchange="if($(this).val()=='0'){ LauncherShowEditEmail('<?=base_url()?>', 0); }" style="font-size:15px; float:left; margin-right:5px; padding:8px; border:solid 1px #cccccc; width:300px;" class="selectInput">
			<?php $nowDate = getDate(); foreach($emails as $item){ ?>
			<option value="<?=$item->id?>"><?=$item->name?></option>
			<?php } ?>
			<option value="0">Without shablon</option>
			</select>
			<div onclick="LauncherShowEditEmail('<?=base_url()?>', $('#EID').val());" style="padding:8px; float:left;margin-left:5px; text-decoration:underline; margin-right:10px; font-size:15px; font-weight:bold; padding-left:15px; padding-right:15px; cursor:pointer; color:#0093C9; border-radius:10px;">
				Edit Email
			</div>
			<div style="margin-top:10px;">
				<div id="launchButtonML" onclick="showConfirmation('Send ('+$('#EID').val()+'|'+$('#specEmail').val()+')...',  function(){ add_email_to_send_launch('<?=base_url()?>', '<?=$qid?>', $('#EID').val(), $('#datepicker<?=$qid?>').val()+' '+$('#hours<?=$qid?>').val()+':'+$('#minutes<?=$qid?>').val(), $('#specEmail').val()); });" class="upmenuButton buttonOther" style="margin-left:0px; color:#ffffff; border:none; border-radius:0px; padding:8px; margin-top:20px; padding-left:45px;  padding-right:45px; font-size:15px;">LAUNCH!</div>	
			</div>
		</div>	
		<div style="clear:both;"></div>
		<div id="EditEmailContainer" style="padding:10px; display:none; margin-top:20px; width:calc(100%-20px);">
		<div style="text-align:center; background-color:#ffffff; padding:40px;"><img src="<?=base_url()?>img/loading.gif"/></div>
	</div>


	<div style="background-color:#ffffff; padding:0px;">

	<div style="font-size:16px; color:#4D4D4D; margin-bottom:5px; margin-top:30px; font-weight:bold;">WATING TO SEND</div>
	<table id="waitingtable<?=$qid?>" class="insideTableWhiteGrey" border="0" style="width:100%; border-bottom:solid 3px #80ACD1;" cellpadding="0" cellspacing="0">
		<tr class="head" style="background-color:#80ACD1; color:#ffffff;">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td>Email send to</td>
			<td >Send Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;"></td>
			<td style="text-align:center; width:50px;"></td>
		</tr>
		<?php foreach($waitingEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:13px; font-weight:bold;"><?=$item->name?></td>
			<td style="font-size:13px; font-weight:bold;"><?=$item->specEmail?></td>
			<td style=" font-size:13px; font-weight:bold;"><?=$item->sendAtDate?></td>
			<td style="text-align:center;"><?php if($item->status == 0){ echo "Waiting"; }else{ echo "Cenceled"; } ?></td>
			<td style="text-align:center; width:50px;"><div onclick="delete_wemail('<?=base_url()?>', '<?=$item->id?>', '<?=$item->qid?>');" class="upmenuButton iredButton buttonOther" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
			<td style="text-align:center; width:50px;"><div onclick="showConfirmation('SEND EMAIL...', function(){ send_email('<?=base_url()?>', '<?=$qid?>', '<?=$item->eid?>', '<?=$item->id?>'); });" class="upmenuButton buttonOther" style=" border-left:solid 1px #217ab9; white-space:nowrap; padding:5px; font-size:13px; padding-left:10px; border:solid 2px #0095D6; padding-right:10px;">LAUNCH</div></td>	
		</tr>
		<?php } ?>
	</table>

	

	<div style="font-size:16px; color:#4D4D4D; margin-bottom:5px; margin-top:30px; font-weight:bold; ">RECIVED EMAILS</div>
	<table class="insideTableWhiteGrey" border="0" style="width:100%; border-bottom:solid 3px #80ACD1;" cellpadding="0" cellspacing="0">
		<tr class="head" style="background-color:#80ACD1; color:#ffffff;">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td style="text-align:center;">Recive Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Answer</td>
		</tr>
		<?php foreach($recivedEmails as $item){ 
				$text = explode("\n", $item->text);
				$output = "";
				foreach($text as $line){

					if((isset($line[0]))&&($line[0]==">")){
							break;
					}
					$output .= $line."\n";
				}

				$item->text = $output;
			?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=$item->id?></td-->
			<td style="font-size:17px; padding:10px;">
				<div onclick="$(this).next().slideDown(500); <?php if($item->status == 0){ ?> update_email_as_readed('<?=base_url()?>', <?=$item->id?>); <?php } ?>" style="cursor:pointer; text-decoration:underline;" ><?=$item->subject?></div>
				<div style="display:none; padding:5px; font-weight:bold; font-size:11px; margin-top:10px;"><?=nl2br($item->text)?>
					
				<div onclick="if($('#answer<?=$item->id?>').is(':hidden')){ $('#answer<?=$item->id?>').slideDown(500); }else{ $('#answer<?=$item->id?>').slideUp(500); }" style="padding:5px; display:inline-block; font-size:12px; margin-top:10px; padding-left:20px; cursor:pointer;  padding-right:20px; background-color:#ff5050; color:#ffffff;">
					SEND ANSWER
				</div>
				<div id="answer<?=$item->id?>" style="display:none; margin-top:10px;">
					<textarea style="width:500px; height:200px; border:solid 1px #dddddd;"></textarea><br/>
					<div onclick="sendAnswerEmail('<?=base_url()?>', '<?=$item->from_email?>', '<?=$item->message_id?>', $(this).prev().prev().val());" style="padding:5px; display:inline-block; font-size:12px; margin-top:10px; padding-left:20px; cursor:pointer; padding-right:20px; background-color:#ff5050; color:#ffffff;">
						SEND
					</div>
				</div>

				</div>
				
			</td>
			<td style="text-align:center; font-size:13px; font-weight:bold;"><?=$item->atDate?></td>
			<td style="text-align:center; color:#999999; font-weight:bold;"><?php if($item->status == 0) { ?><span style="color:#ff5050;">NEW</span><?php }else if($item->status == 1){ ?>READED<?php } ?></td>	
			<td style="text-align:center; width:50px;"><div onclick="delete_recived_email('<?=base_url()?>', <?=$item->id?>, '<?=$item->qid?>');" class="upmenuButton iredButton buttonOther" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
		</tr>
		<?php } ?>
		
	</table>

	
	<div style="font-size:16px; color:#4D4D4D; margin-bottom:5px; margin-top:30px; font-weight:bold;">SENDED EMAILS</div>
	<table class="insideTableWhiteGrey" border="0" style="width:100%; border-bottom:solid 3px #80ACD1;" cellpadding="0" cellspacing="0">
		<tr class="head" style="background-color:#80ACD1; color:#ffffff;">
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
			<td style="font-size:14px; font-weight:bold;"><?=$item->name?></td>
			<td style="font-size:13px; font-weight:bold;"><?=$item->specEmail?></td>
			<td style="text-align:center; font-weight:bold;  font-size:13px;"><?=$item->atDate?></td>
			<td style="text-align:center;  font-weight:bold;"><?php if($item->status == 0){ echo 'NOT OPEN'; }else if($item->status == 1){ echo "<div style='color:#ff5050'>OPENED</div><div style='font-size:12px; color:#999999;'>".$item->openedDate."</div>"; } ?></td> 
			<td style="text-align:center; width:50px;"><div onclick="$('#darker').fadeIn(500);" class="upmenuButton buttonOther" style="margin-left:0px; border-left:solid 1px #217ab9; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">RELAUNCH</div></td>
		</tr>
		<?php } ?>

	</table>
	</div>
	</div>

	</div>

</div>
<?php /* ?>
<div style="padding:20px; padding-top:10px; width:900px; background-color:#ff5050; margin:0px auto; margin-bottom:10px; padding-bottom:30px;">
	<?php $qids = explode('`', $qid); if(count($qids) > 1) $qid = 0; ?>
	<div style="font-size:14px; color:#FFFFFF; margin-bottom:10px;  margin-top:0px;">
		<div style="float:left; margin-top:10px;">SEND EMAIL <span><?php if(count($qids) > 1){ echo "(MASS LAUNCH ".(count($qids)-1)." recipients)"; }else{ echo "(#".str_pad ($qid, 7,"0",STR_PAD_LEFT).")"; } ?></span>
		</div>
		<?php if((count($qids) == 1)&&($qids[0]!=0)){ ?>
		<div style="float:right; <?php if(count($qids) > 1){ ?> display:none; <?php } ?>">
		<div title="client Email: <?=$quote->Email?>" style="font-size:12px; color:#ffffff;">Email to send:</div>
		<span style="padding-left:0px; "><input type="text" name="specEmail" id="specEmail" style="font-size:12px; width:250px;" value="<?=$quote->Email?>"/></span>
		</div>
		<?php } ?>
		<div style="clear:both"></div>
	</div>
	<div style="font-size:11px; color:#FFFFFF; margin-top:10px; margin-bottom:2px;">choose email shablon</div>
	<div>
		<select id="EID" onchange="if($(this).val()=='0'){ LauncherShowEditEmail('<?=base_url()?>', 0); }" style="font-size:15px; float:left; margin-right:5px; padding:8px; border:solid 1px #ffffff; width:300px;" class="selectInput">
			<?php $nowDate = getDate(); foreach($emails as $item){ ?>
			<option value="<?=$item->id?>"><?=$item->name?></option>
			<?php } ?>
			<option value="0">Without shablon</option>
		</select>
		<div onclick="LauncherShowEditEmail('<?=base_url()?>', $(this).prev().val());" class="buttonBlue" style="padding:8px; float:left;margin-left:5px; background-color:#005696; margin-right:10px; font-size:15px; padding-left:15px; padding-right:15px; cursor:pointer; color:#ffffff; border-radius:10px;">
		EDIT
		</div>
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
			<div style="font-size:11px;   color:#ffffff; margin-top:13px; margin-bottom:2px;">Date to send</div>
			<input type="text" class="calendarInput" id="datepicker<?=$qid?>" style="width:100px; color:#000000; border:solid 1px #ffffff;" value="<?=date('d.m.Y')?>" />
		</div>
		<div style="margin-left:5px; margin-right:5px; float:left; margin-top:-27px;">
			<div style="font-size:11px; color:#ffffff; margin-top:10px; margin-bottom:2px;">Time to send</div>
			<select id="hours<?=$qid?>" class="selectInput" style="font-size:15px; width:70px !important; float:left; margin-right:5px; cursor:pointer; padding:8px; border:solid 1px #ffffff;">
			<?php for($i=0; $i<24; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
				<option <?php if($nowDate['hours'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
			<?php } ?>	
			</select>
			<span style="font-size:20px; display:block; float:left; color:#ffffff; margin-top:4px; padding-left:4px; margin-right:3px; padding-right:5px; ">:</span>
			<select id="minutes<?=$qid?>" class="selectInput" style="font-size:15px;  float:left; margin-right:5px; padding:8px; cursor:pointer; border:solid 1px #ffffff; width:70px !important;">
			<?php for($i=0; $i<60; $i++){ if($i < 10) { $j="0".$i; }else{ $j=$i; } ?>
				<option <?php if($nowDate['minutes'] == $i) echo "selected='selected'"; ?> value="<?=$i?>"><?=$j?></option>
			<?php } ?>	
			</select>
		</div>

		<div id="launchButtonML" onclick="add_email_to_send_launch('<?=base_url()?>', '<?=$qid?>', $('#EID').val(), $('#datepicker<?=$qid?>').val()+' '+$('#hours<?=$qid?>').val()+':'+$('#minutes<?=$qid?>').val(), $('#specEmail').val());" class="upmenuButton iredButton buttonGreen" style="margin-left:10px; border-radius:10px; padding:8px; margin-top:0px; padding-left:15px;  padding-right:15px; font-size:15px;">LAUNCH!</div>	
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

	<div style="font-size:13px; color:#24567A; margin-bottom:10px;">WATING TO SEND</div>
	<table id="waitingtable<?=$qid?>" class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>Email-name</td>
			<td>Email send to</td>
			<td >Send Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">Cencel</td>
			<td style="text-align:center; width:50px;">Send now</td>
		</tr>
		<?php foreach($waitingEmails as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:13px;"><?=$item->name?></td>
			<td style="font-size:13px;"><?=$item->specEmail?></td>
			<td style=" font-size:13px;"><?=$item->sendAtDate?></td>
			<td style="text-align:center;"><?php if($item->status == 0){ echo "Waiting"; }else{ echo "Cenceled"; } ?></td>
			<td style="text-align:center; width:50px;"><div onclick="delete_wemail('<?=base_url()?>', '<?=$item->id?>', '<?=$item->qid?>');" class="upmenuButton iredButton buttonOther" style="margin-left:0px; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">DELETE</div></td>	
			<td style="text-align:center; width:50px;"><div onclick="send_email('<?=base_url()?>', '<?=$qid?>', '<?=$item->eid?>', '<?=$item->id?>');" class="upmenuButton buttonGreen" style=" border-left:solid 1px #217ab9; white-space:nowrap; padding:5px; font-size:13px; padding-left:10px;padding-right:10px;">LAUNCH</div></td>	
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

*/?>