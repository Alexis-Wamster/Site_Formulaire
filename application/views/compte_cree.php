<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Compte Créé</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/connexion.css')?>">
</head>
<body>
	<?php if(!isset($prenom) || !isset($nom) || !isset($email) || !isset($motDePasse1) || !isset($motDePasse2)): ?>
		<h1>ERREUR</h1>
	<?php else: ?>
		<div class="container">
			<div class="cadre">
				<h1>Votre compte a bien été créé !</h1>
				<p>Merci de votre confiance</p>
				<?=form_open('connexion_controller/continueWithThisAccount')?>
					<label for="checkbox">Commencer avec ce compte</label>
	    			<input type="checkbox" id="checkbox" checked="checked" name="coche">
	    			<input type="hidden" name="prenom" value="<?php echo $prenom; ?>">
	    			<input type="hidden" name="nom" value="<?php echo $nom; ?>">
	    			<input type="hidden" name="email" value="<?php echo $email; ?>">
	    			<input type="hidden" name="motDePasse1" value="<?php echo $motDePasse1; ?>">
	    			<input type="hidden" name="motDePasse2" value="<?php echo $motDePasse2; ?>">
					<div class="ligne">
						<button type="submit">Valider</button>
					</div>
				</form>
			</div>
		</div>
	<?php endif; ?>
</body>
</html>