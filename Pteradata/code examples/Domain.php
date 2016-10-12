<?php
namespace Rdm;
/**
 * DomainGroup contains methods to work with the domain_group table.
 *  
 * @author	 
 * @since 02/19/2014 1:03 pm 
 */
class Domain extends Base\Domain
{

	// +------------------------------------------------------------------------+
	// | CONSTANTS																|
	// +------------------------------------------------------------------------+
	const DEBUG = MO_DEBUG;
	
	// +------------------------------------------------------------------------+
	// | PRIVATE VARIABLES														|
	// +------------------------------------------------------------------------+
    private $domain_group_id_array;
	// +------------------------------------------------------------------------+
	// | PUBLIC METHODS															|
	// +------------------------------------------------------------------------+
    /**
     * Returns the domain_group_id_array
     * @return array
     */
    function getDomainGroupIdArray() {
        if (is_null($this->domain_group_id_array)) {
            $this->domain_group_id_array = array();
        }
        return $this->domain_group_id_array;
    }
    
    /**
     * Sets the domain_group_id_array
     * @var array
     */
    function setDomainGroupIdArray($arg0) {
        if (is_array($arg0)) {
            $this->domain_group_id_array = $arg0;
            foreach ($this->domain_group_id_array as $key => $value) {
                if (!\MongoId::isValid($value)) {
                    unset($this->domain_group_id_array[$key]);
                }
            }
            array_walk($this->domain_group_id_array, function(&$value) {
                $value = new \MongoId(trim($value));
            });
        } else if (is_string($arg0)) {
            if (strpos($arg0, ',') !== false) {
                $this->domain_group_id_array = explode(",", $arg0);
            } else if (\MongoId::isValid($arg0)) {
                $this->domain_group_id_array = array($arg0);
            }
            foreach ($this->domain_group_id_array as $key => $value) {
                if (!\MongoId::isValid($value)) {
                    unset($this->domain_group_id_array[$key]);
                }
            }
            array_walk($this->domain_group_id_array, function(&$value) {
                $value = new \MongoId(trim($value));
            });
        }
        
        $this->addModifiedColumn('domain_group_id_array');
        return $this;
    }
	// +------------------------------------------------------------------------+
	// | RELATION METHODS														|
	// +------------------------------------------------------------------------+

	// +------------------------------------------------------------------------+
	// | HELPER METHODS															|
	// +------------------------------------------------------------------------+
	
	/**
	 * Queries for a data field by the name
	 * @return DomainGroup
	 */
	function queryByName() {
		$criteria = array('name' => $this->getName());
		return parent::query($criteria, false);
	}
	
	/**
	 * Queries for a data field by the name
	 * @return DomainGroup
	 */
	function queryAll(array $criteria = array(), array $fields = array(), $hydrate = true, $timeout = 30000) {
	    if (trim($this->getName()) != '') {
	        $criteria['name'] = new \MongoRegex('/' . $this->getName() . '/i');
	    }
	    if (count($this->getDomainGroupIdArray()) > 0) {
	        $criteria['domain_group._id'] = array('$in' => $this->getDomainGroupIdArray());
	    }
	    return parent::queryAll($criteria, $fields, $hydrate);
	}
}