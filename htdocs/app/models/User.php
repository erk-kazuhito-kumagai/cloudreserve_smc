<?php
use \Phalcon\Mvc\Model\Relation;
use \Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\PresenceOf as PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Validator\StringLength as StringLength;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
class User extends ModelBase implements Serializable
{

    /**
     *
     * @var integer
     */
    public $userId;
    
    public $vendorId;

    /**
     *
     * @var string
     */
    public $userNo;

    /**
     *
     * @var string
     */
    public $parentId;
    
    /**
     *
     * @var int
     */
    public $company;

    /**
     *
     * @var string
     */
    public $name;
    private $nameEncrypted;
    public $nameError;

    /**
     *
     * @var string
     */
    public $kana;
    private $kanaEncrypted;
    public $kanaError;

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
    
    private $serializedDetail;

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
        
        $this->hasOne("userId", "UserDetail", "userId", 
            array(
                'alias'  => 'userdetail',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasOne("userId", "ChangeMailRequestUser", "userId", 
            array(
                'alias'  => 'changemailrequestuser',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany("userId", "User", "userId", 
            array(
                'alias'  => 'user',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany("userId", "VReservation", "userId", 
            array(
                'alias'  => 'vreservation',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany("userId", "Reservation", "userId", 
            array(
                'alias'  => 'reservation',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany("userId", "ReservationCheckup", "userId", 
            array(
                'alias'  => 'reservationCheckup',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany("userId", "VReservationCheckup", "userId", 
            array(
                'alias'  => 'vReservationCheckup'
            )
        );
    }

    public function getSource()
    {
        return 'm_user';
    }
    

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'            => 'userId', 
            'vendor_id'     => 'vendorId', 
            'user_no'       => 'userNo', 
            'parent_id'     => 'parentId',
            'company'       => 'company', 
            'name'          => 'nameEncrypted',
            'kana'          => 'kanaEncrypted',
            'email'         => 'emailEncrypted',
            'status'        => 'status', 
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
            'userNo',
            'name',
            'kana',
            'email',
            'status'
        );
    }
    
    
    /**
     * set parameter
     * @params array
     */
    public function setParam($parameters) {
        parent::setParam($parameters);

        if(!$this->detail) {
            $this->__get('detail');
        }
        $this->detail->setParam($parameters);
    }
    
    public function validation() {
        return $this->validationHasFailed() != true;
    }

    public function setValidation() {
        if($this->email) {
            $this->emailEncrypted          = Utils::aes_encrypt($this->email);
            $this->validate(new EmailValidator(array(
                'field' => 'email',
                'notRequired' => true,
                'message' => ''
            )));
        }

        if(!$this->userNo) {
            $this->userNo = Consts::DEFAULT_NUMBER;
        }

        $this->kana = mb_convert_kana($this->kana, "KVC");
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "name",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new PresenceOf(
                array(
                    "field"    => "kana",
                    "required" => true,
                )
            )
        );
        
        $this->validate(
            new StringLength(
                array(
                    "field"    => "name",
                    'max' => 50,
                    'min' => 1
                )
            )
        );

        $this->validate(
            new KanaValidator(
                array(
                    "field"    => "kana"
                )
            )
        );

        $this->validate(
            new StringLength(
                array(
                    "field"    => "kana",
                    'max' => 100,
                    'min' => 1
                )
            )
        );
    }
    public function beforeValidation() {
        $this->nameEncrypted           = Utils::aes_encrypt($this->name);
        $this->kanaEncrypted           = Utils::aes_encrypt($this->kana);
        $this->setValidation();
    }
    
    public function __get($property){
        $lowerproperty = strtolower($property);
        if($lowerproperty == 'id') {
            $property = 'userId';
        } elseif($lowerproperty == 'detail' || $lowerproperty == 'userdetail') {
            $property = 'userdetail';
            if(!property_exists($this, 'userdetail')) {

                if($this->userId) {
                    $this->__set($property, $this->getRelated('userdetail'));
                }

                if(!property_exists($this, 'userdetail')) {
                    $this->__set($property, new UserDetail());
                }
           }
        } elseif($lowerproperty == 'changemailrequestuser') {
            $property = 'changemailrequestuser';
            if(!property_exists($this, 'changemailrequestuser')) {
            
                if($this->userId) {
                    $this->__set($property, $this->getRelated('changemailrequestuser'));
                    
                }
                if(!property_exists($this, 'changemailrequestuser')) {
                    $this->__set($property, new ChangeMailRequestUser());
                }
           }
        } elseif($lowerproperty == 'preregistrationmail') {
           $property = 'changemailrequestuser';
            if(!property_exists($this, 'changemailrequestuser')) {
            
                if($this->userId) {
                    $this->__set($property, $this->getRelated('changemailrequestuser'));
                    
                }
                if(!property_exists($this, 'changemailrequestuser')) {
                    $this->__set($property, new ChangeMailRequestUser());
                }
           }
        } elseif($lowerproperty == 'user') {
            if(!property_exists($this, 'user')) {
            if($this->userId) {
                    $this->__set($property, $this->getRelated('user'));
                    
                }
                if(!property_exists($this, 'user')) {
                    $this->__set($property, array());
                }
            }
        } elseif($lowerproperty == 'password') {
           return $this->detail->$property;
        } elseif($lowerproperty == 'passworderror') {
           return $this->detail->$property;
        } elseif($lowerproperty == 'confirmationpassworderror') {
           return $this->detail->$property;
        }

        return $this->$property;
    }
    
    public function afterFetch()
    {
        $this->name = Utils::aes_decrypt($this->nameEncrypted);
        $this->kana = Utils::aes_decrypt($this->kanaEncrypted);
        if($this->emailEncrypted) {
            $this->email= Utils::aes_decrypt($this->emailEncrypted);
        }
        
    }
    
    public static function searchCount($params) {
    	$tables = array(
    		'ud' => 'UserDetail',
    		'u' => 'User');

    	$base = array(
            'models' => $tables,
            'columns' => array ('count(*) cnt')

        );

        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($base);
        $vendor       = \Phalcon\Di::getDefault()->getShared('currentVendor');
        $queryBuilder->where('u.vendorId = :param1:', array('param1' => sprintf('%d', $vendor->vendorId)));
        $queryBuilder->andWhere('u.userId = ud.userId');

        foreach ($params as $key => $val) {
            if ($val) {
                switch ($key) {
                case 'userNo':
                    $queryBuilder->andWhere("u.userNo = :userNo:", array('userNo' => "$val"));
                    break;
                case 'name':
                    $queryBuilder->andWhere("AES_DECRYPT(u.nameEncrypted, '". Consts::BANNERMODULE ."') like :name:", array('name' => "%$val%"));
                    break;
                case 'kana':
                    $queryBuilder->andWhere("AES_DECRYPT(u.kanaEncrypted, '". Consts::BANNERMODULE ."') like :kana:", array('kana' => "%$val%"));
                    break;
                case 'email':
                    $queryBuilder->andWhere("AES_DECRYPT(u.emailEncrypted, '". Consts::BANNERMODULE ."') = :email:", array('email' => "$val"));
                    break;
                case 'birthday':
                    $queryBuilder->andWhere('ud.birthday = :birthday:', array('birthday' => $val));
                    break;
                case 'post':
                    $queryBuilder->andWhere('ud.post = :post:', array('post' => $val));
                    break;
                case 'prefecture':
                    $queryBuilder->andWhere('ud.prefecture = :prefecture:', array('prefecture' => $val));
                    break;
                case 'address1':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.address1, '". Consts::BANNERMODULE ."') like :address1:", array('address1' => "%$val%"));
                    break;
                case 'address2':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.address2, '". Consts::BANNERMODULE ."') like :address2:", array('address2' => "%$val%"));
                    break;
                case 'tel':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.telEncrypted, '". Consts::BANNERMODULE ."') = :tel:", array('tel' => "$val"));
                    break;
                
                case 'gender':
                	$queryBuilder->andWhere("(ud.gender & :gender:) <> 0", array('gender' => $val));
                    break;
                case 'attribute':
                	$queryBuilder->andWhere("(ud.attribute & :attribute:) <> 0", array('attribute' => $val));
                    break;
                }
            }
        }
        
        $results = $queryBuilder->getQuery()->execute();
        return $results[0]->cnt;
        //$queryBuilder->limit($limit,  ($pageOffset-1) * Consts::PAGING);
        //ドライバにより使えない。
        //$offset = ($pageOffset-1) * Consts::PAGING;
        //$limit = " LIMIT $limit OFFSET $offset ";

        //$data = $queryBuilder->getQuery()->getSql();
        
        //$user = new User();
        //$map = $user->columnMap();
        //return  (new Resultset(null, $user, $user->getReadConnection()->query($data['sql'] . $limit, $data['bind'])));
    }
    
    public static function search($params, $pageOffset = 1, $limit = Consts::PAGING) {
    	
    	$queryBuilder = User::getQueryBuilderOfSearch($params);

        //$queryBuilder->limit($limit,  ($pageOffset-1) * Consts::PAGING);
        //ドライバにより使えない。
        $offset = ($pageOffset-1) * Consts::PAGING;
        $limit = " LIMIT $limit OFFSET $offset ";

        $data = $queryBuilder->getQuery()->getSql();
        
        $user = new User();
        $map = $user->columnMap();
        return  (new Resultset(null, $user, $user->getReadConnection()->query($data['sql'] . $limit, $data['bind'])));
    }
    
    public static function getQueryBuilderOfSearch($params) {
        $tables = array(
    		'ud' => 'UserDetail',
    		'u' => 'User');

    	$colums = array (
            'u.userId',
            'u.vendorId',
            'u.userNo',
            'u.parentId',
            'u.company',
            'u.nameEncrypted',
            'u.kanaEncrypted',
            'u.emailEncrypted',
            'u.status',
            'u.createdUser',
            'u.updatedUser',
            'u.createdDate',
            'u.updatedDate');

    	$base = array(
            'models' => $tables,
            'columns' => $colums,
    		'group' => $colums

        );

        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($base);
        $vendor       = \Phalcon\Di::getDefault()->getShared('currentVendor');
        $queryBuilder->where('u.vendorId = :param1:', array('param1' => sprintf('%d', $vendor->vendorId)));
        $queryBuilder->andWhere('u.userId = ud.userId');

        foreach ($params as $key => $val) {
            if ($val) {
                switch ($key) {
                case 'userNo':
                    $queryBuilder->andWhere("u.userNo = :userNo:", array('userNo' => "$val"));
                    break;
                case 'name':
                    $queryBuilder->andWhere("AES_DECRYPT(u.nameEncrypted, '". Consts::BANNERMODULE ."') like :name:", array('name' => "%$val%"));
                    break;
                case 'kana':
                    $queryBuilder->andWhere("AES_DECRYPT(u.kanaEncrypted, '". Consts::BANNERMODULE ."') like :kana:", array('kana' => "%$val%"));
                    break;
                case 'email':
                    $queryBuilder->andWhere("AES_DECRYPT(u.emailEncrypted, '". Consts::BANNERMODULE ."') = :email:", array('email' => "$val"));
                    break;
                case 'birthday':
                    $queryBuilder->andWhere('ud.birthday = :birthday:', array('birthday' => $val));
                    break;
                case 'post':
                    $queryBuilder->andWhere('ud.post = :post:', array('post' => $val));
                    break;
                case 'prefecture':
                    $queryBuilder->andWhere('ud.prefecture = :prefecture:', array('prefecture' => $val));
                    break;
                case 'address1':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.address1, '". Consts::BANNERMODULE ."') like :address1:", array('address1' => "%$val%"));
                    break;
                case 'address2':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.address2, '". Consts::BANNERMODULE ."') like :address2:", array('address2' => "%$val%"));
                    break;
                case 'tel':
                    $queryBuilder->andWhere("AES_DECRYPT(ud.telEncrypted, '". Consts::BANNERMODULE ."') = :tel:", array('tel' => "$val"));
                    break;
                
                case 'gender':
                	$queryBuilder->andWhere("(ud.gender & :gender:) <> 0", array('gender' => $val));
                    break;
                case 'attribute':
                	$queryBuilder->andWhere("(ud.attribute & :attribute:) <> 0", array('attribute' => $val));
                    break;
                }
            }
        }
        
        return $queryBuilder;
    }
    
    public function serialize() {
        $this->serializedDetail = $this->detail->serialize();
        $arrayData = array();
        $arrayData['serializedDetail'] = $this->serializedDetail;

        foreach($this->columnMap() as $val) {
            $arrayData[$val] = $this->$val;
        }
        
        return serialize(
            $arrayData
        );
    }
    
    public function unserialize($data) {
        
        $data = unserialize($data);
        
        foreach($data as $key => $val) {
            $this->$key = $val;
        }
        
        if(!$this->userId) {
            $this->detail->unserialize($this->serializedDetail);
        }
    }
}
