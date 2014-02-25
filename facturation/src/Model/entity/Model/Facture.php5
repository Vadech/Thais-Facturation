<?php
/*
 * 
 * 
 * generator : org.acceleo.module.pim.uml21.gen.php.entity.entity-implementation
 *
 */


/**
 * @package Model
 */

require_once(dirname(__FILE__).'/../Entity.php5');



/**
 *	Class Facture    
 *   
 * @author
 * @version 2.0
 * @package Model
 * 
 */
class Facture  extends Entity{

	public $id_hotel;
	public $numero_facture;
	public $date_deb_facture;
	public $date_fin_facture;
	public $montant_facture;
	public $url_pdf;
	public $affiche_tva;
	public $montant_reduction;
	public $libelle_reduction;
	public $isPayee;
	public $taux_tva;


	/**
	 * Empty constuctor
	 * 
	 */
	public function __construct($id = -1) {
		parent::__construct($id);
		$this->logger =& Log::singleton('file', dirname(__FILE__).'/../log/entity.log',PEAR_LOG_DEBUG);
		
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'SELECT * FROM factures WHERE id_facture = '.$id ;
		if(!$res = $objquery->execute($sql, 'query'))
		{
			echo $sql,mysql_error();
			$this->setId(-1) ;
		}
		else
		{	
			$row = array() ;
			if ($res->numRows() == 1)
			{
				$res->fetchInto($row, DB_FETCHMODE_ASSOC) ;
				foreach(get_object_vars($this) as $name => $val)
					$this->$name = $row[$name];
			}
			else
			{
				$this->setId(-1) ;

				if($res->numRows() > 1)
					Erreur::add(__CLASS__,__METHOD__,2,'','') ;

			}
		}
		// Start of user code of constructor
		//TODO
		// End of user code
	}

	/**
	 * Operation add
	 *
	 * 
	 * 
     * 
     *
	 */
	public  function add() {
		// Start of user code of business method add
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'INSERT INTO factures ' ;
		$sql1 = ' (' ;
		$sql2 = ' VALUES (' ;

		foreach(get_object_vars($this) as $name => $val)
		{
			if($name != 'id' and $name != 'logger')
			{
				$sql1.= $name.', ' ;
				if(is_numeric($val))
					$sql2.= $val.', ' ;
				else
					$sql2.= '\''.$val.'\', ' ;
			}
		}
		
		$sql1 = substr($sql1, 0, strlen($sql1)-2).')' ;
		$sql2 = substr($sql2, 0, strlen($sql2)-2).')' ;				
				
		$sql = $sql.$sql1.$sql2 ;		
		if($res = $objquery->execute($sql, 'query'))
			$this->setId(mysql_insert_id()) ;
		else
		{
			$this->setId(-1) ;
			echo $sql,mysql_error();
			return false ;
		}
		return true ;
		// End of user code
	}

	/**
	 * Operation update
	 *
	 * 
	 * 
     * 
     *
	 */
	public  function update() {
		// Start of user code of business method update
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'UPDATE factures ' ;
		$sql1 = ' SET ' ;

		foreach(get_object_vars($this) as $name => $val)
		{
			if($name != 'id' and $name != 'logger')
			{
				$sql1.= $name.'=' ;
				if(is_numeric($val))
					$sql1.= $val.', ' ;
				else
					$sql1.= '\''.$val.'\', ' ;
			}
		}
		$sql1 = substr($sql1, 0, strlen($sql1)-2) ;
		
		$sql2 = ' WHERE id_facture='.$this->getId() ;
				
		$sql = $sql.$sql1.$sql2 ;		
		if(!$res = $objquery->execute($sql, 'query'))
		{
			echo mysql_error() ;
			return false ;
		}
		else
			return true ;		
		// End of user code
	}

	/**
	 * Operation getAllFactures
	 *
	 * 
	 * 
     * 
     *
	 */
	public static function getAllFactures() {
		// Start of user code of business method getAllFactures
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$result = array() ;

		$sql = 'SELECT id_article FROM Factures;' ;
		if($res = $objquery->execute($sql, 'query'))
		{
			if ($res->numRows() >= 1)
			{
				$row = array();
				while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
				{		
					$obj = new Article($row['id_facture']) ;
					$result[] = $obj ;
				}
			}
		}
		else
		{
			Erreur::add(__CLASS__,__METHOD__,1,$sql,mysql_error()) ;
		}
		
		return $result;	
		// End of user code
	}
	
