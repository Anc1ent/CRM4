<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailchump extends CRM_Controller {

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



    //--------------------------

    /**
    Add mass dispatch pack (one email for each selected quote will be added)
    ATTENTION! Mailchimp doesnt update created list for at least 5 mins. If you want to check MC list you need to wait for members to show up!
    YOU CANT SEND UNTIL MEMEBERS SHOW UP!!!
     */
    public function email_mass_launch()
    {
        $debug = 1;
        $user = $this->autorize();
        $this->user =  $user;
        $qid = $this->input->post('qid');
        $eid = $this->input->post('eid');
        $todate = $this->input->post('todate');
        $todate = date('Y-m-d H:i:s', strtotime($todate));
        //$specEmail = $this->input->post('specEmail');
        //check POST
        if(!$this->is_id_correct($qid)){
            print_r("Wrong POST data or length");
            print_r("POST DATA: qid=".$qid);
            exit;
        }
        if(!$this->is_id_correct($eid)){
            print_r("Wrong POST data or length");
            print_r("POST DATA: eid=".$eid);
            exit;
        }
        if(!$this->is_date_correct($todate)){
            print_r("Wrong POST data or length");
            print_r("POST DATA: todate=".$todate);
            exit;
        }
        //check POST end

        $date = date('Y-m-d H:i:s');
        $qids = explode('`', $qid);
        $count = 0;
        $techmailid = 0;
        $todate = date('Y-m-d H:i:s', strtotime($todate."+2 minutes"));
        foreach($qids as $qid)
        {
            if($qid != "")
            {
                if($count == 0) //PREPARE START //Prepare MC stuff before running first quote
                {
                    $addArray = array(
                        'eid'=>$eid,
                        'qid'=>$qid,
                        'atDate'=>$date,
                        'sendAtDate'=>$todate,
                        'specEmail'=>"TECHADRESS",
                    );
                    $techmailid = $this->emails->emails_mass_add_to_waiting($addArray);     //Create TECHMAIL and add it to waiting emails.(TECHMAIL will be sended to TECHADRESS)
                    $this->emails->set_techmail_waiting_mass_id($techmailid);               //Set mass_id field for current TECHMAIL in emails_waiting
                    $mc_listid = $this->emails->mc_list_create();                           //Create empty list on Mailchimp and fill default requsites
                    if(isset($mc_listid['status']) AND isset($mc_listid['detail']))
                    {
                        print_r("\nmc_list_create Error\n");
                        print_r($mc_listid);
                        print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                        //die();
                    }
                    else
                    {
                        $mc_listid = $mc_listid['id'];
                        if($debug == 1){print_r("mc_listid = ".$mc_listid."\n");}
                    }
                    $email = $this->emails->get_email_by_id($eid);
                    $campaign_id = $this->emails->mc_campaign_create($mc_listid, $email);       //Create campaign (without template) on Mailchimp and fill some default requsites
                    if(isset($campaign_id['status']) AND isset($campaign_id['detail']))
                    {
                        print_r("\nmc_campaign_create Error\n");
                        print_r($campaign_id);
                        print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                        //die();
                    }
                    else
                    {
                        $campaign_id = $campaign_id['id'];
                        if($debug == 1){print_r("campaign id ".$campaign_id."\n");}
                    }

                    $chArray = array(     //this array contains all possible tags for email template in database as keys and corresponding merge fields in Mailchimp as values
                        '[quote_number]'=>'*|QUOTE_NUMB|*',
                        '[order_number]'=>'*|ORDRNBR|*',
                        '[first_name]'=>'*|FIRST_NAME|*',
                        '[origin_state_code]'=>'*|ORG_ST_COD|*',
                        '[destination_state_code]'=>'*|DESTSTCODE|*',
                        '[vehicle_list]'=>'*|VHCL_LIST|*',
                        '[ship_via]'=>'*|SHIP_VIA|*',
                        '[operable_inop]'=>'*|OPR_INOP|*',
                        '[estimated_load_date]'=>'*|ESTLOADDT|*',
                        '[estimated_delivery_date]'=>'*|ESTDLVRDAT|*',
                        '[deposit_required]'=>'*|DEPOSREQ|*',
                        '[pickup_contact]'=>'*|PCKCNTCT|*',
                        '[pickup_phone]'=>'*|PCKPHN|*',
                        '[pickup_phone2]'=>'*|PCKPHN2|*',
                        '[pickup_phone3]'=>'*|PCKPHN3|*',
                        '[pickup_phone_cell]'=>'*|PCKPHNCELL|*',
                        '[pickup_address]'=>'*|PCKADRSS|*',
                        '[pickup_city]'=>'*|PCKCITY|*',
                        '[pickup_state_code]'=>'*|PCKSTCODE|*',
                        '[dropoff_contact]'=>'*|DRPCNTCT|*',
                        '[dropoff_phone]'=>'*|DRPPHN|*',
                        '[dropoff_phone2]'=>'*|DRPPHN2|*',
                        '[dropoff_phone3]'=>'*|DRPPHN3|*',
                        '[dropoff_phone_cell]'=>'*|DRPPHNCELL|*',
                        '[dropoff_address]'=>'*|DRPADR|*',
                        '[dropoff_city]'=>'*|DRPCITY|*',
                        '[dropoff_state_code]'=>'*|DRPSTCODE|*',
                        '[note_to_shipper]'=>'*|NOTESHIP|*',
                        '[u_name]'=>'*|UNAME|*',
                        '[cod_amount]'=>'*|COD|*',
                        '[first_pickup_date]'=>'*|FPCKDATE|*',
                        '[tariff]'=>'*|TARIFF|*',
                        '[phone]'=>'*|PHONE|*',
                        '[vehicle_make]'=>'*|VHCLMAKE|*',
                        '[vehicle_model]'=>'*|VHCLMDL|*',
                        '[origin_city]'=>'*|ORGCITY|*',
                        '[destination_city]'=>'*|DESTCITY|*',
                        '[estimated_ship_date]'=>'*|ESTSHPDATE|*',
                        '[EID]'=>'*|EID|*',
                        '[Qid]'=>'*|QID|*',
                        '[Eid]'=>'*|EID2|*',
                        '[carrier_name]'=>'*|CARIENAME|*',
                        '[carrier_phone1]'=>'*|CARIEPHONE|*',
                        '[driver_phone]'=>'*|DRIVPHONE|*',
                        '[carrier_phone2]'=>'*|CARIEPHN2|*',
                        '[token]'=>'*|TOKEN|*',
                    );
                    $merge_fields = array('[mass_id]'=>'*|EMID|*'); //mass_id needed for Mailchimp report
                    foreach($chArray as $key => $value)
                    {
                        if(strpos($email->text, $key) OR strpos($email->subject, $key)) //now we check which tags exist in selected email template in database...
                        {
                            $merge_fields[$key] = $value;                               //...and create new array with only those tags
                        }
                    }

                    $response_merge = $this->emails->mc_list_merge_fields_assign($mc_listid, $merge_fields);    //Assign existing tags as merge_fields in Mailchimp
                    if($response_merge !== 0)                                                                   //ATTENTION! Mailchimp allows only 30 tags on non-Pro account.
                    {
                        print_r("\nmc_list_merge_fields_assign Error\n");
                        print_r($response_merge);
                        print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                        $this->emails->email_mass_error_clear($techmailid); //if error happens delete already created mass launch data
                        //die();
                    }
                    else
                    {
                        if($debug == 1){print_r("Merge fields assigned successfully\n");}
                    }
                    //$campaign_id = $this->emails->email_mass_get_queue_item_by_mass_id($techmailid);
                    //$campaign_id = $campaign_id->campaign_id;
                    //if($debug == 1){print_r("campaign_id = ".$campaign_id."\n");}

                    $response_campaign_content = $this->emails->mc_campaign_content_set($campaign_id, $email);      //Assign campaign content (template) in Mailchimp
                    if(isset($response_campaign_content['status']) AND isset($response_campaign_content['detail']))
                    {
                        print_r("\nmc_campaign_content_add Error\n");
                        print_r($response_campaign_content);
                        print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                        $this->emails->email_mass_error_clear($techmailid); //if error happens delete already created mass launch data
                        //die();
                    }
                    else
                    {
                        if($debug == 1){print_r("campaign content added successfully\n");}
                    }

                    $qArray = array(
                        'campaign_id'=>$campaign_id,
                        'list_id'=>$mc_listid,
                        'date_added'=>date('Y-m-d H:i:s'),
                        'mass_id'=>$techmailid
                    );
                    $this->emails->emails_mass_add_queue_item($qArray);     //Create new row in emails_mass_queue. Each row = one mass dispatch
                } //PREPARE END //MC stuff ready, but list is still have no members(subscribers, emails)

                $emailInfo = $this->emails->get_email_by_id($eid);
                $quote = $this->quotes->get_quote_by_id_full($qid);

                $addArray = array(
                    'eid'=>$eid,
                    'qid'=>$qid,
                    'atDate'=>$date,
                    'sendAtDate'=>$todate,
                    'specEmail'=>$quote->Email,
                    'mass_id'=>$techmailid          //this row unifies one mass dispatch.
                );
                $newid = $this->emails->emails_mass_add_to_waiting($addArray);  //Add one waiting mass email to each quote
                $this->statistic->email_send_action($qid, $user->id, "ADD EMAIL TO SEND (MASS) (".$emailInfo->name.")", -1);
                $count++;

            }
        }
        if($techmailid !== 0){      //if $techmailid is 0 then something bad and really strange happened
            $masslist = $this->emails->get_emails_waiting_by_mass_id($techmailid);          //Now we take all our waiting mass emails for current run
        }
        else{
            if($debug){print_r(PHP_EOL."Critical error! techmailid = 0");}
            exit;
        }

        if(isset($masslist) AND $masslist->num_rows() > 0)
        {
            $count2 = 0;
            foreach ($masslist->result() as $mail)
            {
                if($debug == 1){print_r("\nMASSLIST # ".$count2." START\n");}
                if($debug == 1){print_r("id->".$mail->id."\nspecEmail->".$mail->specEmail."\nmass_id->".$mail->mass_id."\n");}
                //$sendedid = $this->emails->email_mass_waiting_to_sended($mail->id);
                $args = 0;
                if($mail->specEmail == "TECHADRESS")
                {
                    //$tech_sended_id = $sendedid;
                    //if($debug){print_r("TA tech_sended_id = ".$tech_sended_id."\n");}
                    $args = $this->emails->mc_list_member_create_args($mail->qid, $merge_fields, $techmailid, 1);   //Creating info array to add members in MC list. TECHMAIL have a special email adress
                    if($debug){print_r("TA args[email_address]= ".$args['email_address']."\n");}
                }
                else
                {
                    $args = $this->emails->mc_list_member_create_args($mail->qid, $merge_fields, $techmailid);      //Creating info array to add members in MC list
                    if($debug){print_r("not TA args[email_address]= ".$args['email_address']."\n");}
                }
                $memberId = md5(strtolower($args['email_address']));                                        //  <-Members in MC list have such id
                $response = $this->emails->mc_list_member_add($memberId, $mc_listid, $args);                // Adding members to MC list
                if(isset($response['status']) AND isset($response['detail']))
                {
                    print_r("\nmc_list_member_add Error\n");
                    print_r($response);
                    print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                    //die();
                }
                else
                {
                    if($debug == 1){print_r("memberid ".$response['id']."\n");}
                }

                if($debug == 1){print_r("\nMASSLIST # ".$count2." END\n");}
                $count2++;
            }
        }
            /**At the and of this method we have:
            1. # of emails equal to # of selected quotes
            2. One techmail with TECHADRESS which can be seen in waiting emails list in quote with lowest id (or first selected)
            3. Filled MC list with # of memebers equal to # of selected quotes and one additional member for techmail
            4. Filled MC campaign with template.
            5. Mass queue item in corresponding db table with with filled campaign_id, list_id, date_added and mass_id
            ATTENTION! Mailchimp doesnt update created list for at least 5 mins. If you want to check MC list you need to wait for members to show up! YOU CANT SEND UNTIL MEMEBERS SHOW UP!!!
             */
    }

    /**
    //This function must be launched once every 60 minutes
    //Start checking technical address to update status of previously sended mass dispatches.
    //Send expired mass dispatches
     */
    public function mass_CRON()
    {
        ini_set('MAX_EXECUTION_TIME', -1);
        $this->mc_check_techadress();       //ATTENTION! Mailchimp takes time for report to show up. If you try to check before report show up - update still work, but info about statuses can be incorrect, bounced emails cant be detected
                                            //Time to report show up varies. Observed min time - 15 minutes. Observed max time 120 minutes. (yes, mc is shit)
        $this->email_mass_send_expired_waiting();
    }

    //Check technical adress for unseen messages and if there is any - start status update
    private function mc_check_techadress()
    {
        $debug = 1;
        $user  = MAILCHIMP_TECHADRESS1_EMAIL;       //[TECHADRESS]
        $pass = MAILCHIMP_TECHADRESS1_PASS;
        $connect = imap_open('{imap.mail.ru:993/imap/ssl}INBOX',$user, $pass);
        /*
        if ($connect) {
            print_r('Successful\n');
        } else {
            print_r('Failed');
            die;
        }
        */
        $mails = NULL;
        $mails = imap_search($connect, 'UNSEEN');//'UNSEEN'
        if($mails != NULL)
        {
            foreach($mails as $mail)
            {
                $structure = imap_fetchstructure($connect, $mail);
                if ($structure->type == 1)
                {
                    $email['body'] = imap_fetchbody($connect, $mail, '1');
                    $parts = array();
                    $this->emails->getParts($structure, $parts);
                    $i = 0;
                    foreach ($parts as $part)
                    {
                        // Not text or multipart
                        if ($part['type'] > 1) {
                            $file = imap_fetchbody($connect, $mail, $i);
                            $mail['files'][] = array('content'  => base64_decode($file),
                                'filename' => $part['params'][0]['val'],
                                'size'     => $part['bytes']);
                        }
                        $i++;
                    }
                }
                else
                {
                    $email['body'] = imap_body($connect, $mail);
                }
                if(preg_match ("/(`)(.*)(`)/", $email['body']) AND preg_match ("/(<\|)(.*)(\|>)/", $email['body'])) //check is mail have needed info. mass_id encased in '`' like `EMID 2595` and email is like |>emailadress@gmail.com<|
                {

                    $massidblock = explode("`", $email['body'], 3);
                    $massidblock = explode(" ", $massidblock[1]);
                    $massid = $massidblock[1];
                    if($debug){print_r("massid =".$massid);}

                    /*
                    $emailblock = explode("\|>", $email['body'], 2);
                    $emailblock = explode("<\|", $emailblock[1]);
                    $email = (int)$emailblock[0];
                    if($debug){print_r("email =".$massid);}
                    */
                    $this->email_mass_check_status($massid);
                }
            }
        }
    }

    //Check sended emails statuses on Mailchimp and change them if needed in database
    private function email_mass_check_status($mass_id)
    {
        $debug = 1;
        $mass_item = $this->emails->email_mass_get_queue_item_by_mass_id($mass_id); //get mass queue item
        $tech_id = $mass_item->mass_id;
        if($tech_id == 0)
        {
            echo "Critical error. tech_id = 0. Status wont be updated.";
            exit;
        }
        $sendedarray = $this->emails->get_mass_sended($tech_id);                //get all sended emails with corresponding mass_id
        $mcreport = $this->emails->mc_campaign_report($mass_item->campaign_id); //get campaign report
        if(isset($mcreport['status']) AND isset($mcreport['detail']))
        {
            print_r("\nmc_campaign_report Error\n");
            print_r($mcreport);
            print_r("\n^^^^^^^^^^^^^^^^^^^\n");
            die();
        }
        else
        {
            $mcreport = $mcreport['emails'];
            if($debug == 1){print_r("Report received successfully\n");}
            if($debug == 1){print_r($mcreport);print_r("\n");}
        }
        foreach($sendedarray->result() as $item)
        {
            if($debug == 1){print_r("id ".$item->id." start\n");}
            $quote = $this->quotes->get_quote_by_id_full($item->qid);
            $specEmail = $item->specEmail;
            if($specEmail == 'TECHADRESS')
            {
                $key = FALSE;
                $this->emails->delete_emails_sended_by_id($item->id);   //Delete techmail in emails_sended
            }
            else
            {
                if($debug == 1){print_r("check before key\n");}
                //$key = array_search($specEmail, array_column($mcreport, 'email_address'));  //doesnt work with PHP 5.2
                $f = 1;
                $count = 0;
                $key = FALSE;
                while($f)       //find email with techadress in report array
                {
                    if($mcreport[$count]['email_address'] == $specEmail)
                    {
                        $f = 0;
                        $key = (int)$count;
                    }
                    $count++;
                }
                if($debug == 1){print_r("check after key\n");}
            }
            if($debug == 1){print_r("Key = ");print_r($key);print_r("\n");}
            if($key !== FALSE)
            {
                if(isset($mcreport[$key]['activity'][0]) AND $mcreport[$key]['activity'][0]['action'] == "bounce" AND $mcreport[$key]['activity'][0]['type'] == "hard")
                {                                   //if email was bounced in MC update emails status and quotes status in db
                    $this->emails->set_quote_status($item->qid, 3);
                    $this->emails->set_emails_sended_status_by_id($item->id, 2);
                    if($debug == 1){print_r("Quote #".$item->qid." Email ".$specEmail." was bounced\n");}
                }
                elseif(isset($mcreport[$key]['activity'][0]) AND $mcreport[$key]['activity'][0]['action'] == "open")
                {
                    if($debug == 1){print_r("Quote #".$item->qid." Email ".$specEmail." was opened\n");}
                }
                else
                {
                    if($debug == 1){print_r("Quote #".$item->qid." Email ".$specEmail." was not bounced or opened\n");}
                }
            }
            else
            {
                if($debug == 1){print_r("Key = False\n");}
            }
            if($debug == 1){print_r("id ".$item->id." end\n");}
        }
        $response_delete_campaign = $this->emails->mc_campaign_delete($mass_item->campaign_id);     //
        $response_delete_list = $this->emails->mc_list_delete($mass_item->list_id);                 //Clear remaining data at the end
        $this->emails->emails_mass_delete_queue_item($mass_item->id);                               //
    }

    //launch expired mass dispatches
    private function email_mass_send_expired_waiting()
    {
        ini_set('MAX_EXECUTION_TIME', -1);
        $debug = 1;
        $launchpack = array();
        $techqueue = $this->emails->get_emails_mass_items_not_sended();     //get all not sended dispatches
        $count1 = 0;
        $now = new DateTime();
        //$now->add(new DateInterval('PT10M'));
        if($techqueue->num_rows() > 0)
        {
            foreach ($techqueue->result() as $techmail)
            {
                $sendtime = $this->emails->get_mass_sendtime_by_mass_id($techmail->mass_id);        //Get corresponding technical email from waiting emails and...
                $sendtime = DateTime::createFromFormat('Y-m-d H:i:s', $sendtime->sendAtDate);
                $sendtime->add(new DateInterval('PT4M'));
                if($now > $sendtime)                                                                //...check is it time to send it
                {
                    $launchpack[$techmail->id]['campaign_id'] = $techmail->campaign_id;             //create launchpack of all mass dispatches which will be sended in this method
                    //$launchpack[$techmail->id]['tech_sended_id'] = $tech_sended_id;
                    $launchpack[$techmail->id]['techmail_mass_id'] = $techmail->mass_id;
                    $count1++;
                }
            }
        }
        else exit;
        if($count1 > 0)
        {   //and there we go
            foreach ($launchpack as $start)
            {
                if($debug == 1){print_r("\n------------------------------");}
                if($debug == 1){print_r("\nLAUNCH CAMPAIGN ID ".$start['campaign_id']." START\n");}
                //ATTENTION! Mailchimp doesnt update created list for at least 5 mins. If you want to check MC list you need to wait for members to show up!
                // YOU CANT SEND UNTIL MEMEBERS SHOW UP!!!
                $flag = 1;
                while($flag)    //in this while block we check is campaign ready to send. If not ready, we wait 30 sec. and ckeck again. Repeat until ready or tries exceeds 20 times.
                {
                    $response_checklist = $this->emails->mc_checklist($start['campaign_id']);       //check MC campaign send readiness.
                    if(isset($response_checklist['status']) AND isset($response_checklist['detail']))
                    {
                        print_r("\nmc_checklist Error\n");
                        print_r($response_checklist);
                        print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                        $this->emails->email_mass_error_clear($start['techmail_mass_id']);  //if error happens delete already created mass launch data
                        //die();
                    }
                    else
                    {
                        if($debug == 1){print_r("campaign checklist flag <".$flag.">:\n");print_r($response_checklist);print_r("\n");}
                    }
                    if($response_checklist['items'][0]['type'] == 'error' AND $response_checklist['items'][0]['id'] == 501) //if type = 'error' - MC campaign not ready
                    {
                        $flag++;
                        if($flag > 20)
                        {
                            $flag = 0;
                        }
                        else
                        {
                            sleep(30);
                        }
                    }
                    else
                    {
                        $flag = 0;
                    }
                }
                $response_campaign_send = $this->emails->mc_campaign_send($start['campaign_id']);           //Sending campaign
                if(isset($response_campaign_send['status']) AND isset($response_campaign_send['detail']))
                {
                    print_r("\nmc_campaign_send Error\n");
                    print_r($response_campaign_send);
                    print_r("\n^^^^^^^^^^^^^^^^^^^\n");
                    $this->emails->email_mass_error_clear($start['techmail_mass_id']);  //if error happens delete already created mass launch data
                    exit();
                }
                else
                {
                    if($debug == 1){print_r("campaign sent successfully\n");}
                }
                $mails = $this->emails->get_mass_emails_waiting_by_mass_id($start['techmail_mass_id']);
                foreach ($mails->result() as $mail){
                    $this->emails->email_mass_waiting_to_sended($mail->id);                         //transfer all waiting emails for current dispatch to sended emails
                }

                $updArray = array(
                    'date_launched'=>date('Y-m-d H:i:s'),
                    'mass_id'=>$start['techmail_mass_id'],
                    'sended_id'=>1
                );
                if($debug){print_r("updArray\n");print_r($updArray);print_r("\n");}
                $this->emails->email_mass_update_queue_item($updArray);                             //update emails mass queue item with sended = 1.

                if($debug == 1){print_r("\nLAUNCH CAMPAIGN ID ".$start['campaign_id']." END\n");}
                if($debug == 1){print_r("\n------------------------------");}
            }
        }
    }

    // Mailchaump change email status (used for picture beacon)
    public function chEmailstatusChimp($esid)
    {
        $esid = (int)$esid;
        $this->db->where('id', $esid);
        $es = $this->db->get('emails_sended')->row();

        $this->db->where('id', $es->qid);
        $this->db->update('quotes', array('activeEmail'=>1));


        if($es->status == 0){
            $this->db->set('emailsOpened', 'emailsOpened+1', FALSE);
            $this->db->where('id', $es->qid);
            $this->db->update('quotes');
        }

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

        $this->db->where('id', $esid);
        $this->db->update('emails_sended', array('status'=>1, 'openedDate'=>date('Y-m-d H:i:s'), 'openIP'=>$ipaddress));
        $this->statistic->email_send_action($es->qid, '0', "OPENED EMAIL (".$es->qid.")", '1');

    }


}