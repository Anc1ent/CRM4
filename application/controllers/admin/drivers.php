<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class drivers extends CI_Controller {

    
   public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('quotes_model', 'quotes');
        $this->load->model('emails_model', 'emails');
        $this->load->model('drivers_model', 'drivers');
        $this->load->model('users_model', 'users');
        session_start();

    }      
     
	public function index()
	{
        $this->mainpage();
	}

	// Проверка на вход
	private function autorize(){
		if(($this->session->userdata('hex'))&&($this->session->userdata('uid'))){
			// GET user info
			$user = $this->users->get_user($this->session->userdata('uid'));
			if($this->session->userdata('hex') == md5($user->email.$user->password)){
				$this->user = $user;
				return $user;
			}else{
				redirect(base_url().'admin/enter/');
				exit();	
			}
		}else{
			redirect(base_url().'admin/enter/');
			exit();
		}
	}

	// Текущее время
	private function getNowDate(){
		// Текущее время 
		  $nowDay = getDate(time());
		  if($nowDay['hours'] < 10) $nowDay['hours'] = "0".$nowDay['hours'];
		  if($nowDay['minutes'] < 10) $nowDay['minutes'] = "0".$nowDay['minutes'];
		  if($nowDay['seconds'] < 10) $nowDay['seconds'] = "0".$nowDay['seconds']; 
		  return $nowDay;
	}


	// Главная страница
	public function mainpage(){ 
		 // Попытка авторизоватся
		 $user = $this->autorize();
		 $data['user'] = $user;

		 // Верхнее меню
		 $data['upmenu'] = $this->drivers->get_upmenu();
		 // Получаем массив данных с названим раздлов
		 $data['sparts'] = $this->drivers->get_folders_names();

		 // Список главных разделов
		 $data['sPartsNames'] = array( "100" => "New", "101"=>"Processed", "102"=>"Worked", "103"=>"Archive");

		 // Количество вниутри разделов
		 $data['countInParts'] = $this->drivers->count_sum_inside_part();
		 //print_r($data['countInParts']);

		 $data['menu_active'] = "All";
		 $data['menu_active2'] = "0";

    	 $data['nowDay'] = $this->getNowDate();

		  // Колчество на странице
		  if($this->session->userdata('Dlimit')){
	     		$data['LIMIT'] = $LIMIT = $this->session->userdata('Dlimit');
		  }else{
		 		$data['LIMIT'] = $LIMIT = 100;
		  }
		  // [END] Колчество на странице

		  // Сортировка
		  if($this->session->userdata('Dsort')){
	     		$data['iSORT'] = $iSORT = $this->session->userdata('Dsort');
	     		$data['S'] = $S = $this->session->userdata($iSORT);
		  }else{
		 		$data['iSORT'] = $iSORT = "id";
	     		$data['S'] = $S = "DESC";
		  }

		  
		  if($this->session->userdata('Dsort')){
		    $data['SORT'] = $SORT = "ORDER BY `".$iSORT."` ".$S;
		  }else{
		    $data['SORT'] = $SORT = "ORDER BY `id` DESC";
		  }
		  // [END] Сортировка


		 // Количество общее
		  $data['countQ'] = $this->drivers->get_drivers_count(); 

		  // Получаем список для таблицы на вывод
		  $data['query'] =  $this->drivers->get_drivers_page($SORT, $LIMIT, $PAGE = 0);



		  $this->load->view('admin/Header' ,$data);
		  $this->load->view('admin/upmenudrivers' ,$data);
		  $this->load->view('admin/tables/drivers/header', $data);
		  $this->load->view('admin/tables/drivers/item', $data);
		  $this->load->view('admin/tables/drivers/footer', $data);
		  $this->load->view('admin/Footer', $data);

	}

	// Добавление папки к разделу
	public function add_second_menu(){
		$spart = $this->input->post('spart');
		$sname = $this->input->post('sname');
		$addArray = array(
			'sname'=>$sname,
			'spart'=>$spart);
		$newid = $this->drivers->add_second_menu($addArray);
		echo '<div ondblclick="delete_folder(\''.base_url().'\', '.$newid.'); $(this).fadeOut(500);" onclick=" var ithis = $(this); setTimeout(function(){showPartDrivers(\''.base_url().'\','.$newid.', ithis)},100);"  class="upmenuButton " class="upmenuButton ">'.$sname.' (0)</div>';

	}

	// Удаление папки из раздела
	public function del_second_menu(){
		$did = $this->input->post('did');
		$this->drivers->delete_second_menu($did);
	}

	// Колчество на странице
	public function set_limit($limit = 100){
      	$this->session->set_userdata(array('Dlimit'=>$limit));
      	//redirect(base_url(), 'refresh');
	}

	public function set_sort($s, $sort){
		// Сортировка
	    if($s == 0){
	      $this->session->set_userdata(array('Dsort'=>$sort));	
	      $this->session->set_userdata(array($sort=>"ASC"));	
	    }else{
	       $this->session->set_userdata(array('Dsort'=>$sort));	
	      $this->session->set_userdata(array($sort=>"DESC"));
	      
	    }
		//redirect(base_url(), 'refresh');
	}

  // Перенос заявки
  function set_driver_part(){
  	$spart = $this->input->post('spart');
  	$qid = $this->input->post('qid');
  	$this->drivers->update_driver_part($qid, $spart);
  	$this->drivers->recount_inside_parts($spart);
  }	



  // Подгрузка вконце таблицы
  public function get_more_drivers(){

	    $getMore = $this->input->post('getMore');
	  	$spart = $this->input->post('spart');

	  	// Верхнее меню
		$data['upmenu'] = $this->drivers->get_upmenu();
	  	
	  	// Получаем массив данных с названим раздлов
		 $data['sparts'] = $this->drivers->get_folders_names();
		
		// Список главных разделов
		 $data['sPartsNames'] = array( "100" => "New", "101"=>"Processed", "102"=>"Worked", "103"=>"Archive");

	  	if($this->session->userdata('Dlimit')){
	     	$LIMIT = $this->session->userdata('Dlimit');
	 	}else{
	 		$LIMIT = 100;
	 	}

	 	 // Сортировка
		  if($this->session->userdata('Dsort')){
	     		$data['iSORT'] = $iSORT = $this->session->userdata('Dsort');
	     		$data['S'] = $S = $this->session->userdata($iSORT);
		  }else{
		 		$data['iSORT'] = $iSORT = "id";
	     		$data['S'] = $S = "DESC";
		  }

		  
		  if($this->session->userdata('Dsort')){
		    $data['SORT'] = $SORT = "ORDER BY `".$iSORT."` ".$S;
		  }else{
		    $data['SORT'] = $SORT = "ORDER BY `id` DESC";
		  }
		  // [END] Сортировка

	    $data['ishowHeader'] = 0; 


		 // Количество общее
		  $data['countQ'] = $this->drivers->get_drivers_part_count($spart); 

		  // Получаем список для таблицы на вывод
		  $data['query'] =  $this->drivers->get_drivers_part_page($spart,$SORT, $LIMIT, ($getMore*$LIMIT));



		  
		  $this->load->view('admin/tables/drivers/item', $data);
	      
	  
	  // [END] Подгрузка вконце таблицы
  }

  // Подгрузка вконце таблицы
  public function get_drivers_part(){

  		// Верхнее меню
		$data['upmenu'] = $this->drivers->get_upmenu();

		// Получаем массив данных с названим раздлов
	   $data['sparts'] = $this->drivers->get_folders_names();
		 
		// Список главных разделов
		 $data['sPartsNames'] = array( "100" => "New", "101"=>"Processed", "102"=>"Worked", "103"=>"Archive");

  		$partid = $this->input->post('partid');
	  	if($this->session->userdata('Dlimit')){
	     	$data['LIMIT'] = $LIMIT = $this->session->userdata('Dlimit');
	 	}else{
	 		$data['LIMIT'] = $LIMIT = 100;
	 	}

	 	 // Сортировка
		  if($this->session->userdata('Dsort')){
	     		$data['iSORT'] = $iSORT = $this->session->userdata('Dsort');
	     		$data['S'] = $S = $this->session->userdata($iSORT);
		  }else{
		 		$data['iSORT'] = $iSORT = "id";
	     		$data['S'] = $S = "DESC";
		  }

		  
		  if($this->session->userdata('Dsort')){
		    $data['SORT'] = $SORT = "ORDER BY `".$iSORT."` ".$S;
		  }else{
		    $data['SORT'] = $SORT = "ORDER BY `id` DESC";
		  }
		  // [END] Сортировка

	 	 // Количество общее
		  $data['countQ'] = $this->drivers->get_drivers_part_count($partid);
	      $data['query'] = $this->drivers->get_drivers_part_page($partid, $SORT, $LIMIT, $PAGE = 0); 
	     
 		  $this->load->view('admin/tables/drivers/header', $data);
 		  $this->load->view('admin/tables/drivers/item', $data);
 		  $this->load->view('admin/tables/drivers/footer', $data);
	 
	      
	  
	  // [END] Подгрузка вконце таблицы
  }

  // Подгрузка меню верхнего
  public function get_upmenu(){
  		$selected_menu = $this->input->post('smenu');
  		$selected_menu2 = $this->input->post('smenu2');

  		// Количество общее
		$data['countQ'] = $this->drivers->get_drivers_part_count(0);
		
		// Пересчитываем цыфру для меню  
	  	$this->drivers->recount_inside_parts($selected_menu2);

	  	// Список главных разделов
		 $data['sPartsNames'] = array( "100" => "New", "101"=>"Processed", "102"=>"Worked", "103"=>"Archive");

	  	// Верхнее меню
		$data['upmenu'] = $this->drivers->get_upmenu();

		// Количество вниутри разделов
		$data['countInParts'] = $this->drivers->count_sum_inside_part();
		//print_r($data['countInParts']);

		$data['menu_active'] = $selected_menu;
		$data['menu_active2'] = $selected_menu2;

    	$data['nowDay'] = $this->getNowDate();	     
 		$this->load->view('admin/upmenudrivers', $data);
	 
	      
	  
	  // [END] Подгрузка вконце таблицы
  }

   // Блок редактироване квоты
  public function get_fullinfo(){
  	$qid = $this->input->post('qid');
  	$data['driver'] = $this->drivers->get_driver_by_id($qid);
  	$this->load->view('admin/parts/driverprofile' , $data);

  }

  // Редактирование информации о водителе
  public function adddriver(){
  	$qid = $this->input->post('qid');
  	$dname = $this->input->post('dname');
  	$dcontact = $this->input->post('dcontact');
  	$daddr = $this->input->post('daddr');
  	$daddr2 = $this->input->post('daddr2');
  	$daddrState = $this->input->post('daddrState');
  	$daddrZip = $this->input->post('daddrZip');
  	$daddrCountry = $this->input->post('daddrCountry');
  	$dphone = $this->input->post('dphone');
  	$dphone2 = $this->input->post('dphone2');
  	$dmobile = $this->input->post('dmobile');
  	$demail = $this->input->post('demail');
  	$dfax = $this->input->post('dfax');

  	$chArray = array(
  		'name'=>$dname,
  		'contact'=>$dcontact,
  		'addr'=>$daddr,
  		'addr2'=>$daddr2,
  		'addrState'=>$daddrState,
  		'addrZip'=>$daddrZip,
  		'addrCountry'=>$daddrCountry,
  		'phone'=>$dphone,
  		'phone2'=>$dphone2,
  		'mobile'=>$dmobile,
  		'email'=>$demail,
  		'fax'=>$dfax
  		);

  	$this->drivers->update_driver($qid, $chArray);

  }

  // --------------------------

  // Добавление водителей из текстового файла
