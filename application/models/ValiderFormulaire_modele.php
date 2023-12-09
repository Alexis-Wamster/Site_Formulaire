<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValiderFormulaire_modele extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function stockeReponse()
	{
		$this->load->database();
		$reponse = $this->input->post();
		$prenom=$reponse['nom'];
		$nom=$reponse['prenom'];
		
		$sql = "DELETE FROM S2_2_Reponse WHERE prenom = ? AND nom = ?";
		$this->db->query($sql, [$prenom, $nom]);
		
		foreach($reponse as $clef => $valeur){
			if ($clef !== "nom" && $clef !== "prenom" && $clef !== "clefFormulaire"){
				$jour = substr($clef, 0, 10);
				$horaire = substr($clef, 11);
				$tuple = array(
					'idFormulaire' => $reponse['clefFormulaire'],
					'jour' => $jour,
					'horaire' => $horaire,
					'nom' => $nom,
					'prenom' => $prenom
				);
				$this->db->insert('S2_2_Reponse', $tuple);
			}
		}
		
	}

}