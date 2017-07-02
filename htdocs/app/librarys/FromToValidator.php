<?php

use Phalcon\Mvc\Model\Validator,
    Phalcon\Mvc\Model\ValidatorInterface;

class FromToValidator extends Validator implements ValidatorInterface
{

    //public function validate(\Phalcon\Mvc\EntityInterface $model)
    public function validate(Phalcon\Mvc\ModelInterface $model)
    {
        $fromTarget = $this->getOption('fromfield');
        $toTarget   = $this->getOption('tofield');
        
        $from       = $this->getOption('from');
        $to         = $this->getOption('to');
        
        $fromValue  = $model->$fromTarget;
        $toValue    = $model->$toTarget;
        
        
        if(!is_numeric($fromValue) || !is_numeric($toValue)) {
            if(empty($fromValue) && empty($toValue) ) {
                return true;
            }
            
        
            if(!is_numeric($fromValue)) {
                $this->appendMessage(
                    "",
                    $fromTarget,
                    "FromTo"
                );
            }
            
            if(!is_numeric($toValue)) {
                $this->appendMessage(
                    "",
                    $toTarget,
                    "FromTo"
                );
            }
            
            $this->appendMessage(
                "",
                $fromTarget,
                "FromTo"
            );
            return false;
        }

        if ($fromValue > $toValue || $fromValue < $from || $toValue > $to) {
            if($fromValue > $toValue) {
                $this->appendMessage(
                    "",
                    $fromTarget,
                    "FromTo"
                );
            }
            
            if($fromValue < $from) {
                $this->appendMessage(
                    "",
                    $fromTarget,
                    "FromTo"
                );
            }
            
            if($toValue > $to) {
                $this->appendMessage(
                    "",
                    $toTarget,
                    "FromTo"
                );
            }
            
            $this->appendMessage(
                "",
                $fromTarget,
                "FromTo"
            );
            return false;
        }
        return true;
    }

}