<?php
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;
class TemporaryVendor extends ModelBase
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
        
        $this->hasOne("vendorId", "TemporaryVendorDetail", "vendorId",
            array(
                
                'foreignKey' => array(
                    'action' =>  \Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                ),
                'alias'  => 'detail'
            )
        );
        
    }
    
    
    
    public function getSource()
    {
        return 't_vendor';
    }
    
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'               => 'vendorId',
            'name'             => 'name', 
            'kana'             => 'kana', 
            'status'           => 'status', 
            'created_user'     => 'createdUser',
            'updated_user'     => 'updatedUser',
            'created_date'     => 'createdDate',
            'updated_date'     => 'updatedDate'
        );
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
                    $model = $this->getRelated('detail');
                    $this->__set($property, $model);
                } else {
                    $this->__set($property, new TemporaryVendorDetail());
                }
           }
       }

       return $this->$property;
    }
    
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
    
    /**
     * check in post data columns
     */
    public function getPostColumns()
    {
        return array(
            'name',
            'kana'
        );
    }
    
    public function setConnectionService($service) {
        parent:: setConnectionService($service);
        if(!$this->detail) {
            $this->__get('detail');
            $this->detail->setConnectionService($service);
        }
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

        if(!$this->detail) {
            $this->__get('detail');
        }
        $this->detail->setParameters($parameters);
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
}