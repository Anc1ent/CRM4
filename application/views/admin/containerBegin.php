<!-- CONTENT -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.itemQT').eq(0).click();
    CountQuotes = <?=$countQuotes?>;
    quoted = <?=$quoted?>;
    ordered = <?=$ordered?>;
    dispached = <?=$dispached?>;
    cenceled = <?=$cenceled?>;
  });
</script>
  <div style="width:calc(100% - 250px); margin-left:250px; padding:20px; padding-top:10px; padding-bottom:10px; position:relative;">
      <div style="display:none;">
      <!-- Statistics -->
      <div style="font-size:18px; color:#ffffff; font-weight:bold;">
        STATISTICS:
      </div>
      <div>
        <div class="statItemBlock" style="border-left:none;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.workedL.circle').circleProgress({
                  value: <?php if($countQuotes != 0) { echo round($quoted/$countQuotes,2); } else{ echo "0"; } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="workedL circle">
              <strong><span id="quotedV"><?php if($countQuotes != 0) { echo round($quoted/$countQuotes*100); }else{ echo "0"; } ?></span> <span style="font-size:10px;  margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Worked Leads</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="quotedC"><?=$quoted?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        <!-- SEPARATE -->
         <div class="statItemBlock">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.convertedO.circle').circleProgress({
                  value: <?php if($countQuotes != 0) { echo round($ordered/$countQuotes,2); }else{ echo "0"; } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="convertedO circle">
              <strong><span id="orderedV"><?php if($countQuotes != 0) { echo round($ordered/$countQuotes*100); }else{ echo "0"; } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Converted Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="orderedC"><?=($ordered)?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        <!-- SEPARATE -->
         <div class="statItemBlock">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.dispachedO.circle').circleProgress({
                  value: <?php if($ordered == 0){ echo 0; }else{ echo round($dispached/$ordered,2); } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="dispachedO circle">
              <strong><span id="dispachedV"><?php if($ordered == 0){ echo 0; }else{ echo round($dispached/$ordered*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Dispached Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="dispachedC"><?=($dispached)?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        <!-- SEPARATE -->
         <div class="statItemBlock">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.cenceledO.circle').circleProgress({
                  value: <?php if($ordered == 0){ echo 0; }else{ echo round($cenceled/$ordered,2); } ?>,
                  fill: {color: ['#ffffff']}
                });

              });


              
            </script>
            <div class="cenceledO circle">
              <strong><span id="cenceledV"><?php if($ordered == 0){ echo 0; }else{ echo round($cenceled/$ordered*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Cenceled Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="cenceledC"><?=($cenceled)?> </div>
          </div>  
          <div style="clear:both;"></div>
        </div>

        <!-- SEPARATE -->
        <?php if(!isset($chargered)) $chargered = 0; ?>
         <div class="statItemBlock">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.chargeredS.circle').circleProgress({
                  value: <?php if($chargered == 0){ echo 0; }else{ echo round($chargered/$globalsum,2); } ?>,
                  fill: {color: ['#ffffff']}
                });

              });


              
            </script>
            <div class="chargeredS circle">
              <strong><span id="chargeredSV"><?php if($chargered == 0){ echo 0; }else{ echo round($chargered/$globalsum*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Chargered Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;"><span style="font-size:18px; color:#ffffff; padding-right:2px;">$</span><span style="font-size:18px; color:#ffffff;" id="chargeredSC"><?=($chargered)?></span></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        
        <div style="clear:both;"></div>
      </div>
      <!-- / Statistics -->
      </div>

      <div style="height:10px;"></div>

      <div id="QuotefullInfo" style="width:calc(100% - 38px);  z-index:2; background-color:rgb(232, 235, 240);">
      </div>
      <div id="QFzameniaka" style="display:none; height:250px; width:100%;"></div>
     
      <div class="SlideDownTableItems" style="display:none; width:100%; border-top:none; border-left:none; border-bottom:solid dashed #24567A;" id="dispatchG" >
        <div  class="backEmailsList" style="background-color:transparent;">
          <div id="dispatchBlockG" style="display:none; ">
          <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
          </div>
        </div>
      </div> 

      <div class="SlideDownTableItems" style="display:none; width:100%; border-top:none; border-left:none; border-bottom:solid dashed #24567A;" id="bookitG" >
        <div  class="backEmailsList" style="background-color:transparent;">
          <div id="bookitBlockG" style="display:none; ">
          <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
          </div>
        </div>
      </div> 

      <div class="SlideDownTableItems" style="display:none; width:100%; border-top:none; border-left:none; border-bottom:solid dashed #24567A;" id="fullinfoG" >
      <div  class="backEmailsList" style="background-color:transparent;"> 
        <div id="fullinfoBlockG" style="display:none; ">
        <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
        </div>
      </div>
      </div> 
     
      <!--div class="SlideDownTableItems" style="border-left:none; width:100%; display:none; border-top:none; border-bottom:solid dashed #24567A;" id="SendG" >
       
        <div  class="backEmailsList" style="background-color:transparent;">
          <div id="SendBlockG" style="display:none;">
              <div class="loadingInTable"><img src="<?=base_url()?>img/loading.gif?"/></div>
          </div>
        </div>
      </div-->

      <div style="height:5px;"></div>
<div id="content" >