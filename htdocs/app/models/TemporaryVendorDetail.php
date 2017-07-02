<?php
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;

class TemporaryVendorDetail extends ModelBase
{
    /**
     *
     * @var string
     */
    public $vendorDetailId;
    
    /**
     *
     * @var string
     */
    public $vendorId;
     
    /**
     *
     * @var string
     */
    public $post;
    public $postError;
     
    /**
     *
     * @var string
     */
    public $prefecture;
    public $prefectureError;
     
    /**
     *
     * @var string
     */
    public $address1;
    public $address1Error;
     
    /**
     *
     * @var string
     */
    public $address2;
     
    /**
     *
     * @var string
     */
    public $tel;
    public $telError;
     
    /**
     *
     * @var string
     */
    public $fax;
    public $faxError;
     
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
     *
     * @var string
     */
    public $activationCode;
    public $password;
    public $passwordError;
    public $confirmationPassword;
    public  $confirmationPasswordError;
    
    /**
     *
     * @var string
     */
    public $person;
    public $personEncrypted;
    public $personError;
    
    /**
     *
     * @var string
     */
    public $personKana;
    public $personKanaEncrypted;
    public $personKanaError;
    
    /**
     *
     * @var string
     */
    public $email;
    public $emailEncrypted;
    public $emailError;
     
    /**
     *
     * @var string
     */
    public $personTel;
    public $personTelEncrypted;
    public $personTelError;

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
        
        $this->belongsTo("vendorId", "TemporaryVendor", "vendorId"
            ,array('alias'  => 'vendor')
        );
    }
    
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'           => 'vendorDetailId',
            'vendor_id'    => 'vendorId', 
            'post'         => 'post', 
            'prefecture'   => 'prefecture', 
            'address1'     => 'address1', 
            'address2'     => 'address2', 
            'tel'          => 'tel', 
            'fax'          => 'fax', 
            'activation_code' => 'activationCode', 
            'created_user' => 'createdUser',
            'updated_user' => 'updatedUser',
            'created_date' => 'createdDate',
            'updated_date' => 'updatedDate',
            'person'       => 'personEncrypted', 
            'person_kana'  => 'personKanaEncrypted', 
            'email'        => 'emailEncrypted', 
            'person_tel'   => 'personTelEncrypted'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'post'         => 'post', 
            'prefecture'   => 'prefecture', 
            'address1'     => 'address1', 
            'address2'     => 'address2', 
            'tel'          => 'tel', 
            'fax'          => 'fax',
            'person'       => 'person',
            'personKana'   => 'personKana',
            'personTel'    => 'personTel',
            'email'        => 'email'
        );
    }
    
    public function getSource()
    {
        return 't_vendor_detail';
    }
    
    public function validation() {
    	$validator = new Validation();
        
        $validator->add(
        	"tel",
            new TelValidator(
                [
      
                    "required" => true
                ]
            )
        );
        
        $validator->add(
        	"post",
            new PostValidator(
                [
                    "required" => true
                ]
            )
        );
        
        $validator->add(
        	"email",
            new EmailValidator(
                [
                    "required" => true
                ]
            )
        );
        
        $validator->add(
        	"personTel",
            new TelValidator(
                [
                    "required" => true
                ]
            )
        );
        
        $validator->add(
        	'personKana',
            new StringLength(
                [
                   'max'       => 150,
                    'min'       =>   2
                ]
            )
        );
        
        $validator->add(
        	'personKana',
            new KanaValidator(
                [
                ]
            )
        );
        
        return $this->validate($validator);
    }
    
    public function beforeValidation() {
        
        $this->personTel  = str_replace('-', '', $this->personTel);
        
        $this->personEncrypted     = Utils::aes_encrypt($this->person);
        $this->personKanaEncrypted = Utils::aes_encrypt($this->personKana);
        $this->personTelEncrypted  = Utils::aes_encrypt($this->personTel);
        $this->emailEncrypted      = Utils::aes_encrypt($this->email);
        
        
        
        if($this->password) {
            $security = \Phalcon\Di::getDefault()->getShared('security');
            $this->passwordEncrypted   = $security->hash($this->password);
        }
        
        if(!$this->personTel) {
            $this->personTel = $this->tel;
        }
        
        
        
        $this->activationCode =  Encrypt::enc(Utils::createOwnerAccount($this->vendorId) . $this->email);
    }
    
    /**
     * decrypt data
     */
    public function afterFetch()
    {
        $this->email      = Utils::aes_decrypt($this->emailEncrypted);
        //print $this->email;
        //exit;
        $this->person     = Utils::aes_decrypt($this->personEncrypted);
        $this->personKana = Utils::aes_decrypt($this->personKanaEncrypted);
        $this->personTel  = Utils::aes_decrypt($this->personTelEncrypted);
    }
}