<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index($page='accueil_vue')
	{
		header("Pragma: no-cache");
		$this->load->view($page);
	}
}
