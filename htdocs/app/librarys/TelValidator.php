<?php

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class TelValidator extends Validator
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(Validation $validator, $attribute)
    {

        $value = $validator->getValue($attribute);
        if(!$value) {
            return true;
        }
        $valid = false;

        $valid = preg_match('/^0\d0-\d{4}-\d{4}$/', $value);
        if(!$valid) {
            $valid = preg_match('/^0\d0\d{8}$/', $value);
        }
        if(!$valid) {
            $valid = preg_match('/^\d{2,5}-\d{1,4}-\d{4}$/', $value);
        }
        if(!$valid) {
            $valid = preg_match('/^0\d{9}$/', $value);
        }

        if($valid) {
            return true;
        }
        
        $validator->appendMessage(
            new Message("Telephone format is not correct.",
            $attribute,
            "Tel"
            )
        );
        return false;
    }

}