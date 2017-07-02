<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class ExaminationCategory extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $examinationCategoryId;
    public $objectNo;
    
    /**
     *
     * @var string
     */
    public $name;
    public $nameError;
    
    /**
     *
     * @var string
     */
    public $menu;
    public $menuError;

    /**
     *
     * @var string
     */
    public $detail;
    public $detailError;
    
    public $comment;

    /**
     *
     * @var string
     */
    public $fromDate;
    public $fromDateError;
    
        /**
     *
     * @var string
     */
    public $toDate;
    public $toDateError;
    
    public $parentId;

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
            'id'        => 'examinationCategoryId',
            'name'      => 'name', 
            'menu'      => 'menu', 
            'detail' => 'detail', 
            'comment' => 'comment', 
            'parent_id' => 'parentId', 
            'seq'      => 'seq', 
            'status'      => 'status', 
            'from_date'    => 'fromDate',
            'to_date' => 'toDate', 
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
            'examinationCategoryId',
            'name',
            'detail',
            'comment',
            'menu',
            'fromDate',
            'parentId',
            'toDate',
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
        return 'm_smc_examination_category';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }


    public static function move($orgPositionCheckup , $newPositionCheckup)
    {
        $orgPosition = $orgPositionCheckup->sort;
        $newPosition = $newPositionCheckup->sort;
        if($orgPosition < $newPosition) {
            $sql = 'UPDATE dtb_checkup SET sort = sort - 1 WHERE status = ' . Consts::ACTIVE . ' and sort >? AND sort <=? ';
            $db = \Phalcon\Di::getDefault()->getShared('db');
            $data = array();
            $data[] = $orgPosition;
            $data[] = $newPosition;
            $pdoResult = $db->execute($sql, $data);
            $orgPositionCheckup->sort = $newPosition;
            $orgPositionCheckup->save();
        } elseif($orgPosition > $newPosition) {
            $sql = 'UPDATE dtb_checkup SET sort = sort + 1 WHERE status = ' . Consts::ACTIVE . ' and sort >=? AND sort <? ';
            $db = \Phalcon\Di::getDefault()->getShared('db');
            $data = array();
            $data[] = $newPosition;
            $data[] = $orgPosition;
            $pdoResult = $db->execute($sql, $data);
            $orgPositionCheckup->sort = $newPosition;
            $orgPositionCheckup->save();
        }
    }
    
    public static function getMaxSort()
    {
        try {
            return ExaminationCategory::maximum(array(
                "column"     => "seq"
                ,"conditions" => "status = " . Consts::ACTIVE
            ));
            
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function beforeValidation() {
    
    	if(!$this->seq) {
            $this->seq = ExaminationCategory::getMaxSort() + 1;
        }
        
        if(!$this->parentId) {
            $this->parentId = 0;
        }
        
        if(!$this->fromDate) {
            $this->fromDate = null;
        }
        
        if(!$this->toDate) {
            $this->toDate = null;
        }
        
        if($this->status === '' ||  $this->status === NULL) {
            $this->status = Consts::ACTIVE;
        }
        
    }
    
    public function afterCreate() {
    }
    
}
