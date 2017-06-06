<?php
  $OddClass = "second";
  foreach($query->result() as $data){
    if($OddClass == "second"){ $OddClass = ""; }else{ $OddClass = "second"; }
    ?>
    <tr class="iRow <?=$OddClass?>" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); }else{ $(this).addClass('active'); }">
        <td  style="text-align:center; font-size:14px; width:70px;">
          <?=str_pad ($data->id, 5,"0",STR_PAD_LEFT)?>
          
        </td>
        <td  style="font-size:12px; width:50px;">
        <?=$data->dtype?> 
        </td>
        <!--td  style="text-align:center;"><?=$data->quoteID?> </td>
        <td  style="text-align:center;"><?=$data->quoteID2?></td-->
        <td onclick="event.stopPropagation(); show_fullinfo_drivers('<?=base_url()?>', $(this), '<?=$data->id?>'); " valign="middle" style="text-align:left; font-size:13px; ">
          <?=$data->name?>
        </td>
        <td  style="font-size:14px;">
        <?=$data->contact?> 
        </td>
       
        <td style="font-size:13px; ">
          <?=$data->addr."<br/>".$data->addr2?>
        </td>

        <td style="font-size:14px; padding:7px;" >
          <?=$data->phone."<br/>".$data->phone2."<br/>".$data->email?>
          <?php if(($data->fax != "-")&&($data->fax != "")) echo "<br/>FAX:".$data->fax; ?>
        </td>
        <td style="width:80px; padding:10px;">
          <div style="position:relative;">
              <div onclick="event.stopPropagation(); $('#darker').fadeIn(500); $(this).next().fadeIn(500);" style="font-size:14px; margin:0px; padding:10px; padding-left:10px; padding-right:10px; font-size:12px; margin-top:2px; width:60px;" class="ibutton">Move to</div>
             
              <div class="dropListBlock" style="width:auto; left:auto; right:-12px; top:-10px; white-space:nowrap;">

              <div onclick="event.stopPropagation();" style="font-size:18px; background-color:#ffffff; text-align:left; padding:5px; padding-left:20px; padding-right:20px; color:#777777;">Move to</div>
            <?php 
                foreach($sPartsNames as $key=>$value){
              ?>
              <div style="display:inline-block; margin-right:1px;">
              <div onclick="event.stopPropagation();" style="font-size:12px; color:#ffffff; text-align:left; padding:5px; padding-left:20px; padding-right:20px;"><?=$value?></div>
              <?php foreach($upmenu[$key] as $item){ ?>
                  <div onclick="event.stopPropagation(); moveDriversTo('<?=base_url()?>', '<?=$data->id?>' , '<?=$item->id?>', $(this));" class="dropListItem"><?=$item->sname?></div>
              <?php } ?>
              </div>
            <?php } ?>
              <div style="clear:both;"></div>

            </div>
        </div>
      </tr>

      <tr id="fullinfo<?=$data->id?>" style="display:none; border-top:none; border-left:none;">
        <td colspan="11" class="backEmailsList">
          <div id="fullinfoBlock<?=$data->id?>" style="display:none;">
          <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif"/></div>
          </div>
        </td>
      </tr> 
      
   
    <?php
  }
 
   ?>
