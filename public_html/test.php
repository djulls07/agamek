<?php
/*$b = "1v1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.sc2ranks.com/v2/characters/search');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array('name' => "djulls", 'bracket' => "2v2t", 
	      'expansion' => 'hots',
	      'rank_region' => "eu", 'api_key' => 'eOMywLAr9CoZVwVxlLPbprp0pH6ogOR8DNyE');

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
curl_close($ch);
echo $output;*/

$out = array();
$arr = array("9Q73", "ZOUB", "5XS4", "DA6H");
$arr2 = array("9Q73", "DAR3", "J78N", "3JDA");
$i=0;
for ($j=1; $j<5; $j++) {
  for ($k=1;$k<5;$k++) {
    for ($l=1;$l<5;$l++) {
      for($m=1;$m<5;$m++) {
	$s = $arr[$i] . $arr[$j] . $arr[$k] . $arr[$l] . $arr[$m];
	if(!in_array($s, $out) && $j!=$k && $j!=$l && $j!=$m && 
	   $k!=$l && $k!=$m && $l!=$m)
	  array_push($out, $s);  
      }
    }
  }
}
foreach($out as $k=>$v ){
  echo $v . "<br />";
}

  ?>