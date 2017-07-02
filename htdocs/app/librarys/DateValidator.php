<?php

use Phalcon\Mvc\Model\Validator,
    Phalcon\Mvc\Model\ValidatorInterface;

class DateValidator extends Validator implements ValidatorInterface
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(\Phalcon\Mvc\ModelInterface $model)
    {
        $field = $this->getOption('field');

        $value = $model->$field;
        if(!$value) {
            return true;
        }
        $valid = false;
        
        $d = DateTime::createFromFormat('Ymd', $value);
       
        if($d && $value == $d->format('Ymd')) {
            $valid = true;
        }
        
        if(!$valid) {
            $d = DateTime::createFromFormat('Y/m/d', $value);
            if($d && $value == $d->format('Y/m/d')) {
                $valid = true;
            }
        }
        
        if(!$valid) {
            $d = DateTime::createFromFormat('Y-m-d', $value);
            if($d && $value == $d->format('Y-m-d')) {
                $valid = true;
            }
        }
        
        if($valid) {
            return true;
        }
        print "OK";
        $this->appendMessage(
            "zip format is not correct.",
            $field,
            "Date"
        );
        return false;
    }

}