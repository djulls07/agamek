<?php
session_start();
header("Content-Type:text/plain");

//si ok on log le user et on a donc besoin de la class Membre
include_once('../../classes/Membre.class.php');

if (isset($_POST['pseud']) && isset($_POST['passw'])) {
	$_POST['pseud'] = htmlspecialchars($_POST['pseud']);
	$_POST['passw'] = htmlspecialchars($_POST['passw']);
	// appel bdd verif hash et loging
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$p = "../../infos/infos_bdd";
		if (file_exists($p)) {
			$tmp = json_decode(file_get_contents($p), true);
		}
		$bdd = new PDO("mysql:host=" . $tmp['host'] . ";dbname=" . $tmp['name'], $tmp['user'], $tmp['password'],$pdo_options);
		$h = sha1($_POST['pseud'].$_POST['passw']);
		$r = $bdd->query("SELECT * FROM users WHERE _hash=\"".$h."\" AND _actif=1");
		if ($d = $r->fetch()) {
			//on log in
			$_SESSION['user'] =  serialize(new Membre($d, $p));
			//print_r($_SESSION["user"]);
			echo '{"connexion_ok":"'.$_SESSION['text']['bienvenue'].' '.$d['_pseudo'].'"}';
		} else {
			echo '{"connexion_ko":"'.$_SESSION['text']['compte_n_existe'].'"}';
		}
		//$r->closeCursor();
	} catch (Exception $e) {
		echo '{"connexion_ko":"'.$e->getMessage().'"}';
	}
} else {
	echo '{"connexion_ko":"'.$_SESSION['text']['connexion_ko_champs'].'"}';
}
?>