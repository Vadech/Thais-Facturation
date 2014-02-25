<?php
/*
 * 
 * 
 * generator : org.acceleo.module.pim.uml21.gen.php.common.config.php
 *
 */

/**
 * @package Model
 */

/**
 *	Class Config    
 *  Dynamic configuration manager 
 * @author tmp
 * @version $Id$
 * @package Model
 * 
 */
class Config {
	
	private $dsn;					// DSN of database.
	private $dbtype;
	private $dbhost;
	private $dbname;
	private $dbuser;
	private $dbpwd;
	
	private $smarty_compile_dir;
	private $smarty_config_dir;
	private $smarty_cache_dir;
	
	private $defaultCtrl;			// default controller
	
	public function __construct() {
		// Start of user code for configuration
		global $_dbname, $_dbuser, $_dbpass ;
		$this->dbhost = "localhost";
		$this->dbtype = "mysql";
		$this->dbname = $_dbname ;
		$this->dbuser = $_dbuser ;
		$this->dbpwd = $_dbpass ;
		// End of user code
		
		$this->dsn = $this->dbtype . "://" . $this->dbuser . ":" . $this->dbpwd . "@" . $this->dbhost . "/" . $this->dbname;
	}
	
	/**
	 * Returns DSN.
	 * @return string $dsn {@link dsn $this->dsn}
	 */
	public function getDsn() {
		return $this->dsn;
	}
	
	/**
	 * Returns default controller.
	 * @return Smarty $defaultCtrl  the {@link defaultCtrl default} app controler
	 */
	public function getDefaultCtrl() {
		return $this->defaultCtrl;
	}
	
	public function getSmartyCompileDir() {
		return $this->smarty_compile_dir;
	}
	
	public function getSmartyCacheDir() {
		return $this->smarty_cache_dir;
	}
	
	public function getSmartyConfigDir() {
		return $this->smarty_config_dir;
	}
	
	
}
?>
