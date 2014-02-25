<?php 
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$allOptions = Option::getAllOptions();
$options = array();

foreach ($allOptions as $opt)
{
	$options[] = array(
			"libelle" => $opt->getLibelle(),
			"tarif" => $opt->getTarif());
}


echo json_encode(array("options" => $options));

?>