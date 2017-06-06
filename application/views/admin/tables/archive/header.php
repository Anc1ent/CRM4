<div id="content" >
<div style="width:calc(100% - 40px); margin-right:20px; margin-top:7px; background-color:rgba(255,255,255, 0.7); position:relative;">
<div id="pageLoading" style="width:100%; display:none; height:100%; background-image:url('<?=base_url()?>img/loading.gif?3'); background-position:center 40px; background-repeat:no-repeat; position:absolute; top:50px; left:0px; text-align:center; background-color:rgba(255,255,255,0.9); z-index:99;  min-height:170px;">
</div>
<ul class="QuotesTable" style="width:100%;">
  <li class="headerQT" style="background-color:#7A8CA2;" >
  <div class="cell" style="width:4%;">
        <input type="checkbox" style="margin-left:10px; width:15px;" onclick="if($(this).prop('checked')){ $('.SelectedItem').prop('checked', true).change(); }else{ $('.SelectedItem').prop('checked', false).change(); } "/>
    </div>
   <div class="cell" style=" width:11%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>', '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'id');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'id') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>ID
    </div>
    <div class="cell" style="width:7%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'addDate');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'addDate') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Quoted
    </div>
    <div class="cell" style="width:14%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'shipper');">
        <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'shipper') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Shipper
    </div>
    <div class="cell" style="width:13%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'carMake');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'carMake') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Vechine
    </div>
    <div class="cell" style=" width:10%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'distFromCity');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'distFromCity') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Origin
    </div>
    <div class="cell" style="width:10%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'distToCity');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'distToCity') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Destination
    </div>
    <div class="cell" style=" width:10%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'price');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'price') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Tariff
    </div>
    <div class="cell" style="width:10%; cursor:pointer;" onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'arriveDate');">
       <span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'arriveDate') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Est.Ship.
    </div>
    <div class="cell" style=" width:10% ; padding-top:3px; padding-bottom:3px; ">
      <div onclick="show_mass_launch_block('<?=base_url()?>', $(this));" style="margin-top:2px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: -20px;  margin-right: 0px;   padding: 2px;   display: inline-block;  padding-right: 10px;  padding-left: 10px; font-size:10px;" class="iRedButton buttonOther">MASS LAUNCH (<span id="countSelectedItems">0</span>)</div>
        <div class="iRedButton buttonOther"  onclick="event.stopPropagation(); $('#darker').fadeIn(500);  $('#dropListBlockM').fadeIn(500);" style="margin-top:2px; font-size:12px; border-radius:10px; cursor: pointer;  margin-left: -20px;  margin-right: 0px;   padding: 2px;   display: inline-block;  padding-right: 10px;  padding-left: 10px; font-size:10px; background-color:#1970B0; text-align:center;  color:#ffffff">MOVE TO FOLDER</div>
          <div class="dropListBlock"  id="dropListBlockM" style="width:auto; left:auto; right:-12px; top:-10px; position:fixed; top:80px; left:auto; right:20px; white-space:nowrap;">

                <div onclick="event.stopPropagation();" class="moveToButton">Mass move to</div>
              <?php 
                  foreach($sPartsNames as $key=>$value){
                ?>
                <div style="display:inline-block; margin-right:1px;">
                <div onclick="event.stopPropagation();" style="font-size:12px; text-transform:uppercase; color:#ffffff; text-align:left; padding:5px; padding-left:20px; padding-right:20px;"><?=$value?></div>
                <?php foreach($upmenu[$key] as $item){ ?>
                    <div onclick="event.stopPropagation(); $(this).parent().parent().fadeOut(); mass_moveQuoteTo('<?=base_url()?>', '<?=$item->id?>', $(this));" class="dropListItem"><?=$item->sname?></div>
                <?php } ?>
                </div>
                <?php } ?>
                </div>
    </div>
    <div style="clear:both;"></div>
    <div style="position:relative;">
    <?php if($iSORT!="moveDate") { ?> <div onclick="chTableSort('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'moveDate');" style='font-size:9px; color:#ffffff; cursor:pointer; position:absolute; bottom:3px; left:10px; display:block; width:100px;'>clear sort</div> <?php } ?>
    </div>
  </li>
 