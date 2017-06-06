 <!-- TOP MENU -->
<div style="height:70px;"></div>
<div id="searchForm" class="popupblock" style="float:right; position:fixed; top:0px; left:200px; z-index:999999999; display:none;">
      <div style="width:350px; background-color:#ff5050; padding:20px;">
        <div  style="color:#ffffff; font-size:17px; margin-bottom:5px;">Search</div>
        <select id="nameSearch" style="font-size:14px; padding:5px; margin-right:5px;">
            <option value="q.id">ID</option>
            <option value="c.Email">Email</option>
            <option value="c.FirstName">Frist Name</option>
            <option value="c.Phone">Phone</option>
            <option value="q.destFromCity">Dest From</option>
            <option value="q.destToCity">Dest To</option>
        </select>    
        <input id="textSearch" type="text" style="font-size:14px; padding:5px; width:150px;" placeholder="search text" value=""/>
        <input type="button" style="font-size:14px; padding:5px; padding-left:20px; padding-right:20px; text-align:center; margin-left:5px; margin-top:0px; margin-bottom:0px; width:auto;" onclick="dosearch('<?=base_url()?>', $('#nameSearch').val(), $('#textSearch').val());" class="ibutton" value="Go" />
      </div>
    </div>

  <div style="padding:5px; position:fixed; width:100%; top:0px; left:0px; z-index:65539; background-color:#2B363C; padding-bottom:0px;">
    <div style="float:left; font-size:25px; padding-top:10px; padding-bottom:10px; font-weight:bold;  ">
      <img style="max-height:40px;  height:40px; margin-left:20px;" src="<?=base_url()?>img/logo.svg"/>
    </div>

    <!--div onclick="$('#SEBlock').fadeIn(500); $('#darker').fadeIn(500);" style="float:left; cursor:pointer; position:relative; margin-top:14px; margin-left:15px; width:31px; height:37px; background-image:url('<?=base_url()?>img/S008.jpg'); border-radius:15px; "-->
          <div class="statBlock" id="SEBlock" style="position:absolute; display:none; padding:10px; top:0px; left:0px; width:300px; background-color:#ff5050;">
            <div style="width:100%;">
              <div class="WindowBlockTitle">
                Settings
              </div>
              <div class="SEitems">
                <div class="SEmenuItem">Create New Quote</div>
                <div class="SEmenuItem">Create New Order</div>
                <div class="SEmenuItem">Faq`s</div>
                <div class="SEmenuItem">Tech Support</div>
                <div class="SEmenuItem">Create new Suggestion</div>
                <div class="SEmenuItem" onclick="event.stopPropagation(); $('#SEBlock').fadeOut(300); show_empty_launch_block('<?=base_url()?>', $(this), '0');">Launch without quote</div>
                <div class="SEmenuItem" onclick="event.stopPropagation(); $('#SEBlock').fadeOut(300); show_sms_launch_block('<?=base_url()?>', $(this), '0');">Send SMS</div>
              </div>
            </div>
          </div>
    <!--/div-->
    <div style="float:left; margin-left:100px; margin-top:8px; padding:10px; background-color:#404A50;">
        <div style="float:left; margin-top:0px;  margin-left:10px; margin-right:10px; "><img style="width:16px; " src="<?=base_url()?>img/iconSearch.svg"/></div>
        <div style="float:left; margin-left:7px; margin-top:-1px;"><input id="textSearch"  type="text" style="width:250px;  background-color:inherit; color:#ffffff; border:none; font-size:14px; padding:3px; color:#BACEDB;" onchange="dosearch('<?=base_url()?>', 'all', $(this).val());"  placeholder="Search for..." /></div>
        <div style="clear:both"></div>
    </div>
    
     <div style="float:right; margin-top:18px;">
        <div    style="float:left; margin-top:-2px; cursor:pointer; margin-right:15px;">
          <div style="position:relative;">
            <div title="Waiting Emails" onclick="showEstat('<?=base_url()?>', 'waiting'); $('.statBlock').fadeOut(300); $('#EWBlock').fadeIn(500);"  style="width:26px; cursor:pointer; height:26px; background-image:url('<?=base_url()?>img/icon9.svg'); background-position:0px; background-repeat:no-repeat; background-size:20px; " /></div>
            <div  style="position:absolute; top:-7px; right:-8px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#ffffff; background-color:#888888; border-radius:10px;" id="countAlertsW"><?=$emailsWaiting?></div>
                  <div class="statBlock" id="EWBlock" style="position:absolute; display:none; padding:10px; top:30px; left:0px; width:300px; background-color:#ff5050;">
                  <div style="width:100%;">
                    <div class="WindowBlockTitle">
                      Waiting Emails
                    </div>
                    <div class="SEitems" id="EwaitingContent" style="max-height:400px; overflow-y:auto;">
                      
                    </div>
                  </div>
                </div>
           </div>   
         </div>

        <div    style="float:left; margin-top:4px; cursor:pointer; margin-right:15px;">
          <div style="position:relative;">
            <div title="Sent Emails"  onclick="showEstat('<?=base_url()?>', 'sended'); $('.statBlock').fadeOut(300); $('#ESBlock').fadeIn(500);" style="width:26px; height:26px; background-image:url('<?=base_url()?>img/icon10.svg');  background-repeat:no-repeat; background-size:20px;" /></div>
            <div style="position:absolute; top:-14px; right:-14px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#ffffff; background-color:#1970B0; border-radius:10px;" id="countAlertsS"><?=$emailsSent?></div>
            <div class="statBlock" id="ESBlock" style="position:absolute; display:none; padding:10px; top:30px; left:0px; width:300px; background-color:#ff5050;">
                  <div style="width:100%;">
                    <div class="WindowBlockTitle">
                      Sended Emails
                    </div>
                    <div class="SEitems" id="EsendedContent" style="max-height:400px; overflow-y:auto;">
                      
                    </div>
                  </div>
                </div>
           </div>   
         </div>

          <div    style="float:left; margin-top:4px; cursor:pointer; margin-right:15px;">
          <div style="position:relative;">
            <div title="Opened Emails" onclick="showEstat('<?=base_url()?>', 'opened'); $('.statBlock').fadeOut(300); $('#EOBlock').fadeIn(500);" style="width:26px; height:26px; background-image:url('<?=base_url()?>img/icon11.svg');  background-repeat:no-repeat; background-size:20px;" /></div>
            <div style="position:absolute; top:-14px; right:-14px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#000000; background-color:#FFFF00; border-radius:10px;" id="countAlertsO"><?=$emailsOpened?></div>
             <div class="statBlock" id="EOBlock" style="position:absolute; display:none; padding:10px; top:30px; left:0px; width:300px; background-color:#ff5050;">
                  <div style="width:100%;">
                    <div class="WindowBlockTitle">
                      Opened Emails
                    </div>
                    <div class="SEitems" id="EopenedContent" style="max-height:400px; overflow-y:auto;">
                      
                    </div>
                  </div>
                </div>

           </div>   
         </div>

         <div     style="float:left; margin-top:4px; cursor:pointer; margin-right:60px;">
          <div style="position:relative;">
            <div title="Recived Emails" onclick="showEstat('<?=base_url()?>', 'recived'); $('.statBlock').fadeOut(300); $('#ERBlock').fadeIn(500);" style="width:26px; height:26px; background-image:url('<?=base_url()?>img/icon12.svg');  background-repeat:no-repeat; background-size:20px; margin-top:-2px;" /></div>
            <div style="position:absolute; top:-12px; right:-10px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#000000; background-color:rgb(0,255,128); border-radius:10px;" id="countAlertsR"><?=$emailsRecived?></div>
               <div class="statBlock" id="ERBlock" style="position:absolute; display:none; padding:10px; top:30px; right:0px; width:300px; background-color:#ff5050;">
                  <div style="width:100%;">
                    <div class="WindowBlockTitle">
                      Recived Emails
                    </div>
                    <div class="SEitems" id="ErecivedContent" style="max-height:400px; overflow-y:auto;">
                      
                    </div>
                  </div>
                </div>
           </div>   
         </div>


        <div    style="float:left; margin-top:4px; cursor:pointer; margin-right:15px;">
          <div style="position:relative;">
            <img title="Inital Quote Forms" onclick="showFstat('<?=base_url()?>', 'initial'); $('.statBlock').fadeOut(300); $('#SFIBlock').fadeIn(500);" style="cursor:pointer; width:14px;" src="<?=base_url()?>img/icon13.svg"/>
            <div style="position:absolute; top:-14px; right:-14px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#ffffff; background-color:#DD5675; border-radius:10px;" id="countAlerts0"><?=$formInitCount?></div>

             <div class="statBlock" id="SFIBlock" style="position:absolute; display:none; padding:10px; top:30px; right:0px; width:300px; background-color:#ff5050;">
                <div style="width:100%;">
                  <div class="WindowBlockTitle">
                    Initial quote
                  </div>
                  <div class="SEitems" id="FinitialContent" style="max-height:400px; overflow-y:auto;">

                  </div>
                </div>
          </div>

          </div>
        </div>
        <div  style="float:left; margin-top:4px; cursor:pointer; margin-right:15px;">
          <div style="position:relative;">
            <img title="Request a Call Forms" onclick="showFstat('<?=base_url()?>', 'request'); $('.statBlock').fadeOut(300); $('#SFRBlock').fadeIn(500);" style="cursor:pointer; width:17px;" src="<?=base_url()?>img/icon14.svg"/>
            <div style="position:absolute; top:-14px; right:-14px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#ffffff; background-color:#0BAAEB; border-radius:10px;" id="countAlerts1"><?=$formRequestCount?></div>

                 <div class="statBlock" id="SFRBlock" style="position:absolute; display:none; padding:10px; top:30px; right:0px; width:300px; background-color:#ff5050;">
                <div style="width:100%;">
                  <div class="WindowBlockTitle">
                    Request a Call
                  </div>
                  <div class="SEitems" id="FrequestContent" style="max-height:400px; overflow-y:auto;">

                  </div>
                </div>
              </div>
           </div>   
         </div>
         
         <div  style="float:left; margin-top:4px; cursor:pointer; margin-right:50px;">
          <div style="position:relative;">
            <img  title="Shedule Pickup Forms" onclick="showFstat('<?=base_url()?>', 'shedule'); $('.statBlock').fadeOut(300); $('#SFSBlock').fadeIn(500); " style="width:17px;" src="<?=base_url()?>img/icon15.svg"/>
            <div style="position:absolute; top:-14px; right:-14px; padding:3px; padding-left:7px; padding-right:7px; font-size:9px; color:#ffffff; background-color:#00B100; border-radius:10px;" id="countAlerts2"><?=$formSheduleCount?></div>

                 <div class="statBlock" id="SFSBlock" style="position:absolute; display:none; padding:10px; top:30px; right:0px; width:300px; background-color:#ff5050;">
                <div style="width:100%;">
                  <div class="WindowBlockTitle">
                    Shedule pickup
                  </div>
                  <div class="SEitems" id="FsheduleContent" style="max-height:400px; overflow-y:auto;">

                  </div>
                </div>

           </div>   
         </div>
           </div>
         
         
        <div style="float:left;">
          <div onclick="$('#PCBlock').fadeIn(500); $('#darker').fadeIn(500);" style=" margin-top:-12px; cursor:pointer; margin-right:20px; overflow:hidden;  height:50px; position:relative; width:50px; border-radius:25px; background-position:center; background-image:url('<?=base_url()?>img/user.jpg');">
            

          </div>
          <div id="PCBlock" style="position:absolute; display:none; padding:10px; top:20px; right:20px; width:300px; background-color:#ff5050;">
            <div style="width:100%;">
              <div class="WindowBlockTitle">
               <?=$user->Fname?> <?=$user->Cname?> (Admin)<br/> 
               <?=$user->email?> 
              </div>
              <div class="SEitems">
                <div class="SEmenuItem" onclick="show_pers_cab('<?=base_url()?>'); $('#PCBlock').fadeOut(500);" >Drone Settings</div>
                <div class="SEmenuItem" onclick="document.location='<?=base_url()?>admin/auth/logout';">Logout</div>
              </div>
            </div>
          </div>
        </div>
        <div style="clear:both"></div>
       
    </div>

    <!--div style="float:right; margin-right:80px;">
        <div style="margin-top:10px;">
        <div style="font-size:10px; color:#ffffff; color:#777777;">Emails statistic:</div>

         <div title="Emails Waiting" style="margin:3px auto; cursor:pointer;  font-size:9px;display:inline-block; padding:3px; padding-left:6px; padding-right:6px; border-radius:10px;<?php if($emailsWaiting > 0) { echo "background-color:#1970B0; color:#ffffff;"; }else{ echo "background-color:#cccccc; color:#000000;";  } ?> "><?=$emailsWaiting?></div>  

        <div title="Emails Sent" style="<?php if($emailsSent > 0) { echo "background-color:#1970B0; color:#ffffff;"; }else{ echo "background-color:#cccccc; color:#000000;";  } ?> margin:3px auto; cursor:pointer; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; border-radius:10px; "><?=$emailsSent?></div>
           <div title="Emails Opened" style="margin:3px auto; cursor:pointer; font-size:9px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; border-radius:10px;<?php if($emailsOpened > 0) { echo "background-color:rgb(0,255,128); color:#005696;"; }else{ echo "background-color:#cccccc; color:#000000;";  } ?> "><?=$emailsOpened?></div>
          <div title="Emails Recived" style="margin:3px auto; cursor:pointer;  font-size:9px;display:inline-block; padding:3px; padding-left:6px; padding-right:6px; border-radius:10px;<?php if($emailsRecived > 0) { echo "background-color:#1970B0; color:#ffffff;"; }else{ echo "background-color:#cccccc; color:#000000;";  } ?> "><?=$emailsRecived?></div>
          


            <div title="Notices" onclick="event.stopPropagation(); show_quote_notice('<?=base_url()?>', '0', $(this));" style="cursor:pointer; margin:3px auto; font-size:9px; border-radius:10px; display:inline-block; padding:3px; padding-left:6px; padding-right:6px; <?php if($countNotices > 0) { echo "background-color:#ff5050; color:#ffffff;"; }else{ echo "background-color:#cccccc; color:#000000;";  } ?> "><?=$countNotices?></div>
           </div> 
    </div-->
    
    <div style="clear:both;"></div>
  </div>
  <!-- / TOP MENU -->

  <!-- LEFT MENU -->
  <div style="width:250px; background-color:#343E48; height:100%; position:fixed;">
      
      
     
      
      <div style="margin-top:0px;">

          <div onclick="showDashboard('<?=base_url()?>','Dashboard', $(this));" class="FlevelMenuItem <?php if($menu_active == "Dashboard") echo "active3"; ?>" >
          <div style="float:left; margin-right:7px;  margin-top:2px;">
            <div><img class="iconImage" src="<?=base_url()?>img/icon1.svg" style="width:25px; margin-left:7px; margin-top
            :3px; margin-right:15px;"/></div>
          </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Dashboard</div> 
          
          <div style="clear:both;"></div>
        </div>

        <div onclick="selectFirstLevelMenu('Leads', $(this));" class="FlevelMenuItem <?php if($menu_active == "Leads") echo "active3"; ?>" >
          <div style="float:left; margin-right:7px;  margin-top:2px;">
            <div><img class="iconImage" src="<?=base_url()?>img/icon2.svg" style="width:25px; margin-left:7px; margin-right:15px;"/></div>
          </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Leads</div> 
          <div style="float:right; font-size:12px; margin-top:3px; margin-right:5px;" class="countInsideFlevelMenu"><?=$countInParts[0]?></div> 
          <div style="clear:both;"></div>
        </div>

        <div>
        <?php foreach($upmenu[0] as $item){ ?>
        <div class="SmenuLeads Smenu" style="background-color:#191919; display:none; color:#ffffff;  font-size:15px;">
          <div id="SPitem<?=$item->id?>" onclick="var ithis = $(this); showPartQuotes('<?=base_url()?>','<?=$item->id?>', ithis);" class="SlevelMenuItem   <?php if(($menu_active == 'Leads')&&($menu_active2 == $item->id)) echo "active3"; ?>" >
            <div style="float:left;"><?=$item->sname?></div> 
            <div style="float:right; font-size:11px; margin-right:10px; " id="countInside<?=$item->id?>" ><?=$item->count_inside?></div> 
            <div style="clear:both;"></div>
          </div>
         </div>  
        <?php } ?>
        </div>
          
       
        <div onclick="selectFirstLevelMenu('Quotes', $(this));" class="FlevelMenuItem <?php if($menu_active == "Quotes") echo "active3"; ?>" >
         <div style="float:left;  margin-right:7px;  margin-top:2px;">
  <div><img class="iconImage" src="<?=base_url()?>img/icon3.svg" style="width:25px; margin-left:7px; margin-right:15px;"/></div>
         </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Quotes</div> 
          <div style="float:right;  font-size:12px; margin-top:3px; margin-right:5px;" class="countInsideFlevelMenu"><?=$countInParts[1]?></div> 
          <div style="clear:both;"></div>
        </div>
         <div>
        <?php foreach($upmenu[1] as $item){ ?>
        <div class="SmenuQuotes Smenu" style="background-color:#191919; display:none;  color:#ffffff;  font-size:15px;">
          <div id="SPitem<?=$item->id?>" onclick="var ithis = $(this); showPartQuotes('<?=base_url()?>','<?=$item->id?>', ithis);"  class="SlevelMenuItem  <?php if(($menu_active == 'Quotes')&&($menu_active2 == $item->id)) echo "active3"; ?>" >
            <div style="float:left;"><?=$item->sname?></div> 
            <div style="float:right; font-size:12px; margin-right:10px; " id="countInside<?=$item->id?>"><?=$item->count_inside?></div> 
            <div style="clear:both;"></div>
          </div>
         </div>  
        <?php } ?>
         </div>
         <div onclick="selectFirstLevelMenu('Orders', $(this));" class="FlevelMenuItem <?php if($menu_active == "Orders") echo "active3"; ?>">
         <div style="float:left;  margin-right:7px;  margin-top:2px;">
             <div><img class="iconImage" src="<?=base_url()?>img/icon4.svg" style="width:25px; margin-left:7px; margin-right:15px;"/></div>
         </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Orders</div> 
          <div style="float:right; font-size:12px; margin-top:3px; margin-right:5px;" class="countInsideFlevelMenu"><?=$countInParts[2]?></div> 
          <div style="clear:both;"></div>
        </div>
         <div>
        <?php foreach($upmenu[2] as $item){ ?>
        <div class="SmenuOrders Smenu" style="background-color:#191919; display:none;  color:#ffffff;  font-size:15px;">
          <div  id="SPitem<?=$item->id?>" onclick="var ithis = $(this); showPartQuotes('<?=base_url()?>','<?=$item->id?>', ithis);"  class="SlevelMenuItem  <?php if(($menu_active == 'Orders')&&($menu_active2 == $item->id)) echo "active3"; ?>" >
            <div style="float:left;"><?=$item->sname?></div> 
            <div style="float:right; font-size:12px; margin-right:10px;" id="countInside<?=$item->id?>"><?=$item->count_inside?></div> 
            <div style="clear:both;"></div>
          </div>
         </div>  
        <?php } ?>
        </div>
         <div onclick="selectFirstLevelMenu('Archive', $(this));" class="FlevelMenuItem <?php if($menu_active == "Archive") echo "active3"; ?>">
         <div style="float:left;  margin-right:7px;  margin-top:2px;">
 <div><img class="iconImage" src="<?=base_url()?>img/icon5.svg" style="width:25px; margin-left:7px; margin-right:15px;"/></div>
         </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Dispatch</div> 
          <div style="float:right; font-size:12px; margin-top:3px; margin-right:5px;" class="countInsideFlevelMenu"><?=$countInParts[3]?></div> 
          <div style="clear:both;"></div>
        </div>
         <div>
        <?php foreach($upmenu[3] as $item){ ?>
        <div class="SmenuArchive Smenu" style="background-color:#191919; display:none;  color:#ffffff;  font-size:15px;">
          <div  id="SPitem<?=$item->id?>" onclick="var ithis = $(this); showPartQuotes('<?=base_url()?>','<?=$item->id?>', ithis);" class="SlevelMenuItem <?php if(($menu_active == 'Orders')&&($menu_active2 == $item->id)) echo "active3"; ?>" >
            <div style="float:left;"><?=$item->sname?></div> 
            <div style="float:right; font-size:12px; margin-right:10px; " id="countInside<?=$item->id?>"><?=$item->count_inside?></div> 
            <div style="clear:both;"></div>
          </div>
         </div>  
        <?php } ?>
        </div>
      </div>
       <div style="width:70%; height:2px;  border-top:solid 3px #9AC3E3;; margin:0px auto; opacity:0.24; margin-top:5px; margin-bottom:5px;"></div>
      
      <div class="FlevelMenuItem" onclick="$('#SEBlock').fadeIn(500); $('#darker').fadeIn(500);" >
          <div style="float:left; margin-right:7px;  margin-top:2px;">
            <div><img class="iconImage" src="<?=base_url()?>img/icon6.svg" style="width:25px; margin-left:7px; margin-top
            :3px; margin-right:15px;"/></div>
          </div> 
          <div  style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Settings</div> 
         
          <div style="clear:both;"></div>
        </div>

         <!--div class="FlevelMenuItem" >
          <div style="float:left; margin-right:7px;  margin-top:2px;">
            <div><img class="iconImage" src="<?=base_url()?>img/icon6.svg" style="width:20px; margin-left:7px; margin-top
            :3px; margin-right:20px;"/></div>
          </div> 
          <div style="float:left; color:#BACEDB; margin-top:3px; text-transform:uppercase;">Alerts</div> 
          
          <div style="clear:both;"></div>
        </div-->
<?php /*
       <div onclick="show_pers_cab('<?=base_url()?>');" style="margin-top:40px; cursor:pointer; padding:10px; padding-left:10px; padding-right:10px;">
        <div style="float:left; cursor:pointer; margin-right:10px; overflow:hidden;  height:35px; width:35px; border-radius:20px; background-image:url('<?=base_url()?>img/user-icon.png'); background-size:cover;"></div>
        <div style="float:left; color:#ffffff; font-size:13px; " >
          <div style="font-size:12px;" title="<?=$user->email?>"><?php if(strlen($user->email)>10){ echo substr($user->email, 0, 10)."..."; }else{  echo $user->email;  } ?></div>
          <div style="font-size:12px; color:#999999;">Site Administrator</div>
        </div>
        <div style="clear:both;"></div>
      </div>
      
      <div style="margin-top:20px;">
         <div style="color:#ffffff; padding:20px; font-size:14px; cursor:pointer;">
            <div style="float:left; margin-right:7px; "><div class="cursorIcon"></div></div> 
             <div style="float:left; margin-top:-1px;" onclick="document.location='<?=base_url()?>admin/auth/logout';">Logout</div>
             <div style="clear:both"></div>
         </div> 
      </div>
      */ ?>
     
      
  </div> 
   <div style="position:fixed; bottom:3px; width:250px; text-align:center; font-size:10px; color:rgba(255,255,255,0.5);">
        Copyright © SalesDrone
      </div>
  <!--  / LEFT MENU -->