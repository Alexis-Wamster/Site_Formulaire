<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recontre - Accueil</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
</head>
<body >
	<h1>Votre session a expiré :( </h1>
	<h2>Veuillez vous reconnecter ou vous inscrire </h2>
	<div class="ligne">
		<a class="bouton" href="<?=base_url('index.php/welcome/index/connexion')?>">
			<div>
				<p>Se connecter</p>
				<?=img('assets/img/connexion.png')?>
			</div>
		</a>
		<a class="bouton" href="<?=base_url('index.php/welcome/index/creerCompte')?>">
			<div>
				<p>Créer un compte</p>
				<?=img('assets/img/creerCompte.png')?>
			</div>
		</a>
	</div>

</body>
</html>