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
 *	Class Option    
 *   
 * @author
 * @version 2.0
 * @package Model
 * 
 */
class Option  extends Entity{

	public $libelle;
	public $tarif;


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

		$sql = 'SELECT * FROM options WHERE id_option = '.$id ;
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
					echo "Error no option founded";

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

		$sql = 'INSERT INTO options ' ;
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
			echo mysql_error();
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

		$sql = 'UPDATE options ' ;
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
		
		$sql2 = ' WHERE id_option='.$this->getId() ;
				
		$sql = $sql.$sql1.$sql2 ;		
		if(!$res = $objquery->execute($sql, 'query'))
		{
			echo mysql_error();
			return false ;
		}
		else
			return true ;		
		// End of user code
	}

	/**
	 * Operation getAllOptions
	 *
	 * 
	 * 
     * 
     *
	 */
	public static function getAllOptions() {
		// Start of user code of business method getAllOptions
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$result = array() ;

		$sql = 'SELECT id_option FROM options;' ;
		if($res = $objquery->execute($sql, 'query'))
		{
			if ($res->numRows() >= 1)
			{
				$row = array();
				while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
				{		
					$obj = new Option($row['id_option']) ;
					$result[] = $obj ;
				}
			}
		}
		else
		{
			echo mysql_error();
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
		
		$sql = 'DELETE FROM options' ;
		$sql.= ' WHERE id_option='.$this->getId().' ;' ;
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
	 * Return libelle value.
	 * Type : String
	 *
	 * @return 
	 */
	public function getLibelle($lazyloading = true) {
		return $this->libelle;
	}

	
	/**
	 * Setting of libelle value.
	 * Type : String
	 * 
	 * @param libelle 
	 */
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}

		
	/**
	 * Return tarif value.
	 * Type : Integer
	 *
	 * @return 
	 */
	public function getTarif($lazyloading = true) {
		return $this->tarif;
	}

	
	/**
	 * Setting of tarif value.
	 * Type : Integer
	 * 
	 * @param tarif 
	 */
	public function setTarif($tarif) {
		$this->tarif = $tarif;
	}

		



	
	/**
	 * Return an HTML description of the current object.
	 *
	 */
	public function __toString() {
		$ret = "<table border=\"4\">";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getTarif());
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getLibelle());
		$ret = $ret . "</td></tr>"; 
	
		$ret = $ret."</table>";
		return $ret;
	}

	/**
	 * Returns a string which describes this Option object. Util for logging.
	 *
	 * @return String $desc a string which describes this Option object.
	 */
	public function getSimpleString() {
		$desc =	'Option : [id=' . $this->getId() . '] '
				;
		return $desc;
	}
}
?>
