<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreerFormulaire_controller extends CI_Controller {

	public function boutonClique()
	{
		$this->load->model('ConvertisseurDate');
		$convertisseur = new ConvertisseurDate;	
		$this->load->model('creerFormulaire_modele');
		$formulaire = new CreerFormulaire_modele();

		$action = $this->input->post('action');
		$action = explode(' ', $action);

		if ($action[0] === "add"){
			$this->add($convertisseur, $formulaire, $action[1]);
		}
		if ($action[0] === "remove"){
			$this->remove($convertisseur, $formulaire, $action[1], $action[2]);
		}
		if ($action[0] === "valider"){
			$this->formulaireTermine($convertisseur, $formulaire);
		}
		if ($action[0] === "accueil"){
			setcookie('creer_Formulaire', "", 0, '/');
			redirect('', 'location');
		}
		if ($action[0] === "reset"){
			setcookie('creer_Formulaire', "", 0, '/');
			redirect('welcome/index/creer_formulaire', 'location');
		}
	}

	public function formulaireTermine($convertisseur, $formulaire)
	{
		$error = $formulaire->formulaireTermine();
		if ($error === null){
			if (!isset($_COOKIE['compte_connecte'])) {
				$this->load->view('session_expire');
			}
			else{
				setcookie('creer_Formulaire', "", 0, '/');
				$cleFormulaire = $formulaire->insertFormulaire();
				$this->load->view('formulaire_cree',array('clefFormulaire' => $cleFormulaire));
			}
		}
		else{
			$data = $formulaire->createData($error);
			$data['cash'] = $formulaire->getCash();
			$data['cash']['date2'] = $convertisseur->franciseJour($data['cash']['date']);
			setcookie('creer_Formulaire', json_encode($data), time()+60, '/');
			redirect('welcome/index/creer_formulaire', 'location');
		}
	}

	public function remove($convertisseur, $formulaire, $jour, $heure=null)
	{
		$formulaire->remove($jour, $heure);
		$data = $formulaire->createData();
		$data['cash'] = $formulaire->getCash();
		$data['cash']['date2'] = $convertisseur->franciseJour($data['cash']['date']);
		//$_SESSION['creer_formulaire'] = $data;
		setcookie('creer_Formulaire', json_encode($data), time()+36000, '/');
		redirect('welcome/index/creer_formulaire', 'location');
	}

	public function add($convertisseur, $formulaire, $jour=null)
	{
		if ($formulaire->add($jour)){
			$data = $formulaire->createData();
			$data['cash'] = $formulaire->getCash();
			$data['cash']['date2'] = $convertisseur->franciseJour($data['cash']['date']);
			//$_SESSION['creer_formulaire'] = $data;
			setcookie('creer_Formulaire', json_encode($data), time()+36000, '/');
		}
		redirect('welcome/index/creer_formulaire', 'location');
	}
}