var ipage = 0;
// Часы в шапке
var iclock = setInterval(function(){
  var seconds = parseInt($('#sseconds').html());
  var minutes = parseInt($('#sminutes').html());
  var hours = parseInt($('#shours').html());

  seconds++;

  if(seconds >= 60){
    seconds = 0;
    minutes++;
  }

  if(minutes >= 60){
    minutes = 0;
    hours++;
  }

  if(hours >= 24){
    hours = 0;
  }

  if(seconds < 10) seconds = "0"+seconds;
  if(minutes < 10) minutes = "0"+minutes;
  if(hours < 10) hours = "0"+hours;

  $('#sseconds').html(seconds);
  $('#sminutes').html(minutes);
  $('#shours').html(hours);

}, 1000);
      
// Редактрование данных писем     
function changeEmailValue(name, value, id){
  $.ajax({
    type: 'POST',
    data: ({'name':name, 'value':value, 'id':id}),
    url : 'main/chemailvalue/',
    async: true,
    success: function(response){ 
        console.log(response);
    }
    
   });
}
// Добавление второго уровня меню
function add_folder(base_url, spart, sname, button){
  $('#pageLoading').fadeIn(500);
  $.ajax({
    type: 'POST',
    data: ({'sname':sname, 'spart':spart}),
    url : base_url+'admin/main/add_second_menu/',
    async: true,
    success: function(response){ 
        button.before(response);
        $('#pageLoading').fadeOut(500);
    }
    
 });
}    
// Удаление второго уровня меню
function delete_folder(base_url, did){
  $.ajax({
    type: 'POST',
    data: ({'did':did}),
    url : base_url+'admin/main/del_second_menu/',
    async: true,
    success: function(response){ 
        
    }
    
  });
}

// Переменные текущего выбраного меню
var selectedUpMenu2 = 1;
var selectedUpMenu = 'Leads';

// Показать меню второго уровня
function showSecondupMenu(ClickedButton, Part){
  selectedUpMenu = Part;
  if(ClickedButton.hasClass('active')){ 
    ClickedButton.removeClass('active'); 
    $('#'+Part+'Menu').fadeOut(500); 
  }else{ 
    $('.upmenuButton').removeClass('active'); 
    ClickedButton.addClass('active'); 
    $('.secondMenu').css('display', 'none'); 
    $('#'+Part+'Menu').fadeIn(500); 
  }

}


// Перегрузка таблицы с квотами
function showPartQuotes(base_url, PartId, button, dontrefresh){
  $('#dashBoard').css('display', "none");  
  $('#QuotefullInfo').html('<div class="loadingInTable"><img src="'+base_url+'img/loading.gif"/></div>');
  $('.SlideDownTableItems').css('display','none');
  selectedUpMenu2 = PartId;
  $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    data: ({'partid':PartId}),
    url : base_url+'admin/main/get_quots_part/',
    async: true,
    success: function(response){ 
        $('#content').replaceWith(response);
        
        if((dontrefresh != 2)&&(dontActivateFirst == 0)){
          $('#content').find('.itemQT').eq(0).click();
          if($('#content').find('.itemQT').length == 0){
             $('#QuotefullInfo').html('<div style="font-size:25px; text-align:center; padding-top:75px; padding-bottom:75px; color:#ffffff; font-weight:bold;">THIS FOLDER IS EMPTY <span style="color:rgb(0,255,128); padding-left:10px;">:(</span></div>'); 
          }
        }else{
          dontActivateFirst = 0;
        }

        if(dontrefresh != 1) $('#pageLoading').fadeOut(500); 
        if(button != false){
          $('.SlevelMenuItem').removeClass('active3');
          button.addClass('active3');
        }
        $('#doGroupThigs').fadeOut(500);
        //$('.iRow').click(function(){
          // add_to_group();
        //});
         
    }
    
  }); 
}

function selectFirstLevelMenu(type, button){
  $("body").css("background", "#E8EBF0");
  $('.Smenu').fadeOut('500');
  $('.Smenu'+type).fadeIn('500');
  if(dontSelectFirst == 0){
    $('.Smenu'+type).find('.SlevelMenuItem').eq(0).click();
  }else{
    dontSelectFirst = 0;
  }
  $('.FlevelMenuItem').removeClass('active3');
  button.addClass('active3');
}


// Показать результаты поиска
function dosearch(base_url, name, value){
   selectedUpMenu2 = 0;
  $('#pageLoading').fadeIn(500); 
 // alert(value);
   $.ajax({
    type: 'POST',
    data: ({'name':name, 'value':value}),
    url : base_url+'admin/main/get_quots_search/',
    async: true,
    success: function(response){ 
        $('#content').replaceWith(response);
        selectedUpMenu2 = 0;
         selectedUpMenu = 'All';
        get_upmenu(base_url);
        $('#darker').click();
        //$('#doGroupThigs').fadeOut(500);
        //$('.iRow').click(function(){
          // add_to_group();
        //});
         
    }
    
  }); 
}

function show_quote_notice(base_url, qid, bthis){  
   $('#darker').fadeIn(300);
   if(bthis != 0){
       $('#quotenotice').css({ top:  bthis.offset().top + "px" });
       $('#quotenotice').css({ left:  bthis.offset().left + "px" });
       $('#quotenotice').fadeIn(500);
   }
   

    $.ajax({
    type: 'POST',
    data: ({'qid':qid}),
    url : base_url+'admin/main/get_quote_notices/',
    async: true,
    success: function(response){ 
        $('#quotenotice').html(response);
       //showPartQuotes(base_url, selectedUpMenu2, false, 0);
    }
    
   });
} 

function add_new_notice(base_url, qid){
   $.ajax({
    type: 'POST',
    data: ({'qid':qid, 'Ntext':$('#newnoticeText').val()}),
    url : base_url+'admin/main/add_notice/',
    async: true,
    success: function(response){ 
        $('#quotenoticeBlock').prepend(response);
        //showPartQuotes(base_url, selectedUpMenu2, false, 0);
    }
    
   });
}


var dontSelectFirst = 0;
$( function() {
          $( document ).tooltip();
        } ); 

var dontActivateFirst = 0;
// Перемещение квоты в другой раздел
function moveQuoteTo(base_url, qid , spart, button){
  var GlobalCount1 = $('#SPitem'+selectedUpMenu2).parent().parent().prev().find('.countInsideFlevelMenu');
  GlobalCount1.text(parseInt(GlobalCount1.text())-1);
   var GlobalCount2 = $('#SPitem'+spart).parent().parent().prev().find('.countInsideFlevelMenu');
  GlobalCount2.text(parseInt(GlobalCount2.text())+1);

  $('#countInside'+selectedUpMenu2).text(parseInt($('#countInside'+selectedUpMenu2).text())-1);
  $('#countInside'+spart).text(parseInt($('#countInside'+spart).text())+1);

  dontSelectFirst = 1;
  dontActivateFirst = 1;
  $('#SPitem'+spart).parent().parent().prev().click();
  $('#SPitem'+spart).click();

  selectedUpMenu2 = spart;
  $.ajax({
    type: 'POST',
    data: ({'qid':qid, 'spart':spart}),
    url : base_url+'admin/main/set_quote_part/',
    async: true,
    success: function(response){ 
        //button.parent().parent().parent().parent().fadeOut(500);
        //$('.spartInfo').css('color', 'rgba(0,0,0, 0.17)').css('z-index', '0');
        $('#darker').fadeOut(500);
        showPartQuotes(base_url, selectedUpMenu2, false, 2);
        activateQuote(base_url, qid, 0);
        //get_upmenu(base_url);
    }
    
  });

}

// Переходим в папку
function silent_ch_folder(spart){
  dontSelectFirst = 1;
  dontActivateFirst = 1;
  $('#SPitem'+spart).parent().parent().prev().click();
  $('#SPitem'+spart).click();
  selectedUpMenu2 = spart;
}

