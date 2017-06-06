<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes_model extends CI_Model{ 


  // Количество в таблице quotes
  function get_quotes_count(){
     $this->db->select('id');
     $query = $this->db->get('quotes');
	 return	$countQ = $query->num_rows();	
  }

  // Получаем список квот
  function get_quotes_page($SORT, $LIMIT, $PAGE = 0){
  		$query = $this->db->query("SELECT q.*,c.*, q.id as id  FROM `quotes` as q  
        LEFT JOIN `users_contact` as c ON c.id = q.contact
        ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
  		return $query;
  }
  // Получаем раздел по ид папки
  function get_parentPart_by_folder($fid){
    $this->db->where('id', $fid);
    $folder = $this->db->get('folders');
   // echo $this->db->last_query();
    return $folder->row()->spart;
  }

  // Количество в таблице quotes
  function get_quotes_part_count($partid){
     $this->db->select('id');
     if($partid != 0)
      $this->db->where('spart', $partid);
     $query = $this->db->get('quotes');
      return $countQ = $query->num_rows(); 
  }

  // Получаем список квот
  function get_quotes_part_page($partid, $SORT, $LIMIT, $PAGE = 0){
      $WHERE = "";
      if($partid != 0)
        $WHERE = " WHERE q.spart='".$partid."'";
      $query = $this->db->query("SELECT q.*,c.* , q.id as id  FROM `quotes` as q  
        LEFT JOIN `users_contact` as c ON c.id = q.contact 
       ".$WHERE." ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
      return $query;
  }  

  // Получаем список квот
  function get_quotes_search_page($name, $value, $SORT, $LIMIT, $PAGE = 0){
      $WHERE = "";
      if($value != "")
        $WHERE = " WHERE ".$name." LIKE '%".$value."%'";
      $query = $this->db->query("SELECT q.*,c.*, q.id as id  FROM `quotes` as q  
        LEFT JOIN `users_contact` as c ON c.id = q.contact 
       ".$WHERE." ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
      return $query;
  }

   // Получаем список квот
  function get_quotes_search_page2($name, $value, $SORT, $LIMIT, $PAGE = 0){
      $WHERE = "";
      if($value != "")
        $WHERE = " WHERE q.id LIKE '%".$value."%' OR c.Email LIKE '%".$value."%' OR c.FirstName LIKE '%".$value."%'";
      $query = $this->db->query("SELECT q.*,c.*, q.id as id  FROM `quotes` as q  
        LEFT JOIN `users_contact` as c ON c.id = q.contact 
       ".$WHERE." ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
      return $query;
  }


  // Получаем список разделов меню и папко
  function get_upmenu(){
    $upmenu = array();
      $statuses = $this->db->get('folders');
      foreach($statuses->result() as $item){
        $upmenu[$item->spart][] = $item;    
      }
      return $upmenu;
  }

  // Подсчет количества внутри разделов
  function count_sum_inside_part(){
    $result[0] = $this->db->select('SUM(count_inside) as count')->where('spart', 0)->get('folders')->row()->count;
    $result[1] = $this->db->select('SUM(count_inside) as count')->where('spart', 1)->get('folders')->row()->count;
    $result[2] = $this->db->select('SUM(count_inside) as count')->where('spart', 2)->get('folders')->row()->count;
    $result[3] = $this->db->select('SUM(count_inside) as count')->where('spart', 3)->get('folders')->row()->count;
    return $result;
  }

  // Перенос квоты в другую папку 
  function update_quote_part($qid, $spart){
    $this->db->where('id', $qid);
    $this->db->update('quotes', array('spart'=>$spart));
  }
  // Замена значения у заявки
  function update_quote($id, $name, $value){
    $this->db->where('id', $id);
    $this->db->update('quotes', array($name=>$value));
  }

  // Замена значения у контакта
  function update_contact($id, $name, $value){
    $this->db->where('id', $id);
    $this->db->update('users_contact', array($name=>$value));
  }

  // Добавление папки к разделу
  function add_second_menu($addArray){
     $this->db->insert('folders', $addArray); 
     return $this->db->insert_id();
  }
  // Получаем ид раздела по ид папки
  function get_part_by_folder_id($fid){
    $this->db->select('spart');
     $this->db->where('id', $fid);
     $q = $this->db->get('folders');
     return $q->row()->spart;
  }

  // Удаление папки из раздела
  function delete_second_menu($did){
     $this->db->where('id', $did);
     $this->db->delete('folders');
  }

  // Пересчитываем количество квот внутри папки
  function recount_inside_parts($partId){
    $this->db->select('COUNT(id) as count');
    $this->db->where('spart', $partId);
    $count = $this->db->get('quotes')->row()->count;

    $chArray = array('count_inside'=>$count);
    $this->db->where('id', $partId);
    $this->db->update('folders', $chArray);

    return $count;
  }

  // Получаем список всех папок для селекта
  function get_all_folders(){
    $this->db->select('*, sname as name');
    $this->db->where('spart <', '100');
    $this->db->order_by('sname', 'ASC');
    $q = $this->db->get('folders');
    return $q->result();
  }

  // Получаем список разделов ид-название-корневой раздел
  function get_folders_names(){
    $sPartsNames = array( "0" => "Leads", "1"=>"Quotes", "2"=>"Orders", "3"=>"Archive");
    $query = $this->db->get('folders');
    $result = array();
    $result[0] = (object) array('name'=>"No folder", 'spart'=>"No part");
    foreach($query->result() as $item){
      if($item->spart < 100)
      $result[$item->id] = (object) array("name"=>$item->sname, "spart"=>$sPartsNames[$item->spart]); 
    }
    return $result;
  }

  // получение названия папки по ид
  function get_folder_name_by_id($fid){
    $this->db->where('id', $fid);
    $q = $this->db->get('folders');
    return $q->row()->sname;
  }

  // получаем ид папки из ордеров по имени
  function get_order_folder_by_name($fname){
    $this->db->where('sname', $fname);
    $this->db->where('spart', 2);
    $q = $this->db->get('folders');
    if($q->num_rows() > 0){
        return $q->row()->id;  
    }else{
        return 0;
    }
    
  }

  // получаем все просроченые на CD ордеры
  function get_expire_orders(){
    $this->db->where('CDpostDate >', '0000-00-00 00:00:00');
    $this->db->where('AvailPicDate <', date('Y-m-d H:i:s', (time()+345600)) );
    $q = $this->db->get('quote_order');
    return $q->row();
  }

  // Устанавливаем значение даты поста на CD
  function set_order_as_posted_on_CD($qid){
    $this->db->where('qid', $qid);
    $this->db->update('quote_order', array('CDpostDate', date('Y-m-d H:i:s')));
  }

  // Плучаем квоту по ид
  function get_quote_by_id($qid){
    $this->db->select('q.*, c.*, , q.id as id');
    $this->db->from('quotes as q');
    $this->db->join('users_contact as c', 'c.id = q.contact', 'LEFT');  
    $this->db->where('q.id', $qid);
    $this->db->limit(1);
    return $this->db->get()->row();  
  }

  // Получаем полную информацию по квоте
  function get_quote_by_id_full($qid){
    $this->db->select('q.*, c.*, i.* , q.id as id');
    $this->db->from('quotes as q');
    $this->db->join('users_contact as c', 'c.id = q.contact', 'LEFT');  
    $this->db->join('quote_info as i', 'i.qid = q.id', 'LEFT');  
    $this->db->where('q.id', $qid);
    $this->db->limit(1);
    return $this->db->get()->row(); 
  }


  // Получаем информацию по ордеру
  function get_quote_order_by_id($qid){
    $this->db->select('q.*, c.*, o.*, 
      pc.Addr_street as pAddrStreet, 
      pc.Addr_city as pAddrCity, 
      pc.Addr_state as pAddrState, 
      pc.Addr_zip as pAddrZip, 
      pc.Addr_country as pAddrCountry, 
      pc.FirstName as pFname, 
      pc.Company as pCompany, 
      pc.Phone as pPhone, 
      pc.Phone2 as pPhone2, 
      pc.Phone3 as pPhone3, 
      pc.Mobile as pMobile, 
      dc.Addr_street as dAddrStreet, 
      dc.Addr_city as dAddrCity, 
      dc.Addr_state as dAddrState, 
      dc.Addr_zip as dAddrZip, 
      dc.Addr_country as dAddrCountry, 
      dc.FirstName as dFname, 
      dc.Company as dCompany, 
      dc.Email as dEmail, 
      dc.Phone as dPhone, 
      dc.Phone2 as dPhone2, 
      dc.Mobile as dMobile, 
      dc.Fax as dFax,
      q.id as id');
    $this->db->from('quotes as q');
    $this->db->join('quote_order as o', 'o.qid = q.id', 'LEFT');
    $this->db->join('users_contact as c', 'c.id = q.contact', 'LEFT');  
    $this->db->join('users_contact as pc', 'pc.id = o.Pcontact', 'LEFT');  
    $this->db->join('users_contact as dc', 'dc.id = o.Dcontact', 'LEFT'); 
    $this->db->where('q.id', $qid);
    $this->db->limit(1);
    return $this->db->get()->row();
  }

  // Редактирование контакта квоты
  function update_users_contact($persid, $chArray){
    $this->db->select('id');
    $this->db->from('users_contact');
    $this->db->where('id', $persid);
    $q = $this->db->get();
    if($q->num_rows() > 0){
      $this->db->where('id', $persid);
      $this->db->update('users_contact', $chArray);
    }else{
      $this->db->insert('users_contact', $chArray);
       $persid = $this->db->insert_id();
    }
    return $persid;
  }

  // Редактирование квоты
  function update_quote_full($qid, $chArray){
    if($qid == 0){
      $this->db->insert('quotes', $chArray);
      return $this->db->insert_id();  
    }else{
      $this->db->where('id', $qid);
      $this->db->update('quotes', $chArray);
    }
  }

  // Редактрова внутреней информации квоты
  function update_quote_info($qid, $chArray){
    $this->db->select('qid');
    $this->db->from('quote_info');
    $this->db->where('qid', $qid);
    $q = $this->db->get();

    if($q->num_rows() > 0){
      $this->db->where('qid', $qid);
      $this->db->update('quote_info', $chArray);
    }else{
      $this->db->insert('quote_info', $chArray);
    }
  }

  // Редактирование ордера
  function update_quote_order($qid, $chArray){
    $this->db->select('qid');
    $this->db->from('quote_order');
    $this->db->where('qid', $qid);
    $q = $this->db->get();

    if($q->num_rows() > 0){
       $this->db->where('qid', $qid);
       $this->db->update('quote_order', $chArray);
    }else{
       $this->db->insert('quote_order', $chArray);
    }
  }
  // Получить количество нотайсов для квоты
  function get_count_notices($qid){
    $this->db->where('qid', $qid);
    $q = $this->db->get('quote_notice');
   // echo $this->db->last_query();
    return $q->num_rows();
  }

  // Получить нотайсы для квоты
  function get_notices($qid){
    $this->db->select('n.*, u.email as uname');
    $this->db->join('users_crm as u', ' n.uid=u.id', 'LEFT');
    $this->db->where('n.qid', $qid);
   $this->db->order_by('id', 'DESC');
    $q = $this->db->get('quote_notice as n');
    return $q->result();
  }

  function add_notice($addArray){
    $this->db->insert('quote_notice', $addArray);
  }
/*
  // Получение информации из ордера
  function get_quote_order_by_id($qid){
    $this->db->where('qid', $qid);
    $q = $this->db->get('quote_order', 1);
    return $q->row();
  }
*/
  // Прописываем строки в табилцу инфо для всех записей квот 
  function add_info_rows_to_quotes(){
    $this->db->select('id');
    $this->db->from('quotes');
    $quotes = $this->db->get();

    foreach($quotes->result() as $item){
      $this->db->select('qid');
      $this->db->from('quote_info');
      $this->db->where('qid', $item->id);
      $qi = $this->db->get();
    
      if($qi->num_rows() == 0){
        $addArray = array(
          'qid'=>$item->id,
          'vechinesRun'=>0,
          'shipVia'=>0,
          'shipperNote'=>"-"
          );
        $this->db->insert('quote_info', $addArray);
      }

    }
    
  }

  // Получаем статистику для верхнего блока
  function get_statistic_info($fid, $type = 0){

    $this->db->select('COUNT(DISTINCT qid) as icount');
    $this->db->where('name', 'MoveTo');
    $this->db->where('toVal', $fid);
    if($fid == 75){
      $this->db->or_where('toVal', '74');
    }
    $q = $this->db->get('quote_history');
   // echo $this->db->last_query();
    return $q->row()->icount;
  }

  // Получаем количество квот
  function get_count_quotes($type = 0){
    $this->db->select('COUNT(id) as icount');
   $this->db->where('id <>', '0');
    $q = $this->db->get('quotes');
    return $q->row()->icount;
  }

  // Получаем суммы всех цыфер по количеству рассылок
  function getG_sent_statistic(){
    $this->db->select('SUM(emailsSent) as countSent , SUM(emailsOpened) as countOpened, SUM(emailsRecived) as countRecived, SUM(emailsWait) as countWaiting');
    $q = $this->db->get('quotes');
    return $q->row();  
  }

  //do churge
  function docharge($qid, $churged){
    $this->db->where('qid', $qid);
    $this->db->update('quote_order', array('charged'=>$churged));
  }

  // get charged sum
  function get_global_orders_sum(){
    $this->db->select('SUM(q.price) as price');
    $this->db->join('quote_order as qo', 'q.id = qo.qid', 'INNER');
    $query = $this->db->get('quotes as q');
    return $query->row()->price;
  }

  // get chargered sum
  function get_chargered_sum(){
    $this->db->select('SUM(charged) as charged');
    $query = $this->db->get('quote_order');
    return $query->row()->charged;
  }

}
