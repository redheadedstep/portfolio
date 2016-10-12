<?php
namespace Rdm\Base;

use Mojavi\Form\MongoForm;
/**
 * DomainGroup contains methods to work with the account table.
 * Stores a list of accounts in the system 
 * @author hobby
 * @since 12/30/2013 4:39 pm 
 */
class Domain extends MongoForm {
	
	// +------------------------------------------------------------------------+
	// | PRIVATE VARIABLES														|
	// +------------------------------------------------------------------------+
	
	protected $name;
	protected $description;
	protected $domain_group;
	protected $email_count;
	protected $created_time;
	
	// +------------------------------------------------------------------------+
	// | CONSTRUCTOR															|
	// +------------------------------------------------------------------------+
	/**
	 * Constructs a new object
	 * @return Account
	 */
	function __construct() {
		$this->setCollectionName('domain');
		$this->setDbName('default');
	}
	
	// +------------------------------------------------------------------------+
	// | PUBLIC METHODS															|
	// +------------------------------------------------------------------------+
	
	/**
	 * Returns the name
	 * @return string
	 */
	function getName() {
		if (is_null($this->name)) {
			$this->name = "";
		}
		return $this->name;
	}
	
	/**
	 * Sets the name
	 * @var string
	 */
	function setName($arg0) {
		$this->name = $arg0;
		$this->addModifiedColumn('name');
		return $this;
	}
	
	/**
	 * Returns the description
	 * @return string
	 */
	function getDescription() {
		if (is_null($this->description)) {
			$this->description = "";
		}
		return $this->description;
	}
	
	/**
	 * Sets the description
	 * @var string
	 */
	function setDescription($arg0) {
		$this->description = $arg0;
		$this->addModifiedColumn('description');
		return $this;
	}	
	
	/**
	 * Returns the domain_group
	 * @return \Rdm\Link\DomainGroup
	 */
	function getDomainGroup() {
	    if (is_null($this->domain_group)) {
	        $this->domain_group = new \Rdm\Link\DomainGroup();
	    }
	    return $this->domain_group;
	}
	
	/**
	 * Sets the domain_group
	 * @var \Rdm\Link\DomainGroup
	 */
	function setDomainGroup($arg0) {
	    if (is_string($arg0) && \MongoId::isValid($arg0)) {
	        $this->domain_group = new \Rdm\Link\DomainGroup();
	        $this->domain_group->setId($arg0);
	        if (\MongoId::isValid($this->domain_group->getId()) && $this->domain_group->getName() == '') {
	            $this->domain_group->setName($this->domain_group->getDomainGroup()->getName());
	        }
	    } else if ($arg0 instanceof \MongoId) {
	        $this->domain_group = new \Rdm\Link\DomainGroup();
	        $this->domain_group->setId($arg0);
	        if (\MongoId::isValid($this->domain_group->getId()) && $this->domain_group->getName() == '') {
	            $this->domain_group->setName($this->domain_group->getDomainGroup()->getName());
	        }
	    } else if (is_array($arg0)) {
	        $this->domain_group = new \Rdm\Link\DomainGroup();
	        $this->domain_group->populate($arg0);
	        if (\MongoId::isValid($this->domain_group->getId()) && $this->domain_group->getName() == '') {
	            $this->domain_group->setName($this->domain_group->getDomainGroup()->getName());
	        }
	    }
	    $this->addModifiedColumn('domain_group');
	    return $this;
	}
	
	/**
	 * Returns the email_count
	 * @return integer
	 */
	function getEmailCount() {
		if (is_null($this->email_count)) {
			$this->email_count = 0;
		}
		return $this->email_count;
	}
	
	/**
	 * Sets the email_count
	 * @var integer
	 */
	function setEmailCount($arg0) {
		$this->email_count = (int)$arg0;
		$this->addModifiedColumn('email_count');
		return $this;
	}
	
	/**
	 * Creates indexes for this collection
	 * @return boolean
	 */
	static function createIndexes() {
		$exception = null;
		$indexes = array();
		$indexes[] = array('idx' => array('name' => 1), 'options' => array('background' => true));
		foreach ($indexes as $index) {
			try {
				$collection = new self();
				$collection->getCollection()->createIndex($index['idx'], $index['options']);
			} catch (\Exception $e) {
				$exception = $e;
			}
		}
		
		if (!is_null($exception)) { throw $exception; }
	}
}