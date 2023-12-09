<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Creer un compte</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css?v=8')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/creerCompte.css?v=4')?>">
</head>
<body>
	<?php
		if (isset($_COOKIE['inscription_erreur'])) {
    		$data = json_decode($_COOKIE['inscription_erreur'], true);
    		setcookie('inscription_erreur', '', 0, '/');
    		$classe = $data['classe'];
			$message = $data['message'];
			$cash = $data['cash'];
		}
		if (!isset($classe)){
			$classe['prenom'] = "";
			$classe['nom'] = "";
			$classe['email'] = "";
			$classe['motDePasse1'] = "";
			$classe['motDePasse2'] = "";
		}
		if (!isset($message)){
			$message['prenom'] = "";
			$message['nom'] = "";
			$message['email'] = "";
			$message['motDePasse1'] = "";
		}
		if (!isset($cash)){
			$cash['prenom'] = "";
			$cash['nom'] = "";
			$cash['email'] = "";
			$cash['motDePasse1'] = "";
			$cash['motDePasse2'] = "";
		}
		$p1="<p class=\"erreurTexte\">";
		$p2="</p>";
	?>
	<div class="container">
		<div class="cadre">
			<h1>Inscrivez-vous</h1>
			<?=form_open('inscription_controller/inscription')?>
				<div class="prenomNom">
					<div class="prenom">
						<p>Votre Prénom</p>
						<input
							class="champs petit <?php echo $classe['prenom']; ?>"
							type="text"
							placeholder="Francis"
							name="prenom"
							value="<?php echo $cash['prenom']; ?>"
							required
						>
						<?php echo "{$p1}{$message['prenom']}{$p2}"?>
					</div>
					<div class="nom">
						<p>Votre Nom</p>
						<input
							class="champs petit <?php echo $classe['nom']; ?>"
							type="text"
							placeholder="Dupond"
							name="nom"
							value="<?php echo $cash['nom']; ?>"
							required
						>
						<?php echo "{$p1}{$message['nom']}{$p2}"?>
					</div>
				</div>
				<p>Votre email</p>
				<input
					class="champs grand <?php echo $classe['email']; ?>"
					type="email"
					placeholder="adresse.mail@exemple.fr"
					name="email"
					value="<?php echo $cash['email']; ?>"
					required
				>
				<?php echo "{$p1}{$message['email']}{$p2}"?>

				<p>Votre mot de passe</p>
				<input
					class="champs grand <?php echo $classe['motDePasse1']; ?>"
					type="password"
					placeholder="********"
					name="motDePasse1"
					value="<?php echo $cash['motDePasse1']; ?>"
					required
				>
				<?php echo "{$p1}{$message['motDePasse1']}{$p2}"?>

				<p>Confirmez votre mot de passe</p>
				<input
					class="champs grand <?php echo $classe['motDePasse2']; ?>"
					type="password"
					placeholder="********"
					name="motDePasse2"
					value="<?php echo $cash['motDePasse2']; ?>"
					required
				>

				<div class="ligne">
					<button
					onclick="window.location.href='<?php echo  base_url()?>'"
					type="button">
					Accueil</button>
					<button type="submit">Valider</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>