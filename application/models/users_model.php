<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{ 


  // Получить информаци по пользователю
  function get_user($uid){
     $this->db->where('id', $uid);
     $query = $this->db->get('users_crm');
	   return	$countQ = $query->row();	
  }
  // Получить пользователя по email
  function get_user_by_email($uemail){
     $this->db->where('email', $uemail);
     $this->db->where('ban', 0);
     $query = $this->db->get('users_crm');
     //echo $this->db->last_query();
     return $countQ = $query->row(); 
  }

  // Добавить нового пользователя
  function add_new_user($addArray){
      $this->db->insert('users_crm', $addArray);
      return $this->db->insert_id();
  }

  // Пишем в статистику действий пользователя
  function set_statistic($action, $uid, $state, $thash = '-'){
    $addArray = array(
      'uid'=>$uid,
      'action'=>$action,
      'state'=>$state,
      'atDate'=>date('Y-m-d H:i:s'),
      'Thash'=>$thash);
     $this->db->insert('users_statistics', $addArray);

  }

  // Заменям значение пользователя
  function update_user($uid, $updateArray){
    $this->db->where('id', $uid);
    $this->db->update('users_crm', $updateArray);
  }

  // Вход пользователя
  function get_in($uid, $tHash){
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

      $this->db->where('id', $uid);
      $this->db->update('users_crm', array('isActive'=>1, 'ip'=>$ipaddress, 'fails'=>0, 'activeDate'=>date('Y-m-d H:i:s'), 'Thash'=>md5($tHash.$ipaddress)));

      return $this->db->where('id', $uid)->get('users_crm')->row();
  }

  // Выход пользователя
  function get_out($uid){
      $this->db->where('id', $uid);
      $this->db->update('users_crm', array('isActive'=>0));

  }

  // Неправльная авторизация
  function fail_login($uid, $fails){
      $this->db->where('id', $uid);
      $this->db->update('users_crm', array('fails'=>$fails+1));
      if($fails > 4){
          $this->db->where('id', $uid);  
          $this->db->update('users_crm', array('ban'=>1, 'activeDate'=>date('Y-m-d h:i:s')));
      }
  }


}
