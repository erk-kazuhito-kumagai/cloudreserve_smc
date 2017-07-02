<?php

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class KanaValidator extends Validator
{
    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(Validation $validator, $attribute)
    {
        $required = $this->getOption('required');

        $value = $validator->getValue($attribute);

        if(!$value && !$required) {
            return true;
        }

        mb_regex_encoding("UTF-8");
        $valid = mb_ereg("^[ァ-ヶー　]+$", $value);

        if($valid) {
            return true;
        }
        

        $validator->appendMessage(
            new Message("Kana is not correct.",
            $attribute,
            "Kana"
            )
        );
        return false;
    }
}