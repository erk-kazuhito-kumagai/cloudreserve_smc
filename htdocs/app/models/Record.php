<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class Record extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $recordId;
    public $reservationId;
    public $headerId;
    public $examinationId;
    public $objectNo;
    public $examinationName;
    public $examinationTemplate;
    public $checkupId;
    public $seq;
    public $topCategoryId;
    public $topCategoryName;
    public $topCategoryTemplate;
    public $middleCategoryId;
    public $middleCategoryName;
    public $middleCategoryTemplate;
    public $varchar1;
    public $varchar2;
    public $varchar3;
    public $varchar4;
    public $varchar5;
    public $integer1;
    public $integer2;
    public $integer3;
    public $integer4;
    public $integer5;
    public $date1;
    public $date2;
    public $date3;
    public $date4;
    public $date5;
    public $text1;
    public $text2;
    public $text3;
    
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
            'id' => 'recordId',
            'reservation_id' => 'reservationId',
            'header_id' => 'headerId',
            'examination_id' => 'examinationId',
            'object_no'      => 'objectNo',
            'examination_name' => 'examinationName',
            'examination_template' => 'examinationTemplate',
            'checkup_id' => 'checkupId',
            'seq' => 'seq',
            'top_category_id' =>'topCategoryId',
            'top_category_name' => 'topCategoryName',
            'top_category_template' => 'topCategoryTemplate',
            'middle_category_id' =>'middleCategoryId',
            'middle_category_name' => 'middleCategoryName',
            'middle_category_template' => 'middleCategoryTemplate',
            'vachar1' =>  'varchar1',
            'vachar2' =>  'varchar2',
            'vachar3' =>  'varchar3',
            'vachar4' =>  'varchar4',
            'vachar5' =>  'varchar5',
            'integer1' => 'integer1',
            'integer2' => 'integer2',
            'integer3' => 'integer3',
            'integer4' => 'integer4',
            'integer5' => 'integer5',
            'date1' => 'date1',
            'date2' => 'date2',
            'date3' => 'date3',
            'date4' => 'date4',
            'date5' => 'date5',
            'text1' => 'text1',
            'text2' => 'text2',
            'text3' => 'text3',
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
            'recordId',
            'reservationId',
            'headerId',
            'examinationId',
            'objectNo',
            'examinationName',
            'examinationTemplate',
            'checkupId',
            'seq',
            'topCategoryId',
            'topCategoryName',
            'topCategoryTemplate',
            'middleCategoryId',
            'middleCategoryName',
            'middleCategoryTemplate',
            'varchar1',
            'varchar2',
            'varchar3',
            'varchar4',
            'varchar5',
            'integer1',
            'integer2',
            'integer3',
            'integer4',
            'integer5',
            'date1',
            'date2',
            'date3',
            'date4',
            'date5',
            'text1',
            'text2',
            'text3'
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
        return 't_smc_record';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }


    
}
