<?php 
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$idFacture = $_GET['idFacture'];
$facture = new Facture($idFacture);
$isPayee = 1;
if($facture->getIsPayee() == 1)
	$isPayee = 0;

$facture->setIsPayee($isPayee);
$facture->update();
	

?>