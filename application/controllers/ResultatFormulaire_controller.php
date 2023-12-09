<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultatFormulaire_controller extends CI_Controller {

	public function formulaire()
	{
		$this->load->model('ConvertisseurDate');
		$convertisseur = new ConvertisseurDate;	
		$this->load->model('ResultatFormulaire_model');
		$modele = new ResultatFormulaire_model;
		
		$clefFormulaire = $this->input->get('clefFormulaire');
		$formulaire = $modele->getFormulaire($clefFormulaire);
		$formulaire['date2'] = $convertisseur->franciseJour($formulaire['date']);

		//var_dump($formulaire);
		if ($formulaire === null){
			$this->load->view('formulaireIntrouvable');
		}
		else{
			$this->load->view('resultat_formulaire',$formulaire);
		}
	}
}