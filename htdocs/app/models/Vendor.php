<?php
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;
use Phalcon\Mvc\Model\Behavior\SoftDelete as SoftDelete;
class Vendor extends ModelBase
{

    /**
     *
     * @var integer
     */
    protected $vendorId;
     
    /**
     *
     * @var string
     */
    public $key;
     
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
    public $kana;
    public $kanaError;
    
    public $mode;
    public $modePre;
    public $modeNext;
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
            'id'               => 'vendorId',
            'key'              => 'key',
            'name'             => 'name', 
            'kana'             => 'kana', 
            'mode'             => 'mode', 
            'mode_pre'         => 'modePre', 
            'mode_next'        => 'modeNext', 
            'status'           => 'status', 
            'created_user'     => 'createdUser',
            'updated_user'     => 'updatedUser',
            'created_date'     => 'createdDate',
            'updated_date'     => 'updatedDate'
        );
    }
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'name',
            'kana',
            'modeNext'
        );
    }
    
    public function initialize()
    {        
        $this->addBehavior(new SoftDelete(
            array(
                'field' => 'status',
                'value' => Consts::NOACTIVE
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

        $this->hasOne("vendorId", "VendorDetail", "vendorId", 
            array(
                'alias'  => 'detail',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        $this->hasMany('vendorId', 'Unit', 'vendorId',
             array(
                'alias'  => 'unit',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Operator', 'vendorId', 
            array(
                'alias'  => 'operator',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Info', 'vendorId', 
            array(
                'alias'  => 'info',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasOne('vendorId', 'Privacy', 'vendorId', 
            array(
                'alias'  => 'privacy',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'PreRegistrationMailUser', 'vendorId', 
            array(
                'alias'  => 'preregistrationmailUser',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'User', 'vendorId', 
            array(
                'alias'  => 'user',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Attribute', 'vendorId', 
            array(
                'alias'  => 'attribute',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Mailmaga', 'vendorId', 
            array(
                'alias'  => 'mailmaga',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        $this->hasMany('vendorId', 'WorkMailmaga', 'vendorId', 
            array(
                'alias'  => 'workmailmaga',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Checkup', 'vendorId',
             array(
                'alias'  => 'checkup',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
        
        $this->hasMany('vendorId', 'Interview', 'vendorId',
             array(
                'alias'  => 'interview',
                'foreignKey' => array(
                    'action' => \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                )
            )
        );
       
    }
    
    //public function setConnectionService($service) {
    //    parent:: setConnectionService($service);
    //    if(!$this->vendordetail) {
    //        $this->__get('detail');
    //        $this->detail->setConnectionService($service);
    //    }
    //}

    public function getSource()
    {
        return 'm_vendor';
    }
    
    /**
     * set parameter
     * @params array
     */
    public function setParam($parameters) {
        if(!is_array($parameters)) {
            return;
        }
        $checkColumn = $this->getPostColumns();
        foreach($checkColumn as $key) {
            if(isset($parameters[$key])) {
                $this->$key = $parameters[$key];
            }
        }

        if(!$this->detail) {
            $this->__get('detail');
        }
        $this->detail->setParam($parameters);
    }
    
    public function validation() {
    	$validator = new Validation();
        
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
        return $this->validate($validator);
    }
    
    public function beforeValidation() {
        $this->kana = mb_convert_kana($this->kana, "KVC");

    }
    
    /**
     * For VendorDetail
     */
    public function __get($property){
        $lowerproperty = strtolower($property);

        if($lowerproperty == 'detail') {
            $property = 'detail';
            if(!property_exists($this, 'detail')) {
            
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('detail'));
                    
                } else {
                    $this->__set($property, new VendorDetail());
                }
           }
        } elseif($lowerproperty == 'unit') {
            if(!property_exists($this, 'unit')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('unit'));
                } else {
                    $this->__set('unit', NULL);
                }
            }
        } elseif($lowerproperty == 'operator') {
            if(!property_exists($this, 'operator')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('operator'));
                } else {
                     return array();
                }
            }
        } elseif($lowerproperty == 'info') {
            if(!property_exists($this, 'info')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('info'));
                } else {
                     return array();
                }
            }
        } elseif($lowerproperty == 'privacy') {
            $property = 'privacy';
            if(!property_exists($this, 'privacy')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('privacy'));
                }
                if(!$this->privacy) {
                    $this->__set($property, new Privacy());
                }
            }
        } elseif($lowerproperty == 'preregistrationmailuser') {
            $property = 'preregistrationmailuser';
            if(!property_exists($this, 'preregistrationmailuser')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('preregistrationmailuser'));
                } else {
                    $this->__set($property, NULL);
                }
            }
        } elseif($lowerproperty == 'user') {
            $property = 'user';
            if(!property_exists($this, 'user')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('user'));
                } else {
                    $this->__set($property, NULL);
                }
            }
        } elseif($lowerproperty == 'attribute') {
            $property = 'attribute';
            if(!property_exists($this, 'attribute')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('attribute'));
                } else {
                    $this->__set($property, NULL);
                }
            }
        } elseif($lowerproperty == 'mailmaga') {
            $property = 'mailmaga';
            if(!property_exists($this, 'mailmaga')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('mailmaga'));
                } else {
                    $this->__set($property, NULL);
                }
            }
        } elseif($lowerproperty == 'workmailmaga') {
            $property = 'workmailmaga';
            if(!property_exists($this, 'workmailmaga')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('workmailmaga'));
                } else {
                    $this->__set($property, NULL);
                }
            }
        } elseif($lowerproperty == 'checkup') {
            if(!property_exists($this, 'checkup')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('checkup'));
                } else {
                    $this->__set('checkup', NULL);
                }
            }
        } elseif($lowerproperty == 'interview') {
            if(!property_exists($this, 'interview')) {
                if($this->vendorId) {
                    $this->__set($property, $this->getRelated('interview'));
                } else {
                    $this->__set('checkup', NULL);
                }
            }
        }
        return $this->$property;
    }

    
    public static function get($vendorId = NULL) {
        
        if($vendorId) {
            return  Vendor::findFirst(array(
    	        "conditions" => "status = ?1 and vendorId = ?2",
    	        "bind"       => array(1 => Consts::ACTIVE, 2 => $vendorId)
    	    ));
    	} else {
    	    return  Vendor::findFirst(array(
    	        "conditions" => "status = ?1",
    	        "bind"       => array(1 => Consts::ACTIVE)
    	    ));
    	}
    	
    }
    
    public function getArray() {
        $data = array();
        $list = $this->getPostColumns();
        foreach($list as $column) {
            $data[$column] = $this->$column;
        }
        if(!$this->detail) {
            $this->__get('detail');
        }
        $list = $this->detail->getPostColumns();
        foreach($list as $column) {
            $data[$column] = $this->detail->$column;
        }
        return $data;
    }
    
    public function afterCreate() {
        if(property_exists($this, 'key')) {
            if(!$this->key) {
                $this->key = Utils::formatVendorKey($this->vendorId);
                $this->skipAttributes(
                    array(
                        'status'
                    )
                );
                $this->save();
            }
        }
    }
    
    public static function getList($offset = Consts::OFFSET, $limit = Consts::PAGING) {
        return $list = Vendor::find(array(
            "conditions" => "status =" . Consts::ACTIVE
            ,"limit"  => $limit
    	    ,"offset" => $offset * $limit
    	    ,'order'  =>  'kana'
        ));
    }
    

}