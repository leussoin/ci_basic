<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

	public function index($id = null)
	{
		$this->template->js = 'produit';
		$this->template->css= 'produit';
		$this->template->debug = 'true';

		$this->load->model('produit_model');
		$aDetailProduit = $this->produit_model->details_produit($id);

		$this->load->model('produit_model');
		$aListeCategorie = $this->produit_model->get_categorie();

		$this->load->model('produit_model');
		$aListeMagasin = $this->produit_model->get_magasin();	
	
		$this->template->load('produit', compact('aDetailProduit', 'aListeMagasin', 'aListeCategorie'));
	}

	public function supprime_produit()
	{
	
		$id = $this->input->post('id');
		$this->load->model('produit_model');
		$aDetailProduit = $this->produit_model->delete_produit($id);
		var_dump(array($id, $aDetailProduit));
		echo json_encode($aDetailProduit);

	}














}
