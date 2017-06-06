<style>
.PerscabMenuButton{
	text-align:center; 
	cursor:pointer;
	padding:10px; 
	padding-left:20px; 
	padding-right:20px; 
	display:inline-block; 
	height:100%;
}

.PerscabMenuButton.active2{
	background-color:#00ACFF!important;
	font-size:inherit;
	margin:inherit;
	color:#ffffff;
}

.PerscabMenuButton:hover{
	background-color:rgba(33,122,185,0.3);
}

.PformLabel{
	font-size:11px;
	margin-bottom:2px;
	color:#24567A;
}

.PformInput{
	padding:3px; 
	border:solid 1px #24567A; 
	font-size:12px; 
	width:200px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.PerscabMenuButton').click(function(){
			$('.PerscabMenuButton').removeClass('active2');
			$(this).addClass('active2');
	});		
})

</script>
<div style="width:100%; height:100%;">
<div id="iPerrscabTitle" style="font-size:18px; padding:10px; color:#ffffff; background-color:#00ACFF;">
<div style="float:left;padding-left:13px; ">PERSCAB</div>
<div onclick="$('#darker').click();" style="float:right; padding-right:15px; font-size:13px; cursor:pointer; padding:3px; padding-left:10px; padding-right:10px; background-color:rgba(255,255,255,0.2);">close</div>
<div style="clear:both;"></div>
</div>
<div style="background-color:#eeeeee; width:100%; margin-top:2px;">
	<div onclick="$('.PersCabBlocks').css('display', 'none'); $('#AccPref').fadeIn(500);" class="PerscabMenuButton active2">
			Account preferences
	</div>

	<div onclick="$('.PersCabBlocks').css('display', 'none'); $('#PUsers').fadeIn(500); " class="PerscabMenuButton">
			Users
	</div>
	<div onclick="$('.PersCabBlocks').css('display', 'none'); $('#PEmails').fadeIn(500);" class="PerscabMenuButton">
			Emails
	</div>
  <div onclick="$('.PersCabBlocks').css('display', 'none'); $('#PSMS').fadeIn(500);" class="PerscabMenuButton">
        SMS
    </div>
	<div onclick="$('.PersCabBlocks').css('display', 'none'); $('#PDEmails').fadeIn(500);" class="PerscabMenuButton">
			Drivers Emails 
	</div>

</div>
<div id="AccPref" class="PersCabBlocks" style="padding:20px;">
<form method="POST" onsubmit="update_crm_profile($(this)); return false;" action="<?=base_url()?>admin/main/crm_user_update_info" enctype="multipart/form-data">
<input type="hidden" name="uid" value="<?=$user->id?>" />
 <div style="height:10px;"></div>
<div style="float:left; width:33%;">  
    <div style="width:100px; height:100px; background-image:url('<?=base_url()?>img/icon.png'); background-position:center; background-repeat:no-repeat; background-color:#ffffff;"></div>
   <div class="PformLabel">Logo</div>
   <input type="file" class="PformInput" name="logoImg" />
  <div style="height:10px;"></div>
   <div class="PformLabel">Company name</div>
   <div><input name="Cname" class="PformInput" type="text" value="<?=$user->Cname?>" /></div>
</div>

 <div style="float:left; width:33%;">	
	 <div class="PformLabel">First name</div>
	 <div><input name="Fname" class="PformInput" type="text" value="<?=$user->Fname?>"/></div>
	<div style="height:10px;"></div>
	 <div class="PformLabel">Email</div>
	 <div><input name="Email" class="PformInput" type="text" value="<?=$user->email?>"/></div>	
	 <div style="height:10px;"></div>
   <div class="PformLabel">Fax</div>
   <div><input name="Fax" class="PformInput" type="text" value="<?=$user->Fax?>"/></div> 
	<div style="height:10px;"></div>
