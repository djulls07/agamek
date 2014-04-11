<?php
echo 'ok';

	try { 
		$connexion = new PDO("mysql:host=localhost;dbname=adeptus", 'root',"nuage009");
		$req = $connexion->prepare("INSERT INTO Users (pseudo,email,url_avatar,date_naissance,
					date_inscription,localisation,sexe,nom,prenom,bio,droits,
					metier,signature) VALUES(?,?,?,?,CURDATE(),?,?,?,?,?,?,?,?)");
					
		$req->execute(array('djulls','djulls07@gmail.com','google.fr',
					'1986-9-19',
					'Fr',1,'Leg',
					'Jules','maBio',0,
					'Webbranleur','ME'));
					
					
	} 
	catch(PDOException $e) {
		echo 'erreur connexion: '.$e->getMessage();
	}

echo "ok";

?>