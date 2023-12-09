<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription_controller extends CI_Controller {

	public function inscription()
	{
		$this->load->model('inscription_modele');
		$inscrit = new Inscription_modele();
		$error = $inscrit->inscription();
		if ($error===true){
			$this->load->view('compte_cree', $inscrit->getCash());
		}
		else{
			$data = Inscription_modele::createData($error);
			$data['cash'] = $inscrit->getCash();
			//$this->load->view('creerCompte',$data);
			setcookie('inscription_erreur', json_encode($data), time()+60, '/');
			redirect('welcome/index/creerCompte', 'location');
		}
	}
}