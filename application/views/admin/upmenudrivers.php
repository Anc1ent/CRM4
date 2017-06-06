<div style="width:100%;  background-image:url('<?=base_url()?>img/fon.jpg');  background-position:center;  background-repeat:no-repeat;  background-size:cover; z-index:-2; height:100%; position:fixed; top:0px; left:0px;">
</div>
<div style="width:100%; background-color:rgba(0,0,0,0.5); z-index:-1; height:100%; position:fixed; top:0px; left:0px;">
</div>
<div id="upMenuBlock" style="margin-left:0px; margin-right:5px; margin-top:0px; padding-top:0px;">
<div style=" width:1200px; margin:0px auto;">




     <div onclick="document.location='<?=base_url()?>admin/';" style="font-size:34px;   cursor:pointer;  color:#666666; padding:10px; float:left; padding-left:0px; padding-top:15px; padding-right:20px;">
        <div style="float:left; width:30px; height:30px;  overflow:hidden; margin-right:10px; margin-left:5px; border:solid 3px #ffffff; background-color:#ffffff; border-radius:25px; margin-top:-2px;">
               <div style="background-image:url('<?=base_url()?>img/icon.png'); background-position:center; background-size:cover; background-repeat:no-repeat; width:25px; height:25px;  margin-left:2px; margin-top:2px;"></div>             
        </div>
        <div style="float:left; margin-top:-7px; margin-left:7px;color:#ffffff; font-weight:normal" class="headerTitle" >Easy Sender Drivers</div>
        <div style="clear:both;"></div>
    </div>
    <!--div style="float:right; margin-top:-20px;margin-right:5px;">
        <div style="font-size:12px; text-align:right;">server time:</div>
        <div class="timeText">
            <span id="shours"><?=$nowDay['hours']?></span>:<span id="sminutes"><?=$nowDay['minutes']?></span>:<span id="sseconds"><?=$nowDay['seconds']?></span>
        </div>
    </div-->
      <div style="padding:5px; width:300px; overflow:hidden; height:55px;  float:right; padding-bottom:0px; padding-top:0px; margin-left:20px; font-size:10px; margin-right:0px; margin-bottom:3px; padding-left:5px; ">
    <div style="float:left;  margin-right:5px;  margin-bottom:5px; padding:5px; padding-right:7px; margin-top:5px; padding-bottom:7px; padding-top:5px;  ">
         <img src="<?=base_url()?>img/user-icon.png" style="float:left; max-width:40px;"/>
    </div>
  <div style="font-size:11px; margin-top:10px; margin-bottom:5px; color:#ffffff;"><?=$user->email?></div> 
  <div class="ibutton" style="padding:3px; font-size:10px; padding-left:10px; padding-right:10px; float:left; display:inline-block; cursor:pointer; clear:right; margin-top:0px; margin-right:3px;">perscab</div>
  <div class="iredButton" onclick="document.location='<?=base_url()?>admin/auth/logout';" style="padding:3px; font-size:10px; padding-left:10px; padding-right:10px; float:left; display:inline-block; cursor:pointer; clear:right; margin-top:0px; margin-left:2px; ">logout</div>
  <div style="clear:both;"></div>
</div>
  
 <div style="clear:both;"></div>
