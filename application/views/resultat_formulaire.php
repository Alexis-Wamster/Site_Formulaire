<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rencontre - Résultat formulaire</title>

	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleGenerale?v=2.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/resultatFormulaire?v=8.css')?>">
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

		<details class="horaire" data-pourcentage="<?php echo $statistique['pourcentage']; ?>">
	    	<summary>
	    		<p>nombre de réponses : <?php  echo $statistique['nombre'];?><p>
	    	</summary>
	    	<div class="gens">
	    		<div class="present">
	    			<ul>
	    				<?php foreach ($statistique['present'] as $personne): ?>
	    					<li>
	    						<p><?php echo "{$personne['prenom']} {$personne['nom']}"; ?></p>
	    					</li>
	    				<?php endforeach; ?>
	    			</ul>
	    		</div>
	    	</div>
		</details>
	

		<ul>
			<?php $jour2 = reset($date2) ?>
			<?php foreach($date as $jour => $listeHeure): ?>
				<li class="jour">
					<p><?php echo "$jour2"; ?></p>
					<ul>
						<?php foreach($listeHeure as $horaire => $statistiqueHoraire): ?>
							<li>
								<div class="containerHoraire">
									<details class="horaire" data-pourcentage="<?php echo $statistiqueHoraire['pourcentage']; ?>">
										<summary>
											<div class="ligneHoraire">
												<div class="gauche">
													<p><?php echo "$horaire"; ?></p>
												</div>
												<div class="droite">
													<progress value="<?php echo $statistiqueHoraire['pourcentage']; ?>" max="100"></progress>
													<p><?php echo "{$statistiqueHoraire['nombre']} / {$statistique['nombre']}"; ?></p>
												</div>
											</div>
										</summary>
										<div class="gens">
	    									<div class="present">
												<ul>
							    					<?php foreach ($statistiqueHoraire['present'] as $personne): ?>
							    						<li>
							    							<p><?php echo "{$personne['prenom']} {$personne['nom']}"; ?></p>
							    						</li>
							    					<?php endforeach; ?>
							    				</ul>
							    			</div>
	    									<div class="absent">
	    										<ul>
							    					<?php foreach ($statistiqueHoraire['absent'] as $personne): ?>
							    						<li>
							    							<p><?php echo "{$personne['prenom']} {$personne['nom']}"; ?></p>
							    						</li>
							    					<?php endforeach; ?>
							    				</ul>
						    				</div>
	    								</div>
									</details>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php $jour2 = next($date2); ?>
			<?php endforeach; ?>
		</ul>
			<div class="ligne">
				<button onclick="window.location.href='<?php echo  base_url('index.php/vosFormulaire_controller/chargerFormulaire')?>'">Retour</button>
				<button onclick="window.location.href='<?php echo  base_url()?>'">Accueil</button>
			</div>
		
		</div>
</body>
<script>
var detailsElements = document.querySelectorAll('details.horaire');
	detailsElements.forEach(function(details) {
  		var pourcentage = parseInt(details.getAttribute('data-pourcentage'));
  		var red = Math.round((1 - pourcentage / 100) * 255);
  		var green = Math.round((pourcentage / 100) * 255);
  		var blue = 0;
  		details.style.backgroundColor = 'rgb(' + red + ', ' + green + ', ' + blue + ')';
	});
</script>
</html>