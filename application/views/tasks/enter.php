<style>
body{
	background-image:url('<?=base_url()?>img/fon.jpg');
	background-position:center;
	background-repeat:no-repeat;
	background-size:cover;
	overflow:hidden;
}
</style>
<div style="width:100%;  z-index:-1; background-color:rgba(0,0,0,0.4); height:100%; position:fixed; top:0px; left:0px;">
</div>
<div id="content" style="margin-top:40px; width:300px; margin:auto auto; margin-top:calc(50% - 550px);">
<div onclick="document.location='<?=base_url()?>admin/';" style="font-size:24px; cursor:pointer; margin-top:-28px; margin-left:-5px; margin-bottom:10px; color:#666666; padding:10px;  padding-left:0px; padding-right:0px;">
        
        <div style="float:left; color:#ffffff; font-weight:normal;" class="headerTitle" >TASKS MANAGER</div>
        <div style="clear:both;"></div>
    </div>
<form method="POST" action="<?=base_url()?>tasks/main/auth">
	<div style="font-size:13px; margin-bottom:3px; color:#ffffff;">E-mail</div>
	<div><input  type="text" class="Einput" name="Elogin" id="Elogin" autofocus><div onclick="document.location='<?=base_url()?>tasks/main/add_new_user/'+$('#Elogin').val();" style="font-size:11px; color:#ffffff; display:inline-block; margin-left:5px;">+</div></div>

	<div style="font-size:13px; margin-top:10px; margin-bottom:3px; color:#ffffff;">Password</div>
	<div><input  type="password" class="Einput" name="Epass"></div>
	<input type="hidden" name="CSRF_TOKEN" value=""/>
	
	<div style="margin-top:20px;"><input class="ibutton" type="submit" style="width:auto; margin-top:0px; font-weight:bold; font-size:13px;" value="  ENTER  " /></div>
</form>
</div>