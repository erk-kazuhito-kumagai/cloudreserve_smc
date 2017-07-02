<?php

use Phalcon\Mvc\Model\Validator,
    Phalcon\Mvc\Model\ValidatorInterface;

class MaxMinValidator extends Validator implements ValidatorInterface
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(\Phalcon\Mvc\ModelInterface $model)
    {
        $field = $this->getOption('field');

        $min = $this->getOption('min');
        $max = $this->getOption('max');

        $value = $model->$field;
        
        if(!is_numeric($value)) {
            if(empty($value)) {
                return true;
            }
            $this->appendMessage(
                "The field doesn't have the right range of values",
                $field,
                "MaxMin"
            );
            return false;
        }

        if ($min < $value && $value > $max) {
            $this->appendMessage(
                "The field doesn't have the right range of values",
                $field,
                "MaxMin"
            );
            return false;
        }
        return true;
    }

}