// Групповое перемещение квоты в другой раздел
function mass_moveQuoteTo(base_url,  spart, button){
   var qid = "";
      //alert($('.SelectedItem:checked').length);
      $('.SelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      }); 
   var countItems = parseInt($('.SelectedItem:checked').length);   

  var GlobalCount1 = $('#SPitem'+selectedUpMenu2).parent().parent().prev().find('.countInsideFlevelMenu');
  GlobalCount1.text(parseInt(GlobalCount1.text())-countItems);
   var GlobalCount2 = $('#SPitem'+spart).parent().parent().prev().find('.countInsideFlevelMenu');
  GlobalCount2.text(parseInt(GlobalCount2.text())+countItems);

  $('#countInside'+selectedUpMenu2).text(parseInt($('#countInside'+selectedUpMenu2).text())-countItems);
  $('#countInside'+spart).text(parseInt($('#countInside'+spart).text())+countItems);

   dontSelectFirst = 1;
  $('#SPitem'+spart).parent().parent().prev().click();
  $('#SPitem'+spart).click();

  selectedUpMenu2 = spart;
  $.ajax({
    type: 'POST',
    data: ({'qid':qid, 'spart':spart}),
    url : base_url+'admin/main/set_quote_part/',
    async: true,
    success: function(response){ 
        //button.parent().parent().parent().parent().fadeOut(500);
        //$('.spartInfo').css('color', 'rgba(0,0,0, 0.17)').css('z-index', '0');
        $('#darker').click();
        showPartQuotes(base_url, selectedUpMenu2, false, 1);
        activateQuote(base_url, qid, 0);
        //get_upmenu(base_url);
    }
    
  });

}

// Подгрузка верхнего меню 
function get_upmenu(base_url){
  /*$('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    data: ({'smenu':selectedUpMenu, 'smenu2':selectedUpMenu2}),
    url : base_url+'admin/main/get_upmenu/',
    async: true,
    success: function(response){ 
        $('#upMenuBlock').replaceWith(response);
        $('#pageLoading').fadeOut(500); 
        //$('.secondMenu .upmenuButton').removeClass('active');
       // button.addClass('active');
    }
    
  });
  */
}
// Изменение сортировки
function chTableSort(base_url, val1, val2){
   $('#pageLoading').fadeIn(300); 
   $.ajax({
    type: 'POST',
   // data: ({'partid':selectedUpMenu2}),
    url : base_url+'admin/main/set_sort/'+val1+'/'+val2,
    async: true,
    success: function(response){ 
       
       showPartQuotes(base_url, selectedUpMenu2, false, 0);
    }
    
  });
}
// Изменение количества показываемых квот на странице
function chTableLimit(base_url , val1){
   $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    url : base_url+'admin/main/set_limit/'+val1,
    async: true,
    success: function(response){ 
       showPartQuotes(base_url, selectedUpMenu2, false, 0);
    }
    
  });
}
// Разкрыть детали по рассылке по квоте
function show_send_stat(base_url, button, qid){
  if(button != 0){
    if(button.hasClass('iopen2')){ 
      button.removeClass('iopen2');   
      $('#SendBlockG').slideUp(500, function(){ 
        $('#SendG').css('display', 'none'); 
      }); 
      button.parent().removeClass('active');
    }else{ 
      button.addClass('iopen2'); 
      $('#SendG').css('display', 'block'); 
      $('#SendBlockG').slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/emails/get_quote_sended/',
        async: true,
        success: function(response){ 
           $('#SendBlockG').html(response);
        }
      });
      //button.parent().addClass('active');
    }
  }else{
    //alert(qid);
    $('#SendBlockG').html('<div class="loadingInTable"><img src="'+base_url+'img/loading.gif"/></div>');
     $('#SendG').css('display', 'block'); 
      $('#SendBlockG').slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/emails/get_quote_sended/',
        async: true,
        success: function(response){ 
           $('#SendBlockG').html(response);
        }
      });
  }
 
  
  //add_to_group();
}

// Mass launch
function show_mass_launch_block(base_url, button){
      //alert(($(window).scrollTop()+70));
      $('#massLaunch').css('top', ($(window).scrollTop()+70) + "px");
      var qid = "";
      //alert($('.SelectedItem:checked').length);
      $('.SelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      });

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/emails/mass_launch_block/',
        async: true,
        success: function(response){
          $('#massLaunch').html(response);
         
          //$('#massLaunch').css('top','px');
          $('#massLaunch').fadeIn(500); 
           
        }
      }); 
}

// Mass launch
function show_drivers_mass_launch_block(base_url, button){
      //alert(($(window).scrollTop()+70));
      $('#massLaunch').css('top', ($(window).scrollTop()+70) + "px");
      var qid = "";
      //alert($('.SelectedItem:checked').length);
      $('.DSelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      });

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/emails/drivers_launch_block/',
        async: true,
        success: function(response){
          $('#massLaunch').html(response);
         
          //$('#massLaunch').css('top','px');
          $('#massLaunch').fadeIn(500); 
           
        }
      }); 
}


// Empty launch
function show_empty_launch_block(base_url, button){
      //alert(($(window).scrollTop()+70));
      $('#emptyLaunch').css('top', ($(window).scrollTop()+70) + "px");
     

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":0}),
        url : base_url+'admin/emails/empty_launch_block/',
        async: true,
        success: function(response){
          $('#emptyLaunch').html(response);
         
          //$('#massLaunch').css('top','px');
          $('#emptyLaunch').fadeIn(500); 
           
        }
      }); 
}

// SMS launch
function show_sms_launch_block(base_url, button, qid){
      //alert(($(window).scrollTop()+70));
      $('#emptyLaunch').css('top', ($(window).scrollTop()+70) + "px");
     

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/sms_launch_block/',
        async: true,
        success: function(response){
          $('#emptyLaunch').html(response);
         
          //$('#massLaunch').css('top','px');
          $('#emptyLaunch').fadeIn(500); 
           
        }
      }); 
}

// SEND SMS
function send_sms(base_url, qid, phone, smstext){
     $.ajax({
        type: 'POST',
        data: ({"qid":qid, "number":phone, "smstext":smstext}),
        url : base_url+'admin/main/sendSMS/',
        async: true,
        success: function(response){
          $('#darker').click();
        }
      }); 
} 

// пересчитываем числа цен
function recountTBprices(type){
    if(type == 0){
        var TotalPrice = parseFloat($('#FtotalPrice').text());
        var deposit = parseFloat($('#Fdeposit').text());
        $('#priceValF').html(TotalPrice - deposit);
        $('#pricePMValG').html(parseFloat((TotalPrice - deposit)/parseFloat($('#Fdistance').text())).toFixed(2));
    }else if(type == 1){

        var deposit = parseFloat($('#Fdeposit').text());
        //$('#FtotalPrice').html(parseFloat($('#priceValF').text())+deposit);
        var TotalPrice = parseFloat($('#FtotalPrice').text());
        $('#priceValF').html(TotalPrice - deposit);
        $('#pricePMValG').html(parseFloat((TotalPrice - deposit)/parseFloat($('#Fdistance').text())).toFixed(2));
    }else if(type == 2){
        var deposit = parseFloat($('#Fdeposit').text());
        $('#FtotalPrice').html(parseFloat($('#priceValF').text())+deposit);
        //$('#priceValF').html(TotalPrice - deposit);
        var TotalPrice = parseFloat(parseFloat($('#priceValF').text())+deposit);
        $('#pricePMValG').html(parseFloat((TotalPrice - deposit)/parseFloat($('#Fdistance').text())).toFixed(2));
    }else if(type == 3){
        var deposit = parseFloat($('#Fdeposit').text());
        
        $('#priceValF').html(parseFloat(parseFloat($('#pricePMValG').text())*parseFloat($('#Fdistance').text())).toFixed(2));
        $('#FtotalPrice').html(parseFloat($('#priceValF').text())+deposit);
        var TotalPrice = parseFloat($('#FtotalPrice').text());
        //$('#pricePMValG').html(parseFloat((TotalPrice - deposit)/$('#Fdistance').text()).toFixed(2));
    }
}

