<?php
/*
 * 
 * 
 * generator : org.acceleo.module.pim.uml21.gen.php.entity.abstract-entity
 *
 */

/**
 * The base entity interface.
 */
require_once(dirname(__FILE__)."/IEntity.php5");

/**
 * PEAR log.
 */
require_once("Log.php");
	
/**
 * PEAR DB
 */
require_once("DB.php");

/**
 * root class, manages ID ,debug and define string serialization signature
 * @package entity
 * @version $Id$
 */
abstract class Entity implements IEntity {

	private $id;
	
	protected $logger;
	
	public function __construct($id = -1) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public abstract function getSimpleString();
	
	public function debug($message) {
		$this->logger->log("{" . $this->getSimpleString() . "} " . $message, PEAR_LOG_DEBUG);
	}


}


?>