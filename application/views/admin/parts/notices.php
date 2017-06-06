<div>
	<?php if($qid > 0) { ?><div style="font-size:14px; margin-bottom:10px; font-weight:bold;">Notices to quote (<?=$qid?>)</div> <?php } ?>
	<?php if($qid == 0) { ?><div style="font-size:14px; margin-bottom:10px; font-weight:bold;">Global notice</div> <?php } ?>
	<?php if($qid < 0) { ?><div style="font-size:14px; margin-bottom:10px; font-weight:bold;">Notices to driver (<?=($qid*(-1))?>)</div> <?php } ?>
	<div id="quotenoticeBlock">
		<?php foreach($notices as $notice){ ?>
		<div style="border-bottom:solid 1px #cccccc; margin-top:7px; padding-bottom:10px;">
			<div style="font-size:12px;">
				<?=date('m/d/y h:i A', strtotime($notice->atDate))?>
			</div>
			<div style="font-size:11px;">
				<b><?=$notice->uname?></b>
			</div>
			<div style="font-size:13px; margin-top:5px;">
				<?=nl2br($notice->text)?>
			</div>
		</div>
		<?php } ?>
	</div>

	<div style="margin-top:10px; font-size:14px; margin-bottom:5px;">
		Add new notice
	</div>
	<div>
		<textarea id="newnoticeText" style="width:250px; font-size:13px; height:70px;"></textarea>
	</div>
	<div>
		<div onclick="add_new_notice('<?=base_url()?>', '<?=$qid?>');" style="padding:5px; display:inline-block; cursor:pointer; margin-left:0px; padding-left:10px; padding-right:10px;" class="iRedButton">Add notice</div>
	</div>
</div>