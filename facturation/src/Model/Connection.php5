<?php
/*
 * 
 * 
 * generator : org.acceleo.module.pim.uml21.gen.php.dao.connection
 *
 */

/**
 * This file contains the class that handles a connection within the database.
 *
 * @author My Company
 * @copyright Copyright (c) 2008 My Company
 * @version 1.0
 * @package dao
 */

/**
 * The configuration manager
 */
require_once(dirname(__FILE__) . "/../Model/common/config.php5");

/**
 * This class represents a connection to a database.
 *
 * @author My Company
 * @copyright Copyright (c) 2008 My Company
 * @version 1.0
 * @package dao
 */
class Connection {

	/** 
	 * Database connection.
	 *
	 * @var DB the Pear Data Base connection
	 * @link http://pear.php.net/manual/en/package.database.db.db.php PEAR::DB
	 */
	private $db;
	
	/**
	 * true if the connection is opened.
	 *
	 * @var bool true if the connection is opened.
	 */
	private $open;
	
	/**
	 * creates a new connection instance.
	 */
	public function __construct() {
		$this->open = false;
	}

	/**
	 * Open connection.
	 *
	 * @param bool $autocommit if true then set autocommit.
	 * @link http://pear.php.net/manual/en/package.database.db.db-common.autocommit.php autocommit
	 */	
	public function open($autocommit = true) {
		$config = new Config();
		$this->db =& DB::connect($config->getDsn());
		if (PEAR::isError($this->db)) {
		    $cause = "Standard Message  : " . $this->db->getMessage() . "\n" . 
		    		 "User Information  : " . $this->db->getUserInfo() . "\n" .
		    		 "Debug Information : " . $this->db->getDebugInfo() . "\n";
			throw new Exception("impossible to etablish a connection to the database\n" . $cause);
		} else {
			$this->open = true;
			$this->db->autoCommit($autocommit);
		}
	}
	
	/**
	 * Returns true if the connection is open.
	 *
	 * @return bool true if the connection is open.
	 */
	public function isOpen() {
		return $this->open;
	}
	
	/**
	 * Closes connection.
	 *
	 * @return bool true if correctly disconnected.
	 */
	public function close() {
		$succeed = $this->db->disconnect();
		$this->db->open = false;
		return $succeed;
	}
	
	/**
	 * commits changes.
	 */
	public function commit() {
		$this->db->commit;
	}
	
	/**
	 * Rollback to last commit.
	 */
	public function rollback() {
		$this->db->rollback();
	}
	
	/**
	 * Returns PEAR DB object.
	 *
	 * @return DB_common the pear db object.
	 */
	public function getDb() {
		return $this->db;
	}
	

}


?>