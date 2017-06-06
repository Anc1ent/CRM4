<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    
   public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->model('quotes_model', 'quotes');
        session_start();
    }      
     
	public function index()
	{
       redirect(base_url()."admin/enter", 'refresh');
	}

	
}