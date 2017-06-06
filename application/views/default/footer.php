<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="logo">
					<img src="<?=base_url()?>img/NewLogoSWAT.png" alt="logo"/>
				</div>
				<p>We ship to all 50 states and all over the world. All quotes include taxes, fuel costs and toll charges. We do not require an upfront deposit. All shipments are fully insured and door to door.<br/><br/>If you would like to speak to a transportation agent or have questions about our services, please <strong>contact us today!</strong></p>
				<div class="col col-sm-5 col-lg-5 col-xs-12">
					<p>1205 W. Milwaukee Ave Glenview, IL 60025</p>
				</div>
				<div class="col col-sm-5 col-sm-offset-2 col-lg-offset-2 col-lg-5 col-xs-12">
					<p>E-mail: info@swatmoves.com <span>847-257-6746</span></p>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12">
				<div class="formheading">
					<span>get a</span>Free qoute<span>now!</span>
				</div>
				<div class="form-quote step1 steps">
					<div id="locationField2">
						<img src="<?=base_url()?>img/form_heading_img.png" alt="form_heading_img"/>
						<span>Ship Vehicle FROM:</span>
						<input id="autocomplete-3" placeholder="City State or Zip" onFocus="geolocate()" type="text"/>
						<span>Ship Vehicle TO:</span>
						<input id="autocomplete-4" placeholder="City State or Zip" onFocus="geolocate()" type="text"/>
						<input class="button" name="submit" onclick="return false;" value="Submit" type="submit">
					</div>
				</div>
			</div>
		</div>
		<div class="copyrights">
			<p>Copyright © S.W.A.T.™ AUTO TRANSPORT - Website by <a href="#">Benjamin Cohen Creative</a></p>
			<p><a href="#">Terms and Condtions</a> - <a href="#">Privacy Policy</a></p>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/slider.js"></script>	
<script type="text/javascript" src="<?=base_url()?>js/live_search.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
	$("#move_date").datepicker();
</script>
<script type="text/javascript">
	$(function(){
		$h4 = $('.faq-text-box h4');
		$h4.on('click', function(event) {
			event.preventDefault();
			$h4.not(this).next().slideUp(200);
			$(this).next().slideToggle(200);
		});
	});
</script>
<script type="text/javascript">
	var wnd = $(window), block = $('.paralaxbox');
	wnd.scroll(function(){
		var top = wnd.scrollTop(), height = 100;
		if(height < top){
			position= top/10 - 100;
			block.css('background-position-x', position);
		}			
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#goto").on("click","a", function (event) {
			event.preventDefault();
			var id  = $(this).attr('href'), top = $(id).offset().top;
			$('body,html').animate({scrollTop: top}, 500);
		});
	});
</script>
</div>
<script type="text/javascript">
	$(".slider-container").ikSlider({
		touch		:	true,			// Touch события на мобильных платформах, и mouse(down|move|up) на десктопах
		controls	:	false,			// показывать навигацию внизу
		arrows		:	true,			// показывать вперед|назад навигацию
		infinite	:	true,			// не возвращаться к первой (не влияет на autoPlay, только при перелистывании в ручную)
		delay		:	10000,			// задержка перед перелистыванием 10 секунд
		caption		:	true,			// показывать описание
		speed		:	500,			// скорость анимации
		cssEase		:	'ease-out',		// функция плавности анимации с помощью CSS
		responsive	:	true,			// Подстраиваться по размеры экрана
		autoPlay	:	true,			// автоматическое перелистывание изображений
		pauseOnHover:	true,
		speed		:	500,
		cssEase		:	"ease-in-out"	//описание плавности css анимации
	});
