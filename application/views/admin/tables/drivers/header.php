<div id="content">

<div style="width:1200px; margin:0px auto; margin-top:7px; background-color:rgba(255,255,255, 0.7);">
<table cellpadding="0" id="Qtable" cellspacing="0" class="iTextContent" style="width:100%;">
    <tr class="TableHead"  >
        <td <?php if(($iSORT == 'id')||(!isset($iSORT))) { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>', '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'id');" style="cursor:pointer; text-align:left; white-space:nowrap;"><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'id') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>ID</td>
        <!--td valign="top" style="text-align:center;" >Qid</td>
        <td valign="top" style="width:70px; text-align:center;">Article</td-->
          <td<?php if($iSORT == 'dtype') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'dtype');" style=" cursor:pointer; white-space:nowrap;"><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'dtype') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Type</td>
        <td<?php if($iSORT == 'name') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'name');" style=" cursor:pointer; white-space:nowrap;"><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'name') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Name</td>

        <td <?php if($iSORT == 'contact') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'contact');" style=" cursor:pointer; white-space:nowrap;"><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'contact') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>contact</td>
       
        <td <?php if($iSORT == 'addr') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>', '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'addr');" style=" cursor:pointer; width:150px;"><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'addr') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Address</td>

        <td <?php if($iSORT == 'phone') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'phone');" style=" cursor:pointer; "><span style="font-size:8px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'phone') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Contacts</td>
        <td style="text-align:center;">Move</td>

        
        <!--td >Price</td-->
        <!--td <?php if($iSORT == 'sendedEmails') { ?> class="sactive" <?php } ?> onclick="chTableSortDrivers('<?=base_url()?>',  '<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>', 'sendedEmails');" style=" cursor:pointer; white-space:nowrap; text-align:center;"><span style="font-size:10px; display:inline-block; margin-top:-3px; padding-right:5px; "><?php if($iSORT == 'sendedEmails') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>Sended</td-->
        

        <!--td <?php if($iSORT == 'LastEmailDate') { ?> class="sactive" <?php } ?> onclick="document.location='<?=base_url()?>admin/set_sort/<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>/LastEmailDate/';" style=" cursor:pointer; white-space:nowrap;"><span style="font-size:10px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'LastEmailDate') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>LastSend</td>
        <td <?php if($iSORT == 'nextSend') { ?> class="sactive" <?php } ?> onclick="document.location='<?=base_url()?>admin/set_sort/<?php if($S=="ASC"){?>1<?php }else{ ?>0<?php } ?>/nextSend/';" style=" cursor:pointer; white-space:nowrap;"><span style="font-size:10px; display:inline-block; margin-top:-3px; padding-right:5px;"><?php if($iSORT == 'nextSend') if($S=="ASC"){?>▲<?php }else{ ?>▼<?php } ?></span>NextSend</td-->
      </tr>