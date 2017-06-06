<li onclick="activateQuote('<?=base_url()?>','<?=$data->id?>', 0);" id="q-<?=$data->id?>" class="itemQT  <?=$OddClass?>"  >
  <div class="cell" style="width:4%;">
        <input onchange="$('#countSelectedItems').html($('.SelectedItem:checked').length);" type="checkbox" style="margin-left:10px; width:15px; margin-top:15px;" id="<?=$data->id?>" class="SelectedItem"/>
    </div>
    <div class="cell" style=" width:11%; font-size:11px;">
      
       <?=str_pad ($data->id, 5,"0",STR_PAD_LEFT)?> <div onclick="event.stopPropagation(); show_qhistory('<?=base_url()?>', $(this), '<?=$data->id?>');" class="editIconB" style="display:inline-block;">H</div><br/>
           <div onclick="event.stopPropagation(); show_table_emails_stat('<?=base_url()?>', 'waiting', <?=$data->id?>, $(this));" title="Emails Wait" style="<?php if($data->emailsWait > 0) { echo "background-color:#888888; color:#ffffff;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> margin:3px auto; border-radius:7px; cursor:pointer; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px;  "><?=$data->emailsWait?></div>
         <div onclick="event.stopPropagation(); show_table_emails_stat('<?=base_url()?>', 'sended', <?=$data->id?>, $(this));" title="Emails Sent" style="<?php if($data->emailsSent > 0) { echo "background-color:#1970B0; color:#ffffff;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> margin:3px auto; border-radius:7px; cursor:pointer; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px;  "><?=$data->emailsSent?></div>
           <div onclick="event.stopPropagation(); show_table_emails_stat('<?=base_url()?>', 'opened', <?=$data->id?>, $(this));" title="Emails Opened" style="margin:3px auto; cursor:pointer; border-radius:7px; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($data->emailsOpened > 0) { echo "background-color:#FFFF00; color:#000000;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$data->emailsOpened?></div>
          <div onclick="event.stopPropagation(); show_table_emails_stat('<?=base_url()?>', 'recived', <?=$data->id?>, $(this));" title="Emails Recived" style="margin:3px auto; cursor:pointer; border-radius:7px;  font-size:9px;display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($data->emailsRecived > 0) { echo "background-color:rgb(0,255,128); color:#000000;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$data->emailsRecived?></div>
         

            <div title="Notices" onclick="event.stopPropagation(); show_quote_notice('<?=base_url()?>', '<?=$data->id?>', $(this));" style="cursor:pointer; margin:3px auto; font-size:9px; border-radius:7px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($countNotices > 0) { echo "background-color:#ff5050; color:#ffffff;"; }else{ echo "background-color:#dddddd; color:#000000;";  } ?> "><?=$countNotices?></div>
        
      
    </div>
    <div class="cell" style="width:7%; font-size:11px;">
        <?php if($data->addDate == "0000-00-00 00:00:00") $data->addDate = time(); ?>
       <?=date('m/d/y', strtotime($data->addDate))?>
       <div style="color:#00ACFF;"><?=date('h:i A', strtotime($data->addDate))?></div>
    </div>
    <div class="cell" style="width:14%; font-size:12px;">
       <div ><?=$data->FirstName?> </div>
        <div style="font-size:11px; margin-top:0px;"><?=$data->Phone?></div>
        <div  title="<?=$data->Email?>" style="font-size:11px; color:#00ACFF; cursor:pointer;  margin-top:0px; <?php if($data->activeEmail == 1) echo "font-weight:bold; text-decoration:underline;"; ?> <?php if($data->activeEmail == 2) echo "font-weight:bold; text-decoration:line-through; color:#ff5050;"; ?>"><?=substr($data->Email, 0 ,15)."..."?></div>
    </div>
    <div class="cell" style="width:13%; ">
        <div style="font-size:10px; margin-top:0px;">
        <?=$data->carYear?> <?=$data->carMake?><br/><?=$data->carModel?>
        </div> 
        <div style="font-size:11px; margin-top:0px; color:#00ACFF; display:inline-block;">
            <?=$data->carType?>
        </div>
        <div style="font-size:11px; margin-top:0px; color:#ff5050; display:inline-block; margin-left:5px;">
            <?php if($data->vechinesRun == 0) {  }else if( $data->vechinesRun == 1 ){  }else{ echo "INOP"; }?>
        </div>
    </div>
    <div class="cell" style=" width:10%; " onclick="event.stopPropagation();  activateQuote('<?=base_url()?>','<?=$data->id?>', 1);">
        <div style="font-size:11px; margin-top:0px; position:relative;">
            <?=$data->distFromState?><br/><?=$data->distFromCity?><br/><?=$data->distFromZip?>          
            </div>
    </div>
    <div class="cell" style="width:10%;" onclick="event.stopPropagation();  activateQuote('<?=base_url()?>','<?=$data->id?>', 1);">
       <div style="font-size:11px; margin-top:0px;">
              <?=$data->distToState?><br/><?=$data->distToCity?><br/><?=$data->distToZip?>          
              </div>
    </div>
    <div class="cell" style=" width:10%;">
       <div >
        $<span  id="priceVal<?=$data->id?>" ><?=($data->price + $data->deposit)?></span></div>
        <?php if($data->price_per_mile=="") $data->price_per_mile = "0.00"; ?>
        <div style="margin-top:2px; font-size:11px;"><span  onchange="updatePrice('<?=base_url()?>', '<?=$data->id?>');" id="pricePMVal<?=$data->id?>" ><?=$data->price_per_mile?></span>/mi</div>
        <!--div onclick="show_drivers_table('<?=base_url()?>', $(this) , '<?=$data->id?>');  $(this).parent().parent().addClass('active');" style="margin-top:2px; font-size:8px;  cursor: pointer;  margin-left: 0px;  margin-right: 0px;   padding: 2px;   display: inline-block;  padding-right: 5px;  padding-left: 5px;" class="iRedButton">FIND DRIVER</div-->
         
    </div>
    <div class="cell" style="width:10%; font-size:11px;">
        <?=date('m/d/y', strtotime($data->arriveDate))?>
       <div style="color:#00ACFF;"><?=date('h:i A', strtotime($data->arriveDate))?></div>
       <div style="font-size:11px; margin-top:0px; color:#000000;">
            <?php if($data->shipVia == 0) { echo ""; }else if( $data->shipVia == 1 ){ echo "shipVia: Open"; }else if($data->shipVia == 2){ echo "shipVia: Close"; }else{ echo "shipVia: DriveAway"; } ?>
        </div> 
    </div>
    <div class="cell" style=" width:10% ; font-size:11px;">
       <div onclick="/*show_send_stat('<?=base_url()?>', $(this).parent().parent().prev(), '<?=$data->id?>');*/ show_launch_block('<?=base_url()?>', $(this), '<?=$data->id?>');" style="margin-top:2px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: 0px;  margin-right: 0px;   padding: 5px; border:none !important;  display: inline-block;  margin-left:-20px; padding-right: 10px;  padding-left: 10px;" class="iRedButton buttonOther">LAUNCH DITAILS</div>
      <div style="height:5px;"></div>
    </div>
    <div style="clear:both;"></div>
</li>
      



      <li class="SlideDownTableItems" style="border-left:none; width:100%; display:none; border-top:none; border-bottom:solid dashed #24567A;" id="qhistory<?=$data->id?>" >
       
        <div  class="backEmailsList" >
          <div id="qhistoryBlock<?=$data->id?>" style="display:none; width:100%;">
            <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
          </div>
        </div>
      </li>
      


       


