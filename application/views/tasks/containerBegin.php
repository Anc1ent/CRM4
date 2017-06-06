<style>
.formLabel{
	margin-top:10px; 
	font-size:11px; 
	color:#444444;
}

.Rinput{
	border:solid 1px #cccccc;
	font-size:15px; 
	padding:5px;
	width:300px;
}

.Tbutton{
	display:inline-block; 
	margin-left:10px; 
	background-color:#885050; 
	padding:3px; 
	padding-left:10px; 
	padding-right:10px; 
	cursor:pointer; 
	font-size:9px;
	color:#ffffff;
	transition: 1s;
    transition-timing-function: ease;
}

.Tbutton:hover{
	background-color:#ff5050; 
	color:#ffffff;
	transition: 1s;
    transition-timing-function: ease;
}

.Tbutton.active{
	background-color:#ffffff;
	color:#885050 !important;

}

.iRbutton{
	background-color:#ffffff;
}
</style>
<script type="text/javascript">
	function this_task_my(base_url, button, id){
		$.ajax({
		      type: 'POST',
		      data: ({"id":id}),
		      url : base_url+'tasks/main/my_task/',
		      async: false,
		      success: function(response){ 
		        button.fadeOut(500);
		      }
    	});
	}

	function delete_task(base_url, task, id){
		$.ajax({
		      type: 'POST',
		      data: ({"id":id}),
		      url : base_url+'tasks/main/del_task/',
		      async: false,
		      success: function(response){ 
		        task.fadeOut(500);
		      }
    	});
	}

	function i_compleate(base_url, button, id){
		$.ajax({
		      type: 'POST',
		      data: ({"id":id}),
		      url : base_url+'tasks/main/i_compleate/',
		      async: false,
		      success: function(response){ 
		        button.fadeOut(500);
		      }
    	});	
	}

	function get_coments(base_url, button, tid){
		$.ajax({
		      type: 'POST',
		      data: ({"tid":tid}),
		      url : base_url+'tasks/main/get_coments_to_task/',
		      async: false,
		      success: function(response){ 
		        $('#comentsBlockInside'+tid).html(response);
		      }
    	});	
    	if(button.hasClass('active')){
			$('#comentsBlock'+tid).slideUp(500);
			button.removeClass('active');
		}else{
			$('#comentsBlock'+tid).slideDown(500);
			button.addClass('active');
		}
	}

	function add_coment(base_url, cid, tid){
		var uid = $('#uid'+tid+'_'+cid).val();		
		var pid = $('#pid'+tid+'_'+cid).val();		
		var ctext = $('#ctext'+tid+'_'+cid).val();		
		var ctitle = $('#ctitle'+tid+'_'+cid).val();		
		$.ajax({
		      type: 'POST',
		      data: ({"tid":tid, "uid":uid, "pid":pid, "ctitle":ctitle, "ctext":ctext}),
		      url : base_url+'tasks/main/add_coment/',
		      async: false,
		      success: function(response){ 
		        $('#comentsBlockInside'+tid).append(response);
		      }
    	});	
		$('#comentsBlock'+tid).slideDown(500);		

	}
</script>
<div style="padding:20px; background-color: black; width: 100%; height: 20px; margin-top: -10px; margin-left: -5px;">
<div style="font-size:25px; margin-top:-10px; margin-bottom:0px; color: rgb(255,102,102); padding-left: 15%; font-weight: 900; padding-top: 3px;">TASKS_MANAGER</div>
<div style="font-size:16px; margin-top:-27px; margin-bottom:0px; color: rgb(255,102,102); padding-left: 32%; font-weight: 900; <?php if($_SERVER['REQUEST_URI'] == '/tasks/'){ ?> text-decoration: underline; <?php } ?>">HOME</div>
<div style="font-size:16px; margin-top:-23px; margin-bottom:0px; color: rgb(255,102,102); padding-left: 37%; font-weight: 900; <?php if($_SERVER['REQUEST_URI'] == '/mytask/'){ ?> text-decoration: underline; <?php } ?>">MY TASK</div>
<div style="font-size:10px; margin-top:-23px; margin-bottom:0px; color: rgb(255,102,102); padding-left: 90%; font-weight: 900;">LOGGED US <b style="text-decoration: underline"><?=$user->nickname ?></b></div>
<div style="width:95%; float:left; padding: 20px;">