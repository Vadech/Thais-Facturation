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


require_once(dirname(__FILE__)."/Facture.php5");

/**
 *	Class Hotel
 *  20392313962039231396203923139620392313962039231396
 * @author
 * @version 2.0
 * @package Model
 *
*/
class Hotel  extends Entity{

	public $factures;
	public $nom_hotel;
	public $adresse_hotel;
	public $code_postal_hotel;
	public $ville_hotel;
	public $email_hotel;
	public $web_hotel;
	public $gerant_hotel;
	public $contact_hotel;
	public $dt_install;
	public $dt_trialend;
	public $dt_end;
	public $name_bdd;


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

		$sql = 'SELECT * FROM thaisodt.hotels WHERE id_hotel = '.$id ;
		if(!$res = $objquery->execute($sql, 'query'))
		{
			echo mysql_error();
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

		$sql = 'INSERT INTO Hotels ' ;
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
			Erreur::add(__CLASS__,__METHOD__,1,$sql,mysql_error()) ;
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

		$sql = 'UPDATE Hotels ' ;
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

		$sql2 = ' WHERE id_hotel='.$this->getId() ;

		$sql = $sql.$sql1.$sql2 ;
		if(!$res = $objquery->execute($sql, 'query'))
		{
			Erreur::add(__CLASS__,__METHOD__,1,$sql,mysql_error()) ;
			return false ;
		}
		else
			return true ;
		// End of user code
	}

