<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recette_model extends CI_Model {
    
	public function gets()
	{
		return $this->db->get('recette')->result();
	}

	public function get($id)
	{
		$this->db->select('r.*')
			->from('recette r')
			->where('r.id_recette', $id);

		$recette = $this->db->get()->row();

		$this->db->select('p.*, tp.prix, m.nom_mesure')
			->from('recette r')
			->join('table_asso_recette tr', 'tr.id_recette = r.id_recette', 'left')
			->join('produits p', 'p.id_prod = tr.id_produit', 'left')
			->join('mesure m', 'm.id_mesure = p.fk_id_mesure', 'left')
			->join('table_asso_prix tp', 'p.id_prod = tp.fk_id_produit', 'left')
			->where('r.id_recette', $id);

		$produits = $this->db->get()->result();

		return compact('recette', 'produits');
	}

	public function update($id)
	{
		
	}
}