</div>
<div style="float:left; width:33%;">
   <div class="PformLabel">Phone</div>

   <div><input name="Phone" class="PformInput" type="text" value="<?=$user->Phone?>"/></div>
    <div style="height:10px;"></div>
   <div class="PformLabel">Phone2</div>
	 <div><input name="Phone2" class="PformInput" type="text" value="<?=$user->Phone2?>"/></div>
	 <div style="height:10px;"></div>
	 <div class="PformLabel">Mobile</div>
	 <div><input name="Mobile" class="PformInput" type="text" value="<?=$user->Mobile?>"/></div>
	
	 <div style="height:10px;"></div>
 </div>
 
 <div style="float:left; width:33%;">
	 <div class="PformLabel">Addr street</div>
	 <div><input name="addrStreet" class="PformInput" type="text" value="<?=$user->addrStreet?>"/></div>
	 <div style="height:10px;"></div>
	 <div class="PformLabel">Addr City</div>
	 <div><input name="addrCity" class="PformInput" type="text" value="<?=$user->addrCity?>"/></div>
	 <div style="height:10px;"></div>
	 <div class="PformLabel">Addr State</div>
	 <div><input name="addrState" class="PformInput" type="text" value="<?=$user->addrState?>"/></div>
	 <div style="height:10px;"></div>
 </div>

  <div style="clear:both"></div>
  <div style="margin-top:10px; margin-bottom:20px; border-top:dashed 1px #999999;"></div>

 <div style="float:left; width:33%;">
	 <div class="PformLabel">Quotes id begin from</div>
	 <div><input name="qIdStart" class="PformInput" type="text" value="<?=$user->qIdStart?>"/></div>
	 <div style="height:10px;"></div>	
	 <div class="PformLabel">Time</div>
	 <div><input name="uTimezone" class="PformInput" type="text" value="<?=$user->uTimezone?>"/></div>	
	 <div style="height:10px;"></div>	
	 <div class="PformLabel">Standart Dposit</div>
	 <div><input name="uDeposit" class="PformInput" type="text" value="<?=$user->uDeposit?>"/></div>
   <div style="font-size:11px; margin-top:10px;" class="PformLabel">Central Dispatch token</div>
              <div><input type="text" name="CDtoken" style="font-size:12px;" value="<?=$user->CDtoken?>"/></div>
 </div>
 <div style="clear:both;"></div>
 <input type="submit" class="iButton" class="iButton" style="width:auto; display:inline-block; margin-top:20px;" value=" Save Account " />
</form>
</div>

<div id="PUsers" class="PersCabBlocks" style="padding:20px; display:none;">
	<table  class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<td style="text-align:center; width:70px;">ID</td>
			<td>First name</td>
			<td>Email</td>
			<td >Reg Date</td>
			<td style="text-align:center;">Status</td>
			<td style="text-align:center; width:50px;">-</td>
		</tr>
	</table>
	 <div onclick="$(this).fadeOut(500); $(this).next().fadeIn(500);" class="iButton">Add new moderator</div>
	 <div style="display:none;">
		 <div class="PformLabel">Email</div>
		 <div><input class="PformInput" type="text"/></div>
	 	<div class="iButton">Add new moderator</div>
	 </div>

</div>

<script>
  $( function() {
    $( "#elist" ).sortable();
    $( "#elist" ).disableSelection();
  } );
  
  $( function() {
    //$( ".eitem" ).draggable();
    $( ".blockPart" ).droppable({
      accept: ".eitem",
      classes: {
        "ui-droppable-active": "dropActive",
        "ui-droppable-hover": "dropHover"
      },
      drop: function( event, ui ) {
            var draggableId = ui.draggable.attr("id");
            var droppableId = $(this).attr("id");
            add_emails_to_list('<?=base_url()?>', draggableId, droppableId, $(this));
      }
    });
  } );
  </script>
<style>
    .dropActive{
      background-color:rgba(33,122,185,0.5) !important;
      color:#ffffff;

    }
    .dropHover{
      background-color:rgba(33,122,185,1) !important;
      color:#ffffff;
    }
