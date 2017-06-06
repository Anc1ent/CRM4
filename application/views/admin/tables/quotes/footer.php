</ul>
   </div>
   <div style="width:calc(100% - 40px); margin-right:20px; margin-top:7px; ">
   
   <?php if($LIMIT < $countQ){ ?>
    <div onclick="getMoreQuotes('<?=base_url()?>', <?=$LIMIT?>, <?=$countQ?>);" class="ibutton buttonBlue" style="padding:5px; border-radius:10px; padding-left:30px; padding-right:30px; margin-left:10px; font-weight:bold;" id="showMoreButton" >GET MORE QUOTES</div>
    <?php } ?>

    <div style="float:right; margin-right:100px; margin-top:20px; text-align:right;">
  <div style="font-size:10px; color:#ffffff;">SHOW :</div>
  <select onchange="chTableLimit('<?=base_url()?>', $(this).val());" class="selectInput" style="width:150px; font-size:16px; padding:3px;">
    <option <?php if($LIMIT == 10) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;" value="10">10</option>
    <option <?php if($LIMIT == 100) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="50">50</option>
    <option <?php if($LIMIT == 300) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="100">100</option>
    <option <?php if($LIMIT == 500) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="500">500</option>
    <option <?php if($LIMIT == 1000) echo "selected='selected'"; ?>  style="font-size:16px; padding:3px;" value="10000">ALL</option>
  </select>
</div>
   

<div style="clear:both"></div>
<div style="height:20px;"></div>
</div>
</div>
