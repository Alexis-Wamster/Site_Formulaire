<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscription_modele extends CI_Model {
	public $cash;
	const ERROR_SIZE=0;
	const ERROR_SIZE_PRENOM=1;
	const ERROR_SIZE_NOM=2;
	const ERROR_SIZE_EMAIL=3;
	const ERROR_SIZE_MOTDEPASSE=4;
	const ERROR_CARACTERE=10;
	const ERROR_CARACTERE_PRENOM=11;
	const ERROR_CARACTERE_NOM=12;
	const ERROR_CARACTERE_EMAIL=13;
	const ERROR_CARACTERE_MOTDEPASSE=14;
	const ERROR_CARACTERE2_MOTDEPASSE=15;
	const ERROR_NOEQUALS_MOTDEPASSE=24;
	const ERROR_ALREADYEXIST_EMAIL=33;

	const MESSAGE = array(
		'ERROR_SIZE_PRENOM'=> "*Votre prénom doit faire entre 1 et 40 caractères",
		'ERROR_SIZE_NOM'=> "*Votre nom doit faire entre 1 et 40 caractères",
		'ERROR_SIZE_EMAIL'=> "*Votre email doit faire entre 1 et 40 caractères",
		'ERROR_SIZE_MOTDEPASSE'=> "*Votre mot de passe doit faire entre 8 et 32 caractères",
		'ERROR_CARACTERE_PRENOM'=> "*Caractères autorisés: A-Z, a-z, _- '",
		'ERROR_CARACTERE_NOM'=> "*Caractères autorisés: A-Z, a-z, _- '",
		'ERROR_CARACTERE_EMAIL'=> "*Le format de votre email est incorrect",
		'ERROR_CARACTERE_MOTDEPASSE'=> "*Caractères autorisés: A-Z, a-z, 0-9, !@#\$%^&*()-_+=~`[]{}|:;\"<>,.?\/",
		'ERROR_CARACTERE2_MOTDEPASSE'=> "*Votre mot de passe doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial",
		'ERROR_NOEQUALS_MOTDEPASSE'=> "*Vos deux mot de passe doivent être identiques",
		'ERROR_ALREADYEXIST_EMAIL'=> "*Cette adresse mail est déjà utilisée"
	);

	const CLASS_ERROR = "erreurChamps";

	public function __construct($email='',$motDePasse='',$prenom='',$nom='')
	{
		parent::__construct();
		$this->newCash();
	}

	public function newCash(){
		$this->cash['prenom'] = $this->input->post('prenom');
		$this->cash['nom'] = $this->input->post('nom');
		$this->cash['email'] = $this->input->post('email');
		$this->cash['motDePasse1'] = $this->input->post('motDePasse1');
		$this->cash['motDePasse2'] = $this->input->post('motDePasse2');
	}

	public function getCash(){
		return $this->cash;
	}

	public function insertTuple(){
		$motDePasse = password_hash($this->cash['motDePasse1'], PASSWORD_DEFAULT);
		$tuple = array(
			'email' => $this->cash['email'],
			'nom' => $this->cash['nom'],
			'prenom' => $this->cash['prenom'],
			'motDePasse' => $motDePasse

		);
		$this->db->insert('S2_2_utilisateur', $tuple);
	}

	public static function verificationMotDePasse($motDePasse){
		$autorise = '/^[a-zA-Z0-9!@#$%^&*()\-_+=~`[\]{}|:;"<>,.?\/]+$/';
		if (!preg_match($autorise, $motDePasse)) {
    		return self::ERROR_CARACTERE_MOTDEPASSE;
		}
		if (strlen($motDePasse) < 8 || strlen($motDePasse) > 32) {
    		return self::ERROR_SIZE_MOTDEPASSE;
		}
		if (!preg_match('/[A-Z]/', $motDePasse)) {
		    return self::ERROR_CARACTERE2_MOTDEPASSE;
		}
		if (!preg_match('/[a-z]/', $motDePasse)) {
		    return self::ERROR_CARACTERE2_MOTDEPASSE;
		}
		if (!preg_match('/[0-9]/', $motDePasse)) {
		    return self::ERROR_CARACTERE2_MOTDEPASSE;
		}
		if (!preg_match('/[^a-zA-Z0-9]/', $motDePasse)) {
		    return self::ERROR_CARACTERE2_MOTDEPASSE;
		}
		return true;
	}

	public static function verificationMot($chaine){
		$autorise = '/^[a-zA-Z-_` ]+$/';
		if (!preg_match($autorise, $chaine)) {
    		return self::ERROR_CARACTERE;
		}
		if (strlen($chaine) < 1 || strlen($chaine) > 40) {
    		return self::ERROR_SIZE;
		}
		if (!preg_match('/[a-zA-Z]/', $chaine)) {
		    return self::ERROR_CARACTERE;
		}
		return true;
	}
/*
	public static function envoyerMail($prenom, $nom, $code, $email){
		$message = "Bonjour ".$prenom." ".$nom.",\n\nVous avez demmandez à vous inscrire sur Doodle like. Voici le code à saisir sur notre site pour confirmer votre inscription:\n\n".$code."\n\nSi vous pensez qu'il s'agit d'une erreur merci d'ignorer ce message.\n\nCordialement,\nL'équipe du site Doodle like:\nOscar Williatte\nEdouard Schnur\nAlexis Wamster\n";
		$this->load->library('email');
		$this->email->from('alexis.wamster@etu.u-pec.fr', 'doodle_like');
		$this->email->to($email);
		$this->email->subject('Inscription Doodle like');
		$this->email->message($message);
		if ($this->email->send()) {
    		return true;
		}		
		else {
    		return false;
		}
	}
	*/

	public function inscription(){
		$this->newCash();
		$this->load->database();
		
		$sql = "SELECT * FROM S2_2_utilisateur where email = ?";
		$compteIdentique = $this->db->query($sql,[$this->cash['email']]);
		if ($compteIdentique->num_rows()!==0){
			return self::ERROR_ALREADYEXIST_EMAIL;
		}
		if(($erreur=self::verificationMot($this->cash['prenom']))!==true){
			return $erreur+1;
		}
		if(($erreur=self::verificationMot($this->cash['nom']))!==true){
			return $erreur+2;
		}
		if(!filter_var($this->cash['email'], FILTER_SANITIZE_EMAIL)){
			return self::ERROR_CARACTERE_EMAIL;
		}
		if(($erreur=self::verificationMotDePasse($this->cash['motDePasse1']))!==true){
			return $erreur;
		}
		if ($this->cash['motDePasse1'] !== $this->cash['motDePasse2']){
			return self::ERROR_NOEQUALS_MOTDEPASSE;
		}
		$this->insertTuple();
		return true;
	}

	public static function createData($codeErreur){
		$classe['prenom'] = "";
		$classe['nom'] = "";
		$classe['email'] = "";
		$classe['motDePasse1'] = "";
		$classe['motDePasse2'] = "";

		$message['prenom'] = "";
		$message['nom'] = "";
		$message['email'] = "";
		$message['motDePasse1'] = "";

		if ($codeErreur === self::ERROR_SIZE_PRENOM){
			$classe['prenom'] = self::CLASS_ERROR;
			$message['prenom'] = self::MESSAGE['ERROR_SIZE_PRENOM'];
		}
		elseif($codeErreur === self::ERROR_SIZE_NOM){
			$classe['nom'] = self::CLASS_ERROR;
			$message['nom'] = self::MESSAGE['ERROR_SIZE_NOM'];
		}
		elseif($codeErreur === self::ERROR_SIZE_EMAIL){
			$classe['email'] = self::CLASS_ERROR;
			$message['email'] = self::MESSAGE['ERROR_SIZE_EMAIL'];
		}
		elseif($codeErreur === self::ERROR_SIZE_MOTDEPASSE){
			$classe['motDePasse1'] = self::CLASS_ERROR;
			$message['motDePasse1'] = self::MESSAGE['ERROR_SIZE_MOTDEPASSE'];
		}
		elseif($codeErreur === self::ERROR_CARACTERE_PRENOM){
			$classe['prenom'] = self::CLASS_ERROR;
			$message['prenom'] = self::MESSAGE['ERROR_CARACTERE_PRENOM'];
		}
		elseif($codeErreur === self::ERROR_CARACTERE_NOM){
			$classe['nom'] = self::CLASS_ERROR;
			$message['nom'] = self::MESSAGE['ERROR_CARACTERE_NOM'];
		}
		elseif($codeErreur === self::ERROR_CARACTERE_EMAIL){
			$classe['email'] = self::CLASS_ERROR;
			$message['email'] = self::MESSAGE['ERROR_CARACTERE_EMAIL'];
		}
		elseif($codeErreur === self::ERROR_CARACTERE_MOTDEPASSE){
			$classe['motDePasse1'] = self::CLASS_ERROR;
			$message['motDePasse1'] = self::MESSAGE['ERROR_CARACTERE_MOTDEPASSE'];
		}
		elseif($codeErreur === self::ERROR_CARACTERE2_MOTDEPASSE){
			$classe['motDePasse1'] = self::CLASS_ERROR;
			$message['motDePasse1'] = self::MESSAGE['ERROR_CARACTERE2_MOTDEPASSE'];
		}
		elseif($codeErreur === self::ERROR_NOEQUALS_MOTDEPASSE){
			$classe['motDePasse1'] = self::CLASS_ERROR;
			$message['motDePasse1'] = self::MESSAGE['ERROR_NOEQUALS_MOTDEPASSE'];
			$classe['motDePasse2'] = self::CLASS_ERROR;
		}
		elseif($codeErreur === self::ERROR_ALREADYEXIST_EMAIL){
			$classe['email'] = self::CLASS_ERROR;
			$message['email'] = self::MESSAGE['ERROR_ALREADYEXIST_EMAIL'];
		}

		$data['message'] = $message;
		$data['classe'] = $classe;
		return $data;
	}
}