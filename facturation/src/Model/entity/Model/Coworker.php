<?php
/**
 * @package Model
 */

require_once(dirname(__FILE__).'/../Entity.php5');


require_once(dirname(__FILE__)."/Facture.php5");

/**
 *	Class Coworker
 *  20392313962039231396203923139620392313962039231396
 * @author
 * @version 2.0
 * @package Model
 *
*/
class Coworker  extends Entity{

	public $factures; //TODO remove it
	public $nom_coworker;
    public $adresse_coworker;
	public $code_postal_coworker;
	public $ville_coworker;
	public $email_coworker;
	public $nom_facture_coworker;
	public $dt_install;
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

		$sql = 'SELECT * FROM coworkers WHERE id_coworker = '.$id ;
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

		$sql = 'INSERT INTO Coworkers ' ;
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

		$sql = 'UPDATE Coworkers ' ;
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

		$sql2 = ' WHERE id_coworker='.$this->getId() ;

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
	 * Operation getAllCoworkers
	 *
	 *
	 *
	 *
	 *
	 */
	public static function getAllCoworkers() {
		// Start of user code of business method getAllCoworkers
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$result = array() ;

		$sql = 'SELECT id_article FROM Coworkers;' ;
		if($res = $objquery->execute($sql, 'query'))
		{
			if ($res->numRows() >= 1)
			{
				$row = array();
				while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
				{
					$obj = new Article($row['id_coworker']) ;
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

		$sql = 'DELETE FROM Coworkers' ;
		$sql.= ' WHERE id_coworker='.$this->getId().' ;' ;
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
	 * Return nom_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getNom_coworker($lazyloading = true) {
		return $this->nom_coworker;
	}


	/**
	 * Setting of nom_coworker value.
	 * Type : String
	 *
	 * @param nom_coworker
	 */
	public function setNom_coworker($nom_coworker) {
		$this->nom_coworker = $nom_coworker;
	}


	/**
	 * Return adresse_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getAdresse_coworker($lazyloading = true) {
		return $this->adresse_coworker;
	}


	/**
	 * Setting of adresse_coworker value.
	 * Type : String
	 *
	 * @param adresse_coworker
	 */
	public function setAdresse_coworker($adresse_coworker) {
		$this->adresse_coworker = $adresse_coworker;
	}


	/**
	 * Return code_postal_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getCode_postal_coworker($lazyloading = true) {
		return $this->code_postal_coworker;
	}


	/**
	 * Setting of code_postal_coworker value.
	 * Type : String
	 *
	 * @param code_postal_coworker
	 */
	public function setCode_postal_coworker($code_postal_coworker) {
		$this->code_postal_coworker = $code_postal_coworker;
	}


	/**
	 * Return ville_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getVille_coworker($lazyloading = true) {
		return $this->ville_coworker;
	}


	/**
	 * Setting of ville_coworker value.
	 * Type : String
	 *
	 * @param ville_coworker
	 */
	public function setVille_coworker($ville_coworker) {
		$this->ville_coworker = $ville_coworker;
	}


	/**
	 * Return email_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getEmail_coworker($lazyloading = true) {
		return $this->email_coworker;
	}


	/**
	 * Setting of email_coworker value.
	 * Type : String
	 *
	 * @param email_coworker
	 */
	public function setEmail_coworker($email_coworker) {
		$this->email_coworker = $email_coworker;
	}


	/**
	 * Return nom_facture_coworker value.
	 * Type : String
	 *
	 * @return
	 */
	public function getNom_facture_coworker($lazyloading = true) {
		return $this->nom_facture_coworker;
	}


	/**
	 * Setting of nom_facture_coworker value.
	 * Type : String
	 *
	 * @param nom_facture_coworker
	 */
	public function setNom_facture_coworker($nom_facture_coworker) {
		$this->nom_facture_coworker = $nom_facture_coworker;
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
		$ret = $ret. stripslashes($this->getNom_facture_coworker());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getNom_coworker());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getEmail_coworker());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getAdresse_coworker());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getCode_postal_coworker());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getDt_end());
		$ret = $ret . "</td></tr>";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getVille_coworker());
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
	 * Returns a string which describes this Coworker object. Util for logging.
	 *
	 * @return String $desc a string which describes this Coworker object.
	 */
	public function getSimpleString() {
		$desc =	'Coworker : [id=' . $this->getId() . '] '
				;
				return $desc;
	}

	/**
	 * Operation getCoworkersAFacturer
	 *
	 *
	 *
	 *
	 *
	 */
	public static function getCoworkersAFacturer() {
		// Start of user code of business method getCoworkersAFacturer
		require_once('QueryTool.php') ;

		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'SELECT id_coworker FROM coworkers' ;
		$sql.= ' WHERE dt_install<=NOW()' ;
		$sql.= ' ORDER BY id_coworker ;' ;
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
            $tab[] = new Coworker($row['id_coworker']) ;
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
		$sql.= ' WHERE id_coworker='.$this->getId().';' ;
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
		if($id == "" || $id == null)
		{
			return null;
		}
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

		$bdd_coworker = $this->getName_bdd() ;
		$tab = array() ;

		$sql = 'SELECT id_chambre FROM `'.$bdd_coworker.'`.chambres ;' ;
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
				$sql2 = 'SELECT COUNT(id_reservation_chambres) as nb FROM `'.$bdd_coworker.'`.reservations_chambres rc, `'.$bdd_coworker.'`.reservations r' ;
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
		$sql.= ' WHERE id_coworker='.$this->getId() ;
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
		$sql.= ' WHERE id_coworker='.$this->getId() ;
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
