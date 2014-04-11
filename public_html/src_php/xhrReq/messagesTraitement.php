<?php
session_start();
header("Content-Type:text/plain");
include_once("../../classes/Membre.class.php");

if (isset($_POST['req']) && !empty($_POST['req'])) {
	try {
		lanceur($_POST['req']);
	} catch (Exception $e) {
		die ('{"error": ' . $e->getMessage()) .'}';
	}
}

function lanceur($str) {
	$str();
}

function init_messages() {
	$membre = unserialize($_SESSION['user']);
	$membre->loadConversations();
	echo $membre->getJsonFromConversations();
}

?>