//  launch block
function show_launch_block(base_url, button, qid){
      $('#massLaunch').css('top', ($(window).scrollTop()+70) + "px");

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/emails/mass_launch_block/',
        async: true,
        success: function(response){
          $('#massLaunch').html(response);
         
          //$('#massLaunch').css('top', (parseInt(button.offset().top)-70) + 'px');
          $('#massLaunch').fadeIn(500); 
           
        }
      }); 
}

// добавление пустого лида
function addEmptyLead(base_url){
      $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    data: ({"spart":1}),
    url : base_url+'admin/main/add_empty_lead/',
    async: true,
    success: function(response){ 
      //console.log(response);
       //showPartQuotes(base_url, 1, false, 0);
       activateQuote(base_url, response, 0);
       show_fullinfoG(base_url, $('.buttonBlue').eq(0), response);
    }
    
  });
}

function show_drivers_table(base_url, button, qid){
  if(button != 0){
    if(button.hasClass('iopen2')){ 
      button.removeClass('iopen2');   
      $('#driversBlock'+qid).slideUp(500, function(){ 
        $('#drivers'+qid).css('display', 'none'); 
      }); 
      button.parent().removeClass('active');
    }else{ 
      button.addClass('iopen2'); 
      $('#drivers'+qid).css('display', 'block'); 
      $('#driversBlock'+qid).slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_drivers_table/',
        async: true,
        success: function(response){ 
           $('#driversBlock'+qid).html(response);
        }
      });
      //button.parent().addClass('active');
    }
  }else{
    //alert(qid);
    $('#driversBlock'+qid).html('<div class="loadingInTable"><img src="'+base_url+'img/loading.gif"/></div>');
     $('#drivers'+qid).css('display', 'block'); 
      $('#driversBlock'+qid).slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_drivers_table/',
        async: true,
        success: function(response){ 
           $('#driversBlock'+qid).html(response);
        }
      });
  }
 
}
 


// Показать блок Фаворайтс
function show_drivers_tableF(base_url, button, qid){
  if(button != 0){
    if(button.hasClass('iopen2')){ 
      button.removeClass('iopen2');   
      $('#driversBlockF').fadeOut(500, function(){ 
        $('#driversF').css('display', 'none'); 
      }); 
      button.parent().removeClass('active');
    }else{ 
      button.addClass('iopen2'); 
      $('#driversF').css('display', 'block'); 
      $('#driversBlockF').fadeIn(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_drivers_table/',
        async: true,
        success: function(response){ 
           $('#driversBlockF').html(response);
            $('#hideDriversBut').fadeIn(500);
          $('#driversF').resizable({handles: 'n, s'});
            
        }
      });
      //button.parent().addClass('active');
    }
  }else{
    //alert(qid);
    $('#driversBlockF').html('<div class="loadingInTable"><img src="'+base_url+'img/loading.gif"/></div>');
     $('#driversF').css('display', 'block'); 
      $('#driversBlockF').fadeIn(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_drivers_table/',
        async: true,
        success: function(response){ 
           $('#driversBlockF').html(response);
        }
      });
  }
 
}

// Показать блок Локальные компании
function show_drivers_tableLC(base_url, button, qid, sorting)
{
    //sorting || (sorting="Origin");
        $.ajax({
        type: 'POST',
        data: ({"qid": qid, "sorting": sorting}),
        url: base_url + 'admin/main/get_localcompanies_table/',
        async: true,
        success: function (response)
        {
            $('#driversBlockF').html(response);
        }
    })
}

// Показать Фаворайтс
function show_drivers_tableFav(base_url, button, qid, sorting)
{
    sorting || (sorting="Origin");
    $.ajax({
        type: 'POST',
        data: ({"qid": qid, "sorting": sorting}),
        url: base_url + 'admin/main/get_favorites_table/',
        async: true,
        success: function (response)
        {
            $('#driversBlockF').html(response);
        }
    })
}

// Изменение иконки фаворитов
function favorites(base_url, button, drivers_id, drivers_id_f)
{
    console.log(base_url);
    console.log(button);
    console.log(drivers_id);
    console.log(drivers_id_f);
    $('.drv_id_' + drivers_id).removeAttr('onclick');
    $('.drv_id_' + drivers_id).removeAttr('src');
    //$('.drv_id_' + drivers_id).attr('onclick', null);
    if(drivers_id_f === drivers_id)
    {
        console.log('drivers_id_f != null');
        $.ajax({
            type: 'POST',
            data: ({"drivers_id_f": drivers_id_f}),
            url: base_url + 'admin/main/remove_favorites/',
            async: true,
            success: function () {
                $('.drv_id_' + drivers_id).prop('src', base_url + 'img/favorites_empty.png');
                $('.drv_id_' + drivers_id).attr('onclick', 'favorites(\''+base_url+'\', '+'$(this)'+', \''+drivers_id+'\', \''+null+'\')');
            }
        });
    }
    else
    {
        console.log('drivers_id_f == null');
        $.ajax({
            type: 'POST',
            data: ({"drivers_id": drivers_id}),
            url: base_url + 'admin/main/add_favorites/',
            async: true,
            success: function () {
                $('.drv_id_' + drivers_id).prop('src', base_url + 'img/favorites_full.png');
                $('.drv_id_' + drivers_id).attr('onclick', 'favorites(\''+base_url+'\', '+'$(this)'+', \''+drivers_id+'\', \''+drivers_id+'\')');
            }
        });
    }
}

// Изменение надписи сортировки
function sort_toggle(button)
{
    //button.html("Destination");
    //alert("Sort "+button.text());
    if(button.html()==="Origin")
    {
        //alert("SortOrigin "+button.text());
        button.html("Destination");
    }
    else
    {
       // alert("SortDest "+button.text());
        button.html("Origin");
    }
}

// Показать блок статистики для ковты
function show_qhistory(base_url, button, qid){
  if(button != 0){
    if(button.hasClass('iopen')){ 
      button.removeClass('iopen');   
      $('#qhistoryBlock'+qid).slideUp(500, function(){ 
        $('#qhistory'+qid).css('display', 'none'); 
      }); 
      button.parent().removeClass('active');
    }else{ 
      button.addClass('iopen'); 
      $('#qhistory'+qid).css('display', 'block'); 
      $('#qhistoryBlock'+qid).slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_quote_history/',
        async: true,
        success: function(response){ 
           $('#qhistoryBlock'+qid).html(response);
        }
      });
      //button.parent().addClass('active');
    }
  }else{
    //alert(qid);
    $('#qhistoryBlock'+qid).html('<div class="loadingInTable"><img src="'+base_url+'img/loading.gif"/></div>');
     $('#qhistory'+qid).css('display', 'block'); 
      $('#qhistoryBlock'+qid).slideDown(500);   
      $.ajax({
        type: 'POST',
        data: ({"qid":qid}),
        url : base_url+'admin/main/get_quote_history/',
        async: true,
        success: function(response){ 
           $('#qhistoryBlock'+qid).html(response);
        }
      });
  }
 
}

// Разкрыть детали редактирование квоты
function show_fullinfo(base_url, button, qid){
  $('.SlideDownTableItems').css('display', 'none');
  if(button.hasClass('iopen2')){ 
    button.removeClass('iopen2');   
    $('#fullinfoBlock'+qid).slideUp(500, function(){ 
      $('#fullinfo'+qid).css('display', 'none'); 
    }); 
    //button.parent().removeClass('active');
    //ssalert('a');
  }else{ 
    button.addClass('iopen2'); 
    $('#fullinfo'+qid).css('display', 'block'); 
    $('#fullinfoBlock'+qid).slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/get_fullinfo/',
      async: true,
      success: function(response){ 
         $('#fullinfoBlock'+qid).html(response);
          $('html, body').animate({
                        scrollTop: $('#fullinfoBlock'+qid).position().top+160
                    }, 300);
      }
    });
    //button.parent().addClass('active');
  } 
  
  //add_to_group();
}

