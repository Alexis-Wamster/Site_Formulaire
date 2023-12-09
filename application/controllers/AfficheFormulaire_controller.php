<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AfficheFormulaire_controller extends CI_Controller {

	public function formulaire()
	{
		$this->load->model('ConvertisseurDate');
		$convertisseur = new ConvertisseurDate;	
		$this->load->model('afficheFormulaire_model');
		$modele = new AfficheFormulaire_model;	
		
		$clefFormulaire = $this->input->get('clefFormulaire');
		$formulaire = $modele->getFormulaire($clefFormulaire);

		if ($formulaire === null){
			$this->load->view('formulaireIntrouvable');
		}
		else{
			$formulaire['date2'] = $convertisseur->franciseJour($formulaire['date']);
			$this->load->view('formulaire',$formulaire);
		}
	}
}