</style>
<div id="PEmails" class="PersCabBlocks" style="padding:20px;  display:none;">
  <div style="width:50%; float:left; padding-right:10px;">
	<div style="font-size:18px;">TEMPLATES</div>
	<ul id="elist" style="margin-left:0px; width:430; padding-left:0px;">
		 <?php
  		foreach($queryA as $data){
    ?>
    <li id="<?=$data->id?>" class="eitem" style="width:430px; list-style-type:none; margin:0px;">
    <table class="insideTableWhiteGrey" border="0" cellpadding="0" cellspacing="0">
    <tr class="contentRow" id="erow<?=$data->id?>" style="border-bottom:#777777; width:100%;">
       
        <td  style="font-size:14px; padding-left:10px; width:300px;"><?=$data->name?></td>
       
        <td  id="ecbutton<?=$data->id?>" style="font-size:13px; text-align:center; cursor:pointer;" onclick="show_emails_change('<?=base_url()?>', '<?=$data->id?>');" class="buttonCell">EDIT EMAIL</td>
        <td  style="font-size:13px; text-align:center; cursor:pointer;" onclick="delete_email_from_list('<?=base_url()?>', '<?=$data->id?>');">x</td>
      </tr>
      
    </table>
    </li>
    <?php
  }
 
   ?>
 
	</ul>

<div class="ibutton" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); $(this).next().fadeOut(500); }else{ $(this).addClass('active'); $(this).next().fadeIn(500); }">Add email</div>
    <div  style=" display:none; padding:20px; width:100%;">
   
      <form method="POST" action="<?=base_url()?>admin/main/addchemail/">
        
          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email name</div>
          <div><input type="text" name="Ename" value="" /></div>

          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Subject email</div>
          <div><input type="text" name="Esubject"  value="" /></div>

          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email text</div>
          <div><textarea style="width:90%;" name="Etext"></textarea></div>

          <div style="font-size:11px; margin-top:10px;">Automated move after send</div>
              <div>
              <select name="AutomatedTo">
                <option <?php if($data->AutomatedTo == 0) echo " selected='selected' "; ?> value="0">Do nothing</option>
                <?php foreach($folders as $item){ ?>
                <option  value="<?=$item->id?>"><?=$item->name?></option>
                <?php } ?>
              </select>  
              </div>

              <div style="font-size:11px; margin-top:10px;">Send only in work time</div>
              <div>
                <select name="OnlyInworkTime">
                   <option  value="0" >Any time</option> 
                   <option  value="1" >In work time only</option> 
                   <option value="2" >After work time only</option> 
                </select>
              </div>

          <input type="submit" class="ibutton" style="width:auto;" value="  Add email  "/>
      </form>
    </div>

  </div>
  <div style="width:calc(50% - 40px); border-left:solid 1px #cccccc; padding-left:20px; float:left;">
  
    <?php 
    foreach($sPartsNames as $key=>$item){ 
      ?>
<div onclick="if($(this).next().is(':visible')) { $(this).find('span').html('+'); $(this).next().slideUp(500); }else{ $(this).next().slideDown(500); $(this).find('span').html('-'); }" style="font-size:18px; margin-bottom:0px; cursor:pointer; color:rgba(33,122,185,1); font-weight:bold;"> [ <span>+</span> ] <?=$item?></div>
    <div style="display:none;">
      <?php
        foreach($parts[$key] as $part){
      ?>
            <div id="<?=$part->id?>" class="blockPart" style="padding:10px; border:dashed 1px #999999; background-color:#cccccc; margin-top:20px;">
                <div style="font-size:14px; "><?=$part->name?></div>
            

           <?php if(count($part->Emails) > 0) { ?> <table  class="insideTableWhiteGrey" border="0" style="width:100%; margin-top:5px;" cellpadding="0" cellspacing="0"> <?php } ?>
           <?php
            foreach($part->Emails as $data){
          ?>
          <tr class="contentRow" id="lerow<?=$data->id?>">
             
              <td  style="font-size:12px; padding-left:10px; color:#000000 !important;"><?=$data->name?></td>
              <td  style="font-size:15px; text-align:center; width:100px;"><input type="text" style="border:none; text-align:right; width:70px; background-color:inherit; font-size:inherit; color:#000000 !important; padding:0px; color:inherit;" onchange="changeEmailValue('sendAfterPrev', $(this).val(), <?=$data->id?>);" value="<?=$data->sendAfterPrev?>" /> <span style="font-size:13px; color:#000000 !important; font-style:italic; margin-left:-2px;">sec</span></td>
              <td  style="font-size:13px; text-align:center; cursor:pointer; color:#000000 !important;" onclick="delete_email_from_folder('<?=base_url()?>', '<?=$data->id?>');">x</td>
            </tr>
           
         
          <?php
        }
       
         ?>
       <?php if(count($part->Emails) > 0) { ?>  </table> <?php } ?>
        
          </div>
    <?php } ?>  <div style="height:20px;"></div> </div> <?php } ?>
  


 


  <div style="clear:both;"></div>
  </div>
 <div style="clear:both;"></div>
  


	 
