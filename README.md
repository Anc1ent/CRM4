# CRM4
  MAILCHIMP
  
    New table for mailchimp.
    
        --------------------------------------------------------------------
        CREATE TABLE `emails_mass_queue` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `campaign_id` varchar(45) NOT NULL,
          `list_id` varchar(45) NOT NULL,
          `date_added` datetime NOT NULL,
          `date_launched` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          `mass_id` int(11) NOT NULL,
          `sended_id` int(11) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        --------------------------------------------------------------------

    Alter old tables
    
        --------------------------------------------------------------------
        ALTER TABLE `emails_sended`
        ADD COLUMN `mass_id` INT(11) NOT NULL DEFAULT '0' AFTER `mandrill_id`;
        --------------------------------------------------------------------
        ALTER TABLE `emails_waiting`
        ADD COLUMN `mass_id` INT(11) NOT NULL DEFAULT '0' AFTER `status`;
        --------------------------------------------------------------------
        
