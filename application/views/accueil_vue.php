<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recontre - Accueil</title>
<meta http-equiv="pragma" content="no-cache" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/accueil.css?v=6')?>">
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
<div id="container">

	<div id="body">
		<div class="enTete">
			<div class="haut">
				<div class="gauche">
					<h1>Bienvenue !</h1>
					<h2>Organisez des rencontres avec des formulaires</h2>
				</div>
				<div class="droite">
					<?php if (isset($compte)): ?>
						<a class="compte connecte" href="<?=base_url('index.php/welcome/index/mon_compte')?>">
							<div>
								<p><?php echo $initiale; ?></p>
							</div>
						</a>
					<?php else: ?>
						<a class="compte deconnecte" href="<?=base_url('index.php/welcome/index/connexion')?>">
							<div>
								<?=img('assets/img/connexion.png')?>
							</div>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="chercheClef">
				<form action="<?=base_url('index.php/AfficheFormulaire_controller/formulaire')?>" methode='get'>
					<input class="champs" type="search" placeholder="Entrez le code d'un formulaire" name="clefFormulaire">
				</form>
			</div>
		</div>
		<div class="ligne">
			<?php if (isset($compte)): ?>
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
				<a class="bouton" href="<?=base_url('index.php/welcome/index/creer_formulaire')?>">
					<div>
						<p>Créer un Formulaire</p>
						<?=img('assets/img/nouveauFormulaire.png')?>
					</div>
				</a>
				<a class="bouton" href="<?=base_url('index.php/vosFormulaire_controller/chargerFormulaire')?>">
					<div>
						<p>Vos Formulaire</p>
						<?=img('assets/img/vosFormulaire.png')?>
					</div>
				</a>
			<?php else: ?>
				<a class="bouton" href="<?=base_url('index.php/welcome/index/connexion')?>">
					<div>
						<p>Se connecter</p>
						<?=img('assets/img/connexion.png')?>
					</div>
				</a>
			<?php endif; ?>
			<a class="bouton" href="<?=base_url('index.php/welcome/index/creerCompte')?>">
				<div>
					<p>Créer un compte</p>
					<?=img('assets/img/creerCompte.png')?>
				</div>
			</a>
		</div>
	</div>
	
</div>

</body>
</html>