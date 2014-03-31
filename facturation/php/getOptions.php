<?php 
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$idFacture = isset($_GET["idFacture"]) ? $_GET["idFacture"] : -1;
if($idFacture == "")
{
	$hotel = new Coworker($_GET["idHotel"]);
	$lastFact = $hotel->getLastFacture();
	if($lastFact != null && $lastFact->getId() != -1)
	{
		$idFacture = $lastFact->getId();
	}
	else
	{
		$idFacture = -1;
	}	
	
}

$allOptions = Option::getAllOptions();
$options = array();

foreach ($allOptions as $opt)
{
	$offert = false;
	$selected = false;
	$factOpt = new FactureOption($idFacture, $opt->getId());
	if($factOpt->getId() != -1)
	{
		$selected = true;
		if($factOpt->getOffert())
			$offert = true;
	}	
	
	$options[] = array(
			"id" => $opt->getId(),
			"selected" => $selected,
			"libelle" => $opt->getLibelle(),
			"tarif" => $opt->getTarif(),
			"offert" => $offert
			);
}


echo json_encode(array("options" => $options));

?>
