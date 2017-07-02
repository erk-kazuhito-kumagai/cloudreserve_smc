<?php
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Validator\StringLength as StringLength;
use Phalcon\Mvc\Model\Validator\Numericality as Numericality;
class UserDetail extends ModelBase implements Serializable
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $password;
    public $passwordEncrypted;
    public $passwordError;
    
    public $confirmationPasswordError;

    /**
     *
     * @var string
     */
    public $mark;
    public $markEncrypted;
    public $markError;
    
    /**
     *
     * @var string
     */
    public $number;
    public $numberEncrypted;
    public $numberError;
    
    /**
     *
     * @var string
     */
    public $insurersNumber;
    public $insurersNumberEncrypted;
    public $insurersNumberError;
    
    /**
     *
     * @var string
     */
    public $insurersName;
    public $insurersNameEncrypted;
    public $insurersNameError;

    /**
     *
     * @var string
     */
    public $mobileKey;
    public $mobileKeyEncrypted;

    /**
     *
     * @var string
     */
    public $lastLogin;

    /**
     *
     * @var string
     */
    public $lock;

    /**
     *
     * @var string
     */
    public $gender;
    public $genderError;

    /**
     *
     * @var string
     */
    public $birthday;
    public $birthdayEncrypted;
    public $birthdayError;

    /**
     *
     * @var string
     */
    public $birthYear;
    
    /**
     *
     * @var string
     */
    public $birthMonth;
    
    /**
     *
     * @var string
     */
    public $birthDay;

    /**
     *
     * @var string
     */
    public $post;
    public $postError;

    /**
     *
     * @var integer
     */
    public $prefecture;
    public $prefectureError;

    /**
     *
     * @var string
     */
    public $address1;
    public $address1Encrypted;
    public $address1Error;

    /**
     *
     * @var string
     */
    public $address2;
    public $address2Encrypted;

    /**
     *
     * @var string
     */
    public $tel;
    public $telEncrypted;
    public $telError;

    /**
     *
     * @var string
     */
    public $mailmaga;

    /**
     *
     * @var integer
     */
    public $attribute;

    /**
     *
     * @var string
     */
    public $comment;

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
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'            => 'userDetailId',
            'user_id'       => 'userId', 
            'special'       => 'passwordEncrypted',
            'mark'          => 'markEncrypted', 
            'number'        => 'numberEncrypted', 
            'insurers_number'=> 'insurersNumberEncrypted',
            'insurers_name' => 'insurersNameEncrypted',
            'mobile_key'    => 'mobileKeyEncrypted', 
            'last_login'    => 'lastLogin', 
            'lock'          => 'lock', 
            'gender'        => 'gender', 
            'birthday'      => 'birthday', 
            'birth_month'   => 'birthMonth', 
            'post'          => 'post', 
            'prefecture'    => 'prefecture', 
            'address1'      => 'address1Encrypted', 
            'address2'      => 'address2Encrypted', 
            'tel'           => 'telEncrypted', 
            'mailmaga'      => 'mailmaga', 
            'attribute'     => 'attribute', 
            'comment'       => 'comment', 
            'created_user'  => 'createdUser',
            'updated_user'  => 'updatedUser',
            'created_date'  => 'createdDate',
            'updated_date'  => 'updatedDate'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'mark', 
            'number', 
            'insurersNumber',
            'insurersName',
            'gender', 
            'password', 
            'birthday', 
            'post', 
            'prefecture', 
            'address1', 
            'address2', 
            'tel', 
            'mailmaga', 
            'attribute', 
            'comment'
        );
    }
    
        /**
     * set parameter
     * @params array
     */
    public function setParameters($parameters) {
        parent::setParameters($parameters);
        if(isset($parameters['gender']) && isset($parameters['gender'][0])) {
            $this->gender = $parameters['gender'][0];
        }
        if(isset($parameters['attribute']) && is_array($parameters['attribute'])) {
            $i = 0;
            foreach($parameters['attribute'] as $seq) {
                $i += pow(2, ($seq - 1));
            }
            $this->attribute = $i;
        }
    }

    
    public function getSource()
    {
        return 'm_user_detail';
    }
    
    public function beforeSave() {
        $this->tel        = str_replace('-', '', $this->tel);
        $this->post       = str_replace('-', '', $this->post);
        $dateTime         = new DateTime($this->birthday); 
        $this->birthMonth = $dateTime->format('m');
    }
    
    public function afterFetch()
    {
        $this->address1 = Utils::aes_decrypt($this->address1Encrypted);
        $this->address2 = Utils::aes_decrypt($this->address2Encrypted);
        $this->tel      = Utils::aes_decrypt($this->telEncrypted);
        $this->mark     = Utils::aes_decrypt($this->markEncrypted);
        $this->address1 = Utils::aes_decrypt($this->address1Encrypted);
    }
    
    public function setTelValidation() {
        $this->validate(
            new TelValidator(
                array(
                    "field"    => "tel",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "tel",
                    "required" => true,
                )
            )
        );
    }
    
    public function setValidation() {
        if($this->password) {
            $security = \Phalcon\Di::getDefault()->getShared('security');
            $this->passwordEncrypted   = $security->hash($this->password);
        }
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "gender"
                )
            )
        );
        
        $this->validate(
            new TelValidator(
                array(
                    "field"    => "tel",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PostValidator(
                array(
                    "field"    => "post",
                    "required" => true,
                )
            )
        );
        
        
        
        $this->validate(
            new DateValidator(
                array(
                    'field' => 'birthday'
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'birthday'
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "post",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "tel",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "prefecture",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "address1",
                    "required" => true,
                )
            )
        );
        /*
        $this->validate(
            new StringLength(
                array(
                    "field"    => "insurers_name",
                    'max' => 255
                )
            )
        );
        
        $this->validate(
            new StringLength(
                array(
                    "field"    => "insurers_number",
                    'max' => 8,
                    'min' => 4
                )
            )
        );
        $this->validate(
            new Numericality(
                array(
                    "field"    => "insurers_number"
                )
            )
        );
        
        $this->validate(
            new Numericality(
                array(
                    "field"    => "number"
                )
            )
        );
        */
    }
    
    /**
     * Validations and business logic
     */
    public function beforeValidation()
    {
        $this->address1Encrypted        = Utils::aes_encrypt($this->address1);
        $this->address2Encrypted        = Utils::aes_encrypt($this->address2);
        $this->telEncrypted             = Utils::aes_encrypt($this->tel);
        $this->markEncrypted            = Utils::aes_encrypt($this->mark);
        $this->numberEncrypted          = Utils::aes_encrypt($this->number);
        $this->insurersNumberEncrypted  = Utils::aes_encrypt($this->insurersNumber);
        $this->insurersNameEncrypted    = Utils::aes_encrypt($this->insurersName);
        //$this->mobileKeyEncrypted       = Utils::aes_encrypt($this->mobileKey);
        
        $this->setValidation();
    }
}
