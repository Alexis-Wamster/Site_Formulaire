<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_modele extends CI_Model {
	public $compte;
	public $cash;
	const ERROR_NOEXIST_EMAIL=45;
	const ERROR_INCORRECT_MOTDEPASSE=56;

	const MESSAGE = array(
		'ERROR_NOEXIST_EMAIL'=> "Ce compte n'existe pas",
		'ERROR_INCORRECT_MOTDEPASSE'=> "Mot de passe incorrect"
	);

	const CLASS_ERROR = "erreurChamps";

	public function __construct($email='',$prenom='',$nom='')
	{
		parent::__construct();
		$this->updateCompte($email,$prenom,$nom);
	}

	public function updateCompte($email='',$prenom='',$nom=''){
		$this->compte = ['email'=>$email,'prenom'=>$prenom,'nom'=>$nom];
	}

	public function getCash(){
		return $this->cash;
	}

	public function getCompte(){
		return $this->compte;
	}

	public function newCash(){
		$this->cash['email'] = $this->input->post('email');
		$this->cash['motDePasse'] = $this->input->post('motDePasse');
	}

	public function connexion() {
	    $this->newCash();
	    $this->load->database();
	    $email = $this->cash['email'];
	    $motDePasse = $this->cash['motDePasse'];
	    

	    $sql = "SELECT * FROM S2_2_utilisateur WHERE email = ?";
	    $compteIdentique = $this->db->query($sql, [$email]);
	    if ($compteIdentique->num_rows() === 0) {
	        return self::ERROR_NOEXIST_EMAIL;
	    }

	    $sql = "SELECT * FROM S2_2_utilisateur WHERE email = ?";
	    $query = $this->db->query($sql, [$email]);
	    $motDePasseCrypte = $query->row()->motDePasse;

	    if (password_verify($motDePasse, $motDePasseCrypte)) {
	    	$email = $query->row()->email;
	    	$prenom = $query->row()->prenom;
	    	$nom = $query->row()->nom;
	    	$this->updateCompte($email,$prenom,$nom);
	        return true;
	    } else {
	    	echo $motDePasse." != ".$motDePasseCrypte;
	        return self::ERROR_INCORRECT_MOTDEPASSE;
	    }
	}

	public static function createData($codeErreur){
		$classe['email'] = "";
		$classe['motDePasse'] = "";

		$message['email'] = "";
		$message['motDePasse'] = "";

		if ($codeErreur === self::ERROR_NOEXIST_EMAIL){
			$classe['email'] = self::CLASS_ERROR;
			$message['email'] = self::MESSAGE['ERROR_NOEXIST_EMAIL'];
		}
		elseif($codeErreur === self::ERROR_INCORRECT_MOTDEPASSE){
			$classe['motDePasse'] = self::CLASS_ERROR;
			$message['motDePasse'] = self::MESSAGE['ERROR_INCORRECT_MOTDEPASSE'];
		}

		$data['message'] = $message;
		$data['classe'] = $classe;
		return $data;
	}
}

