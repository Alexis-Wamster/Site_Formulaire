<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreerFormulaire_modele extends CI_Controller {

	public $titre;
	public $lieu;
	public $description;
	public $date;
	const ERROR_TITRE_VIDE=81;
	const ERROR_LIEU_VIDE=82;
	const ERROR_DESCRIPTION_VIDE=83;
	const ERROR_PROPOSITION_VIDE=84;
	const ERROR_DATE_VIDE=85;

	const MESSAGE = array(
		'ERROR_TITRE_VIDE'=> "Le titre doit faire entre 1 et 40 caractères",
		'ERROR_LIEU_VIDE'=> "Le lieu doit faire entre 1 et 60 caractères",
		'ERROR_DESCRIPTION_VIDE'=> "La description doit faire entre 1 et 300 caractères",
		'ERROR_PROPOSITION_VIDE'=> "Ajoutez au moins une date à votre formulaire",
		'ERROR_DATE_VIDE'=> "Cette date doit contenir des horaires"
	);

	const CLASS_ERROR = "erreurChamps";
	
	public function __construct()
	{
		parent::__construct();
		if (isset($_COOKIE['creer_Formulaire'])) {
    		$data = json_decode($_COOKIE['creer_Formulaire'], true);
			$this->titre = $data['cash']['titre'];
			$this->lieu = $data['cash']['lieu'];
			$this->description = $data['cash']['description'];
			$this->date = $data['cash']['date'];
		}
		else{
			$this->date = [];
		}
		$this->updateData();
	}

	public function getCash()
	{
		$data = [
			'titre' => $this->titre,
			'lieu' => $this->lieu,
			'description' => $this->description,
			'date' => $this->date,
		];
		return $data;
	}

	public function updateData()
	{
		$this->titre = $this->input->post('titre');
		$this->lieu = $this->input->post('lieu');
		$this->description = $this->input->post('description');
	}

	public function formulaireTermine()
	{
		if ($this->titre === ""){
			return self::ERROR_TITRE_VIDE;
		}
		if ($this->lieu === ""){
			return self::ERROR_LIEU_VIDE;
		}
		if ($this->description === ""){
			return self::ERROR_DESCRIPTION_VIDE;
		}
		if ($this->date === []){
			return self::ERROR_PROPOSITION_VIDE;
		}
		foreach ($this->date as $jour => $listeDate) {
			if ($listeDate === []){
				return $jour;
			}
		}
		return null;
	}

	public function insertFormulaire(){
		$this->load->database();
		$clefFormulaire = $this->genereClefFormulaire();
		$compte = json_decode($_COOKIE['compte_connecte'], true);
		$email = $compte['email'];
		$tuple = array(
			'email' => $email,
			'titre' => $this->titre,
			'lieu' => $this->lieu,
			'description' => $this->description,
			'idFormulaire' => $clefFormulaire,
			'dateCreation' => date('Y-m-d H:i:s')

		);
		$this->db->insert('S2_2_Formulaire', $tuple);

		foreach ($this->date as $jour => $listeHeure) {
			$tuple = array(
				'jour' => $jour,
				'idFormulaire' => $clefFormulaire
			);
			$this->db->insert('S2_2_Date', $tuple);

			foreach ($listeHeure as $heure => $listeVide){
				$tuple = array(
					'horaire' => $heure,
					'idFormulaire' => $clefFormulaire,
					'jour' => $jour
				);
				$this->db->insert('S2_2_Horaire', $tuple);
			}
		}
		return $clefFormulaire;
	}

	public static function genereRandomString($tailleClef=8, $caractere='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'){
		$clef = "";
		for ($i=0; $i<$tailleClef; $i++){
			$clef .=$caractere[rand(0,strlen($caractere)-1)];
		}
		return $clef;
	}

	public function verifieClefFormulaire($clef){
		$sql = "SELECT * FROM S2_2_Formulaire WHERE idFormulaire = ?";
	    $clefIdentique = $this->db->query($sql, [$clef]);
	    if ($clefIdentique->num_rows() === 0) {
	        return true;
	    }
	    return false;
	}

	public function genereClefFormulaire(){
		do{
			$clef = self::genereRandomString();
		} while(!$this->verifieClefFormulaire($clef));
		return $clef;
	}

	public function add($jour=null)
	{
		if ($jour !== null){
			$id = $jour;
		}
		else{
			$id = 'newDate';
		}
		$nouveau= $this->input->post($id);
		if ($nouveau === ""){
			return false;
		}

		if ($jour === null){
			$this->date[$nouveau] = [];
			ksort($this->date);
		}
		else{
			$this->date[$jour][$nouveau] = [];
			ksort($this->date[$jour]);
		}
		return true;
	}

	public function remove($jour, $heure=null)
	{
		if ($heure === null){
			unset($this->date[$jour]);
		}
		else{
			unset($this->date[$jour][$heure]);
		}
	}

	public function createData($codeErreur=null){
		$classe['titre'] = "";
		$classe['lieu'] = "";
		$classe['description'] = "";

		$message['titre'] = "";
		$message['lieu'] = "";
		$message['description'] = "";
		$message['jour'] = "";

		foreach ($this->date as $jour => $listeHeure) {
			if ($codeErreur == $jour){
				$classe[$jour] = self::CLASS_ERROR;
				$message[$jour] = self::MESSAGE['ERROR_DATE_VIDE'];
			}
			else{
				$classe[$jour] = "";
				$message[$jour] = "";
			}
		}

		if ($codeErreur === self::ERROR_TITRE_VIDE){
			$classe['titre'] = self::CLASS_ERROR;
			$message['titre'] = self::MESSAGE['ERROR_TITRE_VIDE'];
		}
		elseif($codeErreur === self::ERROR_LIEU_VIDE){
			$classe['lieu'] = self::CLASS_ERROR;
			$message['lieu'] = self::MESSAGE['ERROR_LIEU_VIDE'];
		}
		elseif($codeErreur === self::ERROR_DESCRIPTION_VIDE){
			$classe['description'] = self::CLASS_ERROR;
			$message['description'] = self::MESSAGE['ERROR_DESCRIPTION_VIDE'];
		}
		elseif($codeErreur === self::ERROR_PROPOSITION_VIDE){
			$classe['jour'] = self::CLASS_ERROR;
			$message['jour'] = self::MESSAGE['ERROR_PROPOSITION_VIDE'];
		}

		$data['message'] = $message;
		$data['classe'] = $classe;
		return $data;
	}
}