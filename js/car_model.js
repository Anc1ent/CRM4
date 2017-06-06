function car_model(){
	$.post('/index.php/main/car_db_model', function(result) {
		if(result) {
			$('#sel_make').html(result);
		}
	});
}