public function parse_drivers(){
	$driversText = file_get_contents('./drivers.txt');
	$driversArr = explode("\n", $driversText);
	$counter = 0;
	foreach($driversArr as $item){
		//$item = $driversArr[0];
		//echo $driversArr[0];
		$dtype = explode('	', $item)[0];
		$other = explode(',', $item);
		//echo $item; 
		//echo "-";
		//print_r(count($other));
		if(count($other) > 2){
			  $other = $other[0].$other[1];
		}else{
			$other = $other[0];
		}
		$other = trim(substr($other, strlen($dtype)));
		
		$other = explode('	', $other);
	
		$name = $other[0];
		$addr = $other[1];

		$phone = explode(',', $item)[count(explode(',', $item))-1];
		$phone = trim($phone);
		$phone = explode('	', $phone);
		$addr .= ", ".$phone[0];
		$phone = $phone[1]; 
		if((!isset($phone))||($phone == "")) $phone = "-";
	
		$this->db->where('name', $name);
		$q = $this->db->get('drivers');
		if($q->num_rows() > 0){
			echo "a";
		}else{
			$counter++;
			$addArray = array('name'=>$name, 'dtype'=>$dtype, 'addr2'=>$addr, 'phone'=>$phone);
			$this->db->insert('drivers', $addArray);
			echo "b";
		}


	}

	echo $counter;
	//echo $dtype."|".$name."|".$addr."|".$phone;
	//echo $other;
}
 

 // Блок для выбора водителя
