<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recontre - Vos formulaire</title>

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/vosFormulaire?v=3.css')?>">
</head>
<body >
	<?php if (isset($vosFormulaire)): ?>
		<div class="enTete">
			<h1>Voici tous les formulaires que vous avez créé</h1>
		</div>
		<div class="container">
			<?php foreach ($vosFormulaire as $formulaire): ?>
				<div class="ligne1">
					<div class="droite">
						<button onclick="copyToClipboard('<?php echo "$formulaire->idFormulaire" ?>')">Copier le code</button>
						<button onclick="copyToClipboard('<?php echo base_url("index.php/ResultatFormulaire_controller/formulaire?clefFormulaire=".$formulaire->idFormulaire) ?>')">Copier le lien</button>
					</div>
					<a class="gauche" href="<?=base_url('index.php/ResultatFormulaire_controller/formulaire?clefFormulaire='.$formulaire->idFormulaire)?>">
						<div class="formulaire">
							<h2><?php echo "$formulaire->titre" ?></h2>
							<p><?php echo "$formulaire->lieu" ?></p>
							<p><?php echo "$formulaire->description" ?></p>
							<p>code : <strong><?php echo "$formulaire->idFormulaire" ?></strong></p>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
			<div class="ligne">
				<button onclick="window.location.href='<?php echo  base_url()?>'">Accueil</button>
			</div>
		</div>
	<?php else: ?>
		<h1>On dirait que c'est vide ici !</h1>
		<h2>Vous pourrez voir ici les réponses qu'ont reçues vos formulaires dès que vous en aurez créé</h2>
		<div class="ligne">
			<a class="bouton" href="<?=base_url('index.php/welcome')?>">
				<div>
					<p>Retour à l'acceuil</p>
					<?=img('assets/img/accueil.png')?>
				</div>
			</a>
			<a class="bouton" href="<?=base_url('index.php/welcome/index/creer_formulaire')?>">
				<div>
					<p>Créer un Formulaire</p>
					<?=img('assets/img/nouveauFormulaire.png')?>
				</div>
			</a>
		</div>
	<?php endif; ?>
</body>
<script>
function copyToClipboard(text) {
  const textarea = document.createElement('textarea');
  textarea.value = text;
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand('copy');
  document.body.removeChild(textarea);
}
</script>