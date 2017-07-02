<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Manager;

class Reservation extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $reservationId;
    
    public $vendorId;

    /**
     *
     * @var integer
     */
    public $userId;
    
    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $reservationDate;

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
    
    public function initialize()
    {
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
        
        $this->belongsTo("vendorId", "Vendor", "vendorId", 
            array(
                'alias'  => 'unit'
            ));
        $this->belongsTo("userId", "User", "userId", 
            array(
                'alias'  => 'user'
            ));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'reservationId', 
            'reservation_date' => 'reservationDate', 
            'vendor_id' => 'vendorId', 
            'user_id' => 'userId', 
            'status' => 'status', 
            'created_user'     => 'createdUser',
            'updated_user'     => 'updatedUser',
            'created_date'     => 'createdDate',
            'updated_date'     => 'updatedDate'
        );
    }
    

    public function getSource()
    {
        return 't_smc_reservation';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        if($lowerproperty == 'id') {
            $property = 'reservationId';
        } elseif($lowerproperty == 'user') {
            $this->user = $this->getRelated('user');
        } elseif($lowerproperty == 'vendor') {
            $this->vendor = $this->getRelated('vendor');
        }
        return $this->$property;
    }
    
    public function beforeValidation()
    {
        if($this->id) {
            return true;
        }
        
        if(!$this->user) {
            if($this->userId) {
                $this->user = User::findFirst($this->userId);
            }
        }
        
        $this->userId   = $this->user->userId;
        
    }
    public function validation()
    {
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
    
    public function afterFetch()
    {
    }
    public function beforeSave()
    {

    }

    public function beforeFetch()
    {
    }
    
    public function mail() {
    }
}