</script>
<script type="text/javascript">
	var num1 = 24, num2 = 472329, num3 = 175851, num4 = 994, stop = 0, q1 = 0, q2 = 0, q3 = 0, q4 = 0
	var el = document.getElementById('num1');
	x = 0
	window.onscroll = function() {
		var sc = el.getBoundingClientRect().bottom;
		if (!stop && window.pageYOffset > sc){
			stop = 1
			int4();
			int3();
			int2();
			int1();
		}
	}
	function int4() {
		q4 = q4 + 14 * (1 - (q4 / 1050));
		document.getElementById('num4').innerHTML = (q4 | 2) / 10 + '%';
		setTimeout(function(){
			if (q4 >= num4) {
				document.getElementById('num4').innerHTML = num4/10 + '%';
			} else {
				int4();
			}
		}, 1);
	}
	function int3() {
		q3 = q3 + 2666 * (1 - (q3 / 180000));
		s1 = (q3 | 2) + '';
		setTimeout(function(){
			if (s1.length == 4) {
				s1 = s1.substring(0, 1) + "," + s1.substring(1);
			} else if (s1.length == 5){
				s1 = s1.substring(0, 2) + "," + s1.substring(2);
			} else if (s1.length == 6){
				s1 = s1.substring(0, 3) + "," + s1.substring(3);
			}
			document.getElementById('num3').innerHTML = s1;
			if (q3 >= num3) {
				s1 = num3 + '';
				s1 = s1.substring(0, 3) + "," + s1.substring(3);
				document.getElementById('num3').innerHTML = s1
			} else {
				int3();
			}
		}, 1);
	}
	function int2() {
		q2 = q2 + 6666 * (1 - (q2 / 480000));
		s2 = (q2 | 2) + '';
		setTimeout(function(){
			if (s2.length == 4) {
				s2 = s2.substring(0, 1) + "," + s2.substring(1);
			} else if (s2.length == 5){
				s2 = s2.substring(0, 2) + "," + s2.substring(2);
			} else if (s2.length == 6){
				s2 = s2.substring(0, 3) + "," + s2.substring(3);
			}
			document.getElementById('num2').innerHTML = s2;
			if (q2 >= num2) {
				s2 = num2 + '';
				s2 = s2.substring(0, 3) + "," + s2.substring(3);
				document.getElementById('num2').innerHTML = s2;
			} else {
				int2();
			}
		}, 1);
	}
	function int1() {
		var x = 1000 * (q1 / 200);
		++q1
		document.getElementById('num1').innerHTML = q1;
		setTimeout(function(){
		if (q1 >= num1) {
			document.getElementById('num1').innerHTML = num1;
		} else {
			int1();
		}
	}, x);
}
</script>
<script type="text/javascript">
	document.onclick = function(event){
		if ((event.target.id != "autocomplete-1") && (event.target.id != "result_list_1") && (event.target.id != "item_a1_1") && (event.target.id != "item_a1_2") && (event.target.id != "item_a1_3") && (event.target.id != "item_a1_4") && (event.target.id != "item_a1_5") && (event.target.id != "drop-list1")) {
			document.getElementById('result_list_1').style.display='none'
			var num = 1
			var au1 = document.getElementById('autocomplete-1').value
			var res = au1.split(/, /);
			$.post('/index.php/main/validate', { 'num':num , 'au1':au1 , 'res0':res[0] , 'res1':res[1] , 'res2':res[2]}, function(result) {
				if(result) {
					$('#sel_make').html(result);
				}
			});
			var spa = document.getElementsByClassName('item_selected')
			if (spa.length != 0) {
				var sli = spa[0].id;
				$("#" + sli).removeClass('item_selected');
			}
			step2();
		}
		if ((event.target.id != "autocomplete-2") && (event.target.id != "result_list_2") && (event.target.id != "item_a2_1") && (event.target.id != "item_a2_2") && (event.target.id != "item_a2_3") && (event.target.id != "item_a2_4") && (event.target.id != "item_a2_5") && (event.target.id != "drop-list2")) {
			document.getElementById('result_list_2').style.display='none'
			var au2 = document.getElementById('autocomplete-2').value
			var res = au2.split(/, /);
			var num = 2
			$.post('/index.php/main/validate', { 'num':num , 'au1':au2 , 'res0':res[0] , 'res1':res[1] , 'res2':res[2]}, function(result) {
				if(result) {
					$('#sel_make').html(result);
				}
			});
			var spa = document.getElementsByClassName('item_selected')
			if (spa.length != 0) {
				var sli = spa[0].id;
				$("#" + sli).removeClass('item_selected');
			}
			step2();
		}
	}
	function step2() {
		if ((document.getElementById('autocomplete-2').value || 0 != document.getElementById('autocomplete-2').value.length) && (document.getElementById('autocomplete-1').value || 0 != document.getElementById('autocomplete-1').value.length)) {
			document.getElementById('step2').style.display = 'inline';
			if ($('#sel_make option').length == 0) car_mark_all();
			if ($('#sel_class option').length == 0) car_class_all();
		} else {
			document.getElementById('step2').style.display = 'none';
		}
	}
	function car_mark_all(){
		$.post('/index.php/main/car_mark_db_search', function(result) {
			if(result) {
				$('#sel_make').html(result);
			}
		});
	}
	function car_model_all(str){
		$.post('/index.php/main/car_model_db_search', { 'str':str }, function(result) {
			if(result) {
				$('#sel_mod').html(result);
			}
		});
	}
	function car_class_all(){
		$.post('/index.php/main/car_class_db_search', function(result) {
			if(result) {
				$('#sel_class').html(result);
			}
		});
	}
</script>
</body>
</html>