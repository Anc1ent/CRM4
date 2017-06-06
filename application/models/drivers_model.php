<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drivers_model extends CI_Model{ 


  // Количество в таблице quotes
  function get_drivers_count(){
     $this->db->select('id');
     $query = $this->db->get('drivers');
	 return	$countQ = $query->num_rows();	
  }

  // Получаем список квот
  function get_drivers_page($SORT, $LIMIT, $PAGE = 0){
  		$query = $this->db->query("SELECT * FROM `drivers` ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
  		return $query;
  }

  // Количество в таблице quotes
  function get_drivers_part_count($partid){
     $this->db->select('id');
     if($partid != 0)
      $this->db->where('spart', $partid);
     $query = $this->db->get('drivers');
   return $countQ = $query->num_rows(); 
  }

  // Получаем список квот
  function get_drivers_part_page($partid, $SORT, $LIMIT, $PAGE = 0){
      $WHERE = "";
      if($partid != 0)
        $WHERE = " WHERE `spart`='".$partid."'";
      $query = $this->db->query("SELECT * FROM `drivers` ".$WHERE." ".$SORT." LIMIT ".$PAGE.", ".$LIMIT);
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
    $result[100] = $this->db->select('SUM(count_inside) as count')->where('spart', 100)->get('folders')->row()->count;
    $result[101] = $this->db->select('SUM(count_inside) as count')->where('spart', 101)->get('folders')->row()->count;
    $result[102] = $this->db->select('SUM(count_inside) as count')->where('spart', 102)->get('folders')->row()->count;
    $result[103] = $this->db->select('SUM(count_inside) as count')->where('spart', 103)->get('folders')->row()->count;
    return $result;
  }

  // Перенос квоты в другую папку 
  function update_driver_part($qid, $spart){
    $this->db->where('id', $qid);
    $this->db->update('drivers', array('spart'=>$spart));
  }

  // Добавление папки к разделу
  function add_second_menu($addArray){
     $this->db->insert('folders', $addArray); 
     return $this->db->insert_id();
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
    $count = $this->db->get('drivers')->row()->count;

    $chArray = array('count_inside'=>$count);
    $this->db->where('id', $partId);
    $this->db->update('folders', $chArray);

    return $count;
  }

  // Получаем список разделов ид-название-корневой раздел
  function get_folders_names(){
    $sPartsNames = array( "100" => "New", "101"=>"Processed", "102"=>"Worked", "103"=>"Archive");
    $query = $this->db->get('folders');
    $result = array();
    $result[0] = (object) array('name'=>"No folder", 'spart'=>"No part");
    //foreach($query->result() as $item){
    //  $result[$item->id] = (object) array("name"=>$item->sname, "spart"=>$sPartsNames[$item->spart]); 
    //}
    return $result;
  }
  // Плучаем квоту по ид
  function get_driver_by_id($qid){
    $this->db->where('id', $qid);
    return $this->db->get('drivers', 1)->row();  
  }

  // Редактирование водителя
  function update_driver($qid, $chArray){
    if($qid != 0){
      $this->db->where('id', $qid);
      $this->db->update('drivers' , $chArray);
    }else{
      $this->db->insert('drivers', $chArray);
      $qid = $this->db->insert_id();
    }
    return $qid;
  }

  // Поиск водителя
  function get_drivers($fromState, $toState){
      /* Изначальный код--------------------------
      $this->db->select('d.*, d2.*, d.id as id');
    $this->db->from('drivers_prices as d');
    $this->db->join('drivers as d2', 'd.driver_id = d2.id', 'INNER');

    $where = "(d.from_state='".trim($fromState)."' AND d.to_state='".trim($toState)."') OR (d.from_state='".trim($toState)."' AND d.to_state='".trim($fromState)."')";

    $this->db->where($where);
    //$this->db->where('d.from_state', trim($fromState));
    //$this->db->where('d.to_state', trim($toState));



    $this->db->order_by('d.atDate', 'DESC');

    $drivers = $this->db->get();
    
    //echo $this->db->last_query();
    //  print_r($drivers->result());
   //   exit(); [driver_id]
    return $drivers->result();
      ---------------------------------------------------------*/
      $drivers = $this->db->query("select d.*, d2.*, d.id as id, drivers_favorites.users_crm_id, drivers_favorites.drivers_id as drivers_id_f
from drivers_prices as d
INNER join drivers as d2 ON d.driver_id = d2.id
left outer join drivers_favorites on d2.id = drivers_favorites.drivers_id
where (d.from_state=? AND d.to_state=?) OR (d.from_state=? AND d.to_state=?)
order by d.atDate DESC", array($fromState, $toState, $toState, $fromState));
      return $drivers->result();

  }

//Поиск Локальных компаний + сортировка
  function get_drivers_local($fromState, $toState, $user, $sorting)
  {
   /* Изначальный скрипт. Выбирает все компании
        $this->db->select('drivers.*')
          ->from('drivers')
          ->where('drivers.addrState', $fromState)
          ->where('drivers.dType', "Carrier");
      $drivers = $this->db->get();
      return $drivers->result();
   ------------------------------------------------------------------------------*/
      if($sorting=="Origin") {
         $drivers = $this->db->query("SELECT *
FROM(
(select 1 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id = drivers.id
where drivers.dType = 'Carrier' AND drivers_favorites.users_crm_id = ? AND (drivers.addrState = ? OR drivers.addrState = ?))
UNION
(select 2 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id=drivers.id AND drivers_favorites.users_crm_id<>?
where drivers.dType = 'Carrier' AND drivers.addrState = ?)
UNION
(select 3 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id=drivers.id AND drivers_favorites.users_crm_id<>?
where drivers.dType = 'Carrier' AND drivers.addrState = ?)
) AS t1
GROUP By t1.id
order by rank, id", array($user->id, $fromState, $toState, $user->id, $fromState, $user->id, $toState));
      }
      else{
          $drivers = $this->db->query("SELECT *
FROM(
(select 1 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id = drivers.id
where drivers.dType = 'Carrier' AND drivers_favorites.users_crm_id = ? AND (drivers.addrState = ? OR drivers.addrState = ?))
UNION
(select 2 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id=drivers.id AND drivers_favorites.users_crm_id<>?
where drivers.dType = 'Carrier' AND drivers.addrState = ?)
UNION
(select 3 as rank, drivers.*, drivers_favorites.drivers_id
from drivers
left outer join drivers_favorites on drivers_favorites.drivers_id=drivers.id AND drivers_favorites.users_crm_id<>?
where drivers.dType = 'Carrier' AND drivers.addrState = ?)
) AS t1
GROUP By t1.id
order by rank, id", array($user->id, $fromState, $toState, $user->id, $toState, $user->id, $fromState));
      }
      return $drivers->result();
  }

    //Поиск Фаворайтов
    function get_drivers_favorite($user)
    {

        $this->db->select('drivers.*, drivers_favorites.drivers_id, drivers_favorites.datetime')
            ->from('drivers')
            ->join('drivers_favorites', 'drivers.id = drivers_favorites.drivers_id AND drivers_favorites.users_crm_id = ' . $user->id, 'left')
            ->where('drivers.dType', "Carrier")
            ->where('drivers_favorites.users_crm_id', $user->id)
            ->order_by('drivers_favorites.datetime', 'desc');
        $drivers = $this->db->get();
        return $drivers->result();
    }

  // Списко водителей по имени
  function get_drivers_by_name_like($dname){
    $this->db->where('dtype', 'Carrier');
    $this->db->like('name', $dname, 'after');

    $query = $this->db->get('drivers');
    return $query->result();
  }

   // Список всех писем
  function get_all_emails_full(){
    //$this->db->order_by('sendAfterPrev', 'ASC');
    $this->db->where('etype', '0');
    $this->db->order_by('id','DESC');
    $query = $this->db->get('drivers_emails');
    return $query->result();
  }

  // Добавляем писмо в отправленые
  function add_to_send($driver_id, $eid, $specEmail, $quote_id){
     $addArray = array(
      'qid'=>$driver_id,
      'status'=>0,
      'atDate'=>date('Y-m-d H:i:s'),
      'eid'=>$eid,
      'specEmail'=>$specEmail,
      'quote_id'=>$quote_id
      );  

    $this->db->insert('drivers_emails_sended', $addArray);
    $nid = $this->db->insert_id();

    $this->db->where('id', $driver_id);
    $q = $this->db->get('drivers');
    $this->db->where('id', $driver_id);
    $this->db->update('drivers', array('emailsSent'=>($q->row()->emailsSent+1)));

    return $nid;
  }

  // Прописываем значение в шаблон письма
  function update_email_values($emailText, $quote, $driver_name, $driver_id){

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

    //$this->db->where('id', $quote->driverid);
    //$driver = $this->db->get('drivers')->row();
    //print_r($driver);  
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
     // '[pickup_phone3]'=>trim($quote->pPhone3),
      '[pickup_phone_cell]'=>trim($quote->pMobile),
      '[pickup_address]'=>trim($quote->pAddrStreet),
      '[pickup_city]'=>trim($quote->pAddrCity),
      '[pickup_state_code]'=>trim($quote->pAddrState),
      '[dropoff_contact]'=>trim($quote->dFname),
      '[dropoff_phone]'=>trim($quote->dPhone),
      '[dropoff_phone2]'=>trim($quote->dPhone2),
     // '[dropoff_phone3]'=>trim($quote->dPhone3),
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
      '[driver_id]'=>$driver_id,
      //'[carrier_name]'=>trim($driver->name),
     // '[carrier_phone1]'=>trim($driver->phone),
     // '[driver_phone]'=>trim($driver->mobile),
     // '[carrier_phone2]'=>trim($driver->phone2),
      '[token]'=>md5($quote->Email.$quote->id),
      '[driver_name]'=>$driver_name
      );

    return str_replace(array_keys($chArray), $chArray,$emailText);

  }


}
