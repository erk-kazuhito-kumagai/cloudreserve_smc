<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class VHeader extends ModelBase
{
    
     
    /**
     *
     * @var integer
     */
    public $headerId;
    public $userId;
    public $reservationId;
    public $checkupId;
    public $checkupName;
    public $checkupDetail;
    
    public $userName;
    public $userCode;
    public $gender;
    public $birthday;
    public $hireDate;
    public $checkupNo;
    public $workplaceCode;
    public $workplaceName;
    public $workplaceAddress;
    public $type;
    public $deteof;
    public $workFrom;
    public $workTo;
    public $bloodSample;
    public $urineSample;
    

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'headerId',
            'reservation_id' => 'reservationId',
            'checkup_id' => 'checkupId',
            'checkup_name' => 'checkupName',
            'checkup_detail' => 'checkupDetail',
            'user_id' => 'userId',
            'user_name' => 'userName',
            'user_code'=>'userCode',
            'gender'=>'gender',
            'birthday'=>'birthday',
            'hire_date'=>'hireDate',
            'checkup_no'=>'checkupNo',
            'workplace_code'=>'workplaceCode',
            'workplace_name'=>'workplaceName',
            'workplace_address'=>'workplaceAddress',
            'type'=>'type',
            'deteof'=>'deteof',
            'work_from'=>'workFrom',
            'work_to'=>'workTo',
            'blood_sample'=>'bloodSample',
            'urine_sample'=>'urineSample'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'headerId',
            'reservationId',
            'checkupId',
            'checkupName',
            'checkupDetail',
            'userId',
            'userName',
            'userCode',
            'gender',
            'birthday',
            'hireDate',
            'checkupNo',
            'workplaceCode',
            'workplaceName',
            'workplaceAddress',
            'type',
            'deteof',
            'workFrom',
            'workTo',
            'bloodSample',
            'urineSample'
        );
    }
    
     
    public function initialize()
    {
        
        
        
    }

    public function getSource()
    {
        return 'v_smc_header';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        
        return $this->$property;
    }
    
    public function afterFetch()
    {
        
    }


    
}
