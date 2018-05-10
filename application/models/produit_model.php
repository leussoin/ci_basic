<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produit_model extends CI_Model {
	public function get_produit()
	{			
        //return $this->db->get('produits')->result();
        $this->db->select("*")
            ->from('produits')
            ->join('mesure', 'mesure.id_mesure = produits.fk_id_mesure')
            ->join('categorie', 'categorie.id_categorie = produits.fk_id_categorie')
            ->join('table_asso_prix', 'produits.id_prod = table_asso_prix.fk_id_produit');

        return $this->db->get()->result();    
    
    }
    
    public function details_produit($id)
	{			
        //return $this->db->get('produits')->result();
        $this->db->select("*")
            ->from('produits')
            ->join('mesure', 'mesure.id_mesure = produits.fk_id_mesure')
            ->join('categorie', 'categorie.id_categorie = produits.fk_id_categorie')
            ->join('table_asso_prix', 'produits.id_prod = table_asso_prix.fk_id_produit')
            ->where('id_prod', $id);

        return $this->db->get()->row();    
    }


    public function get_categorie()
	{			
        //return $this->db->get('produits')->result();
        $this->db->select("*")->from('categorie');
        return $this->db->get()->result();    
    }

    public function get_magasin()
	{			
        //return $this->db->get('produits')->result();
        $this->db->select("*")->from('magasin');       
        return $this->db->get()->result();    
    }
    
    
    public function delete_produit( $id)
	{			
        //return $this->db->get('produits')->result();
        $this->db->where('id_prod', $id);
        return $this->db->delete('produits');
	}
}
