<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function index()
	{
        echo '<h1>SUPERVISEUR CRON</h1>';
        echo 'cmd : ls -al <br>';
        var_dump( exec( 'ls -al' ) );
    }

    public function message($to = 'World')
    {
        if(! is_cli() ) {
            show_404();
        }

        echo 'Hello ' . $to; 
    }
}
