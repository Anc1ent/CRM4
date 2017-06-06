<style>
.formLabel{
	margin-top:10px; 
	font-size:11px; 
	color:#444444;
}

.Rinput{
	border:solid 1px #995050;
}

.Tbutton{
	display:inline-block; 
	margin-left:10px; 
	background-color:#995050; 
	padding:5px; 
	padding-left:10px; 
	padding-right:10px; 
	cursor:pointer; 
	font-size:12px;
	color:#ffffff;
}
</style>
<script type="text/javascript">
	function delete_task(base_url, task){
		$.ajax({
		      type: 'POST',
		      data: ({"id":url}),
		      url : base_url+'tasks/main/del_task/',
		      async: false,
		      success: function(response){ 
		        task.fadeOut(500);
		      }
    	});
	}
</script>
<div style="padding:20px;">
<div style="font-size:25px; margin-top:-10px; color:#ff5050">
TASKS MANAGER
</div>
<?php 
foreach($tasks as $task){ ?>
<div style="padding:20px; margin-top:20px; border:solid 1px #dddddd;">
	<div style="font-size:18px; color:#777777;"><?=$task->ttitle?> </div>
	<div style="margin-top:5px; font-size:14px; color:#999999;"><?=$task->ttext?></div>
	<div style="margin-top:10px; margin-left:-10px;">
		<div onlick="delete_task('<?=base_url()?>', $(this).parent().parent());" class="tbutton">delete task</div>
		<div class="tbutton">this task my</div>
		<div class="tbutton">i compleate it</div>
		<div class="tbutton">coments</div>
		<div class="tbutton">add task inside</div>
	</div>
</div>

<div style="margin-top:0px; background-color:#dddddd;">

	<div style="margin-top:20px; margin-left:20px; width:500px; padding:20px; border:solid 1px #995050;">
		<div style="font-size:18px; color:#995050;">
				Add new task inside
		</div>
		<form id="AddFrom" action="<?=base_url()?>tasks/main/add_task" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="parentid" value="<?=$task->id?>">
			<div class="formLabel">Title<div>
			<div><input type="text" class="Rinput"  name="ttitle"/></div>
			<input type="file" name="timg" />

			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" name="ttext"></textarea></div>
			<input type="submit" class="iRbutton" onclick="$(this).parent().submit();" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add task" />	
		</form>
	</div>

</div>
<?php } ?>

<div style="margin-top:20px; width:500px; padding:20px; border:solid 1px #995050;">
		<div style="font-size:18px; color:#995050;">
				Add new task
		</div>
		<form id="AddFrom" action="<?=base_url()?>tasks/main/add_task" method="POST"  enctype="multipart/form-data">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="parentid" value="0">
			<div class="formLabel">Title<div>
			<div><input type="text" class="Rinput"  name="ttitle"/></div>
			<input type="file" name="timg" />

			<div class="formLabel">Text</div>
			<div><textarea class="Rinput" name="ttext"></textarea></div>
			<input type="submit" class="iRbutton" onclick="$(this).parent().submit();" style="padding:10px; cursor:pointer; display:inline-block; margin-top:20px; font-size:15px; padding-left:20px; padding-right:20px; width:auto!important;" value="Add task" />	
		</form>
</div>
</div>