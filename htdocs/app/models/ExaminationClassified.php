<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class ExaminationClassified extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $classifiedId;
    
    public $checkupId;
    
    /**
     *
     * @var string
     */
    public $itemId;
    public $objectNo;
    
    public $type;
    public $template;

    /**
     *
     * @var string
     */
    public $parentId;
    /**
     *
     * @var string
     */
    public $topId;
    
    public $sort;
    
    /**
     *
     * @var string
     */
    public $createdUser;

    /**
     *
     * @var string
     */
    public $updatedUser;

    /**
     *
     * @var string
     */
    public $createdDate;

    /**
     *
     * @var string
     */
    public $updatedDate;
    

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'           => 'classifedId', 
            'checkup_id'     => 'checkupId', 
            //'object_no'           => 'objectNo', 
            'item_id'      => 'itemId', 
            'item_type'    => 'type', 
            'parent_id'    => 'parentId',
            'top_id'       => 'topId',
            'sort'         => 'sort',
            //'template'       => 'template', 
            'created_user'   => 'createdUser',
            'updated_user'   => 'updatedUser',
            'created_date'   => 'createdDate',
            'updated_date'   => 'updatedDate'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'classifedId', 
            'checkupId', 
            //'objectNo', 
            'itemId', 
            'type', 
            'parentId',
            'topId', 
            'sort', 
            //'template' 
        );
    }
    
     
    public function initialize()
    {
        $this->useDynamicUpdate(true);
        $this->addBehavior(new Phalcon\Mvc\Model\Behavior\Timestampable(array(
            'beforeValidationOnCreate' => array(
                'field' => array(
                    'createdDate',
                    'updatedDate'
                ),
                'format' => 'Y-m-d H:i:s'
            ),
            'beforeValidationOnUpdate' => array(
                'field'  => 'updatedDate',
                'format' => 'Y-m-d H:i:s'
            ),
        )));
        
        $this->addBehavior(new Operatorable(array(
            'beforeValidationOnCreate' => array(
                'field' => array(
                    'createdUser',
                    'updatedUser'
                )
            ),
            'beforeValidationOnUpdate' => array(
                'field'  => 'updatedUser'
            ),
        )));
        
        
    }

    public function getSource()
    {
        return 'm_smc_examination_classified';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }

    
    public function beforeValidation() {
    
    	if(!$this->parentId) {
            $this->parentId = 0;
        }
        
        if(!$this->topId) {
            $this->topId = 0;
        }
    }
    
    public static function deleteCheckupData($checkupId) {
    	$sql = 'delete from m_smc_examination_classified where checkup_id = ? ';
            $db = \Phalcon\Di::getDefault()->getShared('db');
            $data = array();
            $data[] = $checkupId;
            $pdoResult = $db->execute($sql, $data);
    }    
}