// Показать под блоком таргет инфо форму с новым дизанайном
function show_fullinfoG(base_url, button, qid){
  $('.SlideDownTableItems').css('display', 'none');
  if(button.hasClass('iopen2')){ 
    button.removeClass('iopen2');   
    $('#fullinfoBlockG').slideUp(500, function(){ 
      $('#fullinfoG').css('display', 'none'); 
    }); 
    //button.parent().removeClass('active');
    //ssalert('a');
  }else{ 
    button.addClass('iopen2'); 
    $('#fullinfoG').css('display', 'block'); 
    $('#fullinfoBlockG').slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/get_fullinfo/',
      async: true,
      success: function(response){ 
         $('#fullinfoBlockG').html(response);
          $('html, body').animate({
                        scrollTop: $('#fullinfoBlockG').position().top-250
                    }, 300);
          $('#content').html('');
      }
    });
    //button.parent().addClass('active');
  } 
  
  //add_to_group();
}

// Конвертировать лид в квоту
function convertToQuote(base_url, qid, ispart){
  $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/convertToQuote/',
      async: true,
      success: function(response){ 
         if(response != "+"){
            alert('Lead have some errors and cant be moved to quote...');
         }else if(response == "+"){
            var spart = 75;  
            var GlobalCount1 = $('#SPitem'+selectedUpMenu2).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount1.text(parseInt(GlobalCount1.text())-1);
             var GlobalCount2 = $('#SPitem'+spart).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount2.text(parseInt(GlobalCount2.text())+1);

            $('#countInside'+selectedUpMenu2).text(parseInt($('#countInside'+selectedUpMenu2).text())-1);
            $('#countInside'+spart).text(parseInt($('#countInside'+spart).text())+1);

            dontSelectFirst = 1;
           // $('#SPitem'+spart).parent().parent().prev().click();
           // $('#SPitem'+spart).click();

           // selectedUpMenu2 = selectedUpMenu2;

            showPartQuotes(base_url, ispart, false, 1);
            //activateQuote(base_url, qid, 0);
           // $('#content').find('.itemQT').eq(0).click();
         }
      }
    });
}

// Разкрыть bookit
function show_bookit(base_url, button, qid){
  $('.SlideDownTableItems').css('display', 'none');
  if(button.hasClass('iopen2')){ 
    button.removeClass('iopen2');   
    $('#bookitBlockG').slideUp(500, function(){ 
      $('#bookitG').css('display', 'none'); 
    }); 
    $('#content').fadeIn(500);
    //button.parent().removeClass('active');
  }else{ 
    button.addClass('iopen2'); 
    $('#bookitG').css('display', 'block'); 
    $('#bookitBlockG').slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/get_bookit/',
      async: true,
      success: function(response){ 
         $('#bookitBlockG').html(response);
         $('#content').fadeOut(500);
         $('html, body').animate({
                        scrollTop: $('#bookitBlockG').position().top-250
                    }, 300);
      }
    });
   // button.parent().addClass('active');
  }
  
  //add_to_group();
}

// Разкрыть bookit
function show_dispatch(base_url, button, qid){
  $('.SlideDownTableItems').css('display', 'none');
  if(button.hasClass('iopen2')){ 
    button.removeClass('iopen2');   
    $('#dispatchBlockG').slideUp(500, function(){ 
      $('#dispatchG').css('display', 'none'); 
    }); 
    $('#content').fadeIn(500);
    //button.parent().removeClass('active');
  }else{ 
    button.addClass('iopen2'); 
    $('#dispatchG').css('display', 'block'); 
    $('#dispatchBlockG').slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/get_dispatch/',
      async: true,
      success: function(response){ 
         $('#dispatchBlockG').html(response);
         $('#content').fadeOut(500);
         $('html, body').animate({
                        scrollTop: $('#dispatchBlockG').position().top-300
                    }, 300);
      }
    });
   // button.parent().addClass('active');
  }
  
  //add_to_group();
}

// Разкрыть map
function show_map(base_url, button, qid, url, disturl ){
  //$('#pageLoading').css('display', 'block');
   
   $('#MapDist'+qid).html(0);
  if(button.hasClass('iopen')){ 
    button.removeClass('iopen');   
    $('#MapBlock'+qid).slideUp(500, function(){ 
      $('#Map'+qid).css('display', 'none'); 
    }); 
    button.parent().removeClass('active');
   // $('#pageLoading').fadeOut(500);
  }else{ 
   $('#pageLoading').fadeIn(500);
    button.addClass('iopen'); 
    $('#Map'+qid).css('display', 'block'); 
    $('#MapBlock'+qid).slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"disturl":disturl, 'qid':qid}),
      url : base_url+'admin/main/get_dist/'+qid,
      async: true,
      success: function(response){ 
        $('#MapDist'+qid).html(response.split('~')[0]);
        $('#PricePerMile'+qid).html("$"+response.split('~')[1]+"/mi");
        $('#PriceGlobal'+qid).html("$"+(parseFloat(response.split('~')[1])*parseInt(response.split('~')[0])).toFixed(2));
        updatePrice(base_url, qid);
        $('#pageLoading').fadeOut(500);
      }
    });
    var tmp = $('#MapDist'+qid).parent();
    var tmp2 = $('#PriceGlobal'+qid).parent();
    $('#MapBlock'+qid).html('<iframe style="width:100%; height:600px; border:none;"  src="'+url+'"></iframe>');
    $('#MapBlock'+qid).prepend(tmp);
    $('#MapBlock'+qid).prepend(tmp2);
    //$('#Mapiframe'+qid).attr('src', url);
  button.parent().addClass('active');
  } 
  
  //add_to_group();
}

// Разкрыть map
function showcarpic(base_url, button, qid, url){
//$('#pageLoading').fadeIn(500);
  if(button.hasClass('iopen')){ 
    button.removeClass('iopen');   
    $('#carpicBlock'+qid).slideUp(500, function(){ 
      $('#carpic'+qid).css('display', 'none'); 
    }); 
    button.parent().removeClass('active');
  }else{ 
    button.addClass('iopen'); 
    $('#carpic'+qid).css('display', 'block'); 
    $('#carpicBlock'+qid).slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"req":url}),
      url : base_url+'admin/main/get_carpic/',
      async: true,
      success: function(response){ 
        $('#carpicBlock'+qid).html(response);
        $('#pageLoading').fadeOut(500);
      }
    });
    
    $('#Mapiframe'+qid).attr('src', url);
    button.parent().addClass('active');
  } 
  
  //add_to_group();
}



// Добавление писма в рассылку
function add_email_to_send(base_url, qid, eid, todate){
   var ismass = 0;
   var showSendStat = 1;
   if(qid == 0){
      qid = "";
     //alert($('.SelectedItem:checked').length);
      $('.SelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      });
      ismass = 1;
      showSendStat = 0;
      //alert(qid);
      //return;
   }

   if(showSendStat == 1) $('#pageLoading').fadeIn(500); 
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, "eid":eid, "date":todate, 'ismass':ismass}),
      url : base_url+'admin/emails/add_email_to_send/',
      async: true,
      success: function(response){ 
         //console.log(response);
         if(showSendStat == 1) show_send_stat(base_url, 0, qid);
         //$('#waitingtable'+qid+' > tbody:last').append(response);
         if(showSendStat == 1) $('#pageLoading').fadeOut(500);
         if(showSendStat == 0){
            showPartQuotes(base_url, selectedUpMenu2, false, 0);
            //activateQuote(base_url,qid);
           // $('#massLaunch').fadeOut();
         }
      }
    });
}


// Добавление писма в рассылку через launch
function add_email_to_send_launch(base_url, qid, eid, todate, specEmail){
   var ismass = 0;
   var showSendStat = 1;
   if(qid == 0){
      qid = "";
     //alert($('.SelectedItem:checked').length);
      $('.SelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      });
      ismass = 1;
      showSendStat = 0;
      //alert(qid);
      //return;
   }

   if(ismass == 1){
      specEmail = "-";
   }
   //alert('a');
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, "eid":eid, "date":todate, 'ismass':ismass, 'specEmail':specEmail}),
      url : base_url+'admin/emails/add_email_to_send/',
      async: true,
      success: function(response){ 
            showPartQuotes(base_url, selectedUpMenu2, false, 2);
            activateQuote(base_url,qid);
            $('#darker').click();
      }
    });
    
}

