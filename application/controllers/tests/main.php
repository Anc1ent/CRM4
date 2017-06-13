<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CRM_Controller {

  protected $user; 

  public function __construct(){
        parent::__construct();
        $user = $this->autorize();
        $this->user =  $user;
  } 

 
  public function index()
  {
      echo "FU...";
      exit();
  }

    public function main_page(){
        $counter = 0;

        $Glinks[] = base_url();

        //STATISTIC
/*
        $Glinks[] = base_url().'admin/main/get_quote_notices';
        $Glinks[] = base_url().'admin/main/add_notice';
        $Glinks[] = base_url().'admin/main/update_action_as_read';
        $Glinks[] = base_url().'admin/main/update_openemail_as_read';
        $Glinks[] = base_url().'admin/main/get_alerts_list';
        $Glinks[] = base_url().'admin/main/get_Bstatistic';
        $Glinks[] = base_url().'admin/emails/get_emails_stat';
        $Glinks[] = base_url().'admin/emails/get_emails_teble_stat';
        $Glinks[] = base_url().'admin/emails/get_forms_stat';
*/
        foreach($Glinks as $route){
            if($counter > 2){
                $links[] = array('url' => $route, 'params' => "&qid=0");
            }
            $counter++;
        }

        //QUOTES
/*
        $Qlinks[] = base_url().'admin/main/set_limit/$1';                                          //ARG:limit=20 -> 20 items in table;
        $Qlinks[] = base_url().'admin/main/set_sort/$1';                                           //ARG:s=0/1 -> ASC||DESC;  sort='price'||... -> column name
        $Qlinks[] = base_url().'admin/main/get_fullinfo';                                          //ARG:qid
        $Qlinks[] = base_url().'admin/main/get_bookit';                                            //ARG:qid
        $Qlinks[] = base_url().'admin/main/get_dispatch';                                          //ARG:qid
        $Qlinks[] = base_url().'admin/main/set_quote_part';                                        //ARG:'qid':qid, 'spart':spart
        $Qlinks[] = base_url().'admin/main/update_fullinfo_quote';                                 //ARG:"pAddr":pAddr, "dAddr":dAddr, "pricePMValG":pricePMValG, "Fname":Fname, "Femail":Femail, "Fphone":Fphone, "FcarMake":FcarMake, "FcarModel":FcarModel, "FdistFromCity":FdistFromCity, "FdistFromState":FdistFromState, "FdistFromZip":FdistFromZip, "FdistToCity":FdistToCity, "FdistToState":FdistToState, "FdistToZip":FdistToZip, "Fdistance":Fdistance, "FarrDate":FarrDate, "FtotalPrice":FtotalPrice, "Fdeposit":Fdeposit, "priceValF":priceValF, 'qid':qid
        $Qlinks[] = base_url().'admin/main/update_quote';
        $Qlinks[] = base_url().'admin/main/update_quote_order';
        $Qlinks[] = base_url().'admin/main/update_quote_dispatch';
        $Qlinks[] = base_url().'admin/main/add_empty_lead';
        $Qlinks[] = base_url().'admin/main/add_info_rows_to_quotes';
        $Qlinks[] = base_url().'admin/main/set_price_per_mile';                                    //RETURN:echo $tarif = (($price_per_mile*$dist)+$quote->deposit);
        $Qlinks[] = base_url().'admin/main/set_quote_new_value';                                   //ARG:qid;name->parameter name; value->parameter value
        $Qlinks[] = base_url().'admin/main/set_contact_new_value';                                 //ARG:qid;name->parameter name; value->parameter value
        $Qlinks[] = base_url().'admin/main/docharge';
        $Qlinks[] = base_url().'admin/main/get_more_quots';                                        //'getMore':ipage; 'spart':selectedUpMenu2
        $Qlinks[] = base_url().'admin/main/get_quots_search';
        $Qlinks[] = base_url().'admin/main/get_carpic';
        $Qlinks[] = base_url().'admin/main/convertToQuote';
        $Qlinks[] = base_url().'admin/main/get_quote_history';
        $Qlinks[] = base_url().'admin/main/get_quots_part';                                        //partid= (int)"0"=> "Leads", "1"=>"Quotes", "2"=>"Orders", "3"=>"Archive"
        $Qlinks[] = base_url().'admin/main/get_quots_part/$1';
        $Qlinks[] = base_url().'admin/main/show_fullinfo_quote/$1';
        $Qlinks[] = base_url().'admin/main/get_dist/$1';

        if(isset($Qlinks)){//QUOTES
            foreach($Qlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0&limit=50&partid=1&getMore=1&spart=1");
                }
                $counter++;
            }
        }
*/

        //MENU

        $Menulinks[] = base_url().'admin/main/add_second_menu';                                  //ARG:spart="0"=> "Leads", "1"=>"Quotes", "2"=>"Orders", "3"=>"Archive";  sname="New Folder Name"
        $Menulinks[] = base_url().'admin/main/del_second_menu';                                  //ARG:did=(int)folders_id_to_delete

        if(isset($Menulinks)){//MENU
            foreach($Menulinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&spart=0&sname=FolderCreatedByTest");
                }
                $counter++;
            }
        }

        //INTEGRATIONS

        //$Integlinks[] = base_url().'admin/main/add_dest_price/$1';//not used anywhere      //ARG:$qid, $val
        //$Integlinks[] = base_url().'admin/main/add_cdtoken/$1'; //not used anywhere        //ARG:$token
        if(isset($Integlinks)){//INTEGRATIONS
            foreach($Integlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "");
                }
                $counter++;
            }
        }

        /* SETTINGS */

        $Settlinks[] = base_url().'admin/main/add_emails_to_list';                                //ARG:eid;fid->folder id
        $Settlinks[] = base_url().'admin/main/chemailvalue';                                      //ARG:name->name of column; value->value of column; id->id of field
        $Settlinks[] = base_url().'admin/main/addchemail';
        $Settlinks[] = base_url().'admin/main/get_perscab_page';
        //$Settlinks[] = base_url().'admin/main/crm_user_update_info';
        $Settlinks[] = base_url().'admin/main/get_email_change';                                     //ARG:eid
        $Settlinks[] = base_url().'admin/main/deleteemail/0/';//Profile brocken,but method works
        $Settlinks[] = base_url().'admin/main/deleteemailfromfolder/0/';

        if(isset($Settlinks)){//SETTINGS
            foreach($Settlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&eid=0&fid=95");
                }
                $counter++;
            }
        }

        /* DRIVERS */

        $Driverslinks[] = base_url().'admin/main/get_drivers_table';
        $Driverslinks[] = base_url().'admin/main/get_localcompanies_table';
        $Driverslinks[] = base_url().'admin/main/get_favorites_table';
        $Driverslinks[] = base_url().'admin/main/add_favorites';
        $Driverslinks[] = base_url().'admin/main/remove_favorites';

        if(isset($Driverslinks)){//DRIVERS
            foreach($Driverslinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&eid=0&fid=95");
                }
                $counter++;
            }
        }

        /* SMS */

        $Smslinks[] = base_url().'admin/main/sms_launch_block';
        $Smslinks[] = base_url().'admin/main/get_sms_change';
        $Smslinks[] = base_url().'admin/main/addchsms';               //Sname - sms name | Etext2 - sms body(text) | Eid - sms template id | OnlyInworkTime | sendToDriver('on'||anything)|
        $Smslinks[] = base_url().'admin/emails/delete_SMS_waiting';
        $Smslinks[] = base_url().'admin/emails/smstotextarea';
        $Smslinks[] = base_url().'admin/emails/sms_sended_to_waiting';
        $Smslinks[] = base_url().'admin/emails/smstextsave';
        $Smslinks[] = base_url().'admin/emails/add_sms_to_send';
        //$Smslinks[] = base_url().'sms/main/send_one_SMS';
        //$Smslinks[] = base_url().'sms/main/send_all_expired_sms';    //ATTENTION! does not need any params. Launches all expired sms

        if(isset($Smslinks)){//SMS
            foreach($Smslinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0&smsid=0&wid=0&selector=12&new_text=Text_generated_by_test&OnlyInworkTime=1&sendToDriver=on");
                }
                $counter++;
            }
        }

        /* DASHBOARD */

        $Dashlinks[] = base_url().'admin/main/dashboard';

        if(isset($Dashlinks)){//DASHBOARD
            foreach($Dashlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "");
                }
                $counter++;
            }
        }

        /* EMAILS STATISTIC */

        $Estatlinks[] = base_url().'admin/emails/get_quote_sended';
        $Estatlinks[] = base_url().'admin/emails/chEmailstatus/0/';
        $Estatlinks[] = base_url().'admin/emails/update_email_as_readed';             //ARG:REid->recieved email id
        $Estatlinks[] = base_url().'admin/emails/delete_email_recived';                 //ARG:REid->recieved email id
        $Estatlinks[] = base_url().'admin/emails/email_sended_to_waiting';              //ARG:semail_id->sended id; semail_eid->sended template id; qid; todate; specemail->adress
        $Estatlinks[] = base_url().'admin/emails/delete_email_waiting';                  //ARG:wemail_id

        if(isset($Estatlinks)){//EMAILS STATISTIC
            foreach($Estatlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0");
                }
                $counter++;
            }
        }

        /* EMAIlS ENGINE */

        //$Emailenglinks[] = base_url().'emails/main/add_email_to_send';
        //$Emailenglinks[] = base_url().'emails/main/send_one_email';       //not used anywhere
        //$Emailenglinks[] = base_url().'emails/main/send_email';           //mandrill
        //$Emailenglinks[] = base_url().'emails/main/send_email_sendpulse';
        //$Emailenglinks[] = base_url().'emails/main/send_all_waiting';

        if(isset($Emailenglinks)){//EMAIlS ENGINE
            foreach($Emailenglinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0");
                }
                $counter++;
            }
        }

        /* EMAILS LAUNCHER */

        $Emaillauncherlinks[] = base_url().'admin/emails/drivers_launch_block';
        $Emaillauncherlinks[] = base_url().'admin/emails/empty_launch_block';
        $Emaillauncherlinks[] = base_url().'admin/emails/mass_launch_block';             //ARG:isMass=0||1;qid;

        if(isset($Emaillauncherlinks)){//EMAILS LAUNCHER
            foreach($Emaillauncherlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0");
                }
                $counter++;
            }
        }

        /* EMAILS READER */

        //$Emailreadlinks[] = base_url().'emails/reader/get_all_emails_leads';      parsing leads
        //$Emailreadlinks[] = base_url().'emails/reader/get_all_emails_answers';

        if(isset($Emailreadlinks)){//EMAILS READER
            foreach($Emailreadlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0");
                }
                $counter++;
            }
        }

        /* USERS */

        //$Userlinks[] = base_url().'admin/auth/enter';
        //$Userlinks[] = base_url().'admin/auth/auth';
        //$Userlinks[] = base_url().'admin/auth/logout';

        if(isset($Userlinks)){//USERS
            foreach($Userlinks as $route){
                if($counter > 2){
                    $links[] = array('url' => $route, 'params' => "&qid=0");
                }
                $counter++;
            }
        }
   // $links[] = array('url' => base_url().'quotes/main/get_fullinfo', 'params' => "&qid=0&eid=0");
    $data['links'] = $links;
    $this->load->view('tests/header' ,$data);
    $this->load->view('tests/main' , $data);
    $this->load->view('tests/footer' ,$data);
  }

 

  
	
}