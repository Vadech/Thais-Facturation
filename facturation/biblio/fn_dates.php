<?

function isDate($date)
{
  list($d, $m, $y) = split('[/.-]', $date);
  $dummy = date("d/m/Y", mktime (0,0,0,$m,$d,$y));
  $date = ereg_replace('-', '/', $date);
  if ($dummy != $date)
    return false;
  else
    return true;
}

function diffDateDays($date1, $date2)
{
	ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date1,$regs1) ;
	ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date2,$regs2) ;
	
	return (mktime (0,0,0,$regs2[2],$regs2[3],$regs2[1]) - mktime (0,0,0,$regs1[2],$regs1[3],$regs1[1]))/60/60/24 ;
}

function diffDateMonth($start,$end) 
{
	//$date_format = YYYY-m-d
	sscanf($start, "%4s-%2s-%2s", $annee, $mois, $jour);
	$a1 = $annee;
	$m1 = $mois;
	sscanf($end, "%4s-%2s-%2s", $annee, $mois, $jour);
	$a2 = $annee;
	$m2 = $mois;

	$dif_en_mois = ($m2-$m1)+12*($a2-$a1);
	return $dif_en_mois ;
}

function MySQLDate($datecnv)
{
	if (ereg('([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})',$datecnv,$regs))
	{
		return($regs[3].'-'.$regs[2].'-'.$regs[1]) ;
	}
	else
	{
		return('') ;
	}
}

function FraDate($datecnv)
{
	if (ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$datecnv,$regs))
	{
		return(sprintf('%02d',$regs[3]).'/'.sprintf('%02d',$regs[2]).'/'.$regs[1]) ;
	}
	else
	{
		return('') ;
	}
}

function DojoDate($datecnv)
{
	if (ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$datecnv,$regs))
	{
		return(sprintf('%02d',$regs[2]).'/'.sprintf('%02d',$regs[3]).'/'.$regs[1]) ;
	}
	else
	{
		return('') ;
	}
}

function FraDateShort($datecnv)
{
	if (ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$datecnv,$regs))
	{
		return($regs[3].'/'.$regs[2]) ;
	}
	else
	{
		return('') ;
	}
}

function DateInXDays($X,$FromDate='')
{
    if($FromDate=='')
        $MyDate = explode('-',date('Y-m-d'));
    else
        $MyDate = explode('-',$FromDate);
    
    $XDate = getdate(mktime(0,0,0,$MyDate[1],$MyDate[2]+$X,$MyDate[0]));

    return($XDate['year'].'-'.str_pad($XDate['mon'], 2, '0', STR_PAD_LEFT).'-'.str_pad($XDate['mday'], 2, '0', STR_PAD_LEFT));
}

function DateInXMonths($X,$FromDate='')
{
    if($FromDate=='')
        $MyDate = explode('-',date('Y-m-d'));
    else
        $MyDate = explode('-',$FromDate);
    
    $XDate = getdate(mktime(0,0,0,$MyDate[1]+$X,$MyDate[2],$MyDate[0]));

    return($XDate['year'].'-'.str_pad($XDate['mon'], 2, '0', STR_PAD_LEFT).'-'.str_pad($XDate['mday'], 2, '0', STR_PAD_LEFT));
}

function FraHeure($heurecnv)
{
	if (ereg('([0-9]{1,2}):([0-9]{2}):([0-9]{2})',$heurecnv,$regs))
	{
		return($regs[1].'h'.$regs[2]) ;
	}
	else
	{
		return('') ;
	}
}

function MySQLHeure($heurecnv)
{
	if (ereg('([0-9]{1,2})h([0-9]{2})',$heurecnv,$regs))
	{
		if (strlen($regs[1]) == 1) { $regs[1] = '0'.$regs[1]; }
		return($regs[1].':'.$regs[2].':00') ;
	}
	else
	{
		return('') ;
	}
}

function decoupedatesql($date)
{
  $annee=substr($date,0,4);
  $mois=substr($date,4,2);
  $jour=substr($date,-2);

  return ($annee.'-'.$mois.'-'.$jour);
}

function JourMoisDans($jour, $mois, $nbjours)
{
    if(($jour == '') or ($jour < 1))
    {
    	$jour = 1 ;
    }
    if(($mois == '') or ($mois < 1))
    {
    	$mois = 1 ;
    }
    
    $XDate = getdate(mktime(0,0,0,$mois,$jour+$nbjours,1996));

    $dans['jour'] = $XDate['mday'] ;
    $dans['mois'] = $XDate['mon'] ;
	
	return($dans) ;
}

/*
function form_to_db($date, $delimiter = '.')
{
  if (ereg("([0-9]{1,2})$delimiter([0-9]{1,2})$delimiter([0-9]{2,4})",
      $date, $regs))
  {
    if(strlen($regs[1]) <2) $regs[1] = "0$regs[1]";
    if(strlen($regs[2]) <2) $regs[2] = "0$regs[2]";
    if(strlen($regs[3]) <4) $regs[3] = "20$regs[3]";

    return "$regs[3]$regs[2]$regs[1]";
  }
  else
  {
    return false;
  }
}
*/

function min_date($date1, $date2)
{
	if(!ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date1,$regsdate1) or !ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date2,$regsdate2))
		return false ;
		
	if(mktime(0, 0, 0, $regsdate1[2], $regsdate1[1], $regsdate1[3]) <= mktime(0, 0, 0, $regsdate2[2], $regsdate2[1], $regsdate2[3]))
		return $date1 ;
	else
		return $date2 ;
}

function max_date($date1, $date2)
{
	if(!ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date1,$regsdate1) or !ereg('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})',$date2,$regsdate2))
		return false ;
		
	if(mktime(0, 0, 0, $regsdate1[2], $regsdate1[1], $regsdate1[3]) >= mktime(0, 0, 0, $regsdate2[2], $regsdate2[1], $regsdate2[3]))
		return $date1 ;
	else
		return $date2 ;
}

function removeAccent($str)
{
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    
    return $str;
}

?>