// Добавление писма в рассылку через launch
function add_email_to_send_launch_empty(base_url, qid, eid, todate, specEmail){
   var ismass = 0;
   var showSendStat = 1;
   
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, "eid":eid, "date":todate, 'ismass':ismass, 'specEmail':specEmail}),
      url : base_url+'admin/emails/add_email_to_send/',
      async: true,
      success: function(response){ 
            
            showPartQuotes(base_url, selectedUpMenu2, false, 2);
            activateQuote(base_url,qid);
            $('#darker').click();
         
      }
    });
    
}

// Выслсаем конкретное письмо 1 шт
function send_email(base_url, qid, eid, wid){
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, "eid":eid, "wid":wid}),
      url : base_url+'admin/emails/send_one_email/',
      async: true,
      success: function(response){ 
         //console.log(response);
        // $('#waitingtable'+qid+' > tbody:last').append(response);
        // $('#pageLoading').fadeOut(500);
        
       // alert('I sent it...');
        show_send_stat(base_url, 0, qid);
      }
    });
}

// Отмена в рассылке ожидания
function delete_wemail(base_url, wid, qid){
   $.ajax({
      type: 'POST',
      data: ({"wid":wid}),
      url : base_url+'admin/emails/delete_email_waiting/',
      async: true,
      success: function(response){ 
        show_send_stat(base_url, 0, qid);
         //console.log(response);
        // $('#waitingtable'+qid+' > tbody:last').append(response);
        // $('#pageLoading').fadeOut(500);
        //alert('I sent it...');
      }
    });
}

// Добавление в выделеное
function add_to_group(){
  if($('.iRow.active').length > 1){
     $('#doGroupThigs').fadeIn(500);
  }else{
     $('#doGroupThigs').fadeOut(500);
  } 
}
// Закрытие окон при клике на затемнение
$(document).ready(function(){
  $('#darker').click(function(){
    $("#darker").fadeOut(500);
    $(".dropListBlock").fadeOut(500);
    $(".popupblock").fadeOut(300);
    $(".popupbutton").removeClass('active');
    $('.spartInfo').css('color', 'rgba(0,0,0, 0.17)').css('z-index', '0');
    $('#perscabblock').fadeOut(500);
    $('#alertBlock0').fadeOut(500);
    $('#alertBlock2').fadeOut(500);
    $('#alertBlock1').fadeOut(500);
    $('#quotenotice').fadeOut(500);
    $('#massLaunch').fadeOut(500);
    $('#SEBlock').fadeOut(500);
    $('#PCBlock').fadeOut(500);
    $('.statBlock').fadeOut(300);
  });
/*
  $('.iRow').click(function(){
     add_to_group(); 
  });
*/
  
});
// Обновлятель для парсера
function refresh_on_focus(base_url){
  $(window).focus(function() {
        showPartQuotes(base_url, selectedUpMenu2, false, 0);
        $(window).unbind("focus");
  });
}

function show_pers_cab(base_url){
  $('#darker').fadeIn(500);
  $('#perscabblock').css('top', ($(window).scrollTop()+70) + "px");
  $('#perscabblock').css('left', ($(window).width()/2 - 450) + "px");
  $.ajax({
      type: 'POST',
      data: ({"qid":0}),
      url : base_url+'admin/main/get_perscab_page/',
      async: true,
      success: function(response){ 
         //console.log(response);
         $('#perscabblock').html(response);
         $('#perscabblock').fadeIn(500);
         $( "#perscabblock" ).draggable({ containment: '#darker', handle:'#iPerrscabTitle' });
      }
    });
  
}


function show_emails_change(base_url, eid){
  $('#darker').fadeIn(500);
  $('#editemailblock').css('top', ($(window).scrollTop()+70) + "px");
  $('#editemailblock').css('left', ($(window).width()/2 - 450) + "px");
  $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/main/get_email_change/',
      async: true,
      success: function(response){ 
         //console.log(response);
         $('#editemailblock').html(response);
         $('#editemailblock').fadeIn(500);
         $( "#editemailblock" ).draggable({ containment: '#darker', handle:'#iEPerrscabTitle' });
      }
    });
  
}

// Показываем в блоке лаунча редактирование шаблона
function LauncherShowEditEmail(base_url, eid){
  if($('#EditEmailContainer').is(':visible')){
    $('#EditEmailContainer').fadeOut(500);
  }else{
    $('#EditEmailContainer').fadeIn(500);
    $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/main/get_email_change/',
      async: true,
      success: function(response){ 
         //console.log(response);
         $('#massLaunch').css('position', 'absolute');
         $('#massLaunch').css('top', ($(window).scrollTop()+70) + "px");
         $('#EditEmailContainer').html(response);
         $('#EditEmailContainer').fadeIn(500);
         $('#saveTemporary').fadeIn(500);
      }
    });
  }
  

}

function sendAnswerEmail(base_url, from_email, mess_id, text){
   $.ajax({
      type: 'POST',
      data: ({"from_email":from_email, 'mess_id':mess_id, 'text':text}),
      url : base_url+'admin/emails/send_answer/',
      async: true,
      success: function(response){ 
         $('#hider').click();
      }
    }); 

}

function add_emails_to_list(base_url, eid, fid, container){
  $.ajax({
      type: 'POST',
      data: ({"eid":eid, 'fid':fid}),
      url : base_url+'admin/main/add_emails_to_list/',
      async: true,
      success: function(response){ 
         //console.log(response);
         container.append(response); 
      }
    });
  
}

var pageOpened = 0;

// Редаткрование quote
function updateQuote(base_url, qid){
      var $that = $('#fullInfoForm'+qid),
      formData = new FormData($that.get(0));
      //formData.append('date_upl', new Date()); 
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){ 
          $('#fullinfoBlockG').fadeOut(300);
          //showPartQuotes(base_url, selectedUpMenu2, false, 0);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
          dontActivateFirst = 1;
          showPartQuotes(base_url, selectedUpMenu2, false, 1);
          activateQuote(base_url, qid, 0);
        }
      });
}

 // Редактирование ордера
 function updateQuoteOrder(base_url, qid){
    //alert('a');
      var $that = $('#bookitForm'+qid),
      formData = new FormData($that.get(0));
      //formData.append('date_upl', new Date()); 
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){
          //console.log($('#q-'+qid).offset().top);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
          $('#bookitG').fadeOut(300);
          //showPartQuotes(base_url, selectedUpMenu2, false, 0);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);

          var spart = 83;  
            var GlobalCount1 = $('#SPitem'+selectedUpMenu2).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount1.text(parseInt(GlobalCount1.text())-1);
             var GlobalCount2 = $('#SPitem'+spart).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount2.text(parseInt(GlobalCount2.text())+1);

            $('#countInside'+selectedUpMenu2).text(parseInt($('#countInside'+selectedUpMenu2).text())-1);
            $('#countInside'+spart).text(parseInt($('#countInside'+spart).text())+1);

             dontSelectFirst = 1;
            $('#SPitem'+spart).parent().parent().prev().click();
            $('#SPitem'+spart).click();

            selectedUpMenu2 = spart;

          showPartQuotes(base_url, 83, false, 1);
          activateQuote(base_url, qid, 0);
        }
      });
 }

 // Редактирование ордера
 function updateQuoteDispatch(base_url, qid){
    //alert('a');
      var $that = $('#dispatchForm'+qid),
      formData = new FormData($that.get(0));
      //formData.append('date_upl', new Date()); 
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){
          //console.log($('#q-'+qid).offset().top);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
          $('#dispatchG').fadeOut(300);
          //showPartQuotes(base_url, selectedUpMenu2, false, 0);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);

          var spart = 87;  
            var GlobalCount1 = $('#SPitem'+selectedUpMenu2).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount1.text(parseInt(GlobalCount1.text())-1);
             var GlobalCount2 = $('#SPitem'+spart).parent().parent().prev().find('.countInsideFlevelMenu');
            GlobalCount2.text(parseInt(GlobalCount2.text())+1);

            $('#countInside'+selectedUpMenu2).text(parseInt($('#countInside'+selectedUpMenu2).text())-1);
            $('#countInside'+spart).text(parseInt($('#countInside'+spart).text())+1);

             dontSelectFirst = 1;
            $('#SPitem'+spart).parent().parent().prev().click();
            $('#SPitem'+spart).click();

            selectedUpMenu2 = spart;

          showPartQuotes(base_url, 87, false, 1);
          activateQuote(base_url, qid, 0);
        }
      });
 }

 // Редактирование письма
 function UpdateEmail(Form, eid, hash){
   //console.log(tinyMCE.get('textareaAR'+hash).getContent());
   var $that = Form,
      formData = new FormData($that.get(0));
      formData.append('Etext', tinyMCE.get('textareaAR'+hash).getContent());
      if(eid == 0){ 
          formData.append('Etype', '1'); 
       }
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){
          
          
          if(eid == 0){
            $('#EID').append($('<option>', { value: result,  text: $('input[name=Esubject]').val() })); 
            $('#EID option[value='+result+']').prop('selected', 'selected'); 
          }
          $('#closeEmailWindow').click();
          //console.log($('#q-'+qid).offset().top);
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
        }
      });
 }