	/**
	 * Operation getAllHotels
	 *
	 *
	 *
	 *
	 *
	 */
	public static function getAllHotels() {
		// Start of user code of business method getAllHotels
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$result = array() ;

		$sql = 'SELECT id_article FROM Hotels;' ;
		if($res = $objquery->execute($sql, 'query'))
		{
			if ($res->numRows() >= 1)
			{
				$row = array();
				while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
				{
					$obj = new Article($row['id_hotel']) ;
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

		$sql = 'DELETE FROM Hotels' ;
		$sql.= ' WHERE id_hotel='.$this->getId().' ;' ;
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
	 * Return factures value.
	 * Type : Facture
	 *
	 * @return
	 */
	public function getFactures($lazyloading = true) {
		return $this->factures;
	}
	
	/**
	 * Return factures value.
	 * Type : Facture
	 *
	 * @return
	 */
	public function getName_bdd($lazyloading = true) {
		return $this->name_bdd;
	}


	/**
	 * Setting of factures value.
	 * Type : Facture
	 *
	 * @param factures
	 */
	public function setFactures($factures) {
		$this->factures = $factures;
	}


	/**
	 * Add a Facture inside factures.
	 *
	 */
	public function addFactures($facture) {
		if (!isset($this->factures)) {
			$this->logger->log("{addFactures} You should not use an alter operation while the array is not initialized.", PEAR_LOG_WARNING);
			$this->factures = array();
		}
		array_push($this->factures, $facture);
	}


	/**
	 * Remove a Facture from factures.
	 *
	 */
	public function removeFacturesAt($i) {
		if (!isset($this->factures)) {
			$this->logger->log("{removeFactures} You should not use an alter operation while the array is not initialized.", PEAR_LOG_WARNING);
			$this->factures = array();
		}
		array_splice($this->factures, $i, 1);
	}


	/**
	 * Return the number of Facture in factures.
	 *
	 */
	public function getSizeOfFactures() {
		if (!isset($this->factures)) {
			$this->factures = array();
		}
		return count($this->factures);
	}


	/**
	 * Return an element Facture of factures
	 */
	public function getFacturesAt($i) {
		if (!isset($this->factures)) {
			$this->factures = array();
		}
		return $this->factures[$i];
	}

	/**
	 * Return nom_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getNom_hotel($lazyloading = true) {
		return $this->nom_hotel;
	}


	/**
	 * Setting of nom_hotel value.
	 * Type : String
	 *
	 * @param nom_hotel
	 */
	public function setNom_hotel($nom_hotel) {
		$this->nom_hotel = $nom_hotel;
	}


	/**
	 * Return adresse_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getAdresse_hotel($lazyloading = true) {
		return $this->adresse_hotel;
	}


	/**
	 * Setting of adresse_hotel value.
	 * Type : String
	 *
	 * @param adresse_hotel
	 */
	public function setAdresse_hotel($adresse_hotel) {
		$this->adresse_hotel = $adresse_hotel;
	}


	/**
	 * Return code_postal_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getCode_postal_hotel($lazyloading = true) {
		return $this->code_postal_hotel;
	}


	/**
	 * Setting of code_postal_hotel value.
	 * Type : String
	 *
	 * @param code_postal_hotel
	 */
	public function setCode_postal_hotel($code_postal_hotel) {
		$this->code_postal_hotel = $code_postal_hotel;
	}


	/**
	 * Return ville_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getVille_hotel($lazyloading = true) {
		return $this->ville_hotel;
	}


	/**
	 * Setting of ville_hotel value.
	 * Type : String
	 *
	 * @param ville_hotel
	 */
	public function setVille_hotel($ville_hotel) {
		$this->ville_hotel = $ville_hotel;
	}


	/**
	 * Return email_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getEmail_hotel($lazyloading = true) {
		return $this->email_hotel;
	}


	/**
	 * Setting of email_hotel value.
	 * Type : String
	 *
	 * @param email_hotel
	 */
	public function setEmail_hotel($email_hotel) {
		$this->email_hotel = $email_hotel;
	}


	/**
	 * Return web_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getWeb_hotel($lazyloading = true) {
		return $this->web_hotel;
	}


	/**
	 * Setting of web_hotel value.
	 * Type : String
	 *
	 * @param web_hotel
	 */
	public function setWeb_hotel($web_hotel) {
		$this->web_hotel = $web_hotel;
	}


	/**
	 * Return gerant_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getGerant_hotel($lazyloading = true) {
		return $this->gerant_hotel;
	}


	/**
	 * Setting of gerant_hotel value.
	 * Type : String
	 *
	 * @param gerant_hotel
	 */
	public function setGerant_hotel($gerant_hotel) {
		$this->gerant_hotel = $gerant_hotel;
	}


	/**
	 * Return contact_hotel value.
	 * Type : String
	 *
	 * @return
	 */
	public function getContact_hotel($lazyloading = true) {
		return $this->contact_hotel;
	}


	/**
	 * Setting of contact_hotel value.
	 * Type : String
	 *
	 * @param contact_hotel
	 */
	public function setContact_hotel($contact_hotel) {
		$this->contact_hotel = $contact_hotel;
	}


	/**
	 * Return dt_install value.
	 * Type : String
	 *
	 * @return
	 */
	public function getDt_install($lazyloading = true) {
		return $this->dt_install;
	}


	/**
	 * Setting of dt_install value.
	 * Type : String
	 *
	 * @param dt_install
	 */
	public function setDt_install($dt_install) {
		$this->dt_install = $dt_install;
	}


	/**
	 * Return dt_trialend value.
	 * Type : String
	 *
	 * @return
	 */
	public function getDt_trialend($lazyloading = true) {
		return $this->dt_trialend;
	}


	/**
	 * Setting of dt_trialend value.
	 * Type : String
	 *
	 * @param dt_trialend
	 */
	public function setDt_trialend($dt_trialend) {
		$this->dt_trialend = $dt_trialend;
	}


	/**
	 * Return dt_end value.
	 * Type : String
	 *
	 * @return
	 */
	public function getDt_end($lazyloading = true) {
		return $this->dt_end;
	}


	/**
	 * Setting of dt_end value.
	 * Type : String
	 *
	 * @param dt_end
	 */
	public function setDt_end($dt_end) {
		$this->dt_end = $dt_end;
	}






	/**
	 * Return an HTML description of the current object.
	 *
	 */
	public function __toString() {
		$ret = "<table border=\"4\">";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getDt_install());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getContact_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getDt_trialend());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getNom_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getEmail_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getAdresse_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getGerant_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getWeb_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getCode_postal_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getDt_end());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getVille_hotel());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>";
		$ret = $ret . "<table border=\"2\">";
		for ($i = 0; $i<$this->getSizeOfFactures(); $i++) {
			$ret = $ret."<tr><td>".stripslashes("")." n° $i</td><td>";
			$ret = $ret . $this->getFacturesAt($i)->__toString();
			$ret = $ret."</td></tr>";
		}
		$ret = $ret . "</table>";
		$ret = $ret . "</td></tr>";

		$ret = $ret."</table>";
		return $ret;
	}

	/**
	 * Returns a string which describes this Hotel object. Util for logging.
	 *
	 * @return String $desc a string which describes this Hotel object.
	 */
	public function getSimpleString() {
		$desc =	'Hotel : [id=' . $this->getId() . '] '
				;
				return $desc;
	}

	/**
	 * Operation getHotelsAFacturer
	 *
	 *
	 *
	 *
	 *
	 */
	public static function getHotelsAFacturer() {
		// Start of user code of business method getHotelsAFacturer
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'SELECT id_hotel FROM thaisodt.hotels' ;
		$sql.= ' WHERE dt_install<=NOW()' ;
		$sql.= ' ORDER BY id_hotel ;' ;
		$res = $objquery->execute($sql, 'query');
		if(!$res)
		{
			echo mysql_error();
			return false ;
		}
		$row = array();
		$tab = array() ;
		while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
		{
			$tab[] = new Hotel($row['id_hotel']) ;
		}

		return $tab ;
		// End of user code
	}
	
