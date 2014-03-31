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


require_once(dirname(__FILE__)."/Option.php5");

/**
 *	Class FactureOption    
 *   
 * @author
 * @version 2.0
 * @package Model
 * 
 */
class FactureOption  extends Entity{

	public $id_facture;
	public $id_option;
	public $offert;


	/**
	 * Empty constuctor
	 * 
	 */
	public function __construct($idFacture = -1, $idOption) {
		parent::__construct($id);
		$this->logger =& Log::singleton('file', dirname(__FILE__).'/../log/entity.log',PEAR_LOG_DEBUG);
		
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$sql = 'SELECT * FROM factureOptions WHERE id_facture = '.$idFacture.' AND id_option = '.$idOption ;
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
				$this->setIdFacture($idFacture);
				$this->setIdOption($idOption);
				if($res->numRows() > 1)
					echo "ERROR ici lalalal ".$sql;

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

		$sql = 'INSERT INTO factureOptions ' ;
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
            var_dump($sql);
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

		$sql = 'UPDATE factureOptions ' ;
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
		$sql2 = ' WHERE id_facture ='.$this->getIdFacture() ;
		$sql2 .= ' AND id_option ='.$this->getIdOption() ;
		
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
	 * Operation getAllFactureOptions
	 *
	 * 
	 * 
     * 
     *
	 */
	public static function getAllFactureOptions($idFacture) {
		// Start of user code of business method getAllFactureOptions
		require_once('QueryTool.php') ;
		
		$connection = new Connection();
		$connection->open();
		$objquery = new DB_QueryTool($connection->getDb()) ;

		$result = array() ;

		$sql = 'SELECT * FROM factureOptions WHERE id_facture = '.$idFacture.';' ;
		if($res = $objquery->execute($sql, 'query'))
		{
			if ($res->numRows() >= 1)
			{
				$row = array();
				while($res->fetchInto($row, DB_FETCHMODE_ASSOC))
				{		
					$obj = new FactureOption($row['id_facture'], $row['id_option']) ;
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
		
		$sql = 'DELETE FROM factureOptions' ;
		$sql.= ' WHERE id_facture='.$this->getIdFacture() ;
		$sql.= ' AND id_option='.$this->getIdOption().' ; ' ;
		if(!$res = $objquery->execute($sql, 'query'))
		{
			echo mysql_error() ;
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
	 * Return option value.
	 * Type : Option
	 *
	 * @return 
	 */
	public function getIdOption($lazyloading = true) {
		return $this->id_option;
	}

	
	/**
	 * Setting of option value.
	 * Type : Option
	 * 
	 * @param option 
	 */
	public function setIdOption($option) {
		$this->id_option = $option;
	}

	/**
	 * Return option value.
	 * Type : Option
	 *
	 * @return
	 */
	public function getIdFacture($lazyloading = true) {
		return $this->id_facture;
	}
	
	
	/**
	 * Setting of option value.
	 * Type : Option
	 *
	 * @param option
	 */
	public function setIdFacture($facture) {
		$this->id_facture = $facture;
	}
	
	/**
	 * Return offert value.
	 * Type : Boolean
	 *
	 * @return 
	 */
	public function getOffert($lazyloading = true) {
		return $this->offert;
	}

	
	/**
	 * Setting of offert value.
	 * Type : Boolean
	 * 
	 * @param offert 
	 */
	public function setOffert($offert) {
		$this->offert = $offert;
	}

		



	
	/**
	 * Return an HTML description of the current object.
	 *
	 */
	public function __toString() {
		$ret = "<table border=\"4\">";
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret . $this->getOption()->__toString();
		$ret = $ret . "</td></tr>"; 
		$ret = $ret."<tr><td>".stripslashes("")."</td>";
		$ret = $ret . "<td>";
		$ret = $ret. stripslashes($this->getOffert());
		$ret = $ret . "</td></tr>"; 
	
		$ret = $ret."</table>";
		return $ret;
	}

	/**
	 * Returns a string which describes this FactureOption object. Util for logging.
	 *
	 * @return String $desc a string which describes this FactureOption object.
	 */
	public function getSimpleString() {
		$desc =	'FactureOption : [id=' . $this->getId() . '] '
				;
		return $desc;
	}
}
?>