// Редактирование профиля админа 
function update_crm_profile(Form){
    var $that = Form,
      formData = new FormData($that.get(0));
      //formData.append('date_upl', new Date()); 
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){
          alert('i do it..');
          //console.log($('#q-'+qid).offset().top);
         // $('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
        }
      });
}

// Получение числа из строки 
 function TryParseInt(str,defaultValue) {
     var retValue = defaultValue;
     if(str !== null) {
         if(str.length > 0) {
             if (!isNaN(str)) {
                 retValue = parseInt(str);
             }
         }
     }
     return retValue;
}


// Редактирование цены за милю
function updatePrice(base_url, qid){
  var PricePerMile = $('#pricePMVal'+qid).html();
  //$('#pageLoading').fadeIn(500);
  $.ajax({
      type: 'POST',
      data: ({"qid":qid, "price_per_mile": PricePerMile}),
      url : base_url+'admin/main/set_price_per_mile/',
      async: true,
      success: function(response){ 
         //console.log(response);
         //$('#perscabblock').html(response);
         //$('#perscabblock').fadeIn(500);
         //$( "#perscabblock" ).draggable({ containment: '#darker', handle:'#iPerrscabTitle' });
         $('#priceVal'+qid).html(TryParseInt(response,0));
         $('#priceValF').html(TryParseInt(response,0));
         
         //$('#pageLoading').fadeOut(500); 
      }
    });
}

// удаление письма из настроек рассылки
function delete_email_from_list(base_url, eid){
   $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/main/deleteemail/'+eid+'/',
      async: true,
      success: function(response){ 
         $('#erow'+eid).fadeOut(500);
      }
    });
}

// удаление письма из настроек рассылки
function delete_email_from_folder(base_url, eid){
   $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/main/deleteemailfromfolder/'+eid+'/',
      async: true,
      success: function(response){ 
         $('#lerow'+eid).fadeOut(500);
      }
    });
}

// Редактирование одного значения квоты
function updateQuoteValue(base_url, qid, name, value, iupdatePrice){
  //var PricePerMile = $('#pricePMVal'+qid).html();
  //$('#pageLoading').fadeIn(500);
  //console.log('1');
  $.ajax({
      type: 'POST',
      data: ({"qid":qid, "name": name, "value":value}),
      url : base_url+'admin/main/set_quote_new_value/',
      async: true,
      success: function(response){ 
          if(iupdatePrice == 1){
            updatePrice(base_url, qid);
          }
      }
    });
}

// Редактирование одного значения контакта
function updateContactValue(base_url, cid, name, value){
  //var PricePerMile = $('#pricePMVal'+qid).html();
  //$('#pageLoading').fadeIn(500);
  //console.log('1');
  $.ajax({
      type: 'POST',
      data: ({"cid":cid, "name": name, "value":value}),
      url : base_url+'admin/main/set_contact_new_value/',
      async: true,
      success: function(response){ 

      }
    });
}

// Пометить письмо как прочитаное
function update_email_as_readed(base_url, REid){
  $.ajax({
      type: 'POST',
      data: ({"REid":REid}),
      url : base_url+'admin/emails/update_email_as_readed/',
      async: true,
      success: function(response){ 

      }
    });
}
// Пометить алерт как прочитаный
function updateActionAsRead(base_url, aid){
  $.ajax({
      type: 'POST',
      data: ({"aid":aid}),
      url : base_url+'admin/main/update_action_as_read/',
      async: true,
      success: function(response){ 

      }
    });
}

// Пометить просмотр письма как прочитано как прочитаный
function updateOpenEmailAsRead(base_url, eid){
  $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/main/update_openemail_as_read/',
      async: true,
      success: function(response){ 

      }
    });
}

// Удаление пиьма полученого
function delete_recived_email(base_url, REid, qid){
  $.ajax({
      type: 'POST',
      data: ({"REid":REid}),
      url : base_url+'admin/emails/delete_email_recived/',
      async: true,
      success: function(response){ 
          show_send_stat(base_url, 0, qid);
      }
    });
}

// Добавление писем в рассылку
function add_emails_to_send_list(base_url, stype, qid){
  $.ajax({
      type: 'POST',
      data: ({"stype":stype, "qid":qid}),
      url : base_url+'admin/emails/add_mails_waiting/',
      async: true,
      success: function(response){ 
          //show_send_stat(base_url, 0, qid);
      }
    });
}

// показываем квоту в полном блоке
function activateQuote(base_url,qid, showpic){
  $('.SlideDownTableItems').css('display','none');
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/main/show_fullinfo_quote/'+showpic,
      async: true,
      success: function(response){ 
          $('#QuotefullInfo').html(response);
         // $('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
      }
    });
}

// charget submit
function do_charged(base_url, qid, charged){
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, 'charged':charged}),
      url : base_url+'admin/main/docharge/',
      async: true,
      success: function(response){ 
          $('#darker').click();
          activateQuote(base_url,qid);

      }
    });
}

// сохраняем данные в блоке полной формы
function saveFullQuoteBlock(base_url, qid){
  var Fname = $('#Fname').text();
  var Femail = $('#Femail').text();
  var Fphone = $('#Fphone').text();
  //var Fphone2 = $('#Fphone2').text();
  var FcarMake = $('#FcarMake').text();
  var FcarModel = $('#FcarModel').text();
  var FdistFromCity = $('#FdistFromCity').text();
  var FdistFromState = $('#FdistFromState').text();
  var FdistFromZip = $('#FdistFromZip').text();
  var FdistToCity = $('#FdistToCity').text();
  var FdistToState = $('#FdistToState').text();
  var FdistToZip = $('#FdistToZip').text();
  var Fdistance = $('#Fdistance').text();
  var FarrDate = $('#datepickerLSd').val();
 // console.log($('#datepickerLSd').datepicker("getDate"));

  var FtotalPrice = $('#FtotalPrice').text();
  var Fdeposit = $('#Fdeposit').text();
  var priceValF = $('#priceValF').text();
  var pricePMValG = $('#pricePMValG').text();
  
  var pAddr = $('#pAddr').val();
  var dAddr = $('#dAddr').val();
 
  $.ajax({
      type: 'POST',
      data: ({"pAddr":pAddr, "dAddr":dAddr, "pricePMValG":pricePMValG, "Fname":Fname, "Femail":Femail, "Fphone":Fphone, "FcarMake":FcarMake, "FcarModel":FcarModel, "FdistFromCity":FdistFromCity, "FdistFromState":FdistFromState, "FdistFromZip":FdistFromZip, "FdistToCity":FdistToCity, "FdistToState":FdistToState, "FdistToZip":FdistToZip, "Fdistance":Fdistance, "FarrDate":FarrDate, "FtotalPrice":FtotalPrice, "Fdeposit":Fdeposit, "priceValF":priceValF, 'qid':qid}),
      url : base_url+'admin/main/update_fullinfo_quote/',
      async: true,
      success: function(response){ 
          showPartQuotes(base_url, selectedUpMenu2, false, 2);
          activateQuote(base_url,qid);
      }
    });
}

