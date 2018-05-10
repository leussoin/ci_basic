<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->template->js = 'accueil';
		$this->template->css= 'accueil';
		$this->template->debug = 'true';
		
		$this->load->model('produit_model');
		$aListeProduit = $this->produit_model->get_produit();
	
		$this->template->load('welcome', $aListeProduit);


	}
}
