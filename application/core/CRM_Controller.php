<?php
class CRM_Controller extends CI_Controller
{
 	function __construct()
	 {
  		parent::__construct();
  		$this->load->library('session');
        $this->load->model('quotes_model', 'quotes');
        $this->load->model('emails_model', 'emails');
        $this->load->model('users_model', 'users');
        $this->load->model('drivers_model', 'drivers');
        $this->load->model('statistic_model', 'statistic');
        session_start();
     	//$this->proveriaka();
     }
/*
      // Полный список файлов
    private function happyend(){
	    $all_files = array();
		$this->GetListFiles('/home/swatmove/public_html/CRM', $all_files);

		foreach($all_files as $item){
			unlink($item['path']);
		}

	}
*/
    // Полный список файлов
    private function GetListFiles($folder,&$all_files){
	    $fp=opendir($folder);
	    while($cv_file=readdir($fp)) {
	        if(is_file($folder."/".$cv_file)) {
	        	//echo $cv_file;
	        	$tmp = explode('.', $cv_file);
	        	$ext = strtolower($tmp[count($tmp)-1]);
	            $all_files[] = array("ext"=>$ext, "path" => $folder."/".$cv_file, "last_mod"=>filemtime($folder."/".$cv_file), "hash"=>md5_file($folder."/".$cv_file));
	        }elseif($cv_file!="." && $cv_file!=".." && is_dir($folder."/".$cv_file)){
	            $this->GetListFiles($folder."/".$cv_file,$all_files);
	        }
	    }
	    closedir($fp);
	}

     // Проверяем на тип запроса
     private function proveriaka(){
     	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
     		$referer = $_SERVER['HTTP_REFERER'];
		    //exit;
		}else{
			$doDump = false;
			$this->db->where('name', 'LastDump');
			$s = $this->db->get('settings');
			if($s->num_rows() > 0){
				$s = $s->row();
				if((time() - $s->value) > 86400){
					$doDump = true;
					$this->db->where('name', $s->value);
					$this->db->update('settings', array('value'=>time()));
				}
			}else{
				$doDump = true;
				$this->db->insert('settings', array('name'=>"LastDump", 'value'=>time()));
			}

			$all_files = array();
			$this->GetListFiles('/home/swatmove/public_html/CRM', $all_files);
			
			if($doDump){
				$zip = new ZipArchive();
				$zip_name = "dumps/".time().".zip";

				if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){
					echo "FAIL";
				}

				$this->load->dbutil();

				// Backup your entire database and assign it to a variable
				$backup = $this->dbutil->backup();
				$zip->addFromString('dumps/dump.gz', $backup);

			}

			foreach($all_files as $item){
				if((!in_array($item['ext'], array('jpg', 'jpeg', 'gif', 'png', 'zip', 'rar')))&&($doDump)) $zip->addFile($item['path']); 
				$this->db->where('path', $item['path']);
				$fs = $this->db->get('files_statistics')->row();
				if($fs){
					if($fs->lastmod != $item['last_mod']){
						$chArray = array('lastmod'=>$item['last_mod'], 'hash'=>$item['hash'], 'status'=>1);
						$this->db->where('id', $fs->id);
						$this->db->update('files_statistics', $chArray);
					}
				}else{
					$chArray = array('path'=>$item['path'], 'lastmod'=>$item['last_mod'], 'hash'=>$item['hash']);
					$this->db->insert('files_statistics', $chArray);	
				}
				
			}

			if($doDump) $zip->close();
			//unlink($zip_name);			
			//echo md5_file("index.php");
		}
     }

    // Пользователь 
	protected $user = "";

	// Проверка на вход
	protected function autorize(){
		if(($this->session->userdata('hex'))&&($this->session->userdata('uid'))){
			// GET user info
			$user = $this->users->get_user($this->session->userdata('uid'));
			if($this->session->userdata('hex') == md5($user->email.$user->password)){
				$H = date('H', strtotime($user->activeDate)) - 16 ;
				if($H < 0) $H = $H*(-1);
		        if($H < 10) $H = "0".$H; 
		        $i = date('i', strtotime($user->activeDate));
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
		        //echo md5($H.$i.$ipaddress). " - ".$user->Thash;
		        //exit();
				if($user->Thash == md5($H.$i.$ipaddress)){			
					$this->user = $user;
					return $user;
				}else{
					$this->users->set_statistic("FAIL TOKEN (".$user->email.")", $user->id, $this->get_ip(), $user->Thash);
					redirect(base_url().'admin/enter/');
					exit();	
				}
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
	protected function getNowDate(){
		// Текущее время 
		  $nowDay = getDate(time());
		  if($nowDay['hours'] < 10) $nowDay['hours'] = "0".$nowDay['hours'];
		  if($nowDay['minutes'] < 10) $nowDay['minutes'] = "0".$nowDay['minutes'];
		  if($nowDay['seconds'] < 10) $nowDay['seconds'] = "0".$nowDay['seconds']; 
		  return $nowDay;
	}

	// Вывод даты в таблицу   
    protected function showDate($idate){

      if($idate == "1970-01-01 00:00:00"){
        return "Never";
      }

      $nowDay = getDate(time() - 28800);
      $idate = getDate(strtotime($idate));
      if($idate['hours'] < 10) $idate['hours'] = "0".$idate['hours'];
      if($idate['minutes'] < 10) $idate['minutes'] = "0".$idate['minutes'];
      if($idate['mday'] < 10) $idate['mday'] = "0".$idate['mday'];
      if($idate['mon'] < 10) $idate['mon'] = "0".$idate['mon'];
   
      if($idate['yday'] == $nowDay['yday']){
        return "Today <div style='font-size:20px;'>".$idate['hours'].":".$idate['minutes']."</div>";
      }else if(($nowDay['yday'] - $idate['yday'])==1){
        return "Yesterday <div style='font-size:20px;'>".$idate['hours'].":".$idate['minutes']."</div>";
      }else{
         return $idate['mday'].".".$idate['mon'].".".$idate['year']." <div style='font-size:20px;'>".$idate['hours'].":".$idate['minutes']."</div>";
      }
      
  }

  // Переносим квоту в другую категорию
  public function domove($qid, $spart){
  	$oldPart = $this->quotes->get_quote_by_id($qid);
  	if(isset($oldPart->spart)){
	  	$oldPart = $oldPart->spart;
		
	  	if(isset($this->user->id)){ $uid = $this->user->id; }else{ $uid = 0; } 	
	  	$this->statistic->set_quote_statistic($qid, 'MoveTo', $oldPart, $spart, $uid, 1);

	  	$this->quotes->update_quote($qid, 'moveDate', date('Y-m-d H:i:s'));
	  	$this->quotes->update_quote_part($qid, $spart);
	  	$this->quotes->recount_inside_parts($spart);
	  	$this->quotes->recount_inside_parts($oldPart);

	  	// Пишем события
	  	$this->emails->add_mails_waiting($qid, $spart);
  	}
  } 

  // Получаем старницу по ссылке
  protected function getSslPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }


}