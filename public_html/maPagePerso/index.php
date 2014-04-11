<?php
function my_autoloader($class) {
  include 'classPhp/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="utf-8">
  <title> Ma Page Perso </title>
  </head>
  <body>
  <?php include_once("src/maPagePerso.php"); ?>
  </body>
</html>