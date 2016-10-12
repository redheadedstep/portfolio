<?php
namespace Rdm\Link;
/**
 * Stores a link to a domain_group list
 * @author Mark Hobson
 */
class DomainGroup extends BaseLink {
	
	protected $domain_group_color;
	
	private $domain_group;
	
	/**
	 * Returns the domain_group_id
	 * @return integer
	 */
	function getDomainGroupId() {
		return $this->getId();
	}
	
	/**
	 * Sets the domain_group_id
	 * @var integer
	 */
	function setDomainGroupId($arg0) {
		return $this->setId($arg0);	
	}
	
	/**
	 * Sets the _id
	 * @return $this
	 */
	function setId($arg0) {
		parent::setId($arg0);
		if (\MongoId::isValid($this->_id) && $this->getDomainGroupColor() == '') {
			$this->setDomainGroupColor($this->getDomainGroup()->getColor());
		}
	}
	
	/**
	 * Returns the domain_group_name
	 * @return string
	 */
	function getDomainGroupName() {
		return $this->getName();
	}
	
	/**
	 * Sets the domain_group_name
	 * @var string
	 */
	function setDomainGroupName($arg0) {
		return $this->setName($arg0);
	}
	
	/**
	 * Returns the domain_group_color
	 * @return string
	 */
	function getDomainGroupColor() {
		if (is_null($this->domain_group_color)) {
			$this->domain_group_color = "";
		}
		return $this->domain_group_color;
	}
	
	/**
	 * Sets the domain_group_color
	 * @var string
	 */
	function setDomainGroupColor($arg0) {
		$this->domain_group_color = $arg0;
		$this->addModifiedColumn("domain_group_color");
		return $this;
	}
	
	/**
	 * Returns the domain_group
	 * @return \Rdm\DomainGroup
	 */
	function getDomainGroup() {
		if (is_null($this->domain_group)) {
			$this->domain_group = new \Rdm\DomainGroup();
			$this->domain_group->setId($this->getId());
			$this->domain_group->query();
		}
		return $this->domain_group;
	}
	
}