<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Connexion</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/connexion.css')?>">
</head>
<body>
	<?php
		//if (isset($_SESSION['connexion_erreur'])) {
		//	$data = $_SESSION['connexion_erreur'];
		//	$classe = $data['classe'];
		//	$message = $data['message'];
		//	$cash = $data['cash'];
		//}
		//if ($this->session->userdata('connexion_erreur')) {
		//	$data = $this->session->userdata('connexion_erreur');
		//	$classe = $data['classe'];
		//	$message = $data['message'];
		//	$cash = $data['cash'];
		//}
		if (isset($_COOKIE['connexion_erreur'])) {
    		$data = json_decode($_COOKIE['connexion_erreur'], true);
    		setcookie('connexion_erreur', '', 0, '/');
    		$classe = $data['classe'];
			$message = $data['message'];
			$cash = $data['cash'];
		}
		if (!isset($classe)){
			$classe['email'] = "";
			$classe['motDePasse'] = "";
		}
		if (!isset($message)){
			$message['email'] = "";
			$message['motDePasse'] = "";
		}
		if (!isset($cash)){
			$cash['email'] = "";
			$cash['motDePasse'] = "";
		}
		$p1="<p class=\"erreurTexte\">";
		$p2="</p>";
	?>
	<div class="container">
		<div class="cadre">
			<h1>Connectez vous</h1>
			<?=form_open('connexion_controller/connexion')?>
				<p>Votre email</p>
				<input
				class="champs <?php echo $classe['email']; ?>"
				type="email"
				placeholder="addresse.mail@exemple.fr"
				name="email"
				value="<?php echo $cash['email']; ?>"
				required>
				<?php echo "{$p1}{$message['email']}{$p2}"; ?>

				<p>Votre mot de passe</p>
				<input
				class="champs <?php echo $classe['motDePasse']; ?>"
				type="password"
				placeholder="**********"
				name="motDePasse"
				value="<?php echo $cash['motDePasse']; ?>"
				required>
				<?php echo "{$p1}{$message['motDePasse']}{$p2}"; ?>

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