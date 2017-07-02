<?php
class BusinessException extends \Exception
{
    /**
     * BussinessCheckException
     *
     * @param string   $erroCode
     * @param string   $message
     * @param variable $data
     */
     
     /*
      string
      */
     private $_errorCode;
     
     /*
      variable
      */
     private $_data;
     
     public function __construct($message = '', $errorCode, $data = '') {
        $this->message =  $message;
            if (is_string($errorCode)) {
                $this->_errorCode = $errorCode;
            }
            
            if (is_string($data) || is_array($data)) {
                $this->_data = $data;
            }
     }
     
     public function getErrorCode() {
         return $this->_errorCode;
     }
     
     public function getData() {
         return $this->_data;
     }

}
