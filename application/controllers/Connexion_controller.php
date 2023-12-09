<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion_controller extends CI_Controller {

	public function connexion()
	{
		$this->load->model('connexion_modele');
		$connecte = new Connexion_modele();
		$error = $connecte->connexion();
		if ($error===true){
			$compte = $connecte->getCompte();
			setcookie('compte_connecte', json_encode($compte), time()+3600, '/');
			redirect('welcome/index/accueil_vue', 'location');
		}
		else{
			$data = Connexion_modele::createData($error);
			$data['cash'] = $connecte->getCash();
			//$this->load->view('connexion',$data);
			//$_SESSION['connexion_erreur'] = $data;
			//$this->session->set_userdata('connexion_erreur', $data);

			setcookie('connexion_erreur', json_encode($data), time()+60, '/');
			redirect('welcome/index/connexion', 'location');
		}
	}

	public function continueWithThisAccount(){
		$resultat = $this->input->post();
		if (isset($resultat["coche"])){
			$compte = array(
				'prenom' => $this->input->post('prenom'),
				'nom' => $this->input->post('nom'),
				'email' => $this->input->post('email'),
				'motDePasse1' => $this->input->post('motDePasse1'),
				'motDePasse2' => $this->input->post('motDePasse2')
			);
			setcookie('compte_connecte', json_encode($compte), time()+3600, '/');
		}
		redirect('welcome', 'location');
	}

	public function deconnexion(){
		setcookie('compte_connecte', '', 0, '/');
		redirect('welcome', 'location');
	}
}