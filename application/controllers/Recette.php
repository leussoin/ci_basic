<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recette extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('recette_model');
	}

	// --- VIEW --- //

	public function index()
	{	
		$recette = $this->recette_model->gets();
		
		$this->template->load('recette/list', $recette);
	}

	public function detail($id)
	{
		$detail = $this->recette_model->get($id);
		$this->template->debug = true;
		$this->template->load('recette/detail', $detail);
	}

	public function update($id)
	{
		$detail = $this->recette_model->get($id);
		$this->template->debug = true;
		$this->template->js = 'recette';
		$this->template->load('recette/form', $detail);
	}


	// --- AJAX METHOD --- //

	public function post()
	{

	}
}
