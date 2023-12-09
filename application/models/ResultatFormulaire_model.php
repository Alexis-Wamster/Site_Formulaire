<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultatFormulaire_model extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function exept($a, $b, $clef=[]){
		$c = [];
		foreach ($a as $ligneA) {
			$ligneEqual = false;
			foreach ($b as $ligneB) {
				$nbAttribut=0;
				$nbAttributEqual=0;
				foreach ($clef as $key) {
					$nbAttribut++;
					if ($ligneA[$key] === $ligneB[$key]){
						$nbAttributEqual++;
					}
				}
				if ($nbAttribut===$nbAttributEqual){
					$ligneEqual = true;
				}
			}
			if (!$ligneEqual){
				$ligneC = [];
				foreach ($clef as $key) {
					$ligneC[$key] = $ligneA[$key];
				}
				$c[] = $ligneC;
			}
		}
		return $c;
	}

	public function getRepondant($cleFormulaire, $jour=null, $horaire=null){
		$this->load->database();

		$sql = "SELECT DISTINCT prenom,nom FROM S2_2_Reponse WHERE idFormulaire = ?";
		$query = $this->db->query($sql, [$cleFormulaire]);
		$gensTotal = json_decode(json_encode($query->result()), true);
		$nbTotal = $query->num_rows();

		if ($jour!==null && $horaire!==null){
			$sql = "SELECT DISTINCT prenom,nom FROM S2_2_Reponse WHERE idFormulaire = ? AND jour = ? AND horaire = ?";
			$query = $this->db->query($sql, [$cleFormulaire, $jour, $horaire]);
			$gensPresent = json_decode(json_encode($query->result()), true);
			$nbPresent = $query->num_rows();
			$gensAbsent = $this->exept($gensTotal, $gensPresent, ['prenom','nom']);
		}
		else{
			$gensPresent = $gensTotal;
			$nbPresent = $nbTotal;
			$gensAbsent = [];
		}
		if ($nbTotal > 0){
			$pourcentage = round(($nbPresent / $nbTotal)*100);
		}
		else{
			$pourcentage = 0;
		}

		$resultat = array(
			'nombre' => $nbPresent,
			'pourcentage' => $pourcentage,
			'present' => $gensPresent,
			'absent' => $gensAbsent,
		);

		return $resultat;
	}

	public function getFormulaire($cleFormulaire){
		$this->load->database();
		$sql = "SELECT * FROM S2_2_Formulaire WHERE idFormulaire = ?";
	    $query = $this->db->query($sql, [$cleFormulaire]);
	    if ($query->num_rows() === 0) {
	        return null;
	    }
	    
	    $formulaire = array(
			'titre' => $query->row()->titre,
			'lieu' => $query->row()->lieu,
			'description' => $query->row()->description,
			'clefFormulaire' => $query->row()->idFormulaire,
			'statistique' => $this->getRepondant($cleFormulaire) ,
			'date' => []
		);

		$sql = "SELECT * FROM S2_2_Horaire WHERE idFormulaire = ?";
	    $query = $this->db->query($sql, [$cleFormulaire]);
	    $donnees = $query->result();

	    foreach ($donnees as $row) {
    		$jour = $row->jour;
    		$horaire = $row->horaire;
    		if (!isset($formulaire['date'][$jour])) {
        		$formulaire['date'][$jour] = [];
    		}
    		$formulaire['date'][$jour][$horaire] = $this->getRepondant($cleFormulaire, $jour, $horaire);
		}
		return $formulaire;
	}
}