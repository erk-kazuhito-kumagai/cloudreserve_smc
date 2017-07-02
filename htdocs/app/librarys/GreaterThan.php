<?php

use Phalcon\Mvc\Model\Validator,
    Phalcon\Mvc\Model\ValidatorInterface;

class GreaterThan extends Validator implements ValidatorInterface
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(Phalcon\Mvc\ModelInterface $model)
    {
        $smallTarget = $this->getOption('smallfield');
        $bigTarget   = $this->getOption('bigfield');
        
        $smallValue  = $model->$smallTarget;
        $bigValue    = $model->$bigTarget;
        
        
        if(!is_numeric($smallValue) || !is_numeric($bigValue)) {
            if(empty($smallValue) && empty($bigValue) ) {
                return true;
            }
            
        
            if(!is_numeric($smallValue)) {
                $this->appendMessage(
                    "",
                    $smallTarget,
                    "GreaterThan"
                );
            }
            
            if(!is_numeric($bigValue)) {
                $this->appendMessage(
                    "",
                    $bigTarget,
                    "GreaterThan"
                );
            }
            
            $this->appendMessage(
                "",
                $smallTarget,
                "GreaterThan"
            );
            return false;
        }

        if ($smallValue > $bigValue) {
            $this->appendMessage(
                "",
                $smallTarget,
                "GreaterThan"
            );
            return false;
        }
        return true;
    }

}