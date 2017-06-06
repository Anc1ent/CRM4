// Перегрузка таблицы с квотами
function showPartDrivers(base_url, PartId, button, dontrefresh){
  selectedUpMenu2 = PartId;
  $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    data: ({'partid':PartId}),
    url : base_url+'admin/drivers/get_drivers_part/',
    async: false,
    success: function(response){ 
        $('#content').replaceWith(response);
        if(dontrefresh != 1) $('#pageLoading').fadeOut(500); 
        if(button != false){
          $('.secondMenu .upmenuButton').removeClass('active');
          button.addClass('active');
        }
        $('#doGroupThigs').fadeOut(500);
        $('.iRow').click(function(){
           add_to_group();
        });
          
    }
    
  }); 
}
// Перемещение квоты в другой раздел
function moveDriversTo(base_url, qid , spart, button){
  $.ajax({
    type: 'POST',
    data: ({'qid':qid, 'spart':spart}),
    url : base_url+'admin/drivers/set_driver_part/',
    async: false,
    success: function(response){ 
        //button.parent().parent().parent().parent().fadeOut(500);
        //$('.spartInfo').css('color', 'rgba(0,0,0, 0.17)').css('z-index', '0');
        $('#darker').fadeOut(500);
        showPartDrivers(base_url, selectedUpMenu2, false, 1);
        get_upmenu_drivers(base_url);
    }
    
  });

}

// Подгрузка верхнего меню 
function get_upmenu_drivers(base_url){
  $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    data: ({'smenu':selectedUpMenu, 'smenu2':selectedUpMenu2}),
    url : base_url+'admin/drivers/get_upmenu/',
    async: false,
    success: function(response){ 
        $('#upMenuBlock').replaceWith(response);
        $('#pageLoading').fadeOut(500); 
        //$('.secondMenu .upmenuButton').removeClass('active');
       // button.addClass('active');
    }
    
  });
}
// Изменение сортировки
function chTableSortDrivers(base_url, val1, val2){
   $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    url : base_url+'admin/drivers/set_sort/'+val1+'/'+val2,
    async: false,
    success: function(response){ 
       showPartDrivers(base_url, selectedUpMenu2, false, 0);
    }
    
  });
}
// Изменение количества показываемых квот на странице
function chTableLimitDrivers(base_url , val1){
   $('#pageLoading').fadeIn(500); 
   $.ajax({
    type: 'POST',
    url : base_url+'admin/drivers/set_limit/'+val1,
    async: false,
    success: function(response){ 
       showPartDrivers(base_url, selectedUpMenu2, false, 0);
    }
    
  });
} 


// Разкрыть детали редактирование квоты
function show_fullinfo_drivers(base_url, button, qid){
  if(button.hasClass('iopen')){ 
    button.removeClass('iopen');   
    $('#fullinfoBlock'+qid).slideUp(500, function(){ 
      $('#fullinfo'+qid).css('display', 'none'); 
    }); 
    
  }else{ 
    button.addClass('iopen'); 
    $('#fullinfo'+qid).css('display', 'table-row'); 
    $('#fullinfoBlock'+qid).slideDown(500);   
    $.ajax({
      type: 'POST',
      data: ({"qid":qid}),
      url : base_url+'admin/drivers/get_fullinfo/',
      async: false,
      success: function(response){ 
         $('#fullinfoBlock'+qid).html(response);
      }
    });
  } 
  button.parent().addClass('active');
  //add_to_group();
}

// Редаткрование quote
function updateDriver(qid){
      var $that = $('#driverForm'+qid),
      formData = new FormData($that.get(0));
      //formData.append('date_upl', new Date()); 
      $.ajax({
        url: $that.attr('action'),
        type: $that.attr('method'),
        contentType: false,
        processData: false,
        data: formData,
        success: function(result){ 
          //$('html, body').animate({ scrollTop: parseInt($('#q-'+qid).offset().top) }, 500);
        }
      });
}

// -----------------------------------------------
//  launch block
function show_driver_launch_block(base_url, button, qid, quote_id){
      $('#massLaunch').css('top', ($(window).scrollTop()+70) + "px");

      $('#darker').fadeIn(500);
      $.ajax({
        type: 'POST',
        data: ({"qid":qid, 'quote_id':quote_id}),
        url : base_url+'admin/emails/drivers_launch_block/',
        async: true,
        success: function(response){
          $('#massLaunch').html(response);
         
          //$('#massLaunch').css('top', (parseInt(button.offset().top)-70) + 'px');
          $('#massLaunch').fadeIn(500); 
           
        }
      }); 
}

// Mass launch
function show_drivers_mass_launch_block(base_url, button, quote_id){
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
        data: ({"qid":qid, 'quote_id':quote_id}),
        url : base_url+'admin/emails/drivers_launch_block/',
        async: true,
        success: function(response){
          $('#massLaunch').html(response);
         
          //$('#massLaunch').css('top','px');
          $('#massLaunch').fadeIn(500); 
           
        }
      }); 
}


function show_drivers_emails_change(base_url, eid){
  $('#darker').fadeIn(500);
  $('#editemailblock').css('top', ($(window).scrollTop()+70) + "px");
  $('#editemailblock').css('left', ($(window).width()/2 - 450) + "px");
  $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/drivers/get_email_change/',
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
function LauncherDriverShowEditEmail(base_url, eid){
  if($('#EditEmailContainer').is(':visible')){
    $('#EditEmailContainer').fadeOut(500);
  }else{
    $('#EditEmailContainer').fadeIn(500);
    $.ajax({
      type: 'POST',
      data: ({"eid":eid}),
      url : base_url+'admin/drivers/get_email_change/',
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



// Выслсаем конкретное письмо 1 шт
function send_drivers_email(base_url, qid, eid, specEmail,quote_id){
  var ismass = 0;
   var showSendStat = 1;
   if(qid == 0){
      qid = "";
     //alert($('.SelectedItem:checked').length);
      $('.DSelectedItem:checked').each(function(){
        qid += $(this).attr('id')+"`"; 
      });
      ismass = 1;
      showSendStat = 0;
      //alert(qid);
      //return;
   }

  // if(showSendStat == 1) $('#pageLoading').fadeIn(500); 
   $.ajax({
      type: 'POST',
      data: ({"qid":qid, "eid":eid, 'specEmail':specEmail, 'quote_id':quote_id, 'ismass':ismass}),
      url : base_url+'admin/drivers/send_one_email/',
      async: true,
      success: function(response){ 
        $('#darker').click();
         //console.log(response);
        // $('#waitingtable'+qid+' > tbody:last').append(response);
        // $('#pageLoading').fadeOut(500);
        
       // alert('I sent it...');
        //show_send_stat(base_url, 0, qid);
      }
    });
}