<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->template->js = 'form';
		$this->template->debug = 'true';
		$this->template->load('welcome', array('js' => 'bob'));
	}
}
