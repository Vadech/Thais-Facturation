<?php 
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(is_numeric($_GET['annee']))
	$annee = $_GET['annee'] ;
else
	$annee = date('Y') ;

$date_debut = $annee.'-01-01';
$date_fin = $annee.'-12-31';

$tabHotels = Hotel::getHotelsAFacturer();
$dataHotels = array();
$i = 0;
foreach ($tabHotels as $hotel)
{

	$tabRC = $hotel->getChambresReservationsPeriode($date_debut,$date_fin);

	if(count($tabRC) == 0 || fraDate($hotel->getDt_install()) == "00/00/0000" || $hotel->getDt_end() < date("Y-m-d"))
	{
		continue;
	}

	$dataHotels[$i]["idHotel"] = $hotel->getId();
	$dataHotels[$i]["nom"] = $hotel->getNom_hotel();
	$dataHotels[$i]["dateCreation"] = fraDate($hotel->getDt_install());

	foreach($tabRC as $value)
	{
		$mois = $value['mois'] ;
		$dataHotels[$i]['mois'][$mois-1]['num'] = $mois;
		$facture = $hotel->getFacture($annee."-".$mois."-01");
		if($facture != null && $facture->getId() != -1)
		{
			$nbMois = diffDateMonth($facture->getDate_deb_facture(),  $facture->getDate_fin_facture());
			$total = $facture->getMontant_facture();
			$totalOption = 0;
			$dataHotels[$i]['mois'][$mois-1]['montantFacture'] = $total;
			foreach (FactureOption::getAllFactureOptions($facture->getId()) as $optFact)
			{
				if($optFact->getOffert() == false)
				{ 
					$opt = new Option($optFact->getIdOption());
					$totalOption = $opt->getTarif();
				}
			}
			$total += $totalOption*$nbMois;
			$total -= $facture->getMontantReduction();
			
			$dataHotels[$i]['mois'][$mois-1]['montantFactureTotal'] = $total;
			$dataHotels[$i]['mois'][$mois-1]['urlFacture'] = $facture->getUrl_PDF();
		}
		else
		{
			$lastFact = $hotel->getLastFacture();
			if($lastFact != null)
				$dataHotels[$i]['mois'][$mois-1]['montantFacture'] = $lastFact->getMontant_facture();
		}
		$facture = $hotel->getFactureFor($annee."-".$mois."-01");
		if($facture != null && $facture->getId() != -1)
		{
			$dataHotels[$i]['mois'][$mois-1]['idFacture'] = $facture->getId();
			if($facture->getIsPayee())
				$dataHotels[$i]['mois'][$mois-1]['isPayee'] = true;
		}


		$facture = $facture = $hotel->getFactureFor($annee."-".$mois."-01");
		if($facture != null && $facture->getId() != -1)
			$dataHotels[$i]['mois'][$mois-1]['isFactureOk'] = true;
		
		$dataHotels[$i]['mois'][$mois-1]['chambres_total']++;
		if($value['nb_reservations'] > 0)
			$dataHotels[$i]['mois'][$mois-1]['chambres_utilisees']++;
	}

	for ($m=0;$m<12;$m++)
	{
		$toto[$m]['chambres_total'] += $dataHotels[$i]['mois'][$m]['chambres_total'];
		$toto[$m]['chambres_utilisees'] += $dataHotels[$i]['mois'][$m]['chambres_utilisees'];
		if(isset($dataHotels[$i]['mois'][$m]['montantFactureTotal']))
		{
			$toto[$m]['total'] += $dataHotels[$i]['mois'][$m]['montantFactureTotal'];
		}
	}
	$i++;
}

$totalTotal = 0;
foreach ($toto as $m => $v)
{
	$totalTotal += $v['total'];
}

echo json_encode(array("hotels" => $dataHotels, "toto" => $toto, "totalTotal" => $totalTotal));

?>