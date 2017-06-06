<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    
   public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('quotes_model', 'quotes');
        $this->load->model('emails_model', 'emails');
        $this->load->model('users_model', 'users');
        session_start();

    }      
     
	public function index()
	{
        $this->auth();

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

	
    // Форма входа
    public function enter(){
        //$data['nowDay'] = $this->getNowDate();  
        $data['CRSF_TOKEN'] = session_id();
        $this->load->view('admin/Header');
          $this->load->view('admin/enter', $data);
          $this->load->view('admin/Footer');  

    }

    // Авторизация 
    public function auth(){
        $login = $this->input->post('Elogin');
        $pass = $this->input->post('Epass');
        $user = $this->users->get_user_by_email($login);


       // print_r($user);
        $H = (date('H'))-16;
        if($H < 0) $H = $H*(-1);
        if($H < 10) $H = "0".$H; 
        $i = date('i');
       // $Hi = substr($pass, strlen($pass)-4);
        $Hi = $H.$i;
        //echo $Hi;
        //echo $H.$i." == ".$Hi;
        //exit();
       // if($H.$i == $Hi){
            //$pass = substr($pass, 0 , strlen($pass)-4);
            if(($user != false)&&($user->password==md5($pass))){
                $this->session->set_userdata(array('hex'=>md5($login.md5($pass))));
                $this->session->set_userdata(array('uid'=>$user->id));
               // $this->users->set_statistic('AUTH', $user->id, $this->get_ip());
                $user = $this->users->get_in($user->id, $Hi);
               // echo $user->Thash;
                //exit();
                $this->users->set_statistic("AUTH (".$login.")", $user->id, $this->get_ip(), $user->Thash);
            }else{
                if(isset($user->id)){
                    $this->users->fail_login($user->id, $user->fails);
                }
                $this->users->set_statistic("FAIL (".$login.":".$pass.")", 0, $this->get_ip(), '-');
            }
        //}else{
          // if(isset($user->id)){
            //        $this->users->fail_login($user->id, $user->fails);
           // }
            //$this->users->set_statistic("FAIL (".$login.":".$pass.")", $user->id, $this->get_ip());
       // }
        redirect(base_url()."admin/");
        exit();
    }

    // Выход
    public function logout(){
        $user = $this->users->get_user($this->session->userdata('uid'));
        
        $this->users->set_statistic("LOGOUT", $this->session->userdata('uid'), $this->get_ip(), $user->Thash);
        $user = $this->users->get_out($this->session->userdata('uid'));
        $this->session->set_userdata(array('hex'=>""));
        $this->session->set_userdata(array('uid'=>""));
        redirect(base_url());
        exit();
    }

/*
    // Высылаем новый пароль на почту
    public function add_new_user($email){
        if($email != ""){
            $user = $this->users->get_user_by_email($email);
            $pass = substr(md5(rand(0,99999)), 0, 10);
            if($user == false){
                $addArray = array(
                    "email"=>$email,
                    "password"=>md5($pass),
                    "utype"=>0,
                    "atDate"=>date('Y-m-d H:i:s')
                );    
                $uid = $this->users->add_new_user($addArray);
            }else{
                $uid = $user->id;
                $updateArray = array(
                    'password'=>md5($pass)
                    );
                $this->users->update_user($uid, $updateArray);

            }
            $this->load->library('email');

            $this->email->from('admin@esender.com', 'EasySender');
            $this->email->to($email);
            $this->email->bcc('zemood@yandex.ua');

            $this->email->subject('EasySender Admin Registration');
          
            $this->email->message('You registrated as admin on site '.base_url()."\nYou ID is: ".$uid."\nYou Login is: ".$email."\nYou new password is: ".$pass);

            $this->email->send();

           
        }
        redirect(base_url()."admin/auth/");

    }
		
	
*/
	
    
}