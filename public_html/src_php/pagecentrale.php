<div class="page">
		<div class="contentgauche">
			<?php for ($i=0;$i<200;$i++) printf("pub "); ?>
		</div>
	
		<div class="contentcentre">
			<div class="banniere">
				<?php include_once("banniere.php"); ?>
			</div>
					
			<div class="content" id="centre">
			<?php 
				// GET de la page à afficher
				if (!isset($_GET['page']) || empty($_GET["page"])) {
					$_GET["page"] = 'accueil';
				}
				
				include_once($_GET["page"] . '.php'); 
			?>
			</div>
		</div>
		
		<div class="contentdroite">
			<?php for ($i=0;$i<250;$i++) printf("pub "); ?>
		</div>
</div>