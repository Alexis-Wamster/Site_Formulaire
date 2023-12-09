<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Formulaire introuvable</title>

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/formulaireIntrouvable.css')?>">
</head>
<body>
	<h1>Désolé :'(</h1>
	<h1>Le formulaire que vous cherchez n'existe pas ou a été supprimé</h1>
	<div class="selection">
		<a class="bouton" href="<?=base_url('index.php/welcome')?>">
			<div>
				<p>Retour à l'acceuil</p>
				<?=img('assets/img/accueil.png')?>
			</div>
		</a>
	</div>
</body>
</html>