<?php
//require_once("DOMNodeRecursiveIterator.class.php");
class Robot {

  /* Info pour faire recherche et retourner ce qu'on desire*/
  private $_recherche;
  private $_moteurs = array();
  private $_domainesAcc = array();
  private $_result;
  private $_domsRecherches = array();
  
  
  public function __construct($r, $arrayDomaines, 
			      $moteurs=array("http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=")) {
    $this->_recherche = $r;
    $this->_domainesAcc = $arrayDomaines;
    if (!empty($moteurs))
      $this->_moteurs = $moteurs;
  }

  public function __destruct() {

  }
  
  /* Execute la recherche sur vos moteurs favoris
   * On peut meme ajouter +eurs moteurs a terme.
   */
  public function cherche() {
    foreach($this->_moteurs as $k => $v) {
      $this->lanceRecherche($k,$v);
    }
  }

  /* recherche sur un moteur */
  public function lanceRecherche($k, $moteur) {
    echo 'ok';
    $ch = curl_init();
    echo "ici:". $moteur.$this->_recherche;
    curl_setopt($ch, CURLOPT_URL, $moteur.$this->_recherche);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   

    curl_setopt($ch, CURLOPT_REFERER, 
    		"http://www.phpsources.org/page_referer.php");
    $output = curl_exec($ch);
    curl_close($ch);
    var_dump(json_decode($output, true));
  }
  
  /* Pour chaque res de chaque moteur,curl un a un et on releve les liens
   * en rapport avec les domainesAcc
   */
  //les h3 avec class="r" sont suivi du lien principale du result de recherche
  // sur google.
  
  public function analyseRechercheGoogle() {
    /*$r = $this->_domsRecherches[0];
    $domNode = $r->getElementsByTagName("h3");
    $recursiveIt = new DOMNodeRecursiveIterator($domNode);
    if ($recursiveIt->hasChildren())
      $domNode = $recursiveIt->getChildren();
    //TODO : test avant de continuer
    echo $domNode;*/
  }

  public function analyseRecherche() {
    foreach($this->_domsRecherches as $k => $v) {
      if ($k == 0) { //changer en regex
	analyseRechercheGoogle();
      }
    }
  }
}

?>