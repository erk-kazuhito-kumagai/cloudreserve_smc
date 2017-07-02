<?php
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation;

class VendorDetail extends ModelBase
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
    public $category;
    public $categoryError;
    
    
    /**
     *
     * @var int
     */
    public $healthCheck;

     
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
        
        $this->belongsTo("vendorId", "Vendor", "vendorId");
        
        $this->skipAttributesOnCreate(array('healthCheck'));
    }
    
    
    /**
     * Validations and business logic
     */
     
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

        
        
        return $this->validate($validator);
    }
    public function beforeValidation()
    {
        
        if(!$this->healthCheck) {
           $this->healthCheck = 0;
        }
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
            'category'     => 'category', 
            'health_check' => 'healthCheck', 
            'created_user' => 'createdUser',
            'updated_user' => 'updatedUser',
            'created_date' => 'createdDate',
            'updated_date' => 'updatedDate'
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
            'category'     => 'category',
            'healthCheck'  => 'healthCheck'
        );
    }

    public function getSource()
    {
        return 'm_vendor_detail';
    }
    
    public function beforeSave() {
        
        $this->tel        = str_replace('-', '', $this->tel);
        $this->post       = str_replace('-', '', $this->post);
    }
}