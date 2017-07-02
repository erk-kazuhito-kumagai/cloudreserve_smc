<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class VWorkitem extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $workitemId;
    
    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $detail;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'        => 'workitemId', 
            'name'      => 'name', 
            'detail' => 'detail',
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'workitemId',
            'name',
            'detail'
        );
    }
    
     
    public function initialize()
    {
        
    }

    public function getSource()
    {
        return 'v_smc_workitem';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }
}
