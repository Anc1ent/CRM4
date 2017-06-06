<div style="padding:10px; margin-left:<?=$level*50?>; padding-top:25px; padding-left:20px; padding-bottom:30px;  margin-top:0px; border-bottom:solid 1px #dddddd; border-left:solid 1px #dddddd; position:relative; <?php if($task->parentid == 0){ ?> margin-top:40px; <?php } ?>">

<?php if($task->parentid == 0){ ?>
	<div style="position:absolute; top:-10px; left:-15px; padding:3px; z-index:999999; padding-right:10px; padding-left:10px; background-color:#dddddd;  color:#ffffff; cursor:pointer; height:20px; width:9px;"></div>
	<?php } ?>	

<?php if($haveChilds == 1){ ?>
	<div onclick="if($(this).html() == '-'){ $('#container<?=$task->id?>').slideUp(500); $(this).css('background-color', '#995050'); $(this).html('+'); }else{ $('#container<?=$task->id?>').slideDown(500); $(this).html('-'); $(this).css('background-color', '#999999'); }" style="position:absolute; bottom:-10px; left:35px; padding:3px; z-index:999999; padding-right:10px; padding-left:10px; background-color:#999999;  color:#ffffff; cursor:pointer;">-</div>
	<?php } ?>	
	<div style="font-size:20px; color:#995050; margin-top:-10px; padding-right:150px;"><?=$task->ttitle?> </div>
	<div style="font-size:11px; color:#777777; margin-top:-30px; text-align:right; padding-right:30px; margin-left:5px; margin-bottom:0px;"><?=$task->wnickname?></div>
	<div style="font-size:12px; color:#999999; margin-top:0px; text-align:right; margin-left:5px; padding-right:30px; margin-bottom:5px;"><?=$task->atDate?></div>
	<div style="margin-top:5px; font-size:14px; color:#999999;"><?=nl2br($task->ttext)?></div>
	<?php if($task->timg != '-') { ?><img style="cursor:pointer;" onclick="window.open('<?=base_url().$task->timg?>');" src="<?=base_url().explode('.', $task->timg)[0].'_thumb.'.explode('.', $task->timg)[1]?>" /><?php } ?>
	<div style="margin-top:10px; margin-left:-10px;">
   <?php if($haveChilds == 0){ ?><div style="position:absolute; top:10px; right:0px;" onclick="delete_task('<?=base_url()?>', $(this).parent().parent(), '<?=$task->id?>');" class="tbutton">X</div><?php } ?>
		<?php if($task->owner == 0){ ?><div onclick="this_task_my('<?=base_url()?>', $(this), '<?=$task->id?>');" class="tbutton">this task my</div><?php }else{ ?><div class="tbutton" style="background-color:#ffffff; color:#444444; border:none;"> owher  : <?=$task->onickname?> </div>  <?php } ?>
		<?php if($task->owner != 0){ ?>
		<?php if(($task->status == 0)||($task->status == 1)){ ?><div onclick="i_compleate('<?=base_url()?>', $(this), '<?=$task->id?>');" class="tbutton">i compleate it</div><?php }else if($task->status == 2){ ?><div class="tbutton" style="background-color:#ffffff; color:#444444; border:none;">COMPLEATED</div><?php } ?>
		<?php } ?>	
		<div class="tbutton" onclick="get_coments('<?=base_url()?>', $(this), '<?=$task->id?>');">comments</div>
		<div class="tbutton" onclick="if($(this).hasClass('active')) { $('#addnewForm<?=$task->id?>').slideUp(500); $(this).removeClass('active'); }else{ $('#addnewForm<?=$task->id?>').slideDown(500); $(this).addClass('active'); } ">add task inside</div>
	</div>


<div id="addnewForm<?=$task->id?>" style="margin-top:0px; display:none;">

	<div style="margin-top:20px; margin-left:20px; width:500px; padding:20px; border:solid 1px #999999; margin-bottom:20px; ">
		<div style="font-size:18px; color:#995050;">
				Add new task inside
		</div>
		<form id="AddFrom" action="<?=base_url()?>tasks/main/add_task" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="parentid" value="<?=$task->id?>">
			<div class="formLabel">Title</div>
			<div><input type="text" class="Rinput"  name="ttitle"/></div>
			<input type="file" name="timg" />

			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" style="height:150px; width:400px;" name="ttext"></textarea></div>
			<input type="submit" class="iRbutton" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add task" />
			<input type="button" class="iRbutton" onclick="$('#addnewForm<?=$task->id?>').slideUp(500);" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Cancel" />		
		</form>
	</div>
</div>

<div id="comentsBlock<?=$task->id?>" style="display:none; margin-top:20px; margin-left:20px;">
	<div id="comentsBlockInside<?=$task->id?>" style="border-top:solid 1px #dddddd; padding:20px;">
		<div style="text-align:center;">
				<img src="<?=base_url()?>img/loading.gif"/>
		</div>
	</div>
	<div style="margin-top:20px; margin-left:20px; width:500px; padding:20px; border:solid 1px #999999; margin-bottom:20px;">
		<div style="font-size:18px; color:#995050;">
				Add new comment
		</div>
			<input type="hidden" name="uid" id="uid<?=$task->id?>_0" value="<?=$uid?>">
			<input type="hidden" name="parentid" id="pid<?=$task->id?>_0" value="0">
			<input type="hidden" name="parentid" id="tid<?=$task->id?>_0" value="<?=$task->id?>">
			<div class="formLabel">Title</div>
			<div><input type="text" class="Rinput" id="ctitle<?=$task->id?>_0" name="ctitle"/></div>

			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" style="height:150px; width:400px;" id="ctext<?=$task->id?>_0" name="ttext"></textarea></div>
			<input type="button" onclick="add_coment('<?=base_url()?>', '0', '<?=$task->id?>');" class="iRbutton" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add task" />
			<input type="button" class="iRbutton" onclick="$('#comentBlock<?=$task->id?>').slideUp(500);" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Cancel" />		
	</div>	
</div>


</div>