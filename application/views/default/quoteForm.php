<div class="video">
	<video class="upb_video-src" loop="loop" preload="auto" autoplay="autoplay">
	<source type="video/mp4" src="<?=base_url()?>img/BlueTrucksBG1.mp4"></video>
</div>
<div id="form" class="form-box">
	<div class="container">
		<div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1 col-xs-12">
			<div class="formheading">
				<span>get a </span>Free qoute<span> now!</span>
			</div>
			<img src="<?=base_url()?>img/form_heading_img.png" alt="form_heading_img"/>
				<div class="form-quote step1 steps">
					<div id="locationField" class="row">
						<form>
							<div class="col-sm-6 col-lg-6 col-xs-12">
								<span>Ship Vehicle FROM:</span>
								<input id="autocomplete-1" autocomplete="off" placeholder="Sity State Of Zip" onfocus="document.getElementById('result_list_1').style.display='inline' "onkeyup="live_search(this.value, 1, document.getElementById('autocomplete-2').value, event.keyCode);" type="text"/>
								<div id="result_list_1"></div>
							</div>
							<div class="col-sm-6 col-lg-6 col-xs-12">
								<span>Ship Vehicle TO:</span>
								<input id="autocomplete-2" autocomplete="off" placeholder="Sity State Of Zip"  onfocus="document.getElementById('result_list_2').style.display='inline'" onkeyup="live_search(this.value, 2, document.getElementById('autocomplete-1').value, event.keyCode);" type="text"/>
								<div id="result_list_2"></div>
							</div>
							<div id="step2" style="display:none">

								<div class="col-sm-6 col-lg-6 col-xs-12">
									<span>Shipping Move Date</span>
									<input type="date" id="move_date" placeholder="Shipping move date">		<!--Дата-->
								</div>
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<span>Model Year</span>
									<input type="number" id="model_year" value="2016" max="2016" min="1900" pattern="^[0-9]{4}">				<!--Год выпуска-->
								</div>
								<div class="col-lg-12 col-sm-12 col-xs-12"><select id="sel_class"></select></div>																		<!--Класс-->
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<span>Make</span>
									<select id="sel_make"></select>																				<!--Производитель-->
									<select id="cond">																							<!--Состояние-->
										<option disabled selected>Condition</option>
										<option>Non-running</option>
										<option>Running</option>
									</select>
								</div>
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<span>Model</span>
									<select id="sel_mod">																						<!--Модель-->
										<option>Select Model</option>
									</select>
									<select id="t_type">																						<!--Тип-->
										<option disabled selected>Transport Type</option>
										<option>Enclosed</option>
										<option>Open</option>
									</select>
								</div>
							</div>
							<div id="step3" style="display:none">
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<input type="text" id="name" placeholder="Name" pattern="^[a-zA-Z]{1,}">									<!--Имя-->
									<input type="email" id="email" placeholder="E-mail" pattern="^[a-zA-Z0-9]{1,}@[a-zA-Z]{1,}.[a-zA-Z]{1,}">	<!--Почта-->
								</div>
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<input type="tel" id="phone" placeholder="Phone number" pattern="^[\+\-0-9]{1,}">							<!--Мобильный-->
								</div>
								<div class="col-sm-6 col-lg-6 col-xs-12">
									<!--<button type="submit">Submit!</button>-->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="counter-anchor"></div>
	</div>	
</div>