	/**
	 * Operation delete
	 *
	 * 
	 * 
     * 
     *
	 */
	public  function delete() {
		// Start of user code of business method delete
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;
		
		$sql = 'DELETE FROM Factures' ;
		$sql.= ' WHERE id_facture='.$this->getId().' ;' ;
		if(!$res = $objquery->execute($sql, 'query'))
		{
			Erreur::add(__CLASS__,__METHOD__,3,$sql,mysql_error()) ;
			return false ;
		}
		else
		{
			$this->setId(-1) ;
			return true ;
		}
		// End of user code
	}
	
	/**
	 * Return isPayee value.
	 * Type : Boolean
	 *
	 * @return
	 */
	public function getIsPayee($lazyloading = true) {
		return $this->isPayee;
	}
	
	
	/**
	 * Setting of isPayee value.
	 * Type : Boolean
	 *
	 * @param isPayee
	 */
	public function setIsPayee($isPayee) {
		$this->isPayee = $isPayee;
	}
	
	/**
	 * Return idHotel value.
	 * Type : int
	 *
	 * @return
	 */
	public function getIdHotel($lazyloading = true) {
		return $this->id_hotel;
	}
	
	
	/**
	 * Setting of idHotel value.
	 * Type : int
	 *
	 * @param int
	 */
	public function setIdHotel($id) {
		$this->id_hotel = $id;
	}
	
	/**
	 * Return numero_facture value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getNumero_facture($lazyloading = true) {
		return $this->numero_facture;
	}

	
	/**
	 * Setting of numero_facture value.
	 * Type : String
	 * 
	 * @param numero_facture 
	 */
	public function setNumero_facture($numero_facture) {
		$this->numero_facture = $numero_facture;
	}

		
	/**
	 * Return date_deb_facture value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getDate_deb_facture($lazyloading = true) {
		return $this->date_deb_facture;
	}

	
	/**
	 * Setting of date_deb_facture value.
	 * Type : String
	 * 
	 * @param date_facture 
	 */
	public function setDate_deb_facture($date_facture) {
		$this->date_deb_facture = $date_facture;
	}

	
	/**
	 * Return date_fin_facture value.
	 * Type : String
	 *
	 * @return
	 */
	public function getDate_fin_facture($lazyloading = true) {
		return $this->date_fin_facture;
	}
	
	
	/**
	 * Setting of date_fin_facture value.
	 * Type : String
	 *
	 * @param date_facture
	 */
	public function setDate_fin_facture($date_facture) {
		$this->date_fin_facture = $date_facture;
	}
		
	/**
	 * Return montant_facture value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getMontant_facture($lazyloading = true) {
		return $this->montant_facture;
	}

	
	/**
	 * Setting of montant_facture value.
	 * Type : String
	 * 
	 * @param montant_facture 
	 */
	public function setMontant_facture($montant_facture) {
		$this->montant_facture = $montant_facture;
	}


