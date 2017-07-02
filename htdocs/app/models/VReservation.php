<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Manager;

class VReservation extends ModelBase
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
     public $userNo;
    
    /**
     *
     * @var string
     */
    public $name;
    private $nameEncrypted;
    
    /**
     *
     * @var string
     */
    public $kana;
    private $kanaEncrypted;
    
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


    
    public function initialize()
    {
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
            'user_no' => 'userNo', 
            'name'          => 'nameEncrypted',
            'kana'          => 'kanaEncrypted',
            'status' => 'status'
        );
    }
    

    public function getSource()
    {
        return 'v_smc_reservation';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        if($lowerproperty == 'id') {
            $property = 'reservationId';
        }
        return $this->$property;
    }
    
    public function beforeValidation()
    {
    }
    public function validation()
    {
        
    }
    
     public function afterFetch()
    {
        $this->name = Utils::aes_decrypt($this->nameEncrypted);
        $this->kana = Utils::aes_decrypt($this->kanaEncrypted);
        
        
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