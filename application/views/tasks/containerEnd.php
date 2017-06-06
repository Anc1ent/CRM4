<div onclick="$(this).next().slideDown(500);" style="padding:10px; padding-left:20px; padding-right:20px; color:#ffffff; display:inline-block; margin-top:30px; background-color:#777777; margin-bottom:20px; cursor:pointer;">Add new task</div>
<div style="margin-top:-20px; display:none; width:auto; padding:20px; border:solid 1px #cccccc;">
		<div style="font-size:18px; color:#995050;">
				Add new task
		</div>
		<form id="AddFrom" action="<?=base_url()?>tasks/main/add_task" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="parentid" value="0">
			<div class="formLabel">Title</div>
			<div><input type="text" class="Rinput"  name="ttitle"/></div>
			<input type="file" name="timg" />

			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" style="height:150px; width:90%;" name="ttext"></textarea></div>
			<input type="submit" class="iRbutton" onclick="$(this).parent().submit();" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add task" />	
		</form>
</div>
</div>

</div>