<?php
session_start();

/* cette page est cree afin de faire des requetes xhr pour afficher des petits bouts de codes html
 * sans recharger les pages.
 * Il suffit d'écrire sa fonction php ici et l'appel en ajax se fait en passant le nom de la fonction au parametre
 * nommé req au moment de l'appel ajax 
 *	ex :
 *	xhr.open("POST",'xhrListeReq.php',true);
 *	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 *	xhr.send("req=afficheConnect");		
 */
 
header("Content-Type:text/plain");

if (isset($_POST["req"]) && !empty($_POST["req"])) {
	lanceurF($_POST["req"]);
}

/*on renvoi un objet JSON ( cest pratique meme si inutile ici ou presque).
 *{"info":"result","blabla":"blibli",.......}
 */


//Fonction de lancement:
function lanceurF($name) {
	$name();
}

/*FONCTIONS appellée en ajax depuis le site*/

//verification email
function verif_email() {
	if (isset($_POST["email"]) && !empty($_POST["email"])) {
		//verification regex etc...
		if (!preg_match("#^[a-z0-9.-_]+@[a-z]{2,}\.[a-z]{2,4}$#",$_POST['email'])) {
			echo '{"email":"mauvais format"}';
		} else {
			try {
				$p = '../../infos/infos_bdd';
				if (file_exists($p))
					$tmp = json_decode(file_get_contents($p), true);
				else {
					echo '{"email":"error file infos bdd"}';
					return;
				}
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$tmp['host'].';dbname='.$tmp['name'],
								$tmp['user'], $tmp['password'], $pdo_options);
				
				$rep = $bdd->query("SELECT * FROM users WHERE _email=\"".$_POST['email']."\"");
				if ($rep->fetch()) {
					echo '{"email":"not free"}';
				}
				else {
					echo '{"email":"ok"}';
				}
				$rep->closeCursor();
			} catch (Exception $e) {
				echo '{"email":"error DataBase : ' . $e->getMessage().'"}';
			}
		}
	}
	else {
		echo '{"email":"champs a remplir"}';
	}

}

//verification pseudo
function verif_pseudo() {
	if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
		//verification du champs pseudo
		if (!preg_match("#^[a-zA-Z0-9._-]{2,25}$#", $_POST["pseudo"])) {
			echo '{"pseudo":"mauvais format"}';
		}
		else {
			/* Cas pseudo ok, verifier disponibilité bdd */
			try {
				$p = '../../infos/infos_bdd';
				if (file_exists($p))
					$tmp = json_decode(file_get_contents($p), true);
				else {
					echo '{"pseudo":"error file infos bdd"}';
					return;
				}
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$tmp['host'].';dbname='.$tmp['name'],
								$tmp['user'], $tmp['password'], $pdo_options);
				
				$rep = $bdd->query("SELECT * FROM users WHERE _pseudo=\"".$_POST['pseudo']."\"");
				if ($rep->fetch()) {
					echo '{"pseudo":"not free"}';
				}
				else {
					echo '{"pseudo":"ok"}';
				}
				$rep->closeCursor();
			} catch (Exception $e) {
				echo '{"pseudo":"error DataBase : ' . $e->getMessage().'"}';
			}
		}
	}
	else {
		echo '{"pseudo":"champs a remplir"}';
	}
}

//verification mdp et mdpp
function verif_mdp() {
	if (empty($_POST["mdp"]) && empty($_POST["mdpp"])) {
		echo '{"mdp":"a remplir","mdpp":" a remplir"}';
	}
	else if (!empty($_POST["mdp"]) && empty($_POST["mdpp"])) {
		echo '{"mdpp":"a remplir"}';
	}
	else if (empty($_POST["mdp"]) && !empty($_POST["mdpp"])) {
		echo '{"mdp":"a remplir"}';
	}
	
	if (!empty($_POST["mdp"]) && !empty($_POST["mdpp"])) {
		if ($_POST["mdp"] == $_POST["mdpp"]) {
			if (preg_match("#^[a-zA-Z0-9]{5,20}$#", $_POST["mdp"])) {
				echo '{"mdp":"ok","mdpp":"ok"}';
			}
			else {
				echo '{"mdp":"uniquement lettres chiffres ., -, _ et avec longueur min: 5","mdpp":"uniquement lettres chiffres ., -, _ et avec longueur min: 5"}';
			}
		}
		else {
			echo '{"mdp":"les password doivent etre identiques.","mdpp":"les password doivent etre identiques."}';
		}
	}
}

function verif_mdpp() {
if (empty($_POST["mdp"]) && empty($_POST["mdpp"])) {
		echo '{"mdp":"a remplir","mdpp":" a remplir"}';
	}
	if (!empty($_POST["mdp"]) && !empty($_POST["mdpp"])) {
		if ($_POST["mdp"] == $_POST["mdpp"]) {
			if (preg_match("#^[a-zA-Z0-9]{5,20}$#", $_POST["mdp"])) {
				echo '{"mdp":"ok","mdpp":"ok"}';
			}
			else {
				echo '{"mdp":"uniquement lettres chiffres ., -, _","mdpp":"uniquement lettres chiffres ., -, _"}';
			}
		}
		else {
			echo '{"mdp":"les password doivent etre identiques.","mdpp":"les password doivent etre identiques."}';
		}
	}
}

//verif prenom
function verif_prenom() {
	if (isset($_POST["prenom"]) && !empty($_POST["prenom"])) {
		//verification du champs prenom
		if (!preg_match("#^[a-zA-Z0-9._-]{0,25}$#", $_POST["prenom"])) {
			echo '{"prenom":"mauvais format"}';
		}
		else {
			echo '{"prenom":"ok"}';
		}
	}
	else echo '{"prenom":"ok"}';
}

function verif_nom() {
	if (isset($_POST["nom"]) && !empty($_POST["nom"])) {
		//verification du champs nom
		if (!preg_match("#^[a-zA-Z0-9._-]{0,25}$#", $_POST["nom"])) {
			echo '{"nom":"mauvais format"}';
		}
		else {
			echo '{"nom":"ok"}';
		}
	}
	else echo '{"nom":"ok"}';
}

function verif_metier() {
	if (isset($_POST["metier"])) {
		if (!preg_match("#^[a-zA-Z-_ ]{2,255}$#", $_POST['metier'])) {
			echo '{"metier":"mauvais format ( lettres uniquement )"}';
		} else {
			echo '{"metier":"ok"}';
		}
	}
	else echo '{"metier":"ok"}';
}

function verif_signature() {
	if (isset($_POST["signature"])) {
		if (!preg_match("#^[a-zA-Z-_]{2,25}$#", $_POST['signature']))
			echo '{"signature":"mauvais format ( lettres uniquement )"}';
		else 
			echo '{"signature":"ok"}';
	} else {
		echo '{"signature":"ok"}';
	}
}

function verif_localisation() {
	if (isset($_POST["localisation"])) {
		if (!preg_match("#^[a-zA-Z -_]{2,25}$#", $_POST['localisation']))
			echo '{"localisation":"mauvais format ( lettres uniquement )"}';
		else
			echo '{"localisation":"ok"}';
	}
	else {
		echo '{"localisation":"Needed"}';
	}
}
/** Fin verif inscription**/


?>