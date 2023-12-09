<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recontre - création de formulaire</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale?v=2.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/creerFormulaire?v=3.css')?>">
</head>
<body >
	<?php
		//if (isset($_SESSION['creer_formulaire'])) {
			//$data = $_SESSION['creer_formulaire'];
		if (isset($_COOKIE['creer_Formulaire'])) {
			
    		$data = json_decode($_COOKIE['creer_Formulaire'], true);
			$titre = $data['cash']['titre'];
			$lieu = $data['cash']['lieu'];
			$description = $data['cash']['description'];
			$date = $data['cash']['date'];
			$date2 = $data['cash']['date2'];
			$classe = $data['classe'];
			$message = $data['message'];
		}
		else{
			$titre = "";
			$lieu = "";
			$description = "";
			$date = [];
			$date2 = [];
			$classe['titre'] = "";
			$classe['lieu'] = "";
			$classe['description'] = "";
			$message['titre'] = "";
			$message['lieu'] = "";
			$message['description'] = "";
			$message['jour'] = "";
		}
		$p1="<p class=\"erreurTexte\">";
		$p2="</p>";
	?>
	<?= form_open('creerFormulaire_controller/boutonClique') ?>
	<div class="enTete">
		<input
			class="champs2 titre <?php echo $classe['titre']; ?>"
			type="text"
			placeholder="Ecrivez le titre de votre formulaire"
			maxlength="40"
			name="titre"
			value="<?php echo $titre ?>"
		>
		<?php echo "{$p1}{$message['titre']}{$p2}"?>
		<input
			class="champs2 lieu <?php echo $classe['lieu']; ?>"
			type="text"
			placeholder="Mettez le lieu du rendez-vous"
			maxlength="60"
			name="lieu"
			value="<?php echo $lieu; ?>"
		>
		<?php echo "{$p1}{$message['lieu']}{$p2}"?>
		<textarea
			class="champs2 description <?php echo $classe['description']; ?>"
			placeholder="Ecrivez ici une courte description en écrivant en quoi consiste votre rendez-vous"
			maxlength="300"
			name="description"
			rows="5"
		><?php echo "$description"; ?></textarea>
		<?php echo "{$p1}{$message['description']}{$p2}"?>
	</div>

	<div class="contenus">
		<ul class="listeDate">
		<?php $jour2 = reset($date2) ?>
			<?php foreach ($date as $jour => $listeHeure): ?>
				<li class="<?php echo "{$classe[$jour]}"; ?>">
					<div class='ligne date'>
						<h2><?php echo "$jour2"; ?></h2>
						<button name='action' value='remove <?php echo "$jour"; ?>'>supprimer cette date</button>
					</div>
					<ul class='listeHeure'>
					<?php foreach ($listeHeure as $heure => $listeVide): ?>
						<li>
							<div class='ligne'>
								<p><?php echo "$heure"; ?></p>
								<button name='action' value="remove <?php echo "{$jour} {$heure}"; ?>">supprimer cette heure</button>
							</div>
						</li>
						<?php echo "{$p1}{$message[$jour]}{$p2}"; ?>
					<?php endforeach; ?>
					</ul>
					<div class='ligne'>
						<div class='ligne containerAjouter'>
							<input class='ajouter' type='time' name="<?php echo "$jour"; ?>">
							<button name='action' value="add <?php echo "$jour"; ?>">Ajouter cette heure</button>
						</div>
					</div>
					<?php $jour2 = next($date2); ?>
				</li>
				<?php echo "{$p1}{$message[$jour]}{$p2}"; ?>
			<?php endforeach; ?>
		</ul>
		<?php echo "{$p1}{$message['jour']}{$p2}"; ?>

		<div class="ligne">
			<div class="ligne containerAjouter">
					<input class="ajouter" type="date" name="newDate">
					<button name="action" value="add">Ajouter cette date</button>
			</div>
		</div>
		<div class="ligne">
			<button name="action" value="reset">Tout supprimer</button>
			<button name="action" value="accueil">Accueil</button>
			<button name="action" value="valider">Valider</button>
		</div>
	</div>
</form>
</body>