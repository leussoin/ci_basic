<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	var $data = array(
		'debug' => FALSE,
		'js' => 'form'
	);

	public function index()
	{
		$this->template->load('welcome', $this->data);
	}

	public function test()
	{
		$this->data['debug'] = TRUE;
		$this->template->load('welcome', $this->data);
	}
}
