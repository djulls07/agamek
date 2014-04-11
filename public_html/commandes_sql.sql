/*
 * 1. INSERER UN UTILISATEUR DANS LA TABLE
 */

INSERT INTO `a9658920_adeptus`.`Users` (
`id` ,
`pseudo` ,
`url_avat` ,
`dob` ,
`dor` ,
`loca` ,
`sex` ,
`nom` ,
`prenom` ,
`bio` ,
`type`
)
VALUES (
NULL ,
 '_PSEUDO',
 '_URL_AVATAR_',
 '_DATE_OF_BIRTH_',
 CURDATE( ) /* A ne pas modifier, la table enregistre toute seule la date d'inscription */,
 '_FK_TO_COUTRIES_', /* Clé étrangère à retrouver dans la table Country via la commande 
 			"SELECT id FROM Countries WHERE name LIKE '__NOM_DE_PAYS__'" */
 '0',
 'nom',
 'prénom',
 '_BIO_',
 '0'
); -- O is the default type


/*
 * 2. INSERER UN JEU DANS LA TABLE
 */


INSERT INTO `a9658920_adeptus`.`games` (
`id` ,
`titre` ,
`description`
)
VALUES (
NULL ,
 '__GAME_NAME__',
 '__DESCRIPTION_GAME__'
);



/*
 * 3. INSERER UN JEU DANS LA TABLE
 */


INSERT INTO `a9658920_adeptus`.`tuto` (
`id_user` ,
`id_game` ,
`url_youtube` ,
`description`
)
VALUES (
'0', /* FK à la table USERS. Utiliser : "SELECT id FROM Users WHERE pseudo LIKE '__PSEUDO__';" */
 '0', /* Same with games */
 '__URL_YOUTUBE__',
 '__DESCRPTION__'
);


/*
 * 4. RECUPERER TOUS LES TUTOS FAITS PAR UN MEME UTILISATEUR
 */


SELECT *
FROM `tuto`
WHERE id_user
IN (

SELECT id
FROM Users
WHERE pseudo LIKE '__PSEUDO__'
); /* Cette requêtes renvoie tous les tutoriels rédigés par un utilisateur particulier */
