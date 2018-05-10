<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function index()
	{
        $cmd = 'bob';
        $this->template->debug = TRUE;
        $this->template->load('exemple/cron', array($cmd));
    }

    public function message($to = 'World')
    {
        if(! is_cli() ) {
            show_404();
        }

        echo 'Hello ' . $to; 
    }
}
