<?php

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class PostValidator extends Validator
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(Validation $validator, $attribute)
    {

        $value = $validator->getValue($attribute);
        if(!$value) {
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
        
        $validator->appendMessage(
            new Message("zip format is not correct.",
            $attribute,
            "Post"
            )
        );
        return false;
    }

}