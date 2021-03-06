<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('ADMIN_LOGIN', 'root');
define('ADMIN_PASSWORD', 'root');

define( 'MAILCHIMP_TECHADRESS1_EMAIL', 'anc.test1@mail.ru' );
define( 'MAILCHIMP_TECHADRESS1_PASS', 'ro1vae78r' );
define( 'MAILCHIMP_TECHADRESS2_EMAIL', 'anc.test2@mail.ru' );
define( 'MAILCHIMP_TECHADRESS2_PASS', 'ro1vae78r' );
define( 'MAILCHIMP_TECHADRESS3_EMAIL', 'anc.test3@mail.ru' );
define( 'MAILCHIMP_TECHADRESS3_PASS', 'ro1vae78r' );
define( 'MAILCHIMP_TECHADRESS4_EMAIL', 'anc.test4@mail.ru' );
define( 'MAILCHIMP_TECHADRESS4_PASS', 'ro1vae78r' );
define( 'MAILCHIMP_TECHADRESS5_EMAIL', 'anc.test5@mail.ru' );
define( 'MAILCHIMP_TECHADRESS5_PASS', 'ro1vae78r' );

define( 'MAILCHIMP_SERVER_URL', 'https://us14.api.mailchimp.com/3.0' );
define( 'MAILCHIMP_API_KEY', 'user:9b3c8b114c9042edbcc02956d6450ea5-us14' );

// https://login.sendpulse.com/settings/#api
define( 'API_USER_ID', '38c7c5d901758ada73bbf3d32264613f' );
define( 'API_SECRET', '97def00d4e5d08c226bcd54eee5b66a5' );

define( 'TOKEN_STORAGE', 'file' );

/* End of file constants.php */
/* Location: ./application/config/constants.php */