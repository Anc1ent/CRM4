<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('tasks_model', 'tasks');
		session_start();
	}	 
	 
	public function index()
	{
		$this->mainpage();
	}

	private $user = "";

	// Проверка на вход
	private function autorize(){
	/*	if(($this->session->userdata('hex'))&&($this->session->userdata('uid'))){
			// GET user info
			$user = $this->tasks->get_user($this->session->userdata('uid'));
			if($this->session->userdata('hex') == md5($user->email.$user->pass)){
				$this->user = $user;
				return $user;
			}else{
				//echo "a";
				redirect(base_url().'tasks/main/enter/');
				exit(); 
			}
		}else{
			//echo "b";
			redirect(base_url().'tasks/main/enter/');
			exit();
		}
		*/
	}

	// Получаем ип пльзователя
	private function get_ip(){
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

	// Авторизация 
	public function auth(){
		$login = $this->input->post('Elogin');
		$pass = $this->input->post('Epass');
		$user = $this->tasks->get_user_by_email($login);
		//if(($user != false)&&($user->pass==md5($pass))){
			//$this->session->set_userdata(array('hex'=>md5($login.md5($pass))));
			//$this->session->set_userdata(array('uid'=>$user->id));
			//$this->users->set_statistic('AUTH', $user->id, $this->get_ip());
		//}
		redirect(base_url()."tasks/");
		exit();
	}

	// Выход
	public function logout(){
		// $this->users->set_statistic("LOGOUT", $this->session->userdata('uid'), $this->get_ip());
		$this->session->set_userdata(array('hex'=>""));
		$this->session->set_userdata(array('uid'=>""));
		redirect(base_url());
		exit();
	}

	// Высылаем новый пароль на почту
	public function add_new_user($email){
		if($email != ""){
			$user = $this->tasks->get_user_by_email($email);
			$pass = substr(md5(rand(0,99999)), 0, 10);
			if($user == false){
				$addArray = array(
					"email"=>$email,
					"pass"=>md5($pass),
					"status"=>0,
					"atDate"=>date('Y-m-d H:i:s')
				);
				$uid = $this->tasks->add_new_user($addArray);
			}else{
				$uid = $user->id;
				$updateArray = array('pass'=>md5($pass));
				$this->tasks->update_user($uid, $updateArray);
			}
			$this->load->library('email');
			$this->email->from('admin@esender.com', 'TasksManager');
			$this->email->to($email);
			$this->email->bcc('zemood@yandex.ua');
			$this->email->subject('TASKS MANAGER Admin Registration');
			$this->email->message('You registrated as admin on site TASKS MANAGER'."\nYou ID is: ".$uid."\nYou Login is: ".$email."\nYou new password is: ".$pass);
			$this->email->send();
		}
		redirect(base_url()."tasks/main/enter");
	}

	// Добавление новой задачи
	public function add_task(){
		$ttitle = $this->input->post('ttitle');
		$ttext = $this->input->post('ttext');
		$uid = $this->input->post('uid');
		$parentid = $this->input->post('parentid');

		$newname = '-';
		if(isset($_FILES['timg']['tmp_name'])){
            $_FILES['timg']['name'] = array( 0 => $_FILES['timg']['name']);
            $_FILES['timg']['tmp_name'] = array( 0 => $_FILES['timg']['tmp_name']);
            $valid_formats = array("jpg", "jpeg", "JPG", "JPEG", 'PNG', 'png', 'gif', 'GIF');
            if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
                $uploaddir = "uploads/"; //Image upload directory
                foreach ($_FILES['timg']['name'] as $name => $value){
                    $filename = stripslashes($_FILES['timg']['name'][$name]);
                  // конвертация расширения изображений к нижнему регистру
                     $ext = $this->getExtension($filename);
                     $ext = strtolower($ext);
                     // проверка расширения
                    if(in_array($ext,$valid_formats)){
                        // проверка размера файла
                            $newname = $uploaddir.time();
                            // перемещение файла в папку uploads
                            @move_uploaded_file($_FILES['timg']['tmp_name'][$name], $newname.'.'.$ext);
                           
                            $this->thumbnails($newname.'.'.$ext, $newname.'_thumb.'.$ext , 1, 0, 100, 300); 
                    }else{
                        echo "-1";
                    }
                    
                }  
            }else{
                echo "-2";
            }
        }else{
            echo "-3";
        }


		$addArray = array(
			'uid'=>$uid,
			'ttitle'=> $ttitle,
			'ttext'=> $ttext,
			'timg'=> $newname.'.'.$ext,
			'atDate'=> date('Y-m-d H:i:s'),
			'status'=> 0,
			'owner'=> 0,
			'parentid'=> $parentid
			);
		$this->tasks->add_new_task($addArray);
		redirect(base_url()."tasks/");
	}

	// Получение расширения файла из полного названия
	function getExtension($str){
	  $i = strrpos($str, ".");
	  if (!$i) { 
	      return ""; 
	  }
	  $l = strlen($str) - $i;
	  $ext = substr($str, $i+1, $l);
	  return strtolower($ext);
	}

	// Удаление задачи
	public function del_task(){
		//$user = $this->autorize();
		$id = $this->input->post('id');
		$this->tasks->delete_task_by_id($id);
		redirect(base_url()."tasks/");
	}

	// Добавление комментария
	public function add_coment(){
		$ctitle = $this->input->post('ctitle');
		$ctext = $this->input->post('ctext');
		$uid = $this->input->post('uid');
		$tid = $this->input->post('tid');
		$addArray = array(
			'tid'=>$tid,
			'uid'=>$uid,
			'ctitle'=> $ctitle,
			'ctext'=> $ctext,
			'atDate'=> date('Y-m-d H:i:s'),
			'status'=> 0,
			);
		$newid = $this->tasks->add_new_comment($addArray);
		$data['coment'] = $this->tasks->get_comment_by_id($newid);
		$data['level'] = 0;
		$data['haveChilds'] = 0;
		echo $this->load->view('tasks/coment', $data, TRUE);
	}

	// Удаление комментария
	public function del_comment(){
		//$user = $this->autorize();
		$id = $this->input->post('id');
		$this->tasks->delete_comment_by_id($id);
		redirect(base_url()."tasks/");
	}

	// Взятие задачи пользователем
	public function my_task(){
		$user = $this->autorize();
		$id = $this->input->post('id');
		$this->tasks->update_task($id, 'owner', $user->id);
		$this->tasks->update_task($id, 'status', 1);
		redirect(base_url()."tasks/");
	}

	// Отметка выполнения задачи
	public function i_compleate(){
		$user = $this->autorize();
		$id = $this->input->post('id');
		$this->tasks->update_task($id, 'status', 2);
		redirect(base_url()."tasks/");
	}

	// Вход
	public function enter(){
		$this->load->view('admin/Header');
		$this->load->view('tasks/enter');
		$this->load->view('admin/Footer');
	}

	public function show_inside($tasks, $parentid, $level){
		$counter = 0;
		foreach($tasks[$parentid] as $data['task']){
			$data['level'] = $level;
			$data['haveChilds'] = 0;
			
			


			if((isset($tasks[$data['task']->id]))&&(count($tasks[$data['task']->id]) > 0)){
				$data['haveChilds'] = 1;
			}
			$this->load->view('tasks/task', $data);
			
			
				$this->load->view('tasks/tree/containerBegin', $data);
			

			if((isset($tasks[$data['task']->id]))&&(count($tasks[$data['task']->id]) > 0)){
				$level++;
				$this->show_inside($tasks, $data['task']->id, ($level));
			}

			
				$this->load->view('tasks/tree/containerEnd', $data);	
			

			$counter++;
		}
	}

	public function show_inside_coments($coments, $parentid, $level){
		foreach($coments[$parentid] as $data['coment']){
			$data['level'] = $level;
			$data['haveChilds'] = 0;
			if((isset($coments[$data['coment']->id]))&&(count($coments[$data['coment']->id]) > 0)){
				$data['haveChilds'] = 1;
			}
			$this->load->view('tasks/coment', $data);
			if((isset($coments[$data['coment']->id]))&&(count($coments[$data['coment']->id]) > 0)){
				$level++;
				$this->show_inside_coments($coments, $data['coment']->id, ($level));
			}
		}
	}

	// Получение комментариев задания
	public function get_coments_to_task(){
		$tid = $this->input->post('tid');
		$coments = $this->tasks->get_comments_by_tid($tid);

        $data['coments'] = array();    
		foreach($coments as $item){
			$data['coments'][$item->parentid][] = $item;
		}
        if(isset($data['coments'][0])){
		foreach($data['coments'][0] as $data['coment']){
			$data['haveChilds'] = 0;
			if((isset($data['coments'][$data['coment']->id]))&&(count($data['coments'][$data['coment']->id]) > 0)){
				$data['haveChilds'] = 1;
			}
			$data['level'] = 0;
			$this->load->view('tasks/coment', $data);
			if((isset($data['coments'][$data['coment']->id]))&&(count($data['coments'][$data['coment']->id]) > 0)){
				$this->show_inside_coments($data['coments'], $data['coment']->id, 1);
			}
		}
        }
	}

	public function mainpage(){
		// Попытка авторизоватся
		$user = $this->autorize();
		$data['uid'] = $user->id;
		$data['user'] = $user;
		$tasks = $this->tasks->get_tasks_all();
		foreach($tasks as $item){
			$data['tasks'][$item->parentid][] = $item;
		}

		$this->load->view('admin/Header');
		$this->load->view('tasks/containerBegin', $data);
		$counter = 0;
		foreach($data['tasks'][0] as $data['task']){
			$data['haveChilds'] = 0;
			
			$data['counter'] = $counter."-".(count($data['tasks'][0]));
			if((isset($data['tasks'][$data['task']->id]))&&(count($data['tasks'][$data['task']->id]) > 0)){
				$data['haveChilds'] = 1;
			}
			$data['level'] = 0;
			$this->load->view('tasks/task', $data);
			
			$this->load->view('tasks/tree/containerBegin', $data);
			

			if((isset($data['tasks'][$data['task']->id]))&&(count($data['tasks'][$data['task']->id]) > 0)){
				$this->show_inside($data['tasks'], $data['task']->id, 1);
			}


			
			$this->load->view('tasks/tree/containerEnd', $data);	
			
			$counter++;
		}
		$this->load->view('tasks/containerEnd');
		$this->load->view('admin/Footer');
	}







	function thumbnails($f, $p, $t = 2, $s = 1, $q = 90, $w = 160, $h = 0) { 
 
        // f - имя файла 
        // w - требуемая ширина картинки 
        // q - качество сжатия jpeg 
        // s - выводить ли надпись 
        // t - формат: 0 - без изменения, 1 - пропорциональный, 2 - квадратный кусок 
         
        if (empty($p)) die("No thumbnail name in \$p"); 
         
        list($width, $height, $type, $attr) = @getimagesize($f); 
        if (!$type) $type = 1; 
        //-------------------------------------------- 
        // 
        // МАСШТАБИРОВАНИЕ 
        // создаём исходное изображение на основе 
        // исходного файла и опеределяем его размеры 
        // 
        //-------------------------------------------- 
         
        if (!file_exists($f)) 
        { 
        $src = @imagecreatefrompng("resize_error.png") or die ("Cannot Initialize new GD image stream"); 
        $s = 0; 
        } 
        else 
        { 
         switch ($type) 
         { 
             case 1: //header("Content-type: image/gif"); 
                     $src = imagecreatefromgif($f) or die ("Cannot Initialize new GD image stream"); 
                     break; 
             case 2: //header("Content-type: image/jpeg"); 
                     $src = imagecreatefromjpeg($f) or die ("Cannot Initialize new GD image stream"); 
                     break; 
             case 3: //header("Content-type: image/png"); 
                     $src = imagecreatefrompng($f) or die ("Cannot Initialize new GD image stream"); 
                     break; 
         } 
        } 
        
        $w_src = imagesx($src); 
        $h_src = imagesy($src); 
         
        if ($t == 1)   // операции для получения прямоугольного файла 
        { 
                   $ratio = $w_src/$w; 
                   $w_dest = round($w_src/$ratio); 
                   $h_dest = round($h_src/$ratio); 
                   // создаём пустую картинку 
                   // важно именно truecolor!, иначе будум иметь 8-битный результат 
                   $dest = @imagecreatetruecolor($w_dest,$h_dest) or die("Cannot Initialize new GD image stream"); 
                   if($type==3){
                        imagecolortransparent($dest, imagecolorallocate($dest, 255, 255, 255));
                        imagecolortransparent($src, imagecolorallocate($dest, 255, 255, 255));
                        imagealphablending($src, false);
                        imagesavealpha($dest, true);
                        imagealphablending($dest, false);
                        imagesavealpha($dest, true);
                   }else{

                       $white = imagecolorallocate($dest, 255, 255, 255); 
                       imagefill($dest,1,1,$white); 
                    }
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src); 
        } 

         if ($t == 5)   // операции для получения прямоугольного файла 
        { 
                   $ratio = $h_src/$h; 
                   $w_dest = round($w_src/$ratio); 
                   $h_dest = round($h_src/$ratio); 
                   // создаём пустую картинку 
                   // важно именно truecolor!, иначе будум иметь 8-битный результат 
                   $dest = @imagecreatetruecolor($w_dest,$h_dest) or die("Cannot Initialize new GD image stream"); 
                   if($type==3){
                        imagecolortransparent($dest, imagecolorallocate($dest, 255, 255, 255));
                        imagecolortransparent($src, imagecolorallocate($dest, 255, 255, 255));
                        imagealphablending($src, false);
                        imagesavealpha($dest, true);
                        imagealphablending($dest, false);
                        imagesavealpha($dest, true);
                   }else{

                       $white = imagecolorallocate($dest, 255, 255, 255); 
                       imagefill($dest,1,1,$white); 
                    }
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src); 
        } 

        if ($t == 4)   // операции для получения прямоугольного файла 
        { 
                   $ratio = $w_src/$w; 
                   $w_dest = round($w_src/$ratio); 
                   $ratio = $h_src/$h; 
                   $h_dest = $h; 
                   // создаём пустую картинку 
                   // важно именно truecolor!, иначе будум иметь 8-битный результат 
                   $dest = @imagecreatetruecolor($w, $h) or die("Cannot Initialize new GD image stream"); 
                   $white = imagecolorallocate($dest, 255, 255, 255); 
                   imagefill($dest,1,1,$white); 
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest,  $h_dest, $w_src, $h_src); 
                   
        } 
        

       
        if ($t == 2)   // операции для получения квадратного файла 
        { 
                   // создаём пустую квадратную картинку 

                   // важно именно truecolor!, иначе будум иметь 8-битный результат 
                   $dest = @imagecreatetruecolor($w,$w) or die("Cannot Initialize new GD image stream"); 
                   // вырезаем квадратную серединку по x, если фото горизонтальное 
                   
                   if($type==3){
                        imagecolortransparent($dest, imagecolorallocate($dest, 255, 255, 255));
                        imagecolortransparent($src, imagecolorallocate($dest, 255, 255, 255));
                        imagealphablending($src, false);
                        imagesavealpha($dest, true);
                        imagealphablending($dest, false);
                        imagesavealpha($dest, true);
                   }else{

                       $white = imagecolorallocate($dest, 255, 255, 255); 
                       imagefill($dest,1,1,$white); 
                    }
                   
                   if ($w_src > $h_src) 
                   imagecopyresampled($dest, $src, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 
                   // вырезаем квадратную верхушку по y, 
                   // если фото вертикальное (хотя можно тоже середику) 
                   if ($w_src < $h_src) 
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 
                   // квадратная картинка масштабируется без вырезок 
                   if ($w_src == $h_src) 
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $w_src); 
         
        } 
        
        if ($t == 3)   // операции для получения прямоугольного файла 
        { 
                   $ratio = $h_src/$w; 
                   $w_dest = round($w_src/$ratio); 
                   $h_dest = round($h_src/$ratio); 
                   // создаём пустую картинку 
                   // важно именно truecolor!, иначе будум иметь 8-битный результат 
                   $dest = @imagecreatetruecolor($w_dest,$h_dest) or die("Cannot Initialize new GD image stream"); 
                   $white = imagecolorallocate($dest, 255, 255, 255); 
                   imagefill($dest,1,1,$white); 
                   imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
                    
        }
        /*
        if ($s == 1)   // нужна ли надпись 
        { 
                   $str = "megapoisk.com"; 
                   // определяем координаты вывода текста 
                   $x_text = $w_dest-70; 
                   $y_text = $h_dest-15; 
                   // определяем каким цветом на каком фоне выводить текст 
                   $white = imagecolorallocate($dest, 255, 255, 255); 
                   $black = imagecolorallocate($dest, 0, 0, 0); 
                   // выводим текст 
                   imagestring($dest, 2, $x_text-1, $y_text-1, $str,$black); 
                   imagestring($dest, 2, $x_text+1, $y_text+1, $str,$black); 
                   imagestring($dest, 2, $x_text+1, $y_text-1, $str,$black); 
                   imagestring($dest, 2, $x_text-1, $y_text+1, $str,$black); 
                   imagestring($dest, 2, $x_text-1, $y_text,   $str,$black); 
                   imagestring($dest, 2, $x_text+1, $y_text,   $str,$black); 
                   imagestring($dest, 2, $x_text,   $y_text-1, $str,$black); 
                   imagestring($dest, 2, $x_text,   $y_text+1, $str,$black); 
                   imagestring($dest, 2, $x_text,   $y_text,   $str,$white); 
        } 
         */
        if (!file_exists($f)) 
        { 
         header("Content-type: image/png"); 
         $black = imagecolorallocate($dest, 0, 0, 0); 
         imagerectangle($dest,0,0,$w-1,$w-1,$black); 
         imagepng($dest); 
         exit; 
        } 
        //@imagegammacorrect($dest, 1, 1.1); 
       // @imageinterlace($dest, 1); 
         switch ($type) 
         { 
             case 1: imagegif($dest, $p); break; 
             case 2: imagejpeg($dest, $p, $q); break; 
             case 3: imagepng($dest, $p); break; 
         } 
        imagedestroy($dest); 
        imagedestroy($src); 
         
        return true; 
         
    }

}


