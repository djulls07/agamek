<?php
echo 'ok';
require_once ('config.php');
$matches_mapper_web = new matches_mapper_web("359678899");
$matches_mapper_web->set_account_id(11074115);
$matches_short_info = $matches_mapper_web->load();
foreach ($matches_short_info AS $key=>$match_short_info) {
  $match_mapper = new match_mapper_web($key);
  $match = $match_mapper->load();
  $mm = new match_mapper_db();
  $mm->save($match);
  print_r($match);
}
  ?>