// Проиграть звуковой сигнал
 function playSound(filename){   
    document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="' + filename + '.mp3?" type="audio/mpeg" /><source src="' + filename + '.ogg?" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
}

function fadeOutpopUp(aid){
    setTimeout(function(){ $('#alertBlockPopUp'+aid).fadeOut(500); }, 5000);
}


// Получаем водителей для выбора
function get_like_drivers_search(base_url, dname){
  $('#driversLikeList').html('<div class="loadingInTable" style="padding:20px;"><img src="'+base_url+'img/loading.gif"/></div>');
  $.ajax({
    type: 'POST',
    data: ({'dname':dname}),
    url : base_url+'admin/drivers/get_driver_list/',
    async: true,
    success: function(response){
        $('#driversLikeList').html(response);
        $('#driversLikeList').fadeIn(500);
        $('.driverItem').click(function(){
            $(this).parent().prev().val($(this).text());
            $(this).parent().prev().prev().val($(this).attr('id'));
            $('#driversLikeList').fadeOut(500);
            //alert($(this).attr('id'));
            $.ajax({
                type: 'POST',
                data: ({'did':$(this).attr('id')}),
                url : base_url+'admin/drivers/get_driver_info/',
                async: true,
                success: function(response){
                   var DriverInfo = response.split('~');
                   $('#DriverContact').val(DriverInfo[0]);
                   $('#DriverEmail').val(DriverInfo[1]);
                   $('#DriverPhone').val(DriverInfo[2]);
                   $('#DriverPhone2').val(DriverInfo[3]);
                   $('#DriverMobile').val(DriverInfo[4]);
                   $('#Dciferki').val(DriverInfo[5]);
                   $('#trailerType').val(DriverInfo[6]).change();
                   $('#dCargo').val(DriverInfo[7]).change();
                   $('#addr2').val(unescape(decodeURI(DriverInfo[8].replace(/\+/g, '%20'))));
                   $('#dMC').val(DriverInfo[9]);
                }
                
               });
        });
    }
    
   });
}

// последовательно получаем все алерты
function get_one_type_alert(base_url, ifirstload, aid){
   $.ajax({
    type: 'POST',
    data: ({'aid':aid, 'firstLoad':ifirstload}),
    url : base_url+'admin/main/get_alerts_list/',
    async: true,
    success: function(response){
        var ialertsList = response.split('~');
        if(parseInt(ialertsList[0]) > 0) playSound('http://dronecrm.com/CRM4/img/alert'+aid); 
        $('#countAlerts'+aid).html(parseInt($('#countAlerts'+aid).html()) + parseInt(ialertsList[0]));
        if((ifirstload != 1)&&(parseInt(ialertsList[0]) > 0)){
          $('#alertBlockPopUp'+aid).html(ialertsList[1]);
          $('#alertBlockPopUp'+aid).fadeIn(300);
          fadeOutpopUp(aid);
        }
        $('#alertBlock'+aid).prepend(ialertsList[1]);
        aid = aid+1;
        if(aid < 3){
          get_one_type_alert(base_url, ifirstload, aid);
        }
        //showPartQuotes(base_url, selectedUpMenu2, false, 0);
    }
    
   });

}

// Получаем алерты
function get_all_alerts(base_url, ifirstload){
  if(ifirstload != 1) ifirstload = 0;
  var aid = 0;
  get_one_type_alert(base_url, ifirstload, 0);  
}

function getMoreQuotes(base_url, limit, countQ){
  ipage++;

   $.ajax({
            type: 'POST',
            data: ({'getMore':ipage, 'spart':selectedUpMenu2}),
            url : base_url+'admin/main/get_more_quots/',
            async: true,
            success: function(response){                    
                $('.QuotesTable').append(response);
            }
            
         });

   if(!(((ipage+1)*limit) < countQ)){
      $('#showMoreButton').fadeOut(500);
   }
  
}
// Показать статистику по емейлам
function showEstat(base_url, type){
  $('#darker').fadeIn(300);
    $.ajax({
      type: 'POST',
      data: ({'type':type}),
      url : base_url+'admin/emails/get_emails_stat/',
      async: true,
      success: function(response){                    
          $('#E'+type+'Content').html(response);
      }
      
   }); 
}

// Показываем статистику в таблице лидов
function show_table_emails_stat(base_url, type, qid, button){
  $('#EmailStitle').html('Launch '+type+' statistic (quote:'+qid+')');
  $('#darker').fadeIn(300);
  $('#ESTATBlock').css({ top:  button.offset().top + "px" });
  $('#ESTATBlock').css({ left:  button.offset().left + "px" });
  $.ajax({
      type: 'POST',
      data: ({'type':type, 'qid':qid}),
      url : base_url+'admin/emails/get_emails_teble_stat/',
      async: true,
      success: function(response){                    
          $('#ESContent').html(response);
      }
      
   }); 
  $('#ESTATBlock').fadeIn(500);
}

// Показать статистику по формам
function showFstat(base_url, type){
  $('#darker').fadeIn(300);
  $.ajax({
      type: 'POST',
      data: ({'type':type}),
      url : base_url+'admin/emails/get_forms_stat/',
      async: true,
      success: function(response){                    
          $('#F'+type+'Content').html(response);
      }
      
   }); 
}

function showConfirmation(whattodo, dofunction){
  $('#darker').fadeIn(500);
  $('#confirmationWindow').fadeIn(500);
  $('#confirmationText').html(whattodo);
   $('#confirmationTrue').unbind();
  $('#confirmationTrue').click(function(){
      dofunction();
      $('#darker').click();
  });
}

var CountQuotes = 0;
var quoted = 0;
var ordered = 0;
var dispached = 0;
var cenceled = 0;
var charged = 0;

var alert0 = 0;
var alert1 = 0;
var alert2 = 0;

var newLeads = 0;

