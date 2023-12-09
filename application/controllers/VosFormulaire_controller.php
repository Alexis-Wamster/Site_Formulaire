<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VosFormulaire_controller extends CI_Controller {

	public function chargerFormulaire()
	{
		$this->load->model('vosFormulaire_modele');
		$model = new VosFormulaire_modele();
		if (isset($_COOKIE['compte_connecte'])) {
			$compte = json_decode($_COOKIE['compte_connecte'], true);
			$email = $email = $compte['email'];
			$listeFormulaire = $model->chargeFormulaire($email);
			$this->load->view('vosFormulaire', array('vosFormulaire' => $listeFormulaire));
		}
		else{
			$this->load->view('session_expire');
		}
	}
}