<style>
body{
	 background: #252525; /* For browsers that do not support gradients */
	 background: -webkit-linear-gradient(left, #111111, #252525); /* For Safari 5.1 to 6.0 */
	 background: -o-linear-gradient(left,#111111, #252525); /* For Opera 11.1 to 12.0 */
	 background: -moz-linear-gradient(left,#111111, #252525); /* For Firefox 3.6 to 15 */
	 background: linear-gradient(to right, #111111, #252525); /* Standard syntax */
}
</style>
<div id="content" style="margin-top:40px; width:300px; margin:auto auto; margin-top:150px;">
<div onclick="document.location='<?=base_url()?>admin/';" style="font-size:34px; cursor:pointer; margin-top:-28px; margin-left:-5px; margin-bottom:0px; color:#666666; padding:0px;  padding-left:0px; padding-right:0px;">
	
        <!--div style="color:#427AB6; font-weight:normal" class="headerTitle" ><span style="color:#ffffff;">Sales</span>Drone</div-->
        <div><img src="<?=base_url()?>img/logo.svg" style="height:100px;"/></div>
    </div>
<form method="POST" action="<?=base_url()?>admin/auth/">
	<div style="font-size:13px; margin-bottom:3px; color:#ffffff;">E-mail</div>
	<div><input  type="text" class="Einput" name="Elogin" id="Elogin" autofocus></div>

	<div style="font-size:13px; margin-top:10px; margin-bottom:3px; color:#ffffff;">Password</div>
	<div><input  type="password" class="Einput" name="Epass"></div>
	<input type="hidden" name="CSRF_TOKEN" value="<?=$CRSF_TOKEN?>"/>
	
	<div style="margin-top:20px;"><input class="ibutton" type="submit" style="width:auto; margin-top:0px; font-weight:bold; font-size:13px;" value="  ENTER  " /></div>
</form>
</div>