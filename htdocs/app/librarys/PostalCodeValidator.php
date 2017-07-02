<?php

use \Phalcon\Mvc\Model\Validator,
    \Phalcon\Mvc\Model\ValidatorInterface;

class PostalCodeValidator extends Validator implements ValidatorInterface
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(\Phalcon\Mvc\ModelInterface $model)
    {
        $field    = $this->getOption('field');
        $required = $this->getOption('required');

        $value = $model->$field;
        if(!$value && !$required) {
            return true;
        }
        $valid = false;

        $valid = preg_match('/^\d{3}\-\d{4}$/', $value);
        if(!$valid) {
            $valid = preg_match('/^\d{7}$/', $value);
        }
        
        if($valid) {
            return true;
        }
        
        $this->appendMessage(
            "zip format is not correct.",
            $field,
            "Postal"
        );
        return false;
    }

}