	/**
	 * Return taux_tva value.
	 * Type : String
	 *
	 * @return
	 */
	public function getTaux_tva($lazyloading = true) {
		return $this->taux_tva;
	}
	
	
	/**
	 * Setting of taux_tva value.
	 * Type : String
	 *
	 * @param montant_facture
	 */
	public function setTaux_tva($taux_tva) {
		$this->taux_tva = $taux_tva;
	}
	
	
	/**
	 * Return url_PDF value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getUrl_PDF($lazyloading = true) {
		return $this->url_pdf;
	}

	
	/**
	 * Setting of url_PDF value.
	 * Type : String
	 * 
	 * @param url_PDF 
	 */
	public function setUrl_PDF($url_PDF) {
		$this->url_pdf = $url_PDF;
	}

		
	/**
	 * Return afficeTVA value.
	 * Type : Boolean
	 *
	 * @return 
	 */
	public function getAfficeTVA($lazyloading = true) {
		return $this->affiche_tva;
	}

	
	/**
	 * Setting of afficeTVA value.
	 * Type : Boolean
	 * 
	 * @param afficeTVA 
	 */
	public function setAfficeTVA($afficeTVA) {
		$this->affiche_tva = $afficeTVA;
	}

		
	/**
	 * Return montantReduction value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getMontantReduction($lazyloading = true) {
		return $this->montant_reduction;
	}

	
	/**
	 * Setting of montantReduction value.
	 * Type : String
	 * 
	 * @param montantReduction 
	 */
	public function setMontantReduction($montantReduction) {
		$this->montant_reduction = $montantReduction;
	}

		
	/**
	 * Return libelleReduction value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getLibelleReduction($lazyloading = true) {
		return $this->libelle_reduction;
	}

	
	/**
	 * Setting of libelleReduction value.
	 * Type : String
	 * 
	 * @param libelleReduction 
	 */
	public function setLibelleReduction($libelleReduction) {
		$this->libelle_reduction = $libelleReduction;
	}

		



	
	/**
	 * Return an HTML description of the current object.
	 *
	 */
	public function __toString() {
		$ret = "<table border=\"4\">";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getAfficeTVA());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getDate_facture());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getMontantReduction());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getLibelleReduction());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getUrl_PDF());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getMontant_facture());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getNumero_facture());
		$ret = $ret . "</td></tr>"; 
	
		$ret = $ret."</table>";
		return $ret;
	}

	/**
	 * Returns a string which describes this Facture object. Util for logging.
	 *
	 * @return String $desc a string which describes this Facture object.
	 */
	public function getSimpleString() {
		$desc =	'Facture : [id=' . $this->getId() . '] '
				;
		return $desc;
	}
	
	/**
	 * Return the factory that has created this object.
	 *
	 * @return string the factory that has created this object.
	 */
	public function getFactory() {
		return new FactureFactory();
	}

	
	public function genererFacturePDF() {
		// Start of user code of business method genererFacturePDF
		require_once('../biblio/fn_dates.php') ;
		require_once('../biblio/fpdf153/fpdf.php');
		
		// Initialisation des variables
		$objHotel = new Hotel($this->getIdHotel()) ;
		setlocale(LC_TIME, 'fr_FR') ;
		$alinea = '';
		$euro = ' '.chr(128);
		$hotelNomGood = removeAccent(strtolower(str_replace(" ", "_", $objHotel->getNom_hotel())));
		$nom = '/pdf/facture_'.$hotelNomGood.'_'.$this->numero_facture.'.pdf';
		$this->setUrl_PDF("..".$nom);
		$local_path = $_SERVER['DOCUMENT_ROOT'].'/facturation'.$nom ;
		
		// Suppression de la facture si elle existe
		if(file_exists($local_path))
			unlink($local_path) ;
		
		// Initialisation des objets
		if($objHotel == null or $objHotel->getId() == -1)
		{
			// pb avec l'hotel
			echo 'Hotel correspondant non trouvé : id='.$this->getId_hotel() ;
			return 1 ;
		}
		
		//Instanciation de la classe dérivée
		$pdf=new FPDF('P');
		$pdf->SetMargins(10, 10, 10) ;
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		// Logo et titre
		$pdf->Image($_SERVER['DOCUMENT_ROOT'].'/facturation/images/logos/logo_factures.jpg',10,10,0,40);
		
		$pdf->SetFont('Arial','B',20);
		$pdf->Text(115,30,'FACTURE '.$this->getNumero_facture());
		
		$pdf->Ln(50) ;
		
		$pdf->SetFont('Arial','B',14);
		// Nom hôtel
		$pdf->Cell(105,7,utf8_decode('Thaïs-Soft'),0,0,'L');
		// Nom client
		$pdf->Cell(0,7,utf8_decode(html_entity_decode($objHotel->getNom_hotel(), ENT_NOQUOTES, "utf-8")),0,1,'L');
		
		// coordonnées
		$pdf->SetFont('Arial','',14);
		$pdf->Cell(105,7,utf8_decode('245 Sous le Mont Noir'),0,0,'L');
		$pdf->Cell(0,7,utf8_decode(html_entity_decode($objHotel->getAdresse_hotel(), ENT_NOQUOTES, "utf-8")),0,1,'L');
		
		$pdf->Cell(105,7,'39150'.'  '.utf8_decode('Lac des Rouges Truites'),0,0,'L');
		$pdf->Cell(0,7,$objHotel->getCode_postal_hotel().'  '.utf8_decode(html_entity_decode($objHotel->getVille_hotel(), ENT_NOQUOTES, "utf-8")),0,1,'L');
		$pdf->Ln(5) ;
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,5,utf8_decode('e-mail : contact@thais-soft.com'),0,1,'L');
		$pdf->Cell(0,5,utf8_decode('Web : http://thais-soft.com'),0,1,'L');
		
		$pdf->Ln(10) ;
		
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(0,7,utf8_decode('Facture du '.fraDate($this->getDate_deb_facture())));
		$pdf->Ln(7) ;
		
		$pdf->SetFillColor(200) ;
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,5,utf8_decode('Désignation'),1,0,'L',1);
		$pdf->Cell(20,5,utf8_decode('Quantité'),1,0,'R',1);
		$pdf->Cell(20,5,utf8_decode('TVA'),1,0,'R',1);
		$pdf->Cell(20,5,utf8_decode('PU HT'),1,0,'R',1);
		$pdf->Cell(30,5,utf8_decode('Total HT'),1,0,'R',1);
		
		$pdf->Ln(5) ;
		
		$totalDet = 0 ;
		$tabTotauxTva = array() ;
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255) ;
		
		$nbMois = diffDateMonth($this->getDate_deb_facture(),  $this->getDate_fin_facture());
		$tmp = 0;
		$montantMois = $this->getMontant_facture()/$nbMois;
		
		// Detail
		for($i=0; $i<$nbMois; $i++)
		{
			$libelle = 'Location de Thaïs-Hôtel du '.FraDate(DateInXMonths($tmp, $this->getDate_deb_facture())).' au '.FraDate(DateInXMonths($tmp+1, $this->getDate_deb_facture())) ;
			$pdf->Cell(100,5,utf8_decode($libelle),1,0,'L',1);
			$pdf->Cell(20,5,utf8_decode(1),1,0,'R',1);
			$pdf->Cell(20,5,utf8_decode(str_replace('.', ',', sprintf('%.2f', $this->getTaux_tva())))."%",1,0,'R',1);
			$pdf->Cell(20,5,utf8_decode(str_replace('.', ',', sprintf('%.2f', $montantMois))).$euro,1,0,'R',1);
			$pdf->Cell(30,5,utf8_decode(str_replace('.', ',', sprintf('%.2f', $montantMois))).$euro,1,0,'R',1);
			$pdf->Ln(5) ;
			$tmp++;
		}
		
		$pdf->Ln(5) ;
		
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFillColor(200) ;
		$pdf->Cell(100,5,utf8_decode('Options'),1,0,'L',1);
		$pdf->Cell(20,5,utf8_decode('Souscrite'),1,0,'R',1);
		$pdf->Cell(20,5,utf8_decode('TVA'),1,0,'R',1);
		$pdf->Cell(20,5,utf8_decode('PU HT'),1,0,'R',1);
		$pdf->Cell(30,5,utf8_decode('Total HT'),1,0,'R',1);
		$pdf->Ln(5) ;
		
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255) ;
		$tarifOption = 0;
		//option
		foreach (Option::getAllOptions() as $opt)
		{		
			$libelle = html_entity_decode($opt->getLibelle(), ENT_NOQUOTES, "utf-8");

			$optFact = new FactureOption($this->getId(), $opt->getId());
			$nb = $optFact->getId() != -1;
			$isOfferte = $optFact->getOffert();
			if($nb == 1 && !$isOfferte)
			{
				$statut = "Oui";
				$tarifOption += $opt->getTarif(); 
			}
			else if($isOfferte)
			{
				$statut = "Offerte";
				$nb = 0;
			}
			else
			{
				$statut = "Non";
			}
			$pdf->Cell(100,5,utf8_decode($libelle),1,0,'L',1);
			$pdf->Cell(20,5,utf8_decode($statut),1,0,'R',1);
			$pdf->Cell(20,5,utf8_decode(str_replace('.', ',', sprintf('%.2f', $this->getTaux_tva())))."%",1,0,'R',1);
			$pdf->Cell(20,5,(str_replace('.', ',', sprintf('%.2f', $opt->getTarif()))).$euro,1,0,'R',1);
			$pdf->Cell(30,5,utf8_decode(str_replace('.', ',', sprintf('%.2f', $opt->getTarif()*$nb))).$euro,1,0,'R',1);
			$pdf->Ln(5) ;
		}
		
		$tarifOption = $tarifOption*$nbMois;
		
		$pdf->Ln(5) ;
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255) ;
		
		// Sous-total HT
		$pdf->Cell(100+20+10,5,'',0,0,'L');
		$pdf->Cell(10+20,5,'Abonnement HT',1,0,'R',1);
		$pdf->Cell(30,5,str_replace('.', ',', sprintf('%.2f',$this->getMontant_facture())).$euro,1,1,'R',1);

		// Sous total option
		$pdf->Cell(100+20+10,5,'',0,0,'L');
		$pdf->Cell(10+20,5,'Option HT',1,0,'R',1);
		$pdf->Cell(30,5,str_replace('.', ',', sprintf('%.2f',$tarifOption)).$euro,1,1,'R',1);
		
		if($this->getMontantReduction() > 0)
		{
			// Reduction
			$pdf->Cell(100+20+10,5,'',0,0,'L');
			$pdf->Cell(10+20,5,utf8_decode($this->getLibelleReduction()),1,0,'R',1);
			$pdf->Cell(30,5,str_replace('.', ',', '-'.sprintf('%.2f',$this->getMontantReduction())).$euro,1,1,'R',1);
		}
		
		$totalFact = $this->getMontant_facture()+$tarifOption-$this->getMontantReduction();
		
		// Sous-total HT
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255) ;
		$pdf->Cell(100+20+10,5,'',0,0,'L');
		$pdf->Cell(10+20,5,'Sous-total HT',1,0,'R',1);
		$pdf->Cell(30,5,str_replace('.', ',', sprintf('%.2f',$totalFact)).$euro,1,1,'R',1);
		
		$montant_tva = (($totalFact)*$this->getTaux_tva())/100;
		// TVA
		$pdf->SetFillColor(255) ;
		$pdf->Cell(100+20+10,5,'',0,0,'L');
		$pdf->Cell(10+20,5,'TVA '.str_replace('.', ',', sprintf('%.2f', $this->getTaux_tva()))."%",1,0,'R',1);
		$pdf->Cell(30,5,str_replace('.', ',', sprintf('%.2f',$montant_tva)).$euro,1,1,'R',1);
	
		// Grand total
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFillColor(220) ;
		$pdf->Cell(100+20+10,7,'',0,0,'L');
		$pdf->Cell(10+20,7,'TOTAL TTC',1,0,'R',1);
		$pdf->Cell(30,7,str_replace('.', ',', sprintf('%.2f',$totalFact+$montant_tva)).$euro,1,0,'R',1);
	
		$pdf->Ln(5) ;

		// Mentions de la facture
		$mentions = 'Les factures sont payables à 15 jours.'."\n" ;
		$mentions.= 'Le réglement des services et/ou produits se fait en Euros, soit par chéque libellé à l\'ordre de Thaïs-Soft, soit par virement.'."\n" ;
		$mentions.= 'Indemnité forfaitaire de 40 euros pour frais de recouvrement, en cas de retard de paiement.' ;
	
		$lignes = explode("\n", $mentions) ; // TODO PAS FINI Mentions
		if(count($lignes) > 0)
		{
			$pdf->SetFillColor(255) ;
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(80,7,utf8_decode('Mentions complémentaires'),0,1,'L',1);
			$pdf->Ln(7) ;
	
			$pdf->SetFont('Arial','',10);
			foreach($lignes as $texte)
			{
				$pdf->MultiCell(0,5,utf8_decode($texte),0,1,'J');
			}
			$pdf->Ln(7) ;
		}
		
		$pdf->Output($local_path);

		if($this->update())
			return true ;
		// End of user code
	}
}
?>
