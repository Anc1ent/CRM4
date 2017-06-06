<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails_model extends CI_Model{ 


  // Количество в таблице emails
  function get_emails_count(){
     $this->db->select('id');
     $query = $this->db->get('emails');
	   return	$countQ = $query->num_rows();	
  }

  // Список всех писем
  function get_all_emails($type){
    $this->db->where('etype', $type);
    $this->db->order_by('sendAfterPrev', 'ASC');
    $query = $this->db->get('emails');
    return $query->result();
  }

   // Список всех писем их очереди для папки
  function get_all_emails_list($type){
    $this->db->select('e.*, l.*');
    $this->db->join('emails as e', 'e.id=l.eid', 'INNER');
    $this->db->where('l.fid', $type);
    $this->db->order_by('l.sendAfterPrev', 'ASC');
    $query = $this->db->get('emails_lists as l');
    return $query->result();
  }

   // Список всех писем
  function get_all_emails_full(){
    //$this->db->order_by('sendAfterPrev', 'ASC');
    $this->db->where('etype', '0');
    $this->db->order_by('id','DESC');
    $query = $this->db->get('emails');
    return $query->result();
  }

  // получаем ожитающее письмо по ид
  function get_wemail_by_id($id){
      $this->db->where('id', $id);
      $q = $this->db->get('emails_waiting');
      return $q->row();
  }

 

  // получить список писем которые нужно разослать
  function get_all_waiting_email(){
    $this->db->where('sendAtDate <', date('Y-m-d H:i:s'));
    $ew = $this->db->get('emails_waiting');
    return $ew->result();
  }

  // Список всех писем
  function get_all_emails_names(){
    $this->db->select('name, id');
    $this->db->where('etype', '0');
    $this->db->order_by('name', 'ASC');
    $query = $this->db->get('emails');
    return $query->result();
  }  

  // Список всех писем
  function get_drivers_emails_names(){
    $this->db->select('name, id');
    $this->db->where('etype', '0');
    $this->db->order_by('name', 'ASC');
    $query = $this->db->get('drivers_emails');
    return $query->result();
  } 
  
  // Список отправленых писем
  function get_sended_stat($qid){
    $this->db->select('e.*, s.*');
    $this->db->from('emails_sended as s');
    $this->db->join('emails as e', 'e.id = s.eid', 'LEFT');
    $this->db->where('s.qid', $qid);
    $this->db->order_by('atDate', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

   // Список отправленых писем
  function get_drivers_sended_stat($qid){
    $this->db->select('e.*, s.*');
    $this->db->from('drivers_emails_sended as s');
    $this->db->join('drivers_emails as e', 'e.id = s.eid', 'LEFT');
    $this->db->where('s.qid', $qid);
    $this->db->order_by('atDate', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Список полученых писем
  function get_recived_stat($qid){
    $this->db->select('*');
    $this->db->from('emails_recived');
    $this->db->where('qid', $qid);
    $this->db->order_by('atDate', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Список полученых писем
  function get_drivers_recived_stat($qid){
    $this->db->select('*');
    $this->db->from('drivers_emails_recived');
    $this->db->where('qid', $qid);
    $this->db->order_by('atDate', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Получаем список шалонов для водителей 
  function get_drivers_shablons(){
     $this->db->where('sendToDriver', 1);
     $q = $this->db->get('emails');
     return $q->result(); 
  }

  // Список полученых писем
  function get_waiting_stat($qid){
     $this->db->select('e.*, s.*');
    $this->db->from('emails_waiting as s');
    $this->db->join('emails as e', 'e.id = s.eid', 'LEFT');
    $this->db->where('s.qid', $qid);
    $this->db->order_by('atDate', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Добавление в процесс рассылки с задержкой
  function add_to_send_process($addArray){
    $this->db->insert('emails_waiting', $addArray);
    $nid = $this->db->insert_id();
    $this->db->where('id', $addArray['qid']);
    $q = $this->db->get('quotes');
    $this->db->where('id', $addArray['qid']);
    $this->db->update('quotes', array('emailsWait'=>($q->row()->emailsWait+1)));
    return $nid;
  }
  // Получит информациюпро писмо по ид
  function get_email_by_id($eid){
    $this->db->where('id', $eid);
    return $this->db->get('emails')->row();
  }

   // Получит информациюпро писмо водителю по ид
  function get_drivers_email_by_id($eid){
    $this->db->where('id', $eid);
    return $this->db->get('drivers_emails')->row();
  }

  // Добавляем письмо к рассылку
  function add_emails_to_list($eid, $fid){
    $addArray = array('eid'=>$eid, 'fid'=>$fid);
    $this->db->insert('emails_lists', $addArray);

    $this->db->where('id', $this->db->insert_id());
    $elist = $this->db->get('emails_lists')->row();
    return $elist;
  }

  // Прописываем значение в шаблон письма
  function update_email_values($emailText, $quote){
    if($quote->shipVia == 0){
      $shipVia = "Open";
    }else if($quote->shipVia == 1){
      $shipVia = "Enclosed";
    }else if($quote->shipVia == 2){
      $shipVia = "Flat Bed Transport";
    }else if($quote->shipVia == 3){
      $shipVia = "Other";
    }

    if($quote->vechinesRun == 0){
      $vechinesRun = "Run";
    }else{
      $vechinesRun = "INOP";
    }

    $this->db->where('id', $quote->driverid);
    $driver = $this->db->get('drivers')->row();
    if(!isset($driver->name)) $driver = new stdClass();
    if(!isset($quote->dPhone3)) $quote->dPhone3 = "none";
    if(!isset($driver->name)) $driver->name = "none";
    if(!isset($driver->phone)) $driver->phone = "none";
    if(!isset($driver->mobile)) $driver->mobile = "none";
    if(!isset($driver->phone2)) $driver->phone2 = "none";
    $chArray = array(
      '[quote_number]'=>str_pad($quote->id, 5,"0",STR_PAD_LEFT),
      '[order_number]'=>str_pad($quote->id, 5,"0",STR_PAD_LEFT),
      '[first_name]'=>trim($quote->FirstName),
      '[origin_state_code]'=>trim($quote->distFromState),
      '[destination_state_code]'=>trim($quote->distToState),
      '[vehicle_list]'=>trim($quote->carYear)." ".trim($quote->carMake)." ".trim($quote->carModel),
      '[ship_via]'=>trim($shipVia),
      '[operable_inop]'=>trim($vechinesRun),
      '[estimated_load_date]'=>date('m/d/Y', strtotime($quote->LoadDate)),
      '[estimated_delivery_date]'=>date('m/d/Y', strtotime($quote->DeliveryDate)),
      '[deposit_required]'=>$quote->deposit,
      '[pickup_contact]'=>trim($quote->pFname),
      '[pickup_phone]'=>trim($quote->pPhone),
      '[pickup_phone2]'=>trim($quote->pPhone2),
      '[pickup_phone3]'=>trim($quote->pPhone3),
      '[pickup_phone_cell]'=>trim($quote->pMobile),
      '[pickup_address]'=>trim($quote->pAddrStreet),
      '[pickup_city]'=>trim($quote->pAddrCity),
      '[pickup_state_code]'=>trim($quote->pAddrState),
      '[dropoff_contact]'=>trim($quote->dFname),
      '[dropoff_phone]'=>trim($quote->dPhone),
      '[dropoff_phone2]'=>trim($quote->dPhone2),
      '[dropoff_phone3]'=>trim($quote->dPhone3),
      '[dropoff_phone_cell]'=>trim($quote->dMobile),
      '[dropoff_address]'=>trim($quote->dAddrStreet),
      '[dropoff_city]'=>trim($quote->dAddrCity),
      '[dropoff_state_code]'=>trim($quote->dAddrState),
      '[note_to_shipper]'=>trim($quote->forShipperNotes),
      '[u_name]'=>"Mike Lowell",
      '[cod_amount]'=>trim($quote->CarrierPay),
      '[first_pickup_date]'=>date('m/d/Y', strtotime($quote->LoadDate)),
      '[tariff]'=>($quote->price+$quote->deposit),
      '[phone]'=>trim($quote->Phone),
      '[vehicle_make]'=>trim($quote->carMake),
      '[vehicle_model]'=>trim($quote->carModel),
      '[origin_city]'=>trim($quote->distFromCity),
      '[destination_city]'=>trim($quote->distToCity),
      '[estimated_ship_date]'=>date('m/d/Y', strtotime($quote->arriveDate)),
      '[EID]'=>$quote->id,
      '[Qid]'=>$quote->id,
      '[Eid]'=>$quote->id,
      '[carrier_name]'=>trim($driver->name),
      '[carrier_phone1]'=>trim($driver->phone),
      '[driver_phone]'=>trim($driver->mobile),
      '[carrier_phone2]'=>trim($driver->phone2),
      '[token]'=>md5($quote->Email.$quote->id)
      );

    return str_replace(array_keys($chArray), $chArray,$emailText);

  }

  // Удаляем письмо из списка ожидающих рассылки
  function delete_email_from_waiting($did){
    $this->db->where('id', $did);
    $ew = $this->db->get('emails_waiting')->row();

    $this->db->where('id', $did);
    $this->db->delete('emails_waiting');
    $this->db->last_query();
    


    $this->db->where('id', $ew->qid);
    $q = $this->db->get('quotes');
    $this->db->where('id', $ew->qid);
    $this->db->update('quotes', array('emailsWait'=>($q->row()->emailsWait-1)));
    
  }

  // Отмечаем как прочитаное письмо
  function chEmailstatus($eid){
    $this->db->where('id', $eid);
    $this->db->update('emails_sended', array('status'=>1));
  }

  // Добавляем полученое писмо в ответы у квот
 function add_email_to_recived($emailFrom, $text, $subject, $message_id){
    $this->db->where('Email', $emailFrom);
    $contacts = $this->db->get('users_contact');
    $count = 0;
    foreach($contacts->result() as $contact){
      //print_r($contact);
      $count++;   
      $this->db->where('contact', $contact->id);
      $quote = $this->db->get('quotes');
      $quotes = $quote->result();
      $returned = array();
      foreach($quotes as $quote){
        $qid = $quote->id;
        $returned[] = $qid;
        $addArray = array(
          'subject'=>$subject,
          'text'=>$text,
          'qid'=>$qid,
          'from_email'=>$emailFrom,
          'atDate'=>date('Y-m-d H:i:s'),
          'message_id'=>$message_id
          );
          $this->db->insert('emails_recived', $addArray);
        
          $this->db->where('id', $qid);
          $this->db->update('quotes', array('emailsRecived'=>($quote->emailsRecived+1)));
        
      }

      if($count == 0){
        return 0;
      }
      
    }
    return $returned;

    
 }

 // Отметить полученое письмо как прочитаное
 function update_emails_to_read($REid){
  // $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    $this->db->where('id', $REid);
    $this->db->update('emails_recived', array('status'=>1));
 }

// Удаление полученогописьма
 function delete_recived_email($did){
    
     $this->db->where('id', $did);
    $Remail = $this->db->get('emails_recived')->row();

    $this->db->where('id', $Remail->qid);
    $q = $this->db->get('quotes')->row();

    $this->db->where('id', $Remail->qid);
    $this->db->update('quotes', array('emailsRecived'=>($q->emailsRecived-1)));
 
    $this->db->where('id', $did);
    $this->db->delete('emails_recived');
    
 }


  // Перемещем письмо в отправленные
  function update_email_us_sent($eid){
    $this->db->where('id', $eid);
    $ew = $this->db->get('emails_waiting')->row();
        
    $addArray = array(
      'qid'=>$ew->qid,
      'status'=>0,
      'atDate'=>date('Y-m-d H:i:s'),
      'eid'=>$ew->eid,
      'specEmail'=>$ew->specEmail
      );  

    $this->db->insert('emails_sended', $addArray);
    $nid = $this->db->insert_id();

    $this->db->where('id', $ew->qid);
    $q = $this->db->get('quotes');
    $this->db->where('id', $ew->qid);
    $this->db->update('quotes', array('emailsSent'=>($q->row()->emailsSent+1)));
    return $nid;

  } 

 // Остановить рассылку
  function stop_all_waiting_emails($qid){
    $this->db->where('qid', $qid);
    $this->db->update('emails_waiting', array('status'=>'1'));
  }

  // Формирование спика расылки для раздела
  public function add_mails_waiting($qid, $folder){

      $emails = $this->get_all_emails_list($folder);

      foreach($emails as $email){
      
      $emailInfo = $this->get_email_by_id($email->eid);
      //$date = $this->input->post('date');

      $addArray = array(
        'eid'=>$email->eid,
        'qid'=>$qid,
        'atDate'=>date('Y-m-d H:i:s'),
        'sendAtDate'=>date('Y-m-d H:i:s', (time()+$email->sendAfterPrev))
      );

      $newid = $this->add_to_send_process($addArray);
      
      $CI =& get_instance();
      $CI->load->model('statistic_model', 'statistic');
      $CI->statistic->email_send_action($qid, '0', "ADD EMAIL TO SEND (".$emailInfo->name.")");
    
    }




  }
  // Получаем список для статистики по рассылке
  function get_all_waiting_stat(){
    $this->db->select('e.qid as qid, e.atDate as eatDate, e.eid as eid, q.*, em.name as ename');
    $this->db->join('quotes as q', 'e.qid = q.id', 'INNER');
    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_waiting as  e');
    return $q->result();
  }

  // Получаем список для статистики по рассылке
  function get_all_sended_stat(){
    $this->db->select('e.qid as qid, e.atDate as eatDate, e.eid as eid, q.*, em.name as ename');
    $this->db->join('quotes as q', 'e.qid = q.id', 'INNER');
    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_sended as  e');
    return $q->result();
  }

 
  // Получаем список для статистики по рассылке
  function get_all_opened_stat(){
    $this->db->select('e.qid as qid, e.id as esid, e.openedDate as eatDate, e.eid as eid, q.*, em.name as ename');
    $this->db->join('quotes as q', 'e.qid = q.id', 'INNER');
    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->where('e.status', '1');
    $this->db->where('e.viewit', '0');
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_sended as  e');
    return $q->result();
  }

  // Получаем список для статистики по рассылке
  function get_all_recived_stat(){
    $this->db->select('e.qid as qid, e.status as status,  e.atDate as eatDate, q.*, e.subject as ename');
    $this->db->join('quotes as q', 'e.qid = q.id', 'INNER');
    //$this->db->where('e.status', '1');
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_recived as  e');
    //echo $this->db->last_query();
    return $q->result();
  }

  



  // Получаем список для статистики по рассылке
  function get_waiting_stat_($qid){
    $this->db->select('e.atDate as eatDate, e.eid as eid, em.name as ename');
    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->where('e.qid', $qid);
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_waiting as  e');
    return $q->result();
  }

  // Получаем список для статистики по рассылке
  function get_sended_stat_($qid){
    $this->db->select(' e.atDate as eatDate, e.eid as eid,  em.name as ename');

    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->where('e.qid', $qid);
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_sended as  e');
    return $q->result();
  }

  // Получаем список для статистики по рассылке
  function get_opened_stat_($qid){
    $this->db->select(' e.openedDate as eatDate, e.eid as eid, em.name as ename');
    $this->db->join('emails as em', 'em.id = e.eid', 'INNER');
    $this->db->where('e.status', '1');
    $this->db->where('e.qid', $qid);
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_sended as  e');
    return $q->result();
  }

  // Получаем список для статистики по рассылке
  function get_recived_stat_($qid){
    $this->db->select(' e.atDate as eatDate,  e.subject as ename');
    $this->db->where('e.qid', $qid);
    $this->db->order_by('e.id', 'DESC');
    $q = $this->db->get('emails_recived as  e');
    return $q->result();
  }


  // Получаем данные для статистики форм
  function get_stat_forms($formid){
    $this->db->select('f.*, q.*, f.id as id');
    $this->db->join('quotes as q', 'f.qid = q.id', 'LEFT');
    $this->db->where('f.formid', $formid);
    $this->db->order_by('f.id', 'DESC');
    $q = $this->db->get('forms_data as f'); 
    return $q->result();
  }

  // Получаем цыфры для стаистики форм
  function get_forms_count($formid){
    $this->db->select('COUNT(id) as icount');
    $this->db->where('formid', $formid);
    $q = $this->db->get('forms_data');
    $res = $q->row();
    if(isset($q->row()->icount)){
        return $q->row()->icount; 
    }else{
          return 0;
    }
  }

  // Отмечаем как просмотреное уведомление об открытии письма
  function update_open_as_read($eid){
    $this->db->where('id', $eid);
    $this->db->update('emails_sended', array('viewit'=>1));
  }

   // [ANCADD]
    function get_all_sms_full(){
        //$this->db->order_by('sendAfterPrev', 'ASC');
        $this->db->where('etype', '0');
        $this->db->order_by('id','DESC');
        $query = $this->db->get('sms');
        return $query->result();
    }

  //[ANCADD]
function delete_email_form_wating($wid)
{
    $this->db->where('id', $wid);
    $this->db->delete('emails_waiting');
}

  // [ANCADD]
    function get_all_sms_names(){
        $this->db->select('name, id');
        $this->db->where('etype', '0');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('sms');
        return $query->result();
    }

     //[ANCADD]
    function get_sended_sms_stat($qid){

        $this->db->select('sms.*, sms_sended.*');
        $this->db->from('sms_sended');
        $this->db->join('sms', 'sms.id = sms_sended.sms_id', 'LEFT');
        $this->db->where('sms_sended.qid', $qid);
        $this->db->order_by('atDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

     // [ANCADD]
    function get_recived_sms_stat($qid){
        $this->db->select('sms_recived.*');
        $this->db->from('sms_recived');
        $this->db->where('qid', $qid);
        $this->db->order_by('atDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

     // [ANCADD]
    function get_waiting_sms_stat($qid){
        $this->db->select('sms.name, sms.subject, sms.text, sms.etype, sms.OnlyInworkTime, sms_waiting.*');
        $this->db->from('sms_waiting');
        $this->db->join('sms', 'sms.id = sms_waiting.sms_id', 'LEFT');
        $this->db->where('sms_waiting.qid', $qid);
        $this->db->order_by('atDate', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // [ANCADD]
    function add_sms_to_send_process($addArray){
        $this->db->insert('sms_waiting', $addArray);
        $nid = $this->db->insert_id();
        //$this->db->where('id', $addArray['qid']);
        //$q = $this->db->get('quotes');
        //$this->db->where('id', $addArray['qid']);
        //$this->db->update('quotes', array('emailsWait'=>($q->row()->emailsWait+1)));
        return $nid;
    }

// [ANCADD]
    function get_sms_by_id($smsid){
        $this->db->where('id', $smsid);
        return $this->db->get('sms')->row();
    }

    //[ANCADD]
function delete_SMS_from_waiting($wsms_id){
    $this->db->where('id', $wsms_id);
    $ew = $this->db->get('sms_waiting')->row();

    $this->db->where('id', $wsms_id);
    $this->db->delete('sms_waiting');

    //$this->db->where('id', $ew->qid);
    //$q = $this->db->get('quotes');

    //$this->db->where('id', $ew->qid);
    //$this->db->update('quotes', array('emailsWait'=>($q->row()->emailsWait-1)));
}

// [ANCADD]
function update_sms_to_read($REid){
/*    // $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    $this->db->where('id', $REid);
    $this->db->update('emails_recived', array('status'=>1));
*/
}

 




}