</div>

 <div id="PSMS" class="PersCabBlocks" style="padding:20px;  display:none;">
        <div style="width:50%; float:left; padding-right:10px;">
            <div style="font-size:18px;">SMS TEMPLATES</div>
            <ul id="elist" style="margin-left:0px; width:430; padding-left:0px;">
                <?php
                foreach($querySMS as $data){
                    ?>
                    <li id="<?=$data->id?>" class="eitem" style="width:430px; list-style-type:none; margin:0px;">
                        <table class="insideTableWhiteGrey" border="0" cellpadding="0" cellspacing="0">
                            <tr class="contentRow" id="smsrow<?=$data->id?>" style="border-bottom:#777777; width:100%;">

                                <td  style="font-size:14px; padding-left:10px; width:300px;"><?=$data->name?></td>

                                <td  id="edsmsbutton<?=$data->id?>" style="font-size:13px; text-align:center; cursor:pointer;" onclick="show_sms_change('<?=base_url()?>', '<?=$data->id?>');" class="buttonCell">EDIT SMS</td>
                                <td  style="font-size:13px; text-align:center; cursor:pointer;" onclick="delete_sms_from_list('<?=base_url()?>', '<?=$data->id?>');">x</td>
                            </tr>

                        </table>
                    </li>
                    <?php
                }

                ?>

            </ul>

            <div class="ibutton" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); $(this).next().fadeOut(500); }else{ $(this).addClass('active'); $(this).next().fadeIn(500); }">Add SMS</div>
            <div  style=" display:none; padding:20px; width:100%;">

                <form method="POST" action="<?=base_url()?>admin/main/addchsms/">

                    <div style="font-size:11px; margin-top:10px;" class="PformLabel">SMS name</div>
                    <div><input type="text" name="Sname" value="" /></div>

                    <!--<div style="font-size:11px; margin-top:10px;" class="PformLabel">Subject email</div>
                    <div><input type="text" name="Esubject"  value="" /></div>-->

                    <div style="font-size:11px; margin-top:10px;" class="PformLabel">SMS text</div>
                    <div><textarea style="width:90%;" name="Etext2"></textarea></div>

                    <div style="font-size:11px; margin-top:10px;">Automated move after send</div>
                    <div>
                        <select name="AutomatedTo">
                            <option <?php if($data->AutomatedTo == 0) echo " selected='selected' "; ?> value="0">Do nothing</option>
                            <?php foreach($folders as $item){ ?>
                                <option  value="<?=$item->id?>"><?=$item->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div style="font-size:11px; margin-top:10px;">Send only in work time</div>
                    <div>
                        <select name="OnlyInworkTime">
                            <option  value="0" >Any time</option>
                            <option  value="1" >In work time only</option>
                            <option value="2" >After work time only</option>
                        </select>
                    </div>

                    <input type="submit" class="ibutton" style="width:auto;" value="  Add SMS  "/>
                </form>
            </div>

        </div>
        <div style="width:calc(50% - 40px); border-left:solid 1px #cccccc; padding-left:20px; float:left;">

            <?php
            foreach($sPartsNames as $key=>$item){
                ?>
                <div onclick="if($(this).next().is(':visible')) { $(this).find('span').html('+'); $(this).next().slideUp(500); }else{ $(this).next().slideDown(500); $(this).find('span').html('-'); }" style="font-size:18px; margin-bottom:0px; cursor:pointer; color:rgba(33,122,185,1); font-weight:bold;"> [ <span>+</span> ] <?=$item?></div>
                <div style="display:none;">
                    <?php
                    foreach($parts[$key] as $part){
                        ?>
                        <div id="<?=$part->id?>" class="blockPart" style="padding:10px; border:dashed 1px #999999; background-color:#cccccc; margin-top:20px;">
                            <div style="font-size:14px; "><?=$part->name?></div>


                            <?php if(count($part->Emails) > 0) { ?> <table  class="insideTableWhiteGrey" border="0" style="width:100%; margin-top:5px;" cellpadding="0" cellspacing="0"> <?php } ?>
                                <?php
                                foreach($part->Emails as $data){
                                    ?>
                                    <tr class="contentRow" id="lerow<?=$data->id?>">

                                        <td  style="font-size:12px; padding-left:10px; color:#000000 !important;"><?=$data->name?></td>
                                        <td  style="font-size:15px; text-align:center; width:100px;"><input type="text" style="border:none; text-align:right; width:70px; background-color:inherit; font-size:inherit; color:#000000 !important; padding:0px; color:inherit;" onchange="changeEmailValue('sendAfterPrev', $(this).val(), <?=$data->id?>);" value="<?=$data->sendAfterPrev?>" /> <span style="font-size:13px; color:#000000 !important; font-style:italic; margin-left:-2px;">sec</span></td>
                                        <td  style="font-size:13px; text-align:center; cursor:pointer; color:#000000 !important;" onclick="delete_email_from_folder('<?=base_url()?>', '<?=$data->id?>');">x</td>
                                    </tr>


                                    <?php
                                }

                                ?>
                                <?php if(count($part->Emails) > 0) { ?>  </table> <?php } ?>

                        </div>
                    <?php } ?>  <div style="height:20px;"></div> </div> <?php } ?>

            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>

    </div>



<div id="PDEmails" class="PersCabBlocks" style="padding:20px;  display:none;">
  <div style="width:100%; padding-right:10px;">
  <div style="font-size:18px;">TEMPLATES</div>
  <ul id="elist" style="margin-left:0px; width:430; padding-left:0px;">
     <?php
      foreach($queryD as $data){
    ?>
    <li id="<?=$data->id?>" class="eitem" style="width:430px; list-style-type:none; margin:0px;">
    <table class="insideTableWhiteGrey" border="0" cellpadding="0" cellspacing="0">
    <tr class="contentRow" id="erow<?=$data->id?>" style="border-bottom:#777777; width:100%;">
       
        <td  style="font-size:14px; padding-left:10px; width:300px;"><?=$data->name?></td>
       
        <td  id="ecbutton<?=$data->id?>" style="font-size:13px; text-align:center; cursor:pointer;" onclick="show_drivers_emails_change('<?=base_url()?>', '<?=$data->id?>');" class="buttonCell">EDIT EMAIL</td>
        <td  style="font-size:13px; text-align:center; cursor:pointer;" onclick="delete_email_from_list('<?=base_url()?>', '<?=$data->id?>');">x</td>
      </tr>
      
    </table>
    </li>
    <?php
  }
 
   ?>
 
  </ul>

<div class="ibutton" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); $(this).next().fadeOut(500); }else{ $(this).addClass('active'); $(this).next().fadeIn(500); }">Add email</div>
    <div  style=" display:none; padding:20px; width:100%;">
   
      <form method="POST" action="<?=base_url()?>admin/drivers/addchemail/">
        
          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email name</div>
          <div><input type="text" name="Ename" value="" /></div>

          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Subject email</div>
          <div><input type="text" name="Esubject"  value="" /></div>

          <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email text</div>
          <div><textarea style="width:90%;" name="Etext"></textarea></div>

          <div style="font-size:11px; margin-top:10px;">Automated move after send</div>
              <div>
              <select name="AutomatedTo">
                <option <?php if($data->AutomatedTo == 0) echo " selected='selected' "; ?> value="0">Do nothing</option>
                <?php foreach($folders as $item){ ?>
                <option  value="<?=$item->id?>"><?=$item->name?></option>
                <?php } ?>
              </select>  
              </div>

              <div style="font-size:11px; margin-top:10px;">Send only in work time</div>
              <div>
                <select name="OnlyInworkTime">
                   <option  value="0" >Any time</option> 
                   <option  value="1" >In work time only</option> 
                   <option value="2" >After work time only</option> 
                </select>
              </div>

          <input type="submit" class="ibutton" style="width:auto;" value="  Add email  "/>
      </form>
    </div>

  </div>
  
 <div style="clear:both;"></div>
  


   
</div>

</div>