function live_search(str, num, str2, event){
	if(event == 38 || event == 40) {
		document.getElementById('result_list_' + num).style.display='inline'
		var spa = document.getElementsByClassName('item_selected')
		var li = document.getElementById('drop-list' + num).childNodes.length
		if (spa.length == 0) {
			event == 38 ? document.getElementById("item_a" + num + "_" + li).className = 'item_selected' : document.getElementById("item_a" + num + "_1").className = 'item_selected';
		} else {
			var sli = spa[0].id;
			$("#" + sli).removeClass('item_selected');
			event == 40 ? $("#" + sli).next().addClass('item_selected') : $("#" + sli).prev().addClass('item_selected');
		}
	} else if (event == 13){
		var spa = document.getElementsByClassName('item_selected')
		if (spa.length != 0) {
			document.getElementById('autocomplete-' + num).value = spa[0].innerHTML;
			document.getElementById('result_list_' + num).style.display='none'
			step2();
		}
	} else if (event == 8 || event == 46 || (event >= 48 && event <= 57) || (event >= 65 && event <= 90) || (event >= 96 && event <= 105)){
		$.post('/index.php/main/live_search', { 'str':str , 'i':num , 'str2':str2}, function(result) {
			if(result) {
				$('#result_list_' + num).html(result);
			}
		});
	}
}