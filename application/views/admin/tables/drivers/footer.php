   </table>
   </div>
   <div style="width:1200px; margin:0px auto; margin-top:7px; ">
   <?php if($LIMIT < $countQ){ ?>
    <div class="ibutton" id="showMoreButton" onclick="getMoreDrivers();">GET MORE DRIVERS</div>
    <?php } ?>

    <div style="float:right; margin-right:100px; margin-top:20px; text-align:right;">
  <div style="font-size:10px; color:#000000;">Количество на странице:</div>
  <select onchange="chTableLimitDrivers('<?=base_url()?>', $(this).val());" style="width:100px; font-size:16px; padding:3px;">
    <option <?php if($LIMIT == 10) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;" value="10">10</option>
    <option <?php if($LIMIT == 100) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="100">100</option>
    <option <?php if($LIMIT == 300) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="300">300</option>
    <option <?php if($LIMIT == 500) echo "selected='selected'"; ?> style="font-size:16px; padding:3px;"  value="500">500</option>
    <option <?php if($LIMIT == 1000) echo "selected='selected'"; ?>  style="font-size:16px; padding:3px;" value="1000">1000</option>
  </select>
</div>

   <script>
       function getMoreDrivers(){
        ipage++;

         $.ajax({
                  type: 'POST',
                  data: ({'getMore':ipage, 'spart':selectedUpMenu2}),
                  url : '<?=base_url()?>admin/drivers/get_more_drivers/',
                  async: false,
                  success: function(response){ 
                      $('#doGroupThigs').fadeOut(500);                    
                      $('#Qtable').append(response);
                      $('.iRow').click(function(){
                         if($('.iRow.active').length > 1){
                            $('#doGroupThigs').fadeIn(500);
                         }else{
                              $('#doGroupThigs').fadeOut(500);
                         } 
                      });
                  }
                  
               });

         if(!(((ipage+1)*<?=$LIMIT?>) < <?=$countQ?>)){
            $('#showMoreButton').fadeOut(500);
         }
        
      }
    </script>   

<div style="clear:both"></div>
<div style="height:20px;"></div>
</div>
</div>
