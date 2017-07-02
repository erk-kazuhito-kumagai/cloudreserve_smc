<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class ExaminationItem extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $examinationItemId;
    public $examinationId;
    public $itemNum;
    
    /**
     *
     * @var string
     */
    public $name;
    public $nameError;
    
    public $val;
    public $valError;

    /**
     *
     * @var string
     */
    public $seq;
    public $seqError;

    /**
     *
     * @var string
     */
    public $status;
    
    
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
            'id'        => 'examinationItemId',
            'examination_id'        => 'examinationId',
            'item_num'        => 'itemNum',
            'name'      => 'name', 
            'val'      => 'val', 
            'seq' => 'seq', 
            'status'      => 'status', 
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
            'examinationItemId',
            'examinationId',
            'itemNum',
            'name',
            'val',
            'seq',
            'status'
        );
    }
    
     
    public function initialize()
    {
        $this->addBehavior(new SoftDelete(
            array(
                'field' => 'status',
                'value' => Consts::INACTIVE
            )
        ));
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
        return 'm_smc_examination_item';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }

    
    public static function getMaxSort()
    {
        try {
            return ExaminationItem::maximum(array(
                "column"     => "seq"
                ,"conditions" => "status = " . Consts::ACTIVE
            ));
            
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function beforeValidation() {
    
    	if(!$this->seq) {
            $this->seq = ExaminationItem::getMaxSort() + 1;
        }
        
        
        if($this->status === '' ||  $this->status === NULL) {
            $this->status = Consts::ACTIVE;
        }
        
    }
    
    public function afterCreate() {
    }
    
}
