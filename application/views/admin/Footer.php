
<div id="darker" style="width:100%; display:none; height:100%; background-color:rgba(0,0,0,0.8); position:fixed; top:0px; left:0px; z-index:3;">
</div>

<div class="dropListBlock"  id="dropListBlockD" style="width:360px; left:auto; right:15px; top:100px; white-space:nowrap; position:fixed; z-index:99999;">
    <div onclick="event.stopPropagation();" style="padding-right:50px; padding-left:10px;" class="moveToButton">DISPATCH TOOLS</div>
        <div style="padding:20px;">
            <div style="margin-bottom:10px; color:#ffffff; font-size:14px;">Dispatch via:</div>
        <div class="dropListItem" style="padding-top:10px; padding-bottom:10px;">CENTRAL DISPATCH</div>
        <div class="dropListItem" style="padding-top:10px; padding-bottom:10px;">SHIPWIT</div>
        <div class="dropListItem" style="padding-top:10px; padding-bottom:10px;">Carriers Email</div>
        <div class="dropListItem" style="padding-top:10px; padding-bottom:10px;">Fax</div>
    </div>
    
</div>

<div id="confirmationWindow" class="statBlock" style="display:none; z-index:999999999; width:300px; height:auto; padding:20px; position:fixed; top:150px; left:calc(50% - 150px); background-color:#ff5050;">
    <div style="font-size:18px; color:#ffffff; padding:0px; text-align:center;">ARE YOU SURE?</div>
    <div id="confirmationText" style="margin-top:10px; font-size:13px; color:#ffffff; text-align:center;"></div>
    <div style="text-align:center; margin-top:20px;"><div id="confirmationTrue" class="upmenuButton iredButton buttonGreen" style="margin-left:50px; border-radius:10px; padding:8px; margin-top:0px; padding-left:15px;  padding-right:15px; font-size:15px;">YES!</div> <div onclick="$('#darker').click();" class="buttonBlue" style="padding:8px; float:left;margin-left:5px; background-color:#005696; margin-left:20px; font-size:15px; padding-left:15px; padding-right:15px; cursor:pointer; color:#ffffff; border-radius:10px;">
        NO
        </div> </div>
</div>

<div id="massLaunch" class="statBlock" style="position:absolute; width:900px; top:70px; z-index:65533; display:none; padding:20px; height:auto;">
</div>

<div id="emptyLaunch" class="statBlock" style="position:absolute; width:900px; top:70px; z-index:65533; display:none; padding:20px; height:auto;">
</div>

<div id="quotenotice" style="position:absolute; background-color:rgba(255,255,255,0.9); z-index:655339; display:none; padding:10px; border:solid 1px rgba(33,122,185,0.9); height:auto;">
</div>

<div id="perscabblock" style="position:absolute; background-color:rgba(255,255,255,0.9); z-index:65539; display:none; width:900px; top:70px; border:solid 1px rgba(33,122,185,0.9); height:auto;">
</div>

<div id="editemailblock" style="position:absolute; background-color:rgba(255,255,255,0.9); z-index:65540; display:none; width:900px; border:solid 1px rgba(33,122,185,0.9); height:auto;">
</div>
<div id="sound">
</div>
<?php if((isset($ishowAlerts))&&($ishowAlerts == 1)){ ?>

    <div id="alertBlock0"  style="display:none; border-right:solid 5px #DD5675;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:195px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">
           
    </div>
    <div id="alertBlockPopUp0"  style="display:none; border-right:solid 5px #DD5675;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:195px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">
           
    </div>
<?php } ?>

<?php if((isset($ishowAlerts))&&($ishowAlerts == 1)){ ?>

    <div id="alertBlock1" style="display:none; border-right:solid 5px #0BAAEB;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:155px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">

    </div>
    <div id="alertBlockPopUp1" style="display:none; border-right:solid 5px #0BAAEB;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:155px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">

    </div>
<?php } ?>

<?php if((isset($ishowAlerts))&&($ishowAlerts == 1)){ ?>

    <div id="alertBlock2" style="display:none; border-right:solid 5px #00B100;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:105px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">
    </div>


    <div id="alertBlockPopUp2" style="display:none; border-right:solid 5px #00B100;  position:fixed;  max-width:400px; z-index:99999;  max-height:500px; position:fixed; right:105px; top:73px; padding:0px; padding-left:0px; padding-right:0px;  background-color:#ffffff; overflow-y: auto;">
    </div>
<?php } ?>

<div class="statBlock" id="ESTATBlock" style="position:absolute; z-index:9999999; display:none; padding:10px; top:30px; left:0px; width:300px; background-color:#ff5050;">
  <div style="width:100%;">
    <div class="WindowBlockTitle" id="EmailStitle">
     Emails statistic
    </div>
    <div class="SEitems" id="ESContent" style="max-height:400px; overflow-y:auto;">
      
    </div>
  </div>
</div>


<div id="doGroupThigs"  onclick="if($('#listToDoMenu').is(':visible')){ $('#listToDoMenu').slideUp(500); }else{ $('#listToDoMenu').slideDown(500); $('#darker').fadeIn(500); }" style="position:fixed; display:none; padding:15px; cursor:pointer; background-color:#ff5050; font-size:15px; z-index:9999999; color:#ffffff; top:155px; left:0px;">
	<div>Do with group</div>
	<div  style="position:relative;">
		<div id="listToDoMenu" class="popupblock" style="position:absolute; z-index:99999; top:15px;  display:none; background-color:#995050; left:-20px;">
			<div onclick="event.stopPropagation(); $(this).next().fadeIn(500);" class="Rbutton">
			   Move to
			</div>
			<div class="dropListBlock" style="width:auto; background-color:#995050; left:auto; left:4px; top:0px; white-space:nowrap;">

            <div onclick="event.stopPropagation();" style="font-size:18px; background-color:#ffffff; text-align:left; padding:5px; padding-left:20px; padding-right:20px; color:#777777;">Move to</div>
           	 <?php 
              foreach($sPartsNames as $key=>$value){
            ?>	
            <div style="display:inline-block; margin-right:1px;">
            <div onclick="event.stopPropagation();" style="font-size:12px; color:#ffffff; text-align:left; padding:5px; padding-left:20px; padding-right:20px;"><?=$value?></div>
            <?php foreach($upmenu[$key] as $item){ ?>
                <div onclick="event.stopPropagation(); moveQuoteToG('<?=base_url()?>',  '<?=$item->id?>', $(this));" class="dropListItemR"><?=$item->sname?></div>
            <?php } ?>
            </div>
            <?php } ?>
            
            <div style="clear:both;"></div>

          </div>
          <div onclick="event.stopPropagation(); $(this).next().fadeIn(500);" class="Rbutton" style="background-color:#bb5050;">
			   Send email
			</div>
			<div onclick="event.stopPropagation(); $(this).next().fadeIn(500);" class="Rbutton" >
			   Remind me 
			</div>
		</div>
	</div>
</div>

<!--div id="up" style="bottom: 20px; opacity: 0.7;"></div-->

 </body>
</html>  