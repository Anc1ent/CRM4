<div id="dashBoard">
<style>
body{
	background:#ffffff;
}
</style>
<script src="<?=base_url()?>js/echarts.js"></script>
<div style="font-size:14px; margin-top:-25px; margin:-20px;">
		<div style="padding:20px;">
				<div style="font-size:17px; margin-left:10px; font-weight:bold; color:#282E38;">DASHBOARD</div>
		</div>
		<div>
				<div style="float:left; border-bottom:solid 3px #ffffff; margin-left:30px;">
						<div style="font-size:13px; font-weight:bold; text-transform:uppercase; padding-bottom:5px; padding-left:7px; padding-right:7px; color:#A6AFB9;">Today</div>
						
				</div>
				<div style="float:left; border-bottom:solid 3px #ffffff; margin-left:20px;">
						<div style="font-size:13px; font-weight:bold; text-transform:uppercase; padding-bottom:5px; padding-left:7px; padding-right:7px; color:#A6AFB9; cursor:pointer;">Yesterday</div>
				</div>

				<div style="float:left; border-bottom:solid 3px #ffffff; margin-left:20px;">
						<div style="font-size:13px; font-weight:bold; text-transform:uppercase; padding-bottom:5px; padding-left:7px; padding-right:7px; color:#A6AFB9; cursor:pointer;">last 7 days</div>
				</div>

				<div style="float:left; border-bottom:solid 3px #ffffff; margin-left:20px;">
						<div style="font-size:13px; font-weight:bold; text-transform:uppercase; padding-bottom:5px; padding-left:7px; padding-right:7px; color:#A6AFB9; cursor:pointer;">last 30 days</div>
				</div>

				<div style="float:left; border-bottom:solid 3px #35A3D3; margin-left:20px;">
						<div style="font-size:13px; font-weight:bold; text-transform:uppercase; padding-bottom:5px; padding-left:7px; padding-right:7px;  cursor:pointer;">all time</div>
				</div>	
						
				<div style="clear:both;"></div>
		</div>
		<div style="border-top:solid 1px #DBDFE4; background-color:#E8EBF0">

			<!-- Statistics -->

      <div style="width:100%; margin-right:0px; margin-left:0px;  margin-top:20px; background-color:#7A8CA2;">
        <div class="statItemBlock" style="border-left:none; margin-top:0px; padding-left:20px;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.workedL.circle').circleProgress({
                  value: <?php if($countQuotes != 0) { echo round($quoted/$countQuotes,2); } else{ echo "0"; } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="workedL circle">
              <strong><span id="quotedV"><?php if($countQuotes != 0) { echo round($quoted/$countQuotes*100); }else{ echo "0"; } ?></span> <span style="font-size:10px;  margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Worked Leads</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="quotedC"><?=$quoted?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        <!-- SEPARATE -->
         <div class="statItemBlock" style="margin-top:0px;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.convertedO.circle').circleProgress({
                  value: <?php if($countQuotes != 0) { echo round($ordered/$countQuotes,2); }else{ echo "0"; } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="convertedO circle">
              <strong><span id="orderedV"><?php if($countQuotes != 0) { echo round($ordered/$countQuotes*100); }else{ echo "0"; } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Converted Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="orderedC"><?=($ordered)?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        <!-- SEPARATE -->
         <div class="statItemBlock" style="margin-top:0px;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.dispachedO.circle').circleProgress({
                  value: <?php if($ordered == 0){ echo 0; }else{ echo round($dispached/$ordered,2); } ?>,
                  fill: {color: ['#ffffff']}
                });
              });
              
            </script>
            <div class="dispachedO circle">
              <strong><span id="dispachedV"><?php if($ordered == 0){ echo 0; }else{ echo round($dispached/$ordered*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Dispached Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="dispachedC"><?=($dispached)?></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        <!-- SEPARATE -->
         <div class="statItemBlock" style="margin-top:0px;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.cenceledO.circle').circleProgress({
                  value: <?php if($ordered == 0){ echo 0; }else{ echo round($cenceled/$ordered,2); } ?>,
                  fill: {color: ['#ffffff']}
                });

              });


              
            </script>
            <div class="cenceledO circle">
              <strong><span id="cenceledV"><?php if($ordered == 0){ echo 0; }else{ echo round($cenceled/$ordered*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Cenceled Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;" id="cenceledC"><?=($cenceled)?> </div>
          </div>  
          <div style="clear:both;"></div>
        </div>

        <!-- SEPARATE -->
        <?php if(!isset($chargered)) $chargered = 0; ?>
         <div class="statItemBlock" style="margin-top:0px;">
          <div style="float:left;">
            <script>
              $(document).ready(function(){
                $('.chargeredS.circle').circleProgress({
                  value: <?php if($chargered == 0){ echo 0; }else{ echo round($chargered/$globalsum,2); } ?>,
                  fill: {color: ['#ffffff']}
                });

              });


              
            </script>
            <div class="chargeredS circle">
              <strong><span id="chargeredSV"><?php if($chargered == 0){ echo 0; }else{ echo round($chargered/$globalsum*100); } ?></span> <span style="font-size:10px; margin-left:-5px; font-weight:normal;">%</span></strong>
            </div>
          </div>
          <div style="float:left; margin-top:14px; margin-right:20px; margin-left:0px;">
            <div style="font-size:11px; color:#ffffff;">Chargered Orders</div>
            <div style="font-size:18px; color:#ffffff; margin-top:-2px;"><span style="font-size:18px; color:#ffffff; padding-right:2px;">$</span><span style="font-size:18px; color:#ffffff;" id="chargeredSC"><?=($chargered)?></span></div>
          </div>  
          <div style="clear:both;"></div>
        </div>
        
        
        <div style="clear:both;"></div>
      </div>
      <!-- / Statistics -->

				<div style="float:left; width:20%; margin-left:2%; margin-right:2%;">
						<div style="width:100%;  margin-top:20px; background-color:#ffffff;">
								<div style="font-size:13px; text-transform:uppercase; padding:15px;  background-color:#7A8CA2; font-weight:bold; color:#ffffff;">
										sales board
								</div>
								<div style="text-align:center; color:#6FC232; font-weight:bold; font-size:18px; padding-top:15px; padding-bottom:15px;">
										$3295.00		
								</div>
								<div style="height:1px; background-color:#F1F5F8; width:100%;"></div>
								<div style="text-align:center; color:#9DA0A2; font-weight:bold; font-size:13px; padding-top:15px; padding-bottom:15px;">
										18 orders		
								</div>
								<div style="height:1px; background-color:#F1F5F8; width:100%;"></div>
								<div style="text-align:center; color:#9DA0A2; font-weight:bold; font-size:13px; padding-top:15px; padding-bottom:15px;">
										9 products sold		
								</div>
								<div style="height:1px; background-color:#F1F5F8; width:100%;"></div>
								<div style="text-align:center; color:#9DA0A2; font-weight:bold; font-size:13px; padding-top:15px; padding-bottom:15px;">
										<span style="color:#6FC232;">$51.48</span> average		
								</div>
								<div style="height:1px; background-color:#F1F5F8; width:100%;"></div>
						</div>
				</div>
				<div style="width:70%; float:left; margin-right:2%;">
						<div style="width:100%;  margin-top:20px; background-color:#ffffff;">
								<div style="font-size:13px; text-transform:uppercase; padding:15px;  background-color:#7A8CA2; font-weight:bold; color:#ffffff;">
										total sales
								</div>
								
								<script type="text/javascript">
									$(document).ready(function()
									{


							     
							        require.config({
							            paths: {
							                echarts: 'http://echarts.baidu.com/build/dist'
							            }
							        });
							     
							        require(
							            [
							                'echarts',
							                'echarts/chart/line' 
							            ],
							            function (ec) {
							                
							                var myChart = ec.init(document.getElementById('chartLines')); 
							                
							                var option = {
												    tooltip : {
												        trigger: 'axis'
												    },
												    legend: {
												        data:['Michael','Raichel','Zemood','Sher']
												    },
												    toolbox: {
												        show : false,
												    
												    },
												    calculable : true,
												    xAxis : [
												        {
												            type : 'category',
												            boundaryGap : false,
												            data : ['August','September','October','November','December','January','February', 'March', 'April', 'May']
												        }
												    ],
												    yAxis : [
												        {
												            type : 'value'
												        }
												    ],
												    series : [
												        {
												            name:'Michael',
												            type:'line',
												            stack: 'Michael',
												            itemStyle: {normal: {areaStyle: {type: 'default'}}},
												            data:[120, 132, 101, 134, 90, 230, 210, 120, 0, 0]
												        },
												        {
												            name:'Raichel',
												            type:'line',
												            stack: 'Raichel',
												            itemStyle: {normal: {areaStyle: {type: 'default'}}},
												            data:[220, 182, 191, 234, 290, 330, 310, 220, 0, 0]
												        },
												        {
												            name:'Zemood',
												            type:'line',
												            stack: 'zemood',
												            itemStyle: {normal: {areaStyle: {type: 'default'}}},
												            data:[150, 232, 201, 154, 190, 330, 410, 290, 0, 0]
												        },
												        {
												            name:'Sher',
												            type:'line',
												            stack: 'Sher',
												            itemStyle: {normal: {areaStyle: {type: 'default'}}},
												            data:[320, 332, 301, 334, 390, 330, 320 , 190, 0 ,0]
												        }
												        
												    ]
												};
							       
							                myChart.setOption(option); 
							            }
							        );
							        });
							    </script>
								<div id="chartLines" style="height:300px; width:100%;">
								</div>
						</div>		
				</div>
				<div style="clear:both;"></div>
				<div style="float:left; width:45%; margin-right:2%; margin-left:2%; ">
						<div style="width:100%;  margin-top:20px; background-color:#ffffff;">
								<div style="font-size:13px; text-transform:uppercase; padding:15px;  background-color:#7A8CA2; font-weight:bold; color:#ffffff;">
										Activity
								</div>
								<script type="text/javascript">
									$(document).ready(function()
									{


							     
							        require.config({
							            paths: {
							                echarts: 'http://echarts.baidu.com/build/dist'
							            }
							        });
							     
							        require(
							            [
							                'echarts',
							                'echarts/chart/pie' 
							            ],
							            function (ec) {
							                
							                var myChart = ec.init(document.getElementById('chartPie')); 
							                
							                var option = {

											
												    tooltip : {
												        trigger: 'item',
												        formatter: "{a} <br/>{b} : {c} ({d}%)"
												    },
												    legend: {
												        orient : 'vertical',
											        	x : 'left',
												        data:['Michael','Raichel','Zemood','Sher']
												    },
												    toolbox: {
												        show : false,
												       
												    },
												    calculable : true,
												    series : [
												        {
												            name:'Activity',
												            type:'pie',
												            radius : [20, 110],
												            center : ['50%', 200],
												            roseType : 'area',
												            width: '100%',  
												            sort : 'ascending',      // for funnel
												            max: 40,            // for funnel
												            itemStyle : {
												                normal : {
												                    label : {
												                        show : true
												                    },
												                    labelLine : {
												                        show : true
												                    }
												                },
												                emphasis : {
												                    label : {
												                        show : true
												                    },
												                    labelLine : {
												                        show : true
												                    }
												                }
												            },
												            data:[
												                {value:10, name:'Michael'},
												                {value:5, name:'Raichel'},
												                {value:15, name:'Zemood'},
												                {value:25, name:'Sher'}
												            ]
												        }
												    ]
												};
							       
							                myChart.setOption(option); 
							            }
							        );
							        });
							    </script>
								<div id="chartPie" style="height:350px; width:100%;"></div>
								
						</div>

				</div>

				<div style="float:left; width:45%;  ">
						<div style="width:100%;  margin-top:20px; background-color:#ffffff;">
								<div style="font-size:13px; text-transform:uppercase; padding:15px;  background-color:#7A8CA2; font-weight:bold; color:#ffffff;">
										Work hours
								</div>
								<script type="text/javascript">
									$(document).ready(function()
									{


							     
							        require.config({
							            paths: {
							                echarts: 'http://echarts.baidu.com/build/dist'
							            }
							        });
							     
							        require(
							            [
							                'echarts',
							                'echarts/chart/pie' 
							            ],
							            function (ec) {
							                
							                var myChart = ec.init(document.getElementById('chartPie2')); 
							                
							                var option = {
											    tooltip : {
											        trigger: 'item',
											        formatter: "{a} <br/>{b} : {c} ({d}%)"
											    },
											    legend: {
											        orient : 'vertical',
											        x : 'left',
											        data:['Michael','Raichel','Zemood','Sher']
											    },
											    toolbox: {
											        show : false,
											        feature : {
											            mark : {show: true},
											            dataView : {show: true, readOnly: false},
											            magicType : {
											                show: true, 
											                type: ['pie', 'funnel'],
											                option: {
											                    funnel: {
											                        x: '25%',
											                        width: '50%',
											                        funnelAlign: 'left',
											                        max: 1548
											                    }
											                }
											            },
											            restore : {show: true},
											            saveAsImage : {show: true}
											        }
											    },
											    calculable : true,
											    series : [
											        {
											            name:'Work Time',
											            type:'pie',
											            radius : '55%',
											            center: ['50%', '60%'],
											            data:[
											                {value:335, name:'Michael'},
											                {value:310, name:'Raichel'},
											                {value:234, name:'Zemood'},
											                {value:135, name:'Sher'}
											            ]
											        }
											    ]
											};
							       
							                myChart.setOption(option); 
							            }
							        );
							        });
							    </script>
								<div id="chartPie2" style="height:350px; width:100%;"></div>
								
						</div>

				</div>
				<div style="clear:both;"></div>
				<div style="height:20px;"></div>
		</div>
</div>
