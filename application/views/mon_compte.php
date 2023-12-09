<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recontre - Accueil</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/votreCompte?v=3.css')?>">
</head>
<body >
	<?php
		if (isset($_COOKIE['compte_connecte'])) {
    		$compte = json_decode($_COOKIE['compte_connecte'], true);
    		$prenom = $compte['prenom'];
			$nom = $compte['nom'];
			$email = $compte['email'];
			$initiale = substr($prenom,0,1).'.'.substr($nom,0,1);
		}
	?>
	<?php if (isset($compte)): ?>
		<div class="enTete">
			<h1>Votre compte</h1>
		</div>
		<div class="contenus">
			<div class="photo">
				<p  class="initiale"><?php echo $initiale; ?></p>
			</div>
			<div classe="données">
				<div class="ligne">
					<div class="nom">
						<p class="clef">Nom</p>
						<div class="valeur">
							<p><?php echo $nom; ?></p>
						</div>
					</div>
					<div class="prenom">
						<p class="clef">Prénom</p>
						<div class="valeur">
							<p><?php echo $prenom; ?></p>
						</div>
					</div>
				</div>
				<div class="ligne">
					<div class="email">
						<p class="clef">Adresse email</p>
						<div class="valeur">
							<p><?php echo $email; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="ligne">
			<a class="bouton" href="<?=base_url('index.php/connexion_controller/deconnexion')?>">
				<div>
					<p>Se déconnecter</p>
					<?=img('assets/img/deconnexion.png')?>
				</div>
			</a>
			<a class="bouton" href="<?=base_url('index.php/connexion_controller/connexion')?>">
				<div>
					<p>Changer de compte</p>
					<?=img('assets/img/changerUtilisateur.png')?>
				</div>
			</a>
			<a class="bouton" href="<?=base_url('index.php/welcome/index/creerCompte')?>">
				<div>
					<p>Créer un compte</p>
					<?=img('assets/img/creerCompte.png')?>
				</div>
			</a>
		</div>

		
	<?php else: ?>
		<h1>ERREUR 404</h1>

	<?php endif; ?>
	<div class="ligne">
		<button onclick="window.location.href='<?php echo  base_url()?>'">Accueil</button>
	</div>

</body>
</html>