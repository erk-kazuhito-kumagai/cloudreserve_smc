<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class ExaminationValidation extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $examinationValidationId;
    public $examinationId;
    public $itemNum;
    
    /**
     *
     * @var string
     */
    public $type;
    public $typeError;
    
    public $etc1;
    public $etc1Error;

    /**
     *
     * @var string
     */
    public $etc2;
    public $etc2Error;

    
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
            'id'        => 'examinationValidationId',
            'examination_id'        => 'examinationId',
            'item_num'        => 'itemNum',
            'type'      => 'type', 
            'etc1'      => 'etc1', 
            'etc2' => 'etc2', 
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
            'examinationValidationId',
            'examinationId',
            'itemNum',
            'type',
            'etc1',
            'etc2'
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
        return 'm_smc_examination_validation';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }

    public function beforeValidation() {
    
    }
    
    public function afterCreate() {
    }
    
}