</div>
<div style="width:1200px; margin:0px auto;">
 <div style=" color:#000000;  padding:5px; margin-top:10px; padding-left:0px; padding-right:0px; padding-bottom:0px; ">
     <div onclick="showPartDrivers('<?=base_url()?>','0', $(this)); $('.secondMenu').fadeOut(500); $('.upmenuButton').removeClass('active'); $(this).addClass('active');" class="upmenuButton <?php if($menu_active == "All") echo "active"; ?>" style=" border-left:solid 1px rgba(33,122,185,0.9); ">All <span style="font-size:12px;padding-left:3px;">(<?=($countQ)?>)</span></div>
    <div onclick="showSecondupMenu($(this), 'New');" class="upmenuButton <?php if($menu_active == "New") echo "active"; ?>">New<span style="font-size:12px; padding-left:3px;">(<?=$countInParts[100]?>)</span></div>
    <div onclick="showSecondupMenu($(this), 'Processed');" class="upmenuButton <?php if($menu_active == "Processed") echo "active"; ?>">Processed <span style="font-size:12px; padding-left:3px;">(<?=$countInParts[101]?>)</span></div>
    <div onclick="showSecondupMenu($(this), 'Worked');" class="upmenuButton <?php if($menu_active == "Worked") echo "active"; ?>">Worked <span style="font-size:12px; padding-left:3px;">(<?=$countInParts[102]?>)</span></div>
    <div onclick="showSecondupMenu($(this), 'Archive');" class="upmenuButton <?php if($menu_active == "Archive") echo "active"; ?>">Archive <span style="font-size:12px; padding-left:3px;">(<?=$countInParts[103]?>)</span></div>
    <div class="upmenuButton redbutton <?php if($menu_active == "preferences") echo "active"; ?>" style="float:right;" onclick="document.location='<?=base_url()?>admin/config/';">Preferences</div>
    <div id="searchForm" class="popupblock" style="float:right; position:relative; display:none;">
      <div class="windcontainer" >
        <div  style="color:#ffffff; font-size:17px; margin-bottom:5px;">Search</div>
        <select style="font-size:14px; padding:5px; margin-right:5px;">
            <option value="id">ID</option>
            <option value="email">Email</option>
            <option value="name">Name</option>
        </select>    
        <input type="text" style="font-size:14px; padding:5px; width:150px;" placeholder="search..." value=""/>
        <input type="button" style="font-size:14px; padding:5px; padding-left:20px; padding-right:20px; text-align:center; margin-left:5px; margin-top:0px; margin-bottom:0px; width:auto;" class="ibutton" value="Go" />
      </div>
    </div>
    <div class="popupbutton upmenuButton redbutton2" onclick="if($(this).hasClass('active')){ $('#darker').fadeOut(500); $(this).removeClass('active'); $('#searchForm').fadeOut(500); }else{ $('#darker').fadeIn(500); $(this).addClass('active'); $('#searchForm').fadeIn(500); }" style="float:right;">Search</div>
    
    <div id="filterForm" class="popupblock" style="float:right; position:relative; display:none;">
      <div class="windcontainer" >
        <div style="color:#ffffff; font-size:17px; margin-bottom:5px;">Filter settings</div>
        <select style="font-size:14px; padding:5px; margin-right:5px;">
            <option value="id">ID</option>
            <option value="email">Email</option>
            <option value="name">Name</option>
        </select>    
        <input type="text" style="font-size:14px; padding:5px; width:150px;" placeholder="search..." value=""/>
        <input type="button" style="font-size:14px; padding:5px; padding-left:20px; padding-right:20px; text-align:center; margin-left:5px; margin-top:0px; margin-bottom:0px; width:auto;" class="ibutton" value="Go" />
      </div>
    </div>
    <div class="upmenuButton popupbutton redbutton leftesItem" onclick="if($(this).hasClass('active')){ $('#darker').fadeOut(500); $(this).removeClass('active'); $('#filterForm').fadeOut(500); }else{ $('#darker').fadeIn(500); $(this).addClass('active'); $('#filterForm').fadeIn(500); }" style="float:right;">Filter</div>


    <div style="clear:both;"></div>
 </div>


<?php 
    foreach($sPartsNames as $key=>$value){
 ?>
  <div id="<?=$value?>Menu" class="secondMenu" style=" margin-top:0px; padding:5px; padding-left:0px;<?php if($menu_active != $value) echo "display:none;"; ?>  border-left:none; color:#000000; margin-top:0px;  margin-bottom:10px;">
   <?php $first = true; if((isset($upmenu[$key]))&&(count($upmenu[$key] > 0))) foreach($upmenu[$key] as $item){ ?>
    <div <?php if($first == true){ $first = false; echo " style='border-left:solid 1px rgba(33,122,185,0.9) !important;' "; } ?> ondblclick="delete_folder('<?=base_url()?>', '<?=$item->id?>'); $(this).fadeOut(500);" onclick=" var ithis = $(this); setTimeout(function(){showPartDrivers('<?=base_url()?>','<?=$item->id?>', ithis)},200);"  class="upmenuButton <?php if(($menu_active == $value)&&($menu_active2 == $item->id)) echo "active"; ?>"><?=$item->sname?> (<?=$item->count_inside?>)</div>
   <?php } ?> 

     <div class="popupblock" style="float:left; margin-left:10px; position:relative; display:none;">
      <div class="windcontainer" style="left:0px; top:10px; width:240px; white-space:nowrap;">
      <div style="color:#ffffff; font-size:17px; margin-bottom:5px; margin-top:-7px;">Add folder</div>
        <input type="text" style="font-size:14px; padding:5px; width:150px;" placeholder="folder name" value=""/>
        <input type="button" style="font-size:14px; padding:5px; padding-left:20px; padding-right:20px; text-align:center; margin-left:10px; margin-top:0px; margin-bottom:0px; width:auto;" onclick=" add_folder('<?=base_url()?>', '<?=$key?>', $(this).prev().val(), $(this).parent().parent()); $('#darker').fadeOut(500);  $(this).parent().parent().css('display', 'none');" class="ibutton" value="Add" />
      </div>
    </div>
    <div onclick="$(this).prev().fadeIn(500); $('#darker').fadeIn(500);" class="upmenuButton iredButton">+ add new folder</div>
    

    <div style="clear:both;"></div>
 </div>

 <?php } ?>

 
 </div>
 <div style="height:10px;"></div>

 
 </div>