// Получаем алерты
function get_statistic(base_url){
  $.ajax({
    type: 'POST',
    //data: ({}),
    url : base_url+'admin/main/get_Bstatistic/',
    async: true,
    success: function(response){
        var Vals = response.split('`');
        if(Vals[0] != CountQuotes){
           // QUOTED
           $('.workedL.circle').circleProgress({
              value: parseFloat(Vals[1]/Vals[0]).toFixed(2),
              fill: {color: ['#ffffff']}
            });
           $('#quotedV').html(parseFloat(Vals[1]/Vals[0]*100).toFixed());
           $('#quotedC').html(Vals[1]);
           quoted = Vals[1];

           // ORDERED
           $('.convertedO.circle').circleProgress({
              value: parseFloat(Vals[2]/Vals[0]).toFixed(2),
              fill: {color: ['#ffffff']}
            });
           $('#orderedV').html(parseFloat(Vals[2]/Vals[0]*100).toFixed());
           $('#orderedC').html(Vals[2]);
           ordered = Vals[2];
          
          // DISPACHED
          if(Vals[2] != 0){
             $('.dispachedO.circle').circleProgress({
                value: parseFloat(Vals[3]/Vals[2]).toFixed(2),
                fill: {color: ['#ffffff']}
              });
             $('#dispachedV').html(parseFloat(Vals[3]/Vals[2]*100).toFixed());
             $('#dispachedC').html(Vals[3]);
             dispached = Vals[3];
          }

          // CENCELED
          if(Vals[2] != 0){
             $('.cenceledO.circle').circleProgress({
                value: parseFloat(Vals[4]/Vals[2]).toFixed(2),
                fill: {color: ['#ffffff']}
              });
             $('#cenceledV').html(parseFloat(Vals[4]/Vals[2]*100).toFixed());
             $('#cenceledC').html(Vals[4]);
             cenceled = Vals[3];
          }

        }

        if(Vals[1] != quoted){
             // QUOTED
           $('.workedL.circle').circleProgress({
              value: parseFloat(Vals[1]/Vals[0]).toFixed(2),
              fill: {color: ['#ffffff']}
            });
           $('#quotedV').html(parseFloat(Vals[1]/Vals[0]*100).toFixed());
           $('#quotedC').html(Vals[1]);
           quoted = Vals[1];          
        }

        if(Vals[2] != ordered){
           // ORDERED
           $('.convertedO.circle').circleProgress({
              value: parseFloat(Vals[2]/Vals[0]).toFixed(2),
              fill: {color: ['#ffffff']}
            });
           $('#orderedV').html(parseFloat(Vals[2]/Vals[0]*100).toFixed());
           $('#orderedC').html(Vals[2]);
           ordered = Vals[2];
        }

        if(Vals[3] != dispached){
            // DISPACHED
          if(Vals[2] != 0){
             $('.dispachedO.circle').circleProgress({
                value: parseFloat(Vals[3]/Vals[2]).toFixed(2),
                fill: {color: ['#ffffff']}
              });
             $('#dispachedV').html(parseFloat(Vals[3]/Vals[2]*100).toFixed());
             $('#dispachedC').html(Vals[3]);
             dispached = Vals[3];
          } 
        }

        if(Vals[4] != cenceled){
            // CENCELED
          if(Vals[2] != 0){
             $('.cenceledO.circle').circleProgress({
                value: parseFloat(Vals[4]/Vals[2]).toFixed(2),
                fill: {color: ['#ffffff']}
              });
             $('#cenceledV').html(parseFloat(Vals[4]/Vals[2]*100).toFixed());
             $('#cenceledC').html(Vals[4]);
             cenceled = Vals[3];
          } 
        }

        $('#countAlertsW').html(Vals[5]);
        $('#countAlertsS').html(Vals[6]);
        $('#countAlertsO').html(Vals[7]);
        $('#countAlertsR').html(Vals[8]);

        
        if((alert0 != 0)&&(alert0 < parseInt(Vals[9]))) {
          playSound('http://dronecrm.com/CRM4/img/alert2');
        }

        $('#countAlerts0').html(Vals[9]);
        alert0 = parseInt(Vals[9]);

        if((alert1 != 0)&&(alert1 < parseInt(Vals[10]))) {
          playSound('http://dronecrm.com/CRM4/img/alert2');
        }

        $('#countAlerts1').html(Vals[10]);
        alert1 = parseInt(Vals[10]);

        if((alert2 != 0)&&(alert2 < parseInt(Vals[11]))) {
          playSound('http://dronecrm.com/CRM4/img/alert2');
        }
        $('#countAlerts2').html(Vals[11]);
        alert2 = parseInt(Vals[11]);

        var RaznicaLeads = 0;


       $('#SPitem1').parent().parent().prev().find('.countInsideFlevelMenu').text(Vals[14]);
       $('#countInside1').text(Vals[12]);
       $('#countInside70').text(Vals[13]);

       //console.log(Vals[15]+"-"+Vals[16]+"\n");

       if(charged != Vals[15]){
          // CHARGED
         $('.chargeredS.circle').circleProgress({
            value: parseFloat(Vals[15]/Vals[16]).toFixed(2),
            fill: {color: ['#ffffff']}
          });
         $('#chargeredSV').html(parseFloat(Vals[15]/Vals[16]*100).toFixed());
         $('#chargeredSC').html(Vals[15]);
         charged = Vals[15];
      }

    
        
        


        //console.log(Vals[0]+" - "+CountQuotes);
        //console.log(response);
    }
    
   });  
}


var alertMaker;
var statisticGeter;

var ibase_url = 'http://dronecrm.com/CRM4/'; 
// Кнопка промотать вверх
$(document).ready(function(){

  statisticGeter = setInterval(function(){ get_statistic(ibase_url) }, 7000);

  // Прописовываем все алерты
 // get_all_alerts(ibase_url, 1);
 // alertMaker = setInterval(function(){ get_all_alerts(ibase_url, 0) }, 10000);
    // Обрабатываем поля в дивах
$('body').on('focus', '[contenteditable]', function() {
    var $this = $(this);
    $this.data('before', $this.html());
    return $this;
}).on('blur keyup paste input', '[contenteditable]', function() {
    var $this = $(this);
    if ($this.data('before') !== $this.html()) {
        $this.data('before', $this.html());
        $this.trigger('change');
    }
    return $this;
});



/* set variables locally for increased performance */
        var scroll_timer;
        var displayed = false;
        var $message = $('#up');
        var $window = $(window);
        var top = 100;

        /* react to scroll event on window */
        $window.scroll(function () {
           if(!document.getElementById('dashBoard')){
           if($window.scrollTop() >= 26){
           
              $('#QuotefullInfo').css('position', 'fixed').css('top', '71px').css('right', '20px').css('width', 'calc(100% - 290px)').addClass('gradiend');
              if(!$('#fullMapBlock').is(':visible')){ $('#QFzameniaka').css('height', '50px'); }else{ $('#fullMapBlock').slideUp(300); $('#fullClientBlock').slideUp(300); } 
              $('#QFzameniaka').css('display', 'block');
           
           }    

           if($window.scrollTop() < 26){
              $('#QuotefullInfo').css('position', 'static').css('width', 'calc(100% - 38px)').css('background-color', 'none').removeClass('gradiend');;  
              $('#QFzameniaka').css('display', 'none');

           }
           /* 
           if($window.scrollTop() == 0){
           $('#fullMapBlock').slideDown(300); $('#fullClientBlock').slideDown(300);
         }
         */
            }

           /*
           if($window.scrollTop() < 150){
                    $('#leftMenuSearch').css('position', 'absolute').css('top', '220px');
                }else{
                    $('#leftMenuSearch').css('position', 'fixed').css('top', '50px'); 
                   
                }

            window.clearTimeout(scroll_timer);
            scroll_timer = window.setTimeout(function () { // use a timer for performance
               

                if($window.scrollTop() <= top) // hide if at the top of the page
                {
                    displayed = false;
                    $message.stop().animate({bottom:'-40', opacity: 0 }, 500);
                }
                else if(displayed == false) // show if scrolling down
                {
                    displayed = true;
                    //$message.stop(true, true).fadeIn(500).click(function () { $message.fadeOut(500); });

                    $message.css('display','block').css('bottom', '-50px').stop().animate({bottom:'40', opacity: 0.2 }, 500, function(){ $message.animate({bottom:'20', opacity: 1}, 500 )} );
                    
                    
                }
            }, 100);
            */
        });
        /*
        $('#up').click(function(e) { 
            //e.preventDefault();
            $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
        });
        */
        
    
});


function showDashboard(base_url, type, button){
  $('.Smenu').fadeOut('500');
  $('.Smenu'+type).fadeIn('500');
  if(dontSelectFirst == 0){
    $('.Smenu'+type).find('.SlevelMenuItem').eq(0).click();
  }else{
    dontSelectFirst = 0;
  }
  $('.FlevelMenuItem').removeClass('active3');
  button.addClass('active3');

  $("#QuotefullInfo").html("");
  $("body").css("background", "#ffffff");
  $("#content").html("");
  $.ajax({
      type: 'POST',
      data: ({}),
      url : base_url+'admin/main/dashboard/',
      async: true,
      success: function(response){                    
          $("#content").html(response);
      }
      
   });
  
 
}

//[ANCADD]
function show_sms_change(base_url, smsid){
    $('#darker').fadeIn(500);
    $('#editemailblock').css('top', ($(window).scrollTop()+70) + "px");
    $('#editemailblock').css('left', ($(window).width()/2 - 450) + "px");
    $.ajax({
        type: 'POST',
        data: ({"smsid":smsid}),
        url : base_url+'admin/main/get_sms_change/',
        async: true,
        success: function(response){
            //console.log(response);
            $('#editemailblock').html(response);
            $('#editemailblock').fadeIn(500);
            $( "#editemailblock" ).draggable({ containment: '#darker', handle:'#iEPerrscabTitle' });
        }
    });

}

