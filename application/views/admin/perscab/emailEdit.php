 <div style="width:100%; height:100%;">
<div id="iPerrscabTitle" style="font-size:18px; padding:10px; color:#ffffff; background-color:#00ACFF;">
<div style="float:left;padding-left:13px; ">EDIT EMAIL</div>
<div id="closeEmailWindow" onclick="$('#editemailblock').fadeOut(500); $('#EditEmailContainer').fadeOut(500);" style="float:right; padding-right:15px; font-size:13px; cursor:pointer; padding:3px; padding-left:10px; padding-right:10px; background-color:rgba(255,255,255,0.2);">close</div>
<div style="clear:both;"></div>
</div>  <div style=" padding:20px;  background-color:#ffffff;">
            <form method="POST" action="<?=base_url()?>admin/main/addchemail/">
              <input type="hidden" name="Eid" id="Emid" value="<?=$data->id?>">
              <div style="float:left; width:40%;">
                <div style="font-size:11px; " class="PformLabel">Email name</div>
                <div><input type="text" style="width:100%;" name="Ename" value="<?=$data->name?>" /></div>

                <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email subject</div>
                <div><input type="text" style="width:100%;" name="Esubject"  value="<?=stripslashes($data->subject)?>" /></div>

                <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email From</div>
                <div><input type="text" style="width:100%;" name="Efrom" value="<?=$data->efrom?>" /></div>
              </div>
              <div style="float:right; width:40%; margin-right:20px;">
                <div style="font-size:11px; margin-top:10px;" class="PformLabel">Name From</div>
                <div><input type="text" style="width:100%;" name="Enfrom" value="<?=$data->enfrom?>" /></div>  

                <div style="font-size:11px; margin-top:10px;" class="PformLabel">Reply to</div>
                <div><input type="text" style="width:100%;" name="Ereplyto" value="<?=$data->replyto?>" /></div>

                <div style="font-size:11px; margin-top:10px;" class="PformLabel">resend-bcc</div>
                <div><input type="text" style="width:100%;" name="Ebcc" value="<?=$data->bcc?>" /></div>
              </div>
              <div style="clear:both;"></div>
              <div style="font-size:11px; margin-top:10px;" class="PformLabel">Email text</div>
              <div><textarea id="textareaAR<?=$hash?>"  style="font-size:12px; height:400px;"><?=stripslashes($data->text)?></textarea></div>
              <div style="clear:both;"></div>
              <div style="margin-top:10px; margin-bottom:10px;">
                <input <?php if($data->sendToDriver  == 1) echo "checked='checked'"; ?> type="checkbox" style="width:20px;" name="sendToDriver" />
                <div style="display:inline-block; margin-left:5px;">Can send to driver</div>
              </div>
              <?php if((!isset($notSave))||($notSave == 0)){ ?>
              <div style="font-size:11px; margin-top:10px;">Send only in work time</div>
              <div>
                <select name="OnlyInworkTime">
                   <option <?php if($data->OnlyInworkTime == 0) echo " selected='selected' "; ?> value="0" >Any time</option> 
                   <option <?php if($data->OnlyInworkTime == 1) echo " selected='selected' ";  ?> value="1" >In work time only</option> 
                   <option <?php  if($data->OnlyInworkTime == 2) echo " selected='selected' "; ?> value="2" >After work time only</option> 
                </select>
              </div>
              <div style="height:10px;"></div>
              
              
              <input type="button" class="buttonBlue" style="width:auto; cursor:pointer; text-align:center; margin-top:20px; padding:10px; border-radius:10px; border-radius:10px;" onclick="UpdateEmail($(this).parent(), '<?=$data->id?>', '<?=$hash?>'); $('#EditEmailContainer').fadeOut(500);" class="iButton"   value=" Save Email "/>
 
              <input type="button" id="saveTemporary" class="buttonGreen" style="width:auto; display:none; cursor:pointer; margin-top:20px; padding:10px; margin-left:20px; border-radius:10px;" onclick="$('#Emid').val('0'); UpdateEmail($(this).parent(), '0', '<?=$hash?>'); $('#EditEmailContainer').fadeOut(500);" class="iButton buttonGreen"  value=" Save as temporary shablon to once send "/>

              <?php }else{
                ?>

                <div style="height:10px;"></div>
              
              
              <input type="button" onclick="$('#EID').append($('<option>', { value: <?=$data->id?>,  text: $('input[name=Esubject]').val() })); $('#EID option[value=<?=$data->id?>]').prop('selected', 'selected'); UpdateEmail($(this).parent(), '<?=$data->id?>', '<?=$hash?>'); $('#EditEmailContainer').fadeOut(500);" class="iButton buttonGreen" style="width:auto; margin-top:20px;"  value=" Save Email "/>
                <?php
                } ?>
            </form>

          </div></div>
   <script>
      var iflagSucces = false;
	 var i, t = tinyMCE.editors;
                for (i in t){
                    if (t.hasOwnProperty(i)){
                        t[i].remove();
                    }
                }
   tinyMCE.init({
                    selector: "#textareaAR<?=$hash?>",                            
                    language : 'en',
                    plugins: [
                            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "table contextmenu directionality emoticons template textcolor textcolor colorpicker textpattern kavich paste fullpage"
                    ],
            
                    toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect",
                    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | kavich | fontsizeselect | fontselect",
                    extended_valid_elements : "a[*],abbr[*],acronym[*],address[*],applet[*],area[*],article[*],aside[*],audio[*],b[*],base[*],basefont[*],bdi[*],bdo[*],bgsound[*],big[*],blink[*],blockquote[*],body[*],br[*],button[*],canvas[*],caption[*],center[*],cite[*],code[*],col[*],colgroup[*],command[*],comment[*],datalist[*],dd[*],del[*],details[*],dfn[*],dir[*],div[*],dl[*],dt[*],em[*],embed[*],fieldset[*],figcaption[*],figure[*],font[*],footer[*],form[*],frame[*],frameset[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],head[*],header[*],hgroup[*],hr[*],html[*],i[*],iframe[*],img[*],input[*],ins[*],isindex[*],kbd[*],keygen[*],label[*],legend[*],li[*],link[*],listing[*],map[*],mark[*],marquee[*],menu[*],meta[*],meter[*],multicol[*],nav[*],nobr[*],noembed[*],noframes[*],noscript[*],object[*],ol[*],optgroup[*],option[*],output[*],p[*],param[*],plaintext[*],pre[*],progress[*],q[*],rp[*],rt[*],ruby[*],s[*],samp[*],script[*],section[*],select[*],small[*],source[*],spacer[*],span[*],strike[*],strong[*],style[*],sub[*],summary[*],sup[*],table[*],tbody[*],td[*],textarea[*],tfoot[*],th[*],thead[*],time[*],title[*],tr[*],track[*],tt[*],u[*],ul[*],var[*],video[*],wbr[*],xmp[*]",
                    menubar: false,
                    relative_urls : false,
  					remove_script_host : false,
  					document_base_url : '<?=base_url()?>',
                    toolbar_items_size: 'small',
                    force_br_newlines : 'true',
                    remove_trailing_nbsp : false,
                    autosave_ask_before_unload: false,
                    image_advtab: true,
                    image_title: true,
                    rel_list: [
                        {title: '', value: ''},
                        {title: 'nofollow', value: 'nofollow'},
                    ],
            
                    fontsize_formats: "12px 14px 16px 18px 20px 24px 36px"                                                           
                    
                 }); </script>
         