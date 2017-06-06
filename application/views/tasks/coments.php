<div style="padding:20px; margin-left:<?=$level*30?>; margin-top:20px; background-color: #eeeeee border:solid 1px #dddddd; position:relative;">
	<div class="tbutton" style="background-color:#ffffff; color:red; border:none;"> owner id : <?=$task->owner?> </div>
	<div style="font-size:18px; color:#777777;"><?=$coment->ctitle?> </div>
	<div style="font-size:12px; color:#999999; margin-top:5px; margin-bottom:5px;"><?=$coment->atDate?></div>
	<div style="margin-top:5px; font-size:14px; color:#999999;"><?=$coment->ctext?></div>
	<div style="margin-top:10px; margin-left:-10px;">
   <?php if($haveChilds == 0){ ?><div style="position:absolute; top:5px; right:5px;" onclick="delete_task('<?=base_url()?>', $(this).parent().parent(), '<?=$coment->id?>');" class="tbutton">delete coment</div><?php } ?>
		<div class="tbutton">coments</div>
		<div class="tbutton" onclick="$('#addnewForm<?=$task->id?>').slideDown(500);">add task inside</div>
	</div>

<div id="addnewForm<?=$coment->id?>" style="margin-top:0px; display:none;">
	<div style="margin-top:20px; margin-left:20px; width:500px; padding:20px; border:solid 1px #995050;">
		<div style="font-size:18px; color:#995050;">
				Add new coment inside
		</div>
		<form id="AddFrom" action="<?=base_url()?>tasks/main/add_comment" method="POST">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="parentid" value="<?=$coment->id?>">
			<div class="formLabel">Title</div>
			<div><input type="text" class="Rinput"  name="ttitle"/></div>
			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" style="height:150px; width:400px;" name="ctext"></textarea></div>
			<input type="submit" class="iRbutton" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add comment" />
			<input type="button" class="iRbutton" onclick="$('#addnewForm<?=$coment->id?>').slideUp(500);" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Cancel" />		
		</form>
	</div>
</div>
</div>
