<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VosFormulaire_modele extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function chargeFormulaire($email){
		$this->load->database();
		$sql = "SELECT * FROM S2_2_Formulaire WHERE email = ? ORDER BY dateCreation DESC";
	    $query = $this->db->query($sql, [$email]);
	    if ($query->num_rows() === 0) {
	        return null;
	    }
	    return $query->result();
	}
}

