<?php
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$dateDebFacture = $_GET["dateDeb"];
$idHotel = $_GET["idHotel"];
$numeroFacture = $_GET["num"];
$montant = $_GET["montant"];
$libelReduc = $_GET["libelReduc"];
$montantReduc = $_GET["montantReduc"];
$nbMois = $_GET["nbMois"];

$selectedOptions = $_GET["selectedOptions"];
$optionOfferts = $_GET["optionOfferts"];

echo $idHotel." ".$dateDebFacture." ".$numeroFacture." ".$montant." ".$libelReduc." ".$montantReduc."</br>";

$tmp = split("/", $dateDebFacture);
$mois = $tmp[0];
$annee = $tmp[1];
$moisApres = $mois+$nbMois;
$anneeApres = $annee;
if($moisApres > 12)
{
	$anneeApres++;
	$moisApres -= 12;
}

$dateDeb = date('Y-m-d', mktime(0,0,0, $mois, 1, $annee));
$dateFin = date('Y-m-d', mktime(0,0,0, $moisApres, 1, $anneeApres));

$hotel = new Coworker($idHotel);
$facture = $hotel->getFactureFor($dateDeb);
$newFact = false;
if($facture == null)
{	
	echo "Nouvelle facture<br/>";
	$facture = new Facture();
	$newFact = true;
}

$facture->setAfficeTVA(true);
$facture->setDate_deb_facture($dateDeb);
$facture->setDate_fin_facture($dateFin);
$facture->setLibelleReduction($libelReduc);
$facture->setMontant_facture($montant);
$facture->setMontantReduction($montantReduc);
$facture->setNumero_facture($numeroFacture);
$facture->setIdHotel($idHotel);

if($newFact)
{
	$lastFact = $hotel->getLastFacture();
	if($lastFact != null && $lastFact->getId() != -1)
	{
		$facture->setTaux_tva($lastFact->getTaux_tva());
		$facture->setMontant_facture($lastFact->getMontant_facture());
	}
	print_r($facture);
	$facture->add();
}
else
{
	$facture->update();
}

//option
foreach (FactureOption::getAllFactureOptions($facture->getId()) as $factOpt)
{
	echo "Delete of ".$factOpt->getIdFacture().'<br/>';
	$factOpt->delete();
}
	
foreach ($selectedOptions as $idOpt)
{	
	$factOpt = new FactureOption($facture->getId(), $idOpt);
	if(in_array($idOpt, $selectedOptions))
	{
		$offert = false;
		if(in_array($idOpt, $optionOfferts))
			$offert = true;
		$factOpt->setOffert($offert);
		$factOpt->add();
	}
}

$facture->genererFacturePDF();

?>
