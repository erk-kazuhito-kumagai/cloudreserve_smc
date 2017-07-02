<?php

class Modelbase extends Phalcon\Mvc\Model
{

    public $errorMessages;
    
    public function initialize()
    {
        
    }

    protected function initializeModelErrorMessage() {
        $config = \Phalcon\DI\FactoryDefault::getDefault()->getShared('commonconfig');
        $global = \Phalcon\DI\FactoryDefault::getDefault()->getShared('global');
        require ($config->application->modelsDir . "messages/" . $global->language . '/' . get_class($this) . '.php');
        $this->modelErrorTranslate =  new CustomTranslate(array(
           "content" => $moduleMessages
        ));
    }
    
    public function afterValidation()
    {
    	if ($this->validationHasFailed() === true) {
        
	        $this->initializeModelErrorMessage();
	        $this->errorMessages = array();
	        foreach ($this->getMessages() as $message) {
	            $strName   = $message->getField();
	            $fieldName = $strName . 'Error';
	            $temp = $this->modelErrorTranslate->_($strName . '_' . $message->getType());
	            if($temp) {
	                $this->$fieldName = $temp;
	                $this->errorMessages[] = $this->$fieldName;
	            }
	            print $strName . '_' . $message->getType();
	            //print $this->$fieldName;
	        }
	        return false;
        }
        return true;
    }
    
    public function addValidate($validator) {
        $this->validate($validator);
    }
    
//    public function beforeSave()
//    {
//        if ($this->validationHasFailed() == true) {
//        print 11;
//        exit;
//            return false;
//        }
//        print 1;
//        exit;
//        return true;
//    }

    //public function beforeValidation()
    //{
    //    if ($this->validationHasFailed() == true) {
    //        return false;
    //    }
    //    return true;
    //}
    
    public function validation() {
        if ($this->validationHasFailed() == true) {
            return false;
        }
        return true;
    }
    
    public function getArray() {
        $data = array();
        $list = $this->getPostColumns();
        foreach($list as $column) {
            $data[$column] = $this->$column;
        }
        return $data;
    }
    
    /**
     * set parameter
     * @params array
     */
    public function setParam($parameters) {
        if(!is_array($parameters)) {
            return;
        }
        $checkColumn = $this->getPostColumns();
        foreach($checkColumn as $key) {
            if(isset($parameters[$key])) {
                $this->$key = $parameters[$key];
            }
        }
    }

}