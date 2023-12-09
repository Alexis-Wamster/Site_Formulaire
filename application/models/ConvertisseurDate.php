<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConvertisseurDate extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function franciseJour($listeDate)
	{
	    $listeJour = [];
	    foreach ($listeDate as $jour => $listeHeure) {
	        $listeJour[] = self::dateConversion($jour);
	    }
	    return $listeJour;
	}

	public static function dateConversion($aaaammdd)
	{
    $jourTableau = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    
    $moisTableau = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    
    $aaaammddTableau = explode('-', $aaaammdd);
    
    $annee = intval($aaaammddTableau[0]);
    $numMois = intval($aaaammddTableau[1])-1;
    $jour = $aaaammddTableau[2];
    
    $numJour = date('w', strtotime($aaaammdd));
    
    $resultat = $jourTableau[$numJour].' '.$jour.' '.$moisTableau[$numMois].' '.$annee;
    return $resultat;
}
}