<?php
namespace Rdm\Link;

use Mojavi\Form\Form;

class BaseLink extends Form {

	protected $name;
	protected $rc;
	
	/**
	 * Sets the id
	 * @param int|Object $arg0
	 */
	function setId($arg0) {
		if (is_string($arg0) && \MongoId::isValid($arg0)) {
			parent::setId(new \MongoId($arg0));
		} else if ($arg0 instanceof \MongoId) {
			parent::setId($arg0);
		} else if (is_null($arg0)) {
			parent::setId($arg0);
		} else if (is_string($arg0) && trim($arg0) == '') {
			parent::setId(null);
		}
	}
	
	/**
	 * Returns the name
	 * @return string
	 */
	function getName() {
		if (is_null($this->name)) {
			return null;
		}
		return $this->name;
	}
	
	/**
	 * Sets the name
	 * @var string
	 */
	function setName($arg0) {
		$this->name = $arg0;
		$this->addModifiedColumn("name");
		return $this;
	}
	
	/**
	 * Returns the rc
	 * @return integer
	 */
	function getRc() {
		if (is_null($this->rc)) {
			return null;
		}
		return $this->rc;
	}
	
	/**
	 * Sets the rc
	 * @var integer
	 */
	function setRc($arg0) {
		$this->rc = (int)$arg0;
		$this->addModifiedColumn("rc");
		return $this;
	}
	
	/**
	 * Alias for getRecordCount
	 * @return integer
	 */
	function getRecordCount() {
		return $this->getRc();
	}
	
	/**
	 * Alias for setRecordCount
	 * @var integer
	 */
	function setRecordCount($arg0) {
		return $this->setRc($arg0);
	}
}