<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete as SoftDelete;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;

class Operator extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $operatorId;
    
    /**
     *
     * @var integer
     */
    public $vendorId;

    /**
     *
     * @var string
     */
    public $account;
    public $accountError;

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
    public  $lastName;
    private $lastNameEncrypted;
    public  $lastNameError;

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
     * @var integer
     */
    public $locked;

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
    
    protected $preregistrationmail;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'                      => 'operatorId',
            'vendor_id'               => 'vendorId',
            'special'                 => 'passwordEncrypted',
            'nickname'                => 'nname',
            'name'                    => 'nameEncrypted',
            'kana'                    => 'kanaEncrypted',
            'email'                   => 'emailEncrypted',
            'tel'                     => 'telEncrypted',
            'status'                  => 'status',
            'operator_type'           => 'type',
            'locked'                  => 'locked',
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
            'operatorId',
            'vendorId',
            'password',
            'name',
            'kana',
            'email',
            'tel',
            'type',
            'status',
            'createdUser',
            'updatedUser'
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
        
        $this->hasOne("operatorId", "PreRegistrationMailOperator", "operatorId", 
            array(
                'alias'  => 'preregistrationmail',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );

    }

    /**
     * Relate table name
     */
    public function getSource()
    {
        return 'm_operator';
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        if($lowerproperty == 'id') {
            $property = 'operatorId';
        } elseif($lowerproperty == 'preregistrationmail') {
            $property = 'preregistrationmail';
            if(!$this->preregistrationmail) {
            
                if($this->operatorId) {
                    $this->__set($property, $this->getRelated('preregistrationmail'));
                    
                }
                if(!$this->preregistrationmail) {
                    $this->__set($property, new PreRegistrationMailOperator());
                }
           }
        }
        return $this->$property;
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
        $this->firstNameKana  = mb_convert_kana($this->kana , "KVC");
        
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
        
        $validator->add(
        	"password",
            new PresenceOf(
                [
                ]
            )
        );
        
        $validator->add(
        	"password",
        	new StringLength(
                [
                    'max' => 8,
                    'min' => 6
                ]
            )
        );

        return $this->validate($validator);
    }


    public function beforeValidation()
    {
        $this->nameEncrypted           = Utils::aes_encrypt($this->name);
        $this->kanaEncrypted           = Utils::aes_encrypt($this->kana);
        $this->emailEncrypted          = Utils::aes_encrypt($this->email);
        $this->telEncrypted            = Utils::aes_encrypt($this->tel);
        if($this->password) {
            $security = \Phalcon\Di::getDefault()->getShared('security');
            $this->passwordEncrypted   = $security->hash($this->password);
        }
        
        if($this->status === null) {
            $this->status = Consts::ACTIVE;
        }
        
        if($this->locked === null) {
            $this->locked = Consts::NOLOCK;
        }

        $this->validation();

        if($this->validationHasFailed() == true ) {
            return false;
        }

        return true;
    }


    public static function searchCount($params) {

        $base = array(
            'models'     => array('s' => 'perator'),
            'columns'    => array('count(*) cnt')
        );

        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($base);

        $queryBuilder->columns('count(*) cnt');
        
        $queryBuilder->where('1 = 1');

        foreach($params as $key => $val) {
           if($val) {
               switch($key) {
                  case 'account':
                     $queryBuilder->andWhere("s.account like :account:", array('account' => "$val%"));
                     break;
                  case 'type':
                     $type = 0;
                     if(is_array($val)) {
                         foreach($val as $tempType) {
                             $type += pow(2, ($tempType - 1));
                         }
                     } else {
                         $type = $val;
                     }
                     $queryBuilder->andWhere('(s.type  & :type:) <> 0', array('type' => "$type"));
                     break;
                  case 'name':
                     $queryBuilder->andWhere("AES_DECRYPT(s.nameEncrypted, '". Consts::BANNERMODULE ."') like :name:", array('name' => "$val%"));
                     break;
                  case 'kana':
                     $queryBuilder->andWhere("AES_DECRYPT(s.kanaEncrypted, '". Consts::BANNERMODULE ."') like :kana:", array('kana' => "$val%"));
                     break;
                  case 'tel':
                     $queryBuilder->andWhere("AES_DECRYPT(s.telEncrypted, '". Consts::BANNERMODULE ."') like :tel:", array('tel' => "$val%"));
                     break;
                  case 'email':
                     $queryBuilder->andWhere("AES_DECRYPT(s.emailEncrypted, '". Consts::BANNERMODULE ."') like :email:", array('email' => "$val%"));
                     break;
                  case 'status':
                     $active     = false;
                     $noneactive = false;

                     if(is_array($val)) {
                         if(in_array(Consts::NONEACTIVE, $val)) {
                             $noneactive = true;
                         }

                         if(in_array(Consts::ACTIVE, $val)) {
                             $active = true;
                         }

                         if($noneactive == true && $active == false) {
                             $queryBuilder->andWhere('s.status = :status:', array('status' => Consts::NONEACTIVE));
                         } elseif($noneactive == false && $active == true) {
                             $queryBuilder->andWhere('s.status = :status:', array('status' => Consts::ACTIVE));
                         }
                     } else {
                         $queryBuilder->andWhere('s.status = :status:', array('status' => $val));
                     }
                     break;
              }
           }
        }

        $results = $queryBuilder->getQuery()->execute();
        return $results[0]->cnt;
    }

    public static function search($params, $offset = Consts::OFFSET, $limit = Consts::PAGING) {
       $base = array(
            'models'     => array('s' => 'Operator'),
           // 'columns'    => array('count(*) cnt')
        );

       $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($base);

      $queryBuilder->where('1 = 1');


       foreach($params as $key => $val) {
           if($val) {
               switch($key) {
                  case 'account':
                     $queryBuilder->andWhere("s.account like :account:", array('account' => "$val%"));
                     break;
                  case 'type':
                     $type = 0;
                     if(is_array($val)) {
                         foreach($val as $tempType) {
                             $type += pow(2, ($tempType - 1));
                         }
                     } else {
                         $type = $val;
                     }
                     $queryBuilder->andWhere('(s.type  & :type:) <> 0', array('type' => "$type"));
                     break;
                  case 'name':
                     $queryBuilder->andWhere("AES_DECRYPT(s.nameEncrypted, '". Consts::BANNERMODULE ."') like :name:", array('name' => "$val%"));
                     break;
                  case 'kana':
                     $queryBuilder->andWhere("AES_DECRYPT(s.kanaEncrypted, '". Consts::BANNERMODULE ."') like :kana:", array('kana' => "$val%"));
                     break;
                  case 'tel':
                     $queryBuilder->andWhere("AES_DECRYPT(s.telEncrypted, '". Consts::BANNERMODULE ."') like :tel:", array('tel' => "$val%"));
                     break;
                  case 'email':
                     $queryBuilder->andWhere("AES_DECRYPT(s.emailEncrypted, '". Consts::BANNERMODULE ."') like :email:", array('email' => "$val%"));
                     break;
                  case 'status':
                     $active     = false;
                     $noneactive = false;

                     if(is_array($val)) {
                         if(in_array(Consts::NONEACTIVE, $val)) {
                             $noneactive = true;
                         }

                         if(in_array(Consts::ACTIVE, $val)) {
                             $active = true;
                         }

                         if($noneactive == true && $active == false) {
                             $queryBuilder->andWhere('s.status = :status:', array('status' => Consts::NONEACTIVE));
                         } elseif($noneactive == false && $active == true) {
                             $queryBuilder->andWhere('s.status = :status:', array('status' => Consts::ACTIVE));
                         }
                     } else {
                         $queryBuilder->andWhere('s.status = :status:', array('status' => $val));
                     }
                     break;
              }
           }
        }

        $queryBuilder->limit($limit, ($offset-1) * Consts::PAGING);
        
       return $queryBuilder->getQuery()->execute();

    }
}
