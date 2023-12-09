<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Remplissage du formulaire</title>

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/remplissageFormulaire?v=5.css')?>">
</head>
<body>
	<div class="enTete">
		<div class="gauche">
			<h1><?php echo $titre; ?></h1>
			<h2><?php echo $lieu; ?></h2>
			<p class="description"><?php echo $description; ?></p>
		</div>
		<div class="droite">
			<p><?php echo "Code : <strong> $clefFormulaire </strong>"; ?></p>
		</div>
	</div>
	<div class="contenus">
		<form action='<?=site_url("ValiderFormulaire_controller/valider")?>' method="post">
			<div class="ligne nomPrenom">
				<div class="prenom">
					<p>Votre Prénom</p>
					<input
						class="champs"
						type="text"
						placeholder="Francis"
						name="prenom"
						required
					>
				</div>
				<div class="nom">
					<p>Votre Nom</p>
					<input
						class="champs"
						type="text"
						placeholder="Dupond"
						name="nom"
						required
					>
				</div>
			</div>
			<ul class="listeDate">
			<?php
				$jour2 = reset($date2);
				foreach($date as $jour => $listeHeure){
					echo "<li>";
						echo "<h2 class='date'>$jour2</h2>";
						echo "<ul class='listeHeure'>";
						foreach($listeHeure as $horaire => $listeVide){
							echo "<li><input type='checkbox' name='$jour-$horaire'>$horaire</input></li>";
						}
						echo "</ul>";
					echo "</li>";
					$jour2 = next($date2);
				}
			?>
			</ul>
			<div class="ligne">
				<button onclick="window.location.href='<?php echo  base_url()?>'" type="button">Accueil</button>
				<button type="submit" name="clefFormulaire" value="<?php echo $clefFormulaire; ?>">Valider</button>
			</div>
		</form>
	</div>
</body>
</html>