	function getLastFacture()
	{
		// Start of user code of business method getFactureFor
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;
		
		$sql = 'SELECT MAX(id_facture) as lastId FROM factures' ;
		$sql.= ' WHERE id_hotel='.$this->getId().';' ;
		$res = $objquery->execute($sql, 'query');
		if(!$res)
		{
			echo $sql."  ERROR:". mysql_error()."<br/>";
			return false ;
		}
		$row = array();
		$res->fetchInto($row, DB_FETCHMODE_ASSOC);
		if ($res->numRows() == 0)
		{
			return null;
		}
		$id = $row['lastId'];
		$facture = new Facture($id);
		return $facture;
		// End of user code
	}

	/**
	 * Operation getChambresReservationsPeriode
	 *
	 *
	 *
	 * Parameters :
	 *		 date_debut :
	 *		 date_fin :
	 *
	 *
	 */
	public  function getChambresReservationsPeriode($date_debut,$date_fin) {
		// Start of user code of business method getChambresReservationsPeriode
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$bdd_hotel = $this->getName_bdd() ;
		$tab = array() ;

		$sql = 'SELECT id_chambre FROM `'.$bdd_hotel.'`.chambres ;' ;
		if(!$res = $objquery->execute($sql, 'query'))
		{ 
			//echo mysql_error().$sql ;
			return;
		}
		$row = array() ;
		while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
		{
			// Découpage mois
			$mois_debut = date('m', strtotime($date_debut)) ;
			$annee_debut = date('Y', strtotime($date_debut)) ;

			while(date('Y-m-d', mktime(0,0,0, $mois_debut, 1, $annee_debut)) < $date_fin)
			{
				$sql2 = 'SELECT COUNT(id_reservation_chambres) as nb FROM `'.$bdd_hotel.'`.reservations_chambres rc, `'.$bdd_hotel.'`.reservations r' ;
				$sql2.= ' WHERE r.id_reservation=rc.id_reservation AND id_chambre='.$row['id_chambre'] ;
				$sql2.= ' AND r.date_debut<=\''.$annee_debut.'-'.$mois_debut.'-31\'' ;
				$sql2.= ' AND r.date_fin>=\''.$annee_debut.'-'.$mois_debut.'-01\' ;' ;
				$res2 = $objquery->execute($sql2, 'query');
				$row2 = array() ;
				$res2->fetchInto($row2, DB_FETCHMODE_ASSOC) ;

				$tab[] = array('id_chambre' => $row['id_chambre'],
						'nb_reservations' => $row2['nb'],
						'mois' => $mois_debut,
						'annee' => $annee_debut) ;

				$suivant = mktime(0, 0, 0, $mois_debut+1, 1, $annee_debut) ;
				$mois_debut = date('m', $suivant) ;
				$annee_debut = date('Y', $suivant) ;
			}
		}

		return $tab ;
		// End of user code
	}
	
	function getFactureFor($date)
	{
		// Start of user code of business method getFactureFor
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;
		
		$sql = 'SELECT id_facture FROM factures' ;
		$sql.= ' WHERE id_hotel='.$this->getId() ;
		$sql.= ' AND date_deb_facture<="'.$date.'"' ;
		$sql.= ' AND date_fin_facture>"'.$date.'";' ;
		$res = $objquery->execute($sql, 'query');
		if(!$res)
		{
			echo $sql."  ERROR:". mysql_error()."<br/>";
			return false ;
		}
		$row = array();
		$res->fetchInto($row, DB_FETCHMODE_ASSOC);
		if ($res->numRows() == 0)
		{
			return null;
		}
		$id = $row['id_facture'];
		$facture = new Facture($id);
		return $facture;
		// End of user code
	}
	
	function getFacture($date)
	{
		// Start of user code of business method getFacture
		require_once('QueryTool.php') ;
	
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;
	
		$sql = 'SELECT id_facture FROM factures' ;
		$sql.= ' WHERE id_hotel='.$this->getId() ;
		$sql.= ' AND date_deb_facture="'.$date.'";' ;
		$res = $objquery->execute($sql, 'query');
		if(!$res)
		{
			echo $sql."  ERROR:". mysql_error()."<br/>";
			return false ;
		}
		$row = array();
		$res->fetchInto($row, DB_FETCHMODE_ASSOC);
		if ($res->numRows() == 0)
		{
			return null;
		}
		$id = $row['id_facture'];
		$facture = new Facture($id);
		return $facture;
		// End of user code
	}
}
?>
