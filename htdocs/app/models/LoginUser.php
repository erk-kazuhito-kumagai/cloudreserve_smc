<?php

class LoginUser
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $vendorId;

    /**
     *
     * @var string
     */
    public $email;

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
     * Magic method to assign values to the the model
     * @property unknown
     * @property unknown
     */
    public function __set($property, $value) {
        if(!property_exists($this, $property)) {
            $this->{$property}  = $value;
        }
    }


    public function beforeValidation()
    {
       exit;
    }
}