<div style="padding:20px;">
<div style="font-size:16px;">History</div>
<div style="margin-top:10px;">
<table id="waitingtable" class="insideTableWhiteGrey" border="0" style="width:100%;" cellpadding="0" cellspacing="0">
		<tr class="head">
			<!--td style="text-align:center; width:70px;">ID</td-->
			<td>PARAMETR</td>
			<td>FROM VALUE</td>
			<td >TO VALUE</td>
			<td >Date</td>
			<td >USER</td>
			<td >IP</td>
		</tr>
		<?php foreach($stat as $item){ ?>
		<tr class="contentRow">
			<!--td style="text-align:center; width:70px;"><?=str_pad ($item->id, 5,"0",STR_PAD_LEFT)?></td-->
			<td style="font-size:13px;"><?=$item->name?></td>
			<td style=" font-size:13px;"><?=$item->fromVal?></td>
			<td style="font-size:14px;"><?=$item->toVal?></td>	
			<td style="font-size:12px;"><?=explode(' ',$item->atDate)[0]?><div style="font-size:16px;"><?=explode(' ',$item->atDate)[1]?></div></td>	
			<td style="font-size:11px;"><?=$item->email?></td>	
			<td style="font-size:10px;"><?=$item->ip?></td>	
		</tr>
		<?php } ?>
	</table>
</div>
</div>