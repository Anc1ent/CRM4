<div>
     <div onclick="document.location='<?=base_url()?>admin/';" style="font-size:34px; cursor:pointer; margin-top:-28px; color:#666666; padding:10px; float:left; padding-left:0px; padding-right:0px;"><div class="headerTitle" >Easy Sender</div></div>
<div style="float:right; margin-top:-20px;"><div style="font-size:12px; text-align:right;">server time:</div><div class="timeText"><span id="shours"><?=$nowDay['hours']?></span>:<span id="sminutes"><?=$nowDay['minutes']?></span>:<span id="sseconds"><?=$nowDay['seconds']?></span></div></div>


 <div style="clear:both;"></div>
</div>
<div id="content">
<table cellpadding="0" cellspacing="0" class="iTextContent" style="width:100%;">
    <tr class="TableHead" >
        <td style="width:26px;"></td>
        <td style="width:26px;"></td>
        <td>Title</td>
        <td>Subject</td>
        <td style="width:100px; text-align:center;">Wait</td>
        <td style="width:150px;"></td>
        <td style="text-align:center;"></td>
       
      </tr> 
      
  <?php
  foreach($query as $data){
    ?>
    <tr class="iRow">
        <td  style="font-size:14px;" class="buttonCell"><div class="arrowUp"></div></td>
        <td  style="font-size:14px;" class="buttonCell" ><div class="arrowDown"></div></td>

        <td  style="font-size:18px;"><?=$data->name?></td>
        <td  style="font-size:14px;"><?=$data->subject?></td>
        <td  style="font-size:25px; text-align:center; width:150px;"><input type="text" style="border:none; text-align:right; width:100px; background-color:inherit; font-size:inherit; padding:0px; color:inherit;" onchange="changeEmailValue('sendAfterPrev', $(this).val(), <?=$data->id?>);" value="<?=$data->sendAfterPrev?>" /> <span style="font-size:13px; font-style:italic; margin-left:-2px;">sec</span></td>
        <td  style="font-size:14px; text-align:center;" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); $('#Remail<?=$data->id?>').fadeOut(500); }else{ $(this).addClass('active'); $('#Remail<?=$data->id?>').fadeIn(500); }" class="buttonCell">EDIT EMAIL</td>
        <td  style="font-size:14px; text-align:center;" onclick="document.location='<?=base_url()?>deleteemail/<?=$data->id?>';">x</td>
      </tr>
      <tr>
        <td colspan="7" id="Remail<?=$data->id?>" style="background-color:#8E9D80; display:none; ">
          <div style="width:800px; float:left; background-color:#8E9D80; color:#ffffff; padding:20px; ">
            <form method="POST" action="<?=base_url()?>admin/addchemail/">
              <input type="hidden" name="Eid" value="<?=$data->id?>">
              <div style="font-size:11px;">Email name</div>
              <div><input type="text" name="Ename" value="<?=$data->name?>" /></div>

              <div style="font-size:11px; margin-top:10px;">Subject</div>
              <div><input type="text" name="Esubject"  value="<?=$data->subject?>" /></div>

              <div style="font-size:11px; margin-top:10px;">Email text</div>
              <div><textarea name="Etext" style="font-size:12px;"><?=$data->text?></textarea></div>

              <div style="font-size:11px; margin-top:10px;">Automated move after send</div>
              <div>
              <select name="AutomatedTo">
                <?php foreach($folders as $item){ ?>
                <option <?php if($data->AutomatedTo == 0) echo " selected='selected' "; ?> value="0">Do nothing</option>
                <option <?php if($data->AutomatedTo == $item->id) echo " selected='selected' "; ?> value="<?=$item->id?>"><?=$item->name?></option>
                <?php } ?>
              </select>  
              </div>

              <div style="font-size:11px; margin-top:10px;">Send only in work time</div>
              <div>
                <select name="OnlyInworkTime">
                   <option <?php if($data->OnlyInworkTime == 0) echo " selected='selected' "; ?> value="0" >Any time</option> 
                   <option <?php if($data->OnlyInworkTime == 1) echo " selected='selected' "; ?> value="1" >In work time only</option> 
                   <option <?php if($data->OnlyInworkTime == 2) echo " selected='selected' "; ?> value="2" >After work time only</option> 
                </select>
              </div>

              <input type="submit" class="ibutton" value=" Save Changes "/>
            </form>

          </div>
         
        </td>
      </tr>
   
    <?php
  }
 
   ?>
    </table>

    <div class="ibutton" onclick="if($(this).hasClass('active')){ $(this).removeClass('active'); $(this).next().fadeOut(500); }else{ $(this).addClass('active'); $(this).next().fadeIn(500); }">Добавить письмо в рассылку</div>
    <div  style="background-color:#8E9D80; display:none; color:#ffffff; padding:20px; width:50%;">
      <form method="POST" action="<?=base_url()?>admin/addchemail/">
          <div style="font-size:11px;">Название письма</div>
          <div><input type="text" name="Ename" value="" /></div>

          <div style="font-size:11px; margin-top:10px;">Subject письма</div>
          <div><input type="text" name="Esubject"  value="" /></div>

          <div style="font-size:11px; margin-top:10px;">Текст письма</div>
          <div><textarea name="Etext"></textarea></div>

           <div style="font-size:11px; margin-top:10px;">Automated move after send</div>
              <div>
              <select name="AutomatedTo">
                <?php foreach($folders as $item){ ?>
                <option <?php if($data->AutomatedTo == 0) echo " selected='selected' "; ?> value="0">Do nothing</option>
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


          <input type="submit" class="ibutton" value="  Добавить в рассылку "/>
      </form>
    </div>
</div>