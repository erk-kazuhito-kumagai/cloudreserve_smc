<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete as SoftDelete;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;

class Person extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $vendorId;


    /**
     *
     * @var string
     */
    public $nickname;
    public $nicknameError;

    /**
     *
     * @var string
     */
    public  $name;
    private $nameEncrypted;
    public  $nameError;

    /**
     *
     * @var string
     */
    public  $kana;
    private $kanaEncrypted;
    public  $kanaError;

    /**
     *
     * @var string
     */
    public $email;
    private $emailEncrypted;
    public $emailError;

    /**
     *
     * @var string
     */
    public  $tel;
    private $telEncrypted;
    public  $telError;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $type;

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
            'vendor_id'               => 'vendorId',
            'name'                    => 'nameEncrypted',
            'kana'                    => 'kanaEncrypted',
            'email'                   => 'emailEncrypted',
            'tel'                     => 'telEncrypted',
            'status'                  => 'status',
            'operator_type'           => 'type',
            'created_user'            => 'createdUser',
            'updated_user'            => 'updatedUser',
            'created_date'            => 'createdDate',
            'updated_date'            => 'updatedDate'
        );
    }

    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'vendorId',
            'name',
            'kana',
            'email',
            'tel',
            'type',
            'status'
        );
    }

    /**
     * Initialize class
     */
    public function initialize()
    {
        $this->useDynamicUpdate(true);

        $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\Timestampable(array(
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

    /**
     * Relate table name
     */
    public function getSource()
    {
        return 'm_person';
    }

    /**
     * set parameter
     * @params array
     */
    public function setParameters($parameters) {
        if(!is_array($parameters)) {
            return;
        }
        $checkColumn = $this->getPostColumns();
        foreach($checkColumn as $key) {
            if(isset($parameters[$key])) {
                $this->$key = $parameters[$key];
            }
        }
    }

    /**
     * encrypt data
     */
    private function beforeSave() {
        $this->nameEncrypted           = Utils::aes_encrypt($this->name);
        $this->kanaEncrypted           = Utils::aes_encrypt($this->kana);
        $this->emailEncrypted          = Utils::aes_encrypt($this->email);
        $this->telEncrypted            = Utils::aes_encrypt($this->tel);
    }


    /**
     * decrypt data
     */
    public function afterFetch()
    {
        $this->name                    = Utils::aes_decrypt($this->nameEncrypted);
        $this->kana                    = Utils::aes_decrypt($this->kanaEncrypted);
        $this->email                   = Utils::aes_decrypt($this->emailEncrypted);
        $this->tel                     = Utils::aes_decrypt($this->telEncrypted);
    }

    public function validation()
    {
        $this->kana           = mb_convert_kana($this->kana , "KVC");
       
        $validator = new Validation();
        
        $validator->add(
        	'name',
        	new PresenceOf(
        	[]
        	)
        );
        

        $validator->add(
        	"name",
        	new StringLength(
                [
                    'max' => 50,
                    'min' => 1
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
        	"kana",
            new KanaValidator(
                array(
                    'required' => true
                )
            )
        );
        
        $validator->add(
        	"kana",
            new StringLength(
                [
                    'max' => 100,
                    'min' => 1
                ]
            )
        );

        $validator->add(
        	"tel",
            new TelValidator(
                [
      
                    "required" => true
                ]
            )
        );

        return $this->validate($validator);
    }


    public function beforeValidation()
    {
        if($this->status === null) {
            $this->status = Consts::ACTIVE;
        }

        $this->validation();

        if($this->validationHasFailed() == true ) {
            return false;
        }

        return true;
    }


    public static function get($vendorId, $status = NULL) {
        if($vendorId) {
            if($status) {
                return  Person::findFirst(array(
                    'conditions' => 'vendorId = ?1 and status = ?2',
                    'bind'       => array(1 => $vendorId, 2 => $status)
                ));
            } else {
                return  Person::findFirst(array(
                    'conditions' => 'vendorId = ?1',
                    'bind'       => array(1 => $id)
                ));
            }
        }
    }
}
