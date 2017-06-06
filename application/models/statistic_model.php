<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistic_model extends CI_Model{ 


  // Получить информаци про историю изменений
  function get_quote_history($qid){
     $this->db->where('qid', $qid);
     $query = $this->db->get('quote_history');
	   return	$countQ = $query->result();	
  }


    // Получаем ип пльзователя
   function get_ip(){
        $ipaddress = '';
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
        return $ipaddress;
    }
 // Добавляем значение в статистику изменений
  function set_quote_statistic($qid, $name, $fromVal, $toVal, $uid, $stype){
      $addArray = array(
        'qid'=>$qid,
        'name'=>$name,
        'fromVal'=>$fromVal,
        'toVal'=>$toVal,
        'uid'=>$uid,
        'atDate'=>date('Y-m-d H:i:s'),
        'ip'=>$this->get_ip(),
        'stype'=>$stype);
      $this->db->insert('quote_history', $addArray);
  }  

  // Получаем статистику для квоты
  function get_quote_statistic($qid){
    $this->db->select('q.*, u.*, q.id as id');
    $this->db->join('users_crm as u', 'u.id = q.uid', 'INNER');
    $this->db->where('q.qid', $qid);
    $this->db->order_by('q.atDate', 'DESC');
    $qhistory = $this->db->get('quote_history as q');
    return $qhistory->result();
  }

  // Отсылается письмо
  function email_send_action($qid, $uid, $action, $type=0){
    $addArray = array(
      'uid'=>$uid,
      'qid'=>$qid,
      'action'=>$action,
      'atDate'=>date('Y-m-d H:i:s'),
      'status'=>0,
      'atype'=>$type,
      'ipaddr'=>$this->get_ip());
    $this->db->insert('actions_statistic', $addArray);
  }

  // Получить все нечитаные action
  function get_not_read_alerts($atype, $Udate = "0000-00-00 00:00:00"){
     $this->db->where('status', 0); 
     $this->db->where('atype', $atype);
     $this->db->where('atDate > ', date('Y-m-d H:i:s', strtotime($Udate))); 
     $this->db->order_by('atDate', 'DESC');  
     $q = $this->db->get('actions_statistic');
     return $q->result();
  }

  // Пометить алерт как прочитаный
  function update_action_as_read($aid){
    $this->db->where('id', $aid);
    $this->db->update('actions_statistic', array('status'=>1));
  }

}
