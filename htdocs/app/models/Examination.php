<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class Examination extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $examinationId;
    
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
    public $detail;
    public $detailError;
    
    public $item1;
    public $item1Disp;
    public $item1Detail;
    public $item1Class;
    public $item1Valid;
    public $item1Default;
    public $item1Unit;
    public $item1Mime;
    
    public $item2;
    public $item2Disp;
    public $item2Detail;
    public $item2Class;
    public $item2Valid;
    public $item2Default;
    public $item2Unit;
    public $item2Mime;
    
    public $item3;
    public $item3Disp;
    public $item3Detail;
    public $item3Class;
    public $item3Valid;
    public $item3Default;
    public $item3Unit;
    public $item3Mime;
    
    public $item4;
    public $item4Disp;
    public $item4Detail;
    public $item4Class;
    public $item4Valid;
    public $item4Default;
    public $item4Unit;
    public $item4Mime;
    
    
    public $item5;
    public $item5Disp;
    public $item5Detail;
    public $item5Class;
    public $item5Valid;
    public $item5Default;
    public $item5Unit;
    public $item5Mime;
    
    
    public $item6;
    public $item6Disp;
    public $item6Detail;
    public $item6Class;
    public $item6Valid;
    public $item6Default;
    public $item6Unit;
    public $item6Mime;

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
    
    public $template;

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
            'id'        => 'examinationId', 
            //'object_no' => 'objectNo', 
            'name'      => 'name', 
            'detail' => 'detail', 
            'seq'      => 'seq', 
            'status'      => 'status', 
            'item1'  => 'item1',
            'item1_disp'  => 'item1Disp',
            'item1_detail'=> 'item1Detail',
            'item1_class'  => 'item1Class',
            'item1_valid'  => 'item1Valid',
            'item1_default'  => 'item1Default',
            'item1_unit'  => 'item1Unit',
            'item1_mime'  => 'item1Mime',
            
            'item2'  => 'item2',
            'item2_disp'  => 'item2Disp',
            'item2_detail'=> 'item2Detail',
            'item2_class'  => 'item2Class',
            'item2_valid'  => 'item2Valid',
            'item2_default'  => 'item2Default',
            'item2_unit'  => 'item2Unit',
            'item2_mime'  => 'item2Mime',
            
            'item3'  => 'item3',
            'item3_disp'  => 'item3Disp',
            'item3_detail'=> 'item3Detail',
            'item3_class'  => 'item3Class',
            'item3_valid'  => 'item3Valid',
            'item3_default'  => 'item3Default',
            'item3_unit'  => 'item3Unit',
            'item3_mime'  => 'item3Mime',
            
            'item4'  => 'item4',
            'item4_disp'  => 'item4Disp',
            'item4_detail'=> 'item4Detail',
            'item4_class'  => 'item4Class',
            'item4_valid'  => 'item4Valid',
            'item4_default'  => 'item4Default',
            'item4_unit'  => 'item4Unit',
            'item4_mime'  => 'item4Mime',
            
            'item5'  => 'item5',
            'item5_disp'  => 'item5Disp',
            'item5_detail'=> 'item5Detail',
            'item5_class'  => 'item5Class',
            'item5_valid'  => 'item5Valid',
            'item5_default'  => 'item5Default',
            'item5_unit'  => 'item5Unit',
            'item5_mime'  => 'item5Mime',
            
            'item6'  => 'item6',
            'item6_disp'  => 'item6Disp',
            'item6_detail'=> 'item6Detail',
            'item6_class'  => 'item6Class',
            'item6_valid'  => 'item6Valid',
            'item6_default'  => 'item6Default',
            'item6_unit'  => 'item6Unit',
            'item6_mime'  => 'item6Mime',
            
            'from_date'    => 'fromDate',
            'to_date' => 'toDate', 
            //'template' => 'template', 
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
            'examinationId',
            //'objectNo', 
            'name',
            'detail',
            //'menu',
            'item1',
            'item1Disp',
            'item1Detail',
            'item1Class',
            'item1Valid',
            'item1Default',
            'item1Unit',
            'item1Mime',
            
            'item2',
            'item2Disp',
            'item2Detail',
            'item2Class',
            'item2Valid',
            'item2Default',
            'item2Unit',
            'item2Mime',
            
            'item3',
            'item3Disp',
            'item3Detail',
            'item3Class',
            'item3Valid',
            'item3Default',
            'item3Unit',
            'item3Mime',
            
            'item4',
            'item4Disp',
            'item4Detail',
            'item4Class',
            'item4Valid',
            'item4Default',
            'item4Unit',
            'item4Mime',
            
            'item5',
            'item5Disp',
            'item5Detail',
            'item5Class',
            'item5Valid',
            'item5Default',
            'item5Unit',
            'item5Mime',
            
            'item6',
            'item6Disp',
            'item6Detail',
            'item6Class',
            'item6Valid',
            'item6Default',
            'item6Unit',
            'item6Mime',
            
            'fromDate',
            'parentId',
            'toDate',
            'seq',
            'status',
            //'template'
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
        return 'm_smc_examination';
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
            return Examination::maximum(array(
                "column"     => "seq"
                ,"conditions" => "status = " . Consts::ACTIVE
            ));
            
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function beforeValidation() {
    
    	if(!$this->seq) {
            $this->seq = Examination::getMaxSort() + 1;
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
        if(!$this->template) {
            $this->template = get_class($this) . '_' . $this->examinationId . '.tpl';
        }
    }
    
}