public function get_driver_list(){
	$dname = $this->input->post('dname');
	$drivers = $this->drivers->get_drivers_by_name_like($dname);
	foreach($drivers as $driver){
		echo "<div class='driverItem' id='".$driver->id."'>".$driver->name."</div>";
	}
}

// получаем иновормацию по водителю по ид
public function get_driver_info(){
	$did = $this->input->post('did');
	$driver = $this->drivers->get_driver_by_id($did);
	echo $driver->contact."~".$driver->email."~".$driver->phone."~".$driver->phone2."~".$driver->mobile."~".$driver->ciferki."~".$driver->trailerType."~".$driver->dCargo."~".urlencode($driver->addr2)."~".$driver->dMC;
}

// Добавление письма
  public function addchemail(){

  	
  	$Ename = $this->input->post('Ename');

  	$Efrom = $this->input->post('Efrom');
  	$Enfrom = $this->input->post('Enfrom');
  	$Ereplyto = $this->input->post('Ereplyto');
  //	$Ecc = $this->input->post('Ecc');
  	$Ebcc = $this->input->post('Ebcc');
  	
  	$Esubject = $this->input->post('Esubject');
  	 $Etext = $this->input->post('Etext');
  	   $Eid = $this->input->post('Eid');
  	   //$AutomatedTo = $this->input->post('AutomatedTo');
  	   $OnlyInworkTime = $this->input->post('OnlyInworkTime');
  	   $Etype = $this->input->post('Etype');

  	   if(!isset($Etype)) $Etype = 0;

  	  $sendToDriver = $this->input->post('sendToDriver');
  	  if((isset($sendToDriver))&&($sendToDriver == "on")) {
  	  	$sendToDriver = 1;
  	  }else{
  	  	$sendToDriver = 0;
  	  }


	    $Ename = addslashes($Ename);
	    $Esubject = addslashes($Esubject);
	    $Etext = addslashes($Etext);
	    if(!($Eid > 0)){
	    	$addArray = array(
	    		'name'=>$Ename,
	    		'subject'=>$Esubject,
	    		'text'=>$Etext,
	    		'etype'=>$Etype,
	    		'sendToDriver'=>$sendToDriver,
	    		'OnlyInworkTime'=>$OnlyInworkTime,
	    	//	'cc'=>$Ecc,
	    		'bcc'=>$Ebcc,
	    		'efrom'=>$Efrom,
	    		'enfrom'=>$Enfrom,
	    		'replyto'=>$Ereplyto

	    		);
	    	$this->db->insert('drivers_emails',$addArray);
	    	//echo $this->db->insert_id();
	    }else{
	    	$chArray = array(
	    		'name'=>$Ename,
	    		'subject'=>$Esubject,
	    		'text'=>$Etext,
	    		'sendToDriver'=>$sendToDriver,	
	    		//'AutomatedTo'=>$AutomatedTo,
	    		'OnlyInworkTime'=>$OnlyInworkTime,
	    	//	'cc'=>$Ecc,
	    		'bcc'=>$Ebcc,
	    		'efrom'=>$Efrom,
	    		'replyto'=>$Ereplyto,
	    		'enfrom'=>$Enfrom);

	    	$this->db->where('id',$Eid);
	 		$this->db->update('drivers_emails', $chArray);

	    }

	    //echo $this->db->last_query();
	  	
	    redirect(base_url()."admin/", 'refresh');

  }


   public function get_email_change(){
  	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache"); // HTTP/1.0
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	$data['notSave'] = 0;
	$user = $this->autorize();
	$data['user'] = $user;

	$data['hash'] = time();
  	$data['eid']= $eid = $this->input->post('eid');
  	if($eid != 0){
  		$data['data'] = $this->emails->get_drivers_email_by_id($eid);	
  	}else{
  		if((!isset($user->Fname))||($user->Fname == "")) $user->Fname = "I HAVE NO NAME IN MY SETINGS";
  		$addArray = array(
			'name'=>"Onced send (not save as template)",
			'subject'=>"",
			'text'=>"",
			'etype'=>1,
			//'AutomatedTo'=>$AutomatedTo,
			'OnlyInworkTime'=>0,
		//	'cc'=>$Ecc,
			'bcc'=>"",
			'efrom'=>$user->email,
			'enfrom'=>$user->Fname,
			'replyto'=>$user->email

	    );
  		$this->db->insert('drivers_emails', $addArray);
  		$eid = $this->db->insert_id();
  		$data['data'] = $this->emails->get_drivers_email_by_id($eid);
  		$data['notSave'] = 1;
  	}
  	$this->load->view('admin/perscab/driverEmailEdit', $data);	
    
   }

 // Отправляем конкретное писмои из базы 
 public function send_one_email(){
 	$eid = $this->input->post('eid');
 	$qid = $this->input->post('qid');
 	$specEmail = $this->input->post('specEmail');
 	$quote_id = $this->input->post('quote_id');
 	$quote = $this->drivers->get_driver_by_id($qid);
 	$ismass = $this->input->post('ismass');
 	$iAlreadySend = array();

 	if($ismass == 1){
		$qids = explode('`', $qid);
		foreach($qids as $qid){
			if(($qid == "")||($qid == 0)) continue;
			if(in_array($qid, $iAlreadySend)) continue;
			$specEmail = "-";
			$quote = $this->drivers->get_driver_by_id($qid);
			$this->send_email($eid, $quote->email, $qid, $specEmail, $quote_id);
			$iAlreadySend[] = $qid;
		}
	}else{
		$to = $quote->email;	
		if(($specEmail != "-")&&( $specEmail!="" )) $to = $specEmail;
 		$this->send_email($eid, $to, $qid, $specEmail, $quote_id);
	}
 	

 }

 // Отправка письма
 private function send_email($eid, $to, $qid, $specEmail, $quote_id){
 	//echo $eid;
 	//echo $to."~";
 	$quote = $this->quotes->get_quote_order_by_id($quote_id);

 	$driver = $this->drivers->get_driver_by_id($qid);
 	$driver_id = $qid;

 	$esid = $this->drivers->add_to_send($driver_id, $eid, $specEmail, $quote_id);
 	$isOpenPic = "<img src='".base_url()."img/isopend.php?e=".$esid."' style='display:none; width:1px; height:1px;'/>";


 	$email = $this->emails->get_drivers_email_by_id($eid);
  	$args = array(
    	'key' => 'K67vGlb_hFW4fQdMEyQulQ',
    	'message' => array(
        	"html" => $this->drivers->update_email_values(stripslashes($email->text).$isOpenPic, $quote, $driver->name, $driver->id),
       	 	"text" => null,
        	"from_email" => $email->efrom,
        	"from_name" => $email->enfrom,
        	"subject" => $this->drivers->update_email_values(stripslashes($email->subject), $quote, $driver->name, $driver->id),
        	"to" =>array(array("email" => $to)),
        	"track_opens" => true,
        	"track_clicks" => false
    	)
	);

	if($email->replyto != ""){
		$args['message']['headers'] = array('Reply-To' => $email->replyto);
	}

	if($email->bcc != ""){
		$args['message']['bcc_address'] = $email->bcc;
	}

	//print_r($args);



	$curl = curl_init('https://mandrillapp.com/api/1.0/messages/send.json' );

	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));
	$response = curl_exec($curl);
	//print_r($response);
	//echo "a";
	//$this->emails->delete_email_form_wating($wid);
	//$this->statistic->email_send_action($qid, '0', "SENT EMAIL (".$email->name.")", -1);
	
  }

  // Отмечаем как прочитаное письмо
  function chEmailstatus($eid){
  
  	$this->db->where('id', $eid);
  	$es = $this->db->get('drivers_emails_sended')->row();

  	$this->db->where('id', $es->qid);
  	$this->db->update('drivers', array('activeEmail'=>1));


  	if($es->status == 0){	
	  	$this->db->set('emailsOpened', 'emailsOpened+1', FALSE);
		$this->db->where('id', $es->qid);
		$this->db->update('drivers');
	}

  	//$this->db->where('id', $es->qid);
  	//$this->db->update('quotes', array('activeEmail'=>1));

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

  	$this->db->where('id', $eid);
  	$this->db->update('drivers_emails_sended', array('status'=>1, 'openedDate'=>date('Y-m-d H:i:s'), 'openIP'=>$ipaddress));
  	//$this->statistic->email_send_action($es->qid, '0', "OPENED EMAIL (".$es->qid.")", '1');
  }
 